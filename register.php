<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/12
 * Time: 23:59
 */
require ('connect.php');
session_start();
if(isset($_POST['register-submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "select * from user_simple where username = '$username' ";
    $query = mysql_query($sql);
    $row_num = mysql_num_rows($query);
    if(!$row_num){
        //no match info, ok to register
        $role = 1;   //student register
        $status = 0;  //unbanned
        $sql = "select max(u_id) from user_simple";    //should be related to the basic information
        //!!!!!!!!!!!!!!!!
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        $u_id = $row[0]+1;

        $sql = "insert into user_simple (u_id,username,passwd,role,status) values($u_id,'$username','$password',$role,$status) ";
        $query = mysql_query($sql);

        $sql = "insert into user_details (u_id,email) values($u_id,'$email')";
        $query = mysql_query($sql);

        $_SESSION['u_id'] = $u_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['status'] = $status;
        //echo $_SESSION['username'];
        echo "<script>alert('注册成功！!');location.href='index.php'</script>";
    }else{
        echo "<script>alert('用户名已存在！');location.href='login.html'</script>";
    }
        //header("Location:login.html");
}


if(isset($_POST['register-submit-t'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "select * from user_simple where username = '$username' ";
    $query = mysql_query($sql);
    $row_num = mysql_num_rows($query);
    if(!$row_num){
        //no match info, ok to register
        $role = 2;   //teacher register
        $status = 0;  //unbanned
        $sql = "select max(u_id) from user_simple";    //should be related to the basic information
        //!!!!!!!!!!!!!!!!
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        $u_id = $row[0]+1;

        $sql = "insert into user_simple (u_id,username,passwd,role,status) values($u_id,'$username','$password',$role,$status) ";
        $query = mysql_query($sql);

        $sql = "insert into user_details (u_id,email) values($u_id,'$email')";
        $query = mysql_query($sql);

        $_SESSION['u_id'] = $u_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['status'] = $status;
        //echo $_SESSION['username'];
        echo "<script>alert('注册成功！');location.href='index.php'</script>";
    }
    else{
        echo "<script>alert('用户名已存在！');location.href='login.html'</script>";
    }
}
?>