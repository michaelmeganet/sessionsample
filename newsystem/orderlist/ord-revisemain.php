
<div class='container'>
    <div class='row'>
        <div class='container' id='iolMainArea'>
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active"   id="nav-period-tab" data-toggle="tab" href="#nav-period"   role="tab" aria-controls="nav-period"   aria-selected="true"></a>
                </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-period" role="tabpanel" aria-labelledby="nav-period-tab">

                    <div class="form-group">
                        <div class="col-md text-right">
                            <div class="form-group text-right">
                                <form action="" method="post">
                                    <input class="btn btn-outline-danger" type = "submit" name="reset_click" id="reset_click" onclick="sessionStorage.removeItem('customerList')" value = "reset form">
                                </form>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-4'>
                                <label class="control-label">Period :</label>
                                <select class="custom-select" v-model='period' name='period' id="period">
                                    <option v-for='data in periodList' v-bind:value='data'>{{data}}</option>
                                </select>
                            </div>
                        </div>
                        <div class='row' v-show='showCustomer'>
                            <div class='col-md-4'>
                                <label class="control-label">Customer :</label>
                            </div>
                        </div>
                        <div class='row' v-show='showCustomer'>
                            <div class='col-md-4'>
                                <select class="custom-select" v-model='post_cid' name='cid' id="cid">
                                    <option v-for='data in customerList' v-bind:value='data.cid'>{{data.co_name}}</option>
                                </select>
                                <!--
                                <input type="text" list='customerList' class="form-control" placeholder="Search Customer..." v-model="post_cid" name="cid" id='cid'/>
                                <datalist id="customerList">
                                    <option v-for='data in customerList' v-bind:value='data.cid'>{{data.co_name}}</option>
                                </datalist>-->
                            </div>
                            <div class="col-md-4 align-bottom">
                                <button type='button' class='btn btn-primary btn-block' id='submitCustomer' name='submitCustomer' @click='getCrudDetails'>Get Customer</button>
                            </div>
                        </div>
                    </div>
                    <span>&nbsp;</span>
                    <br />
                    <span>&nbsp;</span>
                    <div v-show='data_status == "error"'>
                        {{data_response}}
                    </div>
                    <div class="form-group" v-show='data_status == "ok"'>
                        <div class='row'>
                            <div class="col-md-4">
                                <label class="control-label">Admin Input (Aid) [Temporary, later must use session]</label>
                                <select class="custom-select" id="aid" name="aid" v-model="aid">
                                    <option value="100" Selected>Administrator</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                            
                            <table class="table table-responsive-sm table-borderless table-striped">
                                <thead style='text-align:center;font-size:15px' class=' text-center'>
                                    <tr>
                                        <th rowspan='2' class='align-middle'  style='width: 10%'>Date Issue</th>
                                        <th rowspan='2' class='align-middle'  style='width: 12%'>Quono</th>
                                        <th rowspan='2' class='align-middle'>Company</th>
                                        <th rowspan='2' class='align-middle'>Is Revision</th>
                                        <th colspan='1' class='align-middle'>Revision Detail</th>
                                        <th rowspan='2' class='align-middle'>Orderlist Issued</th>
                                        <th rowspan='2' class='align-middle'>Issued By</th>
                                        <th rowspan='2' class='align-middle'>Select DO</th>
                                        <th rowspan='2' class='align-middle'>Invoice Issued</th>
                                        <th rowspan='2' class='align-middle'>Action</th>
                                    </tr>
                                    <tr>
                                        <th  class='align-middle' style='width: 12%'>Parent</th>
                                        <!--<th  class='align-middle' style='width: 13%'>Child</th>-->
                                    </tr>
                                </thead>
                                <tbody style='text-align:center;font-size:15px' class='table table-hover'>
                                    <tr v-for="(datarow,index) in data_details">
                                <template v-if="datarow.rev_child == null || datarow.rev_child == ''">
                                    <th class='align-middle'>{{datarow.date}}</th>
                                    <th class='align-middle'>{{datarow.quono}}</th>
                                    <th class='align-middle'>{{datarow.company}}</th>
                                    <!--Detailing the revision mark-->
                                    <th class='align-middle text-warning' v-if='datarow.rev_parent == null || datarow.rev_parent == ""'>No</th>
                                    <th class='align-middle text-warning' v-else=''>Yes</th>
                                    <th class='align-middle text-warning'>{{datarow.rev_parent}}</th>
                                    <!--<th class='align-middle'>{{datarow.rev_child}}</th>-->
                                    <th class='align-middle'>{{datarow.odissue}}</th>
                                    <th class='align-middle text-success'>{{datarow.ol_name}}</th>
                                    <th class='align-middle text-success' v-if='datarow.selectdo == "All Selected"'>{{datarow.selectdo}}</th>
                                    <th class='align-middle text-danger' v-else>{{datarow.selectdo}}</th>
                                    <th class='align-middle text-success' v-if='datarow.ivissue == "Issued"'>{{datarow.ivissue}}</th>
                                    <th class='align-middle text-danger' v-else>{{datarow.ivissue}}</th>
                                    <!--Action Area--> 
                                    <th class='align-middle' >
                                        <!--Issue Button  (show when Quotation issued, Orderlist not Isued)-->
                                        <button type='button' class='btn btn-success btn-sm' @click='openWindow(data_details[index],"issueorderlist")'
                                                v-show="datarow.odissue == 'no'">Issue Orderlist</button>  
                                        <!--end Issue Button-->
                                        <!--Block Issue (show when Quotation issued, Orderlist issued, Invoice Issued--> 
                                        <!--                                        <button type='button' class='btn btn-outline-danger btn-sm ' @click="" disabled
                                                                                     v-show='datarow.odissue == "yes" && datarow.ivissue == "Issued"'>Invoice Issued</button>-->

                                        <button type="button" class="btn btn-outline-warning btn-sm"  disabled
                                                v-show='datarow.odissue == "yes" && datarow.ivissue != "Not Issued"'>Revise</button>

                                        <!--end Block Issue-->
                                        <!--Revise Button (show when Quotation issued, Orderlist issued, Invoice not issued)-->
                                        <div class="btn-group" role="group" 
                                             v-show="datarow.odissue == 'yes' && datarow.ivissue == 'Not Issued'">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Revise</button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <button type="button" class="dropdown-item" @click='openWindow(data_details[index],"prcreviseorderlist")'>Revise Price / Material</button>
                                                <button type="button" class="dropdown-item" @click='openWindow(data_details[index],"dscreviseorderlist")'>Revise Description</button>
                                            </div>
                                        </div>
                                        <!--end Revise Button-->
                                        <!--View Button (show when quotation issued, Orderlist Issued)-->
                                        <!--                                        <button type='button' class='btn btn-primary btn-sm' @click="openWindow(data_details[index],'vieworderlist')"
                                                                                        v-show="datarow.odissue == 'yes'">View</button>-->
                                        <!--end View Button-->
                                        <!--Delete Button (show when Quotation issued, Orderlist issued, Invoice not issued)-->
                                        <!--                                        <button type='button' class='btn btn-danger btn-sm'
                                                                                        v-show="datarow.odissue == 'yes' && datarow.ivissue != 'Issued'">Delete</button>-->
                                        <!--end Delete Button-->
                                    </th>
                                </template>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src='./session/session_js.js'></script>
<script>
                                        var iolVue = new Vue({
                                            el: '#iolMainArea',
                                            data: {
                                                phpajaxresponsefile: './orderlist/backend/orderlist.axios.php',
                                                showCustomer: false,
                                                aid: '100',
                                                period: '',
                                                post_cid: '',
                                                periodList: '',
                                                customerList: '',
                                                data_status: '',
                                                data_response: '',
                                                data_details: ''
                                            },
                                            watch: {
                                                period: function (val) {
                                                    if (val != "" || val != null) {
                                                        this.showCustomer = true;
                                                    }
                                                }
                                            },
                                            methods: {
                                                getPeriod: function () {
                                                    checkSession()
                                                    axios.post(this.phpajaxresponsefile, {
                                                        action: 'getPeriod'
                                                    }).then(function (response) {
                                                        console.log('On getPeriod function...');
                                                        console.log(response.data);
                                                        iolVue.periodList = response.data;
                                                    });


                                                },
                                                getCustomer: function () {
                                                    checkSession()
                                                    //if (sessionStorage.getItem('customerList') == null) {
                                                    axios.post(this.phpajaxresponsefile, {
                                                        action: 'getCustomer'
                                                    }).then(function (response) {
                                                        console.log('On getCustomer function...');
                                                        console.log(response.data);
                                                        sessionStorage.setItem('customerList', JSON.stringify(response.data));
                                                        console.log('Inserted data into Session Storage:');
                                                        console.log(JSON.parse(sessionStorage.getItem('customerList')));
                                                        console.log('transfering data into inVueData');
                                                        iolVue.customerList = JSON.parse(sessionStorage.getItem('customerList'));
                                                    });
                                                    //}
                                                    //if (sessionStorage.getItem('customerList') != null) {
                                                    //console.log('transfering data into iolVue');
                                                    //this.customerList = JSON.parse(sessionStorage.getItem('customerList'));
                                                    //}

                                                },
                                                getCrudDetails: function () {
                                                    axios.post(this.phpajaxresponsefile, {
                                                        action: 'getCrudDetails',
                                                        period: this.period,
                                                        cid: this.post_cid
                                                    }).then(function (response) {
                                                        console.log('on getCrudDetails.');
                                                        console.log(response.data);
                                                        iolVue.data_status = response.data.status;
                                                        if (response.data.status === 'error') {
                                                            iolVue.data_response = response.data.msg;
                                                        } else {
                                                            iolVue.data_details = response.data.detail;
                                                        }
                                                    });

                                                },
                                                openWindow: function (data, func) {
                                                    period = encodeURI(this.period);
                                                    quono = encodeURIComponent(data.quono);
                                                    cid = encodeURI(data.cid);
                                                    com = encodeURI(data.company);
                                                    aid = encodeURI(this.aid);
                                                    switch (func) {
                                                        case 'issueorderlist':
                                                            url = 'index-orderlist.php?view=iolpup&period=' + period + '&quono=' + quono + '&cid=' + cid + '&com=' + com + '&aid=' + aid;
                                                            window.open(url, '_blank');
                                                            break;
                                                        case 'dscreviseorderlist':
                                                            url = 'index-orderlist.php?view=ioldrvs&period=' + period + '&quono=' + quono + '&cid=' + cid + '&com=' + com + '&aid=' + aid;
                                                            window.open(url, '_blank');
                                                            break;
                                                        case 'prcreviseorderlist':
                                                            url = 'index-orderlist.php?view=iolprvs&period=' + period + '&quono=' + quono + '&cid=' + cid + '&com=' + com + '&aid=' + aid;
                                                            window.open(url, '_blank');
                                                            break;
                                                        case 'vieworderlist':
                                                            url = 'index-orderlist.php?view=vol&period=' + period + '&quono=' + quono + '&cid=' + cid + '&com=' + com + '&aid=' + aid;
                                                            window.open(url, '_blank');
                                                            break;
                                                    }

                                                }
                                            },
                                            beforeMount: function () {

                                            },
                                            mounted: function () {
                                                this.getPeriod();
                                                this.getCustomer();
                                            }
                                        })
</script>