<?php

#include_once ('../includes/phhdate.inc.php');

Class JOBWORKDETAIL {

    Protected $jobcode; //Class scope $jobcode
    #Protected $cuttingtype; //Class scope $cuttingtype
    Protected $totalquantity; //Class scope $totalquantity
    #Protected $processcode; //Class scope $processcode
    protected $cncmachining; // boolean value
    protected $manual; // boolean value
    protected $bandsaw; // boolean value
    protected $milling; // boolean value
    protected $millingwidth; // boolean value
    protected $millinglength; // boolean value
    protected $roughgrinding; // boolean value
    protected $precisiongrinding; // boolean value    
    Protected $jobtype; // actually this is cuttingtype
    Protected $millingarray;
    Protected $grindingtype;
    Protected $ArrJobWork;
    Protected $ExJobWork;
    Protected $jobOutputList; //Class scope $jobOutputList
    public $jlwsid;
    protected $objProcess;

    #private $rundb;

    Public function __construct($jobcode, $jobOutputList = null) {
        #$this->rundb = $rundb;
        ##################Initialization of key scope variables that act as starting varaibles (input) #########
        // Input parameter $jobcode, $cuttingtype, $processcode, $totalquantity, $jobOutputList set to scope variables
        if (strlen($jobcode) == 24 || strlen($jobcode) == 28) {
            $jobcode = substr($jobcode, 0, strlen($jobcode) - 4);
        }
        $this->jobcode = $jobcode; //Class scope $jobcode Line 7 
        #$this->cuttingtype = $cuttingtype; //Class scope $cuttingtype Line 8 
        #$this->processcode = $processcode; //Class scope $processcode Line 10 
        #echo "processcode = $processcode";
        $this->jobOutputList = $jobOutputList;
        $this->objProcess = new PROCESS($jobcode);
        $this->totalquantity = $this->objProcess->get_quantity();
        ####################### End of  Initialization #########################################################
        //check if there's existing jobwork_detail on database for this jobcode
        $ExJobWork = $this->check_existing_jobworkstatus($jobcode);
        if ($ExJobWork == 'empty') {//if there's no data yet
            $jobtype = $this->get_cutting_type();
            $this->set_jobtype($jobtype);
            $milling_array = $this->get_milling_array();
            $this->set_millingarray($milling_array);
            $grindingtype = $this->get_grinding_code();
            $this->set_grindingtype($grindingtype);
            //insert this data into database
            $this->insert_jobwork_details($jobcode, $jobtype, $milling_array, $grindingtype);
            $this->set_ExJobWork($this->check_existing_jobworkstatus($jobcode));
        } else { //if there's already data in database for this jobcode
            $this->set_ExJobWork($ExJobWork);
            $this->parse_existing_jobwork($ExJobWork);
            $jobtype = $this->get_jobtype();
            $milling_array = $this->get_millingarray();
            $grindingtype = $this->get_grindingtype();
        }

        // put code to check data in joblistwork_detail
        //end code to check
        if ($jobOutputList != null) {
            $ArrJobWork = $this->get_work_detail($jobtype, $milling_array, $grindingtype);
            $this->set_ArrJobWork($ArrJobWork);
        }
        #echo "jobtype = ";
        #print_r($jobtype);
        #echo "<br>\n";
        #echo "milling_array : ";
        #print_r($milling_array);
        #echo "<br>\n";
        #echo "grindingtype = $grindingtype<br>\n";
        #echo "JobWork Results :<br>\n";
        #print_r($ArrJobWork);
        #echo "<br>\n";
    }

    Protected function parse_existing_jobwork($ExJobWork) {
        $jobtype = array();
        $milling_array = array();
        $grindingtype = 'none';
        foreach ($ExJobWork as $key => $data) {
            if ($data == 'true') {
                switch ($key) {
                    case 'manual':
                        $jobtype[] = $key;
                        break;
                    case 'bandsaw':
                        $jobtype[] = $key;
                        break;
                    case 'cncmachining':
                        $jobtype[] = $key;
                        break;
                    case 'milling':
                        $milling_array[] = array($key => 'Milling Thickness');
                        break;
                    case 'millingwidth':
                        $milling_array[] = array($key => 'Milling Width');
                        break;
                    case 'millinglength':
                        $milling_array[] = array($key => 'Milling Length');
                        break;
                    case 'roughgrinding':
                        $grindingtype = $key;
                        break;
                    case 'precisiongrinding':
                        $grindingtype = $key;
                        break;
                }
            }
        }
        $this->set_jobtype($jobtype);
        $this->set_millingarray($milling_array);
        $this->set_grindingtype($grindingtype);
    }

    Protected function insert_jobwork_details($jobcode, $jobtype, $milling_array, $grindingtype) {
//parse each data into one array to insert
        $insertArray = array();
        $insertArray['jobcode'] = strtoupper(trim($jobcode));
        $updateArray = array();
        if (!empty($jobtype)) {
            foreach ($jobtype as $data) {
                $insertArray[$data] = 'true';
                $updateArray[$data] = 'true';
            }
        }
        if (!empty($milling_array)) {
            foreach ($milling_array as $data_row) {
                foreach ($data_row as $key => $val) {
                    $insertArray[$key] = 'true';
                    $updateArray[$key] = 'true';
                }
            }
        }
        if ($grindingtype != 'none') {
            $insertArray[$grindingtype] = 'true';
            $updateArray[$grindingtype] = 'true';
        }
        #echo "insert Array = ";
        #print_r($insertArray);
        $jlwsid = $this->get_jlwsid();
        if (!$jlwsid) {
            $table = "joblist_work_status";
            $cnt = 0;
            $sqlInsert = "INSERT INTO $table SET ";
            $cntArr = count($insertArray);
            foreach ($insertArray as $key => $value) {
                $cnt++;
                $sqlInsert .= $key . "=:$key";     //--> adds the key as parameter
                if ($cnt != $cntArr) {
                    $sqlInsert .= ", ";      //--> if not final key, writes comma to separate between indexes
                }
            }
            #echo "\$sqlInsert = $sqlInsert <br>";
            $objInsert = new SQLBINDPARAM($sqlInsert, $insertArray);
            $result = $objInsert->InsertData2();
        } else {
            $table = "joblist_work_status";
            $cnt = 0;
            $sqlupdate = "UPDATE $table SET ";
            $cntArr = count($updateArray);
            foreach ($updateArray as $key => $value) {
                $cnt++;
                $sqlupdate .= $key . "=:$key";     //--> adds the key as parameter
                if ($cnt != $cntArr) {
                    $sqlupdate .= ", ";      //--> if not final key, writes comma to separate between indexes
                }
            }
            $sqlupdate .= " WHERE jlwsid = $jlwsid";
            #echo "\$sqlupdate = $sqlupdate <br>";
            $objupdate = new SQLBINDPARAM($sqlupdate, $updateArray);
            $result = $objupdate->UpdateData2();
        }
        #echo "$result <br>";
        return $result;
    }

    Protected function check_existing_jobworkstatus($jobcode) {
        $jobcode = strtoupper(trim($jobcode));
        $qr = "SELECT * FROM joblist_work_status WHERE jobcode = '$jobcode'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        #echo "qr = $qr<br>\n";
        #echo "result = <br>";
        #var_dump($result);
        if (!empty($result)) {
            $this->set_jlwsid($result['jlwsid']);
            $trueCount = 0;
            foreach ($result as $key => $val) {
                if ($key != 'jlwsid' || $key != 'jobcode') {
                    if ($val == 'true') {
                        $trueCount++;
                    }
                }
            }
            if ($trueCount == 0) {
                return 'empty';
            } else {
                return $result;
            }
            #$this->jlwsid = $result['jlwsid']; //instantiate  Scope public variables $jlwid;
        } else {
            return 'empty';
        }
    }

    Public function check_job_work_status($ArrJobWork) { //Call this function from outside of class
        # echo "currently checked : {$this->get_jobcode()}<br>\n";
        foreach ($ArrJobWork as $data_row) {
            $key = $data_row['process'];
            $val = $data_row['status'];
            #echo "key = $key;   val = $val;<br>\n";
            switch ($key) {
                /* //removed jobtake detection
                  case 'Job Take':
                  if ($val != 'Taken') {
                  #echo "not yet taken<br>\n";
                  $info = 'Not Taken Yet';
                  return $info;
                  }
                  break;
                 * 
                 */
                default:
#echo "case is not jobtake<br>\n";
                    if ($val == 'Partial') {
#echo "case is partial<br>\n";
                        $info = 'Quantity Partial Finish';
                    } elseif ($val != 'Finished') {
#echo "case is not finished<br>\n";
                        $info = 'Not End Yet';
                    } elseif ($val == 'Finished') {
#echo "case is finished<br>\n";
                        $info = 'Finished';
                    } elseif ($val == 'Too-Many') {
                        $info = 'Quantity Exceeds Total Quantity';
                    }
                    return $info;
                    break;
            }
        }
    }

    Protected function get_work_detail($arr_jobtype, $milling_array, $grindingtype) {
        $jobWorkArray = array();
        $totalquantity = $this->get_totalquantity();
        $jobcode = $this->get_jobcode();
        #if ($jobcode == 'CJ VLT 2011 1216 02') {
        #    print_r($arr_jobtype);
        #    print_r($milling_array);
        #    print_r($grindingtype);
        #}
#echo "total quantity = $totalquantity<br>\n";
#echo "in get_work_detail\n---milling array\n";
#print_r($milling_array);
#echo"\n in get_work_detail\n---arr_jobtype\n";
#print_r($arr_jobtype);
        /* / removed jobtake checker
          $chk_jobtake = $this->search_in_output('jobtake');
          if ($chk_jobtake != 'empty') { //if job_take exists
          if ($chk_jobtake['date_end'] == ('' || null)) {//if not yet ended
          $jobWorkArray[] = array('process' => 'Job Take', 'status' => 'Taken');
          } else { //if ended
          $jobWorkArray[] = array('process' => 'Job Take', 'status' => 'Taken');
          }
          } else {//if Job Take don't exists
          $jobWorkArray[] = array('process' => 'Job Take', 'status' => 'Not Yet Taken');
          }
          /* */
        if (!empty($arr_jobtype)) {
            $top_qty_check = $this->get_total_quantity_done($arr_jobtype[0]);
            foreach ($arr_jobtype as $jobtype) {
#echo "jobtypedata = $jobtype_data";
                $outputData = $this->search_in_output($jobtype);
                $qty_done_data = $this->get_total_quantity_done($jobtype);
                $cutting = ucwords($jobtype);
                if ($outputData != 'empty') { //if data is found
#echo "outputData = \n";
#print_r($outputData['date_end']);
                    if ($outputData['date_end'] == ('' || null)) { //if not yet ended
                        $jobWorkArray[] = array('process' => $cutting, 'status' => 'On-Progress');
                    } else { //if ended
                        if ($totalquantity != $qty_done_data) {
                            if ($totalquantity < $qty_done_data) {
                                $jobWorkArray[] = array('process' => $cutting, 'status' => 'Too-Many');
                            } else {
                                if ($qty_done_data < $top_qty_check) {
                                    $jobWorkArray[] = array('process' => $cutting, 'status' => 'Partial-In-Session');
                                } else {
                                    $jobWorkArray[] = array('process' => $cutting, 'status' => 'Partial');
                                }
                            }
                        } else {
                            $jobWorkArray[] = array('process' => $cutting, 'status' => 'Finished');
                        }
                    }
                } else {//If there's no data
                    $jobWorkArray[] = array('process' => $cutting, 'status' => 'Not Started');
                }
            }
        }
        /* This is old jobtype checker
          if ($jobtype != 'none') { //get the value for cuttingtype
          $outputData = $this->search_in_output($jobtype);
          $qty_done_data = $this->get_total_quantity_done($jobtype);
          $cutting = ucwords($jobtype);
          if ($outputData != 'empty') { //if data is found
          #echo "outputData = \n";
          #print_r($outputData['date_end']);
          if ($outputData['date_end'] == ('' || null)) { //if not yet ended
          $jobWorkArray[] = array('process' => $cutting, 'status' => 'On-Progress');
          } else { //if ended
          if ($totalquantity != $qty_done_data) {
          $jobWorkArray[] = array('process' => $cutting, 'status' => 'Partial');
          } else {
          $jobWorkArray[] = array('process' => $cutting, 'status' => 'Finished');
          }
          }
          } else {//If there's no data
          $jobWorkArray[] = array('process' => $cutting, 'status' => 'Not Started');
          }
          }
         */
        if (!empty($milling_array)) { //loop in milling type
            if (!isset($top_qty_check)) {
                foreach ($milling_array[0] as $key => $val) {
                    $top_qty_check = $this->get_total_quantity_done($key);
                    break;
                }
            }
#echo "milling array is not empty\n";
            foreach ($milling_array as $data_row) { // get the value for millingtype
                foreach ($data_row as $key => $val) {
#echo $millingKey."\n";
                    $outputMilling = $this->search_in_output($key);
                    $qty_done_milling = $this->get_total_quantity_done($key);
                    $millingKey = ucwords($key);
                    if ($outputMilling != 'empty') {//if there's milling data
                        if ($outputMilling['date_end'] == ('' || null)) { //if not yet ended
                            $jobWorkArray[] = array('process' => $millingKey, 'status' => 'On-Progress');
                        } else { //if ended
                            if ($totalquantity != $qty_done_milling) {
                                if ($totalquantity < $qty_done_milling) {
                                    $jobWorkArray[] = array('process' => $millingKey, 'status' => 'Too-Many');
                                } else {

                                    if ($qty_done_milling < $top_qty_check) {
                                        $jobWorkArray[] = array('process' => $millingKey, 'status' => 'Partial-In-Session');
                                    } else {
                                        $jobWorkArray[] = array('process' => $millingKey, 'status' => 'Partial');
                                    }
                                }
                            } else {
                                $jobWorkArray[] = array('process' => $millingKey, 'status' => 'Finished');
                            }
                        }
                    } else {//if no milling data
                        $jobWorkArray[] = array('process' => $millingKey, 'status' => 'Not Started');
                    }
                }
            }
        } else {
#echo "milling array is empty\n";
        }

        if ($grindingtype != 'none') { //get the value for cuttingtype
            $outputGrinding = $this->search_in_output($grindingtype);
            $qty_done_grinding = $this->get_total_quantity_done($grindingtype);
            $grinding = ucwords($grindingtype);
            if ($outputGrinding != 'empty') { //if data is found
                if ($outputGrinding['date_end'] == ('' || null)) { //if not yet ended
                    $jobWorkArray[] = array('process' => $grinding, 'status' => 'On-Progress');
                } else { //if ended
                    if ($totalquantity != $qty_done_grinding) {
                        if ($totalquantity < $qty_done_grinding) {
                            $jobWorkArray[] = array('process' => $grinding, 'status' => 'Too-Many');
                        } else {
                            if ($qty_done_grinding < $top_qty_check) {
                                $jobWorkArray[] = array('process' => $grindingtype, 'status' => 'Partial-In-Session');
                            } else {
                                $jobWorkArray[] = array('process' => $grinding, 'status' => 'Partial');
                            }
                        }
                    } else {
                        $jobWorkArray[] = array('process' => $grinding, 'status' => 'Finished');
                    }
                }
            } else {//If there's no data
                $jobWorkArray[] = array('process' => $grinding, 'status' => 'Not Started');
            }
        }

        return $jobWorkArray;
    }

    Protected function get_total_quantity_done($jobtype) {
        $jobOutputList = $this->get_jobOutputList();
        $qty_sum = 0;
        if ($jobOutputList != 'empty') {
            foreach ($jobOutputList as $output_data) {
                if ($output_data['jobtype'] == $jobtype) {
                    $qty_sum += (int) $output_data['quantity'];
                }
            }
        } else {
            return 'empty';
        }
#echo "qty sum = $qty_sum<br>\n";
        return $qty_sum;
    }

    Protected function search_in_output($jobtype) {
        $jobOutputList = $this->get_jobOutputList();
#echo "jobtype here :".$jobOutputList['jobtype']."<br>\n";
        if ($jobOutputList != 'empty') {
#echo "joboutput is not empty<br>\n";
#echo "searching $jobtype in job outputlist:<br>\n";
#print_r($jobOutputList);
#echo"<br>";
            $result = array_filter($jobOutputList, function($var) use ($jobtype) {
#echo "try searching $jobtype....<br>\n";
#echo "jobtype = ".$var['jobtype']."<br>\n";
                return ($var['jobtype'] == trim($jobtype));
            });
            if (!empty($result)) {
#echo "onsearch---\n";
#print_r($result);
                foreach ($result as $data_row) {
                    return $data_row;
                    break;
                }
#return $result[];
            } else {
#echo "cannot find $jobtype\n";
                return 'empty';
            }
        } else {
            return 'empty';
        }
    }

    Protected function get_milling_array() {
        #echo "====on function get_milling_array()====\n";
        $objProcess = $this->objProcess;
        $millFaceCode = $objProcess->millFaceCode;
        $Mill_SurfaceProcessCode = $objProcess->Mill_SurfaceProcessCode;
        $Mill_SurfaceProcessSymbol = $objProcess->Mill_SurfaceProcessSymbol;
        if (!empty($millFaceCode)) {
            #echo "\$millFaceCode = $millFaceCode \n";
        }
        if (!empty($Mill_SurfaceProcessCode)) {
            #echo "\$Mill_SurfaceProcessCode = $Mill_SurfaceProcessCode \n";
        }
        if (!empty($Mill_SurfaceProcessSymbol)) {
            #echo "\$Mill_SurfaceProcessSymbol = $Mill_SurfaceProcessSymbol\n";
        }
        $ThickSizeMill = (int) $objProcess->ThickSizeMill;
        $WidthSizeMill = (int) $objProcess->WidthSizeMill;
        $LengthSizeMill = (int) $objProcess->LengthSizeMill;
        #echo "\$ThickSizeMill = $ThickSizeMill<br>";
        #echo "\$WidthSizeMill = $WidthSizeMill<br>";
        #echo "\$LengthSizeMill = $LengthSizeMill<br>";
        $millingarray = array();
        if ($ThickSizeMill > 0) {
            $millingarray[] = array('milling' => 'Milling Thickness');
        }
        if ($WidthSizeMill > 0) {
            $millingarray[] = array('millingwidth' => 'Milling Width');
        }
        if ($LengthSizeMill > 0) {
            $millingarray[] = array('millinglength' => 'Milling Length');
        }
        #echo "===================================\n";

        return $millingarray;
    }

    Protected function get_grinding_code() {
        $objProcess = $this->objProcess;
        $SG_SurfaceProcessCode = $objProcess->SG_SurfaceProcessCode;
        if (!empty($SG_SurfaceProcessCode)) {
            #echo "\$SG_SurfaceProcessCode = $SG_SurfaceProcessCode <br>";
            $grindingprocess = 'precisiongrinding';
        }
        $RG_SurfaceProcessCode = $objProcess->RG_SurfaceProcessCode;
        if (!empty($RG_SurfaceProcessCode)) {
            #echo "\$RG_SurfaceProcessCode = $RG_SurfaceProcessCode <br>";
            $grindingprocess = 'roughgrinding';
        }

        $ThickSizeSurfGrind = (int) $objProcess->ThickSizeSurfGrind;
        $WidthSizeSurfGrind = (int) $objProcess->WidthSizeSurfGrind;
        $LengthSizeSurfGrind = (int) $objProcess->LengthSizeSurfGrind;

        if ($ThickSizeSurfGrind != 0 || $WidthSizeSurfGrind != 0 || $LengthSizeSurfGrind != 0) {
            return $grindingprocess;
        } else {
            return 'none';
        }
    }

    Protected function get_cutting_type() {
        $objProcess = $this->objProcess;
        $jobtype_arr = array();

        $cutCode = $objProcess->cutCode;
        $cuttingType = $objProcess->cuttingType;
        #echo "\$cuttingType = $cuttingType , \$cutCode = $cutCode<br>";
        switch ($cutCode) {
            case 'C':
                $cuttingcode = 'cncmachining';
                break;
            case 'M':
                $cuttingcode = 'manual';
                break;
            case 'B':
                $cuttingcode = 'bandsaw';
                break;
            default:
                $cuttingType = 'none';
                break;
        }

        if ($cuttingcode != 'none') {
            $jobtype_arr[] = $cuttingcode;
            return $jobtype_arr;
        }

#return $cuttingcode;
    }

    //getter and setter area

    Public function get_ArrJobWork() { //this can be called from outside of class
        return $this->ArrJobWork;
    }

    Protected function set_ArrJobWork($input) {
        $this->ArrJobWork = $input;
    }

    Public function get_ExJobWork() { //this can be called from outside of class
        return $this->ExJobWork;
    }

    Protected function set_ExJobWork($input) {
        $this->ExJobWork = $input;
    }

    Protected function get_jobcode() {
        return $this->jobcode;
    }

    Protected function set_jobcode($input) {
        $this->jobcode = $input;
    }

    Protected function get_cuttingtype() {
        return $this->cuttingtype;
    }

    Protected function set_cuttingtype($input) {
        $this->cuttingtype = $input;
    }

    Protected function get_totalquantity() {
        return $this->totalquantity;
    }

    Protected function set_totalquantity($input) {
        $this->totalquantity = $input;
    }

    Protected function get_processcode() {
        return $this->processcode;
    }

    Protected function set_processcode($input) {
        $this->processcode = $input;
    }

    Protected function get_jobtype() {
        return $this->jobtype;
    }

    Protected function set_jobtype($input) {
        $this->jobtype = $input;
    }

    Protected function get_millingarray() {
        return $this->millingarray;
    }

    Protected function set_millingarray($input) {
        $this->millingarray = $input;
    }

    Protected function get_grindingtype() {
        return $this->grindingtype;
    }

    Protected function set_grindingtype($input) {
        $this->grindingtype = $input;
    }

    Protected function get_jobOutputList() {
        return $this->jobOutputList;
    }

    Protected function set_jobOutputList($input) {
        $this->jobOutputList = $input;
    }

    Public function get_jlwsid() {
        return $this->jlwsid;
    }

    Protected function set_jlwsid($input) {
        $this->jlwsid = $input;
    }

}

Class JOBWORK2 {

    Protected $jcodeid;
    Protected $jobcode;
    Protected $sid = null;
    Protected $period = null;
    Protected $jlwsid = null;
    Protected $oid = null;
    Protected $status;

    //later put properties here
    Public function __construct($jobcode, $oid) {
        #$objPeriod = new Period();
        #if (strlen($jobcode) == 24 || strlen($jobcode) == 28) { //old jobcode, has 4 digits period at the last
        #    $period = substr(trim($jobcode),-4);
        #    $jobcode = substr($jobcode,0,strlen($jobcode)-4);
        #} else { //new jobcode, omitted the last4 digits, the period MUST BE RUNNING PERIOD
        #    $period = $objPeriod->getcurrentPeriod();
        #}
        #$this->period = $period; //initialize scope variable $period at line 549
        $this->jobcode = $jobcode; // initialize scope variable $jobcode 
        $this->oid = $oid; // initialize scope variable $oid
        #####################################################
        // use sql query from table jobcodesid check if any records are match the input parameters $jobcode
        // from this match get the $sid, $period, $jcodeid, and $jlwsid, then initialize scope variable
        // if not found any records match check table 
        // see any match of $jobcode->[$runningno, $period, $jobno] in this table produciton_scheduling_period
        // if found, initialize $sid, $period, and insert $sid, $period, $jcodeid, and $jlwsid into table jobcodesi
        # as new found record
        // if not found any $jobcode->[$runningno, $period, $jobno] match  in table produciton_scheduling_period
        // then this is a wrong information in input, because production_scheduling_period no record, then orderlist also no report
        #####################################################
        //Check if jobcode exists in jobcodesid table
        $check_jobcodesid = $this->check_existing_jobcodesid();
        if ($check_jobcodesid == 'empty') {
            # echo "There's no data\n";
            //There's no data yet in jobcodesid, creating a new data
            //Begin fetching data using JOB_WORK_DETAIL 
            $checkResult = $this->check_existing_joblist_work_status();
            if ($checkResult == 'empty') {
                //There's something wrong in joblistworkstatus generation
                //This is because there's no data for the jobcode in the current period.
                //
                #
                ##exit("There's something wrong in joblist_work_status generation<br>"
                #. "Please contact Administrator regarding this.<br>");
            } else {
                //done creating jlworkstatus data,
                //begin create jobcodesid data
                $crt_result = $this->create_jobcodesid();
                if ($crt_result != 'ok') {
                    echo "$crt_result";
                } else {
                    $check_jobcodesid = $this->check_existing_jobcodesid();
                }
            }
        }
        #} else {
        #echo "there's data\n";
        $this->sid = $check_jobcodesid['sid'];
        $this->period = $check_jobcodesid['period'];
        $this->jlwsid = $check_jobcodesid['jlwsid'];
        $this->jcodeid = $check_jobcodesid['jcodeid'];
        $schDetail = $this->get_SchedulingDetails($this->period, $this->jobcode);
        #}
    }

    Public function get_sid() {
        return $this->sid;
    }

    Public function get_period() {
        return $this->period;
    }

    Public function get_jcodeid() {
        return $this->jcodeid;
    }

    Public function call_test_output() {
        echo "Sid = " . $this->sid . "<br>";
        echo "Period = " . $this->period . "<br>";
        echo "JLWSID = " . $this->jlwsid . "<br>";
    }

    Protected function check_existing_jobcodesid() {
        $jobcode = strtoupper(trim($this->jobcode));
        $qr = "SELECT * FROM jobcodesid WHERE jobcode = '$jobcode'";
        #echo "qr = $qr\n";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        #print_r($result);
        if (!empty($result)) {
            return $result;
        } else {
            return 'empty';
        }
    }

    Protected function create_jobcodesid() {
        $period = $this->period;
        $jobcode = strtoupper(trim($this->jobcode));
        $sid = $this->sid;
        $oid = $this->oid;
        $jlwsid = $this->jlwsid;
        $ins_array = array('jobcode' => $jobcode, 'sid' => $sid, 'oid' => $oid, 'period' => $period, 'jlwsid' => $jlwsid);
        $cntarr = count($ins_array);
        $cnt = 0;
        $qr = "INSERT INTO jobcodesid SET ";
        foreach ($ins_array as $key => $val) {
            $cnt++;
            $qr .= "$key = :$key ";
            if ($cnt != $cntarr) {
                $qr .= " , ";
            }
        }
        $objSQL = new SQLBINDPARAM($qr, $ins_array);
        $ins_result = $objSQL->InsertData2();
        if ($ins_result == 'insert ok!') {
            return 'ok';
        } else {
            return "Failed to insert these data:<br>"
                    . "Jobcode = $jobcode<br>"
                    . "SID = $sid<br>"
                    . "period = $period<br>"
                    . "jlwsid = $jlwsid<br>"
                    . "Please contact administrator regarding this thing.<br>";
        }
    }

    Protected function check_existing_joblist_work_status() {
        $jobcode = $this->jobcode;
        $objPeriod = new Period();
        $thisPeriod = $objPeriod->getcurrentPeriod();
        $lastPeriod = $objPeriod->getlastPeriod();
        $schDetail = $this->get_schedulingDetails($jobcode, $thisPeriod);
        if ($schDetail == 'empty') {
            $schDetail = $this->get_schedulingDetails($jobcode, $lastPeriod);
            if ($schDetail == 'empty') {
                return 'empty';
            } else {
                $this->period = $lastPeriod;
                $result = $schDetail;
            }
        } else {
            $this->period = $thisPeriod;
            $result = $schDetail;
        }

        if (!empty($result)) {
            //create a new object of Job Work Detail
            $objJW = new JOBWORKDETAIL($jobcode);
            //Fetch existing Jobwork array
            $ExJobWork_status = $objJW->get_ExJobWork();
            if ($ExJobWork_status != 'empty') {
                $this->jlwsid = $objJW->get_jlwsid();
            } else {
                return 'empty';
            }
            $this->sid = $result['sid'];
            //all data has been carried to scope variables
        } else {
            return 'empty';
        }
    }

    Protected function get_SchedulingDetails($jobcode, $period) {
        $table = "production_scheduling_$period";
        //begin parse jobcode
        $jlfor = substr($jobcode, 0, 2);
        $company_code = substr($jobcode, 3, 3);
        $issue_period = substr($jobcode, 7, 4);
        $runningno = (int) substr($jobcode, 12, 4);
        $jobno = (int) substr($jobcode, 17, 2);
        #echo "parseJobCode length = " . strlen($parseJobCode) . "\n";
        //begin fetch data from scheduling
        $qr = "SELECT * FROM $table "
                . "WHERE jlfor = '$jlfor' "
                . "AND quono LIKE '$company_code%' "
                . "AND runningno LIKE '$runningno' "
                #. "AND jobno LIKE '$jobno' ";
                . "AND noposition = '$jobno' ";
        #. "AND status = 'active'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            $status = $result['status'];
            if ($status != 'active') {
                throw new Exception('This joblist is ' . $status . '!');
                #return $status;
            } else {
                return $result;
            }
        } else {
            return 'empty';
        }
    }

}

?>