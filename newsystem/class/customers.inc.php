<?php

include_once("dbh.inc.php");
include_once("variables.inc.php");

//function redirect($url) {
//    ob_start();
//    header('Location: '.$url);
//    ob_end_flush();
//    die();
//}
class Customers {
    ## properties
//    $accno
//    $co_name
//    $co_no
//    $co_code
//    $address1
//    $address2
//    $address3
//    $country
//    $telephone_sales
//    $fax_sales
//    $handphone_sales
//    $email_sales
//    $attn_sales
//    $telehpone_acc
//    $fax_acc
//    $handphone_acc
//    $email_acc
//    $attn_acc
//    $groups
//    $aid_cus
//    $terms
//    $credit_limit
//    $currency
//    $company
//    $status
//    $date_created
//    $remark
//    $credit_use
//    $one_do_one_inv
//    $can_not_migrate
//    $regular
//    $nobusy

    protected $getPostData;
    public $cid;

    public function __construct() {

        $this->getPostData = [];
    }

    public function customer_list() {

        $sql = "SELECT * FROM customer_list ORDER BY cid asc ";
        $objSQL = new SQL($sql);
        $result = $objSQL->getResultRowArray();

        return $result;
    }

    public function customer_list_numrowas() {

        $sql = "SELECT count(*) FROM customer_list ORDER BY cid ";
        $objSQL = new SQL($sql);
        // $result=  $this->conn->query($sql);
        $result = $objSQL->getRowCount();
        return $result;
    }

    public function create_customer_info($post_data = array()) {

        $this->getPostData = $post_data;
        $cid = $post_data['cid'];
        $this->cid = $cid;
        print_r($post_data);
        //    $accno
//    $co_name
//    $co_no
//    $co_code
//    $address1
//    $address2
//    $address3
//    $country
//    $telephone_sales
//    $fax_sales
//    $handphone_sales
//    $email_sales
//    $attn_sales
//    $telehpone_acc
//    $fax_acc
//    $handphone_acc
//    $email_acc
//    $attn_acc
//    $groups
//    $aid_cus
//    $terms
//    $credit_limit
//    $currency
//    $company
//    $status
//    $date_created
//    $remark
//    $credit_use
//    $one_do_one_inv
//    $can_not_migrate
//    $regular
//    $nobusy       
        if (isset($post_data['create_customer'])) {
            $accno = trim($post_data['accno']);
            $co_name = trim($post_data['co_name']);
            $co_no = trim($post_data['co_no']);
            $co_code = trim($post_data['co_code']);
            $address1 = trim($post_data['address1']);
            $address2 = trim($post_data['address2']);
            $address3 = trim($post_data['address3']);
            $country = trim($post_data['country']);
            $telephone_sales = trim($post_data['telephone_sales']);
            $fax_sales = trim($post_data['fax_sales']);
            $handphone_sales = trim($post_data['handphone_sales']);
            $email_sales = trim($post_data['email_sales']);
            $attn_sales = trim($post_data['attn_sales']);
            $telehpone_acc = trim($post_data['telehpone_acc']);
            $fax_acc = trim($post_data['fax_acc']);
            $handphone_acc = trim($post_data['handphone_acc']);
            $email_acc = trim($post_data['email_acc']);
            $attn_acc = trim($post_data['attn_acc']);
            $groups = trim($post_data['groups']);
            $aid_cus = trim($post_data['aid_cus']);
            $terms = trim($post_data['terms']);
            $credit_limit = trim($post_data['credit_limit']);
            $currency = trim($post_data['currency']);
            $company = trim($post_data['company']);
            $status = trim($post_data['status']);
            $date_created = trim($post_data['date_created']);
            $remarks = trim($post_data['remarks']);
            $credit_used = trim($post_data['credit_used']);
            $one_do_one_inv = trim($post_data['one_do_one_inv']);
            $cannot_migrate = trim($post_data['cannot_migrate']);
            $regular = trim($post_data['regular']);
            $nobusy = trim($post_data['nobusy']);
            $sql = "INSERT INTO customer_list ("
                    . "accno, co_name, co_no, co_code, address1,address2,address3,"
                    . "country, telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales,"
                    . "telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc, groups,"
                    . "aid_cus, terms, credit_limit, currency, company, status, "
                    . "date_created, remarks, credit_used, one_do_one_inv, cannot_migrate, regular, nobusy"
                    . ")"
                    . "VALUES ('$accno','$co_name', '$co_no', '$co_code', '$address1','$address2','$address3',"
                    . "'$country', '$telephone_sales', '$fax_sales', '$handphone_sales', '$email_sales', '$attn_sales',"
                    . "'$telehpone_acc', '$fax_acc', '$handphone_acc', '$email_acc', '$attn_acc', '$groups',"
                    . "'$aid_cus', '$terms', '$credit_limit', '$currency', '$company', '$status',"
                    . "'$date_created', '$remarks', '$credit_used', '$one_do_one_inv', '$cannot_migrate', '$regular', '$nobusy'"
                    . ") WHERE cid = $cid ";

//        $result=  $this->conn->query($sql);
            $objSQL = new SQL($sql);

            $result = $objSQL->InsertData();

            if ($result == 'insert ok!') {

                $_SESSION['message'] = "Successfully Created Student Info";
                echo "Successfully Created Customer Info<br>";

                header('Location: index.php');
            } else {
                $error = "Fail to Created Customer Info <br>";
                $_SESSION['message'] = "Please check this \$sql -> $sql";
                $url = "customercreatefail.php?err=$error";
                //    redirect($url);
                //header('Location: customercreatefail.php?err=$error');
            }

            unset($post_data['create_customer']);
        }
    }

    public function view_customer_by_cid($cid) {

        if (isset($cid)) {

//       $student_id= mysqli_real_escape_string($this->conn,trim($id));
            $cid = trim($cid);

            $sql = "Select * from customer_list where cid='$cid'";
            //echo "line 181, \$sql = $sql <br>"; 

            $objSQL = new SQL($sql);

            $result = $objSQL->getResultOneRowArray();
            return $result;
        }
    }

    public function update_customer_info($post_data = array()) {
        echo "print_r(\$post_data)";
        print_r($post_data);
        echo "<br>";
        $cid = $post_data['cid'];

        if (isset($post_data['update_customer']) && isset($post_data['cid'])) {

            //       $student_name= mysqli_real_escape_string($this->conn,trim($post_data['student_name']));
            //       $email_address= mysqli_real_escape_string($this->conn,trim($post_data['email_address']));
            //       $gender= mysqli_real_escape_string($this->conn,trim($post_data['gender']));
            //       $contact= mysqli_real_escape_string($this->conn,trim($post_data['contact']));
            //       $country= mysqli_real_escape_string($this->conn,trim($post_data['country']));
            //       $student_id= mysqli_real_escape_string($this->conn,trim($post_data['id']));
            $accno = trim($post_data['accno']);
            $co_name = trim($post_data['co_name']);
            $co_no = trim($post_data['co_no']);
            $co_code = trim($post_data['co_code']);
            $address1 = trim($post_data['address1']);
            $address2 = trim($post_data['address2']);
            $address3 = trim($post_data['address3']);
            $country = trim($post_data['country']);
            $telephone_sales = trim($post_data['telephone_sales']);
            $fax_sales = trim($post_data['fax_sales']);
            $handphone_sales = trim($post_data['handphone_sales']);
            $email_sales = trim($post_data['email_sales']);
            $attn_sales = trim($post_data['attn_sales']);
            $telephone_acc = trim($post_data['telephone_acc']);
            $fax_acc = trim($post_data['fax_acc']);
            $handphone_acc = trim($post_data['handphone_acc']);
            $email_acc = trim($post_data['email_acc']);
            $attn_acc = trim($post_data['attn_acc']);
            $groups = trim($post_data['groups']);
            $aid_cus = trim($post_data['aid_cus']);
            $terms = trim($post_data['terms']);
            $credit_limit = trim($post_data['credit_limit']);
            $currency = trim($post_data['currency']);
            $company = trim($post_data['company']);
            $status = trim($post_data['status']);
            $date_created = trim($post_data['date_created']);
            $remarks = trim($post_data['remarks']);
            $credit_used = trim($post_data['credit_used']);
            $one_do_one_inv = trim($post_data['one_do_one_inv']);
            $cannot_migrate = trim($post_data['cannot_migrate']);
            $regular = trim($post_data['regular']);
            $nobusy = trim($post_data['nobusy']);
            // co_name, co_no, co_code, address1,address2,address3,"
            // . "country, telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales,"
            // . "telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc, groups,"
            // . "aid_cus, terms, credit_limit, currency, company, status, "
            // . "date_created, remarks, credit_used, one_do_one_inv, cannot_migrate, regular, nobusy"

            $sql = "UPDATE customer_list SET "
                    . " accno='$accno', co_name='$co_name',co_no='$co_no', co_code='$co_code', address1='$address1', "
                    . " address2='$address2', address3='$address3', country='$country', telephone_sales='$telephone_sales', "
                    . " fax_sales='$fax_sales', handphone_sales='$handphone_sales', email_sales='$email_sales', attn_sales='$attn_sales', "
                    . " telephone_acc='$telephone_acc', fax_acc='$fax_acc', handphone_acc='$handphone_acc', email_acc='$email_acc',  "
                    . " attn_acc='$attn_acc', groups='$groups', aid_cus='$aid_cus', terms='$terms', credit_limit='$credit_limit',  "
                    . " currency='$currency', company='$company', status='$status', date_created='$date_created', remarks='$remarks', "
                    . " credit_used='$credit_used', one_do_one_inv='$one_do_one_inv', cannot_migrate='$cannot_migrate', "
                    . " regular='$regular', nobusy='$nobusy' "
                    . " WHERE cid = $cid ";

            $objSQL = new SQL($sql);

            $result = $objSQL->getUpdate();

            //    if($result == 'updated'){
            //        $_SESSION['message']="Successfully Updated Student Info";
            //    }

            if ($result == 'updated') {

                $_SESSION['message'] = "Successfully  Update Customer Info";
                echo "Successfully Created Customer Info<br>";
                $url = "index.php";
                // redirect($url);
                //    header('Location: index.php');
            } else {
                $error = "Fail to Update Customer Info <br>";
                $_SESSION['message'] = "Please check this \$sql -> $sql";
                $url = "index.php";
                redirect($url);
                //header('Location: customercreatefail.php?err=$error');
            }
            unset($post_data['update_customer']);
        }
    }

    public function delete_customer_info_by_id($cid) {

        // $cid = $this->cid;
        echo "\$cid = $cid <br>";
        if (isset($cid)) {
//       $student_id= mysqli_real_escape_string($this->conn,trim($cid));
            $cid = trim($cid);

            $sql = "DELETE FROM  customer_list  WHERE cid =$cid";
//        $result=  $this->conn->query($sql);
            echo "\$sql= $sql<br>";
            $objSQL = new SQL($sql);

            $result = $objSQL->getUpdate();
            if ($result) {
                $_SESSION['message'] = "Successfully Deleted Student Info";
            }
        }
        header('Location: index.php');
    }

    function __destruct() {
//    mysqli_close($this->conn);  
    }

}

class Customers2 {
    ## properties
//    $accno
//    $co_name
//    $co_no
//    $co_code
//    $address1
//    $address2
//    $address3
//    $country
//    $telephone_sales
//    $fax_sales
//    $handphone_sales
//    $email_sales
//    $attn_sales
//    $telehpone_acc
//    $fax_acc
//    $handphone_acc
//    $email_acc
//    $attn_acc
//    $groups
//    $aid_cus
//    $terms
//    $credit_limit
//    $currency
//    $company
//    $status
//    $date_created
//    $remark
//    $credit_use
//    $one_do_one_inv
//    $can_not_migrate
//    $regular
//    $nobusy

    protected $getPostData;
    public $cid;
    public $com;
    public $customertable;

    public function __construct($com) {
        #echo "Initialize Customers2 Class - Line 355<br>";
        $this->com = $com;
        $this->customertable = "customer_" . trim(strtolower($com));
        $this->getPostData = [];
    }

    public function customer_list() {
        $tblname = $this->customertable;
        $sql = "SELECT * FROM $tblname ORDER BY cid asc ";
        $objSQL = new SQL($sql);
        $result = $objSQL->getResultRowArray();

        return $result;
    }

    public function customer_list_numrowas() {
        $tblname = $this->customertable;

        $sql = "SELECT count(*) FROM $tblname ORDER BY cid ";
        $objSQL = new SQL($sql);
        // $result=  $this->conn->query($sql);
        $result = $objSQL->getRowCount();
        return $result;
    }

    public function create_customer_info($post_data = array()) {
        $tblname = $this->customertable;
        $this->getPostData = $post_data;
        $cid = $post_data['cid'];
        $this->cid = $cid;
        print_r($post_data);
        //    $accno
//    $co_name
//    $co_no
//    $co_code
//    $address1
//    $address2
//    $address3
//    $country
//    $telephone_sales
//    $fax_sales
//    $handphone_sales
//    $email_sales
//    $attn_sales
//    $telehpone_acc
//    $fax_acc
//    $handphone_acc
//    $email_acc
//    $attn_acc
//    $groups
//    $aid_cus
//    $terms
//    $credit_limit
//    $currency
//    $company
//    $status
//    $date_created
//    $remark
//    $credit_use
//    $one_do_one_inv
//    $can_not_migrate
//    $regular
//    $nobusy       
        if (isset($post_data['create_customer'])) {
            $accno = trim($post_data['accno']);
            $co_name = trim($post_data['co_name']);
            $co_no = trim($post_data['co_no']);
            $co_code = trim($post_data['co_code']);
            $address1 = trim($post_data['address1']);
            $address2 = trim($post_data['address2']);
            $address3 = trim($post_data['address3']);
            $country = trim($post_data['country']);
            $telephone_sales = trim($post_data['telephone_sales']);
            $fax_sales = trim($post_data['fax_sales']);
            $handphone_sales = trim($post_data['handphone_sales']);
            $email_sales = trim($post_data['email_sales']);
            $attn_sales = trim($post_data['attn_sales']);
            $telehpone_acc = trim($post_data['telehpone_acc']);
            $fax_acc = trim($post_data['fax_acc']);
            $handphone_acc = trim($post_data['handphone_acc']);
            $email_acc = trim($post_data['email_acc']);
            $attn_acc = trim($post_data['attn_acc']);
            $groups = trim($post_data['groups']);
            $aid_cus = trim($post_data['aid_cus']);
            $terms = trim($post_data['terms']);
            $credit_limit = trim($post_data['credit_limit']);
            $currency = trim($post_data['currency']);
            $company = trim($post_data['company']);
            $status = trim($post_data['status']);
            $date_created = trim($post_data['date_created']);
            $remarks = trim($post_data['remarks']);
            $credit_used = trim($post_data['credit_used']);
            $one_do_one_inv = trim($post_data['one_do_one_inv']);
            $cannot_migrate = trim($post_data['cannot_migrate']);
            $regular = trim($post_data['regular']);
            $nobusy = trim($post_data['nobusy']);
            $sql = "INSERT INTO $tblname ("
                    . "accno, co_name, co_no, co_code, address1,address2,address3,"
                    . "country, telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales,"
                    . "telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc, groups,"
                    . "aid_cus, terms, credit_limit, currency, company, status, "
                    . "date_created, remarks, credit_used, one_do_one_inv, cannot_migrate, regular, nobusy"
                    . ")"
                    . "VALUES ('$accno','$co_name', '$co_no', '$co_code', '$address1','$address2','$address3',"
                    . "'$country', '$telephone_sales', '$fax_sales', '$handphone_sales', '$email_sales', '$attn_sales',"
                    . "'$telehpone_acc', '$fax_acc', '$handphone_acc', '$email_acc', '$attn_acc', '$groups',"
                    . "'$aid_cus', '$terms', '$credit_limit', '$currency', '$company', '$status',"
                    . "'$date_created', '$remarks', '$credit_used', '$one_do_one_inv', '$cannot_migrate', '$regular', '$nobusy'"
                    . ") WHERE cid = $cid ";

//        $result=  $this->conn->query($sql);
            $objSQL = new SQL($sql);

            $result = $objSQL->InsertData();

            if ($result == 'insert ok!') {

                $_SESSION['message'] = "Successfully Created Customer Info";
                echo "Successfully Created Customer Info<br>";

                header('Location: index.php');
            } else {
                $error = "Fail to Created Customer Info <br>";
                $_SESSION['message'] = "Please check this \$sql -> $sql";
                $url = "customercreatefail.php?err=$error";
                //    redirect($url);
                //header('Location: customercreatefail.php?err=$error');
            }

            unset($post_data['create_customer']);
        }
    }

    public function view_customer_by_cid($cid) {
        #echo "Function View_Customer_by_cid - line 489<br>";
        $tblname = $this->customertable;
        if (isset($cid)) {

//       $student_id= mysqli_real_escape_string($this->conn,trim($id));
            $cid = trim($cid);

            $sql = "Select * from $tblname where cid='$cid'";
            #echo "line 497, \$sql = $sql <br>"; 

            $objSQL = new SQL($sql);

            $result = $objSQL->getResultOneRowArray();
            return $result;
        }
    }

    public function update_customer_info($post_data = array()) {
        $tblname = $this->customertable;
        #echo "print_r(\$post_data)";
        #print_r($post_data);
        #echo "<br>";
        $cid = $post_data['cid'];

        if (isset($post_data['update_customer']) && isset($post_data['cid'])) {

            //       $student_name= mysqli_real_escape_string($this->conn,trim($post_data['student_name']));
            //       $email_address= mysqli_real_escape_string($this->conn,trim($post_data['email_address']));
            //       $gender= mysqli_real_escape_string($this->conn,trim($post_data['gender']));
            //       $contact= mysqli_real_escape_string($this->conn,trim($post_data['contact']));
            //       $country= mysqli_real_escape_string($this->conn,trim($post_data['country']));
            //       $student_id= mysqli_real_escape_string($this->conn,trim($post_data['id']));
            $accno = trim($post_data['accno']);
            $co_name = trim($post_data['co_name']);
            $co_no = trim($post_data['co_no']);
            $co_code = trim($post_data['co_code']);
            $address1 = trim($post_data['address1']);
            $address2 = trim($post_data['address2']);
            $address3 = trim($post_data['address3']);
            $country = trim($post_data['country']);
            $telephone_sales = trim($post_data['telephone_sales']);
            $fax_sales = trim($post_data['fax_sales']);
            $handphone_sales = trim($post_data['handphone_sales']);
            $email_sales = trim($post_data['email_sales']);
            $attn_sales = trim($post_data['attn_sales']);
            $telephone_acc = trim($post_data['telephone_acc']);
            $fax_acc = trim($post_data['fax_acc']);
            $handphone_acc = trim($post_data['handphone_acc']);
            $email_acc = trim($post_data['email_acc']);
            $attn_acc = trim($post_data['attn_acc']);
            $groups = trim($post_data['groups']);
            $aid_cus = trim($post_data['aid_cus']);
            $terms = trim($post_data['terms']);
            $credit_limit = trim($post_data['credit_limit']);
            $currency = trim($post_data['currency']);
            $company = trim($post_data['company']);
            $status = trim($post_data['status']);
            $date_created = trim($post_data['date_created']);
            $remarks = trim($post_data['remarks']);
            $credit_used = trim($post_data['credit_used']);
            $one_do_one_inv = trim($post_data['one_do_one_inv']);
            $cannot_migrate = trim($post_data['cannot_migrate']);
            $regular = trim($post_data['regular']);
            $nobusy = trim($post_data['nobusy']);
            // co_name, co_no, co_code, address1,address2,address3,"
            // . "country, telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales,"
            // . "telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc, groups,"
            // . "aid_cus, terms, credit_limit, currency, company, status, "
            // . "date_created, remarks, credit_used, one_do_one_inv, cannot_migrate, regular, nobusy"

            $sql = "UPDATE $tblname SET "
                    . " accno='$accno', co_name='$co_name',co_no='$co_no', co_code='$co_code', address1='$address1', "
                    . " address2='$address2', address3='$address3', country='$country', telephone_sales='$telephone_sales', "
                    . " fax_sales='$fax_sales', handphone_sales='$handphone_sales', email_sales='$email_sales', attn_sales='$attn_sales', "
                    . " telephone_acc='$telephone_acc', fax_acc='$fax_acc', handphone_acc='$handphone_acc', email_acc='$email_acc',  "
                    . " attn_acc='$attn_acc', groups='$groups', aid_cus='$aid_cus', terms='$terms', credit_limit='$credit_limit',  "
                    . " currency='$currency', company='$company', status='$status', date_created='$date_created', remarks='$remarks', "
                    . " credit_used='$credit_used', one_do_one_inv='$one_do_one_inv', cannot_migrate='$cannot_migrate', "
                    . " regular='$regular', nobusy='$nobusy' "
                    . " WHERE cid = $cid ";

            $objSQL = new SQL($sql);

            $result = $objSQL->getUpdate();

            //    if($result == 'updated'){
            //        $_SESSION['message']="Successfully Updated Student Info";
            //    }

            if ($result == 'updated') {

                $_SESSION['message'] = "Successfully  Update Customer Info";
                #echo "Successfully Created Customer Info<br>";
                $url = "index.php";
                // redirect($url);
                //    header('Location: index.php');
            } else {
                $error = "Fail to Update Customer Info <br>";
                $_SESSION['message'] = "Please check this \$sql -> $sql";
                $url = "index.php";
                redirect($url);
                //header('Location: customercreatefail.php?err=$error');
            }
            unset($post_data['update_customer']);
        }
    }

    public function delete_customer_info_by_id($cid) {
        $tblname = $this->customertable;
        // $cid = $this->cid;
        echo "\$cid = $cid <br>";
        if (isset($cid)) {
//       $student_id= mysqli_real_escape_string($this->conn,trim($cid));
            $cid = trim($cid);

            $sql = "DELETE FROM  $tblname  WHERE cid =$cid";
//        $result=  $this->conn->query($sql);
            echo "\$sql= $sql<br>";
            $objSQL = new SQL($sql);

            $result = $objSQL->getUpdate();
            if ($result) {
                $_SESSION['message'] = "Successfully Deleted Student Info";
            }
        }
        header('Location: index.php');
    }

    function __destruct() {
//    mysqli_close($this->conn);  
    }

}

Class CustomerName extends Dbh {

    protected $cid;
    protected $com;

    public function __construct($cid, $com) {

        $this->cid = $cid;
        $this->com = $com;
    }

    public function getCustomerName() {

        $cid = $this->cid;
        $com = $this->com;

        $customertab = "customer_" . strtolower($com);




        $sql = "SELECT co_name FROM $customertab WHERE cid = $cid ";
//                    echo "\$sql = $sql    in getCustomerName <br>"; 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()) {
            $row3 = $stmt->fetch(PDO::FETCH_ASSOC);
        }
//            echo "print_r($row3)<br>";
//             print_r($row3);
//            extract($row3);
        $co_name = $row3['co_name'];

        return $co_name;
    }

}

Class QuotationPeriod {

    public $QuonoPeriod;

    public function __construct($period) {

        $this->QuonoPeriod = $period;
    }

    public function getQuonoPeriod() {

        return $QuonoPeriod;
    }

}

Class CUSTOMERLEGACY extends Dbh {

    protected $com;
    protected $cid;
    protected $aid_cus;

    public function __construct($cid, $com) {

        $this->cid = $cid;
        $this->com = $com;
    }

    public function CheckAndUdateCidChangedate() {
        // check if change date of customer cid is NULL
        // Then update the change date with the value of crate dat
        $cid = $this->cid;
        $com = $this->com;
        $customertab = "customer_" . strtolower($com);
        $sql = "SELECT count(*) FROM $customertab where cid = $cid AND change_date IS NULL";
//            echo "\$sql = $sql <br>";
        $object = new SQL($sql);
        $numrow = $object->getRowCount();
        if ($numrow == 0) {
            return "ok";
            //do nothing
        } else {
            $sql2 = "SELECT date_created FROM $customertab where cid = '$cid' AND change_date IS NULL";
//                 echo "\$sql2 = $sql2 <br>";
            $object2 = new SQL($sql2);
            $result2 = $object2->getResultOneRowArray();
            $date_created = $result2['date_created'];
//            extract($result2);
//                print_r($result2);
//                echo "<br>";



            $sqlupdate = "UPDATE $customertab SET "
                    . "change_date = '$date_created' where cid = $cid ";
//                echo "\$sqlupdate = $sqlupdate <br>";
            $objSQLupdate = new SQL($sqlupdate);
            $updRes = $objSQLupdate->getUpdate();
            if ($updRes == 'updated') {
                return "got NULL in create date, AND updated the change_date to '$date_created' <br>";
            } else {
                
            }
        }
    }

    public function getCustomerArraybyCid() {

        $com = $this->com; // assign back the value of com
        $cid = $this->cid;
        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM $customertab where cid = '$cid'";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        #if ($stmt->rowCount()) {
        #    $row = $stmt->fetch();
        #    //foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
        #}
        // $co_name = $row['co_name'];
        // print_r($row);
        $address1 = $row['address1'];
        $address2 = $row['address2'];
        $address3 = $row['address3'];
        $attn_sales = $row['attn_sales'];
        $telephone_sales = $row['telephone_sales'];
        $fax_sales = $row['fax_sales'];
        // echo "<br>";
        // echo "\$co_name = $co_name <br>";

        $result = array(
            "address1" => $address1,
            "address2" => $address2,
            "address3" => $address3,
            "attn_sales" => $attn_sales,
            "telephone_sales" => $telephone_sales,
            "fax_sales" => $fax_sales
        );
        return $result;
    }

    public function getCustomerNamebyCid() {

        $com = $this->com; // assign back the value of com
        $cid = $this->cid;
        // echo "\$cid = $cid <br>";
        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM $customertab where cid = '$cid'";
        // echo "\$sql = $sql <br>";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        if (!empty($row)) {
            $co_name = $row['co_name'];
        }
        // print_r($row);
        // echo "<br>";
        // echo "\$co_name = $co_name <br>";
        return $co_name;
    }

    public function getCustomerModebyCid() {
        $com = $this->com; // assign back the value of com
        $cid = $this->cid;
        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM $customertab where cid = $cid";
        // echo "\$sql = $sql <br>";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        $mode_one_do_one_inv = $row['one_do_one_inv'];
        // print_r($row);
        // echo "<br>";
        // echo "\$co_name = $co_name <br>";
        return $mode_one_do_one_inv;
    }

    public function getCustomerCompanyNobyCid() {
        $com = $this->com; // assign back the value of com
        $cid = $this->cid;
        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM $customertab where cid = $cid";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        #if ($stmt->rowCount()) {
        #    $row = $stmt->fetch();
        #    //foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
        #   }
        $co_no = $row['co_no'];
        // print_r($row);
        // echo "<br>";
        // echo "\$co_no = $co_no <br>";
        return $co_no;
    }

    public function getInvModeByCid() {
        $com = $this->com; // assign back the value of com
        $cid = $this->cid;

        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM $customertab where cid = $cid";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        if (!empty($row)) {
            #if ($stmt->rowCount()) {
            #    $row = $stmt->fetch();
            #foreach ($row as $key => $value) {
            #    ${$key} = $value;
            #}// assign all key-valuepair
            $one_do_one_inv = $row['one_do_one_inv'];
        }

        $this->one_do_one_inv = $one_do_one_inv;
        // echo "\$this->one_do_one_inv  = ". $this->one_do_one_inv;
        return $one_do_one_inv;
    }

    public function getAidcusByCid() {
        $com = $this->com; // assign back the value of com
        $cid = $this->cid;

        $customertab = "customer_" . strtolower($com);

        $sqlnum_row = "SELECT count(*) FROM $customertab where cid = $cid";
        $objSQLnumrow = new SQL($sqlnum_row);
        $number_of_rows = $objSQLnumrow->getRowCount();
        #$stmt = $this->connect()->prepare($sqlnum_row);
        // echo "\$sql = $sql <br>";
        #$stmt->execute();
        #$number_of_rows = $stmt->fetchColumn();
        // echo "\$numrow = $numrow";
        if ($number_of_rows > 0) {
            # code...

            $sql = "SELECT * FROM $customertab where cid = $cid";
            $objSQL = new SQL($sql);
            $row = $objSQL->getResultOneRowArray();
            #$stmt = $this->connect()->prepare($sql);
            // echo "\$sql = $sql <br>";
            #$stmt->execute();
            if (!empty($row)) {
                #if ($stmt->rowCount()) {
                #    $row = $stmt->fetch();
                #foreach ($row as $key => $value) {
                #    ${$key} = $value;
                #}// assign all key-valuepair
                $aid_cus = $row['aid_cus'];
            }

            $this->aid_cus = $aid_cus;
        } else {
            return "no cid match";
        }
        // echo "\$this->aid_cus  = ". $this->aid_cus;
        // return $one_do_one_inv;
        return $aid_cus;
    }

    public function insertRecordintoCustomer_cusaid() {
        $com = $this->com; // assign back the value of com
        $cid = $this->cid;

        $customertab = "customer_" . strtolower($com);
        $cusaidtab = "customer_cusaid_" . strtolower($com);
        $sql = "SELECT * FROM $customertab where cid = $cid";
        $objSQL = new SQLConnect($sql);
        $row = $objSQL->getResultOneRowArray();
        #$db = dbConn::getConnection();
        #$stmt = $db->prepare($sql);
        #$stmt->execute();
        if (!empty($row)) {
            #if ($stmt->rowCount()) {
            #    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($row as $key => $value) {
                ${$key} = $value;
                #echo "$key : $value\n" . "<br>";
            }// assign all key-valuepair
        }
        $new_aid_cus = '9999';
        $timestamp = date('Y-m-d G:i:s');
        $sqlinsert = "INSERT INTO $cusaidtab "
                . "(rid, cid, accno, co_name, co_no, co_code, address1, address2, address3, country,"
                . "telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales, telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc,"
                . "groups, old_aid_cus, new_cid_cus, terms, currency,credit_limit, company, status, date_created, remarks,"
                . "credit_used, one_do_one_inv, cannot_migrate, regular, nobusy, change_date,addrecordtimestamp )
	    VALUES (null, $cid, '$accno', '$co_name', '$co_no', '$co_code', '$address1', '$address2', '$address3', '$country',"
                . "'$telepone_sales', '$fax_sales', '$handphone_sales', '$email_sales', '$attn_sales', '$telephone_acc', '$fax_acc', '$handphone_acc', '$email_acc', '$attn_acc',"
                . "'$groups', '$aid_cus', '$new_aid_cus', '$terms', '$currency', '$credit_limit', '$company', '$status', '$date_created', '$remarks',"
                . "'$credit_used', '$one_do_one_inv', '$cannot_migrate', '$regular', '$nobusy', '$change_date', '$timestamp'"
                . " )";

        echo "\$sqlinsert = $sqlinsert <br>";
        $objSQLinsert = new SQLConnect($sqlinsert);
        $insResult = $objSQL->InsertData();
        if ($insResult == 'insert ok!') {
            return 'ok';
        } else {
            return 'fail';
        }
        /*
          try {
          $db->beginTransaction();
          $stmt = $db->prepare($sqlinsert);
          $resultArray = array(NULL, (string) $cid, (string) $accno, (string) $co_name, (string) $co_no, (string) $co_code,
          (string) $address1, (string) $address2, (string) $address3, (string) $country, (string) $telephone_sales,
          (string) $fax_sales, (string) $handphone_sales, (string) $email_sales, (string) $attn_sales, (string) $telephone_acc,
          (string) $fax_acc, (string) $handphone_acc, (string) $email_acc, (string) $attn_acc, (string) $groups, (string) $aid_cus,
          (string) $new_aid_cus, (string) $terms, (string) $currency, (string) $credit_limit, (string) $company, (string) $status,
          (string) $date_created, (string) $remarks, (string) $credit_used, (string) $one_do_one_inv, (string) $cannot_migrate,
          (string) $regular, (string) $nobusy, (string) $change_date, (string) $timestamp);
          // print_r($resultArray);
          $stmt->execute($resultArray);
          $db->commit();
          echo "insert to table -> customer_cusaid_pst <br>";
          } catch (Exception $e) {
          $db->rollback();
          throw $e;
          }
         * 
         */
        // echo "\$sqlinsert = $sqlinsert <br>";
        // $stmt = $this->connect()->prepare($sqlinsert);
        // $stmt->execute();
    }

    function __destruct() {
        
    }

}

Class ChangeCustomer extends CUSTOMERLEGACY {

    protected $com;
    protected $cid;
    protected $new_aid_cus;

    public function __construct($cid, $com, $new_aid_cus) {
        // $this->cid = $cid;
        // $this->com = $com;
        $this->new_aid_cus = $new_aid_cus;
        parent::__construct($cid, $com);
    }

    public function insertNewRecordintoCustomer_cusaid() {

        $com = $this->com; // assign back the value of com
        $cid = $this->cid;
        $new_aid_cus = $this->new_aid_cus;

        $customertab = "customer_" . strtolower($com);
        $cusaidtab = "customer_cusaid_" . strtolower($com);
        $sql = "SELECT * FROM $customertab where cid = $cid";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        if (!empty($row)) {
            #$db = dbConn::getConnection();
            #$stmt = $db->prepare($sql);
            #$stmt->execute();
            #if ($stmt->rowCount()) {
            #    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($row as $key => $value) {
                ${$key} = $value;
                #echo "$key : $value\n" . "<br>";
            }// assign all key-valuepair
        }
        // $new_aid_cus = '9999';
        $timestamp = date('Y-m-d G:i:s');
        $sqlinsert = "INSERT INTO $cusaidtab "
                . "(rid, cid, accno, co_name, co_no, co_code, address1, address2, address3, country,"
                . "telephone_sales, fax_sales, handphone_sales, email_sales, attn_sales, telephone_acc, fax_acc, handphone_acc, email_acc, attn_acc,"
                . "groups, old_aid_cus, new_aid_cus, terms, currency,credit_limit, company, status, date_created, remarks,"
                . "credit_used, one_do_one_inv, cannot_migrate, regular, nobusy, change_date,addrecordtimestamp )
	    VALUES " .
                "(null, $cid, '$accno', '$co_name', '$co_no', '$co_code', '$address1', '$address2', '$address3', '$country',"
                . "'$telepone_sales', '$fax_sales', '$handphone_sales', '$email_sales', '$attn_sales', '$telephone_acc', '$fax_acc', '$handphone_acc', '$email_acc', '$attn_acc',"
                . "'$groups', '$aid_cus', '$new_aid_cus', '$terms', '$currency', '$credit_limit', '$company', '$status', '$date_created', '$remarks',"
                . "'$credit_used', '$one_do_one_inv', '$cannot_migrate', '$regular', '$nobusy', '$change_date', '$timestamp'"
                . " )";
        /*
          "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,"
          . "?, ?, ?, ?, ?, ?, ?, ?, ?, ?,"
          . "?, ?, ?, ?, ?, ?, ?, ?, ?, ?,"
          . "?, ?, ?, ?, ?, ?, ?"
          . " )";
         */
        $objSQLins = new SQLConnect($sqlinsert);
        $insRes = $objSQLins->InsertData();
        if ($insRes != 'insert ok!') {
            throw new Exception('Failed to insert records <br>  $sql = ' . $sqlinsert);
        } else {
            
        }
        /*
          echo "\$sqlinsert = $sqlinsert <br>";
          try {
          $db->beginTransaction();
          $stmt = $db->prepare($sqlinsert);
          $resultArray = array(NULL, (string) $cid, (string) $accno, (string) $co_name, (string) $co_no, (string) $co_code, (string) $address1, (string) $address2, (string) $address3, (string) $country, (string) $telephone_sales, (string) $fax_sales, (string) $handphone_sales, (string) $email_sales, (string) $attn_sales, (string) $telephone_acc, (string) $fax_acc, (string) $handphone_acc, (string) $email_acc, (string) $attn_acc, (string) $groups, (string) $aid_cus, (string) $new_aid_cus, (string) $terms, (string) $currency, (string) $credit_limit, (string) $company, (string) $status, (string) $date_created, (string) $remarks, (string) $credit_used, (string) $one_do_one_inv, (string) $cannot_migrate, (string) $regular, (string) $nobusy, (string) $change_date, (string) $timestamp);
          // print_r($resultArray);
          $stmt->execute($resultArray);
          $db->commit();
          echo "insert to table -> customer_cusaid_pst <br>";
          } catch (Exception $e) {
          $db->rollback();
          throw $e;
          }

         * 
         */
        $sqlupdate = "UPDATE $customertab set aid_cus = '$new_aid_cus' where cid = '$cid'";
        $objSQLupdate = new SQL($sql);
        $updRes = $objSQLupdate->getUpdate();
        if ($updRes != 'updated') {
            throw new Exception('Cannot update, details = ' . $sqlupdate);
        }
        #$stmt = $db->prepare($sqlupdate);
        #$stmt->execute();
    }

}

Class Address extends Dbh {

    protected $qno;
    protected $bid;
    protected $cid;
    protected $com;
    protected $dat;

    public function __construct($qno, $bid, $cid, $com, $dat) {
        $this->qno = $qno;
        $this->bid = $bid;
        $this->cid = $cid;
        $this->com = $com;
        $this->dat = $dat;
    }

    public function getDeliveryAddress() {
        $qno = $this->qno;
        $bid = $this->bid;
        $cid = $this->cid;
        $com = $this->com;
        $dat = $this->dat;

        $deltab = "deliveryaddress_" . strtolower($com) . "_" . $dat;
        $sql = "SELECT * FROM $deltab WHERE quono = '$qno' AND cid = '$cid' AND bid = '$bid'";
        echo "\$sql  = $sql  <br>";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        #if ($stmt->rowCount()) {
        #    $row = $stmt->fetch();
        #     foreach ($row as $key => $value) {
        #         ${$key} = $value;
        #     }// assign all key-valuepair
        # }
        # print_r($row);
        // echo "<br>";
        // echo "\$co_no = $co_no <br>";
        return $row;
    }

}

Class Agent extends Dbh {

    protected $aid;
    protected $com;

    public function __construct($aid, $com) {

        $this->aid = $aid;
        $this->com = $com;
    }

    public function getAgentbyaid() {

        $com = $this->com; // assign back the value of com
        $aid = $this->aid;
        // echo "\$cid = $cid <br>";
        $customertab = "customer_" . strtolower($com);

        $sql = "SELECT * FROM admin where aid = '$aid'";
        // echo "\$sql = $sql <br>";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        #if ($stmt->rowCount()) {
        #    $row = $stmt->fetch();
        #    //foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
        #}
        $agent = $row['name'];
        // print_r($row);
        // echo "<br>";
        // echo "\$co_name = $co_name <br>";
        return $agent;
    }

}

Class AgentID extends Dbh {

    protected $agent;

    public function __construct($agent) {

        $this->agent = $agent;
    }

    public function getAgentIDByName() {

        $agent = $this->agent; // assign back the value of com
        // echo "\$agent = $agent <br>";

        $sql = "SELECT aid FROM admin where name = '$agent'";
        // echo "\$sql = $sql <br>";
        $objSQL = new SQL($sql);
        $row = $objSQL->getResultOneRowArray();
        #$stmt = $this->connect()->prepare($sql);
        #$stmt->execute();
        #if ($stmt->rowCount()) {
        #    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //foreach($row as $key=>$value) { ${$key} = $value; }// assign all key-valuepair
        #}
        $agent1 = $row['aid'];
        // echo "\$agent1 = $agent1 <br>";
        // print_r($row);
        // echo "<br>";
        // echo "\$co_name = $co_name <br>";
        return $agent1;
    }

}
?>


