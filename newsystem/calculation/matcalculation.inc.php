<?php

//include 'dbh.inc.php';
//include 'variables.inc.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templatess
 * and open the template in the editor.
 */
function CalVolume($thick, $width, $length, $shaft, $shaftindicator) {

    if ($shaft == 'no') {
        $vol = $thick * $width * $length;
        return $vol;
    } elseif ($shaft == 'yes' && $shaftindicator == 'Dia') {

        //echo "\$vol = $thick x $thick x $length <br>";
        $vol = $thick * $thick * $length;
        return $vol;
    } else {
        //  echo "\$vol = $thick x $thick x $length <br>";
        $vol = $thick * $thick * $length;
        return $vol;
    }
}

function getunitPrice2($resultArray, $thick) {
    // echo "in Fucntion getunitPrice2 line 26 <br>";
    //echo "\$thick = $thick <br>";
//        echo "print_r(\$resultArray)";
//        print_r($resultArray);
//        echo "#####################<br>";
//        echo "\$thick = $thick <br>";
    foreach ($resultArray as $row) {
        # code...

        foreach ($row as $key => $value) {
            ${$key} = $value;
            //echo "$key : $value\n"."<br>";
            debug_to_console("$key => $value");
            $thickness = $row['thickness'];

            if ($thick == $thickness) {
                //    print "\$thick = $thick , \$thickness = $thickness <br>";
                $priceGet = floatval($row['price']);
                //echo "\$priceGet = $priceGet <br>";
                return $priceGet;
            }
        }
    }
}

function CheckPrice($mat, $cid, $thick, $width, $length) {

    ##matcode = 12379p
    debug_to_console("line 17, This is the CheckPrice Funciton");
    debug_to_console($mat);
    debug_to_console($cid);

    switch ($mat) {
        case '12379p':
            $sql = "SELECT * FROM $mat ";
            //echo "line 24, \$sql3 = $sql3<br>";
            $objSql = new SQL($sql);
            $result = $objSql->getResultRowArray();
            // echo "list array \$result <br>";
            // print_r($result);
            // echo "######################<br>";

            $priceGet = getunitPrice2($result, $thick);
            return $priceGet;
            /* foreach ($result3 as $row3) {
              # code...

              foreach ($row3 as $key => $value) {
              ${$key} = $value;
              //          echo "$key : $value\n"."<br>";
              //                         debug_to_console("$key => $value");
              if($thick >= $row3['thickness']){
              $priceGet = $row3['price'];
              $densityGet = $row3['density'];
              return $priceGet;
              break;
              }
              }


              } */
            //echo "\$priceGet = $priceGet , \$densityGet = $densityGet , \$thick = $thick <br>";



            break;
        case '12379s':
            //echo "Function CheckPrice , in case 12379s <br> ";
            $sql3 = "SELECT * FROM $mat ";
            //echo "line 24, \$sql3 = $sql3<br>";
            $objSql = new SQL($sql3);
            $result = $objSql->getResultRowArray();

            $priceGet = getunitPrice2($result, $thick);
            // echo "\$priceGet = $priceGet <br>";
            return floatval($priceGet);


            break;
        default:
            # code...
            //echo "Function CheckPrice , in default caase <br> ";

            $priceGet = 0.00;
            // echo "\$priceGet = $priceGet <br>";
            return $priceGet;
            break;
    }
}

function checkDensity($mat) {



    $sqlMaterial = "SELECT shaft, shaftindicator, materialtype FROM  "
            . "material WHERE materialcode = '$mat' and company = 'PST' ";
    $objMtype = new SQL($sqlMaterial);
    $materialArray = $objMtype->getResultOneRowArray();
//                    echo "\$materialtype = $materialtype<br>";
    //echo "<br>---\$matrialArray ------ array form<br>";
    //print_r($materialArray);
    $materialtype = $materialArray['materialtype']; //get materialtype
    $isShaft = $materialArray['shaft']; //get is shaft or not shaft
    $shaftindicator = $materialArray['shaftindicator']; //get shaftindicator

    $sqlDensity = "SELECT * FROM  material_density WHERE materialtype  = '$materialtype';";
    $objdensity = new SQL($sqlDensity);

    $resultArray = $objdensity->getResultRowArray();
    //echo "<br>---\$resultArray for density ------ array form<br>";
    //print_r($resultArray);
    $density_of_plate = $resultArray[0]['plate'];
    $density_of_shaft = $resultArray[0]['shaft'];

    if ($isShaft == 'no') {
        $density = $density_of_plate;
    } elseif ($isShaft == 'yes') {

        if ($shaftindicator == 'Dia') {

            $density = $density_of_shaft;
        }
    }
    return $density;
}

function CalMat12379p($mat, $thick, $width, $length) {

    $volmue = CalVolume($thick, $width, $length);

    $density = checkDensity($mat);

    //echo "\$volmue = $volmue , \$density = $density <br> ";

    $weight = $volmue * $density;

    //echo "\$weight = $weight <br>";

    return $weight;
}

function CheckShaft($mat, $width) {


    $sql = "SELECT shaft, shaftindicator FROM  material WHERE materialcode = '$mat' and company = 'PST' ";
    //echo "\$sql = $sql <br>";
    debug_to_console("function CheckShaft line 167 , \$sql = $sql");
    $objsql = new SQL($sql);

    $result = $objsql->getResultOneRowArray();

    $shaft = $result['shaft'];
    $shaftindicator = $result['shaftindicator'];


    return $result;
}

class MaterialCal {

    protected $mat; // material code
    protected $thick; // cut thickness
    protected $width; // cut widtrh
    protected $length; // cut length
    protected $fthick; // finish thickness
    protected $fwidth; // finish width
    protected $flength; //finish length

    public function __construct($mat, $thick, $width, $length, $fthick, $fwidth, $flength, $cid) {

        $this->mat = $mat;
        $this->thick = floatval($thick);
        $this->width = floatval($width);
        $this->length = floatval($length);
        $this->fthick = floatval($fthick);
        $this->fwidth = floatval($fwidth);
        $this->flength = floatval($flength);
        $this->cid = $cid;
    }

    public function reCalculateDimension() {

        $mat = $this->mat;
        $thick = $this->thick;
        $width = $this->width;
        $length = $this->length;
        $fthick = $this->fthick;
        $fwidth = $this->fwidth;
        $flength = $this->flength;

        $deltaT = floatval($thick) - floatval($fthick);
        $deltaW = floatval($width) - floatval($fwidth);
        $deltaL = floatval($length) - floatval($flength);
        //    echo "in funciton reCalculateDimension()<br>";
        //    echo "\$deltaT = $deltaT , \$deltaW = $deltaW , \$deltaL = $deltaL <br>";

        $isShaftArray = CheckShaft($mat, $width);
        //print_r($isShaftArray);
        $isShaft = $isShaftArray['shaft'];
        $shaftindicator = $isShaftArray['shaftindicator'];
        //    echo "\$isShaft = $isShaft , \$shaftindicator = $shaftindicator <br>";

        if ($isShaft == 'no') {
            if ($deltaT > 0) {

                if ($deltaW > 0) {

                    if ($thick > 100) {

                        //thickness > 100 mm
                        $thick = floatval($thick);
                        $width = floatval($fwidth) + 10.00;
                        $length = floatval($flength) + 10.00;
                    } else {
                        //thickness <= 100 mm

                        $thick = floatval($thick);
                        $width = floatval($fwidth) + 5.00;
                        $length = floatval($flength) + 5.00;
                    }
                    # code...
                    $resultArray = [];
                    $resultArray['thick'] = $thick;
                    $resultArray['width'] = $width;
                    $resultArray['length'] = $length;
                    return $resultArray;
                }
            }
        } else if ($isShaft == 'yes') {

            if ($shaftindicator == 'Dia') {

                if ($thick > 100) {
                    $thick = floatval($fthick) + 10.00; //Dia

                    $length = floatval($flength) + 10.00;
                } else {

                    $thick = floatval($fthick) + 5; //Dia

                    $length = floatval($flength) + 5.00;
                }

                $resultArray = [];
                $resultArray['thick'] = $thick; //Dis
                $resultArray['width'] = '';
                $resultArray['length'] = $length;
                return $resultArray;
            }
        }
    }

    public function CalMaterialWeight() {

        $mat = $this->mat;
        $thick = $this->thick;
        $width = $this->width;
        $length = $this->length;
        $fthick = $this->fthick;
        $fwidth = $this->fwidth;
        $flength = $this->flength;
        $cid = $this->cid;


        ## recalculation the thick ness
        if ($mat == '12379p') {


            $weight = CalMat12379p($mat, $thick, $width, $length, $cid);

            return $weight;
        }
    }

}
