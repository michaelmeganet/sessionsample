<?php
include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/quotation.inc.php';
include_once 'class/customers.inc.php';
include_once 'class/phhdate.inc.php';
include_once 'includes/tablegeneration.func.inc.php';

$comsml = COMMONNAME_PST::COMPANY_SMLETTER;
$comcap = COMMONNAME_PST::COMPANY_CAPLETTER;
$objPeriod = new Period();
//fetch current Period
$period = $objPeriod->getcurrentPeriod();
$com = $comsml;
//create array to compile all result
$generation_result = array();

//ADD MORE FUNCTION IN includes/tablegeneration.func.inc.php for more insertion
//Quotation generation
$generation_result["quono_list"] = generate_quonolist($period);
$generation_result["quotationnew_{$com}_$period"] = generate_quotation($period, $com);
$generation_result["quotationnew_delete_{$com}_$period"] = generate_quotation_delete($period, $com);
$generation_result["quotation_remarks_{$com}_$period"] = generate_quotation_remark($period, $com);
//end quotation generation
//orderlist generation
$generation_result["orderlistnew_{$com}_$period"] = generate_orderlist($period, $com);
$generation_result["runningno_serial_$period"] = generate_runningno_serial($period, $com);
$generation_result["runningno_$period"] = generate_runningno($period, $com);
$generation_result["orderlistnew_delete_{$com}_$period"] = generate_orderlist_delete($period, $com);
$generation_result["ordercontrolcenter"] = generate_order_control_center();
//end orderlist generation
//joblist generation
$generation_result["production_scheduling_$period"] = generate_production_scheduling($period, $com);
$generation_result["production_output_$period"] = generate_production_output($period, $com);
$generation_result["jobcodesid"] = generate_jobcodesid();
$generation_result["joblist_work_status"] = generate_joblist_work_status();
//end joblist generation
//invoice generation
$generation_result["dono_newsearch"] = generate_dono_newsearch();
$generation_result["invoiceno_{$com}_$period"] = generate_invoiceno($period, $com);
$generation_result["invoice_log_{$com}_$period"] = generate_invoice_log($period, $com);
$generation_result["invoice_reissue_$period"] = generate_invoice_reissue($period, $com);
$generation_result["invrunno_$period"] = generate_invrunno($period, $com);
$generation_result["invrunno_log"] = generate_invrunno_log();
$generation_result["invrunningno_serial_$period"] = generate_invrunningno_serial($period, $com);
$generation_result["customer_payment_{$com}_$period"] = generate_customer_payment($period, $com);
//end invoice generation
?>
<?php include "header.php"; ?>

<body style='padding-bottom:10px'>
    <div class='container' id='mainContainer'>
        <?php include "navmenu.php" ?>
        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <h1>MONTHLY TABLE GENERATION</h1>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="sponsor">
                      <!-- <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom" id="_carbonads_js"></script> -->
                    </div>
                </div>
            </div>
        </div>
        <p class='lead'><?php echo "Generating Tables for Period = $period"; ?></p>
        <div class="container">
            <table class='table table-borderless table-sm'>
                <thead>
                    <tr>
                        <th>Table Name</th>
                        <th>Generation Result</th>
                    </tr>
                </thead>
                <?php
                foreach ($generation_result as $tbname => $result) {
                    if ($result == 'ok') {
                        ?>
                        <tr class='table-success'>
                            <td><?php echo $tbname; ?></td>
                            <td><?php echo $result; ?></td>
                        </tr>
                        <?php
                    } elseif ($result == 'fail') {
                        ?>
                        <tr class='table-danger'>
                            <td><?php echo $tbname; ?></td>
                            <td><?php echo $result; ?></td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr class='table-default'>
                            <td><?php echo $tbname; ?></td>
                            <td><?php echo $result; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <?php include"footer.php" ?> 
</body>
