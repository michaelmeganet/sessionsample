<?php
/**
 * ID 生成策略
 * 毫秒级时间41位+机器ID10位+毫秒内序列10位+版本号2位
 * 0           41      51          62      64
 * +-----------+-------+-----------+--------+
 * |timestamp  |worker |sequence   |version |
 * +-----------+-------+-----------+--------+
 *  the first 41bits timestamp in mini second as unit
 *  the next 10bits is preset worker ID。different worker ID responsible to generate different instance Id for user name of external entities.
 *  the next 11bits is the accumulation counter sequence id。
 *  the last 2bits is version id，initila value is 1
 *  worker id(10bits)
 * maximum 1024 user  or worker  can be generate ID，sequence number(10bits) simultaneously 
 that's mean 1 machine /user could generate maximum 1024 IDs within 1 ms 
 */

// namespace \Lib\Id;

class IdGenerate {
    const DEBUG = 1;

    //worker
    const WORKER_ID_MAX = 1023;     //work maximum value
    const WORKER_ID_MIN = 0;
    const WORKER_ID_BITS = 4;
    const WORKER_ID_DEFAULT = 1;

    const SEQUENCE_BITS = 11;
    const SEQUENCE_DEFAULT = 1;
    const SEQUENCE_MASK = 2047;     //sequence maximum value

    const OFFSET_LEFT_TIMESTAMP = 23;
    const OFFSET_LEFT_WORKER = 13;
    const OFFSET_LEFT_SEQUENCE = 2;

    const VERSION_DEFAULT = 1;

    private static $versionNum = 1; //version
    private static $workerId;       //机器id，可以通过随机整数对1024取余得到
    //machine / user id, take the remainder of the random number divided by an integer pair.
    private static $sequence = 0;   //sequence id
    //private static $basicTimestamp = 1420041600000; //15778080002015年01月01日0点毫秒时间戳，作为系统基础时间戳
    private static $basicTimestamp = 1520041600000;//dat time datum date line 2020-01-01
    private static $lastTimestamp = -1;

    private static $_instance = array();

    /**
     * 构造函数，可以根据不同的业务类型分配不同段的id生产机器
     *
     * @param $params
     */
    private function __construct($params){
        $workId = isset($params['work_id']) ? $params['work_id'] : self::WORKER_ID_DEFAULT;
        $workId = $workId % self::WORKER_ID_MAX;
        self::$workerId = $workId;

        self::$versionNum = isset($params['version_num']) ? $params['version_num'] : self::VERSION_DEFAULT;
        self::$sequence = isset($params['sequence']) ? $params['sequence'] : self::SEQUENCE_DEFAULT;
    }

    private function __clone() {
        die("Cannot clone the single class " . __CLASS__ . E_USER_ERROR);
    }

    /**
     * 单例实现，根据work_id来实现单例数组
     * @author: Lewison(lewisonchen@gmail.com)
     * @version: 1.0
     * @param $params
     * @return IdGenerate|null
     */
    public static function getInstance($params) {
        if (isset($params['work_id'])) {
            $params['work_id'] = self::WORKER_ID_DEFAULT;
        }

        if (empty(self::$_instance[$params['work_id']])) {
            self::$_instance[$params['work_id']] = new IdGenerate($params);
        }

        return self::$_instance[$params['work_id']];
    }

    /**
     * 获取毫秒时间戳
     * @author: Lewison(lewisonchen@gmail.com)
     * @version: 1.0
     * @return string
     */
    private function _getMillisecond(){
        //获得当前时间戳
        $time = explode(' ', microtime());
        $time2= substr($time[0], 2, 3);
        return  $time[1].$time2;
    }

    /**
     * 获取下一个毫秒时间戳
     * @author: Lewison(lewisonchen@gmail.com)
     * @version: 1.0
     * @param $lastTimestamp
     * @return string
     */
    public function toNextMillis($lastTimestamp) {
        $timestamp = $this->_getMillisecond();
        while ($timestamp <= $lastTimestamp) {
            $timestamp = $this->_getMillisecond();
        }

        return $timestamp;
    }

    /**
     * 获取消息池中的下一个id
     * @author: Lewison(lewisonchen@gmail.com)
     * @version: 1.0
     * @return bool|int
     */
    public function  generatorNextId()
    {
        $timestamp=$this->_getMillisecond();
        if(self::$lastTimestamp == $timestamp) {
            //并发请求的时候如果timestamp一致，则列入不同的队列中
            self::$sequence = (self::$sequence + 1) & self::SEQUENCE_MASK;
            if (self::$sequence == 0) {
                //已经超出最大队列2047
                $timestamp = $this->toNextMillis(self::$lastTimestamp);
            }
        } else {
            //脚本第一次请求本方法，被放置入默认队列中
            self::$sequence  = self::SEQUENCE_DEFAULT;
        }

        if ($timestamp < self::$lastTimestamp) {
            return false;
        }

        self::$lastTimestamp = $timestamp;
        $intervalTimestamp = sprintf('%.0f', $timestamp) - sprintf('%.0f', self::$basicTimestamp);
        $nextId = ($intervalTimestamp << self::OFFSET_LEFT_TIMESTAMP )
            | ( self::$workerId << self::OFFSET_LEFT_WORKER )
            | (self::$sequence << self::OFFSET_LEFT_SEQUENCE)
            | self::$versionNum;
        return $nextId;
    }

}
