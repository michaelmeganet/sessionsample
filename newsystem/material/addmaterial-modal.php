<?php ?>

<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Name</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class='form-control' maxlength="25" v-model="addmat.material" />
    </div>
    <div class='col-md-4'>
        <label class='col-form-label' v-if='materialname_stats == "ok"' style='color:lightgreen'>{{materialname_resp}}</label>
        <label class='col-form-label' v-else-if='materialname_stats == "error"' style='color:red'>{{materialname_resp}}</label>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >N.E.G. Symbol</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model="addmat.neg" >
            <option value="yes">YES</option>
            <option value="no">NO</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Name for UBS Inventory</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class='form-control' maxlength="25" v-model="addmat.material_acc" />
    </div>
    <div class='col-md-4'>
        <label class='col-form-label' v-if='materialacc_stats == "ok"' style='color:lightgreen'>{{materialacc_resp}}</label>
        <label class='col-form-label' v-else-if='materialacc_stats == "error"' style='color:red'>{{materialacc_resp}}</label>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Code (no space)</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class='form-control' maxlength="25" v-model="addmat.materialcode" @keydown.space.prevent/>
    </div>
    <div class='col-md-4'>
        <label class='col-form-label' v-if='materialcode_stats == "ok"' style='color:lightgreen'>{{materialcode_resp}}</label>
        <label class='col-form-label' v-else-if='materialcode_stats == "error"' style='color:red'>{{materialcode_resp}}</label>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Category</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select v-model='addmat.category' class='form-control'>
            <template v-for=''>
                <option v-for='(data,key) in categoryList' v-bind:value='key'>{{data.name}}</option>
            </template>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Shape Code</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select v-model='addmat.Shape_Code' class='form-control' @change='
                addmat.shaft = shapeList[addmat.category][addmat.Shape_Code].isshaft;
                addmat.shaftindicator = shapeList[addmat.category][addmat.Shape_Code].shaftindicator
                '>
            <template v-for=''>
                <option v-for='(data,key) in shapeList[addmat.category]' v-bind:value='key'>{{data.name}}</option>
            </template>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Is Shaft ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class='form-control disabled' maxlength="25" v-model="addmat.shaft" readonly/>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Shaft Indicator</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type="text" class='form-control disabled' maxlength="25" v-model="addmat.shaftindicator" readonly/>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Company</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.company'>
            <option value='PMT'>PMT</option>
            <option value='PHH'>PHH</option>
            <option value='PST'>PST</option>
            <option value='PSVPMB'>PSVPMB</option>
            <option value='PTPHH'>PTPHH</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Is Material ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.ismaterial'>
            <option value='yes'>YES</option>
            <option value='no'>NO</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Have Image ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.haveimage'>
            <option value='yes' disabled>YES</option>
            <option value='no'>NO</option>
        </select>
    </div>
    <div class='col-md-auto'>
        <font style='color:red'>Currently disabled, not finish upload module yet</font>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Image Source</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <input type='text' class='form-control' v-model='addmat.imagesource' readonly/>
    </div>
    <div class='col-md-auto'>
        <font style='color:red'>Currently disabled, not finish upload module yet</font>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Machining Code </label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.machiningcode'>
            <option value=''>None</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
        </select>
    </div>
    <div class='col-md-auto'>(Tool Steel only, Refer Daniel for Machining Code)</div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Material Type</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.materialtype'>
            <option value='none' disabled selected>None</option>
            <option value='ts'>Tool Steel</option>
            <option value='ms'>Mild Steel</option>
            <option value='brass'>Brass</option>
            <option value='copper'>Copper</option>
            <option value='aa'>Aluminium</option>
            <option value='bronze'>Bronze</option>
            <option value='hardox'>Hardox</option>
            <option value='other'>Other</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >PHH Standard ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.phhstandard'>
            <option value='yes'>Yes</option>
            <option value='no'>No</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Listing ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.listing'>
            <option value='yes'>Yes</option>
            <option value='no'>No</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label class="col-form-label" >Stock Listing ?</label>
    </div>
    <div class="col-md-auto">
        <label class='col-form-label'>:</label>
    </div>
    <div class="col-md-3">
        <select class='form-control' v-model='addmat.stocklisting'>
            <option value='yes'>Yes</option>
            <option value='no'>No</option>
        </select>
    </div>
</div>
<br>
<div class='form-group row'>
    <div class='col-md'>
        <font style="color:red" v-if="validation_stats == 'error'">{{validation_resp}}</font>
    </div>
    <div class="col-md text-right">
        <button class="btn btn-success" @click="validation_submit()">Create New Material</button>
    </div>
    
</div>