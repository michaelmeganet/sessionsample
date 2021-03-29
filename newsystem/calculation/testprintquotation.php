<?php
include_once '../class/dbh.inc.php';
include_once '../class/variables.inc.php';
#echo str_replace(basename((__DIR__)),'',(__DIR__));
$curURL = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
#$baseurl = str_replace(basename((__DIR__)), '', (__DIR__));
$baseurl = str_replace(basename((__DIR__)), '', $curURL);
#echo $baseurl;
if (($_GET['print'] == 'quotation')) {
    $bid = $_GET['bid'];
    $com = trim(strtolower($_GET['com']));
    $period = trim($_GET['post_period']);
    $cid = trim($_GET['post_cid']);
    $quono = trim($_GET['quono']);

    function get_BranchData($bid) {
        $qr = "SELECT * FROM branch WHERE bid = $bid";
        $objSQL = new SQL($qr);
        $detailBranch = $objSQL->getResultOneRowArray();
        return $detailBranch;
    }

    function get_CustomerData($com, $period, $cid) {
        $customertab = 'customer_' . $com;
        $qr = "SELECT * FROM $customertab WHERE cid = $cid";
        $objSQL = new SQL($qr);
        $detailCustomer = $objSQL->getResultOneRowArray();
        return $detailCustomer;
    }

    function get_AdminData($aid) {
        $qr = "SELECT * FROM admin WHERE aid = $aid";
        $objSQL = new SQL($qr);
        $detailAdmin = $objSQL->getResultOneRowArray();
        return $detailAdmin;
    }

    function get_CurrencyData($currencyid) {
        $qr = "SELECT * FROM currency WHERE cid = $currencyid";
        //echo "\$qr = $qr  <br>";
        $objSQL = new SQL($qr);
        $detailCurrency = $objSQL->getResultOneRowArray();
        return $detailCurrency;
    }

    function get_QuotationData($com, $period, $quono, $cid, $bid, $currencyid) {
        $quotab = 'quotationnew_' . $com . '_' . $period;
        $qr = "SELECT * FROM $quotab WHERE quono = '$quono' AND cid = '$cid' AND bid ='$bid' AND currency = '$currencyid' ORDER BY qid ASC";
        $objSQL = new SQL($qr);
        $array_QuotationData = $objSQL->getResultRowArray();
        return $array_QuotationData;
    }

    function get_QuotationRemarks($com, $period, $quono, $cid, $bid) {
        $quoremtab = 'quotation_remarks_' . $com . '_' . $period;
        $qr = "SELECT * FROM $quoremtab WHERE quono = '$quono' AND cid = '$cid' AND bid = '$bid'";
        #echo $qr . "<br>";
        $objSQL = new SQL($qr);
        $detailQuoRem = $objSQL->getResultOneRowArray();
        return $detailQuoRem;
    }

    function get_MaterialData($materialcode) {
        $qr = "SELECT * FROM material2020 WHERE materialcode = '$materialcode'";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        return $result;
    }

    function get_ProcessData($pmid) {
        $qr = "SELECT * FROM premachining WHERE pmid = $pmid";
        $objSQL = new SQL($qr);
        $result = $objSQL->getResultOneRowArray();
        return $result;
    }

    function get_QuotationPriceData($com, $period, $cid, $bid, $quono) {
        $quotab = 'quotationnew_' . $com . '_' . $period;
        $qr = "SELECT "
                . " (SUM(amountmat) + SUM(amountpmach) + SUM(amountcncmach) + SUM(amountother)) as sum_amount,"
                . " (SUM(discountmat) + SUM(discountpmach) + SUM(discountcncmach) + SUM(discountother)) as sum_discount,"
                . " (SUM(gstmat) + SUM(gstpmach) + SUM(gstcncmach) + SUM(gstother)) as sum_gst"
                . " FROM $quotab WHERE quono = '$quono' AND cid = '$cid' AND bid = '$bid'";
        #echo "$qr";
        $objSQL = new SQL($qr);
        $priceResults = $objSQL->getResultOneRowArray();
        return $priceResults;
    }

    function get_signatureQuoApp($salescorname, $baseurl) {
        $salescorname = trim($salescorname);
        switch ($salescorname) {
            case 'Ms Chai':
                $salescorSignature = '<img src="' . $baseurl . 'images/chaiyatyun.png" width="80" height="102" />';
                break;
            case 'Mr Choo':
                $salescorSignature = '<img src="' . $baseurl . 'images/chooteanfoo.png" width="179" height="80" />';
                break;
            default:
                $salescorSignature = '';
                break;
        }
        return $salescorSignature;
    }

    function get_Signature($aid_quo, $baseurl) {
        switch ($aid_quo) {
            case 4:
                $signature = '<img src="' . $baseurl . 'images/chaiyatyun.png" width="80" height="102" />';
                break;
            case 5:
                $signature = '<img src="' . $baseurl . 'images/lowseeking.png" width="80" height="83" />';
                break;
            case 118:
                $signature = '<img src="' . $baseurl . 'images/hazaizzrinda.png" width="150" height="100" />';
                break;
            case 3:
                $signature = '<img src="' . $baseurl . 'images/leongsoofun.png" width="44" height="150" />';
                break;
            case 49:
                $signature = '<img src="' . $baseurl . 'images/noorkastina.png" width="100" height="75" />';
                break;
            case 134:
                $signature = '<img src="' . $baseurl . 'images/wani.png" width="100" height="75" />';
                break;
            case 136:
                $signature = '<img src="' . $baseurl . 'images/nurhidayah.png" width="100" height="75" />';
                break;
            case 144:
                $signature = '<img src="' . $baseurl . 'images/soleha.png" width="100" height="75" />';
                break;
            case 120:
                $signature = '<img src="' . $baseurl . 'images/naily.png" width="200" height="55" />';
                break;
            case 12:
                $signature = '<img src="' . $baseurl . 'images/chooteanfoo.png" width="179" height="80" />';
                break;
            case 75:
                $signature = '<img src="' . $baseurl . 'images/fionhong.png" width="122" height="80" />';
                break;
            case 133:
                $signature = '<img src="' . $baseurl . 'images/nisa.png" width="90" height="50" />';
                break;
            case 93:
                $signature = '<img src="' . $baseurl . 'images/esther.png" width="81" height="120" />';
                break;
            default:
                $signature = '';
                break;
        }
        return $signature;
    }

    //get branch datas
    $detailBranch = get_BranchData($bid);
    $branchname = $detailBranch['branchname'];
    $branchaddress = $detailBranch['address'];
    $branchphone = $detailBranch['telephone'];
    $branchfax = $detailBranch['fax'];
    $salescorname = $detailBranch['approvedby_quo'];
    $salescorposition = $detailBranch['approvedbyposition_quo'];
    $salesccquo = $detailBranch['cc_quo'];

    //get customer datas
    $detailCustomer = get_CustomerData($com, $period, $cid);
    $customername = $detailCustomer['co_name'];
    $customerco_no = $detailCustomer['co_no'];
    $cus_adr1 = $detailCustomer['address1'];
    $cus_adr2 = $detailCustomer['address2'];
    $cus_adr3 = $detailCustomer['address3'];
    $cus_phone = $detailCustomer['telephone_sales'];
    $cus_fax = $detailCustomer['fax_sales'];
    $cus_attn = $detailCustomer['attn_sales'];
    $cus_aid = $detailCustomer['aid_cus'];
    $cus_terms = $detailCustomer['terms'];
    $cus_currencyid = $detailCustomer['currency'];
    // echo "print_r(\$detailCustomer) <br>";
    // print_r($detailCustomer);
    // echo "<br>";
    //get salesadmin datas
    $detailAdminSales = get_AdminData($cus_aid);
    $admin_salesname = $detailAdminSales['name'];

    //get currency datas
    $detailCurrency = get_CurrencyData($cus_currencyid);
    // echo "print_r(\$detailCurrency) <br>";
    // print_r($detailCurrency);
    // echo "<br>";
    // if(isset($detailCurrency)){
    //     if(!empty($detailCurrency)){
    $ccr_symbol = $detailCurrency['currencysymbol'];
    $ccr_decimal = $detailCurrency['decimalsymbol'];
    $ccr_comma = $detailCurrency['commasymbol'];
    $ccr_centsincluded = $detailCurrency['centsincluded'];
    $ccr_havegst = $detailCurrency['havegst'];
    $ccr_gstname = $detailCurrency['gstname'];
    $ccr_gstpercent = $detailCurrency['gstpercent'];
    $ccr_havevat = $detailCurrency['havevat'];
    $ccr_vatname = $detailCurrency['vatname'];
    $ccr_vatpercent = $detailCurrency['vatpercent'];
    //     }
    // }
    //get quotation array by quono
    $array_QuotationData = get_QuotationData($com, $period, $quono, $cid, $bid, $cus_currencyid);
    $quotation_aidquo = $array_QuotationData[0]['aid_quo'];

    //get quotation admin datas
    $detailAdminQuo = get_AdminData($quotation_aidquo);
    $admin_QuoAdminName = $detailAdminQuo['name'];
    $admin_QuoAdminPos = $detailAdminQuo['position'];

    //get quotation remarks
    $detailQuoRem = get_QuotationRemarks($com, $period, $quono, $cid, $bid);
    #print_r($detailQuoRem);
    if (!empty($detailQuoRem)) {
        $quo_Remarks1 = $detailQuoRem['remarks1'];
        $quo_Remarks2 = $detailQuoRem['remarks2'];
        $quo_Remarks3 = $detailQuoRem['remarks3'];
        $quo_Remarks4 = $detailQuoRem['remarks4'];
    } else {
        $quo_Remarks1 = '';
        $quo_Remarks2 = '';
        $quo_Remarks3 = '';
        $quo_Remarks4 = '';
    }
    //get quotation price datas
    $detailPrices = get_QuotationPriceData($com, $period, $cid, $bid, $quono);
    $sum_amount = $detailPrices['sum_amount'];
    $sum_discount = $detailPrices['sum_discount'];
    $sum_gst = $detailPrices['sum_gst'];
    $total_pregst = $sum_amount - $sum_discount;
    $total_postgst = $total_pregst + $sum_gst;

    //get signature salescor
    $salescorsignature = get_signatureQuoApp($salescorname, $baseurl);
    debug_to_console('Sales cor signature = ' . $salescorsignature);

    //Get signature div
    $signaturediv = get_Signature($quotation_aidquo, $baseurl);

    #print_r($detailPrices);
    #echo "sum amount = $sum_amount<br>";
    #echo "sum discount = $sum_discount<br>";
    #echo "sum gst = $sum_gst<br>";
    #echo "total preGST = $total_pregst<br>";
    #echo "total postGST = $total_postgst<br>";
    //print area for items data
    $maxitemline = 35; //the maximum amount of items starts from 1
    $currentitemline = 0; //the startingitem line to count
    $itemscount = 0; //thecounter of items
    $arrayCount_QuotationData = count($array_QuotationData); //amount of items in quono
    #echo "number of items = $arrayCount_QuotationData<br>";
    $currentitemno = 0; // currently processed itemno
    foreach ($array_QuotationData as $row_QuotationData) {
        $itemscount++; //adds 1 line to count for an item
        $depceil = ceil(strlen($row_QuotationData['dim_desp']) / 25);
        #echo "itemscount = $itemscount, descriptionrow = $depceil<br>";
        if ($depceil > 1) {
            $itemscount += ($depceil - 1);
        }
        if ($row_QuotationData['pmach'] != 0) {
            $itemscount++; //adds 1 line to count for pmach 
        }
        if ($row_QuotationData['cncmach'] != 0) {
            $itemscount++; //adds 1 line to count for cncmach
        }
        if ($row_QuotationData['other'] != 0) {
            $itemscount++;
        }
        $itemscount++; //adds 1 line to space
    }
    $totalpages = ceil($itemscount / $maxitemline);
    #echo "total items = $itemscount<br>";
    #echo "totalpages = $totalpages<br>";
    $excessspace = ($maxitemline * $totalpages) - $itemscount;
    #echo "Total items in $quono; : $arrayCount_QuotationData<br>";
    #echo "Maximum Items per page = $maxitemline<br>";
    #echo "Total of lines needed for this quotation = $itemscount<br>";
    #echo "Total pages needed = $totalpages<br>";
    #echo "Amount of spaces needed after item insert = $excessspace<br>";
}
?>


<head>
    <title><?php echo $quono; ?></title>
    <link href="../includes/printstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
    for ($p = 1; $p <= $totalpages; $p++) {
        debug_to_console("Begin creating page $p");
        if ($p != $totalpages) {
            echo "<div style='page-break-after: always;max-width:2480px;width:100%;'>";
        } else {
            echo "<div style='max-width:2480px;width:100%;'>";
        }
        ?>
    <center>
        <table width="810" cellspacing="0" cellpadding="2" border="1">
            <tbody>
                <tr>
                    <td colspan="12">
                        <table width="100%" cellspacing="0" cellpadding="2" border="0">
                            <tbody>
                                <tr>
                                    <td width="7%" rowspan="4" align="center" valign="top"><img src="<?php echo $baseurl; ?>images/phhlogo.png" width="40" height="29"></td>
                                    <td width="53%"><font style="font-family:'Helvetica'; font-size:17px; font-weight:bold;">PHH SPECIAL STEEL SDN BHD</font> <font style="font-family:'Helvetica'; font-size:9px; font-weight:bold;">(623873-D)</font></td>
                                    <td width="30%" rowspan="4" align="center"><font style="font-family:'Helvetica'; font-size:19px; font-weight:bold;">QUOTATION</font></td>
                                    <td width="10%" rowspan="4" align="center"><font style="font-family:'Helvetica'; font-size:14px;">Rev. 3.0</font></td>
                                </tr>
                                <tr>
                                    <td><font style="font-family:'Helvetica'; font-size:10px;"><?php echo $branchaddress; ?></font></td>
                                </tr>
                                <tr>
                                    <td><font style="font-family:'Helvetica'; font-size:10px;">Tel: <?php echo $branchphone; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: <?php echo $branchfax; ?></font></td>
                                </tr>
                                <tr>
                                    <td><font style="font-family:'Helvetica'; font-size:10px;">GST ID No: 000775045120</font></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="12">
                        <table width="100%" cellspacing="0" cellpadding="2" border="0">

                            <tbody>
                                <tr>
                                    <td width="6%" valign="top">To</td>
                                    <td width="2%" valign="top">:</td>
                                    <td width="59%" colspan="4" valign="top"><?php echo "$customername ($customerco_no)"; ?></td>
                                    <td width="6%" valign="top">No</td>
                                    <td width="2%" valign="top">:</td>
                                    <td width="25%" valign="top"><?php echo $quono; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">&nbsp;</td>
                                    <td colspan="4" valign="top"><?php
                                        echo "$cus_adr1";
                                        echo (isset($cus_adr2)) ? ", $cus_adr2" : "";
                                        ?></td>
                                    <td valign="top">Date</td>
                                    <td valign="top">:</td>
                                    <td valign="top"><?php echo date_format(date_create($array_QuotationData[0]['date']), 'd-m-Y'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">&nbsp;</td>
                                    <td colspan="4" valign="top"><?php echo $cus_adr3 ?></td>
                                    <td valign="top">Terms</td>
                                    <td valign="top">:</td>
                                    <td valign="top"><?php echo $cus_terms; ?></td>
                                </tr>
                                <tr>
                                    <td valign="top">Attn</td>
                                    <td valign="top">:</td>
                                    <td colspan="4" valign="top"><?php echo $cus_attn; ?></td>
                                    <td valign="top">Page</td>
                                    <td valign="top">:</td>
                                    <td valign="top">Page <?php echo $p . " of " . $totalpages; ?></td>
                                </tr>
                                <tr>
                                    <td valign="top">Tel No</td>
                                    <td valign="top">:</td>
                                    <td valign="top" width="25%"><?php echo $cus_phone; ?></td>
                                    <td valign="top" width="6%">Fax No</td>
                                    <td valign="top" width="2%">:</td>
                                    <td valign="top" width="26%"><?php echo $cus_fax; ?></td>
                                    <td valign="top">CC</td>
                                    <td valign="top">:</td>
                                    <td valign="top"><?php echo $admin_salesname; ?>            <input type="hidden" name="sid" id="sid" value="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td width="2%"  rowspan="1" align="center" style="font-size:10px">Item</td>
                    <td width="19%" rowspan="1" align="center">Grade</td>
                    <td width="7%" rowspan="1" align="center">Shape<br>Code</td>
                    <td width="18%" rowspan='1' colspan="3" align="center">
                        <?php
                        if ($array_QuotationData[0]['specialShapeOrder'] == 'TRADE') {
                            echo "Description";
                        } else {
                            echo "Dimension (mm)";
                        }
                        ?>
                    </td>
                    <td width="2%"  rowspan="1" align="center">Qty</td>
                    <td width="9%" rowspan="1" align="center">Unit Price<br>(<?php echo $ccr_symbol; ?>)</td>
                    <td width="9%" rowspan="1" align="center">Amount<br>(<?php echo $ccr_symbol; ?>)</td>
                    <td width="8%"  rowspan="1" align="center">Discount<br>(<?php echo $ccr_symbol; ?>)</td>
                    <td width="8%"  rowspan="1" align="center"><?php echo $ccr_gstname; ?> <?php echo $ccr_gstpercent * 1; ?>%<br>(<?php echo $ccr_symbol; ?>)</td>
                    <td width="8%" rowspan="1" align="center">Total Amount<br>(<?php echo $ccr_symbol; ?>)</td>
                </tr>
                <!--
                <tr>
                    <td width="6%" align="center">T / Ø</td>
                    <td width="8%" align="center">W</td>
                    <td width="6%" align="center">L</td>
                </tr>
                -->
                <!--Items Area-->
                <?php
                $curline = $currentitemline; //starting itemline
                //do for loop for amount of items in array_QuotationData
                #echo "currentitemno = $currentitemno<br>";
                for ($n = $currentitemno; $n <= $arrayCount_QuotationData - 1; $n++) {
                    $setline = 1;
                    $materialcode = $array_QuotationData[$n]['grade'];
                    $materialData = get_MaterialData($materialcode);
                    $materialname = $materialData['material'];
                    $pagetype = $array_QuotationData[$n]['pagetype'];
                    if ($pagetype == 'normal') {
                        $mat_ext_txt = "[N]";
                    } elseif ($pagetype == 'free') {
                        $mat_ext_txt = "[F]";
                    } else {
                        $mat_ext_txt = "";
                    }
                    if ($array_QuotationData[$n]['pmach'] != 0) {
                        $setline++;
                        $pmid = $array_QuotationData[$n]['process'];
                        $processData = get_ProcessData($pmid);
                        $processname = $processData['process'];
                        $addPmachLine = true;
                    }
                    if ($array_QuotationData[$n]['cncmach'] != 0) {
                        $setline++;
                        $addCNCLine = true;
                    }
                    if ($array_QuotationData[$n]['other'] != 0) {
                        $setline++;
                        $addOtherLine = true;
                    }
                    $setline++; //addvalue for spaces
                    $curline += $setline;
                    debug_to_console("Current Item ====== $n");
                    debug_to_console("Current curline ===== $curline");
                    $maxdimensionlen = 25;
                    $dimensionlen = strlen($array_QuotationData[$n]['dim_desp']);
                    #echo $dimensionlen."<br>";
                    debug_to_console("dimension length = $dimensionlen\n");
                    $dimensionlen_count = ceil($dimensionlen / $maxdimensionlen);

                    debug_to_console("\$curline = $curline");
                    //check if curline exceeds maximum space or not
                    if ($curline > $maxitemline) {
                        debug_to_console("curline exceeds maxitemline ($curline > $maxitemline)");
                        //written item would exceeds page size
                        //Stop current process, and continue on next page
                        $currentitemno = $n; //get the current working itemno, put it on other page later.
                        //begin loop to fill spaces
                        for ($s = 0; $s <= ($maxitemline - ($curline - $setline)) - 1; $s++) {
                            debug_to_console("loop for in maxitemline exceeds " . floatval($maxitemline - ($curline - $maxitemline)) . "");
                            ?>

                            <tr>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline" style="border-right-style:none">&nbsp;</td>
                                <td class="topbottomnoline" style="border-right-style: none;border-left-style: none">&nbsp;</td>
                                <td class="topbottomnoline" style="border-left-style: none">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                                <td class="topbottomnoline">&nbsp;</td>
                            </tr>
                            <?php
                        }
                        break 1;
                    } else { //write the necessary datas for each row
                        #echo $dimensionlen_count . "<br>";
                        for ($z = 0; $z < $dimensionlen_count; $z++) {
                            $dim_desc_text = substr($array_QuotationData[$n]['dim_desp'], $z * $maxdimensionlen, $maxdimensionlen);
                            #$finishing_dim_desc_text = substr($array_QuotationData[$n]['finishing_dim_desp'], $z * $maxdimensionlen, $maxdimensionlen);

                            if ($z > 0) {
                                $curline++;

                                echo "<tr>
                                    <td class='topbottomnoline smalltext' align='center'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='left'></td>
                                    <td class='topbottomnoline smalltext' align='left'>" . "</td>
                                    <!--<td class='topbottomnoline' align='left'>" . "</td>
                                    <td class='topbottomnoline' align='left'>" . "</td>
                                    <td class='topbottomnoline' align='left'>" . "</td>-->
                                    <td class='topbottomnoline smalltext' colspan='3'>" . $dim_desc_text . "</td>

                                    <td class='topbottomnoline smalltext' align='center'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                </tr>";
                            } else {
                                echo "<tr>
                                    <td class='topbottomnoline smalltext' align='center'>" . $array_QuotationData[$n]['item'] . "</td>
                                    <td class='topbottomnoline smalltext' align='left'>$materialname&nbsp;$mat_ext_txt</td>
                                    <td class='topbottomnoline smalltext' align='left'>" . $array_QuotationData[$n]['specialShapeOrder'] . "</td>
                                    <!--<td class='topbottomnoline' align='left'>" . $array_QuotationData[$n]['mdt'] . "</td>
                                    <td class='topbottomnoline' align='left'>" . $array_QuotationData[$n]['mdw'] . "</td>
                                    <td class='topbottomnoline' align='left'>" . $array_QuotationData[$n]['mdl'] . "</td>-->
                                    <td class='topbottomnoline smalltext' colspan='3'>" . $dim_desc_text . "</td>

                                    <td class='topbottomnoline smalltext' align='center'>" . $array_QuotationData[$n]['quantity'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['mat'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['amountmat'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['discountmat'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['gstmat'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['totalamountmat'] . "</td>
                                </tr>";
                            }
                        }
                        if (isset($addPmachLine)) {
                            for ($z = 0; $z < $dimensionlen_count; $z++) {
                                # $dim_desc_text = substr($array_QuotationData[$n]['dim_desp'], $z * $maxdimensionlen, $maxdimensionlen);
                                $finishing_dim_desc_text = substr($array_QuotationData[$n]['finishing_dim_desp'], $z * $maxdimensionlen, $maxdimensionlen);

                                if ($z > 0) {
                                    $curline++;
                                    echo "<tr>
                                            <td class='topbottomnoline smalltext' align='left'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='left'></td>
                                            <td class='topbottomnoline smalltext' align='left'>" . "</td>
                                            <!--<td class='topbottomnoline' align='left'>" . "</td>
                                            <td class='topbottomnoline' align='left'>" . "</td>
                                            <td class='topbottomnoline' align='left'>" . "</td>-->
                                            <td class='topbottomnoline smalltext' colspan='3'>" . $finishing_dim_desc_text . "</td>

                                            <td class='topbottomnoline smalltext' align='center'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . "</td>
                                        </tr>";
                                } else {
                                    echo "<tr>
                                            <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                            <td class='topbottomnoline smalltext' align='left'>$processname</td>                                                
                                            <td class='topbottomnoline smalltext' align='left'>" . "</td>
                                            <!--<td class='topbottomnoline smalltext' align='left'>" . $array_QuotationData[$n]['fdt'] . "</td>
                                            <td class='topbottomnoline smalltext' align='left'>" . $array_QuotationData[$n]['fdw'] . "</td>
                                            <td class='topbottomnoline smalltext' align='left'>" . $array_QuotationData[$n]['fdl'] . "</td>-->
                                            <td class='topbottomnoline smalltext' colspan='3'>" . $finishing_dim_desc_text . "</td>
                                            <td class='topbottomnoline smalltext' align='center'>&nbsp;</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['pmach'] . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['amountpmach'] . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['discountpmach'] . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['gstpmach'] . "</td>
                                            <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['totalamountpmach'] . "</td>
                                        </tr>";
                                }
                            }
                            unset($addPmachLine);
                        }
                        if (isset($addCNCLine)) {
                            echo "<tr>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>CNC Machining</td>                                    
                                    <td class='topbottomnoline smalltext' align='left'>" . "</td>
                                    <!--<td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>-->
                                    <td class='topbottomnoline smalltext' colspan='3'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='center'>" . $array_QuotationData[$n]['quantity'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['cncmach'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['amountcncmach'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['discountcncmach'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['gstcncmach'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['totalamountcncmach'] . "</td>
                                </tr>";
                            unset($addCNCLine);
                        }
                        if (isset($addOtherLine)) {
                            echo "<tr>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>Other Costs</td>                                    
                                    <td class='topbottomnoline smalltext'>" . "</td>
                                    <!--<td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>
                                    <td class='topbottomnoline smalltext' align='left'>&nbsp;</td>-->
                                    <td class='topbottomnoline smalltext' colspan='3'>" . "</td>
                                    <td class='topbottomnoline smalltext' align='center'>" . $array_QuotationData[$n]['quantity'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['other'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['amountother'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['discountother'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['gstother'] . "</td>
                                    <td class='topbottomnoline smalltext' align='right'>" . $array_QuotationData[$n]['totalamountother'] . "</td>
                                </tr>";
                            unset($addOtherLine);
                        }

                        debug_to_console('Create a space')
                        ?>
                        <tr>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline" style="border-right-style:none">&nbsp;</td>
                            <td class="topbottomnoline" style="border-right-style: none;border-left-style: none">&nbsp;</td>
                            <td class="topbottomnoline" style="border-left-style: none">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                        </tr>
                        <?php
                    }
                }
                if ($curline < $maxitemline) {
                    for ($t = 0; $t <= ($maxitemline - $curline) - 1; $t++) {
                        ?>
                        <tr>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline" style="border-right-style:none">&nbsp;</td>
                            <td class="topbottomnoline" style="border-right-style: none;border-left-style: none">&nbsp;</td>
                            <td class="topbottomnoline" style="border-left-style: none">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                            <td class="topbottomnoline">&nbsp;</td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <!--End Items Area-->
                <tr>
                    <td colspan="8" valign="top">&nbsp;Terms &amp; Conditions:-<br>
                        &nbsp;1) Price validity : 3 days or subject to change without further Notice.<br>
                        &nbsp;2) Ex-stock subject to prior sales.<br>
                        &nbsp;3) N : Nearest equivalent grade without prejudice for reference only.
                    </td>
                    <td colspan="3" align="right">Subtotal (Excluding GST)&nbsp;<br>
                        Total Discount&nbsp;<br>
                        Total (Excluding GST)&nbsp;<br>
                        GST Payable @ 0%&nbsp;<br>
                        <strong>Total (Inclusive GST)</strong>&nbsp;
                    </td>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody><tr>
                                    <td align="right"><?php echo ($p == $totalpages) ? number_format($sum_amount, 2, $ccr_decimal, $ccr_comma) : ''; ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right" class="bottomsolidline"><?php echo ($p == $totalpages) ? number_format($sum_discount, 2, $ccr_decimal, $ccr_comma) : ''; ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right"><?php echo ($p == $totalpages) ? number_format($total_pregst, 2, $ccr_decimal, $ccr_comma) : ''; ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right" class="bottomsolidline"><?php echo ($p == $totalpages) ? number_format($sum_gst, 2, $ccr_decimal, $ccr_comma) : ''; ?>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="right"><strong><?php echo ($p == $totalpages) ? number_format($total_postgst, 2, $ccr_decimal, $ccr_comma) : ''; ?></strong>&nbsp;</td>
                                </tr>
                            </tbody></table>
                    </td>
                </tr>

                <tr>
                    <td colspan="12">&nbsp;<strong>Remarks:-</strong><br>
                        &nbsp;1) <?php echo $quo_Remarks1; ?><br>
                        &nbsp;2) <?php echo $quo_Remarks2; ?><br>
                        &nbsp;3) <?php echo $quo_Remarks3; ?><br>
                        &nbsp;4) <?php echo $quo_Remarks4; ?>    </td>
                </tr>
                <tr>
                    <td colspan="9" valign="top">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody><tr>
                                    <td colspan="6"><strong>For office use only</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="15%">Issued by:-</td>
                                    <td width="30%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                    <td width="15%">Appproved by:-</td>
                                    <td width="30%">&nbsp;</td>
                                    <td width="5%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>


                            <div style="position:absolute; padding:10px 0px 0px 100px;">
                                <?php echo $signaturediv; //inputs signature;    ?>
                            </div>
                            <div style="position:absolute; padding:10px 0px 0px 350px;">
                                <?php echo $salescorsignature; //sales cor signature    ?>
                            </div>

                            <tr>
                                <td colspan="2" class="bottomdotline">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="2" class="bottomdotline">&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <td><?php echo $admin_QuoAdminName; ?></td>
                                <td>&nbsp;</td>
                                <td>Name:</td>
                                <td><?php echo $salescorname; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Position:</td>
                                <td><?php echo $admin_QuoAdminPos; ?></td>
                                <td>&nbsp;</td>
                                <td>Postion:</td>
                                <td><?php echo $salescorposition; ?> </td>
                                <td>&nbsp;</td>
                            </tr>
            </tbody></table>
    </td>
    <td colspan="3" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td width="5%">&nbsp;</td>
                    <td width="90%"><strong>Confirmed and accepted by:</strong></td>
                    <td width="5%">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="bottomdotline">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Customer Co's Stamp &amp; Signature</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
            </tbody></table>
    </td>
    </tr>
    </tbody>
    </table>

    <table width="810" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
                <td height="10">&nbsp;</td>
            </tr>
        </tbody></table>

    </center>
    <?php
    echo "</div>";
}
?>
