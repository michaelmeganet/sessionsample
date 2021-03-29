<datalist name='thickList' id='thickList'>
    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
</datalist>
<datalist name='W1List' id='W1List'>
    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
</datalist>
<datalist name='W2List' id='W2List'>
    <option v-for='data in w2List' v-bind:value='data'>{{data}}</option>

</datalist>

<div class='row'>

    <!-- TRADE AREA -->
    <template v-if='specialShapeOrder === "TRADE"'>
        <div class="col-md-8" >
            <label class="control-label"><h4>Description</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Order Description</label>
            <span>
                <textarea rows="4" class="form-control" id="description" name="description" v-model='dim_desc' style="resize:none"></textarea>
            </span>
        </div>
    </template>
    <template v-else>
        <!--PLATEN AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'NORMAL'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else>
                <input type='number' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Width</label>
            <span v-if='w1List.length !== 0 && mat !== "12379p"'>
                <select class="custom-select" id='dW' name='dW' v-model='dW' >
                    <option value='#' selected disabled>Select Width..</option>
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input type='number' class='form-control' id='dW' name='dW' v-model='dW' value="" />
            </span>
            <label class="control-label">Length</label>
            <input type='number' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'NORMAL'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input type='number' min='0' v-bind:max='dT' class='form-control' id='fT' name='fT' v-model='fT' />
            <label class="control-label">Width</label>
            <input type='number' min='0' v-bind:max='dW'  class='form-control' id='fW' name='fW' v-model='fW' />
            <label class="control-label">Length</label>
            <input type='number' min='0' v-bind:max='dL'  class='form-control' id='fL' name='fL' v-model='fL' />
        </div>

        <!--PLATEC AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'PLATEC'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Outer Diameter (OD)</label>
            <input  type='number' min='0' class='form-control' id='dOD' name='dOD' v-model='dOD' value="" />
            <label class="control-label">Width</label>
            <input  type='number' min='0' readonly class='form-control' id='dW' name='dW' v-model='dW' list="W1List" value="" />
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'PLATEC'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' />
            <label class="control-label">Outer Diameter (OD)</label>
            <input  type='number' min='0' class='form-control' id='fOD' name='fOD' v-model='fOD' value="" />
            <label class="control-label">Width</label>
            <input  type='number' min='0' readonly class='form-control' id='fW' name='fW' v-model='fW' />
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' />
        </div>

        <!--PLATECO AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'PLATECO'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span><label class="control-label">Outer Diameter (OD)</label>
            <input  type='number' min='0' class='form-control' id='dOD' name='dOD' v-model='dOD' value="" />
            <label class="control-label">Inner Diameter (ID)</label>
            <input  type='number' min='0' class='form-control' id='dID' name='dID' v-model='dID' value="" />
            <label class="control-label">Width</label>
            <input  type='number' min='0' readonly class='form-control' id='dW' name='dW' v-model='dW' list="W1List" value="" />
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'PLATEN' && specialShapeOrder === 'PLATECO'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' />
            <label class="control-label">Outer Diameter (OD)</label>
            <input  type='number' min='0' class='form-control' id='fOD' name='fOD' v-model='fOD' value="" />
            <label class="control-label">Inner Diameter (ID)</label>
            <input  type='number' min='0' class='form-control' id='fID' name='fID' v-model='fID' value="" />
            <label class="control-label">Width</label>
            <input  type='number' min='0' readonly class='form-control' id='fW' name='fW' v-model='fW' />
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' />
        </div>

        <!--O AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'O'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Diameter (PHI)</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dPHI' name='dPHI' v-model='dPHI' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dPHI' name='dPHI' v-model='dPHI' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span><label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'O'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Diameter (PHI)</label>
            <input  type='number' min='0' class='form-control' id='fPHI' name='fPHI' v-model='fPHI' value=""/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--HEX AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'HEX'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness (HEX)</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dHEX' name='dHEX' v-model='dHEX' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dHEX' name='dHEX' v-model='dHEX' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'HEX'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness (HEX)</label>
            <input  type='number' min='0' class='form-control' id='fHEX' name='fHEX' v-model='fHEX' value="" readonly/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--ANGLE AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'A'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Width 1 (W1)</label>
            <span v-if='w1List.length !== 0'>
                <select class="custom-select" id='dW1' name='dW1' v-model='dW1' @change='getW2List()' onchange="setVueWidth1(this.value)">
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW1' name='dW1' v-model='dW1' value="" />
            </span>
            <label class="control-label">Width 2 (W2)</label>
            <span v-if='w2List.length !== 0'>
                <select class="custom-select" id='dW2' name='dW2' v-model='dW2' >
                    <option v-for='data in w2List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW2' name='dW2' v-model='dW2' value="" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'A'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' value="" readonly/>
            <label class="control-label">Width 1 (W1)</label>
            <input  type='number' min='0' class='form-control' id='fW1' name='fW1' v-model='fW1' value="" readonly/>
            <label class="control-label">Width 2 (W2)</label>
            <input  type='number' min='0' class='form-control' id='fW2' name='fW2' v-model='fW2' value="" readonly/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--SS AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'SS'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Width 1 (W1)</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dW1' name='dW1' v-model='dW1' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW1' name='dW1' v-model='dW1' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Width 2 (W2)</label>
            <span v-if='w1List.length !== 0'>
                <select class="custom-select" id='dW2' name='dW2' v-model='dW2' onchange="setVueWidth1(this.value)">
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW2' name='dW2' v-model='dW2' value="" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'SS'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Width 1 (W1)</label>
            <input  type='number' min='0' class='form-control' id='fW1' name='fW1'  v-model='fW1' value="" readonly/>
            <label class="control-label">Width 2 (W2)</label>
            <input  type='number' min='0' class='form-control' id='fW2' name='fW2' v-model='fW2' value="" readonly/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--HS AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'HS'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Width 1 (W1)</label>
            <span v-if='w1List.length !== 0'>
                <select class="custom-select" id='dW1' name='dW1' v-model='dW1' @change='getW2List()' onchange="setVueWidth1(this.value)">
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW1' name='dW1' v-model='dW1' value="" />
            </span>
            <label class="control-label">Width 2 (W2)</label>
            <span v-if='w2List.length !== 0'>
                <select class="custom-select" id='dW2' name='dW2' v-model='dW2' >
                    <option v-for='data in w2List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW2' name='dW2' v-model='dW2' value="" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'HS'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' value="" readonly/>
            <label class="control-label">Width 1 (W1)</label>
            <input  type='number' min='0' class='form-control' id='fW1' name='fW1' v-model='fW1' value="" readonly/>
            <label class="control-label">Width 2 (W2)</label>
            <input  type='number' min='0' class='form-control' id='fW2' name='fW2' v-model='fW2' value="" readonly/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--HP AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'HP'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Outer Diameter (OD)</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dOD' name='dOD' v-model='dOD' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dOD' name='dOD' v-model='dOD' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Inner Diameter (ID)</label>
            <span v-if='w1List.length !== 0'>
                <select class="custom-select" id='dID' name='dID' v-model='dID'  onchange="setVueWidth1(this.value)">
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dID' name='dID' v-model='dID' value="" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'HP'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Outer Diameter (OD)</label>
            <input  type='number' min='0' class='form-control' id='fOD' name='fOD' v-model='fOD' value="" />
            <label class="control-label">Inner Diameter (ID)</label>
            <input  type='number' min='0' class='form-control' id='fID' name='fID' v-model='fID' value="" />
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
        </div>

        <!--FLAT AREA-->
        <div class="col-md-4" v-if="ShapeCode === 'FLAT'">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <span v-if='thickList.length !== 0'>
                <select class="custom-select" id='dT' name='dT' v-model='dT' @change='getW1List()' onchange="setVueThickness(this.value)">
                    <option v-for='data in thickList' v-bind:value='data.thickness'>{{data.thickness}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" @change='getW1List()' onchange="setVueThickness(this.value)" />
            </span>
            <label class="control-label">Width</label>
            <span v-if='w1List.length !== 0'>
                <select class="custom-select" id='dW' name='dW' v-model='dW' >
                    <option v-for='data in w1List' v-bind:value='data'>{{data}}</option>
                </select>
            </span>
            <span v-else=>
                <input  type='number' min='0' class='form-control' id='dW' name='dW' v-model='dW' value="" />
            </span>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'FLAT'">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Thickness</label>
            <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' readonly/>
            <label class="control-label">Width</label>
            <input  type='number' min='0' class='form-control' id='fW' name='fW' v-model='fW' readonly/>
            <label class="control-label">Length</label>
            <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' />
        </div>

        <!--C AREA Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'C' && freepage">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input type='number' @blur='dH = parseFloat(dH)' min='0' class='form-control' id='dH' name='dH' v-model='dH' value="" />
            </span>
            <label class="control-label">Angle (A)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dA' name='dA' v-model='dA' value="" />
            </span>
            <label class="control-label">Angle Thickness (T)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" />
            </span>
            <label class="control-label">Rib Thickness (ribT)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dribT' name='dribT' v-model='dribT' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
            </span>
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'C' && freepage">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fH' name='fH' v-model='fH' value="" />
            </span>
            <label class="control-label">Angle (A)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fA' name='fA' v-model='fA' value="" />
            </span>
            <label class="control-label">Angle Thickness (T)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' value="" />
            </span>
            <label class="control-label">Rib Thickness (ribT)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fribT' name='fribT' v-model='fribT' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
            </span>
        </div>
        <!--C AREA Not Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'C' && !freepage">
            Yes this is showing C<br>Normal Page is not supported <br>Please use Free Page Mode.

        </div>
        <div class="col-md-4" v-if="ShapeCode === 'C' && !freepage">            

        </div>
        
        <!--LIP AREA Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'LIP' && freepage">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dH' name='dH' v-model='dH' value="" />
            </span>
            <label class="control-label">Angle (A)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dA' name='dA' v-model='dA' value="" />
            </span>
            <label class="control-label">Lip Length (C)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dC' name='dC' v-model='dC' value="" />
            </span>
            <label class="control-label">Thickness (T)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dT' name='dT' v-model='dT' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
            </span>
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'LIP' && freepage">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fH' name='fH' v-model='fH' value="" />
            </span>
            <label class="control-label">Angle (A)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fA' name='fA' v-model='fA' value="" />
            </span>
            <label class="control-label">Lip Length (C)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fC' name='fC' v-model='fC' value="" />
            </span>
            <label class="control-label">Thickness (T)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fT' name='fT' v-model='fT' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
            </span>
        </div>
        <!--LIP AREA Not Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'LIP' && !freepage">
            Yes this is showing LIP<br>Normal Page is not supported <br>Please use Free Page Mode.

        </div>
        <div class="col-md-4" v-if="ShapeCode === 'LIP' && !freepage">            

        </div>
        
        <!--H BEAM AREA Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'H' && freepage">
            <label class="control-label"><h4>Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dH' name='dH' v-model='dH' value="" />
            </span>
            <label class="control-label">Width (B)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dB' name='dB' v-model='dB' value="" />
            </span>
            <label class="control-label">Center Thickness (T1)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dT1' name='dT1' v-model='dT1' value="" />
            </span>
            <label class="control-label">Fringe Thickness (T2)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dT2' name='dT2' v-model='dT2' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='dL' name='dL' v-model='dL' value="" />
            </span>
        </div>
        <div class="col-md-4" v-if="ShapeCode === 'H' && freepage">
            <label class="control-label"><h4>Finishing Dimension</h4></label><br>
            <span>&nbsp;</span>
            <label class="control-label">Height (H)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fH' name='fH' v-model='fH' value="" />
            </span>
            <label class="control-label">Width (B)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fB' name='fB' v-model='fB' value="" />
            </span>
            <label class="control-label">Center Thickness (T1)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fT1' name='fT1' v-model='fT1' value="" />
            </span>
            <label class="control-label">Fringe Thickness (T2)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fT2' name='fT2' v-model='fT2' value="" />
            </span>
            <label class="control-label">Length (L)</label>
            <span>
                <input  type='number' min='0' class='form-control' id='fL' name='fL' v-model='fL' value="" />
            </span>
        </div>
        <!--LIP AREA Not Free Page-->
        <div class="col-md-4" v-if="ShapeCode === 'H' && !freepage">
            Yes this is showing H BEAM<br>Normal Page is not supported <br>Please use Free Page Mode.

        </div>
        <div class="col-md-4" v-if="ShapeCode === 'H' && !freepage">            

        </div>
        
    </template>
    <div class="col-md-4">
        <label class='control-label'><h4>Material Price Results</h4></label><br>
        <span>&nbsp;</span>
        <label class='control-label'>Weight :</label>
        <input v-model='weight' class="form-control" id='weight' name='weight' v-bind:readonly="!freepage"/>
        <label class='control-label'>Total Weight :</label>
        <input v-model='totalweight' class="form-control" id='totalweight' name='totalweight' readonly />
        <label class='control-label'>Price per Pcs :</label>
        <input v-model='pricePerPCS' class="form-control" id='pricePerPCS' name='pricePerPCS' v-bind:readonly="!freepage" />
        <label class='control-label'>Total Price :</label>
        <input v-model='totalprice' class="form-control" id='totalprice' name='totalprice' readonly />
        <div v-if='matprice_stats == "error"'>
            <span style="color:red">{{matprice_resp}}</span>
        </div>
        <div class="row no-gutters">
            <div class="col-md" v-if='specialShapeOrder != "TRADE" && !freepage'>
                <button class="btn btn-primary btn-block px-0" type='button' @click='getMatPrice()'>Generate Price (Formula)</button>
            </div>
            <div class="col-md">
                <button class="btn btn-info btn-block" type='button' @click='getMatPriceCalc();getWeightCalc();'>Recalculate Price</button>
            </div>
        </div>
    </div>
</div>