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



if (!$_POST['username'] and !trim($attr)) {
    echo "unchaged";
} else if (!$_POST['username'] and trim($attr)) {
    $r1 = mysql_query("UPDATE user_details SET ".$attr." WHERE u_id = ".$_SESSION['u_id']);
    if ($r1) {
        echo "success";
    } else {
        echo "failure";
    }
} else if ($_POST['username'] and !trim($attr)) {
    $username = trim($_POST['username']);
    $r2 = mysql_query("UPDATE user_simple SET username='$username' WHERE u_id = ".$_SESSION['u_id']);
    if ($r2) {
        echo "success";
        $_SESSION['username'] = $username;
    } else {
        echo "failure";
    }
} else {
    $username = trim($_POST['username']);

    mysql_query("SET AUTOCOMMIT=0");
    mysql_query("START TRANSACTION");

    $r1 = mysql_query("UPDATE user_details SET ".$attr." WHERE u_id = ".$_SESSION['u_id']);
    $r2 = mysql_query("UPDATE user_simple SET username='$username' WHERE u_id = ".$_SESSION['u_id']);

    if ($r1 and $r2) {
        mysql_query("COMMIT");
        $_SESSION['username'] = $username;
        echo "success";
    } else {
        mysql_query("ROLLBACK");
        echo "failure";
    }
    mysql_query("SET AUTOCOMMIT=1");
}

mysql_close();