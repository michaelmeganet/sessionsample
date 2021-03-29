<?php

session_start();
include_once '../class/dbh.inc.php';
include_once '../class/variables.inc.php';

$received_data = json_decode(file_get_contents("php://input"));
$data = array();
$action = $received_data->action;

//echo "TEST";

function validateLogin($username, $password) {
    $pwMD5 = md5($password);
    $qrAdmin = "SELECT * FROM admin WHERE username = '$username' AND password = '$pwMD5'";
    $objSQLadmin = new SQL($qrAdmin);
    $adminresult = $objSQLadmin->getResultOneRowArray();
    $resultarr = array();
    if (!empty($adminresult)) {
        $status = $adminresult['status'];
        if ($status == 'active') {
            $resultarr['status'] = 'ok';
            $resultarr['detail'] = $adminresult;
        } elseif ($status == 'disabled') {
            $resultarr['status'] = 'fail';
            $resultarr['admin_status'] = $status;
            $resultarr['msg'] = 'User status is disabled!';
        } elseif ($status == 'deleted') {
            $resultarr['status'] = 'fail';
            $resultarr['admin_status'] = $status;
            $resultarr['msg'] = 'User status is deleted!';
        } else {
            $resultarr['status'] = 'fail';
            $resultarr['admin_status'] = $status;
            $resultarr['msg'] = 'Cannot read user status!, Contact Administrator!';
        }
    } else {
        $resultarr['status'] = 'fail';
        $resultarr['admin_status'] = 'wrong';
        $resultarr['msg'] = 'Username or Password is incorrect!';
    }
//    print_r($resultarr);
    return $resultarr;
}

function recordToAdminFail($username, $password, $ip, $status) {
    $tab = "admin_fail";
    $qr = "INSERT INTO $tab SET "
            . "username = '$username', "
            . "password = '$password', "
            . "ip = '$ip' ,"
            . "date_time = NOW(), "
            . "status = '$status' ";
    $objSQL = new SQL($qr);
    $insertResult = $objSQL->InsertData();
    #echo "qr = $qr\n\n";

    if ($insertResult == 'insert ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

function recordToAdminFailLive($username, $password, $ip, $status, $operation, $serverpath, $remark) {
    $tab = "admin_fail_live";
    $qr = "INSERT INTO $tab SET "
            . "username = '$username', "
            . "password = '$password', "
            . "ip = '$ip' ,"
            . "date_time = NOW(), "
            . "status = '$status', "
            . "OPERATION = '$operation', "
            . "`SERVER_PATH` = '$serverpath', "
            . "REMARK = '$remark' ";
    $objSQL = new SQL($qr);
//    echo "qr = $qr\n\n";
    $insertResult = $objSQL->InsertData();
    if ($insertResult == 'insert ok!') {
        return 'ok';
    } else {
        return 'fail';
    }
}

switch ($action) {
    case 'doLogin':
//        echo"test";
        $username = $received_data->username;
        $password = $received_data->password;
        try {
            $validateResult = validateLogin($username, $password);
            if ($validateResult['status'] == 'fail') {
                //LOGIN FAILED,
                //insert into admin_fail
                $ip = $_SERVER['REMOTE_ADDR'];
                $status = $validateResult['admin_status'];
                $RTAFResult = recordToAdminFail($username, $password, $ip, $status);
//                echo "result = $RTAFResult\n";

                throw new Exception($validateResult['msg']);
            } else {
                $loginResult = $validateResult['detail'];
//                print_r($validateResult);
                //LOGIN SUCCESS
                //BEGIN PULLING DATASET
                $login_time = date('Y-m-d H:i:s');

                $login_aid = $loginResult['aid'];
//                echo "\$login_aid = $login_aid\n";
                $login_name = $loginResult['name'];
//                echo "\$login_name = $login_name\n";
                $login_position = $loginResult['position'];
//                echo "\$login_position = $login_position\n";
                $login_branch = $loginResult['branch'];
//                echo "\$login_branch = $login_branch\n";
                $login_currency = $loginResult['currency'];
//                echo "\$login_currency = $login_currency\n";
                $login_canoverride = $loginResult['canoverride'];
//                echo "\$login_canoverride = $login_canoverride\n";
                $login_overridepassword = $loginResult['overridepassword'];
//                echo "\$login_overridepassword = $login_overridepassword\n";
                $login_last_login = $loginResult['last_login'];
//                echo "\$login_last_login = $login_last_login\n";

                $url = $_SERVER['REQUEST_URI']; //returns the current URL
//                echo "*url = $url\n";
                $parts = explode('/', $url);
                $dir = $_SERVER['SERVER_NAME'];
//                echo "*dir = $dir\n";
                for ($i = 0; $i < count($parts) - 1; $i++) {
                    $dir .= $parts[$i] . "/";
                }
//                echo "**dir == $dir\n";
                $ip = $_SERVER['REMOTE_ADDR'];
//                $ipv2 = getenv('REMOTE_ADDR');
//                echo "*ip == $ip\n";
//                echo "*ipv2 == $ipv2\n";
                //BEGIN INPUTTING SESSION VALUES                
                $_SESSION['phhsystem_aid'] = $login_aid;
                $_SESSION['phhsystem_name'] = $login_name;
                $_SESSION['phhsystem_position'] = $login_position;
                $_SESSION['phhsystem_branch'] = $login_branch;
                $_SESSION['phhsystem_currency'] = $login_currency;
                $_SESSION['phhsystem_canoverride'] = $login_canoverride;
                $_SESSION['phhsystem_overridepassword'] = $login_overridepassword;
                $_SESSION['phhsystem_last_login'] = $login_last_login;
                $_SESSION['phhsystem_timeout'] = time();

                $_SESSION['phhsystem_ip'] = $ip;

                //insert into admin_fail
                $AFResult = recordToAdminFail($username, $password, $ip, 'success');
//                echo "AFResult =$AFResult\n";
                //insert into admin_fail_live
                $AFLResult = recordToAdminFailLive($username, $password, $ip, 'Login Success', 'User Login', $dir, '');
//                echo "AFLResult = $AFLResult\n";
                //Update last login 
                $qrUpd = "UPDATE admin SET last_login = NOW() WHERE aid = $login_aid";
                $objSQLupd = new SQL($qrUpd);
                $updReslt = $objSQLupd->getUpdate();
//                echo "qr = $qrUpd\n$updReslt\n";
                $out_arr = array('status' => 'ok');
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $out_arr = array('status' => 'error', 'msg' => $msg);
        }
        echo json_encode($out_arr);
        break;
}


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

