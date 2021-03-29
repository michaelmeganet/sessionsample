<?php

include '../class/dbh.inc.php';
include '../class/variables.inc.php';

// Input processcode get processname

$sqlPro  = "SELECT * FROM premachining  WHERE  pmid = $processcode";

$objProcessName = new SQL($sqlPro);
$result = $objProcessName->getResultOneRowArray();