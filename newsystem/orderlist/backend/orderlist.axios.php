<?php

include_once '../../class/dbh.inc.php';
include_once '../../class/variables.inc.php';
include_once '../../class/customers.inc.php';
include_once '../../class/quotation.inc.php';
include_once '../../class/orderlist.inc.php';
include_once '../../class/operation.inc.php';
include_once '../../class/phhdate.inc.php';
include_once '../../class/IdGenerate.class.php';


include_once '../../class/dimension-price.inc.php';
include_once '../../class/abstract_workpcsnew.inc.php';
include_once '../../class/density.inc.php';
include_once '../../calculation/pmach.inc.php';

include_once 'orderlist.func.inc.php'; //list of functions for orderlist backend
include_once '../../class/ordercontrolcenter.inc.php';


$com_sml = COMMONNAME_PST::COMPANY_SMLETTER;
$com_cap = COMMONNAME_PST::COMPANY_CAPLETTER;
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
$action = $received_data->action;

switch ($action) {
    case 'getPeriod':
        $objDate = new DateNow();
        $currentPeriod_int = $objDate->intPeriod();
        $currentPeriod_str = $objDate->strPeriod();

        $EndYYYYmm = 2001;
        $objPeriod = new generatePeriod($currentPeriod_int, $EndYYYYmm);
        $setofPeriod = $objPeriod->generatePeriod3();

        echo json_encode($setofPeriod);
        break;
    case 'getPeriodExtended':
        $objDate = new DateNow();
        $currentPeriod_int = $objDate->intPeriod();
        $currentPeriod_str = $objDate->strPeriod();
        $objPrd = new Period();
        $nextPeriod = $objPrd->getNextPeriod();

        $EndYYYYmm = 2001;
        $objPeriod = new generatePeriod($nextPeriod, $EndYYYYmm);
        $setofPeriod = $objPeriod->generatePeriod3();

        echo json_encode($setofPeriod);
        break;
    case 'getCustomer':
        $qrCC = "SELECT * FROM customer_pst WHERE company='PST'"
                . " AND status NOT LIKE 'deleted' ORDER BY co_name";
        $objSQLCC = new SQL($qrCC);
        $results = $objSQLCC->getResultRowArray();
        echo json_encode($results);
        break;
    case 'getCustomerDetails';
        $com = strtolower(trim($received_data->com));
        $cid = $received_data->cid;
        $tbl = "customer_$com";
        $qr = "SELECT * FROM $tbl WHERE cid = $cid";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            echo json_encode(array('status' => 'ok', 'detail' => $result));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => "Cannot find Customer Data [cid = {$cid}]"));
        }
        break;
    case 'getAdminList':
        $admtab = 'admin';
        $qr = "SELECT * FROM $admtab WHERE issalesperson = 'no' AND `status` = 'active'";
        $objSQLadmin = new SQL($qr);
        $resultadm = $objSQLadmin->getResultRowArray();
        if (!empty($resultadm)) {
            $out_arr = array('status' => 'ok', 'adminList' => $resultadm);
        } else {
            $out_arr = array('status' => 'error');
        }
        echo json_encode($out_arr);
        break;
    case 'getItemList':
        $quono = $received_data->quono;
        $period = $received_data->period;
        $com = $received_data->com;

        $qrIL = "SELECT * FROM quono_list WHERE quono = '$quono'";
        $objSQL = new SQL($qrIL);
        $results = $objSQL->getResultRowArray();
        foreach ($results as $resultskey => $resultsdata) {
            $materialcode = trim($resultsdata['grade']);
            $itemno = $resultsdata['item'];
            $quotab = trim($resultsdata['quotab']);
            $quo_period = trim($resultsdata['period']);

            $qrISSOD = "SELECT * FROM $quotab WHERE quono = '$quono' AND item = $itemno";
            $objSQLISSOD = new SQL($qrISSOD);
            $resultissod = $objSQLISSOD->getResultOneRowArray();
            $odissue = $resultissod['odissue'];
            $results[$resultskey]['odissue'] = $odissue;

            $qrMT = "SELECT material FROM material WHERE materialcode = '$materialcode'";
            $objSQL2 = new SQL($qrMT);
            $result2 = $objSQL2->getResultOneRowArray();
            $materialname = $result2['material'];
            $results[$resultskey]['materialname'] = $materialname;
            $pmid = trim($resultsdata['process']);

            $qrPC = "SELECT process FROM premachining WHERE pmid = $pmid";
            $objSQL3 = new SQL($qrPC);
            $result3 = $objSQL3->getResultOneRowArray();
            $processcode = $result3['process'];
            $results[$resultskey]['processcode'] = $processcode;

            $qrOD = "SELECT status,noposition FROM orderlistnew_" . $com . "_" . $period . " WHERE quono = '$quono' AND item = $itemno";
            #echo "qrod = $qrOD\n";
            $objSQLOD = new SQL($qrOD);
            $resultOD = $objSQLOD->getResultOneRowArray();
            $results[$resultskey]['status_od'] = $resultOD['status'];
            $results[$resultskey]['noposition'] = $resultOD['noposition'];
        }
        echo json_encode($results);
        break;
    case 'getMaterial':
        $specialShape = $received_data->specialShape;
        if ($specialShape == 'NORMAL') {
            $qr = 'SELECT * FROM material2020 WHERE company = "PST"';
        } else {
            $qr = "SELECT * FROM material2020 WHERE material LIKE '%ms plate%' AND company = 'PST'";
        }
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultRowArray();
        echo json_encode($results);
        break;
    case 'getPmach':
        $Shape_Code = $received_data->Shape_Code;
        $specialShape = $received_data->specialShapeOrder;
        if ($Shape_Code == 'PLATEN'/* && $specialShape == 'NORMAL' */) {
            $qr = 'SELECT * FROM premachining';
        } else {
            $qr = 'SELECT * FROM premachining WHERE pmid = 1';
        }
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultRowArray();
        echo json_encode($results);
        break;
    case 'getCategory':
        $mat = $received_data->mat;
        $qr = "SELECT * FROM material2020 WHERE company = 'PST' AND materialcode = '$mat'";
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultOneRowArray();
        echo json_encode($results['category']);
        break;
    case 'getThicklist':
        $mat = $received_data->matcode;
        $custype = $received_data->custype;
        $company = strtolower($received_data->company);
        $cid = $received_data->cid;
//create matTable
        if ($custype == 'outstation' || $custype == 'melaka') {
            $matTable = $mat . "_" . $custype;
        } else if ($custype == 'local') {
            $matTable = $mat . "_" . strtolower($company) . "_" . $cid;
        }

        $checkTable = checkTableExists($matTable);
        if ($checkTable != 'YES') {
            $matTable = $mat;
        }
        $qr = "SELECT DISTINCT thickness FROM $matTable";
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultRowArray();
        echo json_encode($results);

        break;

    case 'getW1List':
        $mat = $received_data->matcode;
        $custype = $received_data->custype;
        $company = strtolower($received_data->company);
        $cid = $received_data->cid;
        $thickness = $received_data->thickness;
//create matTable
        if ($custype == 'outstation' || $custype == 'melaka') {
            $matTable = $mat . "_" . $custype;
        } else if ($custype == 'local') {
            $matTable = $mat . "_" . strtolower($company) . "_" . $cid;
        }

        $checkTable = checkTableExists($matTable);
        if ($checkTable != 'YES') {
            $matTable = $mat;
        }
        $qr = "SELECT DISTINCT width FROM $matTable WHERE thickness = $thickness";
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultRowArray();
        foreach ($results as $datarow) {
            $rawWidth = strtolower($datarow['width']);
            $checkWidth = stripos($rawWidth, 'x');
            if (isset($checkWidth)) {
                $widthArr = explode('x', $rawWidth);
                $data[] = trim($widthArr[0]);
            } else {
                $data[] = $rawWidth;
            }
        }
        echo json_encode($data);

        break;

    case 'getW2List':
        $mat = $received_data->matcode;
        $custype = $received_data->custype;
        $company = strtolower($received_data->company);
        $cid = $received_data->cid;
        $thickness = $received_data->thickness;
        $width = $received_data->width;
//create matTable
        if ($custype == 'outstation' || $custype == 'melaka') {
            $matTable = $mat . "_" . $custype;
        } else if ($custype == 'local') {
            $matTable = $mat . "_" . strtolower($company) . "_" . $cid;
        }

        $checkTable = checkTableExists($matTable);
        if ($checkTable != 'YES') {
            $matTable = $mat;
        }
        $qr = "SELECT DISTINCT width FROM $matTable WHERE thickness = $thickness AND width LIKE '%$width%'";
        $objSQL = new SQL($qr);
        $results = $objSQL->getResultRowArray();
        foreach ($results as $datarow) {
            $rawWidth = strtolower($datarow['width']);
            $checkWidth = stripos($rawWidth, 'x');
            if (isset($checkWidth)) {
                $widthArr = explode('x', $rawWidth);
                $data[] = trim($widthArr[1]);
            } else {
                $data[] = $rawWidth;
            }
        }
        echo json_encode($data);

        break;
    case 'getPmachPrice':
        $matcode = $received_data->matcode;
        $thickness = $received_data->thickness;
        $width = $received_data->width;
        $length = $received_data->length;
        $tol = $received_data->tol;
        $pmid = $received_data->pmid;
        $custype = $received_data->custype;
        $cid = $received_data->cid;
        $company = strtolower($received_data->company);
        $quantity = $received_data->quantity;
        $pmach = pmach($matcode, $thickness, $width, $length, $tol, $pmid, $custype, $cid, $company);
        $totalpmach = $quantity * $pmach;
        $data = array(
            'pmach' => $pmach,
            'totalpmach' => $totalpmach
        );
        echo json_encode($data);

        break;
    case 'getMatPrice':
        $ShapeCode = trim($received_data->ShapeCode);
        $specialShapeOrder = trim($received_data->specialShapeOrder);
        $matcode = trim($received_data->matcode);
        $company = trim(strtolower($received_data->company));
        $cid = trim($received_data->cid);
        $valDimension = json_decode($received_data->valDimension);
        $quantity = $received_data->quantity;
        switch ($ShapeCode) {
            case 'PLATEN':
                switch ($specialShapeOrder) {
                    case 'NORMAL':
//[T,W,L]
                        $T = $valDimension[0];
                        $W = $valDimension[1];
                        $L = $valDimension[2];
                        $dimension_array = array('T' => $T, 'W' => $W, 'L' => $L);
                        break;
                    case 'PLATEC':
//[T,OD,W,L]

                        $T = $valDimension[0];
                        $OD = $valDimension[1];
                        $W = $valDimension[2];
                        $L = $valDimension[3];
                        $dimension_array = array('T' => $T, 'OD' => $OD, 'W' => $W, 'L' => $L);

                        break;
                    case 'PLATECO':
//[T,OD,ID,W,L]

                        $T = $valDimension[0];
                        $OD = $valDimension[1];
                        $ID = $valDimension[2];
                        $W = $valDimension[3];
                        $L = $valDimension[4];
                        $dimension_array = array('T' => $T, 'OD' => $OD, 'ID' => $ID, 'W' => $W, 'L' => $L);

                        break;
                }
                break;
            case 'SS':
//[W1,W2,L]

                $W1 = $valDimension[0];
                $W2 = $valDimension[1];
                $L = $valDimension[2];
                $dimension_array = array('W1' => $W1, 'W2' => $W2, 'L' => $L);

                break;
            case 'FLAT':
//[T,W,L]

                $T = $valDimension[0];
                $W = $valDimension[1];
                $L = $valDimension[2];
                $dimension_array = array('T' => $T, 'W' => $W, 'L' => $L);

                break;
            case 'O':
//[PHI,L]

                $PHI = $valDimension[0];
                $L = $valDimension[1];
                $dimension_array = array('PHI' => $PHI, 'L' => $L);

                break;
            case 'HEX':
//[PHI,L]

                $HEX = $valDimension[0];
                $L = $valDimension[1];
                $dimension_array = array('HEX' => $HEX, 'L' => $L);

                break;
            case 'HS':
//[T,W1,W2,L]

                $T = $valDimension[0];
                $W1 = $valDimension[1];
                $W2 = $valDimension[2];
                $L = $valDimension[3];
                $dimension_array = array('T' => $T, 'W1' => $W1, 'W2' => $W2, 'L' => $L);

                break;
            case 'HP':
//[OD,ID,L]

                $OD = $valDimension[0];
                $ID = $valDimension[1];
                $L = $valDimension[2];
                $dimension_array = array('OD' => $OD, 'ID' => $ID, 'L' => $L);

                break;
            case 'A':
//[T,W1,W2,L]

                $T = $valDimension[0];
                $W1 = $valDimension[1];
                $W2 = $valDimension[2];
                $L = $valDimension[3];
                $dimension_array = array('T' => $T, 'W1' => $W1, 'W2' => $W2, 'L' => $L);

                break;
            case 'C':
                break;
            case 'LIP':
                break;
            case 'H':
                break;
        }
        $objMATPRICE = new \Dimension\MaterialPrice\MATERIAL_SPECIAL_PRICE_CID($cid, $company, $matcode, $dimension_array);
        $vol = $objMATPRICE->getVolume();
        $wgt = round($objMATPRICE->getWeight(), 1);
        $density = $objMATPRICE->getDensity();
        $pPKG = round($objMATPRICE->getPricePerKG(), 1);
        $pPPCS = round($objMATPRICE->getPricePerPcs(), 1);
        $minPrice = $objMATPRICE->getMinPrice($pPPCS, $company, $cid);
        if ($pPPCS != 0) {
            if ($minPrice > 0) {
                $pPKG = $minPrice;
            }
        }
        $ttlwgt = round($quantity * $wgt, 1);
        $ttlprc = round($quantity * $pPPCS, 1);
        $volume = round($vol, 1);
        $weight = round($wgt, 1);
        $pricePerKG = round($pPKG, 1);
        $pricePerPCS = round($pPPCS, 1);
        $totalweight = round($ttlwgt, 1);
        $totalprice = round($ttlprc, 1);
        $data = array(
            'volume' => $volume,
            'weight' => $weight,
            'density' => $density,
            'pricePerKG' => $pricePerKG,
            'pricePerPCS' => $pricePerPCS,
            'totalweight' => $totalweight,
            'totalprice' => $totalprice
        );
        echo json_encode($data);
        break;
    case 'getCrudDetails':
        $period = $received_data->period;
        $cid = $received_data->cid;
        $ordtab = "orderlistnew_" . $com_sml . "_" . $period;
        try {
            $qrChk = "SELECT DISTINCT quono FROM $ordtab "
                    . "WHERE cid = '$cid' "
                    . "ORDER BY quono ASC";
            $objSQLChk = new SQL($qrChk);
            $resultChk = $objSQLChk->getResultRowArray();
            if (!empty($resultChk)) {
                $detail_arr = array();
                foreach ($resultChk as $index => $data_row) {
                    $quono = $data_row['quono'];
                    //get quotation record
                    $qtab = "quono_list";
                    $qrquol = "SELECT * FROM $qtab WHERE cid = $cid AND quono = '$quono' AND odissue = 'yes'";
//                    echo "qr = $qrquol\n\n";
                    $objSQLquol = new SQL($qrquol);
                    $result = $objSQLquol->getResultOneRowArray();
                    if (!empty($result)) {
                        $rev_parent = $result['rev_parent'];
                        $rev_child = $result['rev_child'];
                    } else {
                        throw new Exception('Cannot fetch Quotation Data');
                    }
                    $qrordDetail = "SELECT * FROM $ordtab "
                            . "WHERE quono = '$quono' "
                            . "AND cid = '$cid' "
                            . "AND status != 'cancelled'";
//                    echo "qr = $qrordDetail\n\n";
                    $objSQLorddetail = new SQL($qrordDetail);
                    $dataset = $objSQLorddetail->getResultOneRowArray();
                    if (!empty($dataset)) {
                        #foreach ($dataset as $data) {
                        $date = $dataset['date_issue'];
                        $company = $dataset['company'];
                        $bid = $dataset['bid'];
                        $runningno = $dataset['runningno'];
                        $odissue = 'yes';
                        $aid_ol = $dataset['aid_ol'];
                        //get aid_ol name
                        $qrolaid = "SELECT name FROM admin "
                                . "WHERE aid = '$aid_ol' ";
//                            echo "qr = $qrolaid\n\n";
                        $objSQLolaid = new SQL($qrolaid);
                        $resultolaid = $objSQLolaid->getResultOneRowArray();
                        if (!empty($resultolaid)) {
                            $ol_name = $resultolaid['name'];
                        } else {
                            $ol_name = '';
                        }
                        //get total record for $ordtab
                        $qrordcount = "SELECT COUNT(*) FROM $ordtab WHERE quono = '$quono' "
                                . "AND cid = $cid "
                                . "AND status != 'cancelled'";
//                            echo "qr = $qrordcount\n";
                        $objOrdCount = new SQL($qrordcount);
                        $ord_numrow = $objOrdCount->getRowCount();
                        //get total record for Do Count
                        $qrordcount = "SELECT COUNT(*) FROM $ordtab WHERE quono = '$quono' "
                                . "AND cid = $cid "
                                . "AND status != 'cancelled' "
                                . "AND (docount IS NOT NULL AND docount != '')";
//                            echo "qr = $qrordcount\n";
                        $objOrdCount = new SQL($qrordcount);
                        $ord_docountnumrow = $objOrdCount->getRowCount();
                        //get total record for Invoice Issued
                        $qrordcount = "SELECT COUNT(*) FROM $ordtab WHERE quono = '$quono' "
                                . "AND cid = $cid "
                                . "AND status != 'cancelled' "
                                . "AND ivissue = 'issued' ";
//                            echo "qr = $qrordcount\n";
                        $objOrdCount = new SQL($qrordcount);
                        $ord_ivissuenumrow = $objOrdCount->getRowCount();
//                            echo "ordnumrow = $ord_numrow\n";
//                            echo "orddocountnumrow = $ord_docountnumrow\n";
//                            echo "ordivissuenumrow = $ord_ivissuenumrow\n";
                        unset($qrordcount);
                        unset($objOrdCount);
                        //Check for select do and invoice status
                        if ($ord_docountnumrow == 0) { //DO Count is null or empty 
                            $selectdo = 'Not Selected';
                        } elseif ($ord_docountnumrow < $ord_numrow) { //DO Count that's not null is less than total record
                            $selectdo = 'Partial Selected';
                        } elseif ($ord_docountnumrow == $ord_numrow) { // DO Count that's not null matches total record
                            $selectdo = 'All Selected';
                        } else {
                            $selectdo = '--ERROR--';
                        }
                        if ($ord_ivissuenumrow == 0) { //Invoice Issue is null or empty 
                            $ivissue = 'Not Issued';
                        } elseif ($ord_ivissuenumrow < $ord_numrow) { //Invoice Issue that's not null is less than total record
                            $ivissue = 'Partial Issued';
                        } elseif ($ord_ivissuenumrow == $ord_numrow) { // Invoice Issue that's not null matches total record
                            $ivissue = 'Issued';
                        } else {
                            $ivissue = '--ERROR--';
                        }
                        $detail_arr[] = array(
                            'date' => $date,
                            'quono' => $quono,
                            'cid' => $cid,
                            'bid' => $bid,
                            'runningno' => $runningno,
                            'company' => $company,
                            'odissue' => $odissue,
                            'ol_name' => $ol_name,
                            'selectdo' => $selectdo,
                            'ivissue' => $ivissue,
                            'rev_parent' => $rev_parent,
                            'rev_child' => $rev_child
                        );
                        #}
                    } else {
                        throw new Exception('Cannot find details for quono = ' . $quono);
                    }
                }
            } else {
                throw new Exception('No Orderlist Issued yet.');
            }
            $out_arr = array('status' => 'ok', 'detail' => $detail_arr);
        } catch (Exception $e) {
            $out_arr = array('status' => 'error', 'msg' => $e->getMessage());
        }
        echo json_encode($out_arr);
        break;
    case 'getDetails':
        $period = $received_data->period;
        $cid = $received_data->cid;
        $obj_quotation = new QID($period, $cid);
        $quotation_list = $obj_quotation->quotation_list();
        if (!empty($quotation_list)) {
            foreach ($quotation_list as $index => $quotation_datarow) {
//                Reformat the date
                $dt = $quotation_datarow['date'];
                $objDT = date('d-m-Y', strtotime($dt));
                $quotation_list[$index]['date'] = $objDT;
                $qno = $quotation_datarow['quono'];
                $cid = $quotation_datarow['cid'];
                $com = $quotation_datarow['company'];
                $com_sml = strtolower($com);
                $com_cap = strtoupper($com);
            }


            $out_arr = array('status' => 'ok', 'detail' => $quotation_list);
        } else {
            $out_arr = array('status' => 'error', 'msg' => "Cannot Find Data for period = $period and cid = $cid");
        }
        echo json_encode($out_arr);

        break;
    case 'getQuotationRecord':
        $period = $received_data->period;
        $cid = $received_data->cid;
        $quono = $received_data->quono;
        $com = $received_data->com;
        $quotab = "quotationnew_{$com}_{$period}";
        $qr = "SELECT * FROM $quotab "
                . "WHERE quono = '$quono' "
                . "AND cid = '$cid' "
                . "AND company = '$com' "
                . "AND odissue = 'no' "
//. "AND issued_to_quotation = 'yes' "
                . "ORDER BY item ASC";
        $objSQLquo = new SQL($qr);
# echo "qr = $qr\n";
        $result = $objSQLquo->getResultRowArray();
        if (!empty($result)) {
            foreach ($result as $key => $data_row) {
                $grade = $data_row['grade'];
                $matname = getMaterialNameByGrade($grade);
                if ($matname['status'] == 'ok') {
                    $materialname = $matname['name'];
                } else {
                    $materialname = $grade;
                }
                $pmid = $data_row['process'];
                $prname = getProcessNameByID($pmid);
                if ($prname['status'] == 'ok') {
                    $processname = $prname['name'];
                } else {
                    $processname = $pmid;
                }
                $result[$key]['materialname'] = $materialname;
                $result[$key]['processname'] = $processname;
            }
            $out_arr = array('status' => 'ok', 'detail' => $result);
        } else {
            $out_arr = array('status' => 'error', 'msg' => 'Cannot Find Quotation for [' . $quono . ']');
        }
        echo json_encode($out_arr);
        break;
    case 'getQuotationRecordRvs':
        $period = $received_data->period;
        $cid = $received_data->cid;
        $quono = $received_data->quono;
        $com = $received_data->com;
        $quotab = "quotationnew_{$com}_{$period}";
        $qr = "SELECT * FROM $quotab "
                . "WHERE quono = '$quono' "
                . "AND cid = '$cid' "
                . "AND company = '$com' "
//. "AND odissue = 'no' "
//. "AND issued_to_quotation = 'yes' "
                . "ORDER BY item ASC";
        $objSQLquo = new SQL($qr);
# echo "qr = $qr\n";
        $result = $objSQLquo->getResultRowArray();
        if (!empty($result)) {
            foreach ($result as $key => $data_row) {
                $grade = $data_row['grade'];
                $matname = getMaterialNameByGrade($grade);
                if ($matname['status'] == 'ok') {
                    $materialname = $matname['name'];
                } else {
                    $materialname = $grade;
                }
                $pmid = $data_row['process'];
                $prname = getProcessNameByID($pmid);
                if ($prname['status'] == 'ok') {
                    $processname = $prname['name'];
                } else {
                    $processname = $pmid;
                }
                $result[$key]['materialname'] = $materialname;
                $result[$key]['processname'] = $processname;
            }
            $out_arr = array('status' => 'ok', 'detail' => $result);
        } else {
            $out_arr = array('status' => 'error', 'msg' => 'Cannot Find Quotation for [' . $quono . ']');
        }
        echo json_encode($out_arr);
        break;
    case 'getOrderlistRecordRvs':
        $period = $received_data->period;
        $cid = $received_data->cid;
        $quono = $received_data->quono;
        $com = $received_data->com;
        $ordtab = "orderlistnew_{$com}_{$period}";
        $qr = "SELECT * FROM $ordtab "
                . "WHERE quono = '$quono' "
                . "AND cid = '$cid' "
                . "AND company = '$com' "
//. "AND odissue = 'no' "
//. "AND issued_to_quotation = 'yes' "
                . "ORDER BY noposition ASC";
        $objSQLquo = new SQL($qr);
# echo "qr = $qr\n";
        $result = $objSQLquo->getResultRowArray();
        if (!empty($result)) {
            foreach ($result as $key => $data_row) {
                $grade = $data_row['grade'];
                $matname = getMaterialNameByGrade($grade);
                if ($matname['status'] == 'ok') {
                    $materialname = $matname['name'];
                } else {
                    $materialname = $grade;
                }
                $pmid = $data_row['process'];
                $prname = getProcessNameByID($pmid);
                if ($prname['status'] == 'ok') {
                    $processname = $prname['name'];
                } else {
                    $processname = $pmid;
                }
                $opid = $data_row['operation'];
                $objOP = new OPERATION($opid);
                $opname = $objOP->get_opname();
                $result[$key]['materialname'] = $materialname;
                $result[$key]['processname'] = $processname;
                $result[$key]['operationname'] = $opname;
            }
            $out_arr = array('status' => 'ok', 'detail' => $result);
        } else {
            $out_arr = array('status' => 'error', 'msg' => 'Cannot Find Orderlist for [' . $quono . ']');
        }
        echo json_encode($out_arr);
        break;
    case 'getMaterialNameByGrade':
        $materialcode = $received_data->grade;
        $qr = "SELECT * FROM material2020 WHERE materialcode = '$materialcode'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            $materialname = $result['material'];
            $out_arr = array('status' => 'ok', 'name' => $materialname);
        } else {
            $out_arr = array('status' => 'error', 'msg' => 'Cannot find Material name for [' . $materialcode . ']');
        }
        echo json_encode($out_arr);
        break;
    case 'getSalesman':
        $aid_cus = $received_data->aid_cus;
        $qr = "SELECT * FROM admin WHERE aid = $aid_cus";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            $salesman = array('status' => 'ok', 'name' => $result['name']);
        } else {
            $salesman = array('status' => 'error', 'msg' => 'Cannot Find Salesman Name (aid = ' . $aid_cus . ')');
        }
        echo json_encode($salesman);
        break;
    case 'getInvHeaderRemarks':
        $qr = "SELECT * FROM invhearemarks";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultRowArray();
        if (!empty($result)) {
            $out_arr = array('status' => 'ok', 'detail' => $result);
        } else {
            $out_arr = array('status' => 'error', 'msg' => 'No Remarks Found');
        }
        echo json_encode($out_arr);
        break;
    case 'get_issueOrderlist':
        #echo "====begin backend area of issue orderlist====\n";
        //1. Extract data from front-end
        $totalUsedCR = $received_data->totalUsedCR; //This is the amount transaction for this quotation, update this into customer list;
        $quo_period = $received_data->period;
        $aid = $received_data->aid;
        $quoData = json_decode(json_encode($received_data->quoData), true);
        $quono = $received_data->quono;
        $inv_head_remark = $received_data->inv_head_remark;
        $invDate = $received_data->invDate; //Invoice Issue Date YYYY-MM-DD
        $com = strtolower(trim($received_data->com));
        #$ol_remarks = $received_data->ol_remarks;
        #print_r($quoData);
        $objPeriod = new Period();
        $issue_period = $objPeriod->getcurrentPeriod();
        $issue_date = date_format(date_create(), "Y-m-d");
        $issue_time = date_format(date_create(), "H:i:s");
        $issue_datetime = $issue_date . " " . $issue_time;
        if ($issue_time > "08:00:00" && $issue_time < "17:00:59") {
            
        } else {
            $objIssueDT = new DateTime($issue_datetime);
            date_add($objIssueDT, date_interval_create_from_date_string('1 days'));
            $issue_date = $objIssueDT->format('Y-m-d');
        }
        #echo "Generate runningno = \n";
        $runningno = generate_runno($quono, $issue_period, $aid);
        #echo "runningno = $runningno\n";
        //2. Loop each record from quoData
        $cnt = 0;
        $ol_invld = true;
        try {
            //check if InvDate is valid or not
            $invdate_chk = checkdate(substr($invDate, 5, 2), substr($invDate, 8, 2), substr($invDate, 0, 4));
            if ($invDate == '' || !$invdate_chk) {
                throw new Exception('Invoice Date is Invalid, Please Check');
            }
            #print_r($quoData);
            foreach ($quoData as $key => $data_row) {
                $itemindex = $key + 1;
                #echo $data_row['operation'];
                if ($data_row['operation'] == '' || $data_row['operation'] == null) {
                    Throw new Exception("Operation is empty on Item = " . $itemindex . ".");
                }
                if ($data_row['source'] == '' || $data_row['source'] == null) {
                    Throw new Exception("Source is empty on Item = " . $itemindex . ".");
                }
                $cd_date = $data_row['completiondate'];
                $completiondate_chk = checkdate(substr($cd_date, 5, 2), substr($cd_date, 8, 2), substr($cd_date, 0, 4));
                if (!$completiondate_chk) {
                    Throw new Exception("Completion date [" . $cd_date . "] is invalid on Item = " . $itemindex . ".");
                }
                if ($data_row['cuttingtype'] == '' || $data_row['cuttingtype'] == null) {
                    Throw new Exception("Cutting type is empty on Item = " . $itemindex . ".");
                }
            }
        } catch (Exception $ex) {
            $ol_invld = false;
            $ol_val_text = $ex->getMessage();
        }

        try {
            if (!$ol_invld) {
                throw new Exception($ol_val_text, 104);
            }
            $chkResult = check_existingOrderlist($quono, $issue_period, $com);
            if ($chkResult != 0) {
                throw new Exception('Orderlist has already been issued.', 103);
            }
            $output_data = array();
            foreach ($quoData as $quono_data_row) {
                //3. Fetch quotation data based on issue checkers
                $qid = $quono_data_row['qid']; //mark this, this is the qid
                $operation = $quono_data_row['operation'];
                $source = $quono_data_row['source'];
                #echo "source = $source\n";
                $chamfer = $quono_data_row['chamfer'];
                $flatness = $quono_data_row['flatness'];
                $billing = $quono_data_row['billing'];
                if ($billing = 'false') {
                    $status = 'active';
                } else {
                    $status = 'billing';
                }
                $toltp = $quono_data_row['toltp'];
                $toltm = $quono_data_row['toltm'];
                $tolwp = $quono_data_row['tolwp'];
                $tolwm = $quono_data_row['tolwm'];
                $tollp = $quono_data_row['tollp'];
                $tollm = $quono_data_row['tollm'];
                #$jlremarks = $quono_data_row['jlremarks'];
                $olremarks = $quono_data_row['olremarks'];
                $completiondate = $quono_data_row['completiondate'];
                $ivremarks = $quono_data_row['ivremarks'];
                $ivpono = $quono_data_row['ivpono'];
                $custoolcode = $quono_data_row['custoolcode'];

                $cuttingtype = $quono_data_row['cuttingtype'];
                $quono_dataset = getQuotationDataByQID($qid, $quono, $quo_period, $com);
                $jobno = generate_ol_jobno($com, $issue_period, $quono);
                $additionalData = array(
                    'aid_ol' => $aid,
                    'company' => $com,
                    'issue_period' => $issue_period,
                    'issue_date' => $issue_date,
                    'issue_datetime' => $issue_datetime,
                    'operation' => $operation,
                    'source' => $source,
                    'cuttingtype' => $cuttingtype,
                    'toltp' => $toltp,
                    'toltm' => $toltm,
                    'tolwp' => $tolwp,
                    'tolwm' => $tolwm,
                    'tollp' => $tollp,
                    'tollm' => $tollm,
                    'source' => $source,
                    'chamfer' => $chamfer,
                    'flatness' => $flatness,
                    'status' => $status,
                    'inv_header_remarks' => $inv_head_remark,
                    //'jlremarks' => $jlremarks,
                    'ol_remarks' => $olremarks,
                    'completiondate' => $completiondate,
                    'ivremarks' => $ivremarks,
                    'ivpono' => $ivpono,
                    'custoolcode' => $custoolcode,
                    'inv_date' => $invDate,
                    //'ol_remarks' => $ol_remarks,
                    'jobno' => $jobno,
                    'runningno' => $runningno
                        //add more when there's more data here
                );
                #print_r($detail_quotation);
                //3 a. Generate orderlist array
                $issue_array = generate_issueArray($quono_dataset, $additionalData);
                #echo "Issue array :\n";
                #print_r($issue_array);
                #echo "\n";
                #$objOL = new ISSUE_ORDERLIST($quono, $quono_dataset, $additionalData);
                #$objOL->test_class_variables();
                //3 b. Insert Orderlist into table
                $InsResult = issue_orderlist($issue_array, $issue_period, $com);
                if ($InsResult['status'] == 'error') {
                    //rollback the runningno serial generation if error
                    $qrDel = "DELETE FROM runningno_serial_$issue_period WHERE runningno = $runningno";
                    $objSQLdel = new SQL($qrDel);
                    $delResult = $objSQLdel->getDelete();
                    throw new Exception($InsResult['msg'], 101);
                } else {
                    //issue is succesfull, get the OID now.
                    $oidQR = "SELECT oid FROM orderlistnew_{$com}_{$issue_period} WHERE quono = '$quono' ORDER BY oid DESC ";
                    $objSQLoid = new SQL($oidQR);
                    $resultOID = $objSQLoid->getResultOneRowArray();
                    if (empty($resultOID)) {
                        throw new Exception('Something wrong with OID fetch [' . $oidQR . ']', 111);
                    }
                    $oid = $resultOID['oid']; //fetched OID
                }
                #$InsResult = $objOL->issue_Orderlist();
                #echo "$InsResult\n";
                //3 c. Generate runningno Array
                $runningno_array = generate_runningnoArray($quono, $issue_period, $quono_dataset, $additionalData);
                //3 d. Insert runningno into table
                $RInsResult = issue_runningno($runningno_array, $issue_period);
                if ($RInsResult['status'] == 'error') {
                    throw new Exception($RInsResult['msg'], 102);
                }
                //3.e Insert new record on ordercontrolcenter
                $ordcc_array = generate_ordercontrolcenterArray($quono, $issue_period, $oid, $qid);
                $ORDCCInsResult = issue_ordercontrolcenter($ordcc_array);
                if ($ORDCCInsResult['status'] == 'error') {
                    throw new Exception($ORDCCInsResult['msg'], 112);
                }

                $quotab = "quotationnew_" . $com . "_" . $quo_period;
                $output_data[] = array('qid' => $qid, 'quono' => $quono, 'quo_period' => $quo_period, 'quotab' => $quotab);
                #echo "$RInsResult\n";
            }
            $out_arr = array('status' => 'ok', 'runningno' => $runningno, 'output_data' => $output_data, 'issue_period' => $issue_period);
        } catch (Exception $ex) {
            switch ($ex->getCode()) {
                case 101:
                    $msg = "Something wrong during Orderlist Insertion, Please check this :";
                    $query = $ex->getMessage();
                    $err_quono = $quono;
                    $err_jobno = $jobno;
                    $out_arr = array('status' => 'error', 'msg' => $msg, 'err_quono' => $err_quono, 'err_jobno' => $err_jobno, 'query' => $query);
                    break;
                case 102:
                    $msg = "Something wrong during Runningno Insertion, Please check this :";
                    $query = $ex->getMessage();
                    $err_quono = $quono;
                    $err_jobno = $jobno;
                    $out_arr = array('status' => 'error', 'msg' => $msg, 'err_quono' => $err_quono, 'err_jobno' => $err_jobno, 'query' => $query);
                    break;
                case 103:
                    $msg = "Orderlist has already been issued!";
                    $out_arr = array('status' => 'error-exist', 'msg' => $msg);
                    break;
                case 104:
                    $msg = $ex->getMessage();
                    $out_arr = array('status' => 'error-exist', 'msg' => $msg);
                    ;
                    break;
            }
        }
        echo json_encode($out_arr);
        //4. 
        #echo "====endbackend area of issue orderlist====\n";
        break;
    case 'issueOL_updateQuotation':
        $data = json_decode(json_encode($received_data->data), true);
        try {
            foreach ($data as $quoupd_datarow) {
                $qid = $quoupd_datarow['qid'];
                $quono = $quoupd_datarow['quono'];
                $quo_period = $quoupd_datarow['quo_period'];
                $quotab = $quoupd_datarow['quotab'];

                $quo_updResult = quo_UpdIssueOLStatus($quotab, $quono, $qid);
                if ($quo_updResult == 'fail') {
                    throw new Exception('failed to insert into ' . $quotab);
                }
                $quonolist_updResult = quonolist_UpdIssueOLStatus($quotab, $quono, $quo_period);
                if ($quonolist_updResult == 'fail') {
                    throw new Exception('failed to insert into quono_list');
                }
            }
            $out_arr = array('status' => 'ok', 'msg' => 'Successfuly updated odissue Status in quono_list and ' . $quotab);
        } catch (Exception $ex) {
            $out_arr = array('status' => 'error', 'msg' => $ex->getMessage());
        }
        echo json_encode($out_arr);
        break;
    case 'reviseOL_Desc':
        $quono = $received_data->quono;
        $cid = $received_data->cid;
        $com = $received_data->com;
        $arrItemList = json_decode(json_encode($received_data->arrItemList), true);
        $ol_status_arr = json_decode(json_encode($received_data->ol_status_arr), true);
        $period = $received_data->period;
        $invHeaderRemarks = $received_data->InvHeaderRemarks;
        $invDate = $received_data->invDate;

        #var_dump($invDate);
        #print_r($ol_status_arr);
        try {
            foreach ($ol_status_arr as $key => $ol_status_row) {
                $index = $key;
                $oid = $ol_status_row['oid'];
                if ($ol_status_row['cancelled'] == 1) {
                    $cancelled = true;
                } else {
                    $cancelled = false;
                }
                $exOL_dataset = get_OLRecordByOID($period, $com, $oid);
                $occ_dataset = get_occRecordByOID($oid, $quono, $period);
                #print_r($occ_dataset);
                if (!empty($exOL_dataset)) {
                    if ($cancelled && $exOL_dataset['status'] == 'cancelled') {
                        //the record already cancelled, and not changed.
                        #echo "index = $index, status already cancelled and not changed\n";
                    } else {
                        #echo "index = $index\n";
                        $rvs_dataset = $arrItemList[$index];
                        $item = $rvs_dataset['item'];
                        $noposition = $rvs_dataset['noposition'];
                        $source = $rvs_dataset['source'];
                        $rvs_dataset['ihremarks'] = $invHeaderRemarks;
                        $rvs_dataset['ivdate'] = $invDate;
                        #print_r($rvs_dataset);
                        #echo "source = $source\n";
                        if ($cancelled) {
                            #echo "is cancelled\n";
                            //data is cancelled, ignore other items, just put the status as cancelled;
                            $rvs_DescArray = generate_rvsDescArray($rvs_dataset, "cancelled");
                            $rvs_DescArraySch = generate_rvsDescArray($rvs_dataset, "cancelled");
                            $rvs_dataset['status'] = 'cancelled';
                            $occ_remark = generate_occ_remark("normal", $exOL_dataset, $rvs_dataset);
                        } else {
                            #echo "is not cancelled\n";
                            $rvs_DescArray = generate_rvsDescArray($rvs_dataset);
                            $rvs_DescArraySch = generate_rvsDescArray($rvs_dataset, "sch");
                            if ($rvs_dataset['status'] == 'cancelled') {
                                $rvs_dataset['status'] = 'active';
                            }
                            $occ_remark = generate_occ_remark("normal", $exOL_dataset, $rvs_dataset);
                        }
                        if ($occ_remark == '') {
                            $old_remark = $occ_dataset['remarks2'];
                            $new_remark = $old_remark;
                            $revise_count = (int) $occ_dataset['revisecount'];
                            #echo "rvs count = $revise_count\n";
                        } else {
                            $old_remark = $occ_dataset['remarks2'];
                            if ($old_remark == '' || $old_remark == null) {
                                
                            } else {
                                $old_remark .= "\n";
                            }
                            $date = date('Y-m-d');
                            $new_remark = $old_remark . "\n" . "$date" . "_Changed Records :\n" . "$occ_remark";
                            $revise_count = (int) $occ_dataset['revisecount'] + 1;
                        }

                        $result_rvsOL = revise_orderlist_desc($quono, $cid, $period, $item, $rvs_DescArray);
                        if ($result_rvsOL == 'fail') {
                            throw new Exception("Failed revise Orderlist on Quono = $quono, and item = $item");
                        }
                        #echo "result_rvsOL = $result_rvsOL`\n";
                        $result_rvsSCH = revise_scheduling_desc($quono, $cid, $period, $noposition, $rvs_DescArraySch);
                        if ($result_rvsSCH == 'fail') {
                            throw new Exception("Failed revise Scheduling on Quono = $quono, and No Position = $noposition");
                        }
                        #echo "result_rvsSCH = $result_rvsSCH`\n\n";
                        $result_rvsOCC = desc_updOCC_remark($oid, $quono, $period, $new_remark, $revise_count);
                        if ($result_rvsOCC == 'fail') {
                            throw new Exception("Failed updating remark on Order Control List...");
                        }
                    }
                }
            }
            $out_arr = array('status' => 'ok', 'msg' => 'Revise Successful');
        } catch (Exception $ex) {
            $out_arr = array('status' => 'error', 'msg' => $ex->getMessage());
        }
        echo json_encode($out_arr);
        break;

    case 'reviseOL_Price':
        $quono = $received_data->quono;
        $cid = $received_data->cid;
        $com = strtolower($received_data->com);
        $period = $received_data->period;
        $bid = $received_data->bid;
        $rev_aid = $received_data->rev_aid;
        $rvsItemList = json_decode(json_encode($received_data->arrItemList), true);
        #echo "rvsItemList = \n";
        #print_r($rvsItemList);
        $quotab = "quotationnew_$com" . "_" . "$period";
        $objItemNo = new ITEMNO($quotab, $cid, $bid, $period, $com);
        $new_quono = $objItemNo->getQuono();
        #echo "new quono = $new_quono";

        try {
            foreach ($rvsItemList as $rvs_dataset) {
                $rvs_dataset['aid_quo'] = $rev_aid;
                $item = $rvs_dataset['item'];
                $noposition = $rvs_dataset['noposition'];
                $exOL_dataset = get_OLRecordByItem($period, $com, $quono, $item);
                //create a new quotation record.
                $quonolistResult = create_new_quonolistRecord($rvs_dataset, $quono, $new_quono, $period, $quotab);
                if ($quonolistResult == 'fail') {
                    throw new Exception('Failed to generate Quono_List');
                }
                $quotationResult = create_new_quotation_record($quonolistResult, $quotab);
                if ($quotationResult == 'fail') {
                    throw new Exception('Failed to issue new Revised Quotation');
                } else {
                    if ($rvs_dataset['odissue'] == 'yes') {
                        $qr = 'UPDATE ' . $quotab . ' SET odissue = "yes" WHERE quono = "' . $new_quono . '" AND item = ' . $item . '';
                        $objUQL = new SQL($qr);
                        $result = $objUQL->getUpdate();
                    }
                }
                $new_quo_dataset = $quotationResult;
                //Update child records;
                $updQuonoChild = update_reviseChild("quono_list", $new_quono, $quono);
                $updQuoChild = update_reviseChild($quotab, $new_quono, $quono);

                //begin updating scheduling and ordelrist

                $rvs_PriceArray = generate_rvsPriceArray($rvs_dataset, $new_quo_dataset);
                $rvs_SchPriceArray = generate_rvsPriceArray($rvs_dataset, $new_quo_dataset, "sch");
                //1. revise orderlist                
                $result_rvsOL = revise_orderlist_price($quono, $cid, $period, $item, $rvs_PriceArray);
                if ($result_rvsOL == 'fail') {
                    throw new Exception("Failed revise Orderlist on Quono = $quono, and item = $item");
                }

                $result_rvsSCH = revise_scheduling_price($quono, $cid, $period, $noposition, $rvs_SchPriceArray);
                if ($result_rvsSCH == 'fail') {
                    throw new Exception("Failed revise Scheduling on Quono = $quono, and Position = $noposition");
                }#echo 'result_rvsSCH (item = ' . $item . ') = ' . $result_rvsSCH . "\n";
                //revise runningno
                $oid = $exOL_dataset['oid'];
                $old_qid = $exOL_dataset['qid'];
                $old_quono = $quono;
                $runningno = $exOL_dataset['runningno'];
                $rntab = "runningno_$period";
                $qrUPDRN = "UPDATE $rntab SET qid = {$new_quo_dataset['qid']}, quono = '{$new_quono}' WHERE qid = {$old_qid} AND quono = '$old_quono'";
                $objSQLUPDRN = new SQL($qrUPDRN);
                $resultUPDRN = $objSQLUPDRN->getUpdate();
                if ($resultUPDRN != 'updated') {
                    Throw new Exception("Failed to update runningno to new quotation");
                }
                //revise runningno_serial
                $rnstab = "runningno_serial_$period";
                $qrUPDRNS = "UPDATE $rnstab SET quono = '$new_quono', aid_ol = $rev_aid WHERE runningno = $runningno";
                $objSQLUPDRNS = new SQL($qrUPDRNS);
                $resultUPDRNS = $objSQLUPDRNS->getUpdate();
                if ($resultUPDRNS != 'updated') {
                    Throw new Exception("Failed to update runningno_serial to new quotation [$qrUPDRNS]");
                }
                //revise ordercontrolcenter
                $objOCC = new ORDERCONTROLCENTER($oid, $old_qid, $period);
                $old_ocid = $objOCC->get_ocid();
                $remarks = "Revised Price from ocid = $old_ocid";
                $occ_arr = generate_ordercontrolcenterArray($new_quono, $period, $oid, $new_quo_dataset['qid'], $remarks, $old_ocid);
                $insoccResult = issue_ordercontrolcenter($occ_arr);
                if ($insoccResult['status'] == 'error') {
                    throw new Exception($insoccResult['msg']);
                } else {
                    $objNewOCC = new ORDERCONTROLCENTER($oid, $new_quo_dataset['qid'], $period);
                    $new_ocid = $objNewOCC->get_ocid();
                    $objOCC->update_reviseOCC($new_quono, $new_ocid);
                }
                $out_arr = array('status' => 'ok', 'msg' => 'Orderlist succesfully Revised!\nLinked to New Quotation [' . $new_quono . ']');
            }
        } catch (Exception $ex) {
            $out_arr = array('status' => 'error', 'msg' => $ex->getMessage());
        }
        echo json_encode($out_arr);
        break;
    case 'get_DeleteOrderlist':
        $del_dataset = json_decode(json_encode($received_data->deldataset), true);
        $req_aid = $received_data->req_aid;
        $req_remarks = $received_data->req_remarks;
        $period = $received_data->period;
        $aid = $received_data->aid;
        #print_r($received_data);

        $com = $del_dataset['company'];
        $ol_dateissue = $del_dataset['date'];
        $oriPeriod = substr($ol_dateissue, 2, 2) . substr($ol_dateissue, 5, 2); //Period of Order Issue
        $com_sml = strtolower($com);
        $com_cap = strtoupper($com);
        $quono = $del_dataset['quono'];
        $cid = $del_dataset['cid'];
        $bid = $del_dataset['bid'];
        $runningno = $del_dataset['runningno'];

        $del_datetime = date('Y-m-d H:i:s');

        $ordtab = "orderlistnew_{$com_sml}_$period";
        $orddeltab = "orderlistnew_delete_{$com_sml}_$period";
        //Because Scheduling and Output is generated when Orderlist is issued, It will be created on Orderlist Issue Period
        $schtab = "production_scheduling_$oriPeriod";
        $outtab = "production_output_$oriPeriod";
        //mark Production Scheduling as Cancelled
        try {
            $qrordcount = "SELECT COUNT(*) FROM $ordtab WHERE quono = '$quono' AND cid = '$cid' AND runningno = '$runningno' AND bid = '$bid' ";
            $objSQLordcount = new SQL($qrordcount);
            $ordnumrows = $objSQLordcount->getRowCount();
            if ($ordnumrows <= 0) {
                throw new Exception("Cannot find orderlist record for $quono in $ordtab");
            }
            $qrschcount = "SELECT COUNT(*) FROM $schtab WHERE quono = '$quono' AND cid = '$cid' AND runningno = '$runningno' AND bid = '$bid' ";
            $objSQLschcount = new SQL($qrschcount);
            $schnumrows = $objSQLschcount->getRowCount();
            if ($schnumrows <= 0) {
                throw new Exception("Cannot find scheduling record for $quono in $schtab");
            }
            //begin
            //mark all scheduling as cancelled
            $qrUpdSch = "UPDATE $schtab SET status = 'cancelled' WHERE quono = '$quono' AND cid = '$cid' AND runningno = '$runningno' AND bid = '$bid'";
            $objSQLupdsch = new SQL($qrUpdSch);
            $updschRes = $objSQLupdsch->getUpdate();
            if ($updschRes != 'updated') {
                throw new Exception('Failed to update Scheduling record into cancelled (quono = ' . $quono . ')');
            }
            //Fetch Orderlist records, move it into orderlistnew_delete
            $chkorddelTab = checkTableExists($orddeltab);
            if ($chkorddelTab == 'NO') { //if table not yet exists, generate it
                generate_orderlistnewdel_tbl($orddeltab);
            }
            //get order list records
            $qrord = "SELECT * FROM $ordtab WHERE quono = '$quono' AND cid = '$cid' AND runningno = '$runningno' AND bid = '$bid' ";
            $objSQLord = new SQL($qrord);
            $ord_dataset = $objSQLord->getResultRowArray();
            foreach ($ord_dataset as $ord_datarow) {
                $oid = $ord_datarow['oid'];
                //insert into orderlistnew_delete            
                ///add necessary values for deletion
                $ord_datarow['requestby'] = $req_aid;
                $ord_datarow['deleteby'] = $aid;
                $ord_datarow['datetimedelete_ol'] = $del_datetime;
                $ord_datarow['remarks'] = $req_remarks;
                $qrIns = "INSERT INTO $orddeltab SET ";
                $qrInsdbg = "INSERT INTO $orddeltab SET ";
                $arrcnt = count($ord_datarow);
                $cnt = 0;
                foreach ($ord_datarow as $index => $val) {
                    $cnt++;
                    $qrIns .= " $index =:$index ";
                    $qrInsdbg .= " $index = '$index' ";
                    if ($cnt != $arrcnt) {
                        $qrIns .= ' , ';
                        $qrInsdbg .= ' , ';
                    }
                }
                #echo "qrIns = $qrInsdbg\n";
                $objSQLIns = new SQLBINDPARAM($qrIns, $ord_datarow);
                $insResult = $objSQLIns->InsertData2();
                if ($insResult != 'insert ok!') {
                    throw new Exception("Failed inserting record to $orddeltab, oid = " . $oid . " details = $qrInsdbg");
                }
                //Update log in ordercontrolcenter
                $qrocc = "SELECT * FROM ordercontrolcenter WHERE quono = '$quono' AND orderlist_period = '$period' AND oid = $oid ";
                $objSQLocc = new SQL($qrocc);
                $occDetail = $objSQLocc->getResultOneRowArray();
                if (empty($occDetail)) {
                    throw new Exception('cannot find ordercontrolcenter data');
                }
                $ocid = $occDetail['ocid'];
                $rem2 = $occDetail['remarks2'];
                $new_occ_rem = $rem2 . "\n" . "$del_datetime : Aid [$aid] Deleted Orderlist Record, requested by Aid [$req_aid]";
                $qrUpdocc = "UPDATE ordercontrolcenter SET remarks2 = '$new_occ_rem' WHERE ocid = $ocid";
                $objSQLupdocc = new SQL($qrUpdocc);
                $updoccResult = $objSQLupdocc->getUpdate();
                if ($updoccResult != 'updated') {
                    throw new Exception('failed update Order Control Center, details = ' . $qrUpdocc);
                }
            }
            //Insert Successful, Delete Orderlist record
            $qrDelOrd = "DELETE FROM $ordtab WHERE quono = '$quono' AND cid = $cid AND bid = $bid AND runningno = $runningno";
            $objSQLorddel = new SQL($qrDelOrd);
            $delResult = $objSQLorddel->getDelete();
            if ($delResult != 'deleted') {
                throw new Exception("Failed to delete record from $ordtab, quono = $quono, details = $qrDelOrd");
            }
            //all process success
            $out_arr = array('status' => 'ok');
        } catch (Exception $e) {
//            echo $e->getMessage();
            $out_arr = array('status' => 'error', 'msg' => $e->getMessage());
        }
        echo json_encode($out_arr);
        break;
}


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

