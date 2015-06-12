<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/12
 * Time: 23:59
 */
session_start();
require ('connect.php');
if(isset($_POST['login-submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from user_simple where username = '$username' and passwd = '$password'";
    $query = mysql_query($sql);
    $row_num = mysql_num_rows($query);
    if(!$row_num){
        //no match info
        ?>
        <script>
            alert("用户名或密码错误！");
            location.href = "login.html";
        </script>
        <?php
    }
    else{//register u_id and username into session
        $row = mysql_fetch_array($query);
        $_SESSION['u_id'] = $row['u_id'];
        $_SESSION['username'] = $row['username'];
        header("Location:index.php");
    }
}
?>