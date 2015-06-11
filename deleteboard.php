<?php header("Content-type:text/html;charset=utf8");?>
<?php
/**
 * Created by PhpStorm.
 * User: Henry
 * Date: 2015/6/11
 * Time: 19:10
 */

/**
 * delete board by b_id
 * @param $delete_b_id
 */

include('connect.php');

if(isset($_GET['del'])){
    $d=$_GET['del'];
    $sql="delete from `forum_board` where `b_id`='$d'";
    mysql_query($sql);
    echo "<script>alert('删除成功!');location.href='boardmanagement.php'</script>";
}
?>