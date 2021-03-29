<?php

Class ORDERLIST {

    Protected $oid;         //auto increment
    Protected $bid;         //called from quotation
    Protected $currency;    //called from quotation
    Protected $qid;         //called from quotation
    Protected $quono;       //called from quotation
    Protected $company;     //called from quotation
    Protected $cusstatus;   //called from quotation
    Protected $cid;         //called from quotation
    Protected $accno;       //called from quotation
    Protected $date;        //called from quotation
    Protected $terms;       //called from quotation
    Protected $noposition;  //Generate based on existing record in orderlist
    Protected $item;        //called from quotation
    Protected $quantity;    //called from quotation
    Protected $grade;       //called from quotation
    Protected $mdt;         //called from quotation
    Protected $mdw;         //called from quotation
    Protected $mdl;         //called from quotation
    Protected $dim_desp;    //called from quotation
    Protected $fdt;         //called from quotation
    Protected $fdw;         //called from quotation
    Protected $fdl;         //called from quotation
    Protected $finishing_dim_desp; //called from quotation
    Protected $process;     //called from quotation
    Protected $mat;         //called from quotation
    Protected $pmach;       //called from quotation
    Protected $cncmach;     //called from quotation
    Protected $other;       //called from quotation
    Protected $Shape_Code;  //called from quotation
    Protected $Category;    //called from quotation
    Protected $tabletype;   //called from quotation
    Protected $vat;
    Protected $gst;
    Protected $ftz;         //called from quotation
    Protected $amountmat;   //called from quotation
    Protected $discountmat; //called from quotation
    Protected $gstmat;      //called from quotation
    Protected $totalamountmat; //called from quotation
    Protected $amountpmach; //called from quotation
    Protected $discountpmach; //called from quotation
    Protected $gstpmach;    //called from quotation
    Protected $totalamountpmach; //called from quotation
    Protected $amountcncmach; //called from quotation
    Protected $discountcncmach; //called from quotation
    Protected $gstcncmach;  //called from quotation
    Protected $totalamountcncmach; //called from quotation
    Protected $amountother; //called from quotation
    Protected $discountother; //called from quotation
    Protected $gstother;    //called from quotation
    Protected $totalamountother; //called from quotation
    Protected $totalamount; //called from quotation
    Protected $aid_quo;     //called from quotation
    Protected $aid_cus;     //called from quotation
    Protected $datetimeissue_quo; //datetimeissue column of quotationnew
    Protected $olremarks;   //from issue orderlist
    Protected $date_issue;  //date now
    Protected $completion_date; //null
    Protected $source;      //from issue orderlist -- note :testing uses CJ
    Protected $cuttingtype; //from issue orderlist
    Protected $tol_thkp;
    Protected $tol_thkm;
    Protected $tol_wdtp;
    Protected $tol_wdtm;
    Protected $tol_lghp;
    Protected $tol_lghm;
    Protected $chamfer;
    Protected $flatness;
    Protected $ihremarks;
    Protected $ivremarks;
    Protected $ivpono;
    Protected $custoolcode;
    Protected $runningno;
    Protected $jobno;
    Protected $ivdate;
    Protected $aid_ol;
    Protected $datetimeissue_ol;
    Protected $jlissue;
    Protected $jlreprint;
    Protected $jlreprintcount;
    Protected $docount;
    Protected $dodate;
    Protected $doissue;
    Protected $doreprint;
    Protected $doreprintcount;
    Protected $driver;
    Protected $policyno;
    Protected $aid_do;
    Protected $stampsignature;
    Protected $aid_stampsignature;
    Protected $datetime_stampsignature;
    Protected $ivissue;
    Protected $ivreprint;
    Protected $ivreprintcount;
    Protected $operation;
    Protected $jobcode;

    Public function __construct() {
        
    }

    Protected function get_oid() {
        return $this->oid;
    }

    Protected function set_oid($input) {
        $this->oid = $input;
    }

    Protected function get_bid() {
        return $this->bid;
    }

    Protected function set_bid($input) {
        $this->bid = $input;
    }

    Protected function get_currency() {
        return $this->currency;
    }

    Protected function set_currency($input) {
        $this->currency = $input;
    }

    Protected function get_qid() {
        return $this->qid;
    }

    Protected function set_qid($input) {
        $this->qid = $input;
    }

    Protected function get_quono() {
        return $this->quono;
    }

    Protected function set_quono($input) {
        $this->quono = $input;
    }

    Protected function get_company() {
        return $this->company;
    }

    Protected function set_company($input) {
        $this->company = $input;
    }

    Protected function get_cusstatus() {
        return $this->cusstatus;
    }

    Protected function set_cusstatus($input) {
        $this->cusstatus = $input;
    }

    Protected function get_cid() {
        return $this->cid;
    }

    Protected function set_cid($input) {
        $this->cid = $input;
    }

    Protected function get_accno() {
        return $this->accno;
    }

    Protected function set_accno($input) {
        $this->accno = $input;
    }

    Protected function get_date() {
        return $this->date;
    }

    Protected function set_date($input) {
        $this->date = $input;
    }

    Protected function get_terms() {
        return $this->terms;
    }

    Protected function set_terms($input) {
        $this->terms = $input;
    }

    Protected function get_noposition() {
        return $this->noposition;
    }

    Protected function set_noposition($input) {
        $this->noposition = $input;
    }

    Protected function get_item() {
        return $this->item;
    }

    Protected function set_item($input) {
        $this->item = $input;
    }

    Protected function get_quantity() {
        return $this->quantity;
    }

    Protected function set_quantity($input) {
        $this->quantity = $input;
    }

    Protected function get_grade() {
        return $this->grade;
    }

    Protected function set_grade($input) {
        $this->grade = $input;
    }

    Protected function get_mdt() {
        return $this->mdt;
    }

    Protected function set_mdt($input) {
        $this->mdt = $input;
    }

    Protected function get_mdw() {
        return $this->mdw;
    }

    Protected function set_mdw($input) {
        $this->mdw = $input;
    }

    Protected function get_mdl() {
        return $this->mdl;
    }

    Protected function set_mdl($input) {
        $this->mdl = $input;
    }

    Protected function get_dim_desp() {
        return $this->dim_desp;
    }

    Protected function set_dim_desp($input) {
        $this->dim_desp = $input;
    }

    Protected function get_fdt() {
        return $this->fdt;
    }

    Protected function set_fdt($input) {
        $this->fdt = $input;
    }

    Protected function get_fdw() {
        return $this->fdw;
    }

    Protected function set_fdw($input) {
        $this->fdw = $input;
    }

    Protected function get_fdl() {
        return $this->fdl;
    }

    Protected function set_fdl($input) {
        $this->fdl = $input;
    }

    Protected function get_finishing_dim_desp() {
        return $this->finishing_dim_desp;
    }

    Protected function set_finishing_dim_desp($input) {
        $this->finishing_dim_desp = $input;
    }

    Protected function get_process() {
        return $this->process;
    }

    Protected function set_process($input) {
        $this->process = $input;
    }

    Protected function get_mat() {
        return $this->mat;
    }

    Protected function set_mat($input) {
        $this->mat = $input;
    }

    Protected function get_pmach() {
        return $this->pmach;
    }

    Protected function set_pmach($input) {
        $this->pmach = $input;
    }

    Protected function get_cncmach() {
        return $this->cncmach;
    }

    Protected function set_cncmach($input) {
        $this->cncmach = $input;
    }

    Protected function get_other() {
        return $this->other;
    }

    Protected function set_other($input) {
        $this->other = $input;
    }

    Protected function get_Shape_Code() {
        return $this->Shape_Code;
    }

    Protected function set_Shape_Code($input) {
        $this->Shape_Code = $input;
    }

    Protected function get_Category() {
        return $this->Category;
    }

    Protected function set_Category($input) {
        $this->Category = $input;
    }

    Protected function get_tabletype() {
        return $this->tabletype;
    }

    Protected function set_tabletype($input) {
        $this->tabletype = $input;
    }

    Protected function get_vat() {
        return $this->vat;
    }

    Protected function set_vat($input) {
        $this->vat = $input;
    }

    Protected function get_gst() {
        return $this->gst;
    }

    Protected function set_gst($input) {
        $this->gst = $input;
    }

    Protected function get_ftz() {
        return $this->ftz;
    }

    Protected function set_ftz($input) {
        $this->ftz = $input;
    }

    Protected function get_amountmat() {
        return $this->amountmat;
    }

    Protected function set_amountmat($input) {
        $this->amountmat = $input;
    }

    Protected function get_discountmat() {
        return $this->discountmat;
    }

    Protected function set_discountmat($input) {
        $this->discountmat = $input;
    }

    Protected function get_gstmat() {
        return $this->gstmat;
    }

    Protected function set_gstmat($input) {
        $this->gstmat = $input;
    }

    Protected function get_totalamountmat() {
        return $this->totalamountmat;
    }

    Protected function set_totalamountmat($input) {
        $this->totalamountmat = $input;
    }

    Protected function get_amountpmach() {
        return $this->amountpmach;
    }

    Protected function set_amountpmach($input) {
        $this->amountpmach = $input;
    }

    Protected function get_discountpmach() {
        return $this->discountpmach;
    }

    Protected function set_discountpmach($input) {
        $this->discountpmach = $input;
    }

    Protected function get_gstpmach() {
        return $this->gstpmach;
    }

    Protected function set_gstpmach($input) {
        $this->gstpmach = $input;
    }

    Protected function get_totalamountpmach() {
        return $this->totalamountpmach;
    }

    Protected function set_totalamountpmach($input) {
        $this->totalamountpmach = $input;
    }

    Protected function get_amountcncmach() {
        return $this->amountcncmach;
    }

    Protected function set_amountcncmach($input) {
        $this->amountcncmach = $input;
    }

    Protected function get_discountcncmach() {
        return $this->discountcncmach;
    }

    Protected function set_discountcncmach($input) {
        $this->discountcncmach = $input;
    }

    Protected function get_gstcncmach() {
        return $this->gstcncmach;
    }

    Protected function set_gstcncmach($input) {
        $this->gstcncmach = $input;
    }

    Protected function get_totalamountcncmach() {
        return $this->totalamountcncmach;
    }

    Protected function set_totalamountcncmach($input) {
        $this->totalamountcncmach = $input;
    }

    Protected function get_amountother() {
        return $this->amountother;
    }

    Protected function set_amountother($input) {
        $this->amountother = $input;
    }

    Protected function get_discountother() {
        return $this->discountother;
    }

    Protected function set_discountother($input) {
        $this->discountother = $input;
    }

    Protected function get_gstother() {
        return $this->gstother;
    }

    Protected function set_gstother($input) {
        $this->gstother = $input;
    }

    Protected function get_totalamountother() {
        return $this->totalamountother;
    }

    Protected function set_totalamountother($input) {
        $this->totalamountother = $input;
    }

    Protected function get_totalamount() {
        return $this->totalamount;
    }

    Protected function set_totalamount($input) {
        $this->totalamount = $input;
    }

    Protected function get_aid_quo() {
        return $this->aid_quo;
    }

    Protected function set_aid_quo($input) {
        $this->aid_quo = $input;
    }

    Protected function get_aid_cus() {
        return $this->aid_cus;
    }

    Protected function set_aid_cus($input) {
        $this->aid_cus = $input;
    }

    Protected function get_datetimeissue_quo() {
        return $this->datetimeissue_quo;
    }

    Protected function set_datetimeissue_quo($input) {
        $this->datetimeissue_quo = $input;
    }

    Protected function get_olremarks() {
        return $this->olremarks;
    }

    Protected function set_olremarks($input) {
        $this->olremarks = $input;
    }

    Protected function get_date_issue() {
        return $this->date_issue;
    }

    Protected function set_date_issue($input) {
        $this->date_issue = $input;
    }

    Protected function get_completion_date() {
        return $this->completion_date;
    }

    Protected function set_completion_date($input) {
        $this->completion_date = $input;
    }

    Protected function get_source() {
        return $this->source;
    }

    Protected function set_source($input) {
        $this->source = $input;
    }

    Protected function get_cuttingtype() {
        return $this->cuttingtype;
    }

    Protected function set_cuttingtype($input) {
        $this->cuttingtype = $input;
    }

    Protected function get_tol_thkp() {
        return $this->tol_thkp;
    }

    Protected function set_tol_thkp($input) {
        $this->tol_thkp = $input;
    }

    Protected function get_tol_thkm() {
        return $this->tol_thkm;
    }

    Protected function set_tol_thkm($input) {
        $this->tol_thkm = $input;
    }

    Protected function get_tol_wdtp() {
        return $this->tol_wdtp;
    }

    Protected function set_tol_wdtp($input) {
        $this->tol_wdtp = $input;
    }

    Protected function get_tol_wdtm() {
        return $this->tol_wdtm;
    }

    Protected function set_tol_wdtm($input) {
        $this->tol_wdtm = $input;
    }

    Protected function get_tol_lghp() {
        return $this->tol_lghp;
    }

    Protected function set_tol_lghp($input) {
        $this->tol_lghp = $input;
    }

    Protected function get_tol_lghm() {
        return $this->tol_lghm;
    }

    Protected function set_tol_lghm($input) {
        $this->tol_lghm = $input;
    }

    Protected function get_chamfer() {
        return $this->chamfer;
    }

    Protected function set_chamfer($input) {
        $this->chamfer = $input;
    }

    Protected function get_flatness() {
        return $this->flatness;
    }

    Protected function set_flatness($input) {
        $this->flatness = $input;
    }

    Protected function get_ihremarks() {
        return $this->ihremarks;
    }

    Protected function set_ihremarks($input) {
        $this->ihremarks = $input;
    }

    Protected function get_ivremarks() {
        return $this->ivremarks;
    }

    Protected function set_ivremarks($input) {
        $this->ivremarks = $input;
    }

    Protected function get_ivpono() {
        return $this->ivpono;
    }

    Protected function set_ivpono($input) {
        $this->ivpono = $input;
    }

    Protected function get_custoolcode() {
        return $this->custoolcode;
    }

    Protected function set_custoolcode($input) {
        $this->custoolcode = $input;
    }

    Protected function get_runningno() {
        return $this->runningno;
    }

    Protected function set_runningno($input) {
        $this->runningno = $input;
    }

    Protected function get_jobno() {
        return $this->jobno;
    }

    Protected function set_jobno($input) {
        $this->jobno = $input;
    }

    Protected function get_ivdate() {
        return $this->ivdate;
    }

    Protected function set_ivdate($input) {
        $this->ivdate = $input;
    }

    Protected function get_aid_ol() {
        return $this->aid_ol;
    }

    Protected function set_aid_ol($input) {
        $this->aid_ol = $input;
    }

    Protected function get_datetimeissue_ol() {
        return $this->datetimeissue_ol;
    }

    Protected function set_datetimeissue_ol($input) {
        $this->datetimeissue_ol = $input;
    }

    Protected function get_jlissue() {
        return $this->jlissue;
    }

    Protected function set_jlissue($input) {
        $this->jlissue = $input;
    }

    Protected function get_jlreprint() {
        return $this->jlreprint;
    }

    Protected function set_jlreprint($input) {
        $this->jlreprint = $input;
    }

    Protected function get_jlreprintcount() {
        return $this->jlreprintcount;
    }

    Protected function set_jlreprintcount($input) {
        $this->jlreprintcount = $input;
    }

    Protected function get_docount() {
        return $this->docount;
    }

    Protected function set_docount($input) {
        $this->docount = $input;
    }

    Protected function get_dodate() {
        return $this->dodate;
    }

    Protected function set_dodate($input) {
        $this->dodate = $input;
    }

    Protected function get_doissue() {
        return $this->doissue;
    }

    Protected function set_doissue($input) {
        $this->doissue = $input;
    }

    Protected function get_doreprint() {
        return $this->doreprint;
    }

    Protected function set_doreprint($input) {
        $this->doreprint = $input;
    }

    Protected function get_doreprintcount() {
        return $this->doreprintcount;
    }

    Protected function set_doreprintcount($input) {
        $this->doreprintcount = $input;
    }

    Protected function get_driver() {
        return $this->driver;
    }

    Protected function set_driver($input) {
        $this->driver = $input;
    }

    Protected function get_policyno() {
        return $this->policyno;
    }

    Protected function set_policyno($input) {
        $this->policyno = $input;
    }

    Protected function get_aid_do() {
        return $this->aid_do;
    }

    Protected function set_aid_do($input) {
        $this->aid_do = $input;
    }

    Protected function get_stampsignature() {
        return $this->stampsignature;
    }

    Protected function set_stampsignature($input) {
        $this->stampsignature = $input;
    }

    Protected function get_aid_stampsignature() {
        return $this->aid_stampsignature;
    }

    Protected function set_aid_stampsignature($input) {
        $this->aid_stampsignature = $input;
    }

    Protected function get_datetime_stampsignature() {
        return $this->datetime_stampsignature;
    }

    Protected function set_datetime_stampsignature($input) {
        $this->datetime_stampsignature = $input;
    }

    Protected function get_ivissue() {
        return $this->ivissue;
    }

    Protected function set_ivissue($input) {
        $this->ivissue = $input;
    }

    Protected function get_ivreprint() {
        return $this->ivreprint;
    }

    Protected function set_ivreprint($input) {
        $this->ivreprint = $input;
    }

    Protected function get_ivreprintcount() {
        return $this->ivreprintcount;
    }

    Protected function set_ivreprintcount($input) {
        $this->ivreprintcount = $input;
    }

    Protected function get_operation() {
        return $this->operation;
    }

    Protected function set_operation($input) {
        $this->operation = $input;
    }

    Protected function get_jobcode() {
        return $this->jobcode;
    }

    Protected function set_jobcode($input) {
        $this->jobcode = $input;
    }

}

/**
Class ISSUE_ORDERLIST extends ORDERLIST {

    Protected $quono;
    Protected $issue_company;
    Protected $quono_dataset;
    Protected $issue_cuttingtype;
    Protected $issue_status;
    Protected $issue_inv_header_remarks;
    Protected $issue_inv_date;
    Protected $issue_period; //current period
    Protected $issue_ol_remarks;
    Protected $issue_date; //currentDate
    Protected $issue_datetime; //currentDateTime
    Protected $issue_array;

    Public function __construct($quono, $quono_dataset, $additionalData) {
        echo "++++==INSTANTIATE ISSUE_ORDERLIST CLASS==++++\n";
        $this->quono = $this->quono;
        echo "quono = $quono\n";
        $this->quono_dataset = $quono_dataset;
        echo "quono dataset = \n";
        print_r($this->quono_dataset);
        echo "\n";
        $this->set_AdditionalData($additionalData);
        Echo "additionalData = \n";
        print_r($additionalData);
        echo "\n";
        echo "Instantiate Parent Orderlist Scope....\n";
        $this->set_orderlistData($quono_dataset);        
        $this->generate_issue_array();
        echo "issue array result : \n";
        print_r($this->issue_array);
        echo "\n";
        echo "++++==END INSTANTIATE ISSUE_ORDERLIST CLASS==++++\n";
    }

    Public function test_class_variables() {
        echo "issue_status = " . $this->get_issue_status() . "\n";
        echo "issue_cuttingtype = " . $this->get_issue_cuttingtype() . "\n";
        echo "issue_inv_header_remarks = " . $this->get_issue_inv_header_remarks() . "\n";
        echo "issue_inv_date = " . $this->get_issue_inv_date() . "\n";
        echo "issue_period = " . $this->get_issue_period() . "\n";
        echo "issue_ol_remarks = " . $this->get_issue_ol_remarks() . "\n";
        echo "issue_date = " . $this->get_issue_date() . "\n";
    }

    Public function issue_Orderlist() {
        $issue_array = $this->get_issue_array();
        $issue_period = $this->get_issue_period();
        $issue_company = $this->get_issue_company();
        $ordtab = "orderlistnew_" . $issue_company . "_" . $issue_period;
        $cntArr = count($issue_array);
        $cnt = 0;
        $qrIns = "INSERT INTO $ordtab SET ";
        $qrIns2 = "INSERT INTO $ordtab SET \n";
        foreach ($issue_array as $ordKey => $ordVal) {
            $cnt++;
            $qrIns .= " $ordKey =:$ordKey ";
            $qrIns2 .= " $ordKey = $ordVal ";
            if ($cnt != $cntArr) {
                $qrIns .= " , ";
                $qrIns2 .= " , \n";
            }
        }
        echo $qrIns2;
        $objSQL = new SQLBINDPARAM($qrIns, $issue_array);
        $result = $objSQL->InsertData2();
        if ($result == 'insert ok!') {
            $info = 'Insert Successful!';
        } else {
            $info = 'Insert Failed';
        }
        return $info;
    }

    Protected function set_AdditionalData($additionalData) {
        $this->set_issue_company($additionalData['company']);
        $this->set_issue_cuttingtype($additionalData['cuttingtype']);
        if ($additionalData['billing'] == "false") {
            ##$status = 'active';
        } else {
            ##$status = 'billing';
        }
        $this->set_issue_status($status);
        $this->set_issue_inv_header_remarks($additionalData['inv_header_remarks']);
        $this->set_issue_inv_date($additionalData['inv_date']);
        $objPeriod = new Period();
        $currPeriod = $objPeriod->getcurrentPeriod(); //Use the current period as issue period
        $this->set_issue_period($currPeriod);
        $this->set_issue_ol_remarks($additionalData['ol_remarks']);
        $issue_date = date_format(date_create(), "Y-m-d");
        $issue_time = date_format(date_create(), "H:i:s");
        $issue_datetime = $issue_date . " " . $issue_time;
        if ($issue_time > "08:00:00" && $issue_time < "17:00:59") {
            
        } else {
            $objIssueDT = new DateTime($issue_datetime);
            date_add($objIssueDT, date_interval_create_from_date_string('1 days'));
            $issue_date = $objIssueDT->format('Y-m-d');
        }
        $this->set_issue_date($issue_date);
        $this->set_issue_datetime($issue_datetime);
    }

    Protected function get_OL_no_position() {
        $com = $this->get_issue_company();
        $period = $this->get_issue_period();
        $quono = $this->quono;
        $qr = "SELECT COUNT(*) FROM orderlistnew_{$com}_{$period} WHERE quono = '$quono'";
        $objSQL = new SQL($qr);
        $noposition = $objSQL->getRowCount();
        return $noposition + 1;
    }

    Protected function set_orderlistData($quono_dataset) {
        $dat = $quono_dataset;
        $this->set_bid($dat['bid']);         //called from quotation
        $this->set_currency($dat['currency']);    //called from quotation
        $this->set_qid($dat['qid']);         //called from quotation
        $this->set_quono($dat['quono']);       //called from quotation
        $this->set_company($dat['company']);     //called from quotation
        $this->set_cusstatus($dat['cusstatus']);   //called from quotation
        $this->set_cid($dat['cid']);         //called from quotation
        $this->set_accno($dat['accno']);       //called from quotation
        $this->set_date($dat['date']);        //called from quotation
        $this->set_terms($dat['terms']);       //called from quotation
        $this->set_noposition($this->get_OL_no_position());  //Generate based on existing record in orderlist
        $this->set_item($dat['item']);        //called from quotation
        $this->set_quantity($dat['quantity']);    //called from quotation
        $this->set_grade($dat['grade']);       //called from quotation
        $this->set_mdt($dat['mdt']);         //called from quotation
        $this->set_mdw($dat['mdw']);
        $this->set_mdl($dat['mdl']);
        $this->set_dim_desp($dat['dim_desp']);
        $this->set_fdt($dat['fdt']);
        $this->set_fdw($dat['fdw']);
        $this->set_fdl($dat['fdl']);
        $this->set_finishing_dim_desp($dat['finishing_dim_desp']);
        $this->set_process($dat['process']);
        $this->set_mat($dat['mat']);
        $this->set_pmach($dat['pmach']);
        $this->set_cncmach($dat['cncmach']);
        $this->set_other($dat['other']);
        $this->set_Shape_Code($dat['Shape_Code']);
        $this->set_Category($dat['Category']);
        $this->set_tabletype($dat['tabletype']);
        $this->set_vat(null);
        $this->set_gst(null);
        $this->set_ftz($dat['ftz']);
        $this->set_amountmat($dat['amountmat']);
        $this->set_discountmat($dat['discountmat']);
        $this->set_gstmat($dat['gstmat']);
        $this->set_totalamountmat($dat['totalamountmat']);
        $this->set_amountpmach($dat['amountpmach']);
        $this->set_discountpmach($dat['discountpmach']);
        $this->set_gstpmach($dat['gstpmach']);
        $this->set_totalamountpmach($dat['totalamountpmach']);
        $this->set_amountcncmach($dat['amountcncmach']);
        $this->set_discountcncmach($dat['discountcncmach']);
        $this->set_gstcncmach($dat['gstcncmach']);
        $this->set_totalamountcncmach($dat['totalamountcncmach']);
        $this->set_amountother($dat['amountother']);
        $this->set_discountother($dat['discountother']);
        $this->set_gstother($dat['gstother']);
        $this->set_totalamountother($dat['totalamountother']);
        $this->set_totalamount($dat['totalamount']);
        $this->set_aid_quo($dat['aid_quo']);
        $this->set_aid_cus($dat['aid_cus']);
        $this->set_datetimeissue_quo($dat['datetimeissue']); //datetimeissue column of quotationnew
        $this->set_olremarks($this->get_issue_ol_remarks());   //from issue orderlist
        $this->set_date_issue($this->get_issue_date());  //date now
        $this->set_completion_date(""); //null
        $this->set_source('PST');      //from issue orderlist -- note :testing uses PST
        $this->set_cuttingtype($this->get_issue_cuttingtype()); //from issue orderlist
        $this->set_tol_thkp(0.10);  //testing value, 
        $this->set_tol_thkm(0.00);  //testing value,
        $this->set_tol_wdtp(0.10);  //testing value,
        $this->set_tol_wdtm(0.00);  //testing value,
        $this->set_tol_lghp(0.10);  //testing value,
        $this->set_tol_lghm(0.00);  //testing value,
        $this->set_chamfer(0.0);      //testing value,
        $this->set_flatness('no');     //testing value,
        $this->set_ihremarks($this->get_issue_inv_header_remarks());    //from invoice header remarks,
        $this->set_ivremarks(null);    //testing value,
        $this->set_ivpono(null);      //testing value,
        $this->set_custoolcode(null);  //testing value,
        $this->set_runningno(9900);    //make generation for this,
        $this->set_jobno($this->get_OL_no_position());        //the same as noposition
        $this->set_ivdate($this->get_issue_inv_date());       //Invoice issue date,
        $this->set_aid_ol(100);       //testing value,
        $this->set_datetimeissue_ol($this->get_issue_datetime()); //datetime
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
        $this->set_operation(1); //testing value,
        $this->set_jobcode('testjobcode here'); //testing value,
    }

    Protected function generate_issue_array() {
        $issue_array = array(
            'bid' => $this->get_bid(),
            'currency' => $this->get_currency(),
            'qid' => $this->get_qid(),
            'quono' => $this->get_quono(),
            'company' => $this->get_company(),
            'cusstatus' => $this->get_cusstatus(),
            'cid' => $this->get_cid(),
            'accno' => $this->get_accno(),
            'date' => $this->get_date(),
            'terms' => $this->get_terms(),
            'noposition' => $this->get_noposition(),
            'item' => $this->get_item(),
            'quantity' => $this->get_quantity(),
            'grade' => $this->get_grade(),
            'mdt' => $this->get_mdt(),
            'mdw' => $this->get_mdw(),
            'mdl' => $this->get_mdl(),
            'dim_desp' => $this->get_dim_desp(),
            'fdt' => $this->get_fdt(),
            'fdw' => $this->get_fdw(),
            'fdl' => $this->get_fdl(),
            'finishing_dim_desp' => $this->get_finishing_dim_desp(),
            'process' => $this->get_process(),
            'mat' => $this->get_mat(),
            'pmach' => $this->get_pmach(),
            'cncmach' => $this->get_cncmach(),
            'other' => $this->get_other(),
            'Shape_Code' => $this->get_Shape_Code(),
            'Category' => $this->get_Category(),
            'tabletype' => $this->get_tabletype(),
            'vat' => $this->get_vat(),
            'gst' => $this->get_gst(),
            'ftz' => $this->get_ftz(),
            'amountmat' => $this->get_amountmat(),
            'discountmat' => $this->get_discountmat(),
            'gstmat' => $this->get_gstmat(),
            'totalamountmat' => $this->get_totalamountmat(),
            'amountpmach' => $this->get_amountpmach(),
            'discountpmach' => $this->get_discountpmach(),
            'gstpmach' => $this->get_gstpmach(),
            'totalamountpmach' => $this->get_totalamountpmach(),
            'amountcncmach' => $this->get_amountcncmach(),
            'discountcncmach' => $this->get_discountcncmach(),
            'gstcncmach' => $this->get_gstcncmach(),
            'totalamountcncmach' => $this->get_totalamountcncmach(),
            'amountother' => $this->get_amountother(),
            'discountother' => $this->get_discountother(),
            'gstother' => $this->get_gstother(),
            'totalamountother' => $this->get_totalamountother(),
            'totalamount' => $this->get_totalamount(),
            'aid_quo' => $this->get_aid_quo(),
            'aid_cus' => $this->get_aid_cus(),
            'datetimeissue_quo' => $this->get_datetimeissue_quo(),
            'olremarks' => $this->get_olremarks(),
            'date_issue' => $this->get_date_issue(),
            'completion_date' => $this->get_completion_date(),
            'source' => $this->get_source(),
            'cuttingtype' => $this->get_cuttingtype(),
            'tol_thkp' => $this->get_tol_thkp(),
            'tol_thkm' => $this->get_tol_thkm(),
            'tol_wdtp' => $this->get_tol_wdtp(),
            'tol_wdtm' => $this->get_tol_wdtm(),
            'tol_lghp' => $this->get_tol_lghp(),
            'tol_lghm' => $this->get_tol_lghm(),
            'chamfer' => $this->get_chamfer(),
            'flatness' => $this->get_flatness(),
            'ihremarks' => $this->get_ihremarks(),
            'ivremarks' => $this->get_ivremarks(),
            'ivpono' => $this->get_ivpono(),
            'custoolcode' => $this->get_custoolcode(),
            'runningno' => $this->get_runningno(),
            'jobno' => $this->get_jobno(),
            'ivdate' => $this->get_ivdate(),
            'aid_ol' => $this->get_aid_ol(),
            'datetimeissue_ol' => $this->get_datetimeissue_ol(),
            'operation' => $this->get_operation(),
            'jobcode' => $this->get_jobcode(),
        );
        $this->set_issue_array($issue_array);
    }

    Protected function set_issue_array($input) {
        $this->issue_array = $input;
    }

    Protected function get_issue_array() {
        return $this->issue_array;
    }

    Protected function set_issue_company($input) {
        $this->issue_company = $input;
    }

    Protected function get_issue_company() {
        return $this->issue_company;
    }

    Protected function set_issue_cuttingtype($input) {
        $this->issue_cuttingtype = $input;
    }

    Protected function get_issue_cuttingtype() {
        return $this->issue_cuttingtype;
    }

    Protected function set_issue_status($input) {
        $this->issue_status = $input;
    }

    Protected function get_issue_status() {
        return $this->issue_status;
    }

    Protected function set_issue_inv_header_remarks($input) {
        $this->issue_inv_header_remarks = $input;
    }

    Protected function get_issue_inv_header_remarks() {
        return $this->issue_inv_header_remarks;
    }

    Protected function set_issue_inv_date($input) {
        $this->issue_inv_date = $input;
    }

    Protected function get_issue_inv_date() {
        return $this->issue_inv_date;
    }

    Protected function set_issue_period($input) {
        $this->issue_period = $input;
    }

    Protected function get_issue_period() {
        return $this->issue_period;
    }

    Protected function set_issue_ol_remarks($input) {
        $this->issue_ol_remarks = $input;
    }

    Protected function get_issue_ol_remarks() {
        return $this->issue_ol_remarks;
    }

    Protected function set_issue_date($input) {
        $this->issue_ol_date = $input;
    }

    Protected function get_issue_date() {
        return $this->issue_ol_date;
    }

    Protected function set_issue_datetime($input) {
        $this->issue_ol_datetime = $input;
    }

    Protected function get_issue_datetime() {
        return $this->issue_ol_datetime;
    }

}
 * 
 */
