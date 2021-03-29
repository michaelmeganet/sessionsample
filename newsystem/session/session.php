<?php

//PHP/HTML SESSION FILE
session_start();

$session_gap = 36000000000;
//$session_gap = 3600;

if (!isset($_SESSION['phhsystem_aid'])) {
    echo "Please login first. You can click <a href=\"login.php\" target=\"_parent\">here</a> to login.";
    exit();
}

if (time() - $_SESSION['phhsystem_timeout'] > $session_gap) {
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

    echo "Your session has expired. Click <a href=\"login.php\" target=\"_parent\">here</a> to login again.";
    exit();
} else {
    $_SESSION['phhsystem_timeout'] = time();
}
?>