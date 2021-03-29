<?php
session_start();
if (isset($_SESSION['phhsystem_timeout'])){
    header('Location: ./index.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>NEW PHH SYSTEM</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="Firefox" />
        <link rel="stylesheet" href="../docs/4/darkly/bootstrap.css" media="screen">
        <link rel="stylesheet" href="../docs/_assets/css/custom.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="phhlogo.ico">
        <script src="./assets/jquery-2.1.1.min.js"></script>
    <!--    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
        <script src="../node_modules/axios/dist/axios.min.js"></script>

        <script src="../node_modules/vue/dist/vue.js"></script>

        <!--
        <script src="../bower_components/vue/dist/vue.js"></script>
        <script src="../bower_components/axios/dist/axios.min.js"></script>
        -->
        <!--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />-->
        <!--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>-->
        <link rel="stylesheet" href="./assets/css/select2.css">


        <script>

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23019901-1']);
            _gaq.push(['_setDomainName', "bootswatch.com"]);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body style='padding-bottom:10px'>
        <div class="container " style="height:100%">    
            <div class="row align-items-center " style="height:100%">
                <div class="col-md">
                    <div class="" id="login-form">
                        <div class='container'style="width:40%;max-width:40%">
                            <div class='row py-2' id='phhlogo'>
                                <div class='col-md' >
                                    <img src='./images/phhfulllogowhite.png' style='max-width: 100%'/>
                                </div>
                            </div>
                            <form id='loginArea'>
                                <div class='row pt-2' id='username-input'>
                                    <div class='col-md-4'>
                                        <label class='col-form-label'>Username  :</label>
                                    </div>
                                    <div class='col-md'>
                                        <input type='text' class='form-control' v-model='un' />
                                    </div>
                                </div>
                                <div class='row pb-2' id='username-response'>
                                    <div class='col-md-4'>
                                    </div>
                                    <div class='col-md'>
                                        <label class='col-form-label text-danger'>{{un_resp}}</label>
                                    </div>
                                </div>
                                <div class='row pt-2' id='password-input'>
                                    <div class='col-md-4'>
                                        <label class='col-form-label'>Password  :</label>
                                    </div>
                                    <div class='col-md'>
                                        <input type='password' class='form-control' v-model='pw' v-on:keyup.enter="validate_submit()" />
                                    </div>
                                </div>
                                <div class='row pb-2' id='password-response'>
                                    <div class='col-md-4'>
                                    </div>
                                    <div class='col-md'>
                                        <label class='col-form-label text-danger'>{{pw_resp}}</label>
                                    </div>
                                </div>
                                <div class='row py-2' id='password-input'>
                                    <div class='col-md'>
                                        <label class='col-form-label text-danger' v-show="pw == '' && un != ''">{{submit_resp}}</label>
                                    </div>
                                </div>
                                <div class='row py-2' id='password-input'>
                                    <div class='col-md'>
                                        <button type='button' class='btn btn-info btn-block' @click='validate_submit()'>Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var loginVue = new Vue({
            el: '#loginArea',
            data: {
                phpajaxresponsefile: './session/login.axios.php',
                un: '',
                pw: '',
                un_resp: '',
                pw_resp: '',
                submit_resp: ''

            },
            watch: {
                un: function () {
                    if (this.un !== '' || this.un !== null) {
                        this.un_resp = '';
                        this.submit_resp = '';
                    }
                },
                pw: function () {
                    if (this.pw !== '' || this.pw !== null) {
                        this.pw_resp = '';
//                        this.submit_resp = '';
                    }
                }

            },
            methods: {
                validate_submit: function () {
                    if (this.un != '' && this.pw != '') {
                        let un = this.un;
                        let pw = this.pw;
                        this.doLogin(un, pw);
                    } else {
                        if (this.un === '' || this.un === null) {
                            this.un_resp = 'Please enter Username!';
                        }
                        if (this.pw === '' || this.pw === null) {
                            this.pw_resp = 'Please enter Password!';
                        }

                    }
                },
                doLogin: function (username, password) {
                    axios.post(this.phpajaxresponsefile, {
                        action: 'doLogin',
                        username: username,
                        password: password
                    }).then(function (resp) {
                        console.log('doLogin');
                        console.log(resp.data);
                        if (resp.data.status === 'error') {
                            loginVue.pw = '';
                            loginVue.submit_resp = resp.data.msg;
                        } else if (resp.data.status === 'ok') {
                            window.open('index.php', '_parent');
                        }
                    })
                }
            }
        })
    </script>


    <script src="../docs/_vendor/jquery/dist/jquery.min.js"></script>
    <script src="../docs/_vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="../docs/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../docs/_assets/js/custom.js"></script>
</body>
</html>
