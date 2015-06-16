<?php header("Content-type:text/html;charset=utf8");?>
<?php
/**
 * Created by PhpStorm.
 * User: Henry
 * Date: 2015/6/16
 * Time: 14:38
 */

include('connect.php');

if(isset($_GET['u_id']) || isset($_GET['currentstatus'])){
    $u_id = $_GET['u_id'];
    $current_status = $_GET['currentstatus'];
    $sql="update `user_simple` set status = " . (1 - $current_status) . " where `u_id` = " . $u_id;
    mysql_query($sql);
    echo "<script>alert('修改成功!');location.href='usermanagement.php'</script>";
}
?>