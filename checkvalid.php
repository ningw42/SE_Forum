<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/13
 * Time: 18:27
 */
session_start();
if(!isset($_SESSION['u_id'])){
    ?>
    <script>
        alert("请先登录！");
        location.href = "login.html";
    </script>
<?php
}