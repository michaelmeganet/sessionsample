<?php

include_once ('class/dbh.inc.php');
include_once ('class/variables.inc.php');
include_once ('class/phhdate.inc.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  function checkSpecialPrice($grade, $cid) {

  $table = "$grade" . "_pst_" . "$cid";
  //select * from information_schema.tables where table_name='Client_information';
  $sql = "select * from information_schema.tables where table_name=  '$table' ";
  //      echo "\$sql = $sql <br>";
  $objShowTable = new SQL($sql);

  $ShowTable = $objShowTable->getResultOneRowArray();
  //    var_dump($ShowTable);

  //      echo "<br>";
  //       print_r($ShowTable);
  //      echo "<br>";
  if (!empty($ShowTable)) {

  #foreach ($ShowTable as $value) {
  #$priceTable = $showTable['TABLE_NAME'];
  #return $priceTable;
  return "Special price data is found!";
  #}
  } else {
  return "Special price for $cid in grade $grade not found.";
  }
  }
 * 
 */

function checkTable($table) {

    #$table = "$grade" . "_pst_" . "$cid";
//select * from information_schema.tables where table_name='Client_information';
    $sql = "select * from information_schema.tables where table_name=  '$table' ";
    //      echo "\$sql = $sql <br>";
    $objShowTable = new SQL($sql);

    $ShowTable = $objShowTable->getResultOneRowArray();
//    var_dump($ShowTable);
    //      echo "<pre>";
    //       print_r($ShowTable);
    //      echo "</pre>";
    if (!empty($ShowTable)) {

        #foreach ($ShowTable as $value) {
        #$priceTable = $showTable['TABLE_NAME'];
        #return $priceTable;
        return "Special price data is found!";
        #}
    } else {
        return "Special price for $table not found.";
    }
}

Class PRICE {

    private $company = 'pst'; //class wide company initialization, use "pst" for Ceras Jaya
    protected $grade;
    protected $cid;
    protected $customer_type;
    protected $matcontroltab = 'material_price_control'; // class wide material price control table initialization
    protected $matpricetab;

    public function __construct($grade, $cid, $customer_type) {
        //      echo "============================INITIALIZED PRICE CLASS============================<br>";
        $this->grade = $grade;
        $this->cid = $cid;
        $this->customer_type = $customer_type;
        //      echo "initialized class parameters :<br>";
        //      echo "\$this->grade         = $this->grade<br>";
        //      echo "\$this->cid           = $this->cid<br>";
        //      echo "\$this->customer_type = $this->customer_type<br>";
        //      echo "========+++++++BEGIN FETCHING MATERIAL PRICE TABLE <br>";
        $matPriceCheckResult = $this->get_MaterialPriceTable();
        if ($matPriceCheckResult == 'fail') {
            $mainMatPriceCheckResult = $this->get_MainMaterialPrice();
            if ($mainMatPriceCheckResult == 'fail') {
                $this->matpricetab = 'empty';
                //      echo "<b>Material Price Table Cannot be found!</b><br>";
            } else {
                $this->matpricetab = $this->grade;
                //      echo "\$this->matpricetab = $this->matpricetab<br>";
            }
        } else {
            $this->matpricetab = $matPriceCheckResult['matpricetab'];
            //      echo "\$this->matpricetab = $this->matpricetab<br>";
        }
        //      echo "========+++++++END FETCHING MATERIAL PRICE TABLE <br>";
        //      echo "<br>";
        //      echo "Check if the table exist or not :<br>";
        //      echo checkTable($this->matpricetab) . "<br>";
#$IsSpecialPrice = checkTableSchema($grade, $cid);
#//      echo "Result = $IsSpecialPrice<br>";
// check the special price
// if found special price , output special price table
//if not found special price
// check $grade_$customer_type;
//found    $grade_$customer_type; then output table
//if not found
//check $grade table (main)
        //      echo "========================END PRICE CLASS INITIALIZEMENT=========================<br>";
    }

    Protected function get_MaterialPriceTable() {
        $com = $this->company;
        $grade = $this->grade;
        $cid = $this->cid;
        $customer_type = $this->customer_type;

        //generate table name for customer_special_price
        $cussptab = $grade . "_" . $com . "_" . $cid;
        //Check if this table exists or not;
        $qrCKST = "SHOW TABLES LIKE '$cussptab'";
        $objSQLCKST = new SQL($qrCKST);
        $resultCKST = $objSQLCKST->getResultOneRowArray();
        if (!empty($resultCKST)) {
            //Customer Special Price is Found.
            return array('matpricetab' => $cussptab);
        } else {
            //Cannot find Customer Special Price, Begin Search Customer Type Price
            $cussptab = $grade . "_" . $customer_type;
            $qrCKST2 = "SHOW TABLES LIKE '$cussptab'";
            $objSQLCKST2 = new SQL($qrCKST2);
            $resultCKST2 = $objSQLCKST2->getResultOneRowArray();
            if (!empty($resultCKST2)) {
                //Customer Type Price is found
                return array('matpricetab' => $cussptab);
            } else {
                //Cannot find any Special price, return fail
                return 'fail';
            }
        }
    }

    /*
      Protected function get_MaterialPriceTable() {
      $com = $this->company;
      $grade = $this->grade;
      $cid = $this->cid;
      $customer_type = $this->customer_type;

      $tab = $this->matcontroltab;
      //      echo "=======STEP 1 Get Customer Special Price (Use Grade and CID)<br>";
      $qrST1 = "SELECT * FROM $tab "
      . "WHERE grade = '$grade' "
      . "AND cid = $cid";
      //      echo "\$qrST1 = $qrST1<br>";
      $objSQLST1 = new SQL($qrST1);
      $resultST1 = $objSQLST1->getResultOneRowArray();
      if (empty($resultST1)) {
      //      echo "===+++=STEP 1 Failed, Cannot find Customer Special Price Table<br>";
      //      echo "=======STEP 2 Get Customer Type Special Price Table<br>";
      $qrST2 = "SELECT * FROM $tab "
      . "WHERE grade = '$grade' "
      . "AND type = '$customer_type'";
      //      echo "\$qrST2 = $qrST2<br>";
      $objSQLST2 = new SQL($qrST2);
      $resultST2 = $objSQLST2->getResultOneRowArray();
      if (empty($resultST2)) {
      //      echo "===+++=STEP 2 Failed, Cannot find Customer Type Special Price Table<br>";
      return "fail";
      } else {
      //      echo "===+++=STEP 2 Success, Found Record!<br>";
      //       print_r($resultST2);
      //      echo "<br>";
      $matpricetab = $resultST2['grade'] . "_" . $resultsST2['outstation'];
      $category = $resultsST2['category'];
      return array('matpricetab' => $matpricetab, 'category' => $category);
      }
      } else {
      //      echo "===+++=STEP 1 Success, Found Record!<br>";
      //       print_r($resultST1);
      //      echo "<br>";
      $matpricetab = $resultST1['grade'] . "_" . $com . "_" . $resultST1['cid'];
      $category = $resultST1['category'];
      return array('matpricetab' => $matpricetab, 'category' => $category);
      }
      }
     * ]
     */

    Protected function get_MainMaterialPrice() {
        $grade = $this->grade;

        //      echo " === === = STEP 3 Get Main Material Price<br>";
        $qrST3 = "SHOW TABLES LIKE '$grade'";
        //      echo "\$qrST3 = $qrST3<br>";
        $objSQLST3 = new SQL($qrST3);
        $resultST3 = $objSQLST3->getResultOneRowArray();
        if (empty($resultST3)) {
            //      echo " === ++ += STEP 3 Failed, Cannot find Main Material Price table<br>";
            return 'fail';
        } else {
            //      echo " === ++ += STEP 3 Success, Found Record!<br>";
            return $resultST3;
        }
    }

    Public function get_PriceTable() {
        $matpricetab = $this->matpricetab;
        if ($matpricetab == 'empty') {
            return 'fail';
        } else {
            $qrpt = "SELECT * FROM $matpricetab";
            $objSQLpt = new SQL($qrpt);
            $result = $objSQLpt->getResultRowArray();
            return $result;
        }
    }

    Public function get_matpricetab() {
        return $this->matpricetab;
    }

}
