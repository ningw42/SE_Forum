<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/13
 * Time: 7:30
 */
require ('connect.php');
session_start();
if(isset($_POST['login-submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "select * from user_simple where username = '$username' and passwd = '$password'";
    $query = mysql_query($sql);
    $row_num = mysql_num_rows($query);
    if(!$row_num){
        //no match info
        echo "<script>alert('用户名或密码错误！');location.href='login.html'</script>";
    }
    else{//register u_id and username into session
        $row = mysql_fetch_array($query);
        $_SESSION['u_id'] = $row['u_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['status'] = $row['status'];
        $result = mysql_query("select * from user_details WHERE u_id=".$row['u_id']);
        $data = mysql_fetch_array($result);

        echo $data['photo'];
        if (!$data['photo']) {
            $_SESSION['avatar'] = $DEFAULT_PHOTO;
        } else {
            $_SESSION['avatar'] = 'userAvatar/'.$data['photo'];
        }

        echo "<script>alert('登录成功!');location.href='index.php#';</script>";
    }
}
?>