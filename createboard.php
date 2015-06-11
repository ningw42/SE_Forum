<?php
/**
 * Created by PhpStorm.
 * User: Henry
 * Date: 2015/6/11
 * Time: 19:22
 */

include('connect.php');

if(isset($_POST['sub'])){
    if(!empty($_POST['name']) && !empty($_POST['description'])){
        $id=$_GET['id'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $sql="SELECT `b_name` FROM `forum_board`";
        $query = mysql_query($sql);
        $exist = 0;

        while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
            if($row['b_name']==$name){
                $exist = 1;
                echo "<script>alert('该版块名已存在!');location.href='boardmanagement.php'</script>";

            }
        }
        if(!$exist){
            $sql="INSERT INTO `forum_board` VALUES (" . $id . ",'" . $name . "','" . $description . "',0);";
//            echo $sql;
            mysql_query($sql);
            echo "<script>alert('新建成功!');location.href='boardmanagement.php'</script>";
        }
    }
    else{
        echo "<script>alert('请输入版块名或版块简介！');location.href='boardmanagement.php'</script>";
    }
}

?>