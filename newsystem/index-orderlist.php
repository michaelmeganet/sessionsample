<?php
include_once './session/session.php';
if (isset($_GET['view'])) {
    $view = $_GET['view'];
} else {
    #header('location: index.php');
    $view = null;
}

switch ($view) {
    case 'col'://Issue Orderlist
        $title = "Job Orders - List Orderlist";
        $url = "./orderlist/ord-crud.php";
        $nav = true;
        break;
    case 'iol'://Issue Orderlist
        $title = "Job Orders - Issue Orderlist";
        $url = "./orderlist/ord-issue.php";
        $nav = true;
        break;
    case 'rol'://Issue Orderlist
        $title = "Job Orders - Revise Orderlist";
        $url = "./orderlist/ord-revisemain.php";
        $nav = true;
        break;
    case 'iolpup': //issue orderlist popup
        $title = "JOB Orders - Issue Orderlist Popup";
        $url = "./orderlist/ord-issuepopup.php";
        $nav = false;
        break;
    case 'vol': //issue orderlist popup
        $title = "JOB Orders - View Orderlist Details";
        $url = "./orderlist/ord-view.php";
        $nav = true;
        break;
    case 'ioldrvs': //issue orderlist popup
        $title = "JOB Orders - Revise Orderlist Popup (Description)";
        $url = "./orderlist/ord-revisedesc.php";
        $nav = false;
        break;
    case 'iolprvs': //issue orderlist popup
        $title = "JOB Orders - Revise Orderlist Popup (Price)";
        $url = "./orderlist/ord-reviseprice.php";
        $nav = false;
        break;
    default: //default is issue orderlist
        $title = "Job Orders - Issue Orderlist";
        $url = "./orderlist/ord-issue.php";
        $nav = true;
        break;
}
?>


<?php include "header.php"; ?>

<body style='padding-bottom:10px'>

    <?php
    if ($nav) {
        include"navmenu.php";
        echo '<div class="container" id="mainContainer"> ';
    } else {
        echo "<div class='container-fluid' id='mainContainer'>";
    }
    ?>

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>JOB ORDERS MENU</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="sponsor">
                  <!-- <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom" id="_carbonads_js"></script> -->
                </div>
            </div>
        </div>
    </div>
    <p class='lead'><?php echo $title; ?></p>
    <?php include_once $url; ?>
</div>
<?php include"footer.php" ?> 
</body>