<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" v-bind:class="mainactive"   id="nav-main-tab" data-toggle="tab" href="#nav-main"   role="tab" aria-controls="nav-main"   v-bind:aria-selected="maintrue">Main</a>
        <a class="nav-item nav-link" v-bind:class="finalactive"  id="nav-final-tab"  data-toggle="tab" href="#nav-final" role="tab" aria-controls="nav-final" v-bind:aria-selected="finaltrue">All Total</a>
    </div>
</nav>
<div  id='mainArea'>
    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
        <div class="tab-pane fade show" v-bind:class="mainactive" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab" v-bind:style="{backgroundColor:divBackColor}">
            <!-- Select Customer Type ~ Step1 -->
            <div class="form-group row">
                <div class="col-md-4">
                    <label class='control-label'>Customer Type:</label>
                    <div class='input-group'>
                        <select class='custom-select' name='custype' id='custype' v-model="custype" onchange="showStep2()">
                            <option value='#' selected disabled>Please select one...</option>
                            <option value='local'>Local</option>
                            <option value='outstation'>Outstation</option>
                            <option value='melaka'>Melaka</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 align-items-center align-bottom">
                </div>
                <div class="col-md-4 align-items-center align-bottom">
                    <input type="checkbox" class="checkbox" v-model="freepage" />
                    <label class="custom-label" >Free Page Mode</label>
                </div>
                <hr/>
            </div>
            <!-- Input Quantity, Shape Order, and Material ~ Step2 -->
            <div class="row" v-show="step2show">
                <div class="col-md-4">
                    <label class="control-label">Quantity</label>
                    <input type='integer' v-model='quantity' class='form-control' id='quantity' name='quantity' value='1' placeholder='Quantity' required />
                </div>
                <div class="col-md-4">
                    <label class="control-label">Special Shape Order</label>
                    <select v-model="specialShapeOrder" class='custom-select' name='specialShapeOrder' id='specialShapeOrder' @change='getMaterial()' onchange>
                        <option value='' disabled>Please select one...</option>
                        <option value='NORMAL'>Normal Shape</option>
                        <option value='PLATEC'>Circular Plate Shape</option>
                        <option value='PLATECO'>Ring Plate Shape</option>
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
           <!-- <template v-if='(category != "" && category != null) && (ShapeCode != "" && ShapeCode != null) && (mat != "" && mat != null) && (tabletype != "" && tabletype != null)'>
            -->
            <!-- Input Dimensions ~ Step3 -->
            <div class="form-group" v-show='step3show'>
                <?php include 'dimension-div.php'; ?>
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
                                <input class="form-control" v-model='gstmatpct' name='gstmatpct' value='' id='gstmatpct' disabled/>                        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Subtotal Price</label>
                        <input class="form-control" v-model='subtotalmat' name="subtotalmat" value='' id='subtotalmat'/>
                    </div>
                </div>
            </div>
            <span>&nbsp;</span>
            <!-- Premach Calculation ~ Step4 -->
            <div class="form-group" v-show='step4show'>
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
                        <input type='number' min='0' class="form-control" v-model='pmachprice' name='pmachprice' id='pmachprice' value='' v-bind:readonly="!freepage"/>
                        <div class="row">
                            <div class='col-md-9'>
                                <label class="control-label">Discount (RM)</label>
                                <input type='number' min='0' class="form-control" v-model='discountpmach' name='discountpmach' value='' id="discountpmach"/>
                            </div>
                            <div class="col-md">
                                <label class="control-label">GST(%)</label>
                                <input type='number' min='0' class="form-control" v-model='gstpmachpct' name='gstpmachpct' value='' id='gstmachpct' disabled/>                        
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <label class="control-label">Total Pre-Machining Price</label>
                        <input type='number' min='0' class='form-control' v-model='totalpmachprice' name="totalpmachprice" id='totalpmachprice' v-bind:readonly="!freepage"/>
                        <label class="control-label">SubTotal Pre-Machining Price</label>
                        <input type='number' min='0' class='form-control' v-model='subtotalpmachprice' name="subtotalpmachprice" id='subtotalpmachprice' readonly/>
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
                        <input type='number' min='0' v-model='cncprice' name='cncprice' id='cncprice' class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <div class='row'>
                            <div class='col-md-9'>
                                <label class="control-label">Discount (RM)</label>
                                <input type='number' min='0' class="form-control" v-model='discountcnc' name='discountcnc' value='' id="discountcnc"/>
                            </div>
                            <div class="col-md">
                                <label class="control-label">GST(%)</label>
                                <input type='number' min='0' class="form-control" v-model='gstcncpct' name='gstcncpct' value='' id='gstcncpct' disabled/>                        
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <label class="control-label">Total CNC Price</label>
                        <input type='number' min='0' class='form-control' v-model='totalcncprice' name="totalcncprice" id='totalcncprice' v-bind:readonly="!freepage"/>
                        <label class="control-label">SubTotal CNC Price</label>
                        <input type='number' min='0' class='form-control' v-model='subtotalcncprice' name="subtotalcncprice" id='subtotalcncprice' readonly/>
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
                        <input type='number' min='0' v-model='otherprice' name='otherprice' id='otherprice' class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class='col-md-9'>
                                <label class="control-label">Discount (RM)</label>
                                <input type='number' min='0' class="form-control" v-model='discountother' name='discountother' value='' id="discountother"/>
                            </div>
                            <div class="col-md">
                                <label class="control-label">GST(%)</label>
                                <input type='number' min='0' class="form-control" v-model='gstotherpct' name='gstotherpct' value='' id='gstotherpct' disabled/>                        
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <label class="control-label">Total Other Price</label>
                        <input type='number' min='0' class='form-control' v-model='totalotherprice' name="totalotherprice" id='totalotherprice' v-bind:readonly="!freepage"/>
                        <label class="control-label">SubTotal Other Price</label>
                        <input type='number' min='0' class='form-control' v-model='subtotalotherprice' name="subtotalotherprice" id='subtotalotherprice' readonly/>
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
                        <button class="btn btn-primary btn-block" v-bind:style='{display: btnDisplay}' type='' onclick="showStep5();setDiscountGST()" @click="parseDimension();">Next Step</button>
                    </div>
                </div>
            </div>
            <!--
        </template>
        <template v-else>
            <div class="row">
                <div class="col-md">
                    <label class="control-label">
                        Selected Material Doesn't Have Complete Description
                    </label>
                    <br>
                    <label class="control-label">
                        Contact Administrator regarding this.
                    </label>
                </div>
            </div>
        </template>
            -->

        </div>
        <div class="tab-pane fade show" v-bind:class="finalactive" id="nav-final" role="tabpanel" aria-labelledby="nav-final-tab">
            <!-- Final results ~ Step 5-->
            <div class="form-group" v-show="step5show">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                            <!--<label class="control-label">List of Vue.js Variables</label><br>
                            <!-- hidden inputs from original POST data -->
                            <input type="hidden" name ="aid"               id="aid"                value ="<?php echo $aid; ?>" placeholder="aid"/> 
                            <input type="hidden" name ="bid"               id="bid"                value ="<?php echo $bid; ?>" placeholder="bid"/>
                            <input type="hidden" name ="com"               id="com"                value ="<?php echo $com; ?>" placeholder="com"/>
                            <input type="hidden" name ="post_cid"          id="post_cid"           value ="<?php echo $post_cid; ?> " placeholder="cid" />
                            <input type="hidden" name ="post_period"       id="post_period"        value ="<?php echo $post_period; ?>" placeholder="period"/>
                            <input type="hidden" name ="quotab"            id="quotab"             value ="<?php echo $quotab; ?>" placeholder="quotab"/>
                            <input type="hidden" name ="quono"             id="quono"              value ="<?php echo $quono; ?>" placeholder="quono"/>
                            <input type="hidden" name ="itemno"            id="itemno"             value ="<?php echo $itemno; ?>" placeholder="itemno"/>
                            <input type="hidden" name ="create_quotation"  id="create_quotation"   value ="<?php echo $quotype; ?>" placeholder="quotype"/>

                            <!-- hidden inputs from VUE.JS -->                        
                            <input type="hidden" name ="pagetype"           id="pagetype"          v-if="freepage" value="free" placeholder="pagetype"/>
                            <input type="hidden" name ="pagetype"           id="pagetype"          v-else value="normal" placeholder="pagetype"/>
                            <input type="hidden" name ="custype"           id="custype"            v-bind:value="custype" placeholder="custype"/>
                            <input type="hidden" name ="quantity"          id="quantity"           v-bind:value="quantity" placeholder="quantity"/>
                            <input type="hidden" name ="specialShapeOrder" id="specialShapeOrder"  v-bind:value="specialShapeOrder" placeholder="specialShapeOrder"/>
                            <input type="hidden" name ="mat"               id="mat"                v-bind:value="mat" placeholder="mat"/>
                            <input type='hidden' name ='category'          id='category'           v-bind:value="category" placeholder="category"/>
                            <input type="hidden" name ="Shape_Code"        id="Shape_Code"         v-bind:value="ShapeCode" placeholder="Shape_Code" />
                            <input type="hidden" name ="tabletype"         id="tabletype"          v-bind:value="tabletype" placeholder="tabletype"/>
                            <input type='hidden' name='mdt'                id='mdt'                v-bind:value="mdt" placeholder="mdt"/>
                            <input type='hidden' name='mdw'                id='mdw'                v-bind:value="mdw" placeholder="mdw"/>
                            <input type='hidden' name='mdl'                id='mdl'                v-bind:value="mdl" placeholder="mdl"/>
                            <input type='hidden' name='fdt'                id='fdt'                v-bind:value="fdt" placeholder="fdt"/>
                            <input type='hidden' name='fdw'                id='fdw'                v-bind:value="fdw" placeholder="fdw"/>
                            <input type='hidden' name='fdl'                id='fdl'                v-bind:value="fdl" placeholder="fdl"/>
                            <input type='hidden' name='dim_desc'           id='dim_desc'           v-bind:value="dim_desc" placeholder="dim_desc"/>
                            <input type='hidden' name='finishing_dim_desc' id='finishing_dim_desc' v-bind:value="finishing_dim_desc" placeholder="finishing_dim_desc"/>
                            <input type='hidden' name='pmid'               id='pmid'               v-bind:value="pmid" placeholder="pmid"/>
                            <input type='hidden' name='processcode'        id='processcode'        v-bind:value="processcode" placeholder="processcode"/>
                            <input type='hidden' name='density'            id='density'            v-bind:value="density" placeholder="density"/>
                            <input type='hidden' name='weight'             id='weight'             v-bind:value="weight" placeholder="weight"/>
                            <input type='hidden' name='volume'             id='volume'             v-bind:value="volume" placeholder="volume"/>
                            <input type='hidden' name='pricePerPCS'        id='pricePerPCS'        v-bind:value="pricePerPCS" placeholder="pricePerPCS"/>
                            <input type='hidden' name='pricePerKG'         id='pricePerKG'         v-bind:value="pricePerKG" placeholder="pricePerKG"/>
                            <input type='hidden' name='totalweight'        id='totalweight'        v-bind:value="totalweight" placeholder="totalweight"/>
                            <input type='hidden' name='totalprice'         id='totalprice'         v-bind:value="totalprice" placeholder="totalprice"/>
                            <input type="hidden" name='discountmat'        id='discountmat'        v-bind:value="discountmat" placeholder="discountmat"/>
                            <input type="hidden" name='totaldiscountmat'   id='totaldiscountmat'   v-bind:value="totaldiscountmat" placeholder="totaldscountmat"/>
                            <input type="hidden" name='gstmatpct'          id='gstmatpct'          v-bind:value='gstmatpct' placeholder="gstmatpct" />
                            <input type="hidden" name='gstmat'             id='gstmat'             v-bind:value="gstmat" placeholder="gstmat"/>
                            <input type="hidden" name='totalgstmat'        id='totalgstmat'        v-bind:value="totalgstmat" placeholder="totalgstmat"/>
                            <input type='hidden' name='subtotalmat'        id='subtotalmat'        v-bind:value='subtotalmat' placeholder='subtotalmat'/>

                            <input type="hidden" name='pmachprice'         id='pmachprice'         v-bind:value="pmachprice" placeholder="pmachprice"/>
                            <input type="hidden" name='totalpmachprice'    id='totalpmachprice'    v-bind:value="totalpmachprice" placeholder="totalpmachprice"/>
                            <input type='hidden' name='discountpmach'      id='discountpmach'      v-bind:value='discountpmach' placeholder='discountpmach'/>
                            <input type='hidden' name='totaldiscountpmach' id='totaldiscountpmach' v-bind:value='totaldiscountpmach' placeholder='totaldiscountpmach'/>
                            <input type='hidden' name='gstpmachpct'        id='gstpmachpct'        v-bind:value='gstpmachpct' placeholder='gstpmachpct'/>
                            <input type='hidden' name='gstpmach'           id='gstpmach'           v-bind:value='gstpmach' placeholder='gstpmach'/>
                            <input type='hidden' name='totalgstpmach'      id='totalgstpmach'      v-bind:value='totalgstpmach' placeholder='totalgstpmach'/>
                            <input type='hidden' name='subtotalpmachprice' id='subtotalpmachprice' v-bind:value='subtotalpmachprice' placeholder='subtotalpmachprice'/>

                            <input type="hidden" name='cncprice'           id='cncprice'           v-bind:value="cncprice" placeholder="cncprice"/>
                            <input type='hidden' name='totalcncprice'      id='totalcncprice'      v-bind:value='totalcncprice' placeholder='totalcncprice'/>
                            <input type='hidden' name='discountcnc'        id='discountcnc'        v-bind:value='discountcnc' placeholder='discountcnc'/>
                            <input type='hidden' name='totaldiscountcnc'   id='totaldiscountcnc'   v-bind:value='totaldiscountcnc' placeholder='totaldiscountcnc'/>
                            <input type='hidden' name='gstcncpct'          id='gstcncpct'          v-bind:value='gstcncpct' placeholder='gstcncpct'/>
                            <input type='hidden' name='gstcnc'             id='gstcnc'             v-bind:value='gstcnc' placeholder='gstcnc'/>
                            <input type='hidden' name='totalgstcnc'        id='totalgstcnc'        v-bind:value='totalgstcnc' placeholder='totalgstcnc'/>
                            <input type='hidden' name='subtotalcncprice'   id='subtotalcncprice'   v-bind:value='subtotalcncprice' placeholder='subtotalcncprice'/>

                            <input type="hidden" name='otherprice'         id='otherprice'         v-bind:value="otherprice" placeholder="otherprice"/>
                            <input type='hidden' name='totalotherprice'    id='totalotherprice'    v-bind:value='totalotherprice' placeholder='totalotherprice'/>
                            <input type='hidden' name='discountother'      id='discountother'      v-bind:value='discountother' placeholder='discountother'/>
                            <input type='hidden' name='totaldiscountother' id='totaldiscountother' v-bind:value='totaldiscountother' placeholder='totaldiscountother'/>
                            <input type='hidden' name='gstotherpct'        id='gstotherpct'        v-bind:value='gstotherpct' placeholder='gstotherpct'/>
                            <input type='hidden' name='gstother'           id='gstother'           v-bind:value='gstother' placeholder='gstother'/>
                            <input type='hidden' name='totalgstother'      id='totalgstother'      v-bind:value='totalgstother' placeholder='totalgstother'/>
                            <input type='hidden' name='subtotalotherprice' id='subtotalotherprice' v-bind:value='subtotalotherprice' placeholder='subtotalotherprice'/>

                            <input type="hidden" name='totalamount'        id='totalamount'        v-bind:value="totalamount" placeholder="totalamount"/>
                            <div class="input-group no-gutters">
                                <div class='col-md'>
                                    <button type="button" class='btn btn-warning btn-block btn-large' onclick="previousStep()">Previous Step</button>
                                </div>
                                <div class='col-md'>
                                    <input type="submit" class="btn btn-primary btn-block btn-large" id='submitTotal' name='submitTotal' value='Submit Quotation Item' />
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>