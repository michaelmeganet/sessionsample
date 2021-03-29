<?php
//include 'header.php';
//include_once("../class/dbh.inc.php");
//include_once("../class/variables.inc.php");## from other page first
//include_once("../class/quotation.inc.php");
//include_once("../class/customers.inc.php");
//include '../class/phhdate.inc.php';

include 'matcalculation.inc.php';
include 'pmach.inc.php';
global $qid;
$objqid = new QID($period, $cid);
$qid = $objqid->qid;
echo " qid = $qid <br>";
//$objItemno = new ITEMNO($quotab,$cid,$bid,$period,$company);
//$itemno = $objItemno->
?>


<script type="text/javascript"  >
<?php

function debug_to_console($data) {

    if (is_array($data)) {
        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    } else {
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";


        echo $output;
    }
}
function getThickListByMaterial($mat){
    $qr = "SELECT * FROM {$mat}";
    $thickSQL = new SQL($qr);
    $thickRow = $thickSQL->getResultRowArray();
    if (!empty($thickRow)){
        $result = $thickRow;
    }else{
        $result = 'empty';
    }
    return $result;
}

function getAngleWidthList($mat){
    
}

?>
</script>
<?php
if (isset($objReg)) {
    //echo "\$objReg is initialized <br>";
//    $getcid = $objReg->get_cid();
//    $getperiod = $objReg->get_period();
//    $getquotab = $objReg->get_quotab($quotab);
    //echo "\$getcid = $getcid , \$getperiod =,$getperiod , \$getquotab = $getquotab  <br> ";

    $result = $objReg->list_all_parameter();
    debug_to_console("line 18, This is the list fown of \$ObjReg");
    foreach ($result as $key => $value) {
        ${$key} = $value;
        // echo "$key : $value\n"."<br>";
        debug_to_console("$key => $value");
    }
}

/* if(isset($ObjRegistParam)){
  // echo "\$ObjRegistParam is initialized <br>";


  $result = $ObjRegistParam->list_all_parameter();
  $_SESSION['$result'] = $result;
  debug_to_console("This is the list down of \$ObjRegistParam");
  foreach ($result as $key => $value) {
  ${$key} = $value;
  //                         echo "$key : $value\n"."<br>";
  debug_to_console("$key => $value");
  }


  } */

    if (isset($_POST['calculate_pmach'])) {
    
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">

</script>
<script >
    function getSelectOptioncustype(sel) {
        //alert(sel.options[sel.selectedIndex].text);
//    var cars = ["10", "20", "30"];
        var tmp = sel.options[sel.selectedIndex].text;
        var tmp2 = sel.options[sel.selectedIndex].value;
        var thick = 100;
        //$('#custype').val(tmp);
        $('#cust_type').val(tmp2);
        console.log(tmp2);

        //document.getElementById("Thick").value = cars;
//    alert(tmp);
        console.log(tmp);

    }

    function getSelectOptionProcess(sel) {
        //alert(sel.options[sel.selectedIndex].text);
//    var cars = ["10", "20", "30"];
        var tmp = sel.options[sel.selectedIndex].text;
        var value = sel.options[sel.selectedIndex].value;
        var thick = 100;
//    $('#process').val(tmp);
        $('#processcode').val(value);
        $('#processname').val(tmp);
        console.log(tmp2);

        //document.getElementById("Thick").value = cars;
//    alert(tmp);
        console.log(tmp);

    }

    function getSelectOptionMaterial(sel) {
        //alert(sel.options[sel.selectedIndex].text);
//    var cars = ["10", "20", "30"];
        var tmp = sel.options[sel.selectedIndex].text;
        var tmp2 = sel.options[sel.selectedIndex].value;
        var thick = 100;
        $('#material').val(tmp);
        $('#mat_name').val(tmp);
        $('#materialcode').val(tmp2);
        console.log(tmp2);

        //document.getElementById("Thick").value = cars;
//    alert(tmp);
        console.log(tmp);

    }
    function getSelectOptionThick(sel) {
        //alert(sel.options[sel.selectedIndex].text);
//    var cars = ["10", "20", "30"];
        var tmp = sel.value;
        var thick = 100;
        $('#fThick').val(tmp);

        //document.getElementById("Thick").value = cars;
//    alert(tmp);
        console.log(tmp);

    }

    function getSelectOptionMaterial_acc(sel) {
        //alert(sel.options[sel.selectedIndex].text);
        var tmp = sel.options[sel.selectedIndex].text;

        $('#material_acc').val(tmp);
//    alert(tmp);
        console.log(tmp);

    }

    function getSelectOptionMaterialcode(sel) {
        //alert(sel.options[sel.selectedIndex].text);
        var tmp = sel.options[sel.selectedIndex].text;

        $('#materialcode').val(tmp);
//    alert(tmp);
        console.log(tmp);

    }


    function getSelectOptionSubcategory(sel) {
        //alert(sel.options[sel.selectedIndex].text);
        var tmp = sel.options[sel.selectedIndex].text;

        $('#subcategory').val(tmp);
//    alert(tmp);
        console.log(tmp);

    }

    function getSelectOptionShaftindicator(sel) {
        //alert(sel.options[sel.selectedIndex].text);
        var tmp = sel.options[sel.selectedIndex].text;

        $('#shaftindicator').val(tmp);
//    alert(tmp);
        console.log(tmp);

    }

</script>
<script>
    $(document).ready(function(){
//        $("#thick").keyup(function () {
//
//            var val = document.getElementById("thick").value;
//            var realval = parseFloat(val);
//            var finish_val = realval - 5;
//            $("#fThick").css("background-color", "lightblue");
//            $("#fThick").val(finish_val);
//        });
//        
//        $("#fThick").keyup(function () {
//
//            var fval = document.getElementById("fThick").value;
//            var finishval = parseFloat(fval);
//            var real_val = finishval + 5;
//            $("#thick").css("background-color", "lavender");
//            $("#thick").val(real_val);
//        });
//
//        $("#width").keyup(function () {
//
//            var val = document.getElementById("width").value;
//            var realval = parseFloat(val);
//            var finish_val = realval - 5;
//            $("#fWidth").css("background-color", "lightblue");
//            $("#fWidth").val(finish_val);
//        });
//        
//        $("#fWidth").keyup(function () {
//
//            var fval = document.getElementById("fWidth").value;
//            var finishval = parseFloat(fval);
//            var real_val = finishval + 5;
//            $("#width").css("background-color", "lavender");
//            $("#width").val(real_val);
//        });
//
//        $("#length").keyup(function () {
//
//            var val = document.getElementById("length").value;
//            var realval = parseFloat(val);
//            var finish_val = realval - 5;
//            $("#fLength").css("background-color", "lightblue");
//            $("#fLength").val(finish_val);
//        });
//        
//        $("#fLength").keyup(function () {
//
//            var fval = document.getElementById("fLength").value;
//            var finishval = parseFloat(fval);
//            var real_val = finishval + 5;
//            $("#length").css("background-color", "lavender");
//            $("#length").val(real_val);
//        });
//        
        $("#T").keyup(function () {
            
            var val = document.getElementById("T").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fT").css("background-color", "lightblue");
            $("#fT").val(finish_val);
        });
        
        $("#fT").keyup(function () {

            var fval = document.getElementById("fT").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#T").css("background-color", "lavender");
            $("#T").val(real_val);
        });
        
        $("#W").keyup(function () {

            var val = document.getElementById("W").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fW").css("background-color", "lightblue");
            $("#fW").val(finish_val);
        });
        
        $("#fW").keyup(function () {

            var fval = document.getElementById("fW").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#W").css("background-color", "lavender");
            $("#W").val(real_val);
        });
        
        $("#L").keyup(function () {

            var val = document.getElementById("L").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fL").css("background-color", "lightblue");
            $("#fL").val(finish_val);
        });
        
        $("#fL").keyup(function () {

            var fval = document.getElementById("fL").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#L").css("background-color", "lavender");
            $("#L").val(real_val);
        });
        
        $("#PHI").keyup(function () {

            var val = document.getElementById("PHI").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fPHI").css("background-color", "lightblue");
            $("#fPHI").val(finish_val);
        });
        
        $("#fPHI").keyup(function () {

            var fval = document.getElementById("fPHI").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#PHI").css("background-color", "lavender");
            $("#PHI").val(real_val);
        });
        
        $("#HEX").keyup(function () {

            var val = document.getElementById("HEX").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fHEX").css("background-color", "lightblue");
            $("#fHEX").val(finish_val);
        });
        
        $("#fHEX").keyup(function () {

            var fval = document.getElementById("fHEX").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#HEX").css("background-color", "lavender");
            $("#HEX").val(real_val);
        });
        
        $("#DIA").keyup(function () {

            var val = document.getElementById("DIA").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fDIA").css("background-color", "lightblue");
            $("#fDIA").val(finish_val);
        });
        
        $("#fDIA").keyup(function () {

            var fval = document.getElementById("fDIA").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#DIA").css("background-color", "lavender");
            $("#DIA").val(real_val);
        });
        
        $("#OD").keyup(function () {

            var val = document.getElementById("OD").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fOD").css("background-color", "lightblue");
            $("#fOD").val(finish_val);
        });
        
        $("#fOD").keyup(function () {

            var fval = document.getElementById("fOD").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#OD").css("background-color", "lavender");
            $("#OD").val(real_val);
        });
        
        $("#ID").keyup(function () {

            var val = document.getElementById("ID").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fID").css("background-color", "lightblue");
            $("#fID").val(finish_val);
        });
        
        $("#fID").keyup(function () {

            var fval = document.getElementById("fID").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#ID").css("background-color", "lavender");
            $("#ID").val(real_val);
        });
        
        $("#W1").keyup(function () {

            var val = document.getElementById("W1").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fW1").css("background-color", "lightblue");
            $("#fW1").val(finish_val);
        });
        
        $("#fW1").keyup(function () {

            var fval = document.getElementById("fW1").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#W1").css("background-color", "lavender");
            $("#W1").val(real_val);
        });
        
        $("#W2").keyup(function () {

            var val = document.getElementById("W2").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fW2").css("background-color", "lightblue");
            $("#fW2").val(finish_val);
        });
        
        $("#fW2").keyup(function () {

            var fval = document.getElementById("fW2").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#W2").css("background-color", "lavender");
            $("#W2").val(real_val);
        });
        
        $("#A").keyup(function () {

            var val = document.getElementById("A").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fA").css("background-color", "lightblue");
            $("#fA").val(finish_val);
        });
        
        $("#fA").keyup(function () {

            var fval = document.getElementById("fA").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#A").css("background-color", "lavender");
            $("#A").val(real_val);
        });
        
        $("#H").keyup(function () {

            var val = document.getElementById("H").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fH").css("background-color", "lightblue");
            $("#fH").val(finish_val);
        });
        
        $("#fH").keyup(function () {

            var fval = document.getElementById("fH").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#H").css("background-color", "lavender");
            $("#H").val(real_val);
        });
        
        $("#C").keyup(function () {

            var val = document.getElementById("C").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fC").css("background-color", "lightblue");
            $("#fC").val(finish_val);
        });
        
        $("#fC").keyup(function () {

            var fval = document.getElementById("fC").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#C").css("background-color", "lavender");
            $("#C").val(real_val);
        });
        
        $("#ribT").keyup(function () {

            var val = document.getElementById("ribT").value;
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $("#fribT").css("background-color", "lightblue");
            $("#fribT").val(finish_val);
        });
        
        $("#fribT").keyup(function () {

            var fval = document.getElementById("fribT").value;
            var finishval = parseFloat(fval);
            var real_val = finishval + 5;
            $("#ribT").css("background-color", "lavender");
            $("#ribT").val(real_val);
        });
    });

    </script>
<script>
    var $my_form = $("#createForm");
    $my_form.validate(function ($form, e) {
        alert("submitted");
    });
</script>
        <div class='container'>
            <div class="row content">
                <a  href="index.php"  class="button button-purple mt-12 pull-right">View Material List</a> 
                <!--Quotation Main Area-->
                <h3>Create QUOTATION</h3>
                <?php
                if (!isset($_POST['cust_type'])){?>
                <select name='custype' id="custype" onchange='getSelectOptioncustype(this)'>
                    <option value='local' selected>Local</option>
                    <option value='outstation'>Outstation</option>
                    <option value='melaka'>Melaka</option>
                </select>
                <?php
                }else{
                    $tmp = $_POST['cust_type'];
                    echo "<input type =\"text\" name=\"cust_disp\" id=\"cust_disp\" value=\"$tmp\" readonly=\"true\" />";
                }
                ?>
                <p align='right'>
                    <a href='index.php' class='button button-purple mt-12 pull-right'>View Material List</a>
                </p>
                <hr/>
                <div class='row'>
                    <div class='col-lg-4'>
                        <!--Begin Form for Quotation-->
                        <form method='post' action=''>
                            <?php
                            //Begin Hidden Post Input Area
                            if(isset($_POST)){
                                debug_to_console("This is the data of \$dataPOST : ");
                                foreach($_POST as $keyPOST => $dataPOST){
                                    $keydataPOST = $keyPOST." => ".$dataPOST;
                                    debug_to_console($keydataPOST);
                                }
                                ?>
                            <!--Data from previous Page-->
                                <input type="hidden" name="aid" id="aid" value="<?php echo "$aid"; ?> ">
                                <input type="hidden" name="bid" id="bid" value="<?php echo "$bid"; ?> ">
                                <input type="hidden" name="com" id="com" value="<?php echo "$com"; ?> ">    
                                <input type="hidden" name="cid" id="cid" value="<?php echo "$cid"; ?> ">
                                <input type="hidden" name="period" id="period" value="<?php echo "$period"; ?> ">
                                <input type="hidden" name="quotab" id="quotab" value="<?php echo "$quotab"; ?> ">
                            <?php
                                if(isset($_POST['quantity'])){
                                    $postquantity = $_POST['quantity'];
                                    echo "<input type='hidden' name='quantity' id='quantity' value='{$quantity}'>";
                                }
                                if(isset($_POST['specialShapeOrder'])){
                                    echo "specialShapeOrder= = ".$_POST['specialShapeOrder'];
                                    $specialShapeOrder = $_POST['specialShapeOrder'];
                                    echo "<input type='hidden' name='specialShapeOrder' id='specialShapeOrder' value='{$specialShapeOrder}'>";
                                }
                                if(isset($_POST['mat_name'])){
                                    $matname = $_POST['mat_name'];
                                    echo "<input type='hidden' name='mat_name' id='mat_name' value='{$matname}'>";
                                }
                                if(isset($_POST['mat'])){
                                    $mat = $_POST['mat'];
                                    echo "\$mat = $mat";
                                    echo "<input type='hidden' name='mat' id='mat' value='{$mat}'>";
                                }
                                if(isset($_POST['materialcode'])){
                                    $materialcode = $_POST['materialcode'];
                                    echo "<input type='hidden' name='materialcode' id='materialcode' value='{$materialcode}'>";
                                }
                                if(isset($_POST['showDimension'])){
                                    $showDimension = $_POST['showDimension'];
                                    echo "<input type='hidden' name='showDimension' id='showDimension' value='{$showDimension}'>";
                                }
                                if(isset($_POST['calculate_weight'])){
                                    $calculate_weight = $_POST['calculate_weight'];
                                    echo "<input type='hidden' name='calculate_weight' id='calculate_weight' value='{$calculate_weight}'>";
                                }
                            
                            }
                            //End Hidden Post Input Area
                            ?>
                            <p>Step 1, Item#1</p>
                            <p><!--Customer Type Textbox Area-->
                                <span>Customer Type :</span>
                                <input type="text" name="cust_type" id="cust_type" value="local" readonly ="true"/>
                            </p>
                            <p><!--Quantity Text Box Area-->
                                <span>Quantity :</span>
                                <?php
                                    if(isset($postquantity)){
                                        echo "<input type='integer' list='qty' name='quantity' id='quantity' value='{$postquantity}' readonly='readonly'>";
                                    }else{
                                        ?>
                                        <input type='integer' list='qty' id='quantity' name='quantity' value='' placeholder='Quantity'/>
                                        <datalist id='qty'>                                        
                                        <?php
                                        for ($i=0; $i<100; $i++){
                                            echo "<option>$i</option>";
                                        }
                                        ?>
                                        </datalist>
                                        <?php
                                    }
                                ?>
                            </p>
                            <p><!--Special Shape Order Area-->
                                <?php
                                if(!isset($_POST['specialShapeOrder'])){
                                    ?>
                                    <span>Select Special Shape</span>
                                    <select name='specialShapeOrder' id='specialShapeOrder'>
                                        <option value='NORMAL'>Normal Shape</option>
                                        <option value='PLATEC'>Circular Plate Shape</option>
                                        <option value='PLATECO'>Ring Plate Shape</option>
                                    </select>
                                    <input type='submit' name='submitSpecialShape' id='submitSpecialShape' value='Submit'/>
                                    <?php
                                }elseif(isset($_POST['specialShapeOrder'])){
                                    echo "Shape Order = $specialShapeOrder";
                                    ?>
                                    <p><!--Material Code and Name area-->
                                        <?php
                                        if (!isset($_POST['mat'])&&!isset($_POST['matname'])){
                                        ?>
                                            <span>Material :</span>
                                            <select onchange="getSelectOptionMaterial(this)" class="js-example-basic-single" name='mat' id="mat">
                                                <?php
                                                if($specialShapeOrder!='NORMAL'){
                                                    $sqlcc = "SELECT * FROM material2020 WHERE material LIKE '%ms plate%' AND company='PST'"
                                                            . "ORDER BY material";
                                                }else{
                                                    $sqlcc = "SELECT * FROM material2020 WHERE company='PST'"
                                                            . "ORDER BY material";
                                                }
                                                $objSQL = new SQL($sqlcc);
                                                $resultm = $objSQL->getResultRowArray();
                                                foreach ($resultm as $rowm){
                                                    echo "<option value={$rowm['materialcode']}>{$rowm['material']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type='text' id='mat_name' name='mat_name' value="" readonly/><br>
                                            <input type="text" id="materialcode" name="materialcode" value=""/>
                                            <input type="submit" name="showDimension" id="showDimension" value="Process"/>
                                            
                                        <?php
                                        }else{
                                            if(isset($matname)){
                                                #echo "\$matname = $matname <br>";
                                                ?>
                                                <span>Material Name: </span>
                                                <?php
                                                echo $matname."<br>";
                                                
                                            }
                                            if(isset($materialcode)){
                                                echo "\$materialcode = $materialcode<br>";
                                                ?>
                                                <span>Material Code : </span>
                                                <input type='text' id='materialcode' name="materialcode" value="<?php echo $materialcode;?>" readonly/>
                                               <?php
                                            }
                                        }
                                        ?>
                                    </p>
                                    
                                    <?php
                                    if (isset($_POST['showDimension'])){
                                        $quantity = $postquantity;//transfer post quantity to quantity variable
                                        //variable used :
                                        //$mat : material code
                                        //$quantity : material quantity
                                        //$matname : material name
                                        $SCqr = "SELECT Shape_Code FROM material2020 WHERE materialcode = '{$mat}' AND company = 'PST'";
                                        $SCSQL = new SQL($SCqr);
                                        $resultSC = $SCSQL->getResultOneRowArray();
                                    #    echo "<pre>";
                                    #    print_r($resultSC);
                                    #    echo "</pre>";
                                        $Shape_Code = $resultSC['Shape_Code'];
                                        $_SESSION['Shape_Code'] = $Shape_Code;
                                        ?>
                                        <p><!--Dimension Display Area-->
                                            <?php
                                            if($specialShapeOrder!='NORMAL'){
                                                switch($specialShapeOrder){
                                                    case 'PLATEC':
                                                    ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Circular Cut Plate<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])){
                                                                ?>
                                                                <label for="T">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list="thicklist" name='T' id='T' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="W">
                                                                        <span>Width (W): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W" name="W" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="L">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="DIA">
                                                                        <span>Diameter (DIA): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="DIA" name="DIA" value ="125"  ><br>
                                                                </p>

                                                                <?php
                                                                }else{
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W'])) {
                                                                        $W = $_POST['W'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    if (isset($_POST['DIA'])) {
                                                                        $DIA = $_POST['DIA'];
                                                                    }
                                                                    $mat_code = $mat;
                                                                    $dimension = [$T,$DIA];

                                                                    $objPLATEC = new PLATEC($mat_code,$T,$W,$L,$DIA);
                                                                    $isShapeCodematch = $objPLATEC->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objPLATEC->getDensity();
                                                                        $volume = $objPLATEC->getVolume();
                                                                        $weight = $objPLATEC->getWeight();
                                                                        $unitprice = $objPLATEC->fetchPrice($mat_code,$cid,$com,$weight,$T,$W,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for PLATEC");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="T">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="W">
                                                                            <span>Width (W): </span>
                                                                        </label>
                                                                        <input type="text" id="W" name="W" readonly
                                                                               value=<?php echo "$W"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="L">
                                                                            <span>Length (L): </span>
                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="DIA">
                                                                            <span>Diameter (DIA): </span>
                                                                        </label>
                                                                        <input type="text" id="DIA" name="DIA" readonly
                                                                               value=<?php echo "$DIA"; ?>><br>
                                                                    </p>

                                                                <?php 
                                                                } ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fT">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id='fT'  value="20"  ><br>

                                                                <label for="fW">
                                                                    <span>Finish Width (W): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW" name="fW" value="120"  ><br>
                                                                <label for="fL">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="120"  ><br>
                                                                <label for="fDIA">
                                                                    <span>Finish Diameter (DIA): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fDIA" name="fDIA" value="120"  ><br>

                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW'])) {
                                                                        $fW = $_POST['fW'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }
                                                                    if (isset($_POST['fDIA'])) {
                                                                        $fDIA = $_POST['fDIA'];
                                                                    }

                                                                    ?> 

                                                                <label for="fT">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' name='fT' id='fT'  readonly
                                                                       value=<?php echo "$fT"; ?> ><br>
                                                                <p>       
                                                                    <label for="fW">
                                                                        <span>Finish Width (W): </span>
                                                                    </label>

                                                                    <input type="text" id="fW" name="fW" readonly
                                                                           value=<?php echo "$fW"; ?>           ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="fL">
                                                                        <span>Finish Length (L): </span>
                                                                    </label>

                                                                    <input type="text" id="fL" name="fL" readonly
                                                                           value=<?php echo "$fL"; ?>           ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="fDIA">
                                                                        <span>Finish Diameter (DIA): </span>
                                                                    </label>

                                                                    <input type="text" id="fDIA" name="fDIA" readonly
                                                                           value=<?php echo "$fDIA"; ?>           ><br>
                                                                </p>

                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section> 
                                                        <?php

                                                        break;
                                                    case 'PLATECO':
                                                        //PLATECO dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Circular Ring Cut Plate<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='T' id='T' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="W">
                                                                        <span>Width (W): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W" name="W" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="L">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="ID">
                                                                        <span>Inner Diameter (ID): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="ID" name="ID" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="DIA">
                                                                        <span>Outer Diameter (DIA): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="DIA" name="DIA"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W'])) {
                                                                        $W = $_POST['W'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    if (isset($_POST['ID'])) {
                                                                        $ID = $_POST['ID'];
                                                                    }
                                                                    if (isset($_POST['DIA'])) {
                                                                        $DIA = $_POST['DIA'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$T,$ID,$DIA];

                                                                    $objPLATECO = new PLATECO($mat_code,$T,$W,$L,$DIA,$ID);
                                                                    $isShapeCodematch = $objPLATECO->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objPLATECO->getDensity();
                                                                        $volume = $objPLATECO->getVolume();
                                                                        $weight = $objPLATECO->getWeight();
                                                                        $unitprice = $objPLATECO->fetchPrice($mat_code,$cid,$com,$weight,$T,$W,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for PLATECO");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="T">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="W">
                                                                            <span>Width (W): </span>
                                                                        </label
                                                                        <input type="text" id="W" name="W" readonly
                                                                               value=<?php echo "$W"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="L">
                                                                            <span>Length (L): </span>
                                                                        </label
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="ID">
                                                                            <span>Inner Diameter (ID): </span>
                                                                        </label
                                                                        <input type="text" id="ID" name="ID" readonly
                                                                               value=<?php echo "$ID"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="DIA">
                                                                            <span>Outer Diameter (DIA): </span>

                                                                        </label>
                                                                        <input type="text" id="DIA" name="DIA" readonly
                                                                               value=<?php echo "$DIA"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fT">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id="fT"  value="20"  ><br>
                                                                <label for="fW">
                                                                    <span>Finish Width (W): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW" name="fW" value="120"  ><br>
                                                                <label for="fL">
                                                                    <span>Finish Length (fL): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="120"  ><br>


                                                                <label for="fID">
                                                                    <span>Finish Inner Diameter (ID): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fID" name="fID" value="120"  ><br>

                                                                <label for="fDIA">
                                                                    <span>Finish Outer Diameter (DIA): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fDIA" name="fDIA" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW'])) {
                                                                        $fW = $_POST['fW'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }
                                                                    if (isset($_POST['fID'])) {
                                                                        $fID = $_POST['fID'];
                                                                    }
                                                                    if (isset($_POST['fDIA'])) {
                                                                        $fDIA = $_POST['fDIA'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fT">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fT' id='fT'  readonly
                                                                           value=<?php echo "$fT"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fW">
                                                                            <span>Finish Width (W): </span>
                                                                        </label>

                                                                        <input type="text" id="fW" name="fW" readonly
                                                                               value=<?php echo "$fW"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>
                                                                        </label>

                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fID">
                                                                            <span>Finish Inner Diameter (ID): </span>
                                                                        </label>

                                                                        <input type="text" id="fID" name="fID" readonly
                                                                               value=<?php echo "$fID"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fDIA">
                                                                            <span>Finish Outer Diameter (DIA): </span>
                                                                        </label>
                                                                        <input type="text" id="fDIA" name="fDIA" readonly
                                                                               value=<?php echo "$fDIA"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  

                                                        <section>
                                                            
                                                        <?php
                                                        break;
                                                }
                                            }else{

                                                switch ($Shape_Code) {
                                                    case 'PLATEN':
                                                        //PLATEN dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Normal Plate<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='T' id='T' value =''>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="Width">
                                                                        <span>Width (W): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W" name="W" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W'])) {
                                                                        $W = $_POST['W'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$T,$W,$L];

                                                                    $objPLATEN = new PLATEN($mat_code,$T,$W,$L);
                                                                    $isShapeCodematch = $objPLATEN->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objPLATEN->getDensity();
                                                                        $volume = $objPLATEN->getVolume();
                                                                        $weight = $objPLATEN->getWeight();
                                                                        $unitprice = $objPLATEN->fetchPrice($mat_code,$cid,$com,$weight,$T,$W,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for PLATEN");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="Width">
                                                                            <span>Width (W): </span>
                                                                        </label>
                                                                        <input type="text" id="W" name="W" readonly
                                                                               value=<?php echo "$W"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fThick">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id="fT"  value="20"  ><br>


                                                                <label for="fWidth">
                                                                    <span>Finish Width (W): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW" name="fW" value="120"  ><br>

                                                                <label for="Length">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fthick = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW'])) {
                                                                        $fwidth = $_POST['fW'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $flength = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fThick">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fT' id='fT'  readonly
                                                                           value=<?php echo "$fT"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fWidth">
                                                                            <span>Finish Width (W): </span>
                                                                        </label>
                                                                        <input type="text" id="fW" name=f"W" readonly
                                                                           value=<?php echo "$fW"; ?> ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fLength">
                                                                            <span>Finish Length (L): </span>
                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?> ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    
                                                    case 'FLAT':
                                                        //FLAT dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Normal Plate<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='T' id='T' value =''>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="Width">
                                                                        <span>Width (W): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W" name="W" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W'])) {
                                                                        $W = $_POST['W'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$T,$W,$L];

                                                                    $objFLAT = new FLAT($mat_code,$T,$W,$L);
                                                                    $isShapeCodematch = $objFLAT->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objFLAT->getDensity();
                                                                        $volume = $objFLAT->getVolume();
                                                                        $weight = $objFLAT->getWeight();
                                                                        $unitprice = $objFLAT->fetchPrice($mat_code,$cid,$com,$weight,$T,$W,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for FLAT");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="Width">
                                                                            <span>Width (W): </span>
                                                                        </label>
                                                                        <input type="text" id="W" name="W" readonly
                                                                               value=<?php echo "$W"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fThick">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id="fT"  value="20"  ><br>


                                                                <label for="fWidth">
                                                                    <span>Finish Width (W): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW" name="fW" value="120"  ><br>

                                                                <label for="Length">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fthick = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW'])) {
                                                                        $fwidth = $_POST['fW'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $flength = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fT">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fT' id='fT'  readonly
                                                                           value=<?php echo "$fT"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fW">
                                                                            <span>Finish Width (W): </span>
                                                                        </label>
                                                                        <input type="text" id="fW" name=f"W" readonly
                                                                           value=<?php echo "$fW"; ?> ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>
                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?> ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    
                                                    case 'O':
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Circular Rod<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Diameter(PHI): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='PHI' id='PHI' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['PHI'])) {
                                                                        $PHI = $_POST['PHI'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$PHI,$L];

                                                                    $objO = new O($mat_code,$PHI,$L);
                                                                    $isShapeCodematch = $objO->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objO->getDensity();
                                                                        $volume = $objO->getVolume();
                                                                        $weight = $objO->getWeight();
                                                                        $priceperkg = $objO->fetchPrice($mat_code,$cid,$com,$weight,$PHI,$L);
                                                                        $unitprice = $priceperkg * $weight;
                                                                        
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for O");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("priceperkg = ".$priceperkg);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Diameter(PHI): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='P' id='P'  readonly
                                                                           value=<?php echo "$PHI"; ?> ><br>

                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fThick">
                                                                    <span>Finish Diameter(PHI): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fPHI" id="fPHI"  value="20"  ><br>

                                                                <label for="Length">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fLength" name="fLength" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fPHI'])) {
                                                                        $fPHI = $_POST['fPHI'];
                                                                    }
                                                                    if (isset($_POST['fLength'])) {
                                                                        $flength = $_POST['fLength'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fThick">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fPHI' id='fPHI'  readonly
                                                                           value=<?php echo "$fPHI"; ?> ><br>

                                                                    <p> 
                                                                        <label for="fLength">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fLength" name="fLength" readonly
                                                                               value=<?php echo "$flength"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'HEX':
                                                        //HEX dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Hexagonal Rod<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Hexagon Side(HEX): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='HEX' id='HEX' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on material price table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['HEX'])) {
                                                                        $HEX = $_POST['HEX'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$HEX,$L];

                                                                    $objHEX = new HEX($mat_code,$HEX,$L);
                                                                    $isShapeCodematch = $objHEX->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objHEX->getDensity();
                                                                        $volume = $objHEX->getVolume();
                                                                        $weight = $objHEX->getWeight();
                                                                        $unitprice = $objHEX->fetchPrice($mat_code,$cid,$com,$weight,$HEX,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for HEX");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Hexagon Side(HEX): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='HEX' id='HEX'  readonly
                                                                           value=<?php echo "$HEX"; ?> ><br>

                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fThick">
                                                                    <span>Finish Hexagon Side(HEX): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fHEX" id="fHEX"  value="20"  ><br>

                                                                <label for="Length">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fLength" name="fLength" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fHEX'])) {
                                                                        $fHEX = $_POST['fHEX'];
                                                                    }
                                                                    if (isset($_POST['fLength'])) {
                                                                        $flength = $_POST['fLength'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fThick">
                                                                        <span>Finish Hexagon Side(HEX): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fHEX' id='fHEX'  readonly
                                                                           value=<?php echo "$fHEX"; ?> ><br>

                                                                    <p> 
                                                                        <label for="fLength">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fLength" name="fLength" readonly
                                                                               value=<?php echo "$flength"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'SS':
                                                        //SS dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Solid Square Rod<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Width 1(W1): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='W1' id='W1' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="Width">
                                                                        <span>Width 2(W2): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W2" name="W2" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['W1'])) {
                                                                        $W1 = $_POST['W1'];
                                                                    }
                                                                    if (isset($_POST['W2'])) {
                                                                        $W2 = $_POST['W2'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$W1,$W2,$L];

                                                                    $objSS = new SS($mat_code,$W1,$W2,$L);
                                                                    $isShapeCodematch = $objSS->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objSS->getDensity();
                                                                        $volume = $objSS->getVolume();
                                                                        $weight = $objSS->getWeight();
                                                                        $unitprice = $objSS->fetchPrice($mat_code,$cid,$com,$weight,$W1,$W2,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for SS");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Width1">
                                                                        <span>Width 1(W1): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='W1' id='W1'  readonly
                                                                           value=<?php echo "$W1"; ?> ><br>
                                                                    <p>       
                                                                        <label for="Width2">
                                                                            <span>Width 2(W2): </span>

                                                                            <input type="text" id="W2" name="W2" readonly
                                                                                   value=<?php echo "$W2"; ?>><br>
                                                                            </p>
                                                                            <p> 
                                                                                <label for="Length">
                                                                                    <span>Length (L): </span>

                                                                                </label>
                                                                                <input type="text" id="L" name="L" readonly
                                                                                       value=<?php echo "$L"; ?>><br>
                                                                            </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fWidth1">
                                                                    <span>Finish Width 1(W1): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fW1" id="fW1"  value="20"  ><br>


                                                                <label for="fWidth2">
                                                                    <span>Finish Width 2(W2): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW2" name="fW2" value="120"  ><br>

                                                                <label for="fLength">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fLength" name="fLength" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fW1'])) {
                                                                        $fW1 = $_POST['fW1'];
                                                                    }
                                                                    if (isset($_POST['fW2'])) {
                                                                        $fW2 = $_POST['fW2'];
                                                                    }
                                                                    if (isset($_POST['fLength'])) {
                                                                        $flength = $_POST['fLength'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fWidth1">
                                                                        <span>Finish Width 1(W1): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fW1' id='fW1'  readonly
                                                                           value=<?php echo "$fW1"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fWidth2">
                                                                            <span>Finish Width 2(W2): </span>

                                                                            <input type="text" id="fW2" name="fW2" readonly
                                                                                   value=<?php echo "$fW2"; ?>           ><br>
                                                                            </p>
                                                                            <p> 
                                                                                <label for="fLength">
                                                                                    <span>Finish Length (L): </span>

                                                                                </label>
                                                                                <input type="text" id="fLength" name="fLength" readonly
                                                                                       value=<?php echo "$flength"; ?>           ><br>
                                                                            </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'HP': //Hollow Pipe
                                                        //HP dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Hollow Pipe Tube<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="ID">
                                                                    <span>Inner Diameter(ID): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='ID' id='ID' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            $listWidth = (float)$rows['width'];
                                                                            $listThick = (float)$rows['thickness'];
                                                                            $listID = $listWidth - ($listThick * 2);
                                                                            echo "<option>".$listID."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="OD">
                                                                        <span>Outer Diameter (OD): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" list="widthlist" id="OD" name="OD" value =""  ><br>
                                                                    
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['ID'])) {
                                                                        $ID = $_POST['ID'];
                                                                    }
                                                                    if (isset($_POST['OD'])) {
                                                                        $OD = $_POST['OD'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$ID,$OD,$L];

                                                                    $objHP = new HP($mat_code,$ID,$OD,$L);
                                                                    $isShapeCodematch = $objHP->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objHP->getDensity();
                                                                        $volume = $objHP->getVolume();
                                                                        $weight = $objHP->getWeight();
                                                                        $unitprice = $objHP->fetchPrice($mat_code,$cid,$com,$weight,$ID,$OD,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for HP");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="ID">
                                                                        <span>Inner Diameter(ID): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='ID' id='ID'  readonly
                                                                           value=<?php echo "$ID"; ?> ><br>
                                                                    <p>       
                                                                        <label for="OD">
                                                                            <span>Outer Diameter (OD): </span>
                                                                        </label

                                                                        <input type="text" id="OD" name="OD" readonly
                                                                               value=<?php echo "$OD"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fID">
                                                                    <span>Finish Inner Diameter(ID): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fID" id="fID"  value="20"  ><br>


                                                                <label for="fOD">
                                                                    <span>Finish Outer Diameter(OD): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fOD" name="fOD" value="120"  ><br>

                                                                <label for="Length">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fID'])) {
                                                                        $fID = $_POST['fID'];
                                                                    }
                                                                    if (isset($_POST['fOD'])) {
                                                                        $fOD = $_POST['fOD'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fID">
                                                                        <span>Finish Inner Diameter(ID): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fID' id='fID'  readonly
                                                                           value=<?php echo "$fID"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fWidth">
                                                                            <span>Finish Outer Diameter (OD): </span>
                                                                        </label
                                                                        <input type="text" id="fOD" name="fOD" readonly
                                                                               value=<?php echo "$fOD"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fLength">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fLength" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'HS'://Hollow Square
                                                        //HS dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Hollow Square Tube<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='T' id='T' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="Width1">
                                                                        <span>Width 1(W1): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" list='w1list' id="W1" name="W1" value ="125"  ><br>
                                                                    <datalist id="w1list"> <!--List of Thickness based on materialprice table-->
                                                                        <?php
                                                                        $thickList = getThickListByMaterial($mat);
                                                                        if ($thickList !== 'empty'){
                                                                            foreach ($thickList as $rows){
                                                                                if(!isset($rows['W1'])){
                                                                                    $listWidth = str_replace(" ","",trim(strtolower($rows['width'])));
                                                                                    if (stripos($listWidth,'x')){
                                                                                        $arrListWidth = explode("x",$listWidth);//separates two width values into array
                                                                                        sort($arrListWidth);
                                                                                        $listW1 = $arrListWidth['0'];
                                                                                    }else{
                                                                                        $listW1 = $listWidth;
                                                                                    }
                                                                                }else{
                                                                                    $listW1 = $rows['W1'];
                                                                                }
                                                                                echo "<option>".$listW1."</option>";
                                                                            }
                                                                        }else{
                                                                            echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </p>
                                                                <p>       
                                                                    <label for="Width2">
                                                                        <span>Width 2(W2): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W2" name="W2" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W1'])) {
                                                                        $W1 = $_POST['W1'];
                                                                    }
                                                                    if (isset($_POST['W2'])) {
                                                                        $W2 = $_POST['W2'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$T,$W1,$W2,$L];

                                                                    $objHS = new HS($mat_code,$T,$W1,$W2,$L);
                                                                    $isShapeCodematch = $objHS->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objHS->getDensity();
                                                                        $volume = $objHS->getVolume();
                                                                        $weight = $objHS->getWeight();
                                                                        $unitprice = $objHS->fetchPrice($mat_code,$cid,$com,$weight,$T,$W1,$W2,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for HS");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="Width1">
                                                                        <span>Width 1(W1): </span>
                                                                        </label>
                                                                        <input type="text" id="W1" name="W1" readonly
                                                                               value=<?php echo "$W1"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="Width">
                                                                        <span>Width 2(W2): </span>
                                                                        </label>
                                                                        <input type="text" id="W2" name="W2" readonly
                                                                               value=<?php echo "$W2"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fT">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id="fT"  value="20"  ><br>


                                                                <label for="fW1">
                                                                    <span>Finish Width 1(W1): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW1" name="fW1" value="120"  ><br>

                                                                <label for="fW2">
                                                                    <span>Finish Width 2(W2): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW2" name="fW2" value="120"  ><br>

                                                                <label for="L">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW1'])) {
                                                                        $fW1 = $_POST['fW1'];
                                                                    }
                                                                    if (isset($_POST['fW2'])) {
                                                                        $fW2 = $_POST['fW2'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fT">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fT' id='fT'  readonly
                                                                           value=<?php echo "$fT"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fW1">
                                                                            <span>Finish Width 1(W1): </span>
                                                                        </label>
                                                                        <input type="text" id="fW1" name="fW1" readonly
                                                                               value=<?php echo "$fW1"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fW2">
                                                                            <span>Finish Width 2(W2): </span>
                                                                        </label>
                                                                        <input type="text" id="fW2" name="fW2" readonly
                                                                               value=<?php echo "$fW2"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  

                                                        <?php
                                                        break;
                                                    case 'A': //Angle Bar
                                                        //A dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Angled L Bar<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="Thick">
                                                                    <span>Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' list='thicklist' name='T' id='T' value =''><br>
                                                                <datalist id="thicklist"> <!--List of Thickness based on materialprice table-->
                                                                    <?php
                                                                    $thickList = getThickListByMaterial($mat);
                                                                    if ($thickList !== 'empty'){
                                                                        foreach ($thickList as $rows){
                                                                            echo "<option>".$rows['thickness']."</option>";
                                                                        }
                                                                    }else{
                                                                        echo "<option>Cannot find Thickness List, Please Contact Administrator</option>";
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="Width1">
                                                                        <span>Width 1(W1): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W1" name="W1" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="Width2">
                                                                        <span>Width 2(W2): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="W2" name="W2" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['W1'])) {
                                                                        $W1 = $_POST['W1'];
                                                                    }
                                                                    if (isset($_POST['W2'])) {
                                                                        $W2 = $_POST['W2'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$T,$W1,$W2,$L];

                                                                    $objA = new A($mat_code,$T,$W1,$W2,$L);
                                                                    $isShapeCodematch = $objA->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objA->getDensity();
                                                                        $volume = $objA->getVolume();
                                                                        $weight = $objA->getWeight();
                                                                        $unitprice = $objA->fetchPrice($mat_code,$cid,$com,$weight,$T,$W1,$SW2,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for A");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="Thick">
                                                                        <span>Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='T' id='T'  readonly
                                                                           value=<?php echo "$T"; ?> ><br>
                                                                    <p>       
                                                                        <label for="Width1">
                                                                        <span>Width 1(W1): </span>
                                                                        </label>
                                                                        <input type="text" id="W1" name="W1" readonly
                                                                               value=<?php echo "$W1"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="Width">
                                                                        <span>Width 2(W2): </span>
                                                                        </label>
                                                                        <input type="text" id="W2" name="W2" readonly
                                                                               value=<?php echo "$W2"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fThick">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fT" id="fT"  value="20"  ><br>


                                                                <label for="fW1">
                                                                    <span>Finish Width 1(W1): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW1" name="fW1" value="120"  ><br>

                                                                <label for="fW2">
                                                                    <span>Finish Width 2(W2): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fW2" name="fW2" value="120"  ><br>

                                                                <label for="L">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fW1'])) {
                                                                        $fW1 = $_POST['fW1'];
                                                                    }
                                                                    if (isset($_POST['fW2'])) {
                                                                        $fW2 = $_POST['fW2'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fT">
                                                                        <span>Finish Thickness(T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fT' id='fT'  readonly
                                                                           value=<?php echo "$fT"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fW1">
                                                                            <span>Finish Width 1(W1): </span>
                                                                        </label>
                                                                        <input type="text" id="fW1" name="fW1" readonly
                                                                               value=<?php echo "$fW1"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fW2">
                                                                            <span>Finish Width 2(W2): </span>
                                                                        </label>
                                                                        <input type="text" id="fW2" name="fW2" readonly
                                                                               value=<?php echo "$fW2"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  

                                                        <?php
                                                        break;
                                                    case 'LIP': //Lipped Channel
                                                        //A dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  Lipped Channel<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="H">
                                                                    <span>Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' name='H' id='H' value ='25'><br>
                                                                <datalist id="Thicklist">
                                                                    <option>10</option>
                                                                    <option>15</option>
                                                                    <option>20</option>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="A">
                                                                        <span>Horizontal Rib(A): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="A" name="A" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="C">
                                                                        <span>Lip Side(C): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="C" name="C" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="thick">
                                                                        <span>Thickness (T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="T" name="T"  value="150" ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['H'])) {
                                                                        $H = $_POST['H'];
                                                                    }
                                                                    if (isset($_POST['A'])) {
                                                                        $A = $_POST['A'];
                                                                    }
                                                                    if (isset($_POST['C'])) {
                                                                        $C = $_POST['C'];
                                                                    }
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$H,$A,$C,$T,$L];

                                                                    $objLIP = new LIP($mat_code,$H,$A,$C,$T,$L);
                                                                    $isShapeCodematch = $objLIP->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here

                                                                        $density = $objLIP->getDensity();
                                                                        $volume = $objLIP->getVolume();
                                                                        $weight = $objLIP->getWeight();
                                                                        $unitprice = $objLIP->fetchPrice($mat_code,$cid,$com,$weight,$H,$A,$C,$T,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for LIP");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        

                                                                    }
                                                                    ?> 

                                                                    <label for="H">
                                                                        <span>Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='H' id='H'  readonly
                                                                           value=<?php echo "$H"; ?> ><br>
                                                                    <p>       
                                                                        <label for="A">
                                                                        <span>Horizontal Rib(A): </span>
                                                                        </label>
                                                                        <input type="text" id="A" name="A" readonly
                                                                               value=<?php echo "$A"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="C">
                                                                        <span>Lip Side(C): </span>
                                                                        </label>
                                                                        <input type="text" id="C" name="C" readonly
                                                                               value=<?php echo "$C"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="T">
                                                                        <span>Thickness(T): </span>
                                                                        </label>
                                                                        <input type="text" id='T' name="T" readonly
                                                                               value=<?php echo "$T"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fH">
                                                                    <span>Finish Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fH" id="fH"  value="20"  ><br>


                                                                <label for="fA">
                                                                    <span>Finish Horizontal Rib(A): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fA" name="fA" value="120"  ><br>

                                                                <label for="fC">
                                                                    <span>Finish Lip Side(C): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fC" name="fC" value="120"  ><br>

                                                                <label for="fT">
                                                                    <span>Finish Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' id='fT' name='fT' value ='4.5'><br>
                                                                <label for="L">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fH'])) {
                                                                        $fH = $_POST['fH'];
                                                                    }
                                                                    if (isset($_POST['fA'])) {
                                                                        $fA = $_POST['fA'];
                                                                    }
                                                                    if (isset($_POST['fC'])) {
                                                                        $fC = $_POST['fC'];
                                                                    }
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fH">
                                                                        <span>Finish Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fH' id='fH'  readonly
                                                                           value=<?php echo "$fH"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fA">
                                                                            <span>Finish Horizontal Rib(A): </span>
                                                                        </label>
                                                                        <input type="text" id="fA" name="fA" readonly
                                                                               value=<?php echo "$fA"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fC">
                                                                            <span>Finish Lip Side(C): </span>
                                                                        </label>
                                                                        <input type="text" id="fC" name="fC" readonly
                                                                               value=<?php echo "$fC"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fT">
                                                                            <span>Finish Thickness (T): </span>

                                                                        </label>
                                                                        <input type="text" id="fT" name="fT" readonly
                                                                               value=<?php echo "$fT"; ?>           ><br>
                                                                    </p>  
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'C': //C-Channel
                                                        //C dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  C Channel<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="H">
                                                                    <span>Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' name='H' id='H' value ='25'><br>
                                                                <datalist id="Thicklist">
                                                                    <option>10</option>
                                                                    <option>15</option>
                                                                    <option>20</option>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="A">
                                                                        <span>Horizontal Rib(A): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="A" name="A" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="ribT">
                                                                        <span>Vertical Thickness(ribT): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="ribT" name="ribT" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="T">
                                                                        <span>Horizontal Thickness (T): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="T" name="T"  value="150" ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['H'])) {
                                                                        $H = $_POST['H'];
                                                                    }
                                                                    if (isset($_POST['A'])) {
                                                                        $A = $_POST['A'];
                                                                    }
                                                                    if (isset($_POST['T'])) {
                                                                        $T = $_POST['T'];
                                                                    }
                                                                    if (isset($_POST['ribT'])) {
                                                                        $ribT = $_POST['ribT'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$H,$A,$T,$ribT,$L];

                                                                    $objC = new C($mat_code,$H,$A,$T,$ribT,$L);
                                                                    $isShapeCodematch = $objC->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objC->getDensity();
                                                                        $volume = $objC->getVolume();
                                                                        $weight = $objC->getWeight();
                                                                        $unitprice = $objC->fetchPrice($mat_code,$cid,$com,$weight,$H,$A,$T,$ribT,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for C");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        
                                                                    }
                                                                    ?> 

                                                                    <label for="H">
                                                                        <span>Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='H' id='H'  readonly
                                                                           value=<?php echo "$H"; ?> ><br>
                                                                    <p>       
                                                                        <label for="A">
                                                                        <span>Horizontal Rib(A): </span>
                                                                        </label>
                                                                        <input type="text" id="A" name="A" readonly
                                                                               value=<?php echo "$A"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="ribT">
                                                                        <span>Vertical Thickness(ribT): </span>
                                                                        </label>
                                                                        <input type="text" id="ribT" name="ribT" readonly
                                                                               value=<?php echo "$ribT"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="T">
                                                                        <span>Horizontal Thickness(T): </span>
                                                                        </label>
                                                                        <input type="text" id='T' name="T" readonly
                                                                               value=<?php echo "$T"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fH">
                                                                    <span>Finish Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fH" id="fH"  value="20"  ><br>


                                                                <label for="fA">
                                                                    <span>Finish Horizontal Rib(A): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fA" name="fA" value="120"  ><br>

                                                                <label for="ft">
                                                                    <span>Finish Vertical Thickness(ribT): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fribT" name="fribT" value="120"  ><br>

                                                                <label for="fT">
                                                                    <span>Finish Horizontal Thickness(T): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' id='fT' name='fT' value ='4.5'><br>
                                                                <label for="L">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fH'])) {
                                                                        $fH = $_POST['fH'];
                                                                    }
                                                                    if (isset($_POST['fA'])) {
                                                                        $fA = $_POST['fA'];
                                                                    }
                                                                    if (isset($_POST['fT'])) {
                                                                        $fT = $_POST['fT'];
                                                                    }
                                                                    if (isset($_POST['fribT'])) {
                                                                        $fribT = $_POST['fribT'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fH">
                                                                        <span>Finish Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fH' id='fH'  readonly
                                                                           value=<?php echo "$fH"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fA">
                                                                            <span>Finish Horizontal Rib(A): </span>
                                                                        </label>
                                                                        <input type="text" id="fA" name="fA" readonly
                                                                               value=<?php echo "$fA"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fribT">
                                                                            <span>Finish Vertical Thickness(ribT): </span>
                                                                        </label>
                                                                        <input type="text" id="fribT" name="fribT" readonly
                                                                               value=<?php echo "$fribT"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fT">
                                                                            <span>Finish Horizontal Thickness(T): </span>

                                                                        </label>
                                                                        <input type="text" id="fT" name="fT" readonly
                                                                               value=<?php echo "$fT"; ?>           ><br>
                                                                    </p>  
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break;
                                                    case 'H': //I-Beam / H-Beam
                                                        //H dimension here
                                                        ?>
                                                        <section>
                                                            <fieldset>
                                                                <legend>Dimension</legend>
                                                                <p><span>Material Shape  =  I-Beam<span></p>
                                                                <?php 
                                                                if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>
                                                                <label for="H">
                                                                    <span>Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' name='H' id='H' value ='25'><br>
                                                                <datalist id="Thicklist">
                                                                    <option>10</option>
                                                                    <option>15</option>
                                                                    <option>20</option>
                                                                </datalist>
                                                                <p>       
                                                                    <label for="B">
                                                                        <span>Horizontal Flange(B): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="B" name="B" value ="125"  ><br>
                                                                </p>
                                                                <p>       
                                                                    <label for="Tw">
                                                                        <span>Vertical Thickness(Tw): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="Tw" name="Tw" value ="125"  ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Tf">
                                                                        <span>Flange Thickness (Tf): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="Tf" name="Tf"  value="150" ><br>
                                                                </p>
                                                                <p> 
                                                                    <label for="Length">
                                                                        <span>Length (L): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type="text" id="L" name="L"  value="150" ><br>
                                                                </p>
                                                                <?php
                                                                else:
                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    if (isset($_POST['H'])) {
                                                                        $H = $_POST['H'];
                                                                    }
                                                                    if (isset($_POST['A'])) {
                                                                        $A = $_POST['A'];
                                                                    }
                                                                    if (isset($_POST['Tw'])) {
                                                                        $Tw = $_POST['Tw'];
                                                                    }
                                                                    if (isset($_POST['Tf'])) {
                                                                        $Tf = $_POST['Tf'];
                                                                    }
                                                                    if (isset($_POST['L'])) {
                                                                        $L = $_POST['L'];
                                                                    }
                                                                    $mat_code = $_POST['mat'];
                                                                    $dimension = [$H,$B,$Tw,$Tf,$L];

                                                                    $objH = new H($mat_code,$H,$B,$Tf,$Tw,$L);
                                                                    $isShapeCodematch = $objH->isShapeCodeMatch($mat_code);
                                                                    if($isShapeCodematch!='yes'){
                                                                        echo "line 501 - Shape-Code is not matching, please check";

                                                                    }else{
                                                                        //calculate weight and volume here
                                                                        $density = $objH->getDensity();
                                                                        $volume = $objH->getVolume();
                                                                        $weight = $objH->getWeight();
                                                                        $unitprice = $objH->fetchPrice($mat_code,$cid,$com,$weight,$H,$B,$Tf,$Tw,$L);
                                                                       
                                                                        $totalweight = $quantity * $weight; //total weight added with quantity
                                                                        $totalprice = $unitprice * $quantity; 
                                                                        //this is to debug area
                                                                        debug_to_console("This is Price Calculation for H");
                                                                        debug_to_console("density = ".$density);
                                                                        debug_to_console("volume = ".$volume);
                                                                        debug_to_console("weight = ".$weight);
                                                                        debug_to_console("unitprice = ".$unitprice);
                                                                        debug_to_console("totalweight = ".$totalweight);
                                                                        debug_to_console("totalprice = ".$totalprice);
                                                                        

                                                                    }
                                                                    ?> 

                                                                    <label for="H">
                                                                        <span>Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='H' id='H'  readonly
                                                                           value=<?php echo "$H"; ?> ><br>
                                                                    <p>       
                                                                        <label for="B">
                                                                        <span>Horizontal Flange(B): </span>
                                                                        </label>
                                                                        <input type="text" id="B" name="B" readonly
                                                                               value=<?php echo "$B"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="Tw">
                                                                        <span>Vertical Thickness(Tw): </span>
                                                                        </label>
                                                                        <input type="text" id="Tw" name="Tw" readonly
                                                                               value=<?php echo "$Tw"; ?>><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="Tf">
                                                                        <span>Flange Thickness(Tf): </span>
                                                                        </label>
                                                                        <input type="text" id='Tf' name="Tf" readonly
                                                                               value=<?php echo "$Tf"; ?>><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="Length">
                                                                            <span>Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="L" name="L" readonly
                                                                               value=<?php echo "$L"; ?>><br>
                                                                    </p>  
                                                                <?php endif; ?>         
                                                            </fieldset>

                                                        </section>

                                                        <section>

                                                            <fieldset>
                                                                <legend>Finishing Dimensions</legend>
                                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                                ?>                                    
                                                                <label for="fH">
                                                                    <span>Finish Vertical Rib(H): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" name="fH" id="fH"  value="20"  ><br>


                                                                <label for="fB">
                                                                    <span>Finish Horizontal Flange(B): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fB" name="fA" value="120"  ><br>

                                                                <label for="fTw">
                                                                    <span>Finish Vertical Thickness(Tw): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fTw" name="fTw" value="120"  ><br>

                                                                <label for="fTf">
                                                                    <span>Finish Flange Thickness(Tf): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type='text' id='fTf' name='fTf' value ='4.5'><br>
                                                                <label for="L">
                                                                    <span>Finish Length (L): </span>
                                                                    <strong><abbr title="required">*</abbr></strong>
                                                                </label>
                                                                <input type="text" id="fL" name="fL" value="145" ><br>
                                                                <?php
                                                                else:

                                                                    //echo "print_r(\$_POST) <br>";
                                                                    //print_r($_POST);
                                                                    //echo "<br>=============================<br>";
                                                                    if (isset($_POST['fH'])) {
                                                                        $fH = $_POST['fH'];
                                                                    }
                                                                    if (isset($_POST['fB'])) {
                                                                        $fB = $_POST['fB'];
                                                                    }
                                                                    if (isset($_POST['fTw'])) {
                                                                        $fTw = $_POST['fTw'];
                                                                    }
                                                                    if (isset($_POST['fTf'])) {
                                                                        $fribT = $_POST['fTf'];
                                                                    }
                                                                    if (isset($_POST['fL'])) {
                                                                        $fL = $_POST['fL'];
                                                                    }

                                                                    ?> 

                                                                    <label for="fH">
                                                                        <span>Finish Vertical Rib(H): </span>
                                                                        <strong><abbr title="required">*</abbr></strong>
                                                                    </label>
                                                                    <input type='text' name='fH' id='fH'  readonly
                                                                           value=<?php echo "$fH"; ?> ><br>
                                                                    <p>       
                                                                        <label for="fB">
                                                                            <span>Finish Horizontal Rib(B): </span>
                                                                        </label>
                                                                        <input type="text" id="fB" name="fB" readonly
                                                                               value=<?php echo "$fB"; ?>           ><br>
                                                                    </p>
                                                                    <p>       
                                                                        <label for="fTw">
                                                                            <span>Finish Vertical Thickness(Tw): </span>
                                                                        </label>
                                                                        <input type="text" id="fTw" name="fTw" readonly
                                                                               value=<?php echo "$fTw"; ?>           ><br>
                                                                    </p>
                                                                    <p> 
                                                                        <label for="fTf">
                                                                            <span>Finish Flange Thickness(Tf): </span>

                                                                        </label>
                                                                        <input type="text" id="fTf" name="fTf" readonly
                                                                               value=<?php echo "$fTf"; ?>           ><br>
                                                                    </p>  
                                                                    <p> 
                                                                        <label for="fL">
                                                                            <span>Finish Length (L): </span>

                                                                        </label>
                                                                        <input type="text" id="fL" name="fL" readonly
                                                                               value=<?php echo "$fL"; ?>           ><br>
                                                                    </p>  
                                                                <?php endif; ?> 

                                                            </fieldset>

                                                        </section>  
                                                        <?php
                                                        break; 

                                                    default:
                                                        break;
                                                }

                                            }
                                            
                                            ?>
                                            <section>    
                                                <?php if (!isset($_POST['calculate_weight']) && !isset($_POST['calculate_pmach'])):
                                                ?>    
                                                    <p> <button type="submit"  name="calculate_weight"
                                                                id="calculate_weight" value="Submit">Calculate weight</button> </p>
                                                <?php else: ?>
                                                    <p> Calculate weight is done!</p>

                                                <?php endif; ?>
                                            </section> 
                                        </p>
                                        <?php
                                    }
                                }
                                ?>
                                    
                            </p>
                        </form>
                    </div>
                    <?php
                    if (isset($_POST['calculate_weight'])||isset($_POST['calculate_pmach'])){
                        ?>
                        <div class="col-lg-4">
                            <!--Begin step Pre-Mach-->
                            <!--Get all data from previous Step-->
                            <?php
                            $priceperKg = CheckPrice($mat, $cid, $thick, $width, $length)
                            ?>
                            <!--Begin Step 2-->
                            <p>Step 2, item #1</p>
                            <label for="result_weight">
                                <span>Total Weight : </span>
                                <strong></strong>
                                <input type='text' name='totalweight'
                                       id='totalweight' value='<?php echo $totalweight; ?>' readonly/>
                            </label>
                            <?php
                            echo "<br>";
                            str_repeat('$nbsp;',5);
                            ?>
                            <p>
                                <span>Total Material Price (RM) : </span>
                                <?php
                                if(isset($totalprice)){
                                    echo "<input type='text' name='totalprice' id='totalprice' value='{$totalprice}' readonly/>";
                                }
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
                
        </div>
