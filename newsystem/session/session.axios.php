<?php

// AXIOS / AJAX BASED SESSION FILE
session_start();

$session_gap = 36000000000;
//$session_gap = 3600;
//echo time()."\n";
//echo $_SESSION['phhsystem_timeout']."\n";
#print_r($_SESSION);
if (isset($_SESSION['phhsystem_aid'])){
#    echo $_SESSION['phhsystem_aid'];
}
#var_dump($_SESSION['phhsystem_aid']);
if (!isset($_SESSION['phhsystem_aid'])) {
//  echo "Please login first. You can click <a href=\"index.php\" target=\"_parent\">here</a> to login.";
//  exit();
    $out_arr = array('status' => 'error', 'msg' => 'Please login first.');
}elseif (time() - $_SESSION['phhsystem_timeout'] > $session_gap) {
    unset($_SESSION['phhsystem_aid']);
    unset($_SESSION['phhsystem_name']);
    unset($_SESSION['phhsystem_position']);
    unset($_SESSION['phhsystem_branch']);
    unset($_SESSION['phhsystem_currency']);
    unset($_SESSION['phhsystem_canoverride']);
    unset($_SESSION['phhsystem_overridepassword']);
    unset($_SESSION['phhsystem_ip']);
    unset($_SESSION['phhsystem_last_login']);
    unset($_SESSION['phhsystem_timeout']);
//  echo "Your session has expired. Click <a href=\"index.php\" target=\"_parent\">here</a> to login again.";
//  exit();
    $out_arr = array('status' => 'error', 'msg' => 'Your session has expired, please login again.');
} else {
    $out_arr = array('status' => 'ok', 'msg' => 'Session still accepted','curtime' => time(), 'timeout' => $_SESSION['phhsystem_timeout']);
    $_SESSION['phhsystem_timeout'] = time();
}
echo json_encode($out_arr);
?>