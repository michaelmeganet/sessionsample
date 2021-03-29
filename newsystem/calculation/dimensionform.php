
<script>

    $("#discountmat").keyup(function () {
        var totalmatprice = document.getElementById('totalprice').value;
        var discountmat = document.getElementById('discountmat').value;
        var gstmat = document.getElementById('gstmat').value;
        var discountedmat = totalmatprice - discountmat;
        gstvalue = discountedmat * gstmat / 100;
        subtotalmat = discountedmat + gstvalue;
        if (subtotalmat < 0)
            subtotalmat = 0;
        $('#subtotalmat').val(subtotalmat);
    });
    $("#gstmat").keyup(function () {
        var totalmatprice = document.getElementById('totalprice').value;
        var discountmat = document.getElementById('discountmat').value;
        var gstmat = document.getElementById('gstmat').value;
        var discountedmat = totalmatprice - discountmat;
        gstvalue = discountedmat * gstmat / 100;
        subtotalmat = discountedmat + gstvalue;
        if (subtotalmat < 0)
            subtotalmat = 0;
        $('#subtotalmat').val(subtotalmat);
    });
    $("#discountpmach").keyup(function () {
        var totalpmachprice = document.getElementById('totalpmachprice').value;
        var discountpmach = document.getElementById('discountpmach').value;
        var gstpmach = document.getElementById('gstpmach').value;
        var discountedpmach = totalpmachprice - discountpmach;
        pmachgstvalue = discountedpmach * gstpmach / 100;
        subtotalpmach = discountedpmach + pmachgstvalue;
        if (subtotalpmach < 0)
            subtotalpmach = 0;
        $('#subtotalpmach').val(subtotalpmach);
    });
    $("#gstpmach").keyup(function () {
        var totalpmachprice = document.getElementById('totalpmachprice').value;
        var discountpmach = document.getElementById('discountpmach').value;
        var gstpmach = document.getElementById('gstpmach').value;
        var discountedpmach = totalpmachprice - discountpmach;
        pmachgstvalue = discountedpmach * gstpmach / 100;
        subtotalpmach = discountedpmach + pmachgstvalue;
        if (subtotalpmach < 0)
            subtotalpmach = 0;
        $('#subtotalpmach').val(subtotalpmach);
    });
    $("#cncprice").keyup(function () {
        var quantity = document.getElementById('quantity').value;
        var cncprice = this.value;
        totalcncprice = parseFloat(quantity) * parseFloat(cncprice);
        if (totalcncprice < 0)
            totalcncprice = 0;
        $('#totalcncprice').val(totalcncprice);

        var discountcnc = document.getElementById('discountcnc').value;
        var gstcnc = document.getElementById('gstcnc').value;
        discountedcnc = totalcncprice - discountcnc;
        cncgstvalue = discountedcnc * gstcnc / 100;
        subtotalcnc = discountedcnc + cncgstvalue;
        if (subtotalcnc < 0)
            subtotalcnc = 0;
        $('#subtotalcnc').val(subtotalcnc);
    })
    $("#discountcnc").keyup(function () {
        totalcncprice = document.getElementById('totalcncprice').value;
        var discountcnc = document.getElementById('discountcnc').value;
        var gstcnc = document.getElementById('gstcnc').value;
        discountedcnc = totalcncprice - discountcnc;
        cncgstvalue = discountedcnc * gstcnc / 100;
        subtotalcnc = discountedcnc + cncgstvalue;
        if (subtotalcnc < 0)
            subtotalcnc = 0;
        $('#subtotalcnc').val(subtotalcnc);
    })
    $("#gstcnc").keyup(function () {
        totalcncprice = document.getElementById('totalcncprice').value;
        var discountcnc = document.getElementById('discountcnc').value;
        var gstcnc = document.getElementById('gstcnc').value;
        discountedcnc = totalcncprice - discountcnc;
        cncgstvalue = discountedcnc * gstcnc / 100;
        subtotalcnc = discountedcnc + cncgstvalue;
        if (subtotalcnc < 0)
            subtotalcnc = 0;
        $('#subtotalcnc').val(subtotalcnc);
    })


    $("#otherprice").keyup(function () {
        var otherprice = parseFloat(document.getElementById('otherprice').value);
        var discountother = document.getElementById('discountother').value;
        var gstother = document.getElementById('gstother').value;
        discountedother = otherprice - discountother;
        othergstvalue = discountedother * gstother / 100;
        subtotalother = discountedother + othergstvalue;
        if (subtotalother < 0)
            subtotalother = 0;
        $('#subtotalother').val(subtotalother);
    })
    $("#discountother").keyup(function () {
        var otherprice = parseFloat(document.getElementById('otherprice').value);
        var discountother = document.getElementById('discountother').value;
        var gstother = document.getElementById('gstother').value;
        discountedother = otherprice - discountother;
        othergstvalue = discountedother * gstother / 100;
        subtotalother = discountedother + othergstvalue;
        if (subtotalother < 0)
            subtotalother = 0;
        $('#subtotalother').val(subtotalother);
    })
    $("#gstother").keyup(function () {
        var otherprice = parseFloat(document.getElementById('otherprice').value);
        var discountother = document.getElementById('discountother').value;
        var gstother = document.getElementById('gstother').value;
        discountedother = otherprice - discountother;
        othergstvalue = discountedother * gstother / 100;
        subtotalother = discountedother + othergstvalue;
        if (subtotalother < 0)
            subtotalother = 0;
        $('#subtotalother').val(subtotalother);
    })

    function recalculateprice() {
        var subtotalmatprice = document.getElementById('subtotalmat').value;
        var subtotalpmachprice = document.getElementById('subtotalpmach').value;
        var subtotalcncprice = document.getElementById('subtotalcnc').value;
        var subtotalotherprice = document.getElementById('subtotalother').value;
        subtotalprice = parseFloat(subtotalmatprice) + parseFloat(subtotalpmachprice) + parseFloat(subtotalcncprice) + parseFloat(subtotalotherprice);
        if (subtotalprice < 0)
            subtotalprice = 0;
        $('#subtotalamount').val(subtotalprice);
    }

    $(document).ready(function () {

        $("#dT").keyup(function () {
            var category = <?php echo (isset($category)) ? json_encode($category) : ""; ?>;
            var val = document.getElementById('dT').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            if (category == "ROD") {
                allowance = realval;
            } else {
                allowance = realval - 5;
            }
            var finish_val = allowance;
            $('#dT').css("background-color", "");
            $('#fT').css("background-color", "lightblue");
            $("#fT").val(finish_val);
        });
        //$("#fT").keyup(function () {
        //    var category = <?php // echo (isset($category)) ? json_encode($category) : "";   ?>;
        //    var val = document.getElementById('fT').value;
        //    var finishval = parseFloat(val);
        //   if (category == "ROD") {
        //        allowance = finishval;
        //    } else {
        //        allowance = finishval + 5;
        //    }
        //    var real_val = allowance;
        //    $('#dT').css("background-color", "lightgrey");
        //    $('#fT').css("background-color", "")
        //    $("#dT").val(real_val);
        //});
        $("#dW").keyup(function () {
            var val = document.getElementById('dW').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dW').css("background-color", "");
            $('#fW').css("background-color", "lightblue")
            $("#fW").val(finish_val);
        });
        $("#fW").keyup(function () {
            var val = document.getElementById('fW').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dW').css("background-color", "lightgrey");
            $('#fW').css("background-color", "")
            $("#dW").val(real_val);
        });
        $("#dL").keyup(function () {
            var val = document.getElementById('dL').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dL').css("background-color", "");
            $('#fL').css("background-color", "lightblue")
            $("#fL").val(finish_val);
        });
        $("#fL").keyup(function () {
            var val = document.getElementById('fL').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dL').css("background-color", "lightgrey");
            $('#fL').css("background-color", "")
            $("#dL").val(real_val);
        });
        $("#dW1").keyup(function () {
            var val = document.getElementById('dW1').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dW1').css("background-color", "");
            $('#fW1').css("background-color", "lightblue")
            $("#fW1").val(finish_val);
        });
        $("#fW1").keyup(function () {
            var val = document.getElementById('fW1').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dW1').css("background-color", "lightgrey");
            $('#fW1').css("background-color", "")
            $("#dW1").val(real_val);
        });
        $("#dW2").keyup(function () {
            var val = document.getElementById('dW2').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dW2').css("background-color", "");
            $('#fW2').css("background-color", "lightblue")
            $("#fW2").val(finish_val);
        });
        $("#fW2").keyup(function () {
            var val = document.getElementById('fW2').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dW2').css("background-color", "lightgrey");
            $('#fW2').css("background-color", "")
            $("#dW2").val(real_val);
        });
        $("#dPHI").keyup(function () {
            var val = document.getElementById('dPHI').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval;
            $('#dPHI').css("background-color", "");
            $('#fPHI').css("background-color", "lightblue")
            $("#fPHI").val(finish_val);
        });
        $("#fPHI").keyup(function () {
            var val = document.getElementById('fPHI').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval;
            $('#dPHI').css("background-color", "lightgrey");
            $('#fPHI').css("background-color", "")
            $("#dPHI").val(real_val);
        });
        $("#dHEX").keyup(function () {
            var val = document.getElementById('dHEX').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval;
            $('#dHEX').css("background-color", "");
            $('#fHEX').css("background-color", "lightblue")
            $("#fHEX").val(finish_val);
        });
        $("#fHEX").keyup(function () {
            var val = document.getElementById('fHEX').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval;
            $('#dHEX').css("background-color", "lightgrey");
            $('#fHEX').css("background-color", "")
            $("#dHEX").val(real_val);
        });
        $("#dOD").keyup(function () {
            var val = document.getElementById('dOD').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval;
            $('#dOD').css("background-color", "");
            $('#fOD').css("background-color", "lightblue")
            $("#fOD").val(finish_val);
        });
        $("#fOD").keyup(function () {
            var val = document.getElementById('fOD').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval;
            $('#dOD').css("background-color", "lightgrey");
            $('#fOD').css("background-color", "")
            $("#dOD").val(real_val);
        });
        $("#dID").keyup(function () {
            var val = document.getElementById('dID').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval;
            $('#dID').css("background-color", "");
            $('#fID').css("background-color", "lightblue")
            $("#fID").val(finish_val);
        });
        $("#fID").keyup(function () {
            var val = document.getElementById('fID').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval;
            $('#dID').css("background-color", "lightgrey");
            $('#fID').css("background-color", "")
            $("#dID").val(real_val);
        });
        $("#dH").keyup(function () {
            var val = document.getElementById('dH').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dH').css("background-color", "");
            $('#fH').css("background-color", "lightblue")
            $("#fH").val(finish_val);
        });
        $("#fH").keyup(function () {
            var val = document.getElementById('fH').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dH').css("background-color", "lightgrey");
            $('#fH').css("background-color", "")
            $("#dH").val(real_val);
        });
        $("#dA").keyup(function () {
            var val = document.getElementById('dA').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dA').css("background-color", "");
            $('#fA').css("background-color", "lightblue")
            $("#fA").val(finish_val);
        });
        $("#fA").keyup(function () {
            var val = document.getElementById('fA').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dA').css("background-color", "lightgrey");
            $('#fA').css("background-color", "")
            $("#dA").val(real_val);
        });
        $("#dRibT").keyup(function () {
            var val = document.getElementById('dRibT').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dRibT').css("background-color", "");
            $('#fRibT').css("background-color", "lightblue")
            $("#fRibT").val(finish_val);
        });
        $("#fRibT").keyup(function () {
            var val = document.getElementById('fRibT').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dRibT').css("background-color", "lightgrey");
            $('#fRibT').css("background-color", "")
            $("#dRibT").val(real_val);
        });
        $("#dC").keyup(function () {
            var val = document.getElementById('dC').value;
            if (val < 0) {
                val = 0;
            }
            var realval = parseFloat(val);
            var finish_val = realval - 5;
            $('#dC').css("background-color", "");
            $('#fC').css("background-color", "lightblue")
            $("#fC").val(finish_val);
        });
        $("#fC").keyup(function () {
            var val = document.getElementById('fC').value;
            if (val < 0) {
                val = 0;
            }
            var finishval = parseFloat(val);
            var real_val = finishval + 5;
            $('#dC').css("background-color", "lightgrey");
            $('#fC').css("background-color", "")
            $("#dC").val(real_val);
        });
    });
</script>