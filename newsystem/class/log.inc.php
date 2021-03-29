<?php
Class LogActicity extends Dbh{

	protected $invrunno;
	protected $period;

	public function __construct($invrunno,$period){
		$this->invrunno = $invrunno;
		$this->period = $period;
		// echo "in LogActicity \$invrunno= $invrunno <br>";

	}


	public function loginvoice(){

		$invrunno = $this->invrunno;
		$period = $this->period;
		// echo "\$invrunno = $invrunno <br>";

		$ip = getenv(REMOTE_ADDR);
		$operation = $period.' Invoice running no';
		// $inv_no = $invcotype.$invrunno;
		$NOW = date("Y-m-d H:i:s", time());
		$url = $_SERVER['REQUEST_URI']; //returns the current URL
		$parts = explode('/',$url);
		$dir = $_SERVER['SERVER_NAME'];
		for ($i = 0; $i < count($parts) - 1; $i++) {
		$dir .= $parts[$i] . "/";
		}
		// echo "you are  $user  login  "."from IP Address:  "."$ip   <br>"." have just issued DO no :  $qno  <br> the record is keep in database.<br >";
		$sql = "INSERT INTO invrunno_log (id,  ip, date_time, invrunno,OPERATION, SERVER_PATH) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $this->connect()->prepare($sql);
        $resultArray = array(NULL,(string)$ip , $NOW , (string)$invrunno, (string)$operation, (string)$dir);
        $stmt-> execute($resultArray);



	}

	function __destruct(){
	 
	// echo  "after completion generate,  object  destroyed automatically <br>";
	 
	}
	
}

Class OperationLegacy extends Dbh{

	protected $user;
	protected $password;
	protected $ip;
	protected $operation;
	protected $myinvno;


	function __construct($user,$password,$ip,$operation,$myinvno){

		$this->user = $user;
		$this->password = $password;
		$this->ip = $ip;
		$this->operation = $operation;
		$this->myinvno = $myinvno;


	}

	function putOpsInfoIntoAdmin_Fail_live(){
		$user = $this->user;
		$password = $this->password;
		$ip = $this->ip;
		$operation = $this->operation;
		$myinvno = $this->myinvno;
		
		$sql = "INSERT INTO admin_fail_live (afid, username, password, ip, date_time, status,OPERATION) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($sql);
        $nowDate = date('Y-m-d H:i:s');
        $resultArray = array(NULL, (string)$user, (string)$password, (string)$ip, (string)$nowDate, (string)$myinvno, (string)$operation, );

        $statement-> execute($resultArray);
	}


}
Class FullOperation extends OperationLegacy{

	public function __construct($user,$password,$ip,$operation,$myinvno,$dir){
		$this->dir = $dir;
		parent::__construct($user,$password,$ip,$operation,$myinvno);
	}
        
	public function LogInfoToAdmin_Fail_live(){
		$user = $this->user;
		$password = $this->password;
		$ip = $this->ip;
		$operation = $this->operation;
		$jobno = $this->myinvno;
		$dir = $this->dir;

		// echo "\$user = $user"."   "."\$password = $password"."    ".
  //    "\$ip = $ip"."    "."\$operation = $operation"."   ".
  //    "\$jobno = $jobno"."    "."\$dir = $dir <br>";


		$sql = "INSERT INTO admin_fail_live (afid, username, password, ip, date_time, status,OPERATION, SERVER_PATH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($sql);
        $nowDate = date('Y-m-d H:i:s');
        $resultArray = array(NULL, (string)$user, (string)$password, (string)$ip, (string)$nowDate, (string)$jobno, (string)$operation, (string)$dir);
        print_r($resultArray);
        $statement-> execute($resultArray);



	}

}

?>