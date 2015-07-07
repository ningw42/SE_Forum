<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 7/7/2015
 * Time: 10:00 PM
 */

require("connect.php");
session_start();
$userid = $_SESSION['u_id'];
$maxSize = 512*1024;   // 500K大小
if(isset($_FILES['photo'])){
    $attachment = time();      //以当前时间戳作为文件标识符
    if($_FILES["photo"]["size"]<=$maxSize){
        if ($_FILES["photo"]["error"] > 0)
        {
            ?>
            <script>
                alert("上传文件出现错误！");
            </script>

            <?php
            if(isset($_POST['submit'])){
                header('Location:post.php?b_id=$bid');
            }
            else{
                header('Location:announcement.php?b_id=$bid');
            }
        }
        else
        {
            $md5 = hash_file('md5', $_FILES["photo"]["tmp_name"]);
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $newfile = $md5.'.'.$ext;
            if (file_exists("userAvatar/" . $newfile)) {
                // file exist
            }else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "userAvatar/".$newfile);
            }
            $result = mysql_query('UPDATE user_details SET photo=\''.$newfile.'\' WHERE u_id = '.$userid);
//            echo 'UPDATE user_details SET photo=\''.$md5.'\' WHERE u_id = '.$userid;
        }
    }
    else{
        echo "<script>alert('图片大小超过限制')</script>";
    }
}