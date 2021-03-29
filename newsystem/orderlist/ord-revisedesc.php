<?php
include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/quotation.inc.php';
include_once 'class/phhdate.inc.php';
include_once 'class/operation.inc.php';


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
<!DOCTYPE html> 
<html lang="en">

    <body>
        <div class="container-fluid" id="mainArea">    
            <button ref='reviseModalPopUp' id='reviseModalPopUp' name='reviseModalPopUp' data-toggle="modal" data-target="#reviseModal"  data-backdrop="static" data-keyboard="false" hidden ></button>


            <!--  modal area  -->
            <div class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="reviseModal">
                <div class="modal-dialog modal-xl" style="">
                    <div class="modal-content">
                        <div class='modal-header'>
                            <h5 class="modal-title"><label class='custom-label'>Revise Record {{quono}} item {{prep_rvsRecord.item}}</label></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class='modal-body' v-if='prep_rvsRecord != ""'>
                            <div class='container'>
                                <div class='row'>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Operation</h5></label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Source</h5></label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Cutting Type</h5></label>
                                    </div>
                                </div>
                                <div class='row mb-5'>
                                    <div class='col-md'>
                                        <select class='custom-select'  v-model='prep_rvsRecord.operation'>
                                            <option v-for='(operation,val) in operationList' v-bind:value='val'>{{operation}}</option>
                                        </select>
                                    </div>
                                    <div class='col-md'>
                                        <select class='custom-select'  v-model='prep_rvsRecord.source'>
                                            <option v-for='source in sourceList' v-bind:value='source'>{{source}}</option>
                                        </select>
                                    </div>
                                    <div class='col-md'>
                                        <select class='custom-select'  v-model='prep_rvsRecord.cuttingtype'>
                                            <option v-for='cuttingtype in cuttingtypeList' v-bind:value='cuttingtype'>{{cuttingtype}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Tolerance</h5></label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md text-center'>
                                        <label class='custom-label'>Thickness</label>
                                    </div>
                                    <div class='col-md text-center'>
                                        <label class='custom-label'>Width</label>
                                    </div>
                                    <div class='col-md text-center'>
                                        <label class='custom-label'>Length</label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>
                                                Plus(+)
                                            </div>
                                            <div class='col-md text-center'>
                                                Minus(-)
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>
                                                Plus(+)
                                            </div>
                                            <div class='col-md text-center'>
                                                Minus(-)
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>
                                                Plus(+)
                                            </div>
                                            <div class='col-md text-center'>
                                                Minus(-)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row mb-5'>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>
                                                <input class='form-control-sm' type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_thkp' />
                                            </div>
                                            <div class='col-md text-center'>
                                                <input class='form-control-sm' type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_thkm' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>                                                
                                                <input class='form-control-sm'  type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_wdtp' />
                                            </div>
                                            <div class='col-md text-center'>
                                                <input class='form-control-sm'  type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_wdtm' />
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md text-center'>
                                        <div class='row'>
                                            <div class='col-md text-center'>
                                                <input class='form-control-sm'  type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_lghp' />
                                            </div>
                                            <div class='col-md text-center'>
                                                <input class='form-control-sm'  type='number' step='0.10' placeholder="0.00" v-model='prep_rvsRecord.tol_lghm' />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Chamfer</h5></label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Flatness</h5></label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Billing</h5></label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md'>
                                        <select class='custom-select'  v-model='prep_rvsRecord.chamfer'>
                                            <option v-for='chamfer in chamferList' v-bind:value='chamfer'>{{chamfer}}</option>
                                        </select>
                                    </div>
                                    <div class='col-md'>
                                        <select class='custom-select'  v-model='prep_rvsRecord.flatness'>
                                            <option value="yes">YES</option>
                                            <option value="no">NO</option>
                                        </select>
                                    </div>
                                    <div class='col-md'>
                                        <select class='custom-select' v-model='prep_rvsRecord.status'>
                                            <option value="billing">YES</option>
                                            <option value="active" >NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md'>
                                        <label class='custom-label'><h5>Completion Date</h5></label>
                                    </div>
                                </div>
                                <div class='row mb-5'>
                                    <div class='col-md-4'>
                                        <div class='input-group'>
                                            <select @change='fetch_completion_date_rvs()' class='custom-select' v-bind:value='prep_rvsRecord.completion_date.substr(2,2) + prep_rvsRecord.completion_date.substr(5,2)' id='prep_rvsRecord_cd_period'>
                                                <template v-for="data in date_periodList">
                                                    <option v-bind:value="data" v-if="data == ol_period" selected>{{data}}</option>
                                                    <option v-bind:value="data" v-else-if="data >= ol_period">{{data}}</option>
                                                </template>
                                            </select>

                                            <select @change='fetch_completion_date_rvs()' class='custom-select' v-bind:value='prep_rvsRecord.completion_date.substr(8,2)' id='prep_rvsRecord_cd_day'>
                                                <template v-for="data in date_dayList">                                                                        
                                                    <option v-bind:value="data" >{{data}}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md text-left">
                                        <label class='custom-label' v-html='completion_date_rvs'>{{completion_date_rvs}}</label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <label class='custom-label'>Joblist Remarks</label>
                                    </div>
                                </div>
                                <div class='row mb-5'>
                                    <div class='col-md-6'>
                                        <input class='form-control' v-model='prep_rvsRecord.olremarks'/>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md'>
                                        <label class='custom-label'>Invoice Remarks</label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'>PO No.</label>
                                    </div>
                                    <div class='col-md'>
                                        <label class='custom-label'>Customer Tooling Code</label>
                                    </div>
                                </div>
                                <div class='row mb-5'>
                                    <div class='col-md'>
                                        <input class='form-control' v-model='prep_rvsRecord.ivremarks'/>
                                    </div>
                                    <div class='col-md'>
                                        <input class='form-control' v-model='prep_rvsRecord.ivpono'/>
                                    </div>
                                    <div class='col-md'>
                                        <input class='form-control' v-model='prep_rvsRecord.custoolcode'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-success' @click='submitPrepData()' data-dismiss="modal" >Confirm Edit</button>
                            <button type='button' class="btn btn-danger" data-dismiss="modal" >Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal area-->
            <div class="page-header" id="banner">
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
                                <td><label class="control-label" >{{orderlist_detail[0].date_issue}}</label></td>
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
                            <tr>
                                <td><label class="control-label" >Credit Limit</label></td>                                
                                <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                <td><label class="control-label" >{{customer_detail.credit_limit}}</label></td>
                            </tr>
                            <tr>
                                <td><label class="control-label" >AR Balance</label></td>                                
                                <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                <td><label class="control-label" >{{customer_detail.credit_used}}</label></td>
                            </tr>
                            <tr>
                                <td><label class="control-label" >Limit Balance</label></td>                                
                                <td><label class="control-label" >&nbsp;:&nbsp;</label></td>
                                <td v-if='limitBalance > 0'>
                                    <label class="control-label" >{{limitBalance}}</label>
                                </td>
                                <td v-else-if='limitBalance <= 0'>
                                    <label class="control-label" style='color:red'>{{limitBalance}}</label>
                                    &nbsp;
                                    <label class="control-label" style='color:red'>Balance is over Credit Limit!</label>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <br>
                    </div>
                </div>
                <div class='row'> <!-- Invoice Header Remarks -->
                    <div class="col-lg col-md col-sm">
                        <table>
                            <tr>
                                <td>
                                    <label class='control-label'></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class='row'>                    
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='row py-1 align-middle'>
                            <div class='col-md-5'>
                                <label class='control-label'>Invoice Header Remarks</label>
                            </div>
                            <div class='col-lg col-md col-sm'>: 
                                <select class='custom-select-sm' v-model='inv_header_remarks' id='inv_header_remarks'>
                                    <option value="0" selected>-----No Remarks-----</option>
                                    <option v-if='InvHeaderRemarks_status == "ok"' v-for="data in listInvHeaderRemarks" v-bind:value="data.ihrid">{{data.remarks}}</option>
                                    <option v-else-if='InvHeaderRemarks_status == "error"' disabled selected>{{listInvHeaderRemarks}}</option>
                                </select>
                            </div>
                        </div>
                        <div class='row py-1 align-middle'>
                            <div class='col-lg-5 col-md-5 col-sm-5'>
                            </div>
                            <div class='col-lg col-md col-sm'>
                            </div>
                        </div>
                        <div class='row py-1 align-middle'>
                            <div class='col-lg-5 col-md-5 col-sm-5'>
                                <label class='control-label'>Invoice Date</label>
                            </div>
                            <div class='col-lg col-md col-sm'> :
                                <select class='custom-select-sm' v-model="date_period">
                                    <option v-for="data in date_periodList" v-bind:value="data">{{data}}</option>
                                </select>
                                <select class='custom-select-sm' v-model="date_day">
                                    <option v-for="data in date_dayList" v-bind:value="data">{{data}}</option>
                                </select>
                                <label class='label-control' style='color:yellow'>{{invoiceDate.day}}-{{invoiceDate.month}}-{{invoiceDate.year}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 align-self-end">
                        <div class="row align-items-end">
                            <div class="col-lg col-md col-sm ">
                                <label class='label label-danger'><font style='color:red' v-if="rev_status == 'error'">{{submit_response}}</font></label>                        
                            </div>
                            <div class="col-lg col-md col-sm text-right">     
                                <button class='btn btn-sm btn-success' type='button' @click='reviseOrderlist();'>Submit Revise Orderlist</button>
                            </div>
                        </div>

                    </div>
                    <!--
                    <div class='col-lg-6 col-md-6 col-sm-6'>
                        <div class='row py-1 align-middle'>                            
                            <div class='col-lg-4 col-md-4 col-sm-4'>
                                <label class='control-label'>Orderlist Remarks</label>
                            </div>
                            <div class='col-lg col-md col-sm'>
                                <textarea class='form-control' v-model='ol_remarks' style='resize: none;min-width:100%'  rows='4'></textarea>
                            </div>
                        </div>
                    </div>
                    !-->
                </div>
                <div class="row">
                    <div class='col-md'>
                        <div class='container-fluid'>
                            <div class='row'>
                                <div class='col-md'>
                                    <table class="table table-borderless table-striped">
                                        <thead class="table table-primary " style='text-align:center;font-size:0.8em;'>
                                            <tr>
                                                <td rowspan="3" class='align-middle'>No</td>
                                                <td rowspan='3' class='align-middle'>Qty</td>
                                                <td rowspan="3" class='align-middle'>Material</td>
                                                <td rowspan='3' class='align-middle'>Raw Dimension Description</td>
                                                <td rowspan='3' class='align-middle'>Finishing Dimension Description</td>
                                                <td rowspan='3' class='align-middle'>Process</td>
                                                <td rowspan='3' class='align-middle'>Item No</td>
                                                <td colspan='4' class='align-middle' v-show='price_show'>Price
                                                    <a href='#' @click='price_show = false' >hide details</a>
                                                </td>
                                                <td rowspan='3' class='align-middle'>Total Amount Price<br>
                                                    <a href='#' @click='price_show = true; tolerance_show = false; detail_show = false' v-show='!price_show'>show details</a>
                                                </td>                                                            
                                                <td rowspan='3' class='align-middle'>Operation</td>
                                                <td rowspan='3' class='align-middle'>Source</td>
                                                <td rowspan='3' class='align-middle'>Cutting Type</td>
                                                <td colspan='6' class='align-middle' v-show="tolerance_show">
                                                    <input class='form-check-label' type="checkbox" v-model="tolerance_show" />Tolerance           
                                                </td>
                                                <td rowspan='3' class='align-middle' v-show="!tolerance_show">Tolerance
                                                    <input class='form-check-label' type="checkbox" v-model="tolerance_show"/>
                                                </td>
                                                <td colspan='8' v-show='detail_show'>
                                                    Details <a href='#' @click='detail_show = false'>hide details</a>
                                                </td>
                                                <td colspan='1' rowspan='3' v-show='!detail_show'>
                                                    Details<br>
                                                    <a href='#' @click='detail_show = true;price_show = false;tolerance_show = false'>show details</a>
                                                </td>
                                                <td rowspan='3' class='align-middle' style='width:1%'>Cancel Order</td>
                                                <td rowspan='3' class='align-middle' style='width:1%'>Action</td>
                                            </tr>
                                            <tr>
                                                <td rowspan='2' v-show="price_show">Mat     </td>
                                                <td rowspan='2' v-show="price_show">P.Mach  </td>
                                                <td rowspan='2' v-show="price_show">CNC Mach</td>
                                                <td rowspan='2' v-show="price_show">Other   </td>
                                                <td colspan='2' class='px-0 mx-0' style="width:40px" v-show="tolerance_show">Thickness</td>
                                                <td colspan='2' class='px-0 mx-0' style="width:40px" v-show="tolerance_show">Width</td>
                                                <td colspan='2' class='px-0 mx-0' style="width:40px" v-show="tolerance_show">Length</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Chamfer</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Flatness</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Billing</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Joblist Remarks</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Completion Date</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Invoice Remarks</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">PO No.</td>
                                                <td rowspan='2' class='align-middle' v-show="detail_show">Customer Tool Code</td>
                                            </tr>
                                            <tr v-show="tolerance_show">
                                                <td colspan='' class='px-0 mx-0' style="width:40px">+</td>
                                                <td colspan='' class='px-0 mx-0' style="width:40px">-</td>
                                                <td colspan='' class='px-0 mx-0' style="width:40px">+</td>
                                                <td colspan='' class='px-0 mx-0' style="width:40px">-</td>
                                                <td colspan='' class='px-0 mx-0' style="width:40px">+</td>
                                                <td colspan='' class='px-0 mx-0' style="width:40px">-</td>
                                            </tr>
                                        </thead>
                                        <tbody style='text-align:center;font-size:0.8em'>
                                        <template v-for='(itemData,index) in orderlist_detail'>

                                            <tr v-bind:style="{backgroundColor : cancelColor(ol_status_array[index].cancelled)}" >
                                                <td>{{index+1}}</td>
                                                <!-- quotation dataset -->
                                                <td>{{itemData.quantity}}</td>
                                                <td>{{itemData.materialname}}</td>
                                                <td v-html="reviseDimensionDescDisplay(itemData.dim_desp)">{{reviseDimensionDescDisplay(itemData.dim_desp)}}</td>
                                                <td  v-html="reviseDimensionDescDisplay(itemData.finishing_dim_desp)">{{reviseDimensionDescDisplay(itemData.finishing_dim_desp)}}</td>
                                                <td>{{itemData.processname}}</td>
                                                <td>{{itemData.item}}</td>
                                                <td v-show="price_show">{{itemData.totalamountmat}}</td>
                                                <td v-show="price_show">{{itemData.totalamountpmach}}</td>
                                                <td v-show="price_show">{{itemData.totalamountcncmach}}</td>
                                                <td v-show="price_show">{{itemData.totalamountother}}</td>
                                                <td>{{itemData.totalamount}}</td>
                                                <!-- Operation -->
                                                <td>{{itemData.operationname}}</td>
                                                <!-- Source -->
                                                <td>{{itemData.source}}</td>
                                                <!-- cutting type -->                                                
                                                <td>{{itemData.cuttingtype}}</td>
                                                <!--tolerance-->
                                                <td class='px-0 mx-0' v-show="!tolerance_show">

                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_thkp}}</label>
                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_thkm}}</label>
                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_wdtp}}</label>
                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_wdtm}}</label>
                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_lghp}}</label>
                                                </td>
                                                <td class='px-0 mx-0' v-show="tolerance_show">
                                                    <label class='custom-label'>{{itemData.tol_lghm}}</label>
                                                </td>
                                                <td v-show='!detail_show'>

                                                </td>
                                                <!-- Chamfer -->
                                                <td v-show='detail_show'>{{itemData.chamfer}}</td>
                                                <!-- Flatness -->
                                                <td v-show='detail_show'>{{itemData.flatness}}</td>
                                                <!-- Billing -->
                                                <td v-show='detail_show' v-if='itemData.status != "billing"'>NO</td>
                                                <td v-show='detail_show' v-else>YES</td>
                                                <!-- jlremarks -->
                                                <td v-show='detail_show'>{{itemData.olremarks}}</td>
                                                <!-- completiondate -->
                                                <td v-show='detail_show'>{{itemData.completion_date}}</td>
                                                <!-- invoice remarks -->
                                                <td v-show='detail_show'>{{itemData.ivremarks}}</td>
                                                <!-- PO No. -->
                                                <td v-show='detail_show'>{{itemData.ivpono}}</td>
                                                <!-- Customer Tool Code -->
                                                <td v-show='detail_show'>{{itemData.custoolcode}}</td>
                                                <!-- Issue Checkbox -->
                                                <td class="text-center">
                                                    <input class='form-check-label' v-bind:ref='"checkbox"' type='checkbox' v-bind:value='index' v-model='ol_status_array[index].cancelled'/>
                                                </td>
                                                <td class="text-center">
                                                    <button v-if="ol_status_array[index].cancelled" class='btn btn-sm btn-warning disabled' disabled type='button' @click='prepareReviseRecord(itemData,index)'>Edit</button>
                                                    <button v-else class='btn btn-sm btn-warning' type='button' @click='prepareReviseRecord(itemData,index)'>Edit</button>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr>    
                                            <td v-bind:colspan="ttl_colspan" style='text-align:right'>Subtotal (Ex GST) :</td>
                                            <td>{{subtotal_ExGST}}</td>
                                        <template v-if="limitBalance <= 0">
                                            <td colspan='2' class="text-right"><label style='color:red'>Limit Balance :</label></td>
                                            <td colspan='1' class="text-right"><label style='color:red'>{{limitBalance}}</label></td>
                                        </template>
                                        <template v-else-if="limitBalance > 0">
                                            <td colspan='2' class="text-right">Limit Balance :</td>
                                            <td colspan='1' class="text-right">{{limitBalance}}</td>
                                        </template>
                                        </tr>
                                        <tr>    
                                            <td v-bind:colspan="ttl_colspan" style='text-align:right'>Total Discount :</td>
                                            <td>{{totaldiscount}}</td>
                                            <td colspan='2' class="text-right">Total Transaction :</td>                                                        
                                            <td colspan='1' class="text-right">{{GrandTotal}}</td>

                                        </tr>
                                        <tr>    
                                            <td v-bind:colspan="ttl_colspan" style='text-align:right'>Total (Ex GST) :</td>
                                            <td>{{total_ExGST}}</td>                                                   
                                        <template v-if="remBalance <= 0">
                                            <td colspan='2' class="text-right"><label style="color:red">Remaining Balance :</label></td>                                                        
                                            <td colspan='1' class="text-right"><label style="color:red">{{remBalance}}</label></td>
                                        </template>
                                        <template v-if="remBalance > 0">
                                            <td colspan='2' class="text-right">Remaining Balance :</td>                                                        
                                            <td colspan='1' class="text-right">{{remBalance}}</td>
                                        </template>
                                        </tr>
                                        <tr>    
                                            <td v-bind:colspan="ttl_colspan" style='text-align:right'>GST Amount :</td>
                                            <td>{{gstamount}}</td>
                                            <td colspan='3'></td>
                                        </tr>
                                        <tr>    
                                            <th v-bind:colspan="ttl_colspan" style='text-align:right'>Grand Total :</th>
                                            <th>{{GrandTotal}}</th>
                                            <td colspan='3'></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <div class="sponsor">
                          <!-- <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom" id="_carbonads_js"></script> -->
                        </div>
                        <div id='init_objects'>
                            <input type='hidden' ref='quono' id='quono' name='quono' value='<?php echo $quono; ?>' /><br>
                            <input type='hidden' ref='cid'  id='cid' name='cid' value='<?php echo $cid; ?>' /><br>
                            <input type='hidden' ref='period' id='period' name='period' value='<?php echo $period; ?>' /><br>
                            <input type='hidden' ref='com' id='com' name='com' value='<?php echo $com; ?>' /><br>
                            <input type='hidden' ref='aid' id='aid' name='aid' value='<?php echo $aid; ?>' /><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script type="text/javascript" src='./session/session_js.js'></script>
        <script>
var iolrvsVue = new Vue({
    el: '#mainArea',
    data: {
        phpajaxresponsefile: './orderlist/backend/orderlist.axios.php',
        quono: '',
        cid: '',
        period: '',
        company: '',
        aid: '',
        runno: '',

        customer_status: '',
        customer_detail: '',
        customer_msg: '',
        ol_status_array: [],

        date_periodList: '',
        date_period: '',
        oldate_period: '',
        date_dayList: '',
        date_day: '',
        oldate_day: '',
        invoiceDate: [
            {
                day: null,
                month: null,
                year: null
            }
        ],
        olDate: [
            {
                day: null,
                month: null,
                year: null
            }
        ],

        orderlist_detail: '',
        orderlist_status: '',
        listInvHeaderRemarks: '',
        inv_header_remarks: '',

        prep_rvsRecord: '',
        index_rvsRecord: '',
        completion_date_rvs: '',
        sales_attn: '',
        tolerance_show: false,
        price_show: false,
        detail_show: false,
        rev_response: '',
        rev_status: '',

        sourceList: [
            '',
            'PMT',
            'PHH',
            'PST',
            'PTPHH',
            'CUSTOMER',
            'SUPPLIER',
        ],
        chamferList: [
            '0.0',
            '1.0',
            '1.5',
            '2.0',
            '2.5',
            '3.0'
        ],
        operationList: {
            '1': 'CJ',
            '2': 'PU',
            '4': 'CJ-PU'
        },
        cuttingtypeList: [
            'BANDSAW CUT',
            'MANUAL CUT',
            'CNC FLAME CUT'
        ]
    },
    watch: {
        customer_status: function (val) {
            if (val == 'ok') {
                this.getOrderlistRecordRvs();
            }
        },
        orderlist_detail: function () {
            this.inv_header_remarks = this.orderlist_detail[0].ihremarks;
        },

        date_period: function (val) {
            Y = '20' + val.substr(0, 2);
            m = val.substr(-2);
            this.invoiceDate.month = m;
            this.invoiceDate.year = Y;
            this.date_dayList = new Date(Y, m, 0).getDate();
        },
        date_day: function (val) {
            d = ('00' + val).slice(-2);
            this.invoiceDate.day = d;
        },
        oldate_period: function (val) {
            Y = '20' + val.substr(0, 2);
            m = val.substr(-2);
            this.olDate.month = m;
            this.olDate.year = Y;
        },
        oldate_day: function (val) {
            d = ('00' + val).slice(-2);
            this.olDate.day = d;
        }

    },
    computed: {
        ttl_colspan: function () {
            if (this.price_show) {
                return 11;
            } else {
                return 7;
            }
        },
        xt_colspan: function () {
            price_show = this.price_show;
            tolerance_show = this.tolerance_show;
            cs = 11;
            if (price_show) {
                cs += 4;
            }
            if (tolerance_show) {
                cs += 6;
            }
            return cs;
        },
        ol_period: function () {
            let per = String(this.olDate.year).substr(-2) + String(this.olDate.month);
            return per;
        },
        ol_date_day: function () {
            let day = this.olDate.day;
            //console.log('day = ' + day);
            return day;
        },

        today_date_dmy: function () {
            let dateObj = new Date();
            d = dateObj.getDate();
            m = dateObj.getMonth() + 1;
            Y = dateObj.getFullYear();
            return d + '-' + m + '-' + Y;
        },
        today_date_ymd: function () {
            let dateObj = new Date();
            d = dateObj.getDate();
            m = dateObj.getMonth() + 1;
            Y = dateObj.getFullYear();
            return Y + '-' + m + '-' + d;
        },
        limitBalance: function () {
            crLimit = this.customer_detail.credit_limit;
            crUsed = this.customer_detail.credit_used;
            //crUsed = 500000
            if (crUsed == null || crUsed == 0) {
                bal = parseFloat(crLimit);
            } else {
                bal = parseFloat(crLimit) - parseFloat(crUsed);
            }
            return bal.toFixed(2);
        },
        remBalance: function () {
            let bal = this.limitBalance;
            let pym = this.GrandTotal;
            let rem = parseFloat(bal) - parseFloat(pym);
            return rem.toFixed(2);
        },
        subtotal_ExGST: function () {
            sum = 0;
            for (key in this.orderlist_detail) {
                if (!this.ol_status_array[key].cancelled) {
                    sum += (parseFloat(this.orderlist_detail[key].amountmat) + parseFloat(this.orderlist_detail[key].amountpmach) + parseFloat(this.orderlist_detail[key].amountcncmach) + parseFloat(this.orderlist_detail[key].amountother));
                }
            }
            return sum.toFixed(2);
        },
        totaldiscount: function () {
            sum = 0;
            for (key in this.orderlist_detail) {
                if (!this.ol_status_array[key].cancelled) {
                    sum += (parseFloat(this.orderlist_detail[key].discountmat) + parseFloat(this.orderlist_detail[key].discountpmach) + parseFloat(this.orderlist_detail[key].discountcncmach) + parseFloat(this.orderlist_detail[key].discountother));
                }
            }
            return sum.toFixed(2);
        },
        total_ExGST: function () {
            sum = parseFloat(this.subtotal_ExGST) - parseFloat(this.totaldiscount);
            return sum.toFixed(2);
        },
        gstamount: function () {
            sum = 0;
            for (key in this.orderlist_detail) {
                if (!this.ol_status_array[key].cancelled) {
                    sum += (parseFloat(this.orderlist_detail[key].gstmat) + parseFloat(this.orderlist_detail[key].gstpmach) + parseFloat(this.orderlist_detail[key].gstcncmach) + parseFloat(this.orderlist_detail[key].gstother));
                }
            }
            return sum.toFixed(2);
        },
        GrandTotal: function () {
            sum = 0;
            console.log('grandtotal');
            for (key in this.orderlist_detail) {
                if (!this.ol_status_array[key].cancelled) {
                    sum += parseFloat(this.orderlist_detail[key].totalamount);
                }
            }
            return sum.toFixed(2);
        }
    },
    methods: {
        cancelColor: function (cancelled) {
            if (cancelled) {
                return "#b34b44";
            } else {
                return null;
            }
        },
        fetch_completion_date_rvs: function () {
            if (this.prep_rvsRecord != '') {
                cd_period = document.getElementById('prep_rvsRecord_cd_period').value;
                cd_day = ('00' + document.getElementById('prep_rvsRecord_cd_day').value).slice(-2);

                cd_Year = '20' + cd_period.substr(0, 2);
                cd_month = cd_period.substr(2, 2);

                olDate = new Date(this.olDate.year + '-' + this.olDate.month + '-' + this.olDate.day);
                cdDate = new Date(cd_Year + '-' + cd_month + '-' + cd_day);
                if (cdDate < olDate) {
                    this.completion_date_rvs = '<font style="color:red">Completion Date Cannot Be Less Than Orderlist Issue Date (' + this.olDate.year + '-' + this.olDate.month + '-' + this.olDate.day + ')</font>';
                } else {
                    this.prep_rvsRecord.completion_date = cd_Year + '-' + cd_month + '-' + cd_day;
                    this.completion_date_rvs = '<font style="color:yellow">' + cd_Year + '-' + cd_month + '-' + cd_day + '</font>';
                }
            }
        },
        prepareReviseRecord: function (data, index) {
            this.prep_rvsRecord = data;
            this.index_rvsRecord = index;
            this.$refs['reviseModalPopUp'].click();
        },
        submitPrepData: function () {
            let prepData = this.prep_rvsRecord;
            let prepIndex = this.index_rvsRecord;
            this.orderlist_detail[prepIndex] = JSON.parse(JSON.stringify(prepData));
            this.prep_rvsRecord = '';
            this.index_rvsRecord = '';

        },
        getCustomerDetails: function () {
            checkSession();
            axios.post(this.phpajaxresponsefile, {
                action: 'getCustomerDetails',
                cid: this.cid,
                com: this.company
            }).then(function (response) {
                console.log('on getCustomerDetails');
                console.log(response.data);
                iolrvsVue.customer_status = response.data.status;
                if (response.data.status == 'ok') {
                    iolrvsVue.customer_detail = response.data.detail;
                } else {
                    iolrvsVue.customer_msg = response.data.msg;
                }
                return response.data.status;
            }).then(function (status) {
                //console.log("status = " + status);
                if (status == 'ok') {
                    cc_salesman = iolrvsVue.customer_detail['aid_cus'];
                    axios.post(iolrvsVue.phpajaxresponsefile, {
                        action: 'getSalesman',
                        aid_cus: cc_salesman

                    }).then(function (response) {
                        if (response.data.status == 'ok') {
                            sales_attn = response.data.name;
                        } else {
                            sales_attn = '<font style="color:red">' + response.data.msg + '</font>';
                        }
                        iolrvsVue.sales_attn = sales_attn;
                    });
                }
            });

        },
        getOrderlistRecordRvs: function () {
            checkSession();
            axios.post(this.phpajaxresponsefile, {
                action: 'getOrderlistRecordRvs',
                period: this.period,
                cid: this.cid,
                quono: this.quono,
                com: this.company
            }).then(function (response) {
                console.log('on getOrderlistRecordRvs');
                console.log(response.data);
                iolrvsVue.orderlist_status = response.data.status;
                if (response.data.status == 'ok') {
                    iolrvsVue.orderlist_detail = response.data.detail;
                    iolrvsVue.runno = response.data.detail[0].runningno;
                    return response.data;
                } else {
                    return null;
                }
            }).then(function (data) {
                if (data !== null) {
                    console.log(data);
                    len = data.detail.length;
                    iolrvsVue.getInvoiceDate(data.detail[0].ivdate);
                    iolrvsVue.getOLDate(data.detail[0].date_issue);
                    datarr = [];
                    for (i = 0; i < len; i++) {
                        if (data.detail[i].status == 'cancelled') {
                            ccl = true;
                        } else {
                            ccl = false;
                        }
                        objin = {oid: data.detail[i].oid, cancelled: ccl};
                        datarr[i] = objin;
                    }
                    iolrvsVue.ol_status_array = datarr;
                }
            });

        },
        reviseDimensionDescDisplay: function (data) {
            let rs = data.replace(/x/g, "<br>")
            return rs;
        },

        getInvHeaderRemarks: function () {
            checkSession();
            axios.post(this.phpajaxresponsefile, {
                action: 'getInvHeaderRemarks'
            }).then(function (response) {
                console.log('on getInvHeaderRemarks...');
                console.log(response.data);
                iolrvsVue.InvHeaderRemarks_status = response.data.status;
                if (response.data.status == 'ok') {
                    iolrvsVue.listInvHeaderRemarks = response.data.detail;
                } else {
                    iolrvsVue.listInvHeaderRemarks = response.data.msg;
                }
            });

        },
        getPeriod: function () {
            checkSession();
            axios.post(this.phpajaxresponsefile, {
                action: 'getPeriod'
            }).then(function (response) {
                iolrvsVue.date_periodList = response.data;
            });

        },
        getInvoiceDate: function (date) {
            console.log('on getInvoiceDate');
            let dtObj = new Date(date);
            let d = dtObj.getDate();
            let m = dtObj.getMonth() + 1;
            let Y = dtObj.getFullYear();
            per = String(Y).substr(-2) + ('00' + m).slice(-2);
            console.log(per);
            this.date_period = per;
            this.date_day = ('00' + d).slice(-2);
        },
        getOLDate: function (date) {
            console.log('on getOLDate');
            let dtObj = new Date(date);
            let d = dtObj.getDate();
            let m = dtObj.getMonth() + 1;
            let Y = dtObj.getFullYear();
            per = String(Y).substr(-2) + ('00' + m).slice(-2);
            console.log(per);
            this.oldate_period = per;
            this.oldate_day = ('00' + d).slice(-2);
        },
        reviseOrderlist: function () {
            checkSession();
            let arrItemList = this.orderlist_detail;
            let ol_status_arr = this.ol_status_array;
            let period = this.period;
            let quono = this.quono;
            let cid = this.cid;
            let com = this.company;
            let InvHeaderRemarks = this.inv_header_remarks;
            let invDate = this.invoiceDate.year + '-' + this.invoiceDate.month + '-' + this.invoiceDate.day;
            axios.post(this.phpajaxresponsefile, {
                action: 'reviseOL_Desc',
                arrItemList: arrItemList,
                ol_status_arr: ol_status_arr,
                period: period,
                quono: quono,
                cid: cid,
                com: com,
                InvHeaderRemarks: InvHeaderRemarks,
                invDate: invDate
            }).then(function (response) {
                console.log("on reviseOL_Desc");
                console.log(response.data);
                if (response.data.status == 'ok') {
                    window.alert("Revise Successful for [" + iolrvsVue.quono + "]");
                    window.close();
                } else {
                    window.alert(response.data.msg);
                }
            })



        }
    },
    beforeMount: function () {
        this.quono = document.getElementById('quono').value;
        this.cid = document.getElementById('cid').value;
        this.period = document.getElementById('period').value;
        this.company = document.getElementById('com').value;
        this.aid = document.getElementById('aid').value;

    },
    mounted: function () {
        this.getCustomerDetails();
        this.getInvHeaderRemarks();
        this.getPeriod();
    }
})

        </script>
    </body>
</html>