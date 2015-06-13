<!DOCTYPE html>
<?php
Session_start();
header("Content-type: text/html; charset=utf-8");
$userid = $_SESSION['u_id'];
$username = $_SESSION['username'];
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
    <!-- Popup -->
    <!-- <link href='css/popbox.css' rel='stylesheet'> -->

    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Popup -->
    <!-- // <script src="js/popbox.min.js"></script> -->
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="nav-wrapper">
    <div class="container-fluid">
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="帖子或作者">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <div class="navbar-header">
                    <img alt="avatar" src="images/Akari.png" class="img-nav img-rounded">
                </div>
            </li>
            <li class="dropdown">
                <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?php echo $username; ?>
                    <!-- <span class="caret"></span> -->
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">编辑信息</a></li>
                    <li><a href="#">短消息 <span class="badge">42</span></a></li>
                    <li class="divider"></li>
                   <li><a href="logout.php">注销</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="divider-vertical"></li>
            <li class="active"><a href="#">浏览 <span class="sr-only">(current)</span></a></li>
            <li class="divider-vertical"></li>
            <li><a href="#">热门帖子</a></li>
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
        <form class="form-horizontal col-sm-6">
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">QQ</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="qq" placeholder="QQ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">个人主页</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="homepage" placeholder="Homepage">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">个性签名</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="3" placeholder="当前个性签名"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-3">
                    <button type="submit" class="btn btn-default">更新个人信息</button>
                </div>
            </div>
        </form>
        <form class="form-horizontal col-sm-6">
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-6">
                    <img src="images/Akari.png" class="img-thumbnail"style="width: 100%">
                </div>
                <div class="col-sm-offset-2 col-sm-6">
                    <input type="file" name="imagefilename" accept="image/jpeg" id="InputFile">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-3">
                    <button type="submit" class="btn btn-default">上传头像</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>