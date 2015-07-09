<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title>Forum</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function checkSubmit(){
            if ( confirm("确定发布公告？")){
                var title = document.post.title.value;
                var content = document.post.content.value;
                //document.write(title);
                if( title == "" || content == "" ){
                    alert("公告主题或内容不能为空！");
                    // document.post.title.focus();
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
<?php
require("connect.php");
require('checkvalid.php');
// session_start();
$username = $_SESSION['username'];
$u_id = $_SESSION['u_id'];
$bid = $_GET['b_id'];
?>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="nav-wrapper">
        <div class="container-fluid">
            <form class="navbar-form navbar-left" role="search" method="post" action="posts.php?b_id=<?php echo $bid ?>">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="帖子或作者">
                </div>
                <button type="submit" class="btn btn-default" name="search">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="navbar-header">
                        <img alt="avatar" src="images/Akari.png" class="img-nav img-rounded">
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username?>
                        <!-- <span class="caret"></span> -->
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="editinfo.php">编辑信息</a></li>
                        <li><a href="message.php">短消息 <span class="badge">42</span></a></li>
                        <?php if($_SESSION['role'] == 0){ ?>
                            <li><a href="usermanagement.php">用户管理</a></li>
                            <li><a href="boardmanagement.php">版块管理</a></li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="logout.php">注销</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="divider-vertical"></li>
                <li><a href='posts.php?b_id=<?php echo $bid ?>'>浏览</a></li>
                <li class="divider-vertical"></li>
                <li><a href="top10.php">热门帖子</a></li>
                <li class="divider-vertical"></li>
                <li class="active"><a href="announcement.php?b_id=<?php echo $bid?>">公告 <span class="sr-only">(current)</span></a></li>
                <li class="divider-vertical"></li>
                <li class="divider-vertical-invisable"></li>
                <li class="divider-vertical-invisable"></li>
                <li class="divider-vertical-invisable"></li>
                <li class="divider-vertical-invisable"></li>
                <li class="divider-vertical-invisable"></li>
            </ul>
        </div>
    </div>
</nav>

<div class="panel panel-default panel-size">
    <div class="panel-heading">
        <ol class="breadcrumb breadcrumb-post">
            <?php

            if(isset($_GET['b_id']))
                $bid = $_GET['b_id'];

            $sql = "select b_name from forum_board where b_id = $bid";
            $query = mysql_query($sql)
            or die("Error!");
            $row = mysql_fetch_array($query);   //num of posts
            $b_name = $row[0];
            mysql_close();
            ?>
            <li><a href="posts.php?b_id=<?php echo $bid?>"><?php echo $b_name?></a></li>
            <li class="active">发布公告</li>
            <!-- <li class="active">Data</li> -->
        </ol>
    </div>
    <div class="panel-body">
        <form name="post" enctype="multipart/form-data" action="post_handle.php?b_id=<?php echo $bid ?>" method="POST" onsubmit="return checkSubmit()">
            <div class="input-group">
                <span class="input-group-addon" >主题</span>
                <input type="text" class="form-control" placeholder="120个字符以内" name="title">
                <span class="input-group-btn">
                    <button class="btn btn-success" name ="submit_announcement" type="submit">发布</button>
                </span>
            </div>
            <textarea class="form-control input-textarea" rows="10" placeholder="公告内容" name = "content"></textarea>
            <input type="file" name="uploadfile" id="uploadfile">
        </form>
    </div>
</div>


</body>
</html>