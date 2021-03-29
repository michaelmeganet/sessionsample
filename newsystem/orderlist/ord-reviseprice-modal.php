<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" v-bind:class="mainactive"   id="nav-main-tab" data-toggle="tab" href="#nav-main"   role="tab" aria-controls="nav-main"   v-bind:aria-selected="maintrue">Main</a>
        <a class="nav-item nav-link" v-bind:class="finalactive"  id="nav-final-tab"  data-toggle="tab" href="#nav-final" role="tab" aria-controls="nav-final" v-bind:aria-selected="finaltrue">All Total</a>
    </div>
</nav>

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
    <div class="tab-pane fade show" v-bind:class="mainactive" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab" v-bind:style="{backgroundColor:divBackColor}">
        <!-- Select Customer Type ~ Step1 -->
        <div class="form-group row">
            <div class="col-md-4">
                <label class='control-label'>Customer Type:</label>
                <div class='input-group' v-if="custype == ''">
                    <select class='custom-select' name='custype' id='custype' v-model="custype" onchange="showStep2()">
                        <option value='#' selected disabled>Please select one...</option>
                        <option value='local'>Local</option>
                        <option value='outstation'>Outstation</option>
                        <option value='melaka'>Melaka</option>
                    </select>
                </div>
                <div class='input-group' v-else >
                    <input class="form-control" v-model='custype' readonly />
                </div>
            </div>
            <div class="col-md-4 align-items-center align-bottom">
            </div>
            <div class="col-md-4 align-items-center align-bottom">
                <input type="checkbox" class="checkbox" v-model="freepage" v-if="mainShapeOrder == 'TRADE'" disabled/>
                <input type="checkbox" class="checkbox" v-model="freepage" v-else/>
                <label class="custom-label" >Free Page Mode</label>
            </div>
            <hr/>
        </div>
        <!-- Input Quantity, Shape Order, and Material ~ Step2 -->
        <div class="row">
            <div class="col-md-4">
                <label class="control-label">Quantity</label>
                <input type='integer' v-model='quantity' class='form-control' id='quantity' name='quantity' value='1' placeholder='Quantity' required />
            </div>
            <div class="col-md-4">
                <label class="control-label">Special Shape Order</label>
                <select v-model="specialShapeOrder" class='custom-select' name='specialShapeOrder' id='specialShapeOrder' @change='getMaterial()' onchange>
                    <option value='' disabled>Please select one...</option>
                    <option value='NORMAL' v-if="mainShapeOrder !== 'TRADE'">Normal Shape</option>
                    <option value='PLATEC' v-if="mainShapeOrder !== 'TRADE'">Circular Plate Shape</option>
                    <option value='PLATECO' v-if='mainShapeOrder !== "TRADE"'>Ring Plate Shape</option>
                    <option value='TRADE' v-if='mainShapeOrder === "TRADE"'>Trade</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class='control-label'>Material :</label>
                <select class='custom-select' name ='mat' id='mat' v-model='mat' style='color: black' @change='getMainDetail();getThickList()' onchange="showStep3()">
                    <option v-for='data in materialList' v-bind:value='data.materialcode'>{{data.material}}</option>
                </select>
                Matcode = {{mat}}<br>
                category = {{category}}<br>
                Shape_Code = {{ShapeCode}}<br>
                tabletype = {{tabletype}}<br>
            </div>
        </div>
        <span>&nbsp;</span>
        <!-- Input Dimensions ~ Step3 -->
        <div class="form-group">
            <?php include 'calculation/dimension-div.php'; ?>
            <div class="row">
                <div class="col-md-4 align-middle">
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class='col-md-9'>
                            <label class="control-label">Discount (RM)</label>
                            <input class="form-control" v-model='discountmat' name='discountmat' value='' id="discountmat"/>
                        </div>
                        <div class="col-md">
                            <label class="control-label">GST(%)</label>
                            <input class="form-control" v-model='gstmatpct' name='gstmatpct' value='' id='gstmatpct'/>                        
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Subtotal Price</label>
                    <input class="form-control" v-model='subtotalmat' name="subtotalmat" value='' id='subtotalmat' />
                </div>
            </div>
        </div>
        <span>&nbsp;</span>
        <!-- Premach Calculation ~ Step4 -->
        <div class="form-group">
            <div class='row'>
                <div class="col-md-4">
                    <h4>Pre-Machining </h4>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>Process Code   (<span v-if='ShapeCode !== "PLATEN"' Style="color:red">  No Pmach for this material</span>)</label>
                    <select v-model='pmid' name='pmid' id='pmid' class="custom-select" @change='getPmachPrice()'>
                        <option v-for='option in pmachList' v-bind:value='option.pmid'>{{option.process}}</option>
                    </select>
                    <label class="control-label">Tolerance</label>
                    <span v-if='tolerance'>
                        <select v-model='tol' name='tol' id='tol' class='custom-select'>
                            <option value='' selected disabled>Please Select Tolerance</option>
                            <option value='0.02'>&PlusMinus;0.02 mm</option>
                            <option value='0.10'>&PlusMinus;0.10 mm</option>
                        </select>
                    </span>
                    <span v-else>
                        <select v-model='tol' name='tol' id='tol' class='custom-select'>
                            <option value='0' selected>No Tolerance Needed</option>
                        </select>
                    </span>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Pre-Machining Price</label>
                    <input class="form-control" v-model='pmachprice' name='pmachprice' id='pmachprice' value='' v-bind:readonly="!freepage"/>
                    <div class="row">
                        <div class='col-md-9'>
                            <label class="control-label">Discount (RM)</label>
                            <input class="form-control" v-model='discountpmach' name='discountpmach' value='' id="discountpmach"/>
                        </div>
                        <div class="col-md">
                            <label class="control-label">GST(%)</label>
                            <input class="form-control" v-model='gstpmachpct' name='gstpmachpct' value='' id='gstmachpct' disabled/>                        
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <label class="control-label">Total Pre-Machining Price</label>
                    <input class='form-control' v-model='totalpmachprice' name="totalpmachprice" id='totalpmachprice' v-bind:readonly="!freepage"/>
                    <label class="control-label">SubTotal Pre-Machining Price</label>
                    <input class='form-control' v-model='subtotalpmachprice' name="subtotalpmachprice" id='subtotalpmachprice' readonly/>
                </div>
            </div>
            <span>&nbsp;</span>
            <div class='row'>
                <div class="col-md-4">
                    <h4>CNC</h4>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>CNC Price</label>
                    <input v-model='cncprice' name='cncprice' id='cncprice' class="form-control" />
                </div>
                <div class="col-md-4">
                    <div class='row'>
                        <div class='col-md-9'>
                            <label class="control-label">Discount (RM)</label>
                            <input class="form-control" v-model='discountcnc' name='discountcnc' value='' id="discountcnc"/>
                        </div>
                        <div class="col-md">
                            <label class="control-label">GST(%)</label>
                            <input class="form-control" v-model='gstcncpct' name='gstcncpct' value='' id='gstcncpct' disabled/>                        
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <label class="control-label">Total CNC Price</label>
                    <input class='form-control' v-model='totalcncprice' name="totalcncprice" id='totalcncprice' v-bind:readonly="!freepage"/>
                    <label class="control-label">SubTotal CNC Price</label>
                    <input class='form-control' v-model='subtotalcncprice' name="subtotalcncprice" id='subtotalcncprice' readonly/>
                </div>
            </div>
            <span>&nbsp;</span>
            <div class='row'>
                <div class="col-md-4">
                    <h4>Other Charges</h4>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>Other Price</label>
                    <input v-model='otherprice' name='otherprice' id='otherprice' class="form-control" />
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class='col-md-9'>
                            <label class="control-label">Discount (RM)</label>
                            <input class="form-control" v-model='discountother' name='discountother' value='' id="discountother"/>
                        </div>
                        <div class="col-md">
                            <label class="control-label">GST(%)</label>
                            <input class="form-control" v-model='gstotherpct' name='gstotherpct' value='' id='gstotherpct' disabled/>                        
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <label class="control-label">Total Other Price</label>
                    <input class='form-control' v-model='totalotherprice' name="totalotherprice" id='totalotherprice' v-bind:readonly="!freepage"/>
                    <label class="control-label">SubTotal Other Price</label>
                    <input class='form-control' v-model='subtotalotherprice' name="subtotalotherprice" id='subtotalotherprice' readonly/>
                </div>
            </div>            
            <span>&nbsp;</span>
            <div class="row">
                <div class="col-md">
                    <button class="btn btn-info btn-block" type='' onclick="reCalculateAllPrices()" @click="">Recalculate All Prices</button>
                </div>
            </div>
            <span>&nbsp;</span>
            <div class="row">
                <div class="col-md">
                    <button class="btn btn-primary btn-block" v-bind:style='{display: btnDisplay}' type='' onclick=" setDiscountGST()" @click="parseDimension()">Set Discount and GST Prices</button>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show" v-bind:class="finalactive" id="nav-final" role="tabpanel" aria-labelledby="nav-final-tab">
        <!-- Final results ~ Step 5-->
        <div class="form-group">
            <div class='row'>
                <div class="col-md-4">
                    <label class="control-label">Material Code</label>
                    <input class="form-control" type="text" v-model='mat' readonly />
                </div>
                <div class="col-md-4">
                    <label class="control-label">Material Name</label>
                    <input class="form-control" type="text" v-model='materialname' readonly />
                </div>
            </div>
            <span>&nbsp;</span>
            <div class='row'>
                <div class="col-md-4">
                    <label class="control-label">Quantity</label>
                    <input class="form-control" type="text" v-model='quantity' readonly />
                </div>
            </div>
            <span>&nbsp;</span>
            <div class='row'>
                <div class="col-md-4"  v-if="specialShapeOrder !== 'TRADE'">
                    <h4>Dimension</h4>
                    <div class="row no-gutters">
                        <div class="col-md">
                            <label class="control-label"> T</label>
                            <input class="form-control" type="text" v-model='mdt' readonly />
                        </div>
                        <div class="col-md">
                            <label class="control-label"> W</label>
                            <input class="form-control" type="text" v-model='mdw' readonly />
                        </div>
                        <div class="col-md">
                            <label class="control-label"> L</label>
                            <input class="form-control" type="text" v-model='mdl' readonly />
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class='col-md'>
                            <label class ='control-label'>Detail :</label>
                            <input class ='form-control' type="text" v-model='dim_desc' readonly />
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-if="specialShapeOrder !== 'TRADE'">
                    <h4>Finishing Dimension</h4>
                    <div class="row no-gutters">
                        <div class="col-md ">
                            <label class="control-label"> T</label>
                            <input class="form-control" type="text" v-model='fdt' readonly />
                        </div>
                        <div class="col-md">
                            <label class="control-label"> W</label>
                            <input class="form-control" type="text" v-model='fdw' readonly />
                        </div>
                        <div class="col-md">
                            <label class="control-label"> L</label>
                            <input class="form-control" type="text" v-model='fdl' readonly />
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md">
                            <label class ='control-label'>Detail :</label>
                            <input class ='form-control' type="text" v-model='finishing_dim_desc' readonly />
                        </div>
                    </div>
                </div>
                <div v-else class="col-md-8">
                    <h4>Description</h4>
                    <div class="row no-gutters">
                        <div class='col-md'>
                            <label class ='control-label'>Order Description :</label>
                            <textarea rows='4' style="resize:none" class ='form-control' type="text" v-model='dim_desc' readonly></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h4>Weight and Price</h4>
                    <div class="row no-gutters">
                        <div class='col-md'>
                            <label class="control-label">Unit Weight</label>
                            <input class="form-control" v-model='weight' readonly />
                            <label class="control-label">Total Weight</label>
                            <input class='form-control' v-model='totalweight' readonly />  
                        </div>
                    </div>
                </div>
            </div>
            <span>&nbsp;</span>
            <div class="row">
                <div class="col-md">
                    <h4>Amount of Material</h4>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-4'>
                    <label class='control-label'>Unit Price</label>
                    <input class="form-control" v-model="pricePerPCS" readonly />
                    <label class='control-label'>Total Price</label>
                    <input class='form-control' v-model='totalprice' readonly />
                </div>
                <div class="col-md-4">
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Discount</label>
                            <input class='form-control' v-model='discountmat' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>GST(%)</label>
                            <input class='form-control' v-model='gstmatpct' readonly disabled/>
                        </div>
                        <div class="col-md-9">
                            <label class='control-label'>GST Amount</label>
                            <input class='form-control' v-model='gstmat' readonly disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Total Discount</label>
                            <input class='form-control' v-model='totaldiscountmat' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Total GST Amount</label>
                            <input class='form-control' v-model='totalgstmat' readonly disabled/>
                        </div>
                    </div>
                    <label class="control-label">Subtotal Mat</label>
                    <input class='form-control' v-model='subtotalmat' readonly />
                </div>
            </div>
            <span>&nbsp;</span>
            <div class="row">
                <div class='col-md'>
                    <h4>Amount of Pre-Machining</h4>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-4'>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>PMID</label>
                            <input class='form-control' v-model='pmid' readonly />
                        </div>
                        <div class="col-md-9">
                            <label class='control-label'>Process Code</label>
                            <input class='form-control' v-model='processcode' readonly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>Pre-Machining Price</label>
                    <input class="form-control" v-model='pmachprice' readonly/>
                    <label class='control-label'>Total Pre-Machining Price</label>
                    <input class="form-control" v-model='totalpmachprice' readonly/>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Discount Pre-Machining</label>
                            <input class='form-control' v-model='discountpmach' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>GST(%)</label>
                            <input class='form-control' v-model='gstpmachpct' readonly disabled/>
                        </div>
                        <div class="col-md-9">
                            <label class='control-label'>GST Amount</label>
                            <input class='form-control' v-model='gstpmach' readonly disabled/>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Total Discount Pre-Machining</label>
                            <input class='form-control' v-model='totaldiscountpmach' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Total GST Amount</label>
                            <input class='form-control' v-model='totalgstpmach' readonly disabled/>
                        </div>
                    </div>
                    <label class="control-label">Subtotal Pre-Machining</label>
                    <input class='form-control' v-model='subtotalpmachprice' readonly />
                </div>
            </div>
            <span>&nbsp;</span>

            <div class="row">
                <div class='col-md'>
                    <h4>Amount of CNC</h4>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>CNC Price</label>
                    <input class="form-control" v-model='cncprice' readonly/>
                    <label class='control-label'>Total CNC Price</label>
                    <input class="form-control" v-model='totalcncprice' readonly/>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Discount CNC</label>
                            <input class='form-control' v-model='discountcnc' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>GST(%)</label>
                            <input class='form-control' v-model='gstcncpct' readonly disabled/>
                        </div>
                        <div class="col-md-9">
                            <label class='control-label'>GST Amount</label>
                            <input class='form-control' v-model='gstcnc' readonly disabled/>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Total Discount CNC</label>
                            <input class='form-control' v-model='totaldiscountcnc' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Total GST Amount</label>
                            <input class='form-control' v-model='totalgstcnc' readonly disabled/>
                        </div>
                    </div>
                    <label class="control-label">Subtotal CNC</label>
                    <input class='form-control' v-model='subtotalcncprice' readonly />
                </div>
            </div>
            <span>&nbsp;</span>

            <div class="row">
                <div class='col-md'>
                    <h4>Amount of Other</h4>
                </div>
            </div>
            <div class="row">
                <div class='col-md-4'>
                    <label class='control-label'>Other Price</label>
                    <input class="form-control" v-model='otherprice' readonly/>
                    <label class='control-label'>Total Other Price</label>
                    <input class="form-control" v-model='totalotherprice' readonly/>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Discount Other</label>
                            <input class='form-control' v-model='discountother' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>GST(%)</label>
                            <input class='form-control' v-model='gstotherpct' readonly disabled/>
                        </div>
                        <div class="col-md-9">
                            <label class='control-label'>GST Amount</label>
                            <input class='form-control' v-model='gstother' readonly disabled/>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='row'>
                        <div class='col-md'>
                            <label class='control-label'>Total Discount Other</label>
                            <input class='form-control' v-model='totaldiscountother' readonly />
                        </div>
                    </div>
                    <div class='row no-gutters'>
                        <div class="col-md">
                            <label class='control-label'>Total GST Amount</label>
                            <input class='form-control' v-model='totalgstother' readonly disabled/>
                        </div>
                    </div>
                    <label class="control-label">Subtotal Other</label>
                    <input class='form-control' v-model='subtotalotherprice' readonly />
                </div>
            </div>
            <span>&nbsp;</span>
            <div class='row'>
                <div class='col-md-4'></div>
                <div class='col-md-4'></div>
                <div class="col-md-4">
                    <label class='control-label'><strong>TOTAL AMOUNT</strong></label>
                    <input class='form-control' v-model ='totalamount' readonly />
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <p class="text-warning">Please make sure the data above is correct, before moving into the next item / finishing the quotation.</p>                </div>
            </div>
            <div class="row">
                <div class='col-md'>

                    <form action="" method="post">
                        <div class='row'>
                            <div class='col-md'>
                                <button type="button" class="btn btn-warning btn-block btn-large" onclick='openDetails()'>Edit Details</button>
                            </div>
                            <div class='col-md '>
                                <button type="button" class="btn btn-primary btn-block btn-large" @click='finalizeItemDetail()' data-dismiss='modal'>Revise This Item</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>