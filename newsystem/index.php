<?php
include_once './session/session.php';

if (isset($_GET['view'])) {
    $view = $_GET['view'];
} else {
    #header('location: index.php');
    $view = null;
}

switch ($view) {
    default: //default is issue orderlist
        #$title = "Job Orders - Issue Orderlist";
        $url = "./message.php";
        $nav = true;
        break;
}
$loginname = $_SESSION['phhsystem_name'];
//echo $_SESSION['phhsystem_timeout'];
?>


<?php include "header.php"; ?>

<body style='padding-bottom:10px'>
    <?php include 'navmenu.php'; ?>
<div class="container" id="mainContainer">
    

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>NEW PHHSYSTEM MAIN PAGE</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="sponsor">
                  <!-- <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom" id="_carbonads_js"></script> -->
                </div>
            </div>
        </div>
    </div>
    <p class='lead'>Welcome, <strong class="text-info" ><?php echo $loginname; ?></strong>.</p>
    <p class='lead'>Select Menu from top to continue.</p>
    <?php include_once $url; ?>
</div>
<?php include "footer.php" ?> 
</body>