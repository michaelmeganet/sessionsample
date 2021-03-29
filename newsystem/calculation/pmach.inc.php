<?php

//include_once '../class/dbh.inc.php';
//include_once '../class/variables.inc.php';
//$materialcode = $_GET["mat"]; //material code
//$thickness = $_GET["mdt"]; //material thickness
//$width = $_GET["mdw"]; //material width
//$length = $_GET["mdl"]; //material length
//$process = $_GET["pro"]; //process
//$custype = $_GET["cus"]; //customer type
//$tol = $_GET["tol"]; //tolerance
//$cid = $_GET["cid"]; //company id
//$com = $_GET["com"]; //company
//$centsincluded = $_GET["cen"]; //cents included
//$materialcode = '12379p'; //material code
//$thickness = '35'; //material thickness
//$width = '120'; //material width
//$length = '350'; //material length
//$process = 5; //process
//$custype = 'LOCAL'; //customer type
////$tol = $_GET["tol"]; //tolerance
//$cid = 504; //company id
//$com = 'PST'; //company
//$centsincluded = 'yes'; //cents included
//$materialcode = $_POST['materialcode']; //material code
//$thickness = $_POST['thick']; //material thickness
//$width = $_POST['width']; //material width
//$length = $_POST['length']; //material length
//$process = $_POST['process']; //process
//$custype = $_POST['cust_type']; //customer type
////$tol = $_GET["tol"]; //tolerance
//$cid = $_POST['cid']; //company id
//$com = $_POST['company']; //company
//$centsincluded = 'yes'; //cents included
function pmach($materialcode, $thickness, $width, $length, $tol, $processcode, $custype, $cid, $com) {
    $width = floatval($width);
    $length = floatval($length);
    $thickness = floatval($thickness);
//lookup all hints from array if length of q>0
    $hint = 0.00;
    #echo "\$processcode = $processcode <br>";// check have special table for special customer
    if (strlen($processcode) > 0) {
        #echo "true strlen(\$processcode) > 0 , for ".strlen($processcode);
        $hint = 0.00;
        $tables = 'premachining_' . strtolower($com) . '_' . $cid;
        $tables2 = 'premachiningadd_' . strtolower($com) . '_' . $cid;
        #echo "\$tables =  $tables <br>";
        #echo "\$tables2 =  $tables2 <br>";

        $sql = "SELECT count(*) FROM $tables WHERE pmid = $processcode";
        //  $result = $rundb->Query($sql);
        #echo "\$sql =  $sql <br>";
        $objSql = new SQL($sql);
        $result = $objSql->getRowCount();
        #echo "\$result =  $result <br>";
        //if result = 1 then got special price, otherwise no special price
        if ($result == 0) {
            /*
              if($custype == "outstation"){
              $sql = "SELECT * FROM premachining_outstation WHERE pmid = $processcode";
              $result = $rundb->Query($sql);
              }
              else{
              $sql = "SELECT * FROM premachining WHERE pmid = $processcode";
              $result = $rundb->Query($sql);
              }
             */
            $premachoutstation = "premachining_" . $custype;

            $sql2 = "SELECT count(*) FROM $premachoutstation WHERE pmid = $processcode";

            //        $result = $rundb->Query($sql);
            $ObjSql2 = new SQL($sql2);
            $result2 = $ObjSql2->getRowCount();
            #echo "\$sql2 = $sql2 <br>";

            if ($result2 == 0) {
                //if outstation not found, check for company, possible for indonesia
                $premachothers = "premachining_" . strtolower($com);

                $sqlother = "SELECT count(*) FROM $premachothers WHERE pmid = $processcode";
                //            $result = $rundb->Query($sql);
                #echo "\$premachothers =  $premachothers <br>";

                $objOther = new SQL($sqlother);
                $resultother = $objOther->getRowCount();

                if ($resultother == 0) {
                    $sqlpmach = "SELECT * FROM premachining WHERE pmid = $processcode";
                    //            $result = $rundb->Query($sql);
                    //echo " \$sqlpmach= $sqlpmach<br>";
                    $objpmach = new SQL($sqlpmach);
                    $row = $objpmach->getResultOneRowArray();
                    // echo "<br>";
                    //print_r($row);
                    // echo "<br>";
                }
            }
        }else{

            if ($result > 0) {
                $sqlpmach = "SELECT * FROM premachining WHERE pmid = $processcode";
                //            $result = $rundb->Query($sql);
                #echo " \$sqlpmach= $sqlpmach<br>";
                $objpmach = new SQL($sqlpmach);
                $row = $objpmach->getResultOneRowArray();
            }
        }

        //  $row = $rundb->FetchArray($result);
        //plate indicator
        $top1 = $row['top1'];
        $bottom2 = $row['bottom2'];
        $sidel3 = $row['sidel3'];
        $sider4 = $row['sider4'];
        $sideb5 = $row['sideb5'];
        $sidet6 = $row['sidet6'];

        //top freesize
        $t1fw = $row['t1fw'];
        $t1frg = $row['t1frg'];
        $t1fsg = $row['t1fsg'];

        //bottom freesize
        $b2fw = $row['b2fw'];
        $b2frg = $row['b2frg'];
        $b2fsg = $row['b2fsg'];

        //side left 3 freesize
        $sl3fw = $row['sl3fw'];
        $sl3frg = $row['sl3frg'];
        $sl3fsg = $row['sl3fsg'];

        //side right 4 freesize
        $sr4fw = $row['sr4fw'];
        $sr4frg = $row['sr4frg'];
        $sr4fsg = $row['sr4fsg'];

        //side bottom 5 freesize
        $sb5fw = $row['sb5fw'];
        $sb5frg = $row['sb5frg'];
        $sb5fsg = $row['sb5fsg'];

        //side top 6 freesize
        $st6fw = $row['st6fw'];
        $st6frg = $row['st6frg'];
        $st6fsg = $row['st6fsg'];

        //top accurate
        $t1aw = $row['t1aw'];
        $t1arg = $row['t1arg'];
        if ($materialcode == 'ss303p') {

            $t1asg = 2 * $row['t1asg']; //6WA2SGA
            //$t1asg = 2 * $t1asg ; //6WA2SGA
        } else {
            $t1asg = $row['t1asg']; //6WA2SGA
        }


        //bottom accurate
        $b2aw = $row['b2aw'];
        $b2arg = $row['b2arg'];
        if ($materialcode == 'ss303p') {
            $b2asg = 2 * $row['b2asg']; //6WA2SGA
            //$b2asg = 2 * $b2asg;//6WA2SGA
        } else {

            $b2asg = $row['b2asg']; //6WA2SGA
        }


        //side leat 3 accurate
        if ($materialcode == 'ss303p') {
            $sl3aw = 2 * $row['sl3aw']; //6WA2SGA
        } else {
            $sl3aw = $row['sl3aw']; //6WA2SGA
        }

        $sl3arg = $row['sl3arg'];
        $sl3asg = $row['sl3asg'];

        //side right 4 accurate
        if ($materialcode == 'ss303p') {

            $sr4aw = 2 * $row['sr4aw']; //6WA2SGA
        } else {

            $sr4aw = $row['sr4aw']; //6WA2SGA
        }

        $sr4arg = $row['sr4arg'];
        $sr4asg = $row['sr4asg'];

        //side bottom 5 accurate
        if ($materialcode == 'ss303p') {

            $sb5aw = 2 * $row['sb5aw']; //6WA2SGA
        } else {

            $sb5aw = $row['sb5aw']; //6WA2SGA
        }

        $sb5arg = $row['sb5arg'];
        $sb5asg = $row['sb5asg'];

        //side top 6 accurate
        if ($materialcode == 'ss303p') {

            $st6aw = 2 * $row['st6aw']; //6WA2SGA
        } else {

            $st6aw = $row['st6aw']; //6WA2SGA
        }

        if ($materialcode == 'ss303p') {

            $st6arg = 2 * $row['st6arg'];
        } else {

            $st6asg = $row['st6asg'];
            $st6arg = $row['st6arg'];
        }


        if ($thickness < 25) {
            $thickness = 25;
        }

        //if Panasonic HA Air-Conditioning (M) S/B ********************************************************************************
        if (($com == "PST" && $cid == 506) || ($com == "PST" && $cid == 20506)
        ) {
            if ($tol == "0.02") {
                if ($t1aw != "" || $t1aw != "0.00" || $b2aw != "" || $b2aw != "0.00") {
                    if ($length <= 1000) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.02mm Length < 1m'";
                        $resultaa = $rundb->Query($sqlaa);
                        $rowaa = $rundb->FetchArray($resultaa);

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    } else if ($length > 1000 && $length <= 1600) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.02mm Length 1m ~ 1.6m'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        $objSqlaa = new SQL($sqlaa);
                        $rowaa = $objSqlaa->getResultOneRowArray();
                        //          $rowaa = $rundb->FetchArray($resultaa);

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    } else if ($length > 1600) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.02mm Length > 1.6m'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        //          $rowaa = $rundb->FetchArray($resultaa);
                        $objSqlaa = new SQL($sqlaa);
                        $rowaa = $objSqlaa->getResultOneRowArray();

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    }
                }
            } else if ($tol == "0.10") {
                if ($t1aw != "" || $t1aw != "0.00" || $b2aw != "" || $b2aw != "0.00") {
                    if ($length <= 1000) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.10mm Length < 1m'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        //          $rowaa = $rundb->FetchArray($resultaa);
                        $objSqlaa = new SQL($sqlaa);
                        $rowaa = $objSqlaa->getResultOneRowArray();

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    } else if ($length > 1000 && $length <= 1600) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.10mm Length 1m ~ 1.6m'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        //          $rowaa = $rundb->FetchArray($resultaa);
                        $objSqlaa = new SQL($sqlaa);
                        $rowaa = $objSqlaa->getResultOneRowArray();

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    } else if ($length > 1600) {
                        $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND conditions = 'Tolerance 0.10mm Length > 1.6m'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        //          $rowaa = $rundb->FetchArray($resultaa);
                        $objSqlaa = new SQL($sqlaa);
                        $rowaa = $objSqlaa->getResultOneRowArray();

                        $t1asg = $rowaa['price'];
                        $b2asg = $rowaa['price'];
                    }
                }
            } else {
                $t1asg = $row['t1asg'];
                $b2asg = $row['b2asg'];
            }
        }

        //if company is AE Technology Sdn Bhd or AE Technology (P) Sdn Bhd or Suntech Precision Sdn Bhd ************************************************
        else if (($com == "PST" && $cid == 5171)) {
            $hypo = $hypo2 = $hypo3 = round(sqrt(($width * $width) + ($length * $length)), 2);
            //$hypo = round(sqrt(($width * $width) + ($length * $length)), 2);
            //$hypo2 = round(sqrt(($thickness * $thickness) + ($length * $length)), 2);
            //$hypo3 = round(sqrt(($thickness * $thickness) + ($width * $width)), 2);

            if ($row['process'] == "6WA2SGA") {
                if ($hypo <= 1000) {
                    $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '6WA2SGA' AND conditions = '< 1000mm'";
                    //        $resultaa = $rundb->Query($sqlaa);
                    //        $rowaa = $rundb->FetchArray($resultaa);
                    $objSqlaa = new SQL($sqlaa);
                    $rowaa = $objSqlaa->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = $rowaa['price'] * 2;
                            $b2asg = $rowaa['price'] * 2;

                            break;

                        default:
                            $t1asg = $rowaa['price'];
                            $b2asg = $rowaa['price'];
                            break;
                    }


                    $sqlbb = "SELECT * FROM $tables2 WHERE type = 'Side Accurate' AND process = '6WA2SGA' AND conditions = '< 1000mm'";
                    //            $resultbb = $rundb->Query($sqlbb);
                    //            $rowbb = $rundb->FetchArray($resultbb);
                    $objSqlbb = new SQL($sqlbb);
                    $rowbb = $objSqlbb->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $sl3aw = $rowbb['price'] * 2;
                            $sr4aw = $rowbb['price'] * 2;
                            $sb5aw = $rowbb['price'] * 2;
                            $st6aw = $rowbb['price'] * 2;
                            break;

                        default:
                            $sl3aw = $rowbb['price'];
                            $sr4aw = $rowbb['price'];
                            $sb5aw = $rowbb['price'];
                            $st6aw = $rowbb['price'];
                            break;
                    }
                } else if ($hypo > 1001 && $hypo <= 1500) {
                    $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '6WA2SGA' AND conditions = '1001mm ~ 1500mm'";
                    //            $resultaa = $rundb->Query($sqlaa);
                    //            $rowaa = $rundb->FetchArray($resultaa);
                    $objSqlaa = new SQL($sqlaa);
                    $rowaa = $objSqlaa->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = $rowaa['price'] * 2;
                            $b2asg = $rowaa['price'] * 2;
                            break;

                        default:
                            $t1asg = $rowaa['price'];
                            $b2asg = $rowaa['price'];
                            break;
                    }


                    $sqlbb = "SELECT * FROM $tables2 WHERE type = 'Side Accurate' AND process = '6WA2SGA' AND conditions = '1001mm ~ 1500mm'";
                    //        $resultbb = $rundb->Query($sqlbb);
                    //        $rowbb = $rundb->FetchArray($resultbb);
                    $objSqlbb = new SQL($sqlbb);
                    $rowbb = $objSqlbb->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $sl3aw = $rowbb['price'] * 2;
                            $sr4aw = $rowbb['price'] * 2;
                            $sb5aw = $rowbb['price'] * 2;
                            $st6aw = $rowbb['price'] * 2;
                            break;

                        default:
                            $sl3aw = $rowbb['price'];
                            $sr4aw = $rowbb['price'];
                            $sb5aw = $rowbb['price'];
                            $st6aw = $rowbb['price'];
                            break;
                    }
                } else if ($hypo > 1501 && $hypo <= 2000) {
                    $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND"
                            . " process = '6WA2SGA' AND conditions = '1501mm ~ 2000mm'";
                    //              $resultaa = $rundb->Query($sqlaa);
                    //              $rowaa = $rundb->FetchArray($resultaa);
                    $objSqlaa = new SQL($sqlaa);
                    $rowaa = $objSqlaa->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = $rowaa['price'] * 2;
                            $b2asg = $rowaa['price'] * 2;
                            break;

                        default:
                            $t1asg = $rowaa['price'];
                            $b2asg = $rowaa['price'];
                            break;
                    }



                    $sqlbb = "SELECT * FROM $tables2 WHERE type = 'Side Accurate' AND "
                            . "process = '6WA2SGA' AND conditions = '1501mm ~ 2000mm'";
                    //                $resultbb = $rundb->Query($sqlbb);
                    //                $rowbb = $rundb->FetchArray($resultbb);
                    $objSqlbb = new SQL($sqlbb);
                    $rowbb = $objSqlbb->getResultOneRowArray();

                    switch ($materialcode) {
                        case 'ss303p':
                            $sl3aw = $rowbb['price'] * 2;
                            $sr4aw = $rowbb['price'] * 2;
                            $sb5aw = $rowbb['price'] * 2;
                            $st6aw = $rowbb['price'] * 2;
                            break;

                        default:
                            $sl3aw = $rowbb['price'];
                            $sr4aw = $rowbb['price'];
                            $sb5aw = $rowbb['price'];
                            $st6aw = $rowbb['price'];
                            break;
                    }
                } else if ($hypo > 2000) {
                    $sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '6WA2SGA' AND conditions = '> 2000mm'";
                    //                $resultaa = $rundb->Query($sqlaa);
                    //                $rowaa = $rundb->FetchArray($resultaa);
                    $objSqlaa = new SQL($sqlaa);
                    $rowaa = $objSqlaa->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = $rowaa['price'] * 2;
                            $b2asg = $rowaa['price'] * 2;
                            break;

                        default:
                            $t1asg = $rowaa['price'];
                            $b2asg = $rowaa['price'];
                            break;
                    }



                    $sqlbb = "SELECT * FROM $tables2 WHERE type = 'Side Accurate' AND process = '6WA2SGA' AND conditions = '> 2000mm'";
                    //                $resultbb = $rundb->Query($sqlbb);
                    //                $rowbb = $rundb->FetchArray($resultbb);
                    $objSqlbb = new SQL($sqlbb);
                    $rowbb = $objSqlbb->getResultOneRowArray();
                    switch ($materialcode) {
                        case 'ss303p':
                            $sl3aw = $rowbb['price'] * 2;
                            $sr4aw = $rowbb['price'] * 2;
                            $sb5aw = $rowbb['price'] * 2;
                            $st6aw = $rowbb['price'] * 2;
                            break;

                        default:
                            $sl3aw = $rowbb['price'];
                            $sr4aw = $rowbb['price'];
                            $sb5aw = $rowbb['price'];
                            $st6aw = $rowbb['price'];
                            break;
                    }
                }
            }
            //other than 6WA process
            else {
                //W Side Freesize > 1000mm (all 4 side)
                if ($hypo > 1000) {
                    $sqlaa = "SELECT count(*) FROM $tables2 WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                    $resultaa = $rundb->Query($sqlaa);
                    $objSqlaa = new SQL($sqlaa);
                    $resultaa = $objSqlaa->getRowCount();
                    if ($resultaa == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlaa = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                          $resultaa = $rundb->Query($sqlaa);
                          }
                          else{
                          $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                          $resultaa = $rundb->Query($sqlaa);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlaa = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                        //			$resultaa = $rundb->Query($sqlaa);

                        $objSqlaa = new SQL($sqlaa);
                        $resultaa = $objSqlaa->getRowCount();
                        if ($resultaa == 0) {
                            $sqlaa2 = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                            $objSqlaa2 = new SQL($sqlaa2);
                        }
                    }

                    $rowaa = $objSqlaa2->getResultOneRowArray();

                    if ($sl3fw && $sr4fw && $sb5fw && $st6fw != 0) {
                        $sl3fw = $rowaa['price'];
                        $sr4fw = $rowaa['price'];
                        $sb5fw = $rowaa['price'];
                        $st6fw = $rowaa['price'];
                    }
                }

                //W Side Accurate 1001mm ~ 1350mm (side width)
                if ($hypo2 > 1000 && $hypo2 <= 1350) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                        //			$resultac2 = $rundb->Query($sqlac2);
                        $objSqlac2 = new SQL($sqlac2);
                        $resultac2 = $objSqlac2->getRowCount();

                        if ($resultac2 == 0) {
                            $sqlac3 = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                            //                          $resultac3 = $rundb->Query($sqlac3);
                            $objSqlac3 = new SQL($sqlac3);
                        }
                    }

                    //		  $rowac = $rundb->FetchArray($resultac);
                    $rowac = $objSqlac3->getResultOneRowArray();

                    if ($sl3aw && $sr4aw != 0) {
                        $sl3aw = $rowac['price'];
                        $sr4aw = $rowac['price'];
                    }
                }
                //W Side Accurate 1001mm ~ 1350mm
                else if ($hypo2 > 1351 && $hypo2 <= 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                        $objSqlac2 = new SQL($sqlac2);
                        $resultac2 = $objSqlac2->getRowCount();
                        //                        $resultac = $rundb->Query($sqlac);

                        if ($resultac2 == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                            $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    //		  $rowac = $rundb->FetchArray($resultac);
                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sl3aw && $sr4aw != 0) {
                        $sl3aw = $rowac['price'];
                        $sr4aw = $rowac['price'];
                    }
                }
                //W Side Accurate 1001mm ~ 1350mm
                else if ($hypo2 > 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    //                  $resultac = $rundb->Query($sqlac);

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                        //$resultac2 = $rundb->Query($sqlac2);
                        $objSqlac2 = new SQL($sqlac2);
                        $resultac2 = $objSqlac2->getRowCount();
                        if ($resultac2 == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }
                    $rowac = $objSqlac->getResultOneRowArray();
                    //		  $rowac = $rundb->FetchArray($resultac);

                    if ($sl3aw && $sr4aw != 0) {
                        $sl3aw = $rowac['price'];
                        $sr4aw = $rowac['price'];
                    }
                }

                //W Side Accurate 1001mm ~ 1350mm (side length)
                if ($hypo3 > 1000 && $hypo3 <= 1350) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                        //$resultac = $rundb->Query($sqlac);
                        $objSqlac2 = new SQL($sqlac2);
                        $resultac2 = $objSqlac2->getRowCount();


                        if ($resultac2 == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();


                    if ($sb5aw && $st6aw != 0) {
                        $sb5aw = $rowac['price'];
                        $st6aw = $rowac['price'];
                    }
                }
                //W Side Accurate 1001mm ~ 1350mm
                else if ($hypo3 > 1351 && $hypo3 <= 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                    //$resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                        //			$resultac2 = $rundb->Query($sqlac2);
                        $objSqlac2 = new SQL($sqlac2);
                        $resultac2 = $objSqlac2->getRowCount();

                        if (!$resultac) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                            //$resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sb5aw && $st6aw != 0) {
                        $sb5aw = $rowac['price'];
                        $st6aw = $rowac['price'];
                    }
                }
                //W Side Accurate 1001mm ~ 1350mm
                else if ($hypo3 > 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                    //                    $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                        //$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();
                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                            $objSqlac = new SQL($sqlac);
                            //                          $resultac = $rundb->Query($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sb5aw && $st6aw != 0) {
                        $sb5aw = $rowac['price'];
                        $st6aw = $rowac['price'];
                    }
                }

                //SG Side Freesize > 1000mm (all 4 side)
                if ($hypo > 1000) {
                    $sqlaa = "SELECT count(*) FROM $tables2 WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                    //		  $resultaa = $rundb->Query($sqlaa);
                    $objSqlaa = new SQL($sqlaa);
                    $resultaa = $objSqlaaa->getRowCount();
                    if ($resultaa == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlaa = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                          $resultaa = $rundb->Query($sqlaa);
                          }
                          else{
                          $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                          $resultaa = $rundb->Query($sqlaa);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlaa2 = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                        //			$resultaa = $rundb->Query($sqlaa);
                        $objSqlaa2 = new SQL($sqlaa2);
                        $resultaa2 = $objSqlaa2->getRowCount();

                        if ($resultaa == 0) {
                            $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                            //                          $resultaa = $rundb->Query($sqlaa);
                            $objSqlaa = new SQL($sqlaa);
                        }
                    }

                    $rowaa = $objSqlaa->getResultOneRowArray();

                    if ($sl3fsg && $sr4fsg && $sb5fsg && $st6fsg != 0) {
                        $sl3fsg = $rowaa['price'];
                        $sr4fsg = $rowaa['price'];
                        $sb5fsg = $rowaa['price'];
                        $st6fsg = $rowaa['price'];
                    }
                }

                //SG Surface Accurate > 1350mm (surface)
                if ($hypo2 > 1350) {
                    $sqlab = "SELECT count(*) FROM $tables2 WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                    //$resultab = $rundb->Query($sqlab);
                    $objSqlab = new SQL($sqlab);
                    $resultab = $objSqlab->getRowCount();
                    if ($resultab == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlab = "SELECT * FROM premachiningadd_outstation WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                          $resultab = $rundb->Query($sqlab);
                          }
                          else{
                          $sqlab = "SELECT * FROM premachiningadd WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                          $resultab = $rundb->Query($sqlab);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlab = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                        //$resultab = $rundb->Query($sqlab);
                        $objSqlab = new SQL($sqlab);
                        $resultab = $objSqlab->getRowCount();

                        if ($resultab == 0) {
                            $sqlab = "SELECT * FROM premachiningadd WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                            //			  $resultab = $rundb->Query($sqlab);
                            $objSqlab = new SQL($sqlab);
                        }
                    }

                    $rowab = $objSqlab->getResultOneRowArray();

                    if ($t1asg && $b2asg != 0) {
                        $t1asg = $rowab['price'];
                        $b2asg = $rowab['price'];
                    }
                }

                //SG Side Accurate 1001mm ~ 1350mm (side width)
                if ($hypo2 > 1000 && $hypo2 <= 1350) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resulta == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                        //			$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();

                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sl3asg && $sr4asg != 0) {
                        $sl3asg = $rowac['price'];
                        $sr4asg = $rowac['price'];
                    }
                }
                //SG Side Accurate 1001mm ~ 1350mm
                else if ($hypo2 > 1351 && $hypo2 <= 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                    //$resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                        //			$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();

                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sl3asg && $sr4asg != 0) {
                        $sl3asg = $rowac['price'];
                        $sr4asg = $rowac['price'];
                    }
                }
                //SG Side Accurate 1001mm ~ 1350mm
                else if ($hypo2 > 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                        $objSqlac = new SQL($sqlac);
                        //                        $resultac = $rundb->Query($sqlac);
                        $resultac = $objSqlac->getRowCount();
                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sl3asg && $sr4asg != 0) {
                        $sl3asg = $rowac['price'];
                        $sr4asg = $rowac['price'];
                    }
                }

                //SG Side Accurate 1001mm ~ 1350mm (side length)
                if ($hypo3 > 1000 && $hypo3 <= 1350) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                    //		  $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                        //$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();
                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sb5asg && $st6asg != 0) {
                        $sb5asg = $rowac['price'];
                        $st6asg = $rowac['price'];
                    }
                }
                //SG Side Accurate 1001mm ~ 1350mm
                else if ($hypo3 > 1351 && $hypo3 <= 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                    //$resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT * FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                        //$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();
                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sb5asg && $st6asg != 0) {
                        $sb5asg = $rowac['price'];
                        $st6asg = $rowac['price'];
                    }
                }
                //SG Side Accurate 1001mm ~ 1350mm
                else if ($hypo3 > 2000) {
                    $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                    //$resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resultac == 0) {
                        /*
                          if($custype == "outstation"){
                          $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                          else{
                          $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                          $resultac = $rundb->Query($sqlac);
                          }
                         */
                        $premachaddoutstation = "premachiningadd_" . $custype;

                        $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                        //			$resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        $resultac = $objSqlac->getRowCount();
                        if ($resultac == 0) {
                            $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                            //			  $resultac = $rundb->Query($sqlac);
                            $objSqlac = new SQL($sqlac);
                        }
                    }

                    $rowac = $objSqlac->getResultOneRowArray();

                    if ($sb5asg && $st6asg != 0) {
                        $sb5asg = $rowac['price'];
                        $st6asg = $rowac['price'];
                    }
                }
            }
        } elseif ($com == "PST" && $materialcode == "ss303p") {

            //    if ($cid == 22376 || $cid = 23937) {

            if ($row['process'] == '2WA2SGA') {
                //echo "in process = 2WA2SGA";

                if ($hypo <= 1000) {
                    //$sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '2WA' AND conditions = '< 1000mm'";
                    //echo "\$sqlaa = $sqlaa   line 1404<br>";
                    //$resultaa = $rundb->Query($sqlaa);
                    //$rowaa = $rundb->FetchArray($resultaa);
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1aw = 0.45;
                            $b2aw = 0.45;
                            $t1asg = 0.75;
                            $b2asg = 0.75;
                            //echo "\$t1aw = $t1aw  , \$b2aw = $b2aw <br>";
                            break;

                        default:
                            $t1aw = 0.45;
                            $b2aw = 0.45;
                            $t1asg = 0.75;
                            $b2asg = 0.75;
                            break;
                    }


                    //            $sqlbb = "SELECT * FROM $tables2 WHERE type = 'Side Accurate' AND process = '6WA2SGA' AND conditions = '< 1000mm'";
                    //            echo "\$sqlbb = $sqlbb    line 1422<br>";
                    //            $resultbb = $rundb->Query($sqlbb);
                    //            $rowbb = $rundb->FetchArray($resultbb);
                    //            switch ($materialcode) {
                    //                case 'ss303p':
                    //                    $sl3aw = 0.5;
                    //                    $sr4aw = 0.5;
                    //                    $sb5aw = $rowbb['price'] * 2;
                    //                    $st6aw = $rowbb['price'] * 2;
                    //                    break;
                    //
    //                default:
                    //                    $sl3aw = $rowbb['price'];
                    //                    $sr4aw = $rowbb['price'];
                    //                    $sb5aw = $rowbb['price'];
                    //                    $st6aw = $rowbb['price'];
                    //                    break;
                    //            }        
                    ### remove becaUSE 2wa
                }
            } elseif ($row['process'] == '2WA') {

                if ($hypo <= 1000) {
                    //$sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '2WA' AND conditions = '< 1000mm'";
                    //echo "\$sqlaa = $sqlaa   line 1404<br>";
                    //$resultaa = $rundb->Query($sqlaa);
                    //$rowaa = $rundb->FetchArray($resultaa);
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = 0.45;
                            $b2asg = 0.45;

                            break;

                        default:
                            $t1asg = 0.45;
                            $b2asg = 0.45;
                            break;
                    }
                }
            } elseif ($row['process'] == '2SGA') {

                if ($hypo <= 1000) {
                    //$sqlaa = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = '2WA' AND conditions = '< 1000mm'";
                    //echo "\$sqlaa = $sqlaa   line 1404<br>";
                    //$resultaa = $rundb->Query($sqlaa);
                    //$rowaa = $rundb->FetchArray($resultaa);
                    switch ($materialcode) {
                        case 'ss303p':
                            $t1asg = 1.2;
                            $b2asg = 1.2;

                            break;

                        default:
                            $t1asg = 1.2;
                            $b2asg = 1.2;
                            break;
                    }
                }
            }
            //}
        } else { //other **********************************************************************************************************************************************
            $hypo = round(sqrt(($width * $width) + ($length * $length)), 2);
            $hypo2 = $hypo;
            $hypo3 = $hypo;

            //$hypo = round(sqrt(($width * $width) + ($length * $length)), 2);
            //$hypo2 = round(sqrt(($thickness * $thickness) + ($length * $length)), 2);
            //$hypo3 = round(sqrt(($thickness * $thickness) + ($width * $width)), 2);
            //W Side Freesize > 1000mm (all 4 side)
            if ($hypo2 > 1000) {
                $sqlaa = "SELECT count(*) FROM $tables2 WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                //          $resultaa = $rundb->Query($sqlaa);
                $objSqlaa = new SQL($sqlaa);
                $resultaa = $objSqlaa->getRowCount();

                if ($resultaa == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlaa = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                      $resultaa = $rundb->Query($sqlaa);
                      }
                      else{
                      $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                      $resultaa = $rundb->Query($sqlaa);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlaa = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                    //                $resultaa = $rundb->Query($sqlaa);
                    $objSqlaa = new SQL($sqlaa);
                    $resultaa = $objSqlaa->getRowCount();

                    if ($resultaa == 0) {
                        $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'W' AND conditions = '> 1000mm'";
                        //                    $resultaa = $rundb->Query($sqlaa);
                        $objSqlaa = new SQL($sqlaa);
                    }
                }

                $rowaa = $objSqlaa->getResultOneRowArray();

                /*
                  if($sl3fw && $sr4fw && $sb5fw && $st6fw != 0){
                  $sl3fw = $rowaa['price'];
                  $sr4fw = $rowaa['price'];
                  $sb5fw = $rowaa['price'];
                  $st6fw = $rowaa['price'];
                  }
                 */

                if ($sl3fw != 0) {
                    $sl3fw = $rowaa['price'];
                }

                if ($sr4fw != 0) {
                    $sr4fw = $rowaa['price'];
                }

                if ($sb5fw != 0) {
                    $sb5fw = $rowaa['price'];
                }

                if ($st6fw != 0) {
                    $st6fw = $rowaa['price'];
                }
            }

            //W Side Accurate 1001mm ~ 1350mm (side width)
            if ($hypo2 > 1000 && $hypo2 <= 1350) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                //            $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                    //                $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                        //                    $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3aw && $sr4aw != 0){
                  $sl3aw = $rowac['price'];
                  $sr4aw = $rowac['price'];
                  }
                 */
                #var_dump($rowac);
                if ($sl3aw != 0) {
                    $sl3aw = $rowac['price'];
                }

                if ($sr4aw != 0) {
                    $sr4aw = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo2 > 1351 && $hypo2 <= 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                //            $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                    //                $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                        //          $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3aw && $sr4aw != 0){
                  $sl3aw = $rowac['price'];
                  $sr4aw = $rowac['price'];
                  }
                 */

                if ($sl3aw != 0) {
                    $sl3aw = $rowac['price'];
                }

                if ($sr4aw != 0) {
                    $sr4aw = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo2 > 2000) {

                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                //        $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                    //            $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                        //                $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3aw && $sr4aw != 0){
                  $sl3aw = $rowac['price'];
                  $sr4aw = $rowac['price'];
                  }
                 */

                if ($sl3aw != 0) {
                    $sl3aw = $rowac['price'];
                }

                if ($sr4aw != 0) {
                    $sr4aw = $rowac['price'];
                }
            }

            //W Side Accurate 1001mm ~ 1350mm (side length)
            if ($hypo3 > 1000 && $hypo3 <= 1350) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();
                //        $resultac = $rundb->Query($sqlac);

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                    //            $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1001mm ~ 1350mm'";
                        $objSqlac = new SQL($sqlac);
                        //                $resultac = $rundb->Query($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5aw && $st6aw != 0){
                  $sb5aw = $rowac['price'];
                  $st6aw = $rowac['price'];
                  }
                 */

                if ($sb5aw != 0) {
                    $sb5aw = $rowac['price'];
                }

                if ($st6aw != 0) {
                    $st6aw = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo3 > 1351 && $hypo3 <= 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                //        $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '1351mm ~ 2000mm'";
                        //                $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5aw && $st6aw != 0){
                  $sb5aw = $rowac['price'];
                  $st6aw = $rowac['price'];
                  }
                 */

                if ($sb5aw != 0) {
                    $sb5aw = $rowac['price'];
                }

                if ($st6aw != 0) {
                    $st6aw = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo3 > 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                //        $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                    //            $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {

                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'W' AND conditions = '> 2000mm'";
                        //                $resultac = $rundb->Query($sqlac);

                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5aw && $st6aw != 0){
                  $sb5aw = $rowac['price'];
                  $st6aw = $rowac['price'];
                  }
                 */

                if ($sb5aw != 0) {
                    $sb5aw = $rowac['price'];
                }

                if ($st6aw != 0) {
                    $st6aw = $rowac['price'];
                }
            }

            //SG Side Freesize > 1000mm (all 4 side)
            if ($hypo > 1000) {

                $sqlaa = "SELECT count(*) FROM $tables2 WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                //        $resultaa = $rundb->Query($sqlaa);
                $objSqlaa = new SQL($sqlaa);
                $resultaa = $objSqlaa->getRowCount();
                if ($resultaa == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlaa = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                      $resultaa = $rundb->Query($sqlaa);
                      }
                      else{
                      $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                      $resultaa = $rundb->Query($sqlaa);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlaa = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                    //            $resultaa = $rundb->Query($sqlaa);
                    $objSqlaa = new SQL($sqlaa);
                    $resultaa = $objSqlaa->getRowCount();

                    if ($resultaa == 0) {
                        $sqlaa = "SELECT * FROM premachiningadd WHERE type = 'Side Freesize' AND process = 'SG' AND conditions = '> 1000mm'";
                        //          $resultaa = $rundb->Query($sqlaa);
                        $objSqlaa = new SQL($sqlaa);
                    }
                }

                $rowaa = $objSqlaa->getResultOneRowArray();

                /*
                  if($sl3fsg && $sr4fsg && $sb5fsg && $st6fsg != 0){
                  $sl3fsg = $rowaa['price'];
                  $sr4fsg = $rowaa['price'];
                  $sb5fsg = $rowaa['price'];
                  $st6fsg = $rowaa['price'];
                  }
                 */

                if ($sl3fsg != 0) {
                    $sl3fsg = $rowaa['price'];
                }

                if ($sr4fsg != 0) {
                    $sr4fsg = $rowaa['price'];
                }

                if ($sb5fsg != 0) {
                    $sb5fsg = $rowaa['price'];
                }

                if ($st6fsg != 0) {
                    $st6fsg = $rowaa['price'];
                }
            }

            //SG Surface Accurate > 1350mm (surface)
            if ($hypo2 > 1350) {
                $sqlab = "SELECT * FROM $tables2 WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                //            $resultab = $rundb->Query($sqlab);
                $objSqlab = new SQL($sqlab);
                $resultab = $objSqlab->getRowCount();

                if ($resultab == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlab = "SELECT * FROM premachiningadd_outstation WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                      $resultab = $rundb->Query($sqlab);
                      }
                      else{
                      $sqlab = "SELECT * FROM premachiningadd WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                      $resultab = $rundb->Query($sqlab);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlab = "SELECT * FROM $premachaddoutstation WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                    //            $resultab = $rundb->Query($sqlab);
                    $objSqlab = new SQL($sqlab);
                    $resultab = $objSqlab->getRowCount();

                    if ($resultab == 0) {
                        $sqlab = "SELECT * FROM premachiningadd WHERE type = 'Surface Accurate' AND process = 'SG' AND conditions = '> 1350mm'";
                        //                $resultab = $rundb->Query($sqlab);
                        $objSqlab = new SQL($sqlab);
                    }
                }

                $rowab = $objSqlab->getResultOneRowArray();

                /*
                  if($t1asg && $b2asg != 0){
                  $t1asg = $rowab['price'];
                  $b2asg = $rowab['price'];
                  }
                 */

                if ($t1asg != 0) {
                    $t1asg = $rowab['price'];
                }
                if ($materialcode == 'ss303p') {
                    $t1asg = 2 * $t1asg;
                }

                if ($b2asg != 0) {
                    $b2asg = $rowab['price'];
                }
                if ($materialcode == 'ss303p') {
                    $b2asg = 2 * $b2asg;
                }
            }

            //SG Side Accurate 1001mm ~ 1350mm (side width)
            if ($hypo2 > 1000 && $hypo2 <= 1350) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                //        $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                    //            $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                        //                    $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3asg && $sr4asg != 0){
                  $sl3asg = $rowac['price'];
                  $sr4asg = $rowac['price'];
                  }
                 */

                if ($sl3asg != 0) {
                    $sl3asg = $rowac['price'];
                }

                if ($sr4asg != 0) {
                    $sr4asg = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo2 > 1351 && $hypo2 <= 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                //            $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                    //            $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                        //                    $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3asg && $sr4asg != 0){
                  $sl3asg = $rowac['price'];
                  $sr4asg = $rowac['price'];
                  }
                 */

                if ($sl3asg != 0) {
                    $sl3asg = $rowac['price'];
                }

                if ($sr4asg != 0) {
                    $sr4asg = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo2 > 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                //      $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                    //                $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT count(*) FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                        //                    $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sl3asg && $sr4asg != 0){
                  $sl3asg = $rowac['price'];
                  $sr4asg = $rowac['price'];
                  }
                 */

                if ($sl3asg != 0) {
                    $sl3asg = $rowac['price'];
                }

                if ($sr4asg != 0) {
                    $sr4asg = $rowac['price'];
                }
            }

            //SG Side Accurate 1001mm ~ 1350mm (side length)
            if ($hypo3 > 1000 && $hypo3 <= 1350) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                //      $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                    //                $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();
                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1001mm ~ 1350mm'";
                        //                    $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5asg && $st6asg != 0){
                  $sb5asg = $rowac['price'];
                  $st6asg = $rowac['price'];
                  }
                 */

                if ($sb5asg != 0) {
                    $sb5asg = $rowac['price'];
                }

                if ($st6asg != 0) {
                    $st6asg = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo3 > 1351 && $hypo3 <= 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                //      $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                    //        $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '1351mm ~ 2000mm'";
                        //          $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5asg && $st6asg != 0){
                  $sb5asg = $rowac['price'];
                  $st6asg = $rowac['price'];
                  }
                 */

                if ($sb5asg != 0) {
                    $sb5asg = $rowac['price'];
                }

                if ($st6asg != 0) {
                    $st6asg = $rowac['price'];
                }
            }
            //W Side Accurate 1001mm ~ 1350mm
            else if ($hypo3 > 2000) {
                $sqlac = "SELECT count(*) FROM $tables2 WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                //      $resultac = $rundb->Query($sqlac);
                $objSqlac = new SQL($sqlac);
                $resultac = $objSqlac->getRowCount();

                if ($resultac == 0) {
                    /*
                      if($custype == "outstation"){
                      $sqlac = "SELECT * FROM premachiningadd_outstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                      else{
                      $sqlac = "SELECT * FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                      $resultac = $rundb->Query($sqlac);
                      }
                     */
                    $premachaddoutstation = "premachiningadd_" . $custype;

                    $sqlac = "SELECT count(*) FROM $premachaddoutstation WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                    //        $resultac = $rundb->Query($sqlac);
                    $objSqlac = new SQL($sqlac);
                    $resultac = $objSqlac->getRowCount();

                    if ($resultac == 0) {
                        $sqlac = "SELECT count(*) FROM premachiningadd WHERE type = 'Side Accurate' AND process = 'SG' AND conditions = '> 2000mm'";
                        //          $resultac = $rundb->Query($sqlac);
                        $objSqlac = new SQL($sqlac);
                        //                    $resultac = $objSqlac->getRowCount();
                    }
                }

                $rowac = $objSqlac->getResultOneRowArray();

                /*
                  if($sb5asg && $st6asg != 0){
                  $sb5asg = $rowac['price'];
                  $st6asg = $rowac['price'];
                  }
                 */

                if ($sb5asg != 0) {
                    $sb5asg = $rowac['price'];
                }

                if ($st6asg != 0) {
                    $st6asg = $rowac['price'];
                }
            }
        }

        //calculate plate top freesize = plate indicator * width * length * plate proce / 25.4 power of 2
        $top1fp = (($top1 * $width * $length * $t1fw) / pow(25.4, 2)) + (($top1 * $width * $length * $t1frg) / pow(25.4, 2)) + (($top1 * $width * $length * $t1fsg) / pow(25.4, 2));

        //calculate plate bottom freesize = plate indicator * width * length * plate proce / 25.4 power of 2
        $bottom2fp = (($bottom2 * $width * $length * $b2fw) / pow(25.4, 2)) + (($bottom2 * $width * $length * $b2frg) / pow(25.4, 2)) + (($bottom2 * $width * $length * $b2fsg) / pow(25.4, 2));

        //calculate plate side left 3 freesize = plate indicator * thickness * length * plate proce / 25.4 power of 2
        $sidel3fp = (($sidel3 * $thickness * $length * $sl3fw) / pow(25.4, 2)) + (($sidel3 * $thickness * $length * $sl3frg) / pow(25.4, 2)) + (($sidel3 * $thickness * $length * $sl3fsg) / pow(25.4, 2));

        //calculate plate side right 4 freesize = plate indicator * thickness * length * plate proce / 25.4 power of 2
        $sider4fp = (($sider4 * $thickness * $length * $sr4fw) / pow(25.4, 2)) + (($sider4 * $thickness * $length * $sr4frg) / pow(25.4, 2)) + (($sider4 * $thickness * $length * $sr4fsg) / pow(25.4, 2));

        //calculate plate side bottom 5 freesize = plate indicator * thickness * width * plate proce / 25.4 power of 2
        $sideb5fp = (($sideb5 * $thickness * $width * $sb5fw) / pow(25.4, 2)) + (($sideb5 * $thickness * $width * $sb5frg) / pow(25.4, 2)) + (($sideb5 * $thickness * $width * $sb5fsg) / pow(25.4, 2));

        //calculate plate side top 6 freesize = plate indicator * thickness * width * plate proce / 25.4 power of 2
        $sidet6fp = (($sidet6 * $thickness * $width * $st6fw) / pow(25.4, 2)) + (($sidet6 * $thickness * $width * $st6frg) / pow(25.4, 2)) + (($sidet6 * $thickness * $width * $st6fsg) / pow(25.4, 2));

        //calculate plate top accurate = plate indicator * width * length * plate proce / 25.4 power of 2
        $top1ap = (($top1 * $width * $length * $t1aw) / pow(25.4, 2)) + (($top1 * $width * $length * $t1arg) / pow(25.4, 2)) + (($top1 * $width * $length * $t1asg) / pow(25.4, 2));

        //calculate plate bottom accurate = plate indicator * width * length * plate proce / 25.4 power of 2
        $bottom2ap = (($bottom2 * $width * $length * $b2aw) / pow(25.4, 2)) + (($bottom2 * $width * $length * $b2arg) / pow(25.4, 2)) + (($bottom2 * $width * $length * $b2asg) / pow(25.4, 2));

        //calculate plate side left 3 accurate = plate indicator * thickness * length * plate proce / 25.4 power of 2
        $sidel3ap = (($sidel3 * $thickness * $length * $sl3aw) / pow(25.4, 2)) + (($sidel3 * $thickness * $length * $sl3arg) / pow(25.4, 2)) + (($sidel3 * $thickness * $length * $sl3asg) / pow(25.4, 2));

        //calculate plate side right 4 accurate = plate indicator * thickness * length * plate proce / 25.4 power of 2
        $sider4ap = (($sider4 * $thickness * $length * $sr4aw) / pow(25.4, 2)) + (($sider4 * $thickness * $length * $sr4arg) / pow(25.4, 2)) + (($sider4 * $thickness * $length * $sr4asg) / pow(25.4, 2));

        //calculate plate side bottom 5 accurate = plate indicator * thickness * width * plate proce / 25.4 power of 2
        $sideb5ap = (($sideb5 * $thickness * $width * $sb5aw) / pow(25.4, 2)) + (($sideb5 * $thickness * $width * $sb5arg) / pow(25.4, 2)) + (($sideb5 * $thickness * $width * $sb5asg) / pow(25.4, 2));

        //calculate plate side top 6 accurate = plate indicator * thickness * width * plate proce / 25.4 power of 2
        $st6arg = 0.00;
        $sidet6ap = (($sidet6 * $thickness * $width * $st6aw) / pow(25.4, 2)) + (($sidet6 * $thickness * $width * $st6arg) / pow(25.4, 2)) + (($sidet6 * $thickness * $width * $st6asg) / pow(25.4, 2));


        $sumall = $top1fp + $bottom2fp + $sidel3fp + $sider4fp + $sideb5fp + $sidet6fp + $top1ap + $bottom2ap + $sidel3ap + $sider4ap + $sideb5ap + $sidet6ap;
        #####################################################
        # add on L:W Ratio influence premachining price
        # L/W >= 5 , < 7  ==> $sumall * 1.5
        # L/W >= 7 , <10  ==> $sumall * 1.8
        # L/W >= 10       ==> $sumall * 2.0
        #
      # $width = $_GET["mdw"]; //material width
        # $length = $_GET["mdl"]; //m
        $Len = intval($length);
        $Wid = intval($width);
        $LenthWitdhRatio = ($Len / $Wid);

        $Len = intval($length);
        $Wid = intval($width);
        // echo "\$Len = $Len <br>";
        // echo "\$Wid = $Wid <br>";
        $LenthWitdhRatio = ($Len / $Wid);
        // echo "\$LenthWitdhRatio = $LenthWitdhRatio <br>";
        $parameter = NULL;
        #$caseA : 

        switch ($cid) {
            case '22367':
                # code...
                if ($materialcode == "ss303p") {
                    $parameter = 3;
                } else {
                    if ($LenthWitdhRatio - 5 >= 0 AND $LenthWitdhRatio - 7 < 0) {
                        $parameter = 0;
                    } elseif ($LenthWitdhRatio - 7 >= 0 AND $LenthWitdhRatio - 10 < 0) {
                        # code...
                        $parameter = 1;
                    } elseif ($LenthWitdhRatio - 10 >= 0) {
                        # code...
                        $parameter = 2;
                    } else {
                        $parameter = 3;
                    }
                }
                break;
            case '23937':
                # code...
                if ($materialcode == "ss303p") {
                    $parameter = 3;
                } else {
                    if ($LenthWitdhRatio - 5 >= 0 AND $LenthWitdhRatio - 7 < 0) {
                        $parameter = 0;
                    } elseif ($LenthWitdhRatio - 7 >= 0 AND $LenthWitdhRatio - 10 < 0) {
                        # code...
                        $parameter = 1;
                    } elseif ($LenthWitdhRatio - 10 >= 0) {
                        # code...
                        $parameter = 2;
                    } else {
                        $parameter = 3;
                    }
                }
                break;
            case '22326':
                # code...
                $parameter = 3;
                break;
            case '540':
                # code...
                $parameter = 3;
                break;
            case '21630'://Leader Range Technology Sdn BhD
                # code...
                $parameter = 3;
                break;
            case '20530'://Benchmark Electronics (M) Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '20506'://Panasonic (M) Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '22038'://Towam Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '433'://Micro Carbide Engineering Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '6617'://TPTW Engineering Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '2030'://Dufu Industries Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '20541'://Nichima Precision Engineering Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '682'://Top Degree (M) Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '20708'://Esquire Technology Sdn Bhd
                # code...
                $parameter = 3;
                break;
            case '21505'://Greatech Integration (M) Sdn Bhd
                # code...
                $parameter = 3;
                break;
            default:
                # code...
                if ($LenthWitdhRatio - 5 >= 0 AND $LenthWitdhRatio - 7 < 0) {
                    $parameter = 0;
                } elseif ($LenthWitdhRatio - 7 >= 0 AND $LenthWitdhRatio - 10 < 0) {
                    # code...
                    $parameter = 1;
                } elseif ($LenthWitdhRatio - 10 >= 0) {
                    # code...
                    $parameter = 2;
                } else {
                    $parameter = 3;
                }

                break;
        }

        #$caseB : $LenthWitdhRatio - 7 >= 0 AND $LenthWitdhRatio - 10 <0
        #$caseC  : $LenthWitdhRatio - 10 >= 0 
        // $LenthWitdhRatio = 


        switch ($parameter) {
            case '0':
                # code...
                $sumall = $sumall * 1.5;

                break;
            case '1':
                # code...
                $sumall = $sumall * 1.8;

                break;
            case '2':
                # code...
                $sumall = $sumall * 2;

                break;
            case '3':
                # code...
                $sumall = $sumall * 1;

                break;
            default:
                # code...
                echo "Exception in compare $parameter";
                break;
        }
        // echo "\$sumall = $sumall <br>";
        $total = number_format(round($sumall, 1), 2, '.', '');
        ## here 
        $tables3 = 'premachiningmin_' . strtolower($com) . '_' . $cid;

        //$sql2 = "SELECT * FROM $tables3 WHERE material = '$materialcode'";
        $sql2 = "SELECT count(*) FROM $tables3 WHERE pmmid = '$processcode'";
        //  $result2 = $rundb->Query($sql2);
        $objSql2 = new SQL($sql2);
        $result2 = $objSql2->getRowCount();

        if ($result2 == 0) {
            //if outstation not found, check for company, possible for indonesia
            $premachminothers = "premachiningmin_" . strtolower($com);

            $sql2 = "SELECT count(*) FROM $premachminothers WHERE pmid = '$processcode'";
            //        $result2 = $rundb->Query($sql2);
            $objSql2 = new SQL($sql2);
            $result2 = $objSql2->getRowCount();

            if ($result2 == 0) {
                //$sql2 = "SELECT * FROM premachiningmin WHERE material = '$materialcode'";
                $sql2 = "SELECT count(*) FROM premachiningmin WHERE pmmid = '$processcode'";
                //            $result2 = $rundb->Query($sql2);
                $objSql2 = new SQL($sql2);
            }
        }

        $numrows2 = $objSql2->getRowCount();

        //$proc = $row['process'];
        $proc = $materialcode;


        $puretotal = 0.00;
        if ($numrows2 != 0) { //if material found
            $sql2 = "SELECT * FROM premachiningmin WHERE pmmid = '$processcode'";
            $objSql2 = new SQL($sql2);
            $row2 = $objSql2->getResultOneRowArray();
//            echo "list down $row2 array:-<br>";
//            print_r($row2);
//            echo "<br>";
            $samplevalue = '';
            foreach ($row2 as $key => $value) {



                ${$key} = $value;
                $key = trim($key);
                $materialcode = trim($materialcode);
                if ($key === $materialcode) {
                    //print "\$key is indentical with \$material ......"." $key === $materialcode";
                    $samplevalue = $value;
                } else {
                    // print "\$key is not indentical with \$material ......"." $key !=$materialcode";
                }
                //echo "<br>"."$key : $value\n"."<br>";
//                   echo "\$row2['$key'] : $value\n"."<br>";
            }
            //echo "\$proc = $proc , \$samplevalue = $samplevalue <br>";
            if ($samplevalue > $total) {
                $puretotal = $samplevalue;
            } else {
                $puretotal = $total;
            }
        } else { //if material not found
            $puretotal = $total;
        }

        //if company is Formosa Prosonic Mfg. Sdn Bhd, id 185 ********************************************************************************
        if (($com == "PMT" && $cid == 140) || ($com == "PST" && $cid == 199) || ($com == "PHH" && $cid == 1088)) {
            if ($proc == "6WA6SGA") {
                if ($total <= 50) { //use total to skip minimum charges
                    $puretotal = "100.00";
                } else if ($total > 50 && $total <= 80) {
                    $puretotal = "150.00";
                } else if ($total > 80 && $total <= 100) {
                    $puretotal = "180.00";
                } else if ($total > 100 && $total <= 150) {
                    $puretotal = "230.00";
                } else if ($total > 150 && $total <= 200) {
                    $puretotal = "300.00";
                } else if ($total > 200 && $total <= 250) {
                    $puretotal = "380.00";
                } else if ($total > 250 && $total <= 450) {
                    $puretotal = "450.00";
                } else {
                    $puretotal = $total;
                }
            }
        }

//      if($centsincluded == "no"){
//            $puretotal = number_format(round($puretotal, 0), 0, '.', '');
//      }
//      else{
        $puretotal = number_format(round($puretotal, 1), 2, '.', '');
//      }  
    }

    $hint = $puretotal;


    // Set output to "no suggestion" if no hint were found
    // or to the correct values
    if ($hint == "") {
        $response = "";
    } else {
        $response = $hint;
    }

    //output the response
    //echo $response;
    return $response;
}
?>

