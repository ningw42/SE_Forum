<?php header("Content-type:text/html;charset=utf8");
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/12
 * Time: 23:59
 */
//require ('connect.php');
session_start();
if(isset($_POST['register-submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sid = $_POST['sid'];
    $flag = false;

    $conn = mysql_connect("10.12.218.56","sibylla","banana");
    mysql_select_db('se', $conn);
    mysql_query("SET NAMES 'utf8'");
    $sqlc = "select student_id from student";
    $queryc = mysql_query($sqlc);

    while($rowc = mysql_fetch_array($queryc)){
        if($rowc['student_id'] == $sid){
            $flag = true;
            break;
        }
    }
    mysql_close($conn);

    if(!$flag){
        ?>
        <script>
            alert("非本校师生无法注册！");
            location.href = "login.html";
        </script>
        <?php
        exit();
    }

    $con = mysql_connect("localhost","root","123456");
    mysql_select_db('forum', $con);
    mysql_query("SET NAMES 'utf8'");
    $DEFAULT_PHOTO = "images/Akari.png";

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

        mysql_query("SET AUTOCOMMIT=0");
        mysql_query("START TRANSACTION");

        $sql = "insert into user_simple (u_id,username,passwd,role,status) values($u_id,'$username','$password',$role,$status) ";
        $query1 = mysql_query($sql);

        $sql = "insert into user_details (u_id) values($u_id)";
        $query2 = mysql_query($sql);

        if ($query1 and $query2) {
            mysql_query("COMMIT");
        } else {
            mysql_query("ROLLBACK");
            mysql_query("SET AUTOCOMMIT=1");
            ?>
            <script>
                alert("注册失败！");location.href='login.html'
            </script>
    <?php
            exit();
        }

        mysql_query("SET AUTOCOMMIT=1");
        $_SESSION['u_id'] = $u_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['status'] = $status;
        $_SESSION['avatar'] = $DEFAULT_PHOTO;
        //echo $_SESSION['username'];
        echo "<script>alert('注册成功！!');location.href='index.php'</script>";
    }else{
        echo "<script>alert('用户名已存在！');location.href='login.html'</script>";
    }
        //header("Location:login.html");
}


if(isset($_POST['register-submit-t'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $tid = $_POST['tid'];
    $flag = false;

    $conn = mysql_connect("10.12.218.56","sibylla","banana");
    mysql_select_db('se', $conn);
    mysql_query("SET NAMES 'utf8'");
    $sqlc = "select teacher_id from teacher";
    $queryc = mysql_query($sqlc);

    while($rowc = mysql_fetch_array($queryc)){
        if($rowc['teacher_id'] == $tid){
            $flag = true;
            break;
        }
    }
    mysql_close($conn);

    if(!$flag){
        ?>
        <script>
            alert("非本校师生无法注册！");
            location.href = "login.html";
        </script>
        <?php
        exit();
    }

    $con = mysql_connect("localhost","root","123456");
    mysql_select_db('forum', $con);
    mysql_query("SET NAMES 'utf8'");
    $DEFAULT_PHOTO = "images/Akari.png";

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

        mysql_query("SET AUTOCOMMIT=0");
        mysql_query("START TRANSACTION");
        $sql = "insert into user_simple (u_id,username,passwd,role,status) values($u_id,'$username','$password',$role,$status) ";
        $query1 = mysql_query($sql);

        $sql = "insert into user_details (u_id) values($u_id)";
        $query2 = mysql_query($sql);

        if ($query1 and $query2) {
            mysql_query("COMMIT");
        } else {
            mysql_query("ROLLBACK");
            mysql_query("SET AUTOCOMMIT=1");
            ?>
            <script>
                alert("注册失败！");location.href='login.html'
            </script>
        <?php
            exit();
        }
        mysql_query("SET AUTOCOMMIT=1");
        $_SESSION['u_id'] = $u_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['status'] = $status;
        $_SESSION['avatar'] = $DEFAULT_PHOTO;
        //echo $_SESSION['username'];
        echo "<script>alert('注册成功！');location.href='index.php'</script>";
    }
    else{
        echo "<script>alert('用户名已存在！');location.href='login.html'</script>";
    }
}
?>