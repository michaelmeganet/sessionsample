<?php

//CJ DCM 2011 1606 02 2011
//CJ KCR 2011 0164 01
#include_once ('class/dbh.inc.php');
#include_once ('class/variables.inc.php');
#include_once ('class/phhdate.inc.php');
#include_once ('class/pmach.inc.php');

function checkAnyMillProcess($ProcessName) {

    $check = substr($ProcessName, 1, 1);

    return $check;
}

function checkAnyRGProcess($ProcessName) {

    ##echo "in the fucntion checkAnyRGProcess , \$ProcessName = $ProcessName\n";

    #refer https://www.evernote.com/l/AJMyzaanFTlKK6krVVJPGpjqDuDWXbHOWzk/
    # https://www.runoob.com/php/php-preg_filter.html
    //$str = "4WA2RGA";
    //$pattern = "/4WA2RGA/";
    //#echo preg_filter($pattern, "RGA", $str);
    //result = SGA
    //
    ## check it is RG or RGA
    $TEST = stristr("$ProcessName", "RGA");
    if (!isset($TEST) || empty($TEST) || $TEST != "RGA") {

        $TEST = stristr("$ProcessName", "RG");
        ##echo "the process is RG ,because \$TEST = $TEST\n";
    } else {
        ##echo "the process is RGA ,because \$TEST = $TEST\n";
    }


    if (!empty($TEST) || !isset($TEST)) {


        $pattern = "/" . $ProcessName . "/";
        switch ($TEST) {
            case "RGA":

                $check = preg_filter($pattern, "RGA", $ProcessName);
                break;
            case "RG":

                $check = preg_filter($pattern, "RG", $ProcessName);
                break;

            default:
                $check = "not found.";
                break;
        }

        //#echo "LINE 61 -> \$check =  $check \n";


        return $check;
    }
}

function checkAnySGProcess($ProcessName) {
    ##echo "in the fucntion checkAnySGProcess , \$ProcessName = $ProcessName\n";
    //$check = strpbrk($ProcessName, "SG");
    #refer https://www.evernote.com/l/AJMyzaanFTlKK6krVVJPGpjqDuDWXbHOWzk/
    # https://www.runoob.com/php/php-preg_filter.html
    //$str = "4WA2SGA";
    //$pattern = "/4WA2SGA/";
    //#echo preg_filter($pattern, "SGA", $str);
    //result = SGA
    ##echo "\$ProcessName = $ProcessName\n";
    $TEST = stristr("$ProcessName", "SGA");
    ##echo "\$TEST = $TEST \n";
    #var_dump($TEST);
    ###echo "\n";
    $TEST = stristr("$ProcessName", "SG");
    if (!$TEST || !isset($TEST) || empty($TEST) || $TEST != "SGA") {

        ##echo "the process is SG ,because \$TEST = $TEST\n";
    } else {
        ##echo "the process is not SG ,because \$TEST = $TEST\n";
    }

    if (!empty($TEST) || !isset($TEST)) {

        $pattern = "/" . $ProcessName . "/";
        switch ($TEST) {
            case "SGA":

                $check = preg_filter($pattern, "SGA", $ProcessName);
                break;
            case "SG":

                $check = preg_filter($pattern, "SG", $ProcessName);
                break;

            default:
                $check = "not found";
                break;
        }

        //##echo "LINE 117 -> \$check =  $check \n";


        return $check;
    }
}

function checkFacesSG($ProcessName) {
    ##echo "in function of checkFacsesSG \n";
    $startPosition = strpos("$ProcessName", "SG");
    $noOfSurface = substr($ProcessName, ($startPosition - 1), 1);
    ##echo "\$noOfSurface = $noOfSurface \n";
    return $noOfSurface;
}

function checkFacesSGA($ProcessName) {
    ##echo "in function of checkFacsesSGA \n";
    $startPosition = strpos("$ProcessName", "SGA");
    $noOfSurface = substr($ProcessName, ($startPosition - 1), 1);
    ##echo "\$noOfSurface = $noOfSurface \n";
    return $noOfSurface;
}

function checkFacesRG($ProcessName) {
    ##echo "in function of checkFacsesRG \n";
    $startPosition = strpos("$ProcessName", "RG");
    $noOfSurface = substr($ProcessName, ($startPosition - 1), 1);
    ##echo "\$noOfSurface = $noOfSurface \n";
    return $noOfSurface;
}

function checkFacesRGA($ProcessName) {
    ##echo "in function of checkFacsesRGA \n";
    $startPosition = strpos("$ProcessName", "RGA");
    $noOfSurface = substr($ProcessName, ($startPosition - 1), 1);
    ##echo "\$noOfSurface = $noOfSurface \n";
    return $noOfSurface;
}

function numberToWords($int) {
    ##echo "in function numberToWords , \$int = $int\n";
    switch ($int) {
        case "1":
            $response = "ONE";
            return $response;
            break;
        case "2":
            $response = "TWO";
            return $response;
            break;
        case "3":
            $response = "THREE";
            return $response;
            break;
        case "4":
            $response = "FOUR";
            return $response;
            break;
        case "5":
            $response = "FIVE";
            return $response;
            break;
        case "6":
            $response = "SIX";
            return $response;
            break;
        default:
            $response = "empty";
            return $response;
            break;
    }
}

function get_detail_by_jobcode($jobcode) {
    // get the infomation by $period and $jobcode
    // from the production_scheduling_period and the coressponding
    //production_output_period
    ##echo "enter function of get_detail_by_jobcode \n";
    $branch = substr($jobcode, 0, 2);
    $co_code = substr($jobcode, 3, 3);
    $yearmonth = '20' . substr($jobcode, 7, 2) . '-' . substr($jobcode, 9, 2);
    $runningno = (int) substr($jobcode, 12, 4);
    $jobno = (int) substr($jobcode, 17, 2);
    $periodQuono = substr($jobcode, 7, 4);
    $objPeriod = new Period();
    $period = $objPeriod->getcurrentPeriod();
    ##echo "\$branch = $branch , \$co_code = $co_code, \$yearmonth = $yearmonth, \$runningno = $runningno, \$jobno = $jobno\n";
    ##echo "\$period = $period\n";
    $proschtab = 'production_scheduling_' . $period;
    ##echo "$proschtab = $proschtab \n";
    $qr = "SELECT * FROM $proschtab "
            . "WHERE jlfor = '$branch' "
            . "AND quono LIKE '$co_code%' "
            #. "AND date_issue LIKE '$yearmonth%' "
            . "AND runningno = $runningno "
            . "AND status = 'active' "
            #. "AND jobno = $jobno";
            . "AND noposition = $jobno";
    ##echo "\$qr = $qr \n";
    ##echo "\n###########################################################################\n";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    //print_r($result);
    if (!empty($result)) {
        return $result;
    } else {//if current period table cant see any reudlt check last period table
        //return 'empty';
        $lastperiod = $objPeriod->getlastPeriod();
        $proschtab = 'production_scheduling_' . $lastperiod;
        ##echo "check last period ,$proschtab \n";
        $qr = "SELECT * FROM $proschtab "
                . "WHERE jlfor = '$branch' "
                . "AND quono LIKE '$co_code%' "
                #. "AND date_issue LIKE '$yearmonth%' "
                . "AND runningno = $runningno "
                . "AND status = 'active' "
                #. "AND jobno = $jobno";
                . "AND noposition = $jobno";
        ##echo "\$qr = $qr \n";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            return $result;
        } else {
            return 'empty';
        }
    }
}

function find_sid_by_jobcode($period, $jobcode) {
    // get the infomation by $period and $jobcode
    // production_output_period
    //
    $branch = substr($jobcode, 0, 2);
    $co_code = substr($jobcode, 3, 3);
    $yearmonth = '20' . substr($jobcode, 7, 2) . '-' . substr($jobcode, 9, 2);
    $runningno = (int) substr($jobcode, 12, 4);
    $jobno = (int) substr($jobcode, 17, 2);
    $proschtab = 'production_scheduling_' . $period;
    $qr = "SELECT * FROM $proschtab "
            . "WHERE jlfor = '$branch' "
            . "AND quono LIKE '$co_code%' "
            #. "AND date_issue LIKE '$yearmonth%' "
            . "AND runningno = $runningno "
            . "AND status = 'active' "
            #. "AND jobno = $jobno";
            . "AND noposition = $jobno";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    #print_r($result);
    if (!empty($result)) {
        return $result;
    } else {
        return 'no sid can be found in $proschtab \n';
    }
}

function findCo_codeBycid($cid, $company) {

    $sql = "SELECT co_code FROM customer_" . strtolower($company) . " "
            . " WHERE cid = $cid ";
    ##echo "sql = $sql \n";
    $objcid = new SQL($sql);
    $result = $objcid->getResultOneRowArray();
    $co_code = $result['co_code'];
    ##echo "in function findCo_codeBycid, co_code = $co_code\n";
    ##echo "sql = $sql \n";
    return $co_code;
}

function findQuonoPeriod($quono) {

    $period = substr($quono, 4, 4);
    return $period;
}

function findProcessName($process) {
    $sql = "SELECT * FROM premachining where pmid = '$process' ";
    $objSql = new SQL($sql);
    $result = $objSql->getResultOneRowArray();
    $processName = $result['process'];
    return $processName;
}

Class PROCESS {

    public $joblistno;
    public $cutCode;
    protected $processType;
    public $cuttingType;
    public $millFaces;
    public $RGFaces;
    public $SGFaces;
    //public $ProcessSurface;
    protected $cutType;
    protected $ProcessName;
    protected $SurfaceFinish;
    protected $processCode;
    public $millFaceCode;
    public $SGFaceCode;
    public $RGFaceCode;
    public $ProcessSurface;
    protected $sid;
    protected $bid;
    protected $qid;
    protected $quono;
    protected $company;
    protected $cid;
    protected $quantity;
    protected $grade;
    protected $process;
    protected $runningno;
    protected $jobno;
    protected $jlfor;
    protected $status;
    protected $SurfaceProcess;
    protected $SurfaceProcessSymbol;
    public $Mill_SurfaceProcessCode;
    public $Mill_SurfaceProcessSymbol;
    public $SG_SurfaceProcessSymbol;
    public $SG_SurfaceProcessCode;
    public $RG_SurfaceProcessSymbol;
    public $RG_SurfaceProcessCode;
    public $ThickSizeMill;
    public $WidthSizeMill;
    public $LengthSizeMill;
    public $ThickSizeSurfGrind; //LSG or LSGA
    public $WidthSizeSurfGrind; //WSG or WSGA
    public $LengthSizeSurfGrind; //LSG or LSGA

//        $millFaceCode = $objMill->millFaceCode;
//        #echo "millFaceCode = $millFaceCode \n";
//        $SGFaceCode = $objSG->SGFaceCode;
//        #echo "SGFaceCode = $SGFaceCode \n";
//        $RGFaceCode = $objRG->RGFaceCode;
//        #echo "RGFaceCode = $RGFaceCode \n";

    public function __construct($jobcode) {

//        $cutCode = "";
        //Assume all jobcode is current month and last month jobcode
        $cutCode = "";
        $objPeriod = new Period();
        $thisPeriod = $objPeriod->getcurrentPeriod();
        $prevPeriod = $objPeriod->getlastPeriod();
        $sch_detail = get_detail_by_jobcode($jobcode);
//        var_dump($sch_detail);
        ##echo "\n";
        if (isset($sch_detail) && $sch_detail != 'empty') {
//            $status = $sch_detail['status'];
            ##echo "in isset(\$sch_detail) && !empty(\$sch_detail) \n";
            $status = $sch_detail['status'];
            $this->status = $status;
        }
//        $status = $this->status;
        ##echo "JOBCODE Input is $jobcode \n";
        if ($sch_detail == 'empty') {
            ##echo "there is no record of $jobcode could be found on current period ($thisPeriod) and last period ($prevPeriod)\n";
        } elseif ($status != "active") {
            ##echo "The status for  $jobcode is $status, which is not the active status, this jobcode have issue.\n";
        } else {

            $this->sid = $sch_detail['sid'];
            $this->bid = $sch_detail['bid'];
            $this->qid = $sch_detail['qid'];
            $this->quono = $sch_detail['quono'];
            $quono = $sch_detail['quono']; //local
            $this->company = $sch_detail['company'];
            $company = $sch_detail['company'];
            $this->cid = $sch_detail['cid'];
            $cid = $sch_detail['cid']; //local
            $this->quantity = $sch_detail['quantity'];
            $this->grade = $sch_detail['grade'];
            $this->process = $sch_detail['process'];
            $process = $sch_detail['process'];
            $this->cuttingType = $sch_detail['cuttingtype'];
            $this->runningno = (string) $sch_detail['runningno'];
            $runningno = (string) $sch_detail['runningno'];
            $this->jobno = (string) $sch_detail['jobno'];
            #$jobno = (string) $sch_detail['jobno']; // local
            $jobno = (string) $sch_detail['noposition']; // Use noposition instead
            $this->jlfor = $sch_detail['jlfor'];
            $jlfor = $sch_detail['jlfor']; // local

            if (strlen($jobno) == 1) {
                $jobno = "0" . $jobno;
            }
            if (strlen($runningno) == 1) {

                $runningno = "000" . $runningno;
            } elseif (strlen($runningno) == 2) {
                $runningno = "00" . $runningno;
            } elseif (strlen($runningno) == 3) {
                $runningno = "0" . $runningno;
            } else {
                ## do nothing
            }
            ##### look for co_code
            $co_code = findCo_codeBycid($cid, $company);
            ### look for quotation period
            $quonoPeriod = findQuonoPeriod($quono);
            ### look for process name
            ##$this->ProcessName = $sch_detail['process'];
            $processName = findProcessName($process);
            $this->ProcessName = $processName;

            ##echo "in constructor of Class PROCESS \n";
            ##echo "The below scope variables have been instantiated \n ";
            ##echo "<b>sid = $this->sid , bid = $this->bid , qid = $this->qid, quono = $this->quono \n";
            ##echo "company = $this->company, cid = $this->cid, quantity = $this->quantity, grade = $this->grade\n";
            ##echo "process = $this->process, processName = $this->ProcessName cuttingType = $this->cuttingType, ";
            ##echo "runningno = $this->runningno, jobno = $this->jobno, jlfor = $this->jlfor, status = $this->status \n";
            ##echo "processName = $processName </b>\n";
            ##echo "\n";
            ##echo "############Resolve back to JOBCOBE ######################################\n";
            ##echo "JOBCODE IS " . $jlfor . " " . $co_code . " " . $quonoPeriod . " " . $runningno . " " . $jobno . "\n";

            $objcutCode = new CUTPROCESS($this->cuttingType); //aggregation relationship
            $cutCode = $objcutCode->cutCode;

//            $this->cuttingType = $objcutCode ;
            $this->cutCode = $cutCode;

            ####
            ## check if there is a milling process
            $checkMill = checkAnyMillProcess($this->ProcessName); //Assume it is W
            if ($checkMill == "W") {// Milling
                $objMill = new MILL($this->ProcessName);
            } else {

            }

            #####
            ## check if there is a Surface Grinding Process

            $checkSG = checkAnySGProcess($this->ProcessName);
            ##echo "Line 437 , before enter !empty(\$checkSG) \$checkSG = $checkSG \n";
            if (!empty($checkSG)) {
                if ($checkSG == 'SG') {// SG process
                    ##echo "\$checkSG = $checkSG \n";
                    //  $objSG = new SG($this->ProcessName);
                } elseif ($checkSG == 'SGA') {
                    ##echo "\$checkSG = $checkSG \n";
                }
                ##echo "Line 445 , \$checkSG = $checkSG \n";
                // ##echo "var_dump\n";
                $objSG = new SURFACE_GRIND($this->ProcessName);
                //var_dump($objSG);
                //##echo "\n";
            }

            #####
            ## check if there is a RG Surface Grinding Process
            $checkRG = checkAnyRGProcess($this->ProcessName);
            if (!empty($checkRG)) {
                if ($checkRG == 'RG') {// SG process
                    ##echo "\$checkRG = $checkRG \n";
                } elseif ($checkRG == 'RGA') {
                    ##echo "\$checkRG = $checkRG \n";
                }

                $objRG = new RG($this->ProcessName);
            }
        }

        ##echo "\n#############ECHO OUT THE SURFACE PROCESS CODE######################\n";
        if (isset($objcutCode)) {
            $cutCode = $objcutCode->cutCode;
            if (!empty($cutCode)) {
                ##echo "cutCode = $cutCode \n";
                $this->cutCode = $cutCode;
            }
        }
        if (isset($objMill)) {
            $millFaces = $objMill->millFaces; // integer
            $this->millFaces = $millFaces;

            if (!empty($millFaces)) {
                ##echo "millFaces = $millFaces\n";
            }

            $millFaceCode = $objMill->millFaceCode;
            $Mill_SurfaceProcessSymbol = $objMill->Mill_SurfaceProcessSymbol;
            if (!empty($Mill_SurfaceProcessSymbol)) {
                $Mill_SurfaceProcessSymbol = $objMill->Mill_SurfaceProcessSymbol;
                ##echo "Mill_SurfaceProcessSymbol = $Mill_SurfaceProcessSymbol \n";
            }
        }

        if (!empty($millFaceCode)) {

            ##echo "millFaceCode = $millFaceCode \n";
            $this->millFaceCode = $millFaceCode;
        }

        if (isset($objMill)) {
            $Mill_SurfaceProcessCode = $objMill->Mill_SurfaceProcessCode;
            $this->Mill_SurfaceProcessCode = $Mill_SurfaceProcessCode;
            $this->Mill_SurfaceProcessSymbol = $Mill_SurfaceProcessSymbol;

            ##echo "Mill_SurfaceProcessCode  = $Mill_SurfaceProcessCode  \n";
            $this->ThickSizeMill = $objMill->ThickSizeMill;
            $this->WidthSizeMill = $objMill->WidthSizeMill;
            $this->LengthSizeMill = $objMill->LengthSizeMill;
        }
        //$this->SurfaceProcessSymbol = $SurfaceProcessSymbol;
//        if (!empty($SurfaceProcessSymbol)) {
//            ##echo "SurfaceProcessSymbol = $SurfaceProcessSymbol \n";
//            $this->SurfaceProcessSymbol = $SurfaceProcessSymbol;
//        }
        if (isset($objSG)) {
            $SGFaces = $objSG->SGFaces;
            $SGFaceCode = $objSG->SGFaceCode;
//        ##echo "SGFaceCode = $SGFaceCode \n";

            $SG_SurfaceProcessSymbol = $objSG->SG_SurfaceProcessSymbol;
            $this->SG_SurfaceProcessSymbol = $SG_SurfaceProcessSymbol;
            $SG_SurfaceProcessCode = $objSG->SG_SurfaceProcessCode;
            $this->SG_SurfaceProcessCode = $SG_SurfaceProcessCode;
        }
        if (!empty($SG_SurfaceProcessSymbol)) {
            ##echo "SG_SurfaceProcessSymbol = $SG_SurfaceProcessSymbol\n";
        }
        if (!empty($SG_SurfaceProcessCode)) {
            ##echo "SG_SurfaceProcessCode = $SG_SurfaceProcessCode\n";
        }
        if (!empty($SGFaceCode)) {
            ##echo "SGFaceCode = $SGFaceCode \n";
            $this->SGFaceCode = $SGFaceCode;
        }
        if (!empty($objSG)) {
            $this->ThickSizeSurfGrind = $objSG->ThickSizeSurfGrind;
            $this->WidthSizeSurfGrind = $objSG->WidthSizeSurfGrind;
            $this->LengthSizeSurfGrind = $objSG->LengthSizeSurfGrind;
            ##echo "in SG, \$this->ThickSizeSurfGrind = $this->ThickSizeSurfGrind\n";
            ##echo "in SG, \$this->WidthSizeSurfGrind = $this->WidthSizeSurfGrind\n";
            ##echo "in SG, \$this->LengthSizeSurfGrind = $this->LengthSizeSurfGrind\n";
        }
        if (isset($objRG)) {
            $RGFaces = $objRG->RGFaces;
            if (!empty($RGFaces)) {
                ##echo "RGFaces = $RGFaces\n";
            }
            $this->RGFaces = $RGFaces;
            $RGFaceCode = $objRG->RGFaceCode;
            if (!empty($RGFaceCode)) {
                $RGFaceCode = $objRG->RGFaceCode;
                $this->RGFaceCode = $RGFaceCode;
                ##echo "RGFaceCode = $RGFaceCode \n";
            }
            $RG_SurfaceProcessSymbol = $objRG->RG_SurfaceProcessSymbol;
            $this->RG_SurfaceProcessSymbol = $RG_SurfaceProcessSymbol;
            $RG_SurfaceProcessCode = $objRG->RG_SurfaceProcessCode;
            $this->RG_SurfaceProcessCode = $RG_SurfaceProcessCode;
        }
        if (!empty($RG_SurfaceProcessCode)) {
            ##echo "RG_SurfaceProcessCode = $RG_SurfaceProcessCode\n";
        }
        if (!empty($RG_SurfaceProcessSymbol)) {
            ##echo "RG_SurfaceProcessSymbol = $RG_SurfaceProcessSymbol\n";
        }
        if (!empty($objRG)) {
            $this->ThickSizeSurfGrind = $objRG->ThickSizeSurfGrind;
            $this->WidthSizeSurfGrind = $objRG->WidthSizeSurfGrind;
            $this->LengthSizeSurfGrind = $objRG->LengthSizeSurfGrind;
            ##echo "in RG, \$this->ThickSizeSurfGrind = $this->ThickSizeSurfGrind\n";
            ##echo "in RG, \$this->WidthSizeSurfGrind = $this->WidthSizeSurfGrind\n";
            ##echo "in RG, \$this->LengthSizeSurfGrind = $this->LengthSizeSurfGrind\n";
        }
//        $RDFaces = $objRG->ProcessSurface;
//        $this->ProcessSurface = $ProcessSurface;
////        if (!empty($ProcessSurface)) {
//        ##echo "\$ProcessSurface = $ProcessSurface\n";
//        }
    }
    Public function get_quantity(){
        return $this->quantity;
    }

}

Class CUTPROCESS {

    protected $cuttingType;
    public $cutCode;

    public function __construct($cuttingType) {
//        parent::__construct($jobcode);
        ##echo "enter Class CUTPROCESS to instantince cuttingtype . \n";
        $this->cuttingType = $cuttingType;

        switch ($cuttingType) {

            case CUTTINGTPYE::BANDSAW_CUT:
                $this->cutCode = CUTTINGTPYE::BANDSAW_CUT_CODE;

                break;
            case CUTTINGTPYE::MANUAL_CUT:
                $this->cutCode = CUTTINGTPYE::MANUAL_CUT_CODE;


                break;
            case CUTTINGTPYE::CNCFLAME_CUT:
                $this->cutCode = CUTTINGTPYE::CNCFLAME_CUT_CODE;


                break;

            default:
                $this->cutCode = "empty";

                break;
        }
        ##echo "\$this->cutCode = $this->cutCode \n";
    }

}

Class MILL extends PROCESS {

    protected $ProcessName;
    public $millFaceCode;
    public $TWSurfaces;
    public $TWASurfaces;
    public $WWSurfaces;
    public $WWASurfaces;
    public $LWSurfaces;
    public $LWASurfaces;
    public $Mill_SurfaceProcessSymbol;
    public $Mill_SurfaceProcessCode;
    public $millFaces;
    public $ThickSizeMill; //TW or TWA
    public $WidthSizeMill; //WW or WWA
    public $LengthSizeMill; //LW or LWA

//    public $ProcessSurface;

    public function __construct($processName) {
        #instanciante

        $this->TWSurfaces = 0;
        $this->TWASurfaces = 0;
        $this->WWSurfaces = 0;
        $this->WWASurfaces = 0;
        $this->LWSurfaces = 0;
        $this->LWASurfaces = 0;
        $this->ThickSizeMill = 0;
        $this->WidthSizeMill = 0;
        $this->LengthSizeMill = 0;
        $this->ProcessName = $processName;

        ##echo "\n#####################################################\n";
        ##echo "in Class MILL's constructor, instantiated ProcessName = $processName \n";

        ####
        # detect milling surfaces
        # 2 : top and bottom
        # 4 : front and rear + left and right
        # 6 : top and bottom + front and rear + left and right
        $millFaces = substr($processName, 0, 1); ## first character of $processName
        $millFaces = (int) $millFaces;
        $this->millFaces = $millFaces;

        ##echo "millFaces = $millFaces \n";
        $numberOfFace = numberToWords($millFaces);

        //##echo "\n\$numberOfFace = $numberOfFace \n ";
        #########
        # detect standard milling (W) or accuratge Mill (WA)
        $millAccurate = $millFaces = substr($processName, 1, 2); //Assume it is WA
        $millStandard = $millFaces = substr($processName, 1, 1); //Assume it is W

        if ($millAccurate == "WA") {

            ## This is sure case of Precision Milling (WA)
            ## SURFACE_PROCESSES detected
            $SurfaceProcess = $numberOfFace . "_WA";
        } elseif ($millAccurate != "WA" && $millStandard == "W") {// for which no "WA" detected but have detected "W"
            $SurfaceProcess = $numberOfFace . "_W";
        } else {
            #
            $SurfaceProcess = "empty";
        }
        ##echo "\$SurfaceProcess = $SurfaceProcess \n";

        ######
        # setup Mill SURFACE_PROCESSES Class
        $objName = new SURFACE_PROCESSES($SurfaceProcess);
        $millFaceCode = $objName->getFaceCode();
        $faces = $objName->getFaces();
        $this->ThickSizeMill = $objName->ThickSizeMill;
        $this->WidthSizeMill = $objName->WidthSizeMill;
        $this->LengthSizeMill = $objName->LengthSizeMill;
        $this->ProcessSurface = $faces;
        $Mill_SurfaceProcessSymbol = $objName->getSurfaceProcessSymbol();
        $Mill_SurfaceProcessCode = $objName->getSurfaceProcessCode();
#        $millFaceCode = SURFACE_PROCESSES::FOUR_WA
        $this->millFaceCode = $millFaceCode;
        $this->Mill_SurfaceProcessSymbol = $Mill_SurfaceProcessSymbol;
        $this->Mill_SurfaceProcessCode = $Mill_SurfaceProcessCode;
        ##echo "\$millFaceCode = $millFaceCode \n";
        ##echo "\$Mill_SurfaceProcessSymbol = $Mill_SurfaceProcessSymbol \n";
        ##echo "\$this->ProcessSurface = $this->ProcessSurface \n";
        ##echo "\$this->ThickSizeMill = $this->ThickSizeMill \n";
        ##echo "\$this->WidthSizeMill = $this->WidthSizeMill \n";
        ##echo "\$this->LengthSizeMill= $this->LengthSizeMill \n";

        ##echo "\n##################END OF INSTANTIATION IN MILL CLASS##########################\n";
    }

}

Class SURFACE_GRIND extends PROCESS {

    protected $ProcessName;
    protected $SGprocess;
    protected $SurfaceFormCode;
    public $SG_SurfaceProcessSymbol;
    public $SG_SurfaceProcessCode;
    public $SGFaceCode;
    public $SGFaces;

    public function __construct($processName) {
        $this->ProcessName = $processName;


        ## check and confirm SG process name
        ##echo "\n#####################################################\n";
        ##echo "in Class SURFACE_GRIND's constructor, instantiated ProcessName = $processName \n";
        ####
        # Detect surface griding surfaces
        # 2 : top and bottom
        # 4 : front and rear + left and right
        # 6 : top and bottom + front and rear + left and right
        $SGprocess = checkAnySGProcess($processName);
        $this->SGprocess = $SGprocess;
        ##echo "\$SGprocess = $SGprocess \n";
        ## check it is single surface of double surface for each SG process
        $SGFaces = checkFacesSG($processName);
        //##echo "\$SGFaces = $SGFaces \n";
        $numberOfFaces = numberToWords($SGFaces);
        //##echo "\$numberOfFaces = $numberOfFaces \n";
        ####
        # TRANSLATE TO capital letter numeric system
        $SurfaceProcess = $numberOfFaces . "_" . $SGprocess;
        ##echo "\$SurfaceProcess = $SurfaceProcess \n";
        ######
        # setup SG SURFACE_PROCESSES Class
        $objNameSG = new SURFACE_PROCESSES($SurfaceProcess);


        switch ($SGprocess) {
            case "SGA":
                $SGFaceCode = $objNameSG->getSGAFaceCode();

                break;
            case "SG":
                $SGFaceCode = $objNameSG->getSGFaceCode();

                break;
            default:
                $SGFaceCode = "Get nothing because \$SGprocess = $SGprocess, which  "
                        . " is not belong to SG or SGA \n";
                break;
        }
        $this->SGFaceCode = $SGFaceCode;

        ##echo "\$SGFaceCode = $SGFaceCode \n";

//        $millFaceCode = $objName->getFaceCode();
        $SG_SurfaceProcessSymbol = $objNameSG->getSurfaceProcessSymbol();
        $SG_SurfaceProcessCode = $objNameSG->getSurfaceProcessCode();
        $SGFaces = $objNameSG->getFaces();
        $this->SG_SurfaceProcessSymbol = $SG_SurfaceProcessSymbol;
        $this->SG_SurfaceProcessCode = $SG_SurfaceProcessCode;
        $this->SGFaces = $SGFaces;
        ##echo "\$SGFaceCode = $SGFaceCode \n";
        ##echo "in SG \$SG_SurfaceProcessSymbol = $SG_SurfaceProcessSymbol \n";
        ##echo "in SG \$SG_SurfaceProcessCode = $SG_SurfaceProcessCode \n";
        ##echo "in SG \$SGFaces = $SGFaces \n";
        $this->ThickSizeSurfGrind = $objNameSG->ThickSizeSurfGrind;
        $this->WidthSizeSurfGrind = $objNameSG->WidthSizeSurfGrind;
        $this->LengthSizeSurfGrind = $objNameSG->LengthSizeSurfGrind;
        ##echo "\$this->ThickSizeSurfGrind = $this->ThickSizeSurfGrind\n";
        ##echo "\$this->WidthSizeSurfGrind = $this->WidthSizeSurfGrind\n";
        ##echo "\$this->LengthSizeSurfGrind = $this->LengthSizeSurfGrind\n";

        ##echo "\n##################END OF INSTANTIATION IN SURFACE_GRIND CLASS##########################\n";
    }

}

Class RG extends PROCESS {

    protected $ProcessName;
    protected $RGprocess;
    protected $SurfaceFormCode;
    public $RG_SurfaceProcessSymbol;
    public $RG_SurfaceProcessCode;
    public $RGFaceCode;
    public $RGFaces;

    public function __construct($processName) {

        $this->ProcessName = $processName;
        ## check and confirm SG process name
        ##echo "\n#####################################################\n";
        ##echo "in Class RG_SURFACE_GRIND's constructor, instantiated ProcessName = $processName \n";
        ####
        # Detect RG surface griding surfaces
        # 2 : top and bottom
        # 4 : front and rear + left and right
        # 6 : top and bottom + front and rear + left and right
        $RGprocess = checkAnyRGProcess($processName);
        $this->RGprocess = $RGprocess;
        ##echo "\$RGprocess = $RGprocess \n";
        ## check it is single surface of double surface for each SG process
        $RGFaces = checkFacesRG($processName);
        #echo "\$RGFaces = $RGFaces \n";
        $this->RGFaces = $RGFaces;
        $numberOfFaces = numberToWords($RGFaces);
        #echo "\$numberOfFaces = $numberOfFaces \n";
        ####
        # TRANSLATE TO capital letter numeric system
        $SurfaceProcess = $numberOfFaces . "_" . $RGprocess;
        #echo "\$SurfaceProcess = $SurfaceProcess \n";
        ######
        ######
        # setup RG SURFACE_PROCESSES Class
//        $objName = new SURFACE_PROCESSES($SurfaceProcess);
//        $RGFaceCode = $objName->getRGFaceCode();
//        $this->RGFaceCode = $RGFaceCode;
//
//        #echo "\$SGFaceCode = $SGFaceCode \n";
//        #echo "\n##################END OF INSTANTIATION IN SURFACE_GRIND CLASS##########################\n";
        # setup RG SURFACE_PROCESSES Class
        $objName = new SURFACE_PROCESSES($SurfaceProcess);

        switch ($RGprocess) {
            case "RGA":
                $RGFaceCode = $objName->getRGAFaceCode();

                break;
            case "RG":
                $RGFaceCode = $objName->getRGFaceCode();

                break;
            default:
                $SGFaceCode = "Get nothing because \$RGprocess = $RGprocess, which  "
                        . " is not belong to RG or RGA \n";
                break;
        }
        if (isset($RGFaceCode)) {
            $this->RGFaceCode = $RGFaceCode;

            #echo "\$RGFaceCode = $RGFaceCode \n";
        }
        $RG_SurfaceProcessSymbol = $objName->getSurfaceProcessSymbol();
        $RG_SurfaceProcessCode = $objName->getSurfaceProcessCode();
        // $RGFaces = $objName->getFaces();

        $this->RG_SurfaceProcessSymbol = $RG_SurfaceProcessSymbol;
        $this->RG_SurfaceProcessCode = $RG_SurfaceProcessCode;
        //$this->RGFaces = $RGFaces;
        #echo "in RG \$RG_SurfaceProcessSymbol = $RG_SurfaceProcessSymbol \n";
        #echo "in RG \$RG_SurfaceProcessCode = $RG_SurfaceProcessCode \n";
        #echo "in RG \$RGFaces = $RGFaces \n";
        #echo "in RG \$this->RGFaces = $this->RGFaces \n";
        $this->ThickSizeSurfGrind = $objName->ThickSizeSurfGrind;
        $this->WidthSizeSurfGrind = $objName->WidthSizeSurfGrind;
        $this->LengthSizeSurfGrind = $objName->LengthSizeSurfGrind;
        #echo "\$this->ThickSizeSurfGrind = $this->ThickSizeSurfGrind\n";
        #echo "\$this->WidthSizeSurfGrind = $this->WidthSizeSurfGrind\n";
        #echo "\$this->LengthSizeSurfGrind = $this->LengthSizeSurfGrind\n";

        #echo "\n##################END OF INSTANTIATION IN RG CLASS##########################\n";
    }

}

Class MACHINES {

    protected $mcid;
    protected $machineid;
    protected $name;
    protected $model;
    protected $capacity_per_hour; // (data table column is "index_per_hour"
    protected $operation_process_code;

}

Class MILL_MACHINES extends MACHINES {

}

?>