<?php

include_once('../../class/dbh.inc.php');
include_once('../../class/variables.inc.php');
include_once('../../class/joblistwork.inc.php');
include_once('../../class/phhdate.inc.php');

$received_data = json_decode(file_get_contents("php://input"));

$data_output = array();
$action = $received_data->action;

$mattab = 'material2020'; //The new material table
//$mattab = 'material';

switch ($action) {
    case 'validation_materialname':
        $matname = $received_data->matname;
        $qr = "SELECT COUNT(*) FROM $mattab WHERE material = '$matname'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getRowCount();
        if ($result != 0) {
            $status = 'error';
            $msg = 'Material name already exists!';
        } else {
            $status = 'ok';
            $msg = 'Material name available!';
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
        break;
    case 'validation_materialacc':
        $matacc = $received_data->matacc;
        $qr = "SELECT COUNT(*) FROM $mattab WHERE material_acc = '$matacc'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getRowCount();
        if ($result != 0) {
            $status = 'error';
            $msg = 'Material Account already exists!';
        } else {
            $status = 'ok';
            $msg = 'Material Account available!';
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
        break;
    case 'validation_materialcode':
        $matcode = $received_data->matcode;
        $qr = "SELECT COUNT(*) FROM $mattab WHERE materialcode = '$matcode'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getRowCount();
        if ($result != 0) {
            $status = 'error';
            $msg = 'Material Code already exists!';
        } else {
            $status = 'ok';
            $msg = 'Material Code available!';
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
        break;
    case 'get_submitMaterial':
        $addmat_array = json_decode(json_encode($received_data->addmat), true);
        #print_r($addmat_array);
        #var_dump($addmat_array);
        $qrins = "INSERT INTO $mattab SET ";
        $qrins2 = "INSERT INTO $mattab SET <br>";
        $arrcount = count($addmat_array);
        $cnt = 0;
        foreach ($addmat_array as $key => $val) {
            $cnt ++;
            $qrins .= " $key =:$key ";
            $qrins2 .= " $key = '$val' ";
            if ($arrcount != $cnt) {
                $qrins .= " , ";
                $qrins2 .= " , <br>";
            }
        }
        #echo "$qrins2";
        $objSQLsubmit = new SQLBINDPARAM($qrins, $addmat_array);
        $InsResult = $objSQLsubmit->InsertData2();
        if ($InsResult == 'insert ok!') {
            $status = 'ok';
            $msg = 'Created new Material ['.$addmat_array['material'].']';
            $qrSel = "SELECT * FROM $mattab ORDER BY mid DESC LIMIT 0,1";
            $objSQLsel = new SQL($qrSel);
            $result = $objSQLsel->getResultOneRowArray();
            if (!empty($result)) {
                $detail = $result;
            }
            $out_arr = array('status' => $status, 'msg' => $msg, 'detail' => $detail);
        } else {
            $status = 'error';
            $msg = 'Failed to insert into database<br>Please Check this :';
            $detail = $qrins2;
            $out_arr = array('status' => $status, 'msg' => $msg, 'detail' => $detail);
        }
        echo json_encode($out_arr);
        break;
}