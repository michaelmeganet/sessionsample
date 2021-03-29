<?php
include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/quotation.inc.php';
include_once 'class/phhdate.inc.php';



if (isset($_GET['quono'])) {
    $quono = $_GET['quono'];
} else {
    die('Can\'t reach this page that way. Please <a href="index-orderlist.php">try again</a>.');
}
if (isset($_GET['period'])) {
    $period = $_GET['period'];
} else {
    die('Can\'t reach this page that way. Please <a href="index-orderlist.php">try again</a>.');
}
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
} else {
    die('Can\'t reach this page that way. Please <a href="index-orderlist.php">try again</a>.');
}
if (isset($_GET['com'])) {
    $com = $_GET['com'];
} else {
    die('Can\'t reach this page that way. Please <a href="index-orderlist.php">try again</a>.');
}
if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
} else {
    die('Can\'t reach this page that way. Please <a href="index-orderlist.php">try again</a>.');
}
$ordtab = "orderlistnew" . "_" . $com . "_" . $period;
?>
<div class="container-fluid">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <div id='init_objects'>
                    <input type='hidden' ref='quono' id='quono' name='quono' value='<?php echo $quono; ?>' /><br>
                    <input type='hidden' ref='cid'  id='cid' name='cid' value='<?php echo $cid; ?>' /><br>
                    <input type='hidden' ref='period' id='period' name='period' value='<?php echo $period; ?>' /><br>
                    <input type='hidden' ref='com' id='com' name='com' value='<?php echo $com; ?>' /><br>
                    <input type='hidden' ref='aid' id='aid' name='aid' value='<?php echo $aid; ?>' /><br>
                    <input type='hidden' name='ordtab' id='ordtab' value='<?php echo $ordtab; ?>' />
                </div>
            </div>
            <div class="container-fluid" id='mainArea'>
                <div class="row">
                    <div class='col-md'>
                        <div class='row'>
                            <div class='col-md'> 
                                <!--  modal area  -->
                                <div class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="reviseModal">
                                    <div class="modal-dialog modal-xl" style="max-height:80%;height:80vh;">
                                        <div class="modal-content">
                                            <div class='modal-header'>
                                                <h5 class="modal-title">{{modalTitle}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body' style='max-height: 90%;height:90vh;overflow-y: scroll'>
                                                <?php include_once 'ord-reviseprice-modal.php'; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal area-->
                            </div>
                        </div>
                        <!--   main area   -->
                        <div class="row">
                            <div class="col-lg col-md col-sm">
                                <table class=''>
                                    <tr>
                                        <td><label class="control-label" >Quono</label></td>
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{quono}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >To</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{customer_detail.co_name}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >Address</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td rowspan='3' class='align-top'>
                                            <label class="control-label" >{{customer_detail.address1}}</label>
                                            <br>
                                            <label class="control-label" >{{customer_detail.address2}}</label>
                                            <br>                                
                                            <label class="control-label" >{{customer_detail.address3}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" ></label></td>                                
                                        <td><label class="control-label" >&nbsp;&nbsp;&nbsp;</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" ></label></td>                                
                                        <td><label class="control-label" >&nbsp;&nbsp;&nbsp;</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >Attn</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{customer_detail.attn_sales}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >Contact&nbsp;No.</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{customer_detail.telephone_sales}}</label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg col-md col-sm">
                                <table>
                                    <tr>
                                        <td><label class="control-label" >Issue Date</label></td>
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{today_date_dmy}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >Terms</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" >{{customer_detail.terms}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >CC</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" v-html ='sales_attn'>{{sales_attn}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" >Running No</label></td>                                
                                        <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                        <td><label class="control-label" style="color:yellow" >{{("0000" + runno).slice(-4)}}</label></td>
                                    </tr>
                                    <tr>
                                        <td><label class="control-label" ></label></td>                                
                                        <td><label class="control-label" >&nbsp;&nbsp;&nbsp;</label></td>
                                        <td><label class="control-label" ></label></td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class='row' id='reviseOrderlist'>
                            <div Class='col-md'>
                                <div class='row no-gutters align-middle'>
                                    <div class='col-md-6'>                                                
                                    </div>
                                    <div class='col-md-4'>
                                    </div>
                                    <div class='col-md-2 text-right'>
                                        <button class='btn btn-success btn-sm' id='submitRevise' name='submitRevise' onclick='revConfirm()'>Submit Revise Orderlist</button>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md'>
                                        <table class="table table-striped table-responsive-md">
                                            <thead class="table table-primary" style='text-align:center;font-size:0.8em;'>
                                                <tr>
                                                    <td rowspan="2">Item</td>
                                                    <td rowspan='2'>Qty</td>
                                                    <td rowspan='2'>Shape Code</td>
                                                    <td rowspan="2">Category</td>
                                                    <td rowspan="2">Sp Shape Order</td>
                                                    <td rowspan="2">Material</td>
                                                    <td rowspan='2'>Raw Dimension Description</td>
                                                    <td rowspan='2'>Finishing Dimension Description</td>
                                                    <td rowspan='2'>Process</td>
                                                    <td colspan='4'>Price</td>
                                                    <td rowspan='2'>Total Amount</td>
                                                    <td rowspan='2' colspan="2" style='width:5%'>Action</td>
                                                </tr>
                                                <tr>
                                                    <td>Mat</td>
                                                    <td>P.Mach</td>
                                                    <td>CNC.Mach</td>
                                                    <td>Other</td>
                                                </tr>
                                            </thead>
                                            <tbody style='text-align:center;font-size:0.8em'>
                                                <tr v-for='(itemData,index) in allItemList' v-bind:style="{backgroundColor : issuedColor(index)}">
                                                    <td>{{itemData.item}}</td>
                                                    <td>{{itemData.quantity}}</td>
                                                    <td>{{itemData.Shape_Code}}</td>
                                                    <td>{{itemData.Category}}</td>
                                                    <td>{{itemData.specialShapeOrder}}</td>
                                                    <td>{{itemData.materialname}}</td>
                                                    <td>{{itemData.dim_desp}}</td>
                                                    <td>{{itemData.finishing_dim_desp}}</td>
                                                    <td>{{itemData.processcode}}</td>
                                                    <td>{{itemData.totalamountmat}}</td>
                                                    <td>{{itemData.totalamountpmach}}</td>
                                                    <td>{{itemData.totalamountcncmach}}</td>
                                                    <td>{{itemData.totalamountother}}</td>
                                                    <td>{{itemData.totalamount}}</td>
                                                    <td v-if="itemData.odissue == 'no'"><button class='btn btn-primary btn-sm disabled' type='button' onclick="" >Not Issued</button></td>
                                                    <td v-else-if="itemData.status_od == 'cancelled'"><button class='btn btn-primary btn-sm disabled' type='button' onclick="" >Cancelled</button></td>
                                                    <td v-else='itemData.odissue == "yes"'><button id='revisebtn' class='btn btn-primary btn-sm' type='button' onclick="" @click='propItemDetail(itemData.item);getMaterial();getThickList();reverseParseDimension();' data-toggle="modal" data-target=".bd-example-modal-lg">Edit</button></td>
                                                    <!--<td><button id='deletebtn' class='btn btn-danger btn-sm' type='button' onclick="" @click='removeItemDetail(itemData.item);' style='
                                                                font-weight: 700;
                                                                line-height: 1;font-size:21px;font-family:serif' >&times;</button></td>-->
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end main area -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="sponsor">
                  <!-- <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom" id="_carbonads_js"></script> -->
                </div>
            </div>
        </div>
    </div>
    <?php include"footer.php" ?>
    <script type="text/javascript" src='./session/session_js.js'></script>
    <script>
                                            $(document).ready(function () {
                                                $("#revisebtn").click(function () {
                                                    $("#reviseModal").modal({
                                                        backdrop: 'static',
                                                        keyboard: false
                                                    });
                                                });
                                            });
                                            function revConfirm() {
                                                let retval = confirm('Are you sure you want to revise with these datas?');
                                                if (retval == true) {
                                                    reviseOL.reviseOrderlist();
                                                } else {
                                                    return;
                                                }
                                            }
                                            ;
                                            function reCalculateAllPrices() {
                                                let qty = reviseVueData.quantity;
                                                let cncprice = reviseVueData.cncprice;
                                                let otherprice = reviseVueData.otherprice;
                                                reviseOL.getPmachPrice();
                                                reviseOL.getPmachPriceCalc();
                                                reviseOL.getMatPriceCalc();
                                                reviseVueData.totalcncprice = parseFloat(qty) * parseFloat(cncprice);
                                                reviseVueData.totalotherprice = parseFloat(qty) * parseFloat(otherprice);
                                            }
                                            ;
                                            function setDiscountGST() {
                                                $('#reviseModal').animate({scrollTop: 0}, 'medium');
                                                console.log("Data that has been inputted ...");
                                                console.log(reviseVueData);
                                                reviseVueData.mainactive = '';
                                                reviseVueData.finalactive = 'active';
                                                reviseVueData.maintrue = 'false';
                                                reviseVueData.finaltrue = 'true';
                                            }
                                            ;
                                            function openDetails() {
                                                $('#reviseModal').animate({scrollTop: 0}, 'medium');
                                                reviseVueData.mainactive = 'active';
                                                reviseVueData.finalactive = '';
                                                reviseVueData.maintrue = 'true';
                                                reviseVueData.finaltrue = 'false';
                                            }
                                            ;
                                            function setVueThickness(val) {
                                                reviseVueData.thickness = val;
                                            }
                                            ;
                                            function setVueWidth1(val) {
                                                reviseVueData.width1 = val;
                                            }
                                            ;
                                            var reviseVueData = {
                                                phpajaxresponsefile: './orderlist/backend/orderlist.axios.php',
                                                period: '',
                                                rev_aid: '',
                                                aid_ol: '',
                                                quono: '',
                                                new_quono: '',
                                                ordtab: '',
                                                com: '',
                                                cid: '',
                                                accno: '',
                                                aid_cus: '',
                                                aid_quo: '',
                                                bid: '',
                                                currency: '',
                                                cusstatus: '',
                                                ftz: '',
                                                mainShapeOrder: '',
                                                curItemIndex: '',
                                                allItemList: '',
                                                modalTitle: '',
                                                //put variables here
                                                btnDisplay: 'inline',
                                                mainactive: 'active',
                                                finalactive: '',
                                                maintrue: 'true',
                                                finaltrue: 'false',
                                                tolerance: false,
                                                tol: 0,
                                                freepage: false,

                                                custype: 'local',
                                                quantity: 1,
                                                specialShapeOrder: '',
                                                mat: '',
                                                materialname: '',
                                                matprice_stats: '',
                                                matprice_resp: '',
                                                ShapeCode: '',
                                                category: '',
                                                tabletype: '',
                                                mdt: '',
                                                mdw: '',
                                                mdl: '',
                                                fdt: '',
                                                fdw: '',
                                                fdl: '',
                                                dim_desc: '',
                                                finishing_dim_desc: '',
                                                volume: 0.00,
                                                weight: 0.00,
                                                totalweight: 0.00,
                                                density: 0.00,
                                                pricePerKG: 0.00,
                                                pricePerPCS: 0.00,
                                                totalprice: 0.00,
                                                discountmat: 0.00,
                                                totaldiscountmat: 0.00,
                                                gstmatpct: 0.00,
                                                gstmat: 0.00,
                                                totalgstmat: 0.00,
                                                subtotalmat: 0.00,
                                                pmid: 1,
                                                processcode: 'Basic Process',
                                                pmachprice: 0.00,
                                                discountpmach: 0.00,
                                                totaldiscountpmach: 0.00,
                                                gstpmachpct: 0,
                                                gstpmach: 0.00,
                                                totalgstpmach: 0.00,
                                                totalpmachprice: 0.00,
                                                subtotalpmachprice: 0.00,
                                                cncprice: 0.00,
                                                discountcnc: 0.00,
                                                totaldiscountcnc: 0.00,
                                                gstcncpct: 0,
                                                gstcnc: 0.00,
                                                totalgstcnc: 0.00,
                                                totalcncprice: 0.00,
                                                subtotalcncprice: 0.00,
                                                otherprice: 0.00,
                                                discountother: 0.00,
                                                totaldiscountother: 0.00,
                                                gstotherpct: 0,
                                                gstother: 0.00,
                                                totalgstother: 0.00,
                                                totalotherprice: 0.00,
                                                subtotalotherprice: 0.00,
                                                totalamount: 0.00,
                                                //list of dimension variables
                                                dT: '',
                                                dW: '',
                                                dL: '',
                                                fT: '',
                                                fW: '',
                                                fL: '',
                                                dOD: '',
                                                fOD: '',
                                                dID: '',
                                                fID: '',
                                                dPHI: '',
                                                fPHI: '',
                                                dHEX: '',
                                                fHEX: '',
                                                dW1: '',
                                                fW1: '',
                                                dW2: '',
                                                fW2: '',
                                                dH: '',
                                                fH: '',
                                                dA: '',
                                                fA: '',
                                                dC: '',
                                                fC: '',
                                                dB: '',
                                                fB: '',
                                                dribT: '',
                                                fribT: '',
                                                dT1: '',
                                                fT1: '',
                                                dT2: '',
                                                fT2: '',
                                                //put arraydata variables here
                                                materialList: '',
                                                thickList: '',
                                                w1List: '',
                                                w2List: '',
                                                pmachList: '',
                                                thickness: '',
                                                width1: '',
                                                width2: '',

                                                //headeraprt
                                                customer_status: '',
                                                customer_detail: '',
                                                customer_msg: '',
                                                sales_attn: '',
                                                runno: '',
                                            }
                                            ;
                                            reviseOL = new Vue({
                                                el: '#mainArea',
                                                data: reviseVueData,
                                                watch: {
                                                    specialShapeOrder: function () {
                                                        this.getMaterial();
                                                    },
                                                    materialList: function () {
                                                        if (this.materialList !== '') {
                                                            this.getMainDetail();
                                                        }
                                                    },
                                                    dT: function (val) {
                                                        if (reviseVueData.ShapeCode == 'A' || reviseVueData.ShapeCode == 'HS' || (reviseVueData.ShapeCode == 'FLAT') ||
                                                                (reviseVueData.ShapeCode == 'C' || (reviseVueData.ShapeCode == 'LIP'))) {
                                                            reviseVueData.fT = parseFloat(reviseVueData.dT);
                                                        } else {
                                                            if (parseFloat(reviseVueData.dT) <= 0 || parseFloat(reviseVueData.dT) == '' || (parseFloat(reviseVueData.dT) - 5) < 0) {
                                                                //reviseVueData.dT = 0;
                                                                reviseVueData.fT = 0;
                                                            } else {
                                                                reviseVueData.fT = parseFloat(reviseVueData.dT) - 5;
                                                            }
                                                        }
                                                    },
                                                    fT: function (val) {
//                                 if (reviseVueData.ShapeCode !== 'PLATEN' && reviseVueData.category === 'PLATE') {
//                                 reviseVueData.dT = parseFloat(reviseVueData.fT) + 5;
//                                 }
                                                        if (parseFloat(reviseVueData.fT) > parseFloat(reviseVueData.dT)) {
                                                            reviseVueData.fT = parseFloat(reviseVueData.dT);
                                                        } else {
                                                            reviseVueData.fT = parseFloat(reviseVueData.fT);
                                                        }
                                                    },
                                                    dW: function (val) {
                                                        if ((reviseVueData.ShapeCode == 'FLAT')) {
                                                            reviseVueData.fW = parseFloat(reviseVueData.dW);
                                                        } else {
                                                            if (parseFloat(reviseVueData.dW) <= 0 || parseFloat(reviseVueData.dW) == '' || (parseFloat(reviseVueData.dW) - 5) < 0) {
                                                                //reviseVueData.dW = 0;
                                                                reviseVueData.fW = 0;
                                                            } else {
                                                                reviseVueData.fW = parseFloat(reviseVueData.dW) - 5;
                                                            }
                                                        }
                                                    },
                                                    fW: function (val) {
//                                    reviseVueData.dW = parseFloat(reviseVueData.fW) + 5;
                                                        if (parseFloat(reviseVueData.fW) > parseFloat(reviseVueData.dW)) {
                                                            reviseVueData.fW = parseFloat(reviseVueData.dW);
                                                        } else {
                                                            reviseVueData.fW = parseFloat(reviseVueData.fW);
                                                        }
                                                    },
                                                    dL: function (val) {
                                                        if ((reviseVueData.ShapeCode == 'FLAT')) {
                                                            reviseVueData.fL = parseFloat(reviseVueData.dL) - 5;
                                                        } else {
                                                            if (parseFloat(reviseVueData.dL) <= 0 || parseFloat(reviseVueData.dL) == '' || (parseFloat(reviseVueData.dL) - 5) < 0) {
                                                                //reviseVueData.dL = 0;
                                                                reviseVueData.fL = 0;
                                                            } else {
                                                                if (reviseVueData.category == 'ROD' && reviseVueData.ShapeCode == 'O') {
                                                                    if (parseFloat(reviseVueData.dPHI) > 100) {
                                                                        reviseVueData.fL = parseFloat(reviseVueData.dL) - 10;
                                                                    } else {
                                                                        reviseVueData.fL = parseFloat(reviseVueData.dL) - 5;
                                                                    }
                                                                } else {
                                                                    reviseVueData.fL = parseFloat(reviseVueData.dL) - 5;

                                                                }
                                                            }
                                                        }
                                                    },
                                                    fL: function (val) {
//                                    reviseVueData.dL = parseFloat(reviseVueData.fL) + 5;
                                                        if (parseFloat(reviseVueData.fL) > parseFloat(reviseVueData.dL)) {
                                                            reviseVueData.fL = parseFloat(reviseVueData.dL);
                                                        } else {
                                                            reviseVueData.fL = parseFloat(reviseVueData.fL);
                                                        }
                                                    },
                                                    dOD: function (val) {
                                                        if (parseFloat(reviseVueData.dOD) <= 0 || reviseVueData.dOD == '' || (parseFLoat(reviseVueData.dOD) - 5) < 0) {
                                                            reviseVueData.dOD = 0;
                                                            reviseVueData.fOD = 0;
                                                        } else {
                                                            if (reviseVueData.ShapeCode !== 'PLATEN') {
                                                                reviseVueData.fOD = parseFloat(reviseVueData.dOD);
                                                            } else {
                                                                reviseVueData.fOD = parseFloat(reviseVueData.dOD) - 5;
                                                            }
                                                            if (reviseVueData.specialShapeOrder !== 'NORMAL' && reviseVueData.ShapeCode === 'PLATEN') {
                                                                reviseVueData.dW = parseFloat(reviseVueData.dOD);
                                                                reviseVueData.fW = parseFloat(reviseVueData.fOD);
                                                                reviseVueData.dL = parseFloat(reviseVueData.dOD);
                                                                reviseVueData.fL = parseFloat(reviseVueData.fOD);
                                                            }
                                                        }
                                                    },
                                                    fOD: function (val) {
                                                        if (reviseVueData.ShapeCode !== 'PLATEN') {
                                                        } else {
//                                        reviseVueData.dOD = parseFloat(reviseVueData.fOD) + 5;
                                                            if (parseFloat(reviseVueData.fOD) > parseFloat(reviseVueData.dOD)) {
                                                                reviseVueData.fOD = parseFloat(reviseVueData.dOD);
                                                            } else {
                                                                reviseVueData.fOD = parseFloat(reviseVueData.fOD);
                                                            }
                                                        }
                                                        if (reviseVueData.specialShapeOrder !== 'NORMAL' && reviseVueData.ShapeCode === 'PLATEN') {
                                                            reviseVueData.dW = parseFloat(reviseVueData.dOD);
                                                            reviseVueData.fW = parseFloat(reviseVueData.fOD);
                                                            reviseVueData.dL = parseFloat(reviseVueData.dOD);
                                                            reviseVueData.fL = parseFloat(reviseVueData.fOD);
                                                        }
                                                    },
                                                    dID: function (val) {
                                                        if (parseFloat(reviseVueData.dID) <= 0 || parseFloat(reviseVueData.dID) == '' || (parseFloat(reviseVueData.dID) - 5) < 0) {
                                                            //reviseVueData.dID = 0;
                                                            reviseVueData.fID = 0;
                                                        } else {
                                                            if (reviseVueData.ShapeCode !== 'PLATEN') {
                                                                reviseVueData.fID = parseFloat(reviseVueData.dID);
                                                            } else {
                                                                reviseVueData.fID = parseFloat(reviseVueData.dID) - 5;
                                                            }
                                                        }
                                                    },
                                                    fID: function (val) {
                                                        if (reviseVueData.ShapeCode !== 'PLATEN') {
                                                        } else {
//                                        reviseVueData.dID = parseFloat(reviseVueData.fID) + 5;
                                                            if (parseFloat(reviseVueData.fID) > parseFloat(reviseVueData.dID)) {
                                                                reviseVueData.fID = parseFloat(reviseVueData.dID);
                                                            } else {
                                                                reviseVueData.fID = parseFloat(reviseVueData.fID);
                                                            }
                                                        }
                                                    },
                                                    dPHI: function (val) {
                                                        if (parseFloat(reviseVueData.dPHI) <= 0 || parseFloat(reviseVueData.dPHI) == '' || (parseFloat(reviseVueData.dPHI) - 5) < 0) {
//                                        reviseVueData.dPHI = 0;
                                                            reviseVueData.fPHI = 0;
                                                        } else {
                                                            reviseVueData.fPHI = parseFloat(reviseVueData.dPHI);
                                                        }
                                                    },
                                                    fPHI: function (val) {
//                                    reviseVueData.dPHI = parseFloat(reviseVueData.fPHI);
                                                        if (parseFloat(reviseVueData.fPHI) > parseFloat(reviseVueData.dPHI)) {
                                                            reviseVueData.fPHI = parseFloat(reviseVueData.dPHI);
                                                        } else {
                                                            reviseVueData.fPHI = parseFloat(reviseVueData.fPHI);
                                                        }
                                                    },
                                                    dHEX: function (val) {
                                                        if (parseFloat(reviseVueData.dHEX) <= 0 || parseFloat(reviseVueData.dHEX) == '' || (parseFloat(reviseVueData.dHEX) - 5) < 0) {
//                                        reviseVueData.dHEX = 0;
                                                            reviseVueData.fHEX = 0;
                                                        } else {
                                                            reviseVueData.fHEX = parseFloat(reviseVueData.dHEX);
                                                        }
                                                    },
                                                    fHEX: function (val) {
//                                    reviseVueData.dHEX = parseFloat(reviseVueData.fHEX);
                                                        if (parseFloat(reviseVueData.fHEX) > parseFloat(reviseVueData.dHEX)) {
                                                            reviseVueData.fHEX = parseFloat(reviseVueData.dHEX);
                                                        } else {
                                                            reviseVueData.fHEX = parseFloat(reviseVueData.fHEX);
                                                        }
                                                    },
                                                    dW1: function (val) {
                                                        if (parseFloat(reviseVueData.dW1) <= 0 || parseFloat(reviseVueData.dW1) == '' || (parseFloat(reviseVueData.dW1) - 5) < 0) {
//                                        reviseVueData.dW1 = 0;
                                                            reviseVueData.fW1 = 0;
                                                        } else {
                                                            if (reviseVueData.ShapeCode == 'A' || reviseVueData.ShapeCode == 'SS' || reviseVueData.ShapeCode == 'HS') {
                                                                reviseVueData.fW1 = parseFloat(reviseVueData.dW1);
                                                            } else {
                                                                reviseVueData.fW1 = parseFloat(reviseVueData.dW1) - 5;
                                                            }
                                                        }
                                                    },
                                                    fW1: function (val) {
//                                    reviseVueData.dW1 = parseFloat(reviseVueData.fW1) + 5;
                                                        if (parseFloat(reviseVueData.fW1) > parseFloat(reviseVueData.dW1)) {
                                                            reviseVueData.fW1 = parseFloat(reviseVueData.dW1);
                                                        } else {
                                                            reviseVueData.fW1 = parseFloat(reviseVueData.fW1);
                                                        }

                                                    },
                                                    dW2: function (val) {
                                                        if (parseFloat(reviseVueData.dW2) <= 0 || parseFloat(reviseVueData.dW2) == '' || (parseFloat(reviseVueData.dW2) - 5) < 0) {
//                                        reviseVueData.dW2 = 0;
                                                            reviseVueData.fW2 = 0;
                                                        } else {
                                                            if (reviseVueData.ShapeCode == 'A' || reviseVueData.ShapeCode == 'SS' || reviseVueData.ShapeCode == 'HS') {
                                                                reviseVueData.fW2 = parseFloat(reviseVueData.dW1);
                                                            } else {
                                                                reviseVueData.fW2 = parseFloat(reviseVueData.dW2) - 5;
                                                            }
                                                        }
                                                    },
                                                    fW2: function (val) {
//                                    reviseVueData.dW2 = parseFloat(reviseVueData.fW2) + 5;
                                                        if (parseFloat(reviseVueData.fW2) > parseFloat(reviseVueData.dW2)) {
                                                            reviseVueData.fW2 = parseFloat(reviseVueData.dW2);
                                                        } else {
                                                            reviseVueData.fW2 = parseFloat(reviseVueData.fW2);

                                                        }
                                                    },
                                                    dH: function (val) {
                                                        reviseVueData.fH = parseFloat(val).toFixed(2);
                                                    },
                                                    fH: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dH)) {
                                                            reviseVueData.fH = parseFloat(reviseVueData.dH).toFixed(2);
                                                        } else {
                                                            reviseVueData.fH = parseFloat(val);
                                                        }
                                                    },
                                                    dA: function (val) {
                                                        reviseVueData.fA = parseFloat(val).toFixed(2);
                                                    },
                                                    fA: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dA)) {
                                                            reviseVueData.fA = parseFloat(reviseVueData.dA).toFixed(2);
                                                        } else {
                                                            reviseVueData.fA = parseFloat(val);
                                                        }
                                                    },
                                                    dC: function (val) {
                                                        reviseVueData.fC = parseFloat(val).toFixed(2);
                                                    },
                                                    fC: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dC)) {
                                                            reviseVueData.fC = parseFloat(reviseVueData.dC).toFixed(2);
                                                        } else {
                                                            reviseVueData.fC = parseFloat(val);
                                                        }
                                                    },
                                                    dribT: function (val) {
                                                        reviseVueData.fribT = parseFloat(val).toFixed(2);
                                                    },
                                                    fribT: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dribT)) {
                                                            reviseVueData.fribT = parseFloat(reviseVueData.dribT).toFixed(2);
                                                        } else {
                                                            reviseVueData.fribT = parseFloat(val);
                                                        }
                                                    },
                                                    dB: function (val) {
                                                        reviseVueData.fB = parseFloat(val);
                                                    },
                                                    fB: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dB)) {
                                                            reviseVueData.fB = parseFloat(reviseVueData.dB).toFixed(2);
                                                        } else {
                                                            reviseVueData.fB = parseFloat(val);
                                                        }
                                                    },
                                                    dT1: function (val) {
                                                        reviseVueData.fT1 = parseFloat(val);
                                                    },
                                                    fT1: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dT1)) {
                                                            reviseVueData.fT1 = parseFloat(reviseVueData.dT1).toFixed(2);
                                                        } else {
                                                            reviseVueData.fT1 = parseFloat(val);
                                                        }
                                                    },
                                                    dT2: function (val) {
                                                        reviseVueData.fT2 = parseFloat(val).toFixed(2);
                                                    },
                                                    fT2: function (val) {
                                                        if (parseFloat(val) > parseFloat(reviseVueData.dT2)) {
                                                            reviseVueData.fT2 = parseFloat(reviseVueData.dT2).toFixed(2);
                                                        } else {
                                                            reviseVueData.fT2 = parseFloat(val);
                                                        }
                                                    },
                                                    totalprice: function () {
                                                        if (reviseVueData.totalprice !== '') {
                                                            console.log(reviseVueData.totalprice);
                                                            let qty = parseFloat(reviseVueData.quantity);
                                                            let discmat = parseFloat(reviseVueData.discountmat);
                                                            let gstmatpct = parseFloat(reviseVueData.gstmatpct);
                                                            let matprice = parseFloat(reviseVueData.pricePerPCS);
                                                            let gstmat = (matprice - discmat) * gstmatpct / 100;
                                                            let subtotal = (matprice - discmat + gstmat) * qty;
                                                            reviseVueData.subtotalmat = subtotal.toFixed(2);
                                                            reviseVueData.step4show = true;
                                                            reviseOL.getPmach();
                                                        } else {
                                                            reviseVueData.step4show = false;
                                                        }
                                                    },
                                                    pmid: function () {
                                                        reviseOL.getProcessByPmid();
                                                        if (reviseVueData.processcode.match(/SGA/i)) {
                                                            reviseVueData.tolerance = true;
                                                            reviseVueData.tol = 0.02;
                                                        } else {
                                                            reviseVueData.tolerance = false;
                                                            reviseVueData.tol = 0;
                                                        }
                                                    },
                                                    tol: function () {
                                                        reviseOL.getPmachPrice();
                                                    },
                                                    pmachprice: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let pmachprice = parseFloat(reviseVueData.pmachprice);
                                                        reviseVueData.totalpmachprice = qty * pmachprice;

                                                    },
                                                    totalpmachprice: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discpmach = parseFloat(reviseVueData.discountpmach);
                                                        let gstpmachpct = parseFloat(reviseVueData.gstpmachpct);
                                                        let pmachprice = parseFloat(reviseVueData.pmachprice);
                                                        let gstpmach = (pmachprice - discpmach) * gstpmachpct / 100;
                                                        let subtotal = (pmachprice - discpmach + gstpmach) * qty;
                                                        reviseVueData.subtotalpmachprice = subtotal.toFixed(2);
                                                        reviseVueData.gstpmach = gstpmach.toFixed(2);
                                                        reviseVueData.totaldiscountpmach = qty * discpmach;
                                                        reviseVueData.totalgstpmach = gstpmach * qty;
                                                    },
                                                    totalcncprice: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let disccnc = parseFloat(reviseVueData.discountcnc);
                                                        let gstcncpct = parseFloat(reviseVueData.gstcncpct);
                                                        let cncprice = parseFloat(reviseVueData.cncprice);
                                                        let gstcnc = (cncprice - disccnc) * gstcncpct / 100;
                                                        let subtotal = (cncprice - disccnc + gstcnc) * qty;
                                                        reviseVueData.subtotalcncprice = subtotal.toFixed(2);
                                                        reviseVueData.gstcnc = gstcnc.toFixed(2);
                                                        reviseVueData.totaldiscountcnc = qty * disccnc;
                                                        reviseVueData.totalgstcnc = gstcnc * qty;
                                                    },
                                                    totalotherprice: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discother = parseFloat(reviseVueData.discountother);
                                                        let gstotherpct = parseFloat(reviseVueData.gstotherpct);
                                                        let otherprice = parseFloat(reviseVueData.otherprice);
                                                        let gstother = (otherprice - discother) * gstotherpct / 100;
                                                        let subtotal = (otherprice - discother + gstother) * qty;
                                                        reviseVueData.subtotalotherprice = subtotal.toFixed(2);
                                                        reviseVueData.gstother = gstother.toFixed(2);
                                                        reviseVueData.totaldiscountother = qty * discother;
                                                        reviseVueData.totalgstother = gstother * qty;
                                                    },
                                                    cncprice: function () {
                                                        reviseVueData.totalcncprice = parseFloat(reviseVueData.cncprice) * parseFloat(reviseVueData.quantity);
                                                    },
                                                    otherprice: function () {
                                                        reviseVueData.totalotherprice = parseFloat(reviseVueData.otherprice) * parseFloat(reviseVueData.quantity);
                                                    },
                                                    discountmat: function () {
                                                        console.log(reviseVueData);
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discmat = parseFloat(reviseVueData.discountmat);
                                                        let gstmatpct = parseFloat(reviseVueData.gstmatpct);
                                                        let matprice = parseFloat(reviseVueData.pricePerPCS);
                                                        let gstmat = (matprice - discmat) * gstmatpct / 100;
                                                        let subtotal = (matprice - discmat + gstmat) * qty;
                                                        reviseVueData.subtotalmat = subtotal.toFixed(2);
                                                        reviseVueData.gstmat = gstmat.toFixed(2);
                                                        reviseVueData.totaldiscountmat = qty * discmat;
                                                        reviseVueData.totalgstmat = gstmat * qty;
                                                    },
                                                    gstmatpct: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discmat = parseFloat(reviseVueData.discountmat);
                                                        let gstmatpct = parseFloat(reviseVueData.gstmatpct);
                                                        let matprice = parseFloat(reviseVueData.pricePerPCS);
                                                        let gstmat = (matprice - discmat) * gstmatpct / 100;
                                                        let subtotal = (matprice - discmat + gstmat) * qty;
                                                        reviseVueData.subtotalmat = subtotal.toFixed(2);
                                                        reviseVueData.gstmat = gstmat.toFixed(2);
                                                        reviseVueData.totaldiscountmat = qty * discmat;
                                                        reviseVueData.totalgstmat = gstmat * qty;
                                                    },
                                                    discountpmach: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discpmach = parseFloat(reviseVueData.discountpmach);
                                                        let gstpmachpct = parseFloat(reviseVueData.gstpmachpct);
                                                        let pmachprice = parseFloat(reviseVueData.pmachprice);
                                                        let gstpmach = (pmachprice - discpmach) * gstpmachpct / 100;
                                                        let subtotal = (pmachprice - discpmach + gstpmach) * qty;
                                                        reviseVueData.subtotalpmachprice = subtotal.toFixed(2);
                                                        reviseVueData.gstpmach = gstpmach.toFixed(2);
                                                        reviseVueData.totaldiscountpmach = qty * discpmach;
                                                        reviseVueData.totalgstpmach = gstpmach * qty;
                                                    },
                                                    gstpmachpct: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discpmach = parseFloat(reviseVueData.discountpmach);
                                                        let gstpmachpct = parseFloat(reviseVueData.gstpmachpct);
                                                        let pmachprice = parseFloat(reviseVueData.pmachprice);
                                                        let gstpmach = (pmachprice - discpmach) * gstpmachpct / 100;
                                                        let subtotal = (pmachprice - discpmach + gstpmach) * qty;
                                                        reviseVueData.subtotalpmachprice = subtotal.toFixed(2);
                                                        reviseVueData.gstpmach = gstpmach.toFixed(2);
                                                        reviseVueData.totaldiscountpmach = qty * discpmach;
                                                        reviseVueData.totalgstpmach = gstpmach * qty;
                                                    },
                                                    discountcnc: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let disccnc = parseFloat(reviseVueData.discountcnc);
                                                        let gstcncpct = parseFloat(reviseVueData.gstcncpct);
                                                        let cncprice = parseFloat(reviseVueData.cncprice);
                                                        let gstcnc = (cncprice - disccnc) * gstcncpct / 100;
                                                        let subtotal = (cncprice - disccnc + gstcnc) * qty;
                                                        reviseVueData.subtotalcncprice = subtotal.toFixed(2);
                                                        reviseVueData.gstcnc = gstcnc.toFixed(2);
                                                        reviseVueData.totaldiscountcnc = qty * disccnc;
                                                        reviseVueData.totalgstcnc = gstcnc * qty;
                                                    },
                                                    gstcncpct: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let disccnc = parseFloat(reviseVueData.discountcnc);
                                                        let gstcncpct = parseFloat(reviseVueData.gstcncpct);
                                                        let cncprice = parseFloat(reviseVueData.cncprice);
                                                        let gstcnc = (cncprice - disccnc) * gstcncpct / 100;
                                                        let subtotal = (cncprice - disccnc + gstcnc) * qty;
                                                        reviseVueData.subtotalcncprice = subtotal.toFixed(2);
                                                        reviseVueData.gstcnc = gstcnc.toFixed(2);
                                                        reviseVueData.totaldiscountcnc = qty * disccnc;
                                                        reviseVueData.totalgstcnc = gstcnc * qty;
                                                    },
                                                    discountother: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discother = parseFloat(reviseVueData.discountother);
                                                        let gstotherpct = parseFloat(reviseVueData.gstotherpct);
                                                        let otherprice = parseFloat(reviseVueData.otherprice);
                                                        let gstother = (otherprice - discother) * gstotherpct / 100;
                                                        let subtotal = (otherprice - discother + gstother) * qty;
                                                        reviseVueData.subtotalotherprice = subtotal.toFixed(2);
                                                        reviseVueData.gstother = gstother.toFixed(2);
                                                        reviseVueData.totaldiscountother = qty * discother;
                                                        reviseVueData.totalgstother = gstother * qty;
                                                    },
                                                    gstotherpct: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discother = parseFloat(reviseVueData.discountother);
                                                        let gstotherpct = parseFloat(reviseVueData.gstotherpct);
                                                        let otherprice = parseFloat(reviseVueData.otherprice);
                                                        let gstother = (otherprice - discother) * gstotherpct / 100;
                                                        let subtotal = (otherprice - discother + gstother) * qty;
                                                        reviseVueData.subtotalotherprice = subtotal.toFixed(2);
                                                        reviseVueData.gstother = gstother.toFixed(2);
                                                        reviseVueData.totaldiscountother = qty * discother;
                                                        reviseVueData.totalgstother = gstother * qty;
                                                    },
                                                    subtotalmat: function () {
                                                        console.log(reviseVueData.totalamount);
                                                        reviseVueData.totalamount = parseFloat(parseFloat(reviseVueData.subtotalmat) + parseFloat(reviseVueData.subtotalpmachprice) + parseFloat(reviseVueData.subtotalcncprice) + parseFloat(reviseVueData.subtotalotherprice)).toFixed(2);
                                                    },
                                                    subtotalpmachprice: function () {
                                                        console.log(reviseVueData.totalamount);
                                                        reviseVueData.totalamount = parseFloat(parseFloat(reviseVueData.subtotalmat) + parseFloat(reviseVueData.subtotalpmachprice) + parseFloat(reviseVueData.subtotalcncprice) + parseFloat(reviseVueData.subtotalotherprice)).toFixed(2);
                                                    },
                                                    subtotalcncprice: function () {
                                                        console.log(reviseVueData.totalamount);
                                                        reviseVueData.totalamount = parseFloat(parseFloat(reviseVueData.subtotalmat) + parseFloat(reviseVueData.subtotalpmachprice) + parseFloat(reviseVueData.subtotalcncprice) + parseFloat(reviseVueData.subtotalotherprice)).toFixed(2);
                                                    },
                                                    subtotalotherprice: function () {
                                                        console.log(reviseVueData.totalamount);
                                                        reviseVueData.totalamount = parseFloat(parseFloat(reviseVueData.subtotalmat) + parseFloat(reviseVueData.subtotalpmachprice) + parseFloat(reviseVueData.subtotalcncprice) + parseFloat(reviseVueData.subtotalotherprice)).toFixed(2);
                                                    }
                                                },
                                                computed: {
                                                    divBackColor: function () {
                                                        if (this.freepage) {
                                                            return "#125c49";
                                                        } else {
                                                            return "#222";
                                                        }
                                                    },
                                                    today_date_dmy: function () {
                                                        let dateObj = new Date();
                                                        d = dateObj.getDate();
                                                        m = dateObj.getMonth() + 1;
                                                        Y = dateObj.getFullYear();
                                                        return d + '-' + m + '-' + Y;
                                                    },
                                                },
                                                methods: {
                                                    issuedColor: function (index) {
                                                        let dat = reviseVueData.allItemList[index];
                                                        if (dat.odissue == 'no') {
                                                            return "#959695";
                                                        } else if (dat.status_od == 'cancelled') {
                                                            return "#c23636";
                                                        }
                                                    },

                                                    getCustomerDetails: function () {
                                                        checkSession();
                                                        axios.post(this.phpajaxresponsefile, {
                                                            action: 'getCustomerDetails',
                                                            cid: this.cid,
                                                            com: this.com
                                                        }).then(function (response) {
                                                            console.log('on getCustomerDetails');
                                                            console.log(response.data);
                                                            reviseVueData.customer_status = response.data.status;
                                                            if (response.data.status == 'ok') {
                                                                reviseVueData.customer_detail = response.data.detail;
                                                            } else {
                                                                reviseVueData.customer_msg = response.data.msg;
                                                            }
                                                            return response.data.status;
                                                        }).then(function (status) {
                                                            //console.log("status = " + status);
                                                            if (status == 'ok') {
                                                                cc_salesman = reviseVueData.customer_detail['aid_cus'];
                                                                axios.post(reviseVueData.phpajaxresponsefile, {
                                                                    action: 'getSalesman',
                                                                    aid_cus: cc_salesman

                                                                }).then(function (response) {
                                                                    if (response.data.status == 'ok') {
                                                                        sales_attn = response.data.name;
                                                                    } else {
                                                                        sales_attn = '<font style="color:red">' + response.data.msg + '</font>';
                                                                    }
                                                                    reviseVueData.sales_attn = sales_attn;
                                                                });
                                                            }
                                                        })

                                                    },
                                                    getOrderlistRecordRvs: function () {
                                                        checkSession();
                                                        axios.post(this.phpajaxresponsefile, {
                                                            action: 'getOrderlistRecordRvs',
                                                            period: this.period,
                                                            cid: this.cid,
                                                            quono: this.quono,
                                                            com: this.com
                                                        }).then(function (response) {
                                                            console.log('on getOrderlistRecordRvs');
                                                            console.log(response.data);
                                                            //reviseVueData.orderlist_status = response.data.status;
                                                            if (response.data.status == 'ok') {
                                                                //reviseVueData.orderlist_detail = response.data.detail;
                                                                reviseVueData.runno = response.data.detail[0].runningno;
                                                                return response.data;
                                                            } else {
                                                                return null;
                                                            }
                                                        });

                                                    },
                                                    getInitValues: function () {
                                                        checkSession();
                                                        reviseVueData.ordtab = document.getElementById('ordtab').value;
                                                        reviseVueData.quono = document.getElementById('quono').value;
                                                        reviseVueData.cid = document.getElementById('cid').value;
                                                        reviseVueData.period = document.getElementById('period').value;
                                                        reviseVueData.com = document.getElementById('com').value;
                                                        reviseVueData.rev_aid = document.getElementById('aid').value;
                                                    },
                                                    getItemList: function () {
                                                        checkSession();
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getItemList',
                                                            quono: reviseVueData.quono,
                                                            com: reviseVueData.com,
                                                            period: reviseVueData.period
                                                        }).then(function (response) {
                                                            console.log('on Getitemlist function...');
                                                            console.log(response.data);
                                                            response.data.forEach(function (item, index) {
                                                                varindex = index + 1;
                                                                itemList = 'item' + varindex + 'List';
                                                                reviseVueData[itemList] = item;
                                                                console.log('index : ' + index);
                                                                console.log(itemList + " = ");
                                                                console.log(reviseVueData[itemList]);
                                                                console.log('======================');
                                                            });
                                                            reviseVueData.allItemList = response.data;
                                                            let arrItemDetail = reviseVueData.allItemList[0];
                                                            //reviseVueData.com = arrItemDetail.company;
                                                            reviseVueData.accno = arrItemDetail.accno;
                                                            reviseVueData.aid_cus = arrItemDetail.aid_cus;
                                                            reviseVueData.aid_quo = arrItemDetail.aid_quo;
                                                            reviseVueData.bid = arrItemDetail.bid;
                                                            reviseVueData.currency = arrItemDetail.currency;
                                                            reviseVueData.cusstatus = arrItemDetail.cusstatus;
                                                            reviseVueData.ftz = arrItemDetail.ftz;
                                                            if (arrItemDetail.specialShapeOrder.includes("TRADE")) {
                                                                reviseVueData.mainShapeOrder = "TRADE";
                                                            } else {
                                                                reviseVueData.mainShapeOrder = arrItemDetail.specialShapeOrder;
                                                            }
                                                            console.log('allItemList number of arrays = ' + reviseVueData.allItemList.length);
                                                        });

                                                    },
                                                    reviseOrderlist: function () {
                                                        checkSession();
                                                        let arrItemList = reviseVueData.allItemList;
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'reviseOL_Price',
                                                            quono: reviseVueData.quono,
                                                            //new_quono: reviseVueData.new_quono,
                                                            cid: reviseVueData.cid,
                                                            com: reviseVueData.com,
                                                            arrItemList: arrItemList,
                                                            period: reviseVueData.period,
                                                            bid: reviseVueData.bid,
                                                            rev_aid: reviseVueData.rev_aid
                                                        }).then(function (response) {
                                                            console.log('in reviseOrderlist...');
                                                            console.log(response.data);
                                                            if (response.data.status == 'ok') {
                                                                //console.log(response.data);
                                                                /*mark edit here*/
                                                                window.alert(response.data.msg);
                                                                window.opener.iolVue.getCrudDetails();
                                                                window.close();
                                                            } else {
                                                                window.alert(response.data.msg);
                                                            }
                                                        });

                                                    },
                                                    removeItemDetail: function (i) {
                                                        let index = i - 1;
                                                        let remVal = confirm('Are you sure to delete this item?');
                                                        if (remVal) {
                                                            let arrItemList = reviseVueData.allItemList;
                                                            arrItemList.splice(index, 1);
                                                        }
                                                    },
                                                    propItemDetail: function (i) {
                                                        checkSession();
                                                        openDetails();
                                                        if (i != "new") {
                                                            let index = i - 1;
                                                            reviseVueData.modalTitle = 'Edit Item ' + i;
                                                            reviseVueData.curItemIndex = index;
                                                            console.log('item selected : ' + index);
                                                            let arrItemDetail = reviseVueData.allItemList[index];
                                                            console.log("selected Array of Data : ");
                                                            console.log(arrItemDetail);
                                                            if (arrItemDetail.pagetype == 'free') {
                                                                reviseVueData.freepage = true;
                                                            } else {
                                                                reviseVueData.freepage = false;
                                                            }
                                                            reviseVueData.category = arrItemDetail.category;
                                                            reviseVueData.custype = arrItemDetail.custype;
                                                            reviseVueData.density = arrItemDetail.density;
                                                            reviseVueData.dim_desc = arrItemDetail.dim_desp;
                                                            reviseVueData.fdl = arrItemDetail.fdl;
                                                            reviseVueData.fdt = arrItemDetail.fdt;
                                                            reviseVueData.fdw = arrItemDetail.fdw;
                                                            reviseVueData.finishing_dim_desc = arrItemDetail.finishing_dim_desp;
                                                            reviseVueData.mat = arrItemDetail.grade;
                                                            reviseVueData.materialname = arrItemDetail.materialname;
                                                            reviseVueData.mdl = arrItemDetail.mdl;
                                                            reviseVueData.mdt = arrItemDetail.mdt;
                                                            reviseVueData.mdw = arrItemDetail.mdw;
                                                            reviseVueData.cncprice = arrItemDetail.cncmach;
                                                            reviseVueData.otherprice = arrItemDetail.other;
                                                            reviseVueData.pmachprice = arrItemDetail.pmach;
                                                            reviseVueData.pmid = arrItemDetail.process;
                                                            reviseVueData.pricePerKG = arrItemDetail.priceperKG;
                                                            reviseVueData.pricePerPCS = arrItemDetail.mat;
                                                            reviseVueData.processcode = arrItemDetail.processcode;
                                                            reviseVueData.quantity = arrItemDetail.quantity;
                                                            reviseVueData.ShapeCode = arrItemDetail.Shape_Code;
                                                            if (arrItemDetail.specialShapeOrder.includes("TRADE")) {
                                                                console.log('found trade');
                                                                reviseVueData.specialShapeOrder = "TRADE";
                                                            } else {
                                                                reviseVueData.specialShapeOrder = arrItemDetail.specialShapeOrder;
                                                            }
                                                            reviseVueData.tabletype = arrItemDetail.tabletype;
                                                            reviseVueData.totalprice = arrItemDetail.amountmat;
                                                            reviseVueData.totalcncprice = arrItemDetail.amountcncmach;
                                                            reviseVueData.discountcnc = arrItemDetail.discountcncmach / arrItemDetail.quantity;
                                                            reviseVueData.totaldiscountcnc = arrItemDetail.discountcncmach;
                                                            reviseVueData.discountmat = arrItemDetail.discountmat / arrItemDetail.quantity;
                                                            reviseVueData.totaldiscountmat = arrItemDetail.discountmat;
                                                            reviseVueData.discountother = arrItemDetail.discountother / arrItemDetail.quantity;
                                                            reviseVueData.totaldiscountother = arrItemDetail.discountother;
                                                            reviseVueData.discountpmach = arrItemDetail.discountpmach / arrItemDetail.quantity;
                                                            reviseVueData.totaldiscountpmach = arrItemDetail.discountpmach;
                                                            reviseVueData.gstcnc = arrItemDetail.gstcncmach / arrItemDetail.quantity;
                                                            if (arrItemDetail.cncmach == 0) {
                                                                gstcncpercent = 0;
                                                            } else {
                                                                gstcncpercent = reviseVueData.gstcnc / (arrItemDetail.cncmach - reviseVueData.discountcnc) * 100;
                                                            }
                                                            reviseVueData.gstcncpct = Math.ceil(parseFloat(gstcncpercent), 2);
                                                            reviseVueData.totalgstcnc = arrItemDetail.gstcncmach;
                                                            reviseVueData.gstmat = arrItemDetail.gstmat / arrItemDetail.quantity;
                                                            if (arrItemDetail.mat == 0) {
                                                                gstmatpercent = 0;
                                                            } else {
                                                                gstmatpercent = reviseVueData.gstmat / (arrItemDetail.mat - reviseVueData.discountmat) * 100;
                                                            }
                                                            reviseVueData.gstmatpct = Math.ceil(parseFloat(gstmatpercent));
                                                            reviseVueData.totalgstmat = arrItemDetail.gstmat;
                                                            reviseVueData.gstother = arrItemDetail.gstother / arrItemDetail.quantity;
                                                            if (arrItemDetail.other == 0) {
                                                                gstotherpercent = 0;
                                                            } else {
                                                                gstotherpercent = reviseVueData.gstother / (arrItemDetail.other - reviseVueData.discountother) * 100;
                                                            }
                                                            reviseVueData.gstotherpct = Math.ceil(parseFloat(gstotherpercent));
                                                            reviseVueData.totalgstother = arrItemDetail.gstother;
                                                            reviseVueData.gstpmach = arrItemDetail.gstpmach / arrItemDetail.quantity;
                                                            if (arrItemDetail.pmach == 0) {
                                                                gstpmachpercent = 0;
                                                            } else {
                                                                gstpmachpercent = reviseVueData.gstpmach / (arrItemDetail.pmach - reviseVueData.discountpmach) * 100;
                                                            }
                                                            reviseVueData.gstpmachpct = Math.ceil(parseFloat(gstpmachpercent));
                                                            reviseVueData.totalgstpmach = arrItemDetail.gstpmach;
                                                            reviseVueData.totalotherprice = arrItemDetail.amountother;
                                                            reviseVueData.totalpmachprice = arrItemDetail.amountpmach;
                                                            reviseVueData.subtotalcncprice = arrItemDetail.totalamountcncmach;
                                                            reviseVueData.subtotalmat = arrItemDetail.totalamountmat;
                                                            reviseVueData.subtotalotherprice = arrItemDetail.totalamountother;
                                                            reviseVueData.subtotalpmachprice = arrItemDetail.totalamountpmach;
                                                            reviseVueData.totalamount = arrItemDetail.totalamount;
                                                            reviseVueData.totalweight = arrItemDetail.totalweight;
                                                            reviseVueData.volume = arrItemDetail.volumeperunit;
                                                            reviseVueData.weight = arrItemDetail.weightperunit;
                                                        } else {
                                                            this.cleanModal();
                                                            if (reviseVueData.mainShapeOrder == 'TRADE') {
                                                                reviseVueData.freepage = true;
                                                            }
                                                            reviseVueData.curItemIndex = reviseVueData.allItemList.length;
                                                            reviseVueData.modalTitle = 'Add New Item';
                                                        }

                                                    },
                                                    finalizeItemDetail: function () {
                                                        let index = reviseVueData.curItemIndex;
                                                        reviseVueData.curItemIndex = '';
                                                        let itemno = '';
                                                        let itemLen = reviseVueData.allItemList.length;
                                                        console.log('itemLen = ' + itemLen + '; index = ' + index);
                                                        if (itemLen == index) {
                                                            let itemRowJSON = JSON.stringify(reviseVueData.allItemList[index - 1]);
                                                            reviseVueData.allItemList.push(JSON.parse(itemRowJSON));
                                                            console.log('index-1 = ');
                                                            console.log(reviseVueData.allItemList[index - 1]);
                                                            console.log('index');
                                                            console.log(reviseVueData.allItemList[index]);
                                                        }
                                                        itemno = index + 1;
                                                        let arrItemDetail = reviseVueData.allItemList[index];
                                                        arrItemDetail.category = reviseVueData.category;
                                                        arrItemDetail.cncmach = reviseVueData.cncprice;
                                                        arrItemDetail.density = reviseVueData.density;
                                                        arrItemDetail.dim_desp = reviseVueData.dim_desc;
                                                        arrItemDetail.fdl = reviseVueData.fdl;
                                                        arrItemDetail.fdt = reviseVueData.fdt;
                                                        arrItemDetail.fdw = reviseVueData.fdw;
                                                        arrItemDetail.finishing_dim_desp = reviseVueData.finishing_dim_desc;
                                                        arrItemDetail.grade = reviseVueData.mat;
                                                        arrItemDetail.materialname = reviseVueData.materialname;
                                                        arrItemDetail.mdl = reviseVueData.mdl;
                                                        arrItemDetail.mdt = reviseVueData.mdt;
                                                        arrItemDetail.mdw = reviseVueData.mdw;
                                                        arrItemDetail.other = reviseVueData.otherprice;
                                                        arrItemDetail.pmach = reviseVueData.pmachprice;
                                                        arrItemDetail.process = reviseVueData.pmid;
                                                        arrItemDetail.priceperKG = reviseVueData.pricePerKG;
                                                        arrItemDetail.mat = reviseVueData.pricePerPCS;
                                                        arrItemDetail.processcode = reviseVueData.processcode;
                                                        arrItemDetail.quantity = reviseVueData.quantity;
                                                        arrItemDetail.Shape_Code = reviseVueData.ShapeCode; //
                                                        if (reviseVueData.specialShapeOrder === 'TRADE') {
                                                            arrItemDetail.specialShapeOrder = reviseVueData.ShapeCode + ' (' + 'TRADE' + ')';
                                                        } else {
                                                            arrItemDetail.specialShapeOrder = reviseVueData.specialShapeOrder;
                                                        }
                                                        arrItemDetail.totalamountcncmach = reviseVueData.subtotalcncprice;
                                                        arrItemDetail.totalamountmat = reviseVueData.subtotalmat;
                                                        arrItemDetail.totalamountother = reviseVueData.subtotalotherprice;
                                                        arrItemDetail.totalamountpmach = reviseVueData.subtotalpmachprice;
                                                        if (reviseVueData.tabletype === null) {
                                                            reviseVueData.tabletype = '';
                                                        }
                                                        arrItemDetail.tabletype = reviseVueData.tabletype;
                                                        arrItemDetail.totalamount = reviseVueData.totalamount;
                                                        arrItemDetail.amountcncmach = reviseVueData.totalcncprice;
                                                        arrItemDetail.discountcncmach = reviseVueData.totaldiscountcnc;
                                                        arrItemDetail.discountmat = reviseVueData.totaldiscountmat;
                                                        arrItemDetail.discountother = reviseVueData.totaldiscountother;
                                                        arrItemDetail.discountpmach = reviseVueData.totaldiscountpmach;
                                                        arrItemDetail.gstcncmach = reviseVueData.totalgstcnc;
                                                        arrItemDetail.gstmat = reviseVueData.totalgstmat;
                                                        arrItemDetail.gstother = reviseVueData.totalgstother;
                                                        arrItemDetail.gstpmach = reviseVueData.totalgstpmach;
                                                        arrItemDetail.amountother = reviseVueData.totalotherprice;
                                                        arrItemDetail.amountpmach = reviseVueData.totalpmachprice;
                                                        arrItemDetail.amountmat = reviseVueData.totalprice;
                                                        arrItemDetail.totalweight = reviseVueData.totalweight;
                                                        arrItemDetail.volumeperunit = reviseVueData.volume;
                                                        arrItemDetail.weightperunit = reviseVueData.weight;
                                                        arrItemDetail.item = itemno;
                                                    },
                                                    cleanModal: function () {
                                                        reviseVueData.category = '';
                                                        //reviseVueData.custype = '';
                                                        reviseVueData.custype = 'local'; //Default to local
                                                        reviseVueData.density = 0;
                                                        reviseVueData.dim_desc = '';
                                                        reviseVueData.fdl = 0;
                                                        reviseVueData.fdt = 0;
                                                        reviseVueData.fdw = 0;
                                                        reviseVueData.finishing_dim_desc = '';
                                                        reviseVueData.mat = '';
                                                        reviseVueData.materialname = '';
                                                        reviseVueData.mdl = 0;
                                                        reviseVueData.mdt = 0;
                                                        reviseVueData.mdw = 0;
                                                        reviseVueData.cncprice = 0;
                                                        reviseVueData.otherprice = 0;
                                                        reviseVueData.pmachprice = 0;
                                                        reviseVueData.pmid = 1;
                                                        reviseVueData.pricePerKG = 0;
                                                        reviseVueData.pricePerPCS = 0;
                                                        reviseVueData.processcode = '';
                                                        reviseVueData.quantity = 0;
                                                        reviseVueData.ShapeCode = '';
                                                        reviseVueData.specialShapeOrder = '';
                                                        reviseVueData.tabletype = '';
                                                        reviseVueData.totalprice = 0;
                                                        reviseVueData.totalcncprice = 0;
                                                        reviseVueData.discountcnc = 0;
                                                        reviseVueData.totaldiscountcnc = 0;
                                                        reviseVueData.discountmat = 0;
                                                        reviseVueData.totaldiscountmat = 0;
                                                        reviseVueData.discountother = 0;
                                                        reviseVueData.totaldiscountother = 0;
                                                        reviseVueData.discountpmach = 0;
                                                        reviseVueData.totaldiscountpmach = 0;
                                                        reviseVueData.gstcnc = 0;
                                                        reviseVueData.gstcncpct = 0;
                                                        reviseVueData.totalgstcnc = 0;
                                                        reviseVueData.gstmat = 0;
                                                        reviseVueData.gstmatpct = 0;
                                                        reviseVueData.totalgstmat = 0;
                                                        reviseVueData.gstother = 0;
                                                        reviseVueData.gstotherpct = 0;
                                                        reviseVueData.totalgstother = 0;
                                                        reviseVueData.gstpmach = 0;
                                                        reviseVueData.gstpmachpct = 0;
                                                        reviseVueData.totalgstpmach = 0;
                                                        reviseVueData.totalotherprice = 0;
                                                        reviseVueData.totalpmachprice = 0;
                                                        reviseVueData.subtotalcncprice = 0;
                                                        reviseVueData.subtotalmat = 0;
                                                        reviseVueData.subtotalotherprice = 0;
                                                        reviseVueData.subtotalpmachprice = 0;
                                                        reviseVueData.totalamount = 0;
                                                        reviseVueData.totalweight = 0;
                                                        reviseVueData.volume = 0;
                                                        reviseVueData.weight = 0;
                                                    },
                                                    //Methods for Details Modal
                                                    getMaterial: function () {
                                                        let specialShapeOrder = reviseVueData.specialShapeOrder;
                                                        if (specialShapeOrder === 'TRADE') {
                                                            specialShapeOrder = 'NORMAL'; // Temporary using all data, later change it.
                                                        }
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getMaterial',
                                                            specialShape: specialShapeOrder
                                                        }).then(function (response) {
                                                            console.log("on  getMaterial...");
                                                            console.log(response.data);
                                                            reviseVueData.materialList = response.data;
                                                        });
                                                    },
                                                    getPmach: function () {
                                                        checkSession();
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getPmach',
                                                            Shape_Code: reviseVueData.ShapeCode,
                                                            specialShapeOrder: reviseVueData.specialShapeOrder
                                                        }).then(function (response) {
                                                            console.log('on getPmach function...');
                                                            console.log(response.data);
                                                            reviseVueData.pmachList = response.data;
                                                        });
                                                    },
                                                    getProcessByPmid: function () {
                                                        let dat = reviseVueData.pmachList;
                                                        let pmid = reviseVueData.pmid;
                                                        let datPmach = dat.filter(d => d.pmid === pmid);
                                                        reviseVueData.processcode = datPmach[0].process;
                                                    },
                                                    getMainDetail: function () {
                                                        let matcode = reviseVueData.mat;
                                                        let dat = reviseVueData.materialList;
                                                        console.log('matcode ' + matcode);
                                                        datMatDetail = dat.filter(d => d.materialcode === matcode);
                                                        console.log(datMatDetail);
                                                        reviseVueData.category = datMatDetail[0].category;
                                                        console.log('category = ' + datMatDetail[0].category);
                                                        reviseVueData.ShapeCode = datMatDetail[0].Shape_Code;
                                                        console.log('Shape_Code = ' + datMatDetail[0].Shape_Code);
                                                        reviseVueData.tabletype = datMatDetail[0].tabletype;
                                                        console.log('tabletype = ' + datMatDetail[0].tabletype);
                                                        reviseVueData.materialname = datMatDetail[0].material;
                                                        console.log('materialname = ' + datMatDetail[0].material);
                                                    },
                                                    getThickList: function () {
                                                        let custype = reviseVueData.custype;
                                                        let company = reviseVueData.com;
                                                        let cid = reviseVueData.cid;
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getThicklist',
                                                            matcode: reviseVueData.mat,
                                                            custype: custype,
                                                            company: company,
                                                            cid: cid
                                                        }).then(function (response) {
                                                            console.log('getThicklist');
                                                            console.log(response.data);
                                                            reviseVueData.thickList = response.data;
                                                        });
                                                    },
                                                    getW1List: function () {
                                                        let custype = reviseVueData.custype;
                                                        let company = reviseVueData.com;
                                                        console.log('company = ' + company);
                                                        let cid = reviseVueData.cid;
                                                        console.log('cid = ' + cid);
                                                        let thickness = reviseVueData.thickness;
                                                        console.log('thickness = ' + thickness);
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getW1List',
                                                            matcode: reviseVueData.mat,
                                                            custype: custype,
                                                            company: company,
                                                            cid: cid,
                                                            thickness: thickness
                                                        }).then(function (response) {
                                                            console.log('getW1List');
                                                            console.log(response.data);
                                                            reviseVueData.w1List = response.data;
                                                            console.log(reviseVueData.w1List);
                                                        });
                                                    },
                                                    getW2List: function () {
                                                        let custype = reviseVueData.custype;
                                                        let company = reviseVueData.com;
                                                        let cid = reviseVueData.cid;
                                                        let thickness = reviseVueData.thickness;
                                                        let width = reviseVueData.width1;
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getW2List',
                                                            matcode: reviseVueData.mat,
                                                            custype: custype,
                                                            company: company,
                                                            cid: cid,
                                                            thickness: thickness,
                                                            width: width
                                                        }).then(function (response) {
                                                            console.log('getW2List');
                                                            console.log(response.data);
                                                            reviseVueData.w2List = response.data;
                                                        });
                                                    },
                                                    getPmachPriceCalc: function () {
                                                        let qty = parseFloat(reviseVueData.quantity);
                                                        let discpmach = parseFloat(reviseVueData.discountpmach);
                                                        let gstpmachpct = parseFloat(reviseVueData.gstpmachpct);
                                                        let pmachprice = parseFloat(reviseVueData.pmachprice);
                                                        let gstpmach = (pmachprice - discpmach) * gstpmachpct / 100;
                                                        let subtotal = (pmachprice - discpmach + gstpmach) * qty;
                                                        reviseVueData.subtotalpmachprice = subtotal.toFixed(2);
                                                        reviseVueData.gstpmach = gstpmach.toFixed(2);
                                                        reviseVueData.totaldiscountpmach = qty * discpmach;
                                                        reviseVueData.totalgstpmach = gstpmach * qty;
                                                    },
                                                    getPmachPrice: function () {
                                                        checkSession();
                                                        let pmid = reviseVueData.pmid;
                                                        console.log('pmid = ' + pmid);
                                                        let company = reviseVueData.com;
                                                        let cid = reviseVueData.cid;
                                                        if (pmid != 1) {
                                                            let matcode = reviseVueData.mat;
                                                            let thickness = reviseVueData.dT;
                                                            let width = reviseVueData.dW;
                                                            let length = reviseVueData.dL;
                                                            let custype = reviseVueData.custype;
                                                            let quantity = reviseVueData.quantity;
                                                            let tol = reviseVueData.tol;
                                                            axios.post(reviseVueData.phpajaxresponsefile, {
                                                                action: 'getPmachPrice',
                                                                matcode: matcode,
                                                                thickness: thickness,
                                                                width: width,
                                                                length: length,
                                                                tol: tol,
                                                                pmid: pmid,
                                                                custype: custype,
                                                                cid: cid,
                                                                company: company,
                                                                quantity: quantity
                                                            }).then(function (response) {
                                                                console.log('on getPmachPrice function...');
                                                                console.log(response.data);
                                                                let pmachResult = response.data;
                                                                reviseVueData.pmachprice = pmachResult.pmach;
                                                                console.log('pmachprice  = ' + pmachResult.pmach);
                                                                reviseVueData.totalpmachprice = pmachResult.totalpmach;
                                                                console.log('totalpmachprice  = ' + pmachResult.totalpmach);
                                                            });
                                                        } else {
                                                            reviseVueData.pmachprice = 0;
                                                            reviseVueData.totalpmachprice = 0;
                                                        }


                                                    },

                                                    getWeightCalc: function () {
                                                        let weight = reviseVueData.weight;
                                                        let quantity = reviseVueData.quantity;

                                                        let totalweight = parseFloat(weight) * parseFloat(quantity);
                                                        reviseVueData.totalweight = parseFloat(totalweight).toFixed(2);
                                                        let pricePerPCS = reviseVueData.pricePerPCS;
                                                        reviseVueData.pricePerkG = parseFloat(parseFloat(pricePerPCS) / parseFloat(weight)).toFixed(2);
                                                    },
                                                    getMatPriceCalc: function () {
                                                        let pricePerPCS = reviseVueData.pricePerPCS;
                                                        let discount = reviseVueData.discountmat;
                                                        let gstmatval = reviseVueData.gstmat;
                                                        let quantity = reviseVueData.quantity;

                                                        let totalprice = parseFloat(pricePerPCS) * quantity;
                                                        let subtotalprice = (parseFloat(pricePerPCS) - parseFloat(discount) + parseFloat(gstmatval)) * quantity;
                                                        reviseVueData.totalprice = parseFloat(totalprice).toFixed(2);
                                                        reviseVueData.subtotalmat = parseFloat(subtotalprice).toFixed(2);

                                                    },
                                                    getMatPrice: function () {
                                                        checkSession();
                                                        let custype = reviseVueData.custype;
                                                        let Shape_Code = reviseVueData.ShapeCode;
                                                        let specialShapeOrder = reviseVueData.specialShapeOrder;
                                                        let matcode = reviseVueData.mat;
                                                        let company = reviseVueData.com;
                                                        let cid = reviseVueData.cid;
                                                        let quantity = reviseVueData.quantity;
                                                        let valDimension;
                                                        switch (Shape_Code) {
                                                            case 'PLATEN':
                                                                switch (specialShapeOrder) {
                                                                    case 'NORMAL':
                                                                        //[T,W,L]
                                                                        valDimension = [reviseVueData.dT, reviseVueData.dW, reviseVueData.dL];
                                                                        break;
                                                                    case 'PLATEC':
                                                                        //[T,OD,W,L]
                                                                        valDimension = [reviseVueData.dT, reviseVueData.dOD, reviseVueData.dW, reviseVueData.dL];
                                                                        break;
                                                                    case 'PLATECO':
                                                                        //[T,OD,ID,W,L]
                                                                        valDimension = [reviseVueData.dT, reviseVueData.dOD, reviseVueData.dID, reviseVueData.dW, reviseVueData.dL];
                                                                        break;
                                                                }
                                                                break;
                                                            case 'SS':
                                                                //[W1, W2, L]
                                                                valDimension = [reviseVueData.dW1, reviseVueData.dW2, reviseVueData.dL];
                                                                break;
                                                            case 'FLAT':
                                                                //[T, W, L]
                                                                valDimension = [reviseVueData.dT, reviseVueData.dW, reviseVueData.dL];
                                                                break;
                                                            case 'O':
                                                                //[PHI, L]
                                                                valDimension = [reviseVueData.dPHI, reviseVueData.dL];
                                                                break;
                                                            case 'HEX':
                                                                //[HEX,L]
                                                                valDimension = [reviseVueData.dHEX, reviseVueData.dL];
                                                                break;
                                                            case 'HS':
                                                                //[T, W1, W2, L]
                                                                valDimension = [reviseVueData.dT, reviseVueData.dW1, reviseVueData.dW2, reviseVueData.dL];
                                                                break;
                                                            case 'HP':
                                                                //[OD, ID, L]
                                                                valDimension = [reviseVueData.dOD, reviseVueData.dID, reviseVueData.dL];
                                                                break;
                                                            case 'A':
                                                                //[T,W1,W2,L]
                                                                console.log('getMatPrice for A: ');
                                                                valDimension = [reviseVueData.dT, reviseVueData.dW1, reviseVueData.dW2, reviseVueData.dL];
                                                                console.log(valDimension);
                                                                break;
                                                            case 'C':
                                                                //[H,A,T,ribT,L]
                                                                valDimension = [reviseVueData.dH, reviseVueData.dA, reviseVueData.dT, reviseVueData.dribT, reviseVueData.dL];
                                                                break;
                                                            case 'LIP':
                                                                //[H,A,C,T,L]
                                                                valDimension = [reviseVueData.dH, reviseVueData.dA, reviseVueData.dC, reviseVueData.dT, reviseVueData.dL];
                                                                break;
                                                            case 'H':
                                                                //[H,B,T1,T2,L]
                                                                valDimension = [reviseVueData.dH, reviseVueData.dB, reviseVueData.dT1, reviseVueData.dT2, reviseVueData.dL];
                                                                break;
                                                        }
                                                        axios.post(reviseVueData.phpajaxresponsefile, {
                                                            action: 'getMatPrice',
                                                            ShapeCode: Shape_Code,
                                                            specialShapeOrder: specialShapeOrder,
                                                            matcode: matcode,
                                                            company: company,
                                                            custype: custype,
                                                            cid: cid,
                                                            valDimension: JSON.stringify(valDimension),
                                                            quantity: quantity
                                                        }).then(function (response) {
                                                            console.log('on getMatPrice function ...');
                                                            console.log(response.data);
                                                            reviseVueData.matprice_stats = response.data.status;
                                                            if (response.data.status == 'ok') {
                                                                let matPriceResult = response.data;
                                                                w = parseFloat(matPriceResult.weight);
                                                                reviseVueData.weight = w.toFixed(2);
                                                                console.log('weight = ' + matPriceResult.weight);
                                                                reviseVueData.volume = matPriceResult.volume.toFixed(2);
                                                                console.log('volume = ' + matPriceResult.volume);
                                                                reviseVueData.density = matPriceResult.density;
                                                                console.log('density = ' + matPriceResult.density);
                                                                reviseVueData.pricePerKG = matPriceResult.pricePerKG.toFixed(2);
                                                                console.log('pricePerKG = ' + matPriceResult.pricePerKG);
                                                                reviseVueData.pricePerPCS = matPriceResult.pricePerPCS.toFixed(2);
                                                                console.log('pricePerPCS = ' + matPriceResult.pricePerPCS);
                                                                reviseVueData.totalweight = matPriceResult.totalweight.toFixed(2);
                                                                console.log('totalweight = ' + matPriceResult.totalweight);
                                                                reviseVueData.totalprice = matPriceResult.totalprice.toFixed(2);
                                                                console.log('totalprice = ' + matPriceResult.totalprice);
                                                            } else if (response.data.status == 'error') {
                                                                reviseVueData.matprice_resp = response.data.msg;

                                                            }
                                                        });

                                                    },
                                                    parseDimension: function () {
                                                        let dim_desc;
                                                        let finishing_dim_desc;
                                                        let mdt;
                                                        let mdw;
                                                        let mdl;
                                                        let fdt;
                                                        let fdw;
                                                        let fdl;
                                                        let Shape_Code = reviseVueData.ShapeCode;
                                                        let specialShapeOrder = reviseVueData.specialShapeOrder;
                                                        if (specialShapeOrder !== 'TRADE') {
                                                            switch (Shape_Code) {
                                                                case 'PLATEN':
                                                                    switch (specialShapeOrder) {
                                                                        case 'NORMAL':
                                                                            dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x W' + parseFloat(reviseVueData.dW) + ' x L' + parseFloat(reviseVueData.dL);
                                                                            finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x W' + parseFloat(reviseVueData.fW) + ' x L' + parseFloat(reviseVueData.fL);
                                                                            mdt = reviseVueData.dT;
                                                                            mdw = reviseVueData.dW;
                                                                            mdl = reviseVueData.dL;
                                                                            fdt = reviseVueData.fT;
                                                                            fdw = reviseVueData.fW;
                                                                            fdl = reviseVueData.fL;
                                                                            break;
                                                                        case 'PLATEC':
                                                                            //[T,OD,W,L]
                                                                            dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x OD' + parseFloat(reviseVueData.dOD) + ' x W' + parseFloat(reviseVueData.dW) + ' x L' + parseFloat(reviseVueData.dL);
                                                                            finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x OD' + parseFloat(reviseVueData.fOD) + ' x W' + parseFloat(reviseVueData.fW) + ' x L' + parseFloat(reviseVueData.fL);
                                                                            mdt = reviseVueData.dT;
                                                                            mdw = reviseVueData.dW;
                                                                            mdl = reviseVueData.dL;
                                                                            fdt = reviseVueData.fT;
                                                                            fdw = reviseVueData.fW;
                                                                            fdl = reviseVueData.fL;
                                                                            break;
                                                                        case 'PLATECO':
                                                                            //[T,OD,ID,W,L]
                                                                            dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x OD' + parseFloat(reviseVueData.dOD) + ' x ID' + parseFloat(reviseVueData.dID) + ' x W' + parseFloat(reviseVueData.dW) + ' x L ' + parseFloat(reviseVueData.dL);
                                                                            finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x OD' + parseFloat(reviseVueData.fOD) + ' x ID' + parseFloat(reviseVueData.fID) + ' x W' + parseFloat(reviseVueData.fW) + ' x L ' + parseFloat(reviseVueData.fL);
                                                                            mdt = reviseVueData.dT;
                                                                            mdw = parseFloat(reviseVueData.dW);
                                                                            mdl = parseFloat(reviseVueData.dL);
                                                                            fdt = reviseVueData.fT;
                                                                            fdw = reviseVueData.fW;
                                                                            fdl = reviseVueData.fL;
                                                                            break;
                                                                    }
                                                                    break;
                                                                case 'SS':
                                                                    //[W1, W2, L]
                                                                    dim_desc = 'W1' + parseFloat(reviseVueData.dW1) + ' x W2' + parseFloat(reviseVueData.dW2) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'W1' + parseFloat(reviseVueData.fW1) + ' x W2' + parseFloat(reviseVueData.fW2) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dW1;
                                                                    mdw = reviseVueData.dW2;
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fW1;
                                                                    fdw = reviseVueData.fW2;
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'FLAT':
                                                                    //[T, W, L]
                                                                    dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x W' + parseFloat(reviseVueData.dW) + ' x L' + reviseVueData.dL;
                                                                    finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x W' + parseFloat(reviseVueData.fW) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dT;
                                                                    mdw = reviseVueData.dW;
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fT;
                                                                    fdw = reviseVueData.fW;
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'O':
                                                                    //[PHI, L]
                                                                    dim_desc = 'PHI' + parseFloat(reviseVueData.dPHI) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'PHI' + parseFloat(reviseVueData.fPHI) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dPHI;
                                                                    mdw = '';
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fPHI;
                                                                    fdw = '';
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'HEX':
                                                                    //[HEX,L]
                                                                    dim_desc = 'HEX' + parseFloat(reviseVueData.dHEX) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'HEX' + parseFloat(reviseVueData.fHEX) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dHEX;
                                                                    mdw = '';
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fHEX;
                                                                    fdw = '';
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'HS':
                                                                    //[T, W1, W2, L]
                                                                    dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x W1' + parseFloat(reviseVueData.dW1) + ' x W2' + parseFloat(reviseVueData.dW2) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x W1' + parseFloat(reviseVueData.fW1) + ' x W2' + parseFloat(reviseVueData.fW2) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dT;
                                                                    mdw = parseFloat(reviseVueData.dW1) + ' x ' + parseFloat(reviseVueData.dW2);
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fHEX;
                                                                    fdw = parseFloat(reviseVueData.fW1) + ' x ' + parseFloat(reviseVueData.fW2);
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'HP':
                                                                    //[OD, ID, L]
                                                                    dim_desc = 'OD' + parseFloat(reviseVueData.dOD) + ' x ID' + parseFloat(reviseVueData.dID) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'OD' + parseFloat(reviseVueData.fOD) + ' x ID' + parseFloat(reviseVueData.fID) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dOD;
                                                                    mdw = reviseVueData.dID;
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fOD;
                                                                    fdw = reviseVueData.fID;
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'A':
                                                                    //[T,W1,W2,L]
                                                                    dim_desc = 'T' + parseFloat(reviseVueData.dT) + ' x W1' + parseFloat(reviseVueData.dW1) + ' x W2' + parseFloat(reviseVueData.dW2) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'T' + parseFloat(reviseVueData.fT) + ' x W1' + parseFloat(reviseVueData.fW1) + ' x W2' + parseFloat(reviseVueData.fW2) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = reviseVueData.dT;
                                                                    mdw = parseFloat(reviseVueData.dW1) + ' x ' + parseFloat(reviseVueData.dW2);
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = reviseVueData.fHEX;
                                                                    fdw = parseFloat(reviseVueData.fW1) + ' x ' + parseFloat(reviseVueData.fW2);
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'C':
                                                                    //[H,A,T,ribT,L]
                                                                    dim_desc = 'H' + parseFloat(reviseVueData.dH) + ' x A' + parseFloat(reviseVueData.dA) + ' x rT' + parseFloat(reviseVueData.dribT) + ' x T' + parseFloat(reviseVueData.dT) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'H' + parseFloat(reviseVueData.fH) + ' x A' + parseFloat(reviseVueData.fA) + ' x rT' + parseFloat(reviseVueData.fribT) + ' x T' + parseFloat(reviseVueData.fT) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = 'H ' + parseFloat(reviseVueData.dH) + ' x A ' + parseFloat(reviseVueData.dA);
                                                                    mdw = 'ribT ' + parseFloat(reviseVueData.dribT) + ' x T ' + parseFloat(reviseVueData.dT);
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = 'H ' + parseFloat(reviseVueData.fH) + ' x A ' + parseFloat(reviseVueData.fA);
                                                                    fdw = 'ribT ' + parseFloat(reviseVueData.fribT) + ' x T ' + parseFloat(reviseVueData.fT);
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'LIP':
                                                                    //[H,A,C,T,L]
                                                                    dim_desc = 'H' + parseFloat(reviseVueData.dH) + ' x A' + parseFloat(reviseVueData.dA) + ' x C' + parseFloat(reviseVueData.dC) + ' x T' + parseFloat(reviseVueData.dT) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'H' + parseFloat(reviseVueData.fH) + ' x A' + parseFloat(reviseVueData.fA) + ' x C' + parseFloat(reviseVueData.fC) + ' x T' + parseFloat(reviseVueData.fT) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = 'H ' + parseFloat(reviseVueData.dH) + ' x A ' + parseFloat(reviseVueData.dA);
                                                                    mdw = 'C ' + parseFloat(reviseVueData.dC) + ' x T ' + parseFloat(reviseVueData.dT);
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = 'H ' + parseFloat(reviseVueData.fH) + ' x A ' + parseFloat(reviseVueData.fA);
                                                                    fdw = 'C ' + parseFloat(reviseVueData.fC) + ' x T ' + parseFloat(reviseVueData.fT);
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                                case 'H':
                                                                    //[H,B,T1,T2,L]
                                                                    dim_desc = 'H' + parseFloat(reviseVueData.dH) + ' x B' + parseFloat(reviseVueData.dB) + ' x T1' + parseFloat(reviseVueData.dT1) + ' x T2' + parseFloat(reviseVueData.dT2) + ' x L' + parseFloat(reviseVueData.dL);
                                                                    finishing_dim_desc = 'H' + parseFloat(reviseVueData.fH) + ' x B' + parseFloat(reviseVueData.fB) + ' x T1' + parseFloat(reviseVueData.fT1) + ' x T2' + parseFloat(reviseVueData.fT2) + ' x L' + parseFloat(reviseVueData.fL);
                                                                    mdt = 'H ' + parseFloat(reviseVueData.dH) + ' x B ' + parseFloat(reviseVueData.dB);
                                                                    mdw = 'T1 ' + parseFloat(reviseVueData.dT1) + ' x T2 ' + parseFloat(reviseVueData.dT2);
                                                                    mdl = reviseVueData.dL;
                                                                    fdt = 'H ' + parseFloat(reviseVueData.fH) + ' x B ' + parseFloat(reviseVueData.fB);
                                                                    fdw = 'T1 ' + parseFloat(reviseVueData.fT1) + ' x T ' + parseFloat(reviseVueData.fT2);
                                                                    fdl = reviseVueData.fL;
                                                                    break;
                                                            }
                                                            reviseVueData.mdt = mdt;
                                                            reviseVueData.mdw = mdw;
                                                            reviseVueData.mdl = mdl;
                                                            reviseVueData.fdt = fdt;
                                                            reviseVueData.fdw = fdw;
                                                            reviseVueData.fdl = fdl;
                                                        } else {
                                                            finishing_dim_desc = reviseVueData.dim_desc;
                                                            dim_desc = reviseVueData.dim_desc;
                                                        }
                                                        reviseVueData.dim_desc = dim_desc;
                                                        reviseVueData.finishing_dim_desc = finishing_dim_desc;
                                                    },
                                                    reverseParseDimension: function () {
                                                        console.log('on reverseParseDimension ....');
                                                        let dim_desc = reviseVueData.dim_desc;
                                                        let finishing_dim_desc = reviseVueData.finishing_dim_desc;
                                                        console.log('dim_desc = ' + dim_desc + "; finishing_dim_desc = " + finishing_dim_desc);
                                                        let Shape_Code = reviseVueData.ShapeCode;
                                                        let specialShapeOrder = reviseVueData.specialShapeOrder;
                                                        switch (Shape_Code) {
                                                            case 'PLATEN':
                                                                switch (specialShapeOrder) {
                                                                    case 'NORMAL': //T x W x L
                                                                        console.log('case = PLATEN;NORMAL');
                                                                        dimres = dim_desc.replace(/T|W|L/gi, "");
                                                                        fdimres = finishing_dim_desc.replace(/T|W|L/gi, "");
                                                                        console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                        dimarr = dimres.split("x");
                                                                        fdimarr = fdimres.split("x");
                                                                        reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                        reviseVueData.dW = parseFloat(dimarr[1]).toFixed(2);
                                                                        reviseVueData.dL = parseFloat(dimarr[2]).toFixed(2);
                                                                        reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                        reviseVueData.fW = parseFloat(fdimarr[1]);
                                                                        reviseVueData.fL = parseFloat(fdimarr[2]);
                                                                        break;
                                                                    case 'PLATEC':
                                                                        //[T,OD,W,L]
                                                                        console.log('case = PLATEN;PLATEC');
                                                                        dimres = dim_desc.replace(/T|OD|W|L/gi, "");
                                                                        fdimres = finishing_dim_desc.replace(/T|OD|W|L/gi, "");
                                                                        console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                        dimarr = dimres.split("x");
                                                                        fdimarr = fdimres.split("x");
                                                                        reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                        reviseVueData.dOD = parseFloat(dimarr[1]).toFixed(2);
                                                                        reviseVueData.dW = parseFloat(dimarr[2]).toFixed(2);
                                                                        reviseVueData.dL = parseFloat(dimarr[3]).toFixed(2);
                                                                        reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                        reviseVueData.fOD = parseFloat(fdimarr[1]);
                                                                        reviseVueData.fW = parseFloat(fdimarr[2]);
                                                                        reviseVueData.fL = parseFloat(fdimarr[3]);
                                                                        break;
                                                                    case 'PLATECO':
                                                                        //[T,OD,ID,W,L]
                                                                        console.log('case = PLATEN;PLATECO');
                                                                        dimres = dim_desc.replace(/T|OD|ID|W|L/gi, "");
                                                                        fdimres = finishing_dim_desc.replace(/T|OD|ID|W|L/gi, "");
                                                                        console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                        dimarr = dimres.split("x");
                                                                        fdimarr = fdimres.split("x");
                                                                        reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                        reviseVueData.dOD = parseFloat(dimarr[1]).toFixed(2);
                                                                        reviseVueData.dID = parseFloat(dimarr[2]).toFixed(2);
                                                                        reviseVueData.dW = parseFloat(dimarr[3]).toFixed(2);
                                                                        reviseVueData.dL = parseFloat(dimarr[4]).toFixed(2);
                                                                        reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                        reviseVueData.fOD = parseFloat(fdimarr[1]);
                                                                        reviseVueData.fOD = parseFloat(fdimarr[2]);
                                                                        reviseVueData.fW = parseFloat(fdimarr[3]);
                                                                        reviseVueData.fL = parseFloat(fdimarr[4]);
                                                                        break;
                                                                }
                                                                break;
                                                            case 'SS':
                                                                //[W1, W2, L]
                                                                console.log('case = SS');
                                                                dimres = dim_desc.replace(/W1|W2|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/W1|W2|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dW1 = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dW2 = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.fW1 = parseFloat(fdimarr[0]);
                                                                reviseVueData.fW2 = parseFloat(fdimarr[1]);
                                                                reviseVueData.fL = parseFloat(fdimarr[2]);
                                                                break;
                                                            case 'FLAT':
                                                                //[T, W, L]
                                                                console.log('case = FLAT');
                                                                dimres = dim_desc.replace(/T|W|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/T|W|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dW = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                reviseVueData.fW = parseFloat(fdimarr[1]);
                                                                reviseVueData.fL = parseFloat(fdimarr[2]);
                                                                break;
                                                            case 'O':
                                                                //[PHI, L]
                                                                console.log('case = O');
                                                                dimres = dim_desc.replace(/PHI|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/PHI|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dPHI = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.fPHI = parseFloat(fdimarr[0]);
                                                                reviseVueData.fL = parseFloat(fdimarr[1]);
                                                                break;
                                                            case 'HEX':
                                                                //[HEX,L]
                                                                console.log('case = HEX');
                                                                dimres = dim_desc.replace(/HEX|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/HEX|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dHEX = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.fHEX = parseFloat(fdimarr[0]);
                                                                reviseVueData.fL = parseFloat(fdimarr[1]);
                                                                break;
                                                            case 'HS':
                                                                //[T, W1, W2, L]
                                                                console.log('case = HS');
                                                                dimres = dim_desc.replace(/T|W1|W2|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/T|W1|W2|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dW1 = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dW2 = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[3]).toFixed(2);
                                                                reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                reviseVueData.fW1 = parseFloat(fdimarr[1]);
                                                                reviseVueData.fW2 = parseFloat(fdimarr[2]);
                                                                reviseVueData.fL = parseFloat(fdimarr[3]);
                                                                break;
                                                            case 'HP':
                                                                //[OD, ID, L]
                                                                console.log('case = HP');
                                                                dimres = dim_desc.replace(/OD|ID|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/OD|ID|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dOD = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dID = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.fOD = parseFloat(fdimarr[0]);
                                                                reviseVueData.fID = parseFloat(fdimarr[1]);
                                                                reviseVueData.fL = parseFloat(fdimarr[2]);
                                                                break;
                                                            case 'A':
                                                                //[T,W1,W2,L]
                                                                console.log('case = A');
                                                                dimres = dim_desc.replace(/T|W1|W2|L/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/T|W1|W2|L/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dT = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dW1 = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dW2 = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[3]).toFixed(2);
                                                                reviseVueData.fT = parseFloat(fdimarr[0]);
                                                                reviseVueData.fW1 = parseFloat(fdimarr[1]);
                                                                reviseVueData.fW2 = parseFloat(fdimarr[2]);
                                                                reviseVueData.fL = parseFloat(fdimarr[3]);
                                                                break;
                                                            case 'C':
                                                                //[H,A,ribT,T,L]
                                                                console.log('case = C');
                                                                dimres = dim_desc.replace(/\[|H|A|rT|T|L|\]/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/\[|H|A|rT|T|L|\]/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dH = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dA = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dribT = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.dT = parseFloat(dimarr[3]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[4]).toFixed(2);
                                                                reviseVueData.fH = parseFloat(fdimarr[0]).toFixed(2);
                                                                reviseVueData.fA = parseFloat(fdimarr[1]).toFixed(2);
                                                                reviseVueData.fribT = parseFloat(fdimarr[2]).toFixed(2);
                                                                reviseVueData.fT = parseFloat(fdimarr[3]).toFixed(2);
                                                                reviseVueData.fL = parseFloat(fdimarr[4]).toFixed(2);
                                                                break;
                                                            case 'LIP':
                                                                //[H,A,C,T,L]
                                                                console.log('case = LIP');
                                                                dimres = dim_desc.replace(/\[|H|A|C|T|L|\]/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/\[|H|A|C|T|L|\]/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dH = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dA = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dC = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.dT = parseFloat(dimarr[3]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[4]).toFixed(2);
                                                                reviseVueData.fH = parseFloat(fdimarr[0]).toFixed(2);
                                                                reviseVueData.fA = parseFloat(fdimarr[1]).toFixed(2);
                                                                reviseVueData.fC = parseFloat(fdimarr[2]).toFixed(2);
                                                                reviseVueData.fT = parseFloat(fdimarr[3]).toFixed(2);
                                                                reviseVueData.fL = parseFloat(fdimarr[4]).toFixed(2);
                                                                break;
                                                            case 'H':
                                                                //[H,B,T1,T2,L]
                                                                console.log('case = C');
                                                                dimres = dim_desc.replace(/\[|H|B|T1|T2|L|\]/gi, "");
                                                                fdimres = finishing_dim_desc.replace(/\[|H|B|T1|T2|L|\]/gi, "");
                                                                console.log('dimres = ' + dimres + "; fdimres = " + fdimres);
                                                                dimarr = dimres.split("x");
                                                                fdimarr = fdimres.split("x");
                                                                reviseVueData.dH = parseFloat(dimarr[0]).toFixed(2);
                                                                reviseVueData.dB = parseFloat(dimarr[1]).toFixed(2);
                                                                reviseVueData.dT1 = parseFloat(dimarr[2]).toFixed(2);
                                                                reviseVueData.dT2 = parseFloat(dimarr[3]).toFixed(2);
                                                                reviseVueData.dL = parseFloat(dimarr[4]).toFixed(2);
                                                                reviseVueData.fH = parseFloat(fdimarr[0]).toFixed(2);
                                                                reviseVueData.fB = parseFloat(fdimarr[1]).toFixed(2);
                                                                reviseVueData.fT1 = parseFloat(fdimarr[2]).toFixed(2);
                                                                reviseVueData.fT2 = parseFloat(fdimarr[3]).toFixed(2);
                                                                reviseVueData.fL = parseFloat(fdimarr[4]).toFixed(2);
                                                                break;
                                                        }
                                                    }
                                                },
                                                mounted: function () {
                                                    this.getInitValues();
                                                    this.getItemList();
                                                    this.getCustomerDetails();
                                                    this.getOrderlistRecordRvs();
                                                }
                                            });

    </script>