<?php
$infomsg = '';
if (isset($_POST['submitTotal'])) {
    $objCQuoNoList = new QUONO_LIST($_POST, $arr_dtlCustomer);
    $dtest = $objCQuoNoList->insertQuonolist();
    #$dtest = $objCQuotation->insertQuotation();
    if ($dtest == 'Insert Successful!') {
        $infomsg = '<p class="text-success">Quotation item has been inserted.</p>';
    } else {
        $infomsg = '<p class="text-danger">Quotation item failed to insert, Please contact administrator.</p>';
    }
}
if (isset($_POST['submitQuotation'])) {
    $qr = "SELECT * FROM quono_list WHERE quono = '$quono' ORDER BY item ASC ";
    $objtestSql = new SQL($qr);
    $resultQuonolist = $objtestSql->getResultRowArray();
    $arr_QuoInsResult = array();
    $cntSuccess = 0;
    $cntFail = 0;
    foreach ($resultQuonolist as $rowdata) {
        print_r($rowdata);
        echo"<br>";
        $objCQuotation = new CreateQuotation2($rowdata, $_POST['quotab']);
        $insertResult = $objCQuotation->insertQuotation();
        $arr_QuoInsResult[] = array('result' => $insertResult);
        if ($insertResult == 'Insert Successful!') {
            $cntSuccess++;
        } else {
            $cntFail++;
        }
    }
    //insert remarks
    $objQuoRem = new QUO_REMARKS($_POST);
    $quoRemInsertResult = $objQuoRem->create_remarks();
    if ($quoRemInsertResult == 'Insert Successful!') {
        $quoRemInfoMsg = "<p class=\"text-info\">Done Submitting Remarks for $quono</p>";
    } else {
        $quoRemInfoMsg = "<p class=\"text-danger\">Failed Submitting Remarks for $quono</p>";
    }

    $totalitem = (float) $cntSuccess + (float) $cntFail;
    $infomsg = "<p class=\"text-info\">Done submitting Quotation $quono containing $totalitem items with $cntSuccess Successes, and $cntFail Failure. </p>";
    //update status of issued in quono_list
    $qr = 'UPDATE quono_list SET issued_to_quotation = "yes" WHERE quono = "' . $quono . '"';
    $objUQL = new SQL($qr);
    $result = $objUQL->getUpdate();
    if ($result == 'updated') {
        $quolistupdmsg = '<p class=\"text-info\">Updated quono: ' . $quono . ' as issued on quono_list</p>';
    } else {
        $quolistupdmsg = '<p class=\"text-danger\">Cannot update quono: ' . $quono . ' as issued on quono_list</p>';
    }
}
?>

<div class=" tab-pane active">
    <div class="form-group">
        <?php
        echo $infomsg . "<br>";
        echo (isset($quoRemInfoMsg)) ? $quoRemInfoMsg : "";
        ?>
        <div class="row">
            <div class="col-sm">
                <?php
                //just for testing the item lists, delete this area later
                #echo "<pre style='color:black'>Lists of Final POST Data :<br>";
                #print_r($_POST);
                #echo "</pre>";
                //end testing
                $qr = "SELECT * FROM quono_list WHERE quono = '$quono' ORDER BY item ASC ";
                #echo $qr;
                $objtestSql = new SQL($qr);
                $resulttest = $objtestSql->getResultRowArray();
                echo "<table class='table table-responsive'>";
                foreach ($resulttest as $testkey => $testrows) {
                    echo "<tr>";
                    foreach ($testrows as $key => $rows) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";
                    break;
                }
                foreach ($resulttest as $testkey => $testrows) {
                    echo "<tr>";
                    foreach ($testrows as $key => $rows) {
                        echo "<th>$rows</th>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
        </div>
        <?php
        if (isset($_POST['submitQuotation'])) {
            ?>
            <div class="row">
                <div class="col-sm text-center">
                    <form action="">
                        <button type="button" class="btn btn-primary" onclick="window.close()">(notworking yet)Show Quotation Detail (<?php echo $quono; ?>)</button>
                    </form>
                </div>
                <div class="col-sm text-center">
                    <form action='calculation/testprintquotation.php' method='get' target="_blank">
                        <input type="hidden" name ="bid"               id="bid"                value ="<?php echo $bid; ?>" />
                        <input type="hidden" name ="com"               id="com"                value ="<?php echo $com; ?>" />
                        <input type="hidden" name ="post_cid"          id="post_cid"           value ="<?php echo $post_cid; ?>" />
                        <input type="hidden" name ="post_period"       id="post_period"        value ="<?php echo $post_period; ?>" />
                        <input type="hidden" name ="quotab"            id="quotab"             value ="<?php echo $quotab; ?>" />
                        <input type="hidden" name ="quono"             id="quono"              value ="<?php echo $quono; ?>" />
                        <input type="hidden" name ="create_quotation"  id="create_quotation"   value ="<?php echo $quotype; ?>" placeholder="quotype"/>

                        <input type='hidden' name='print'              id='print'              value='quotation' />                        
                        <input type="submit" class="btn btn-success" name='submitPrint' id='submitPrint' value='Print This Quotation' />
                    </form>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="col-sm">
                    <form action="" method="POST">                    
                        <input type="hidden" name ="aid"               id="aid"                value ="<?php echo $aid; ?>" />
                        <input type="hidden" name ="bid"               id="bid"                value ="<?php echo $bid; ?>" />
                        <input type="hidden" name ="com"               id="com"                value ="<?php echo $com; ?>" />
                        <input type="hidden" name ="post_cid"          id="post_cid"           value ="<?php echo $post_cid; ?>" />
                        <input type="hidden" name ="post_period"       id="post_period"        value ="<?php echo $post_period; ?>" />
                        <input type="hidden" name ="quotab"            id="quotab"             value ="<?php echo $quotab; ?>" />
                        <input type="hidden" name ="quono"             id="quono"              value ="<?php echo $quono; ?>" />
                        <input type="hidden" name ="create_quotation"  id="create_quotation"   value ="<?php echo $quotype; ?>" placeholder="quotype"/>

                        <div class="row">
                            <div class='col-md-2'>
                                <label class='control-label'>Remarks :</label>
                            </div>
                            <div class='col-md'>
                                <?php
                                if ($quotype == 'trade') {
                                    ?>
                                    <input class='form-control' type='text' id='remarks1' name='remarks1' value='' />
                                    <?php
                                } else {
                                    ?>                                
                                    <input class='form-control' type='text' id='remarks1' name='remarks1' value='Wastage Charges included' />
                                    <?php
                                }
                                ?>
                                <input class='form-control' type='text' id='remarks2' name='remarks2' value='' />
                                <input class='form-control' type='text' id='remarks3' name='remarks3' value='' />
                                <input class='form-control' type='text' id='remarks4' name='remarks4' value='' />
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" id='submitQuotation' name='submitQuotation' value='Submit All Items into Quotation'/>
                    </form>
                </div>
                <div class="col-sm text-center">
                    <form action="" method="POST">
                        <!--Lists of hidden inputs-->
                        <input type="hidden" name ="aid"               id="aid"                value ="<?php echo $aid; ?>" />
                        <input type="hidden" name ="bid"               id="bid"                value ="<?php echo $bid; ?>" />
                        <input type="hidden" name ="com"               id="com"                value ="<?php echo $com; ?>" />
                        <input type="hidden" name ="post_cid"          id="post_cid"           value ="<?php echo $post_cid; ?>" />
                        <input type="hidden" name ="post_period"       id="post_period"        value ="<?php echo $post_period; ?>" />
                        <input type="hidden" name ="quotab"            id="quotab"             value ="<?php echo $quotab; ?>" />
                        <input type="hidden" name ="quono"             id="quono"              value ="<?php echo $quono; ?>" />
                        <input type="hidden" name ="create_quotation"  id="create_quotation"   value ="<?php echo $quotype; ?>" placeholder="quotype"/>

                        <?php if ($itemno < 10) { ?>
                            <input class="btn btn-success" type = "submit" name="submitNew" id="reset_click" value = "Add New Item">
                        <?php } else { ?>
                            <input class='btn btn-outline-success disabled' type='submit' value='Cannot add more than 10 Items' disabled/>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>