<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/14/2015
 * Time: 1:06 PM
 */
Session_start();
include("connect.php");

$attr = "";
$error = 0;
// echo !$_POST['gender']."\n";
if (!$_POST['gender']) {
    $error ++;
} else {
    if ($_POST['gender'] == '1') {
        $gender = 'M';
    } else if ($_POST['gender'] == '2') {
        $gender = 'F';
    }
    $attr .= ("gender='".(trim($gender)."',"));
}
if (!$_POST['phone']) {
    $error += 2;
} else {
    $attr .= ("phone='".trim($_POST['phone'])."',");
}
if (!$_POST['description']) {
    $error += 4;
} else {
    $attr .= ("description='".trim($_POST['description'])."',");
}
if (!$_POST['email']) {
    $error += 8;
} else {
    $attr .= ("email='".trim($_POST['email'])."',");
}

$attr = substr($attr, 0, -1);



if (!trim($attr)) {
    echo "unchaged";
} else {
    $r1 = mysql_query("UPDATE user_details SET ".$attr." WHERE u_id = ".$_SESSION['u_id']);
//    echo "UPDATE user_details SET ".$attr." WHERE u_id = ".$_SESSION['u_id'];
    if ($r1) {
        echo "success";
    } else {
        echo "failure";
    }
}

mysql_close();