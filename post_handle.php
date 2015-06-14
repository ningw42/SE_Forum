<?php
//handle form
require("connect.php");
$bid = $_GET['b_id'];
session_start();
if(isset($_POST['submit'])){ //普通帖子
   // $author_id = 1;
    //$author = "Curry";//should fetch value from session

    $author_id = $_SESSION['u_id'];
    $author = $_SESSION['username'];
    $is_announcement = 0;   //not announcement
    $title = $_POST['title'];
    $content = $_POST['content'];
   // echo $title."<br>";
    //echo $content."<br>";
    $attachment = -1;

    $sql = "select max(p_id) from posts_topic";
    $query = mysql_query($sql)
        or die("Error1!");
    $row = mysql_fetch_array($query);
    $pid = $row[0]+1;
    //echo $pid;
    $sql = "insert into posts_topic (p_id,title,author_id,author,board_id,is_announcement) values ($pid,'$title',$author_id,'$author',$bid,$is_announcement)";

    $query = mysql_query($sql)
        or die("Error2!");

    $sql = "insert into posts_content (p_id,content,attachment) values ($pid,'$content',$attachment)";

    $query = mysql_query($sql)
        or die("Error3!");

    ?>
    <script>
        alert("发帖成功，跳转至帖子详细页面！");
        location.href = 'detail.php?id=<?php echo $pid ?> ';
    </script>

<?php
}
if(isset($_POST['submit_announcement'])){
    //$author_id = 1;
    //$author = "Curry";//should fetch value from session

    $author_id = $_SESSION['u_id'];
    $author = $_SESSION['username'];
    $is_announcement = 1;   //announcement
    $title = $_POST['title'];
    $content = $_POST['content'];
    // echo $title."<br>";
    //echo $content."<br>";
    $attachment = -1;

    $sql = "select max(p_id) from posts_topic";
    $query = mysql_query($sql)
    or die("Error1!");
    $row = mysql_fetch_array($query);
    $pid = $row[0]+1;
    //echo $pid;
    $sql = "insert into posts_topic (p_id,title,author_id,author,board_id,is_announcement) values ($pid,'$title',$author_id,'$author',$bid,$is_announcement)";

    $query = mysql_query($sql)
    or die("Error2!");

    $sql = "insert into posts_content (p_id,content,attachment) values ($pid,'$content',$attachment)";

    $query = mysql_query($sql)
    or die("Error3!");
    ?>
    <script>
        alert("公告发布成功，跳转至公告详细页面！");
        location.href = 'detail.php?id=<?php echo $pid ?> ';
    </script>

<?php
}
//convert to HTML
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>