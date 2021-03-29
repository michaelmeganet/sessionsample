<?php
include '../class/dbh.inc.php';
include '../class/variables.inc.php';
$materialcode = '12379p_pst_540';
$sql3 = "SELECT * FROM $materialcode WHERE width = '400'";
$objSql3 = new SQL($sql3);
$result3 = $objSql3->getResultRowArray();
$thick = 140;
//print_r($result3);

echo "<br>";
foreach ($result3 as $row3) {
# code...

    foreach ($row3 as $key => $value) {
            ${$key} = $value;
//          echo "$key : $value\n"."<br>";
//                         debug_to_console("$key => $value");
    if($thick >= $row3['thickness']){
      $priceGet = $row3['price'];
      $densityGet = $row3['density'];
      break;
    }
      }
      

}       
echo "\$priceGet = $priceGet , \$densityGet = $densityGet , \$thick = $thick <br>";


?>