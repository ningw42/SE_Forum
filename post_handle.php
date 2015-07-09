<?php
//handle form
require("connect.php");
$bid = $_GET['b_id'];
session_start();
if(isset($_POST['submit'])||isset($_POST['submit_announcement'])){
    $maxSize = 5*1024*1024;   //5M大小
    if(!empty($_FILES['uploadfile']['tmp_name'])){
//        $attachment = time();      //以当前时间戳作为文件标识符
        if($_FILES["uploadfile"]["size"]<=$maxSize){
            if ($_FILES["uploadfile"]["error"] > 0)
            {
//                $attachment = -2;
                ?>
                <script>
                    alert("上传文件出现错误！");
                </script>

                <?php
                //echo "Error: " . $_FILES["uploadfile"]["error"] . "<br />";
                if(isset($_POST['submit'])){
                    header('Location:post.php?b_id='.$bid);
                    exit;
                }
                else{
                    header('Location:announcement.php?b_id='.$bid);
                    exit;
                }
            }
            else
            {

//                echo "Upload: " . $_FILES["uploadfile"]["name"] . "<br />";
//                echo "Type: " . $_FILES["uploadfile"]["type"] . "<br />";
//                echo "Size: " . ($_FILES["uploadfile"]["size"] / 1024) . " Kb<br />";
//                echo "Stored in: " . $_FILES["uploadfile"]["tmp_name"];
                $attachment = time();      //以当前时间戳作为文件标识符
                $attachment = $attachment . "_" . $_FILES['uploadfile']['name'];
                if (file_exists("upload/" . $attachment)) {
                    echo "<script>alert('$attachment already exist')</script>";
                }else{
                    $string = strrev($_FILES['uploadfile']['name']);
                    $array = explode('.',$string);
                    $type = $array[0];
                    move_uploaded_file($_FILES["uploadfile"]["tmp_name"],
                        "upload/".$attachment);
//                    echo $attachment;
                }
            }
        }
        else{
            echo "<script>alert('附件大小超过限制')</script>";
            if(isset($_POST['submit'])){
                header('Location:post.php?b_id='.$bid);
                exit;
            }
            else{
                header('Location:announcement.php?b_id='.$bid);
                exit;
            }
        }
    }
    else{
        $attachment = NULL;
    }



    $author_id = $_SESSION['u_id'];
    $author = $_SESSION['username'];
    if(isset($_POST['submit'])){
        $is_announcement = 0;   //not announcement
    }
    else{
        $is_announcement = 1;   // announcement
    }

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "select max(p_id) from posts_topic";
    $query = mysql_query($sql)
        or die("Error1!");
    $row = mysql_fetch_array($query);
    $pid = $row[0]+1;
    mysql_query("SET AUTOCOMMIT=0");
    mysql_query("START TRANSACTION");   //assure atomic
    //echo $pid;
    $sql = "insert into posts_topic (p_id,title,author_id,author,board_id,is_announcement) values ($pid,'$title',$author_id,'$author',$bid,$is_announcement)";

    $query1 = mysql_query($sql)
        or die("Error2!");

    $sql = "insert into posts_content (p_id,content,attachment) values ($pid,'$content', '$attachment')";

    $query2 = mysql_query($sql)
        or die("Error3!");

    $sql = "update forum_board set posts_count = posts_count + 1 where b_id = $bid";
    $query3 = mysql_query($sql)
        or die("Error4!");
    if ($query1 and $query2 and $query3) {
        mysql_query("COMMIT");
    } else {
        mysql_query("ROLLBACK");
    }
    mysql_query("SET AUTOCOMMIT=1");
    ?>
    <script>
        alert("发布成功，跳转至详细页面！");
        location.href = 'detail.php?id=<?php echo $pid; ?>';
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