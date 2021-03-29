<?php

function revise_quotation_price($quono, $cid, $period, $item, $rvs_PriceArray) {
    $tabcom = COMMONNAME_PST::COMPANY_SMLETTER;
    $quotab = "quotationnew_$tabcom" . "_" . $period;
    $qr = "UPDATE $quotab SET ";
    $cntArr = count($rvs_PriceArray);
    $cnt = 0;
    foreach ($rvs_PriceArray as $keyRvsPrc => $valRvsPrc) {
        $cnt++;
        $qr .= " $keyRvsPrc =:$keyRvsPrc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND item = '$item'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_PriceArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function revise_quonolist_price($quono, $cid, $period, $item, $rvs_PriceArray) {
    $qnotab = "quono_list";
    $qr = "UPDATE $qnotab SET ";
    $cntArr = count($rvs_PriceArray);
    $cnt = 0;
    foreach ($rvs_PriceArray as $keyRvsPrc => $valRvsPrc) {
        $cnt++;
        $qr .= " $keyRvsPrc =:$keyRvsPrc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND item = '$item'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_PriceArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function revise_orderlist_price($quono, $cid, $period, $item, $rvs_PriceArray) {
    $tabcom = COMMONNAME_PST::COMPANY_SMLETTER;
    $ordtab = "orderlistnew_$tabcom" . "_" . $period;
    $qr = "UPDATE $ordtab SET ";
    $cntArr = count($rvs_PriceArray);
    $cnt = 0;
    foreach ($rvs_PriceArray as $keyRvsPrc => $valRvsPrc) {
        $cnt++;
        $qr .= " $keyRvsPrc =:$keyRvsPrc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND item = '$item'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_PriceArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function revise_scheduling_price($quono, $cid, $period, $noposition, $rvs_PriceArray) {
    $ordtab = "production_scheduling" . "_" . $period;
    $qr = "UPDATE $ordtab SET ";
    $cntArr = count($rvs_PriceArray);
    $cnt = 0;
    foreach ($rvs_PriceArray as $keyRvsPrc => $valRvsPrc) {
        $cnt++;
        $qr .= " $keyRvsPrc =:$keyRvsPrc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND noposition = '$noposition'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_PriceArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function revise_orderlist_desc($quono, $cid, $period, $item, $rvs_DescArray) {
    $tabcom = COMMONNAME_PST::COMPANY_SMLETTER;
    $ordtab = "orderlistnew_$tabcom" . "_" . $period;
    $qr = "UPDATE $ordtab SET ";
    $cntArr = count($rvs_DescArray);
    $cnt = 0;
    foreach ($rvs_DescArray as $keyRvsDsc => $valRvsDsc) {
        $cnt++;
        $qr .= " $keyRvsDsc =:$keyRvsDsc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND item = '$item'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_DescArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function revise_scheduling_desc($quono, $cid, $period, $noposition, $rvs_DescArray) {
    $ordtab = "production_scheduling" . "_" . $period;
    $qr = "UPDATE $ordtab SET ";
    $cntArr = count($rvs_DescArray);
    $cnt = 0;
    foreach ($rvs_DescArray as $keyRvsDsc => $valRvsDsc) {
        $cnt++;
        $qr .= " $keyRvsDsc =:$keyRvsDsc ";
        if ($cntArr != $cnt) {
            $qr .= " , ";
        }
    }
    $qr .= "WHERE quono = '$quono' AND cid = $cid AND noposition = '$noposition'";
    $objUpd = new SQLBINDPARAM($qr, $rvs_DescArray);
    $result = $objUpd->UpdateData2();
    if ($result == 'Update ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function create_new_quonolistRecord($rvs_dataset, $quono, $new_quono, $period, $quotab) {
    unset($rvs_dataset['id']);
    $rvs_dataset['quono'] = $new_quono;
    $rvs_dataset['period'] = $period;
    $rvs_dataset['quotab'] = $quotab;
    $rvs_dataset['rev_parent'] = $quono;
    $cid = $rvs_dataset['cid'];
    $objREVQUONO = new REV_QUONO($rvs_dataset);
    #var_dump($objREVQUONO);
    $insResult = $objREVQUONO->insertQuonolist();
    if ($insResult == 'Insert Successful!') {
        $quonolist_arr = $objREVQUONO->get_QuonolistArray();
        $qr = 'UPDATE quono_list SET issued_to_quotation = "yes", odissue = "yes" WHERE quono = "' . $new_quono . '"';
        $objUQL = new SQL($qr);
        $result = $objUQL->getUpdate();
        return $quonolist_arr;
    } else {
        return 'fail';
    }
}

function create_new_quotation_record($quonolist_arr, $quotab) {
    $objCQ = new CreateQuotation2($quonolist_arr, $quotab);
    $insertResult = $objCQ->insertQuotation();
    if ($insertResult == 'Insert Successful!') {
        $quoArray = $objCQ->get_quoArray();
        $qid = $objCQ->get_qid();
        $quoArray['qid'] = $qid;
        return $quoArray;
    } else {
        return 'fail';
    }
}

function update_reviseChild($quotab, $newquono, $quono) {
    $qrUpd = "UPDATE $quotab SET rev_child = '$newquono' WHERE quono = '$quono'";
    $objSQLCh = new SQL($qrUpd);
    $resultSQLCh = $objSQLCh->getUpdate();
    if ($resultSQLCh == 'updated') {
        return 'success';
    } else {
        return 'failed';
    }
}

function get_customerDetails($cid) {
    $com = 'pst';
    $custab = "customer_$com";
    $qr = "SELECT * FROM $custab WHERE cid = $cid";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    if (!empty($result)) {
        return $result;
    } else {
        return 'fail';
    }
}

function generate_rvsPriceArray($rvs_dataset, $new_quo_dataset, $type = "all") {
    if ($type == 'all') {
        $rvs_PriceArray = array(
            'quono' => $new_quo_dataset['quono'],
            'qid' => $new_quo_dataset['qid'],
            'aid_quo' => $new_quo_dataset['aid_quo'],
            'Shape_Code' => $rvs_dataset['Shape_Code'],
            'Category' => $rvs_dataset['Category'],
            'specialShapeOrder' => $rvs_dataset['specialShapeOrder'],
            'tabletype' => $rvs_dataset['tabletype'],
            'quantity' => $rvs_dataset['quantity'],
            'grade' => $rvs_dataset['grade'],
            'mdt' => $rvs_dataset['mdt'],
            'mdw' => $rvs_dataset['mdw'],
            'mdl' => $rvs_dataset['mdl'],
            'dim_desp' => $rvs_dataset['dim_desp'],
            'fdt' => $rvs_dataset['fdt'],
            'fdw' => $rvs_dataset['fdw'],
            'fdl' => $rvs_dataset['fdl'],
            'finishing_dim_desp' => $rvs_dataset['finishing_dim_desp'],
            'process' => $rvs_dataset['process'],
            'mat' => $rvs_dataset['mat'],
            'pmach' => $rvs_dataset['pmach'],
            'cncmach' => $rvs_dataset['cncmach'],
            'other' => $rvs_dataset['other'],
            'ftz' => $rvs_dataset['ftz'],
            'amountmat' => $rvs_dataset['amountmat'],
            'discountmat' => $rvs_dataset['discountmat'],
            'gstmat' => $rvs_dataset['gstmat'],
            'totalamountmat' => $rvs_dataset['totalamountmat'],
            'amountpmach' => $rvs_dataset['amountpmach'],
            'discountpmach' => $rvs_dataset['discountpmach'],
            'gstpmach' => $rvs_dataset['gstpmach'],
            'totalamountpmach' => $rvs_dataset['totalamountpmach'],
            'amountcncmach' => $rvs_dataset['amountcncmach'],
            'discountcncmach' => $rvs_dataset['discountcncmach'],
            'gstcncmach' => $rvs_dataset['gstcncmach'],
            'totalamountcncmach' => $rvs_dataset['totalamountcncmach'],
            'amountother' => $rvs_dataset['amountother'],
            'discountother' => $rvs_dataset['discountother'],
            'gstother' => $rvs_dataset['gstother'],
            'totalamountother' => $rvs_dataset['totalamountother'],
            'totalamount' => $rvs_dataset['totalamount'],
        );
    } elseif ($type == 'sch') {
        $rvs_PriceArray = array(
            'quono' => $new_quo_dataset['quono'],
            'qid' => $new_quo_dataset['qid'],
            'quantity' => $rvs_dataset['quantity'],
            'grade' => $rvs_dataset['grade'],
            'mdt' => $rvs_dataset['mdt'],
            'mdw' => $rvs_dataset['mdw'],
            'mdl' => $rvs_dataset['mdl'],
            'fdt' => $rvs_dataset['fdt'],
            'fdw' => $rvs_dataset['fdw'],
            'fdl' => $rvs_dataset['fdl'],
            'process' => $rvs_dataset['process']
        );
    }
    return $rvs_PriceArray;
}

function generate_rvsDescArray($rvs_dataset, $type = "all") {
    #echo "TEST ".$rvs_dataset['status']." \n\n";
    if ($type == "all") {
        if ($rvs_dataset['status'] == 'cancelled') {
            $rvs_dataset['status'] = 'active'; //if the record is cancelled, but is marked to active, changed it to active
        }
        $rvs_DescArray = array(
            'status' => $rvs_dataset['status'],
            'olremarks' => $rvs_dataset['olremarks'], //
            'completion_date' => $rvs_dataset['completion_date'], //
            'source' => $rvs_dataset['source'], //
            'cuttingtype' => $rvs_dataset['cuttingtype'], //
            'tol_thkp' => $rvs_dataset['tol_thkp'], //
            'tol_thkm' => $rvs_dataset['tol_thkm'], //
            'tol_wdtp' => $rvs_dataset['tol_wdtp'], //
            'tol_wdtm' => $rvs_dataset['tol_wdtm'], //
            'tol_lghp' => $rvs_dataset['tol_lghp'], //
            'tol_lghm' => $rvs_dataset['tol_lghm'], //
            'chamfer' => $rvs_dataset['chamfer'], //
            'flatness' => $rvs_dataset['flatness'], //
            'ihremarks' => $rvs_dataset['ihremarks'], //
            'ivremarks' => $rvs_dataset['ivremarks'], //
            'ivpono' => $rvs_dataset['ivpono'], //
            'custoolcode' => $rvs_dataset['custoolcode'],
            'ivdate' => $rvs_dataset['ivdate'],
            'operation' => $rvs_dataset['operation'],
        );
    } elseif ($type == 'sch') {
        if ($rvs_dataset['status'] == 'cancelled') {
            $rvs_dataset['status'] = 'active'; //if the record is cancelled, but is marked to active, changed it to active
        }
        $rvs_DescArray = array(
            'status' => $rvs_dataset['status'],
            'completion_date' => $rvs_dataset['completion_date'],
            'source' => $rvs_dataset['source'],
            'cuttingtype' => $rvs_dataset['cuttingtype'],
            'custoolcode' => $rvs_dataset['custoolcode'],
            'ivdate' => $rvs_dataset['ivdate'],
            'operation' => $rvs_dataset['operation'],
        );
    } elseif ($type == 'cancelled') {
        $rvs_DescArray = array(
            'status' => 'cancelled'
        );
    }

    return $rvs_DescArray;
}

function checkTableExists($matTable) {
    $qr = "SHOW TABLES LIKE '%$matTable%'";
    $objSQL = new SQL($qr);
    $results = $objSQL->getResultOneRowArray();
    if (!empty($results)) {
        return 'YES';
    } else {
        return 'NO';
    }
}

function check_existingOrderlist($quono, $period, $com) {
    $ortab = "orderlistnew_{$com}_{$period}";
    $qr = "SELECT COUNT(*) FROM $ortab WHERE quono = '$quono'";
    $objSQL = new SQL($qr);
    $rowcount = $objSQL->getRowCount();
    return $rowcount;
}

function get_OLRecordByOID($period, $com, $oid) {
    $ortab = "orderlistnew_{$com}_{$period}";
    $qr = "SELECT * FROM $ortab WHERE oid = $oid";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    return $result;
}

function get_OLRecordByItem($period, $com, $quono, $item) {
    $ortab = "orderlistnew_{$com}_{$period}";
    $qr = "SELECT * FROM $ortab WHERE item = $item AND quono = '$quono' ";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    return $result;
}

function quo_UpdIssueOLStatus($quotab, $quono, $qid) {
    $qr = "UPDATE $quotab SET odissue = 'yes' WHERE quono = '$quono' AND qid = $qid ";
    $objSQLupd = new SQL($qr);
    $result = $objSQLupd->getUpdate();
    if ($result = 'updated') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function quonolist_UpdIssueOLStatus($quotab, $quono, $period) {
    $qr = "UPDATE quono_list SET odissue = 'yes' WHERE quono = '$quono' AND quotab = '$quotab' ";
    $objSQLupd = new SQL($qr);
    $result = $objSQLupd->getUpdate();
    if ($result = 'updated') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function issue_orderlist($issue_array, $issue_period, $com) {
    $ordtab = "orderlistnew_" . $com . "_" . $issue_period;
    $chkTab = checkTableExists($ordtab);
    if ($chkTab == 'NO'){
        $genTab = generate_orderlistnew_tbl($ordtab);
        if ($genTab == 'fail'){
            throw new Exception('Failed to Generate New Table ['.$ordtab.']');
        }
    }
    $cntArr = count($issue_array);
    $cnt = 0;
    $qrIns = "INSERT INTO $ordtab SET ";
    $qrIns2 = "INSERT INTO $ordtab SET \n";
    foreach ($issue_array as $ordKey => $ordVal) {
        $cnt++;
        $qrIns .= " $ordKey =:$ordKey ";
        $qrIns2 .= " `$ordKey` = '$ordVal' ";
        if ($cnt != $cntArr) {
            $qrIns .= " , ";
            $qrIns2 .= " , \n";
        }
    }
#echo $qrIns2;
    $objSQL = new SQLBINDPARAM($qrIns, $issue_array);
    $result = $objSQL->InsertData2();
    if ($result == 'insert ok!') {
        $info = array('status' => 'ok', 'msg' => 'Insert Successful!');
    } else {
        $info = array('status' => 'error', 'msg' => $qrIns2);
    }
    return $info;
}

function issue_ordercontrolcenter($ordCC_array) {
    $ordcctab = "ordercontrolcenter";
    $cntArr = count($ordCC_array);
    $cnt = 0;
    $qrIns = "INSERT INTO $ordcctab SET ";
    $qrIns2 = "INSERT INTO $ordcctab SET \n";
    foreach ($ordCC_array as $ordKey => $ordVal) {
        $cnt++;
        $qrIns .= " $ordKey =:$ordKey ";
        $qrIns2 .= " `$ordKey` = '$ordVal' ";
        if ($cnt != $cntArr) {
            $qrIns .= " , ";
            $qrIns2 .= " , \n";
        }
    }
#echo $qrIns2;
    $objSQL = new SQLBINDPARAM($qrIns, $ordCC_array);
    $result = $objSQL->InsertData2();
    if ($result == 'insert ok!') {
        $info = array('status' => 'ok', 'msg' => 'Insert Successful!');
    } else {
        $info = array('status' => 'error', 'msg' => $qrIns2);
    }
    return $info;
}

function issue_runningno($runningno_array, $issue_period) {
    $runtab = "runningno_" . $issue_period;
    $chkrn = checkTableExists($runtab);
    if ($chkrn == 'NO') {
        $resultgnrn = generate_runningno_tbl($runtab);
        if ($resultgnrn == 'fail') {
            throw new Exception('Failed generating new Runningno table [Period = ' . $issue_period . "]");
        }
    }
    $cntArr = count($runningno_array);
    $cnt = 0;
    $qrIns = "INSERT INTO $runtab SET ";
    $qrIns2 = "INSERT INTO $runtab SET \n";
    foreach ($runningno_array as $runKey => $runVal) {
        $cnt++;
        $qrIns .= " $runKey =:$runKey ";
        $qrIns2 .= " $runKey = $runVal ";
        if ($cnt != $cntArr) {
            $qrIns .= " , ";
            $qrIns2 .= " , \n";
        }
    }
#echo $qrIns2;
    $objSQL = new SQLBINDPARAM($qrIns, $runningno_array);
    $result = $objSQL->InsertData2();
    if ($result == 'insert ok!') {
        $info = array('status' => 'ok', 'msg' => 'Insert Successful!');
    } else {
        $info = array('status' => 'error', 'msg' => $qrIns2);
    }
    return $info;
}

function generate_runningnoArray($quono, $issue_period, $quono_dataset, $additionalData) {
    $runtab = "runningno_$issue_period";
    $dat = $quono_dataset;
    $qr = "SELECT COUNT(*) FROM $runtab WHERE date_issue = CURDATE() AND bid = {$dat['bid']}";
    $objSQLCount = new SQL($qr);
    $rowcount = $objSQLCount->getRowCount();
    $todayorderno = $rowcount + 1;
    $runningno_array = array(
        'bid' => $dat['bid'],
        'date_issue' => $additionalData['issue_date'],
        'runno' => $additionalData['runningno'],
        'todayorderno' => $todayorderno,
        'qid' => $dat['qid'],
        'quono' => $quono,
        'cid' => $dat['cid'],
        'company' => $dat['company']
    );
    return $runningno_array;
}

function get_occRecordByOID($oid, $quono, $period) {
    $qr = "SELECT * FROM ordercontrolcenter WHERE oid = $oid AND quono = '$quono' AND orderlist_period = '$period' AND ocid_child IS NULL";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    if (!empty($result)) {
        return $result;
    } else {
        return 'empty';
    }
}

function desc_updOCC_remark($oid, $quono, $orderlist_period, $occ_remark, $revise_count) {
    $occtab = "ordercontrolcenter";
    $qr = "UPDATE $occtab SET remarks2 = '$occ_remark', revisecount = $revise_count "
            . "WHERE oid = $oid AND quono = '$quono' AND orderlist_period = '$orderlist_period' AND ocid_child IS NULL";
    $objSQL = new SQL($qr);
    $updresult = $objSQL->getUpdate();
    #echo "QR = $qr\n";
    if ($updresult == 'updated') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function generate_occ_remark($type, $exOL_dataset, $rvs_dataset) {
    switch ($type) {
        case 'normal':
            $new_remark = '';
            #echo $exOL_dataset['status'] . " vs " . $rvs_dataset['status']."\n";
            foreach ($rvs_dataset as $key => $val) {
                #secho (($exOL_dataset[$key]))."\n";
                if (isset($exOL_dataset[$key])) {
                    $old_data = $exOL_dataset[$key];
                    if ($old_data != $val) {
                        $new_remark .= "$key = $old_data -> $val\n";
                    }
                }
            }
            break;
        case 'price':
            break;
    }
    # echo "remarks = \n$new_remark \n";
    return $new_remark;
}

function generate_ordercontrolcenterArray($quono, $ol_period, $oid, $qid, $remarks = null, $ocid_parent = null) {
    $quono_period = substr($quono, 4, 4);
    $date = date('Y-m-d');
    if ($remarks == null) {
        $remarks1 = $date . " : Orderlist is issued.\n";
    } else {
        $remarks1 = $date . " : " . $remarks;
    }
    $OCCArr = array(
        'oid' => $oid,
        'qid' => $qid,
        'quono' => $quono,
        'quono_period' => $quono_period,
        'orderlist_period' => $ol_period,
        'revisecount' => 0,
        'remarks1' => $remarks1,
        'remarks2' => '',
        'ocid_parent' => $ocid_parent
    );
    return $OCCArr;
}

function generate_issueArray($quono_dataset, $additionalData) {
    $dat = $quono_dataset;
    $issue_array = array(
        'bid' => $dat['bid'],
        'currency' => $dat['currency'],
        'qid' => $dat['qid'],
        'quono' => $dat['quono'],
        'company' => $dat['company'],
        'cusstatus' => $dat['cusstatus'],
        'cid' => $dat['cid'],
        'accno' => $dat['accno'],
        'date' => $dat['date'],
        'terms' => $dat['terms'],
        'noposition' => $additionalData['jobno'],
        'item' => $dat['item'],
        'quantity' => $dat['quantity'],
        'grade' => $dat['grade'],
        'mdt' => $dat['mdt'],
        'mdw' => $dat['mdw'],
        'mdl' => $dat['mdl'],
        'dim_desp' => $dat['dim_desp'],
        'fdt' => $dat['fdt'],
        'fdw' => $dat['fdw'],
        'fdl' => $dat['fdl'],
        'finishing_dim_desp' => $dat['finishing_dim_desp'],
        'process' => $dat['process'],
        'mat' => $dat['mat'],
        'pmach' => $dat['pmach'],
        'cncmach' => $dat['cncmach'],
        'other' => $dat['other'],
        'Shape_Code' => $dat['Shape_Code'],
        'Category' => $dat['Category'],
        'specialShapeOrder' => $dat['specialShapeOrder'],
        'tabletype' => $dat['tabletype'],
        'vat' => null, //dunno where this from
        'gst' => null, //dunno where this from
        'ftz' => $dat['ftz'],
        'amountmat' => $dat['amountmat'],
        'discountmat' => $dat['discountmat'],
        'gstmat' => $dat['gstmat'],
        'totalamountmat' => $dat['totalamountmat'],
        'amountpmach' => $dat['amountpmach'],
        'discountpmach' => $dat['discountpmach'],
        'gstpmach' => $dat['gstpmach'],
        'totalamountpmach' => $dat['totalamountpmach'],
        'amountcncmach' => $dat['amountcncmach'],
        'discountcncmach' => $dat['discountcncmach'],
        'gstcncmach' => $dat['gstcncmach'],
        'totalamountcncmach' => $dat['totalamountcncmach'],
        'amountother' => $dat['amountother'],
        'discountother' => $dat['discountother'],
        'gstother' => $dat['gstother'],
        'totalamountother' => $dat['totalamountother'],
        'totalamount' => $dat['totalamount'],
        'status' => $additionalData['status'],
        'aid_quo' => $dat['aid_quo'],
        'aid_cus' => $dat['aid_cus'],
        'datetimeissue_quo' => $dat['datetimeissue'],
        'olremarks' => $additionalData['ol_remarks'],
        'date_issue' => $additionalData['issue_date'],
        'completion_date' => $additionalData['completiondate'], //this will be empty, only inserted after job end
        'source' => $additionalData['source'],
        'cuttingtype' => $additionalData['cuttingtype'],
        'tol_thkp' => $additionalData['toltp'],
        'tol_thkm' => $additionalData['toltm'],
        'tol_wdtp' => $additionalData['tolwp'],
        'tol_wdtm' => $additionalData['tolwm'],
        'tol_lghp' => $additionalData['tollp'],
        'tol_lghm' => $additionalData['tollm'],
        'chamfer' => $additionalData['chamfer'],
        'flatness' => $additionalData['flatness'],
        'ihremarks' => $additionalData['inv_header_remarks'],
        'ivremarks' => $additionalData['ivremarks'],
        'ivpono' => $additionalData['ivpono'],
        'custoolcode' => $additionalData['custoolcode'],
        'runningno' => $additionalData['runningno'],
        'jobno' => $additionalData['jobno'],
        'ivdate' => $additionalData['inv_date'],
        'aid_ol' => $additionalData['aid_ol'],
        'datetimeissue_ol' => $additionalData['issue_datetime'],
        //Unknown if generated by current issue or not, active it when needed
#$this->set_jlissue(); 
#$this->set_jlreprint();
#$this->set_jlreprintcount();
#$this->set_docount();
#$this->set_dodate();
#$this->set_doissue();
#$this->set_doreprint();
#$this->set_doreprintcount();
#$this->set_driver();
#$this->set_policyno();
#$this->set_aid_do();
#$this->set_stampsignature();
#$this->set_aid_stampsignature();
#$this->set_datetime_stampsignature();
#$this->set_ivissue();
#$this->set_ivreprint();
#$this->set_ivreprintcount();
//end unknown data
        'operation' => $additionalData['operation'],
            //'jobcode' => "jobcode here", //test value, change this later
            //'jcodeid' => '' //this is only generated from joblist issue
    );
    return $issue_array;
}

function generate_ol_jobno($com, $issue_period, $quono) {
    $qr = "SELECT COUNT(*) FROM orderlistnew_{$com}_{$issue_period} WHERE quono = '$quono'";
    $objSQL = new SQL($qr);
    $noposition = $objSQL->getRowCount();
    return $noposition + 1;
}

function getQuotationDataByQID($qid, $quono, $period, $com) {
    $quotab = "quotationnew_" . $com . "_" . $period;
    $qr = "SELECT * FROM $quotab "
            . "WHERE quono = '$quono' "
            . "AND qid = $qid";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    If (!empty($result)) {
        return $result;
    } else {
        return 'empty';
    }
}

function getMaterialNameByGrade($grade) {
    $materialcode = $grade;
    $qr = "SELECT * FROM material2020 WHERE materialcode = '$materialcode'";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    if (!empty($result)) {
        $materialname = $result['material'];
        $out_arr = array('status' => 'ok', 'name' => $materialname);
    } else {
        $out_arr = array('status' => 'error', 'msg' => 'Cannot find Material name for [' . $materialcode . ']');
    }
    return $out_arr;
}

function getProcessNameByID($process) {
    $qr = "SELECT * FROM premachining WHERE pmid = $process";
    $objSQL = new SQL($qr);
    $result = $objSQL->getResultOneRowArray();
    if (!empty($result)) {
        $processname = $result['process'];
        $out_arr = array('status' => 'ok', 'name' => $processname);
    } else {
        $out_arr = array('status' => 'error', 'msg' => 'Cannot find Process name for PMID [' . $process . ']');
    }
    return $out_arr;
}

function generate_runningno_serial_tbl($rstab) {

    $qr = "CREATE TABLE `$rstab` (
                    `rsid` INT(11) NOT NULL AUTO_INCREMENT,
                    `runningno` INT(11) NOT NULL,
                    `instanceid` VARCHAR(18) NOT NULL,
                    `quono` VARCHAR(18) NOT NULL,
                    `aid_ol` INT(11) NOT NULL,
                    `datecreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`rsid`),
                    INDEX `sid` (`rsid`)
            )
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            ;
            ";
    $objSQL = new SQL($qr);
    $result = $objSQL->ExecuteQuery();
    if ($result == 'execute ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function generate_orderlistnew_tbl($ordtab) {
    $qr = "CREATE TABLE `$ordtab` (
                `oid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `bid` INT(10) UNSIGNED NOT NULL,
                `currency` INT(10) NOT NULL,
                `qid` INT(10) UNSIGNED NOT NULL,
                `quono` VARCHAR(20) NOT NULL,
                `company` VARCHAR(10) NOT NULL,
                `cusstatus` VARCHAR(10) NOT NULL,
                `cid` INT(10) UNSIGNED NOT NULL,
                `accno` VARCHAR(8) NOT NULL,
                `date` DATE NOT NULL,
                `terms` VARCHAR(30) NOT NULL,
                `noposition` INT(10) UNSIGNED NOT NULL,
                `item` VARCHAR(5) NOT NULL,
                `quantity` INT(10) NOT NULL,
                `grade` VARCHAR(30) NOT NULL,
                `mdt` VARCHAR(15) NULL DEFAULT NULL,
                `mdw` VARCHAR(15) NULL DEFAULT NULL,
                `mdl` VARCHAR(15) NULL DEFAULT NULL,
                `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `fdt` VARCHAR(15) NULL DEFAULT NULL,
                `fdw` VARCHAR(15) NULL DEFAULT NULL,
                `fdl` VARCHAR(15) NULL DEFAULT NULL,
                `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `process` VARCHAR(20) NULL DEFAULT NULL,
                `mat` DECIMAL(20,2) NOT NULL,
                `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `other` DECIMAL(20,2) NULL DEFAULT NULL,
                `Shape_Code` VARCHAR(20) NULL DEFAULT '',
                `specialShapeOrder` VARCHAR(20) NULL DEFAULT '',
                `Category` VARCHAR(20) NULL DEFAULT '',
                `tabletype` VARCHAR(5) NULL DEFAULT '',
                `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                `ftz` VARCHAR(5) NULL DEFAULT NULL,
                `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamount` DECIMAL(20,2) NOT NULL,
                `status` VARCHAR(10) NOT NULL,
                `aid_quo` INT(10) UNSIGNED NOT NULL,
                `aid_cus` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_quo` DATETIME NOT NULL,
                `olremarks` VARCHAR(100) NULL DEFAULT NULL,
                `date_issue` DATE NOT NULL,
                `completion_date` VARCHAR(15) NOT NULL,
                `source` VARCHAR(10) NOT NULL,
                `cuttingtype` VARCHAR(20) NOT NULL,
                `tol_thkp` VARCHAR(4) NOT NULL,
                `tol_thkm` VARCHAR(4) NOT NULL,
                `tol_wdtp` VARCHAR(4) NOT NULL,
                `tol_wdtm` VARCHAR(4) NOT NULL,
                `tol_lghp` VARCHAR(4) NOT NULL,
                `tol_lghm` VARCHAR(4) NOT NULL,
                `chamfer` VARCHAR(5) NOT NULL,
                `flatness` VARCHAR(5) NOT NULL,
                `ihremarks` INT(10) NULL DEFAULT NULL,
                `ivremarks` VARCHAR(30) NULL DEFAULT NULL,
                `ivpono` VARCHAR(20) NULL DEFAULT NULL,
                `custoolcode` VARCHAR(20) NULL DEFAULT NULL,
                `runningno` VARCHAR(4) NOT NULL,
                `jobno` VARCHAR(3) NOT NULL,
                `ivdate` DATE NOT NULL,
                `aid_ol` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_ol` DATETIME NOT NULL,
                `jlissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprintcount` INT(10) NOT NULL DEFAULT '0',
                `docount` INT(10) NULL DEFAULT NULL,
                `dodate` DATE NULL DEFAULT NULL,
                `doissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprintcount` VARCHAR(10) NOT NULL DEFAULT '0',
                `driver` VARCHAR(10) NULL DEFAULT NULL,
                `policyno` VARCHAR(20) NULL DEFAULT 'PST',
                `aid_do` INT(10) UNSIGNED NULL DEFAULT NULL,
                `stampsignature` VARCHAR(5) NOT NULL DEFAULT 'no',
                `aid_stampsignature` INT(10) NULL DEFAULT NULL,
                `datetime_stampsignature` DATETIME NULL DEFAULT NULL,
                `ivissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprintcount` INT(10) NOT NULL DEFAULT '0',
                `operation` INT(3) NOT NULL DEFAULT '1',
                `jcodeid` INT(11) NULL DEFAULT NULL,
                PRIMARY KEY (`oid`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB
        ROW_FORMAT=DYNAMIC
        ;
        ";
    $objSQL = new SQL($qr);
    $result = $objSQL->ExecuteQuery();
    if ($result == 'execute ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}
function generate_orderlistnewdel_tbl($ordtab) {
    $qr = "CREATE TABLE IF NOT EXISTS `$ordtab` (
                `odid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `oid` INT(10) UNSIGNED NOT NULL,
                `bid` INT(10) UNSIGNED NOT NULL,
                `currency` INT(10) NOT NULL,
                `qid` INT(10) UNSIGNED NOT NULL,
                `quono` VARCHAR(20) NOT NULL,
                `company` VARCHAR(10) NOT NULL,
                `cusstatus` VARCHAR(10) NOT NULL,
                `cid` INT(10) UNSIGNED NOT NULL,
                `accno` VARCHAR(8) NOT NULL,
                `date` DATE NOT NULL,
                `terms` VARCHAR(30) NOT NULL,
                `noposition` INT(10) UNSIGNED NOT NULL,
                `item` VARCHAR(5) NOT NULL,
                `quantity` INT(10) NOT NULL,
                `grade` VARCHAR(30) NOT NULL,
                `mdt` VARCHAR(15) NULL DEFAULT NULL,
                `mdw` VARCHAR(15) NULL DEFAULT NULL,
                `mdl` VARCHAR(15) NULL DEFAULT NULL,
                `dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `fdt` VARCHAR(15) NULL DEFAULT NULL,
                `fdw` VARCHAR(15) NULL DEFAULT NULL,
                `fdl` VARCHAR(15) NULL DEFAULT NULL,
                `finishing_dim_desp` VARCHAR(50) NULL DEFAULT NULL,
                `process` VARCHAR(20) NULL DEFAULT NULL,
                `mat` DECIMAL(20,2) NOT NULL,
                `pmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `cncmach` DECIMAL(20,2) NULL DEFAULT NULL,
                `other` DECIMAL(20,2) NULL DEFAULT NULL,
                `Shape_Code` VARCHAR(20) NULL DEFAULT '',
                `specialShapeOrder` VARCHAR(20) NULL DEFAULT '',
                `Category` VARCHAR(20) NULL DEFAULT '',
                `tabletype` VARCHAR(5) NULL DEFAULT '',
                `vat` DECIMAL(20,2) NULL DEFAULT NULL,
                `gst` DECIMAL(20,2) NULL DEFAULT NULL,
                `ftz` VARCHAR(5) NULL DEFAULT NULL,
                `amountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountmat` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountpmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountcncmach` DECIMAL(10,2) NULL DEFAULT NULL,
                `amountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `discountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `gstother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamountother` DECIMAL(10,2) NULL DEFAULT NULL,
                `totalamount` DECIMAL(20,2) NOT NULL,
                `status` VARCHAR(10) NOT NULL,
                `aid_quo` INT(10) UNSIGNED NOT NULL,
                `aid_cus` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_quo` DATETIME NOT NULL,
                `olremarks` VARCHAR(100) NULL DEFAULT NULL,
                `date_issue` DATE NOT NULL,
                `completion_date` VARCHAR(15) NOT NULL,
                `source` VARCHAR(10) NOT NULL,
                `cuttingtype` VARCHAR(20) NOT NULL,
                `tol_thkp` VARCHAR(4) NOT NULL,
                `tol_thkm` VARCHAR(4) NOT NULL,
                `tol_wdtp` VARCHAR(4) NOT NULL,
                `tol_wdtm` VARCHAR(4) NOT NULL,
                `tol_lghp` VARCHAR(4) NOT NULL,
                `tol_lghm` VARCHAR(4) NOT NULL,
                `chamfer` VARCHAR(5) NOT NULL,
                `flatness` VARCHAR(5) NOT NULL,
                `ihremarks` INT(10) NULL DEFAULT NULL,
                `ivremarks` VARCHAR(30) NULL DEFAULT NULL,
                `ivpono` VARCHAR(20) NULL DEFAULT NULL,
                `custoolcode` VARCHAR(20) NULL DEFAULT NULL,
                `runningno` VARCHAR(4) NOT NULL,
                `jobno` VARCHAR(3) NOT NULL,
                `ivdate` DATE NOT NULL,
                `aid_ol` INT(10) UNSIGNED NOT NULL,
                `datetimeissue_ol` DATETIME NOT NULL,
                `jlissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `jlreprintcount` INT(10) NOT NULL DEFAULT '0',
                `docount` INT(10) NULL DEFAULT NULL,
                `dodate` DATE NULL DEFAULT NULL,
                `doissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `doreprintcount` VARCHAR(10) NOT NULL DEFAULT '0',
                `driver` VARCHAR(10) NULL DEFAULT NULL,
                `policyno` VARCHAR(20) NULL DEFAULT 'PST',
                `aid_do` INT(10) UNSIGNED NULL DEFAULT NULL,
                `stampsignature` VARCHAR(5) NOT NULL DEFAULT 'no',
                `aid_stampsignature` INT(10) NULL DEFAULT NULL,
                `datetime_stampsignature` DATETIME NULL DEFAULT NULL,
                `ivissue` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprint` VARCHAR(10) NOT NULL DEFAULT 'no',
                `ivreprintcount` INT(10) NOT NULL DEFAULT '0',
                `operation` INT(3) NOT NULL DEFAULT '1',
                `jcodeid` INT(11) NULL DEFAULT NULL,
                `requestby` INT(11) NOT NULL,
                `deleteby` INT(11) NOT NULL,
                `datetimedelete_ol` DATETIME NOT NULL,
                `remarks` TEXT NOT NULL,
                
                PRIMARY KEY (`odid`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB
        ROW_FORMAT=DYNAMIC
        ;
        ";
    $objSQL = new SQL($qr);
    $result = $objSQL->ExecuteQuery();
    if ($result == 'execute ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function generate_runningno_tbl($rntab) {
    $qr = "CREATE TABLE `$rntab` (
                    `rnid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `bid` INT(10) UNSIGNED NOT NULL,
                    `date_issue` DATE NOT NULL,
                    `runno` INT(10) UNSIGNED NOT NULL,
                    `todayorderno` INT(10) UNSIGNED NOT NULL,
                    `qid` INT(10) NOT NULL,
                    `quono` VARCHAR(20) NOT NULL,
                    `cid` INT(10) UNSIGNED NOT NULL,
                    `company` VARCHAR(10) NOT NULL,
                    PRIMARY KEY (`rnid`)
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
            ROW_FORMAT=DYNAMIC
            ;
            ";
    $objSQL = new SQL($qr);
    $result = $objSQL->ExecuteQuery();
    if ($result == 'execute ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function generate_runno($quono, $issue_period, $aid) {
    $rstab = "runningno_serial_$issue_period";
    $rschk = checkTableExists($rstab);
    if ($rschk == "NO") {
        $resultgnrns = generate_runningno_serial_tbl($rstab);
        if ($resultgnrns == 'fail') {
            throw new Exception('Failed generating new Runningno_Serial Table [Period = ' . $issue_period . "]");
        }
    }
    $qr = "SELECT * FROM $rstab ORDER BY rsid DESC LIMIT 0,1";
    $objRunno = new SQL($qr);
    $recordset = $objRunno->getResultOneRowArray();
    if (!empty($recordset)) {
        $runningno = $recordset['runningno'];
        $instanceid = (int) $recordset['instanceid'];
        $datecreate = $recordset['datecreate'];
    } else {
        $runningno = 0;
        $instanceid = 0;
    }
    $newrunno = $runningno;
    $newrunno++;
#echo "in Line 146  \$runningno = $runningno, \$newrunno = $newrunno \n";
    if (isset($newrunno)) {
        if (isset($aid)) {
            $user = $aid;
            $user = trim(preg_replace('/\s+/', ' ', $user));
#echo "the user is id $user \n";
        }
#echo "newrunno = $newrunno, runningno = $runningno \n";
        $newrunno = (int) $newrunno;
        $newrunno = $runningno;
        $newrunno++;

        $userid1 = $user;
        $getID1 = generate_new_serial($quono, $userid1, $newrunno, $instanceid, $issue_period); //This returns the runningno
#var_dump($getID1);
    } elseif (isset($runningno)) {
        
    }
#echo "newrunno = $newrunno \n";
    $output = array(
        'message' => 'running no generated'
    );
#echo json_encode($output);
    return $getID1;
}

function generate_new_serial($quono, $j, $runno, $instanceid2, $period) {
    $date = new DateTime();
    $date->setDate(2020, 10, 3);
#echo $date->format('Y-m-d') . " | ";
#$expiredate = $date->format('Y-m-d');
// $j = 1001; //only one user/machine ID
    $rstab = "runningno_serial_$period";

    $datecreate = date('Y-m-d H:i:s');

#echo "$datecreate " . "\n";
    $serialno = $runno;

    for ($i = 1; $i < 2; $i++) {
# code...
//with in 100 time loop of $i

        $params = array('work_id' => $j,);
        $idGenerate = IdGenerate::getInstance($params);
        $instanceid = $idGenerate->generatorNextId();
//$serialno++;
        $sid = '';
// return $id;
// Prints the day, date, month, year, time, AM or PM
        $sql = "SELECT datecreate, instanceid, runningno FROM $rstab ORDER BY rsid DESC LIMIT 0, 1";
#echo "\$sql = $sql \n";
        $objcheckInstance = new SQL($sql);
        $recordset = $objcheckInstance->getResultOneRowArray();
        if (!empty($recordset)) {
#echo "recordset is not empty\n";
            $instanceidcheck = $recordset['instanceid'];
            $serial_no = $recordset['runningno'];
        } else {
#echo "recordset is empty\n";

            $instanceidcheck = 0;
            $serial_no = 0;
        }
#echo "\$instanceidcheck = $instanceidcheck , \$instanceid2 = $instanceid2,\$instanceid = $instanceid  \n";
#echo "\$serial_no = $serial_no \n";
        $sql2 = "SELECT datecreate, instanceid, runningno FROM $rstab ORDER BY rsid DESC LIMIT 0, 1";
        $objcheckInstance2 = new SQL($sql2);
        $recordset2 = $objcheckInstance2->getResultOneRowArray();
        if (!empty($recordset2)) {
#echo "recordset2 is not empty\n";

            $instanceidcheck2 = $recordset2['instanceid'];
            $serial_no2 = $recordset2['runningno'];
        } else {
#echo "recordset2 is empty\n";

            $instanceidcheck2 = 0;
            $serial_no2 = 0;
        }
        $serial_no2 = (int) $serial_no2;
        $serial_no = (int) $serial_no;
        $serialno = (int) $serialno;
#echo "\$instanceidcheck2 = $instanceidcheck2 , \$instanceid2 = $instanceid2, \$instanceid = $instanceid\n";
#echo "\$serial_no = $serial_no \n";
        if ($serial_no2 > $serialno) {
            $serialno = $serial_no2;
        }
        if (isset($instanceid)) {
            if ($instanceid != $instanceidcheck2) {
                $serialno = $serial_no;
                $serialno++;
#echo "in line 116 , before insertSQL, \$instanceid2 = $instanceid2, \$instanceid = $instanceid, \$serialno = $serialno\n";
#insert_serialData($instanceid, $j, $expiredate, $serialno, $datecreate,$rstab);
            } else {
#echo "in line 119 else , before insertSQL, \instancetid = instancetid, \$serialno = $serialno\n";
#insert_serialData($instanceid, $j, $expiredate, $serialno, $datecreate,$rstab);
#insert_serialData($instanceid, $j, $quono, $serialno, $datecreate, $rstab);
            }
            $inst_sd_result = insert_serialData($instanceid, $j, $quono, $serialno, $datecreate, $rstab);
        }

//#echo "work_id = $j, \$instancetid = $instancetid    |   " . $datecreate . " | expireddate = $expiredate | $serialno\n";
    }

    return $serialno;
}

function insert_serialData($instancetid, $userid, $quono, $serialno, $datecreate, $rstab) {
    $sqlInsert = "INSERT INTO $rstab SET instanceid = '$instancetid', "
            . " aid_ol = '$userid', quono = '$quono', runningno = '$serialno',"
            . " datecreate = '$datecreate';";
##echo "Line 65, \$sqlInsert = $sqlInsert \n";
    $objinsert = new SQL($sqlInsert);
    $result = $objinsert->InsertData();
#echo "$result\n";
}

/*
function generate_quonolistArray($rvs_dataset) {
    $quonoArr = array(
        'bid' => $rvs_dataset['bid'],
        'currency' => $rvs_dataset['currency'],
        'quono' => $rvs_dataset['quono'],
        'quotab' => $rvs_dataset['quotab'],
        'post_period' => $rvs_dataset['period'],
        'Shape_Code' => $rvs_dataset['Shape_Code'],
        'category' => $rvs_dataset['Category'],
        'specialShapeOrder' => $rvs_dataset['specialShapeOrder'],
        'tabletype' => $rvs_dataset['tabletype'],
        'com' => $rvs_dataset['company'],
        'status' => $rvs_dataset['cusstatus'],
        'custype' => $rvs_dataset['custype'],
        'pagetype' => $rvs_dataset['pagetype'],
        'post_cid' => $rvs_dataset['cid'],
        'accno' => $rvs_dataset['accno'],
        'date' => date('Y-m-d'),
        'terms' => $rvs_dataset['terms'],
        'itemno' => $rvs_dataset['item'],
        'quantity' => $rvs_dataset['quantity'],
        'mat' => $rvs_dataset['grade'],
        'mdt' => $rvs_dataset['mdt'],
        'mdw' => $rvs_dataset['mdw'],
        'mdl' => $rvs_dataset['mdl'],
        'dim_desc' => $rvs_dataset['dim_desp'],
        'fdt' => $rvs_dataset['fdt'],
        'fdw' => $rvs_dataset['fdw'],
        'fdl' => $rvs_dataset['fdl'],
        'finishing_dim_desc' => $rvs_dataset['finishing_dim_desc'],
        'pmid' => $rvs_dataset['pmid'],
        'pricePerPCS' => $rvs_dataset['mat'],
        'pmachprice' => $rvs_dataset['pmach'],
        'cncprice' => $rvs_dataset['cncmach'],
        'otherprice' => $rvs_dataset['other'],
        'ftz' => $rvs_dataset['ftz'],
        'totalprice' => $rvs_dataset['amountmat'],
        'totaldiscountmat' => $rvs_dataset['discountmat'],
        'totalgstmat' => $rvs_dataset['gstmat'],
        'subtotalmat' => $rvs_dataset['totalamountmat'],
        'totalpmachprice' => $rvs_dataset['amountpmach'],
        'totaldiscountpmach' => $rvs_dataset['discountpmach'],
        'totalgstpmach' => $rvs_dataset['gstpmach'],
        'subtotalpmachprice' => $rvs_dataset['totalamountpmach'],
        'totalcncprice' => $rvs_dataset['amountcncmach'],
        'totaldiscountcnc' => $rvs_dataset['discountcncmach'],
        'totalgstcnc' => $rvs_dataset['gstcncmach'],
        'subtotalcncprice' => $rvs_dataset['totalamountcncmach'],
        'otherprice' => $rvs_dataset['amountother'],
        'totaldiscountother' => $rvs_dataset['discountother'],
        'totalgstother' => $rvs_dataset['gstother'],
        'subtotalotherprice' => $rvs_dataset['totalamountother'],
        'totalamount' => $rvs_dataset['totalamount'],
        'aid' => 100,//$rvs_dataset['__'], //CHANGe THIS LATER, THIS MUST BE BASED ON USER LOGIN
        'aid_cus' => $rvs_dataset['aid_cus'],
        'datetimeissue' => date('Y-m-d G:i:s'),
        'volume' => $rvs_dataset['volumeperunit'],
        'weight' => $rvs_dataset['weightperunit'],
        'totalweight' => $rvs_dataset['totalweight'],
        'density' => $rvs_dataset[''],
        'pricePerKG' => $rvs_dataset['__']
    );
}*/