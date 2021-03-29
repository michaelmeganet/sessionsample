<?php

include_once "pmach.inc.php";
include_once '../class/dbh.inc.php';
include_once '../class/variables.inc.php';
include_once '../class/dimension-price.inc.php';
// include_once '../class/abstract_workpcsnew.inc.php';
include_once '../class/quotation.inc.php';
include_once '../class/customers.inc.php';

//function pmach($materialcode, $thickness, $width, $length, $tol, $processcode, $custype, $cid, $com)

$materialcode = 'kd11sp';
$thickness = 25;
$width = 150; 
$length = 250;
$tol = 0;
$processcode = '6';
 $custype = "Local" ;
 $cid = 22326;
 $com = "pst";

  $result = pmach($materialcode, $thickness, $width, $length, $tol, $processcode, $custype, $cid, $com);

  echo "\$result = $result <br>";

?>