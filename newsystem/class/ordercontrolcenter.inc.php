<?php

Class ORDERCONTROLCENTER {

    private $ocid; //key , auto_increment;
    private $oid; //orderlist key
    private $qid; //quotation key;
    private $quono; //quono
    private $quono_period; //period issue of quotation
    private $orderlist_period; // period issue of orderlist
    private $revisecount; //number of revises done
    private $remarks1; //remarks
    private $remarks2; //remarks
    private $ocid_parent; //key of parent record (revised from)
    private $ocid_child; //key of child record (revise result)

    Public function __construct($oid, $qid, $orderlist_period) {
        $occ_dataset = $this->get_records($oid, $qid, $orderlist_period);
        $this->ocid = $occ_dataset['ocid'];
        $this->oid = $occ_dataset['oid'];
        $this->qid = $occ_dataset['qid'];
        $this->quono = $occ_dataset['quono'];
        $this->quono_period = $occ_dataset['quono_period'];
        $this->orderlist_period = $occ_dataset['orderlist_period'];
        $this->revisecount = $occ_dataset['revisecount'];
        $this->remarks1 = $occ_dataset['remarks1'];
        $this->remarks2 = $occ_dataset['remarks2'];
        $this->ocid_parent = $occ_dataset['ocid_parent'];
        $this->ocid_child = $occ_dataset['ocid_child'];;
    }

    Private function get_records($oid, $qid, $orderlist_period) {
        $qr = "SELECT * FROM ordercontrolcenter WHERE oid = $oid AND qid = $qid AND orderlist_period = '$orderlist_period'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        if (!empty($result)) {
            return $result;
        } else {
            return 'fail';
        }
    }

    Public function update_reviseOCC($new_quono, $new_ocid) {
        $old_ocid = $this->get_ocid();
        $old_quono = $this->get_quono();
        $remarks1 = $this->get_remarks1();
        $date = date('Y-m-d');
        $new_remarks = $remarks1 . "\n" . "$date : Revised Price and/or Dimension." . "\n" . "Changed Quotation from $old_quono to $new_quono (OCID = $new_ocid)";
        $qrUpd = "UPDATE ordercontrolcenter SET remarks1 = '$new_remarks', ocid_child = $new_ocid WHERE ocid = $old_ocid";
        $objSQL = new SQL($qrUpd);
        $updResult = $objSQL->getUpdate();
        #echo "qr = $qrUpd\n";
        if ($updResult == 'updated') {
            return 'ok';
        } else {
            return 'fail';
        }
    }

    Function set_ocid($input) {
        $this->ocid = $input;
    }

    Function get_ocid() {
        return $this->ocid;
    }

    Function set_oid($input) {
        $this->oid = $input;
    }

    Function get_oid() {
        return $this->oid;
    }

    Function set_qid($input) {
        $this->qid = $input;
    }

    Function get_qid() {
        return $this->qid;
    }

    Function set_quono($input) {
        $this->quono = $input;
    }

    Function get_quono() {
        return $this->quono;
    }

    Function set_quono_period($input) {
        $this->quono_period = $input;
    }

    Function get_quono_period() {
        return $this->quono_period;
    }

    Function set_orderlist_period($input) {
        $this->orderlist_period = $input;
    }

    Function get_orderlist_period() {
        return $this->orderlist_period;
    }

    Function set_revisecount($input) {
        $this->revisecount = $input;
    }

    Function get_revisecount() {
        return $this->revisecount;
    }

    Function set_remarks1($input) {
        $this->remarks1 = $input;
    }

    Function get_remarks1() {
        return $this->remarks1;
    }

    Function set_remarks2($input) {
        $this->remarks2 = $input;
    }

    Function get_remarks2() {
        return $this->remarks2;
    }

    Function set_ocid_parent($input) {
        $this->ocid_parent = $input;
    }

    Function get_ocid_parent() {
        return $this->ocid_parent;
    }

    Function set_ocid_child($input) {
        $this->ocid_child = $input;
    }

    Function get_ocid_child() {
        return $this->ocid_child;
    }


}
