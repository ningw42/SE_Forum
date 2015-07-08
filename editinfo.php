<!DOCTYPE html>
<?php
require("checkvalid.php");
// Session_start();
header("Content-type: text/html; charset=utf-8");
$userid = $_SESSION['u_id'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];
include("connect.php");
?>
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
    <!-- Upload -->
<!--    <link rel="stylesheet" href="css/jquery.fileupload.css">-->

    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Upload -->
<!--    <script src="js/jquery.ui.widget.js"></script>-->
<!--    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>-->
<!--    <script src="js/jquery.iframe-transport.js"></script>-->
<!--    <script src="js/jquery.fileupload.js"></script>-->
<!--    <script src="js/jquery.fileupload-process.js"></script>-->
<!--    <script src="js/jquery.fileupload-image.js"></script>-->
    <!-- The File Upload validation plugin -->
<!--    <script src="js/jquery.fileupload-validate.js"></script>-->
    <!-- Main Upload JS -->
<!--    <script src="js/upload.js"></script>-->
</head>

<body>
<?php
$sql = "select * from user_details WHERE u_id=".$userid;
$row = mysql_fetch_array(mysql_query($sql));
?>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="nav-wrapper">
    <div class="container-fluid">
        <form class="navbar-form navbar-left" role="search" method="post" action="posts.php">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="帖子或作者">
            </div>
            <button type="submit" class="btn btn-default" name="search">搜索</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <div class="navbar-header">
                    <img alt="avatar" src="<?php echo $avatar; ?>" class="img-nav img-rounded">
                </div>
            </li>
            <li class="dropdown">
                <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?php echo $username; ?>
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
            <li class="active"><a href="#">浏览 <span class="sr-only">(current)</span></a></li>
            <li class="divider-vertical"></li>
            <li><a href="top10.php">热门帖子</a></li>
            <li class="divider-vertical"></li>
            <li><a href="#">公告</a></li>
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
            <li class="active">个人信息</li>
        </ol>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <form class="form-horizontal col-sm-6" id="info" action="#">
            <div class="form-group" style="display: none;">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" placeholder="<?php echo $username ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" placeholder="<?php echo $row['email'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">性别</label>
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php if ($row['gender']=="M") echo "active"?>"> <input type="radio" name="gender" value="1">男 </label>
                        <label class="btn btn-default <?php if ($row['gender']=="F") echo "active"?>"> <input type="radio" name="gender" value="2">女 </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-6">
                    <input type="phone" class="form-control" name="phone" placeholder="<?php echo $row['phone'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">个性签名</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="description" rows="3" placeholder="<?php echo $row['description'] ?>"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-3">
                    <button type="button" id="updateinfo" style="display: none;" class="btn btn-default">更新个人信息</button>
                </div>
            </div>
        </form>
        <form name='photoupload' id='photoupload' enctype="multipart/form-data" method='POST' action='photo_uploader.php'>
        <div class="col-sm-6">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-6">
                <img src="<?php echo $avatar; ?>" class="img-thumbnail" style="width: 100%; height: 100%;">
            </div>
            <div class="col-sm-offset-2 col-sm-3">
                <input id="photo" type="file" name="photo" accept="image/png, image/jpeg">
            </div>
            <div class="col-sm-2">
                <button id="uploadbutton" class="btn btn-default" style="display: none;">上传文件</button>
            </div>
        </div>
        </form>
    </div>
</div>
</body>
<script type="text/javascript">
    var hasContent = false;
    $('#updateinfo').click( function() {
        if (hasContent) {
            var p = $('#info').serialize();
            if (p.indexOf('gender') < 0) p = p + "&gender=";
            $.post( 'updateinfo.php', p, function(data) {
                // console.log(data)
                if (data == "success") {
                    alert("success");
                    location.reload();
                } else if (data == "failure") {
                    alert("failure, try again");
                };
            });
        } else {
            // TO-DO modal alert
            console.log("unchanged")
        }
    });
    $('#info').change(function (){
        $('#updateinfo').css('display', 'block');
        hasContent = true;
    });
    $('#photo').change(function (){
        $('#uploadbutton').css('display', 'block');
        hasContent = true;
    });
    $('#uploadbutton').click(function (){
       $('#photoupload').submit();
    });
</script>
</html>