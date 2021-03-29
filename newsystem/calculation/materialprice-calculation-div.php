<?php

include 'calculation/include-dimension-post.php';


switch ($Shape_Code) {
    case 'PLATEN':
        if ($specialShapeOrder == 'NORMAL') {
            // T W L
            $dimension_array = array('T' => $dT, 'W' => $dW, 'L' => $dL); //Tested, calculated properly
            //Create backwards compatible variable
            $mdt = $dT;
            $mdw = $dW;
            $mdl = $dL;
            $fdt = $fT;
            $fdw = $fW;
            $fdl = $fL;
            //Create new dimension Description
            $dim_desc = "$dT X $dW X $dL";
            $finishing_dim_desc = "$fT X $fW X $fL";
        } else {
            
        }
        break;
    case 'SS':
        $dimension_array = array('W1' => $dW1, 'W2' => $dW2, 'L' => $dL); //Tested, calculated properly
        //create Backwards compatible variable
        $mdt = $dW1;
        $mdw = $dW2;
        $mdl = $dL;
        $fdt = $fW1;
        $fdw = $fW2;
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dW1 X $dW2 X $dL";
        $finishing_dim_desc = "$fW1 X $fW2 X $fL";
        break;
    case 'O':
        $dimension_array = array('PHI' => $dPHI, 'L' => $dL); //Tested, calculation result has difference margin 1.0 - 1.5
        //create Backwards compatible variable
        $mdt = $dPHI;
        $mdw = null;
        $mdl = $dL;
        $fdt = $fPHI;
        $fdw = null;
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dPHI X $dL";
        $finishing_dim_desc = "$fPHI X $fL";
        break;
    case 'HEX':
        $dimension_array = array('HEX' => $dHEX, 'L' => $dL); // Tested, Calculation result has difference margin 1.0 - 1.5
        //create Backwards compatible variable
        $mdt = $dHEX;
        $mdw = null;
        $mdl = $dL;
        $fdt = $fHEX;
        $fdw = null;
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dHEX X $dL";
        $finishing_dim_desc = "$fHEX X $fL";
        break;
    case 'HS':
        $dimension_array = array('T' => $dT, 'W1' => $dW1, 'W2' => $dW2, 'L' => $dL); // Tested, Calculation result has differnece margin 1.0 - 1.5
        //create Backwards compatible variable
        $mdt = $dT;
        $mdw = "$dW1 x $dW2";
        $mdl = $dL;
        $fdt = $fT;
        $fdw = "$fW1 x $fW2";
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dT X $dW1 X $dW2 X $dL";
        $finishing_dim_desc = "$fT X $fW1 X $fW2 X $fL";
        break;
    case 'HP':
        $dimension_array = array('OD' => $dOD, 'ID' => $dID, 'L' => $dL); //Tested, Calculation result has difference margin 1.0
        //create Backwards compatible variable
        $mdt = $dOD;
        $mdw = $dID;
        $mdl = $dL;
        $fdt = $fOD;
        $fdw = $fID;
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dOD X $dID X $dL";
        $finishing_dim_desc = "$fOD X $fID X $fL";
        break;
    case 'FLAT':
        $dimension_array = array('T' => $dT, 'W' => $dW, 'L' => $dL); //Tested, Calculation result has difference margin 1.0 - 1.5
        //create Backwards compatible variable
        $mdt = $dT;
        $mdw = $dW;
        $mdl = $dL;
        $fdt = $fT;
        $fdw = $fW;
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dT X $dW X $dL";
        $finishing_dim_desc = "$fT X $fW X $fL";
        break;
    case 'A':
        $dimension_array = array('T' => $dT, 'W1' => $dW1, 'W2' => $dW2, 'L' => $dL);
        //create Backwards compatible variable
        $mdt = $dT;
        $mdw = "$dW1 x $dW2";
        $mdl = $dL;
        $fdt = $fT;
        $fdw = "$fW1 x $fW2";
        $fdl = $fL;
        //Create new dimension Description
        $dim_desc = "$dT X $dW1 X $dW2 X $dL";
        $finishing_dim_desc = "$fT X $fW1 X $fW2 X $fL";
        break;
    case 'C':

        break;
    case 'LIP':
        break;
    case 'H':
        break;
}
$objMATPRICE = new \Dimension\MaterialPrice\MATERIAL_SPECIAL_PRICE_CID($post_cid, $com, $mat, $dimension_array);
$volume = $objMATPRICE->getVolume();
#echo "\$volume = $volume<br>";
$weight = $objMATPRICE->getWeight();
#echo "\$weight = $weight<br>";
$density = $objMATPRICE->getDensity();
#echo "\$density = $density<br>";
$pricePerKG = $objMATPRICE->getPricePerKG();
#echo "\$pricePerKG = $pricePerKG<br>";
$pricePerPCS = $objMATPRICE->getPricePerPcs();
#echo "\$pricePerPCS = $pricePerPCS<br>";
$minPrice = $objMATPRICE->getMinPrice($pricePerPCS, $com, $post_cid);
#echo "\$minPrice = $minPrice<br>";
if ($pricePerPCS != 0) {
    if ($minPrice > 0) {
        #echo "<span style='color:blue; font-size:1.2em; font-weight:bold;'>PricePerPCS ($pricePerPCS) is lower than MinPrice($minPrice)</span><br>";
        $pricePerPCS = $minPrice;
    }
}
$totalweight = round($quantity * $weight , 2);
$totalprice = round($quantity * $pricePerPCS, 2);
?>