<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/14
 * Time: 21:49
 */
require('checkvalid.php');
require('connect.php');

$pid = $_GET['p_id'];
$bid = $_GET['b_id'];
$sql = "delete from posts_topic where p_id = $pid";
$query = mysql_query($sql)
    or die("Error!");

if(isset($_GET['announce'])){
    //header("Location:announcement.php?b_id=$bid");
    ?>
    <script>
        alert("删除成功!");
        location.href = 'announcement.php?b_id=<?php echo $bid?>';
    </script>
    <?php

}
else{
    //header("Location:posts.php?b_id=$bid");
    ?>
    <script>
        alert("删除成功!");
        location.href = 'posts.php?b_id=<?php echo $bid?>';
    </script>
<?php
}
?>

