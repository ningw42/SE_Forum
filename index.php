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
</head>

<body>
<?php
    require('checkvalid.php');
    $username = $_SESSION['username'];
    $u_id = $_SESSION['u_id'];
    $role = $_SESSION['role'];
    $status = $_SESSION['status'];
?>
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
                <li><a>浏览 <span class="sr-only">(current)</span></a></li>
                <li class="divider-vertical"></li>
                <li><a href="top10.php">热门帖子</a></li>
                <li class="divider-vertical"></li>
                <li><a>公告</a></li>
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
            <li class="active">选择板块</li>
        </ol>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            /**
             * Created by PhpStorm.
             * User: Henry
             * Date: 2015/6/10
             * Time: 19:10
             */

            include('connect.php');

            $sql = "SELECT `b_id`, `b_name`, `description`, `posts_count` FROM `forum_board`;";
            $query = mysql_query($sql);
            while ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?php echo $row['b_name'] ?></h3>
                            <p><?php echo $row['description'] ?></p>
                            <p><?php echo $row['posts_count'] ?></p>
                            <p>
                                <a href="posts.php?b_id=<?php echo $row['b_id'] ?>" class="btn btn-primary" role="button">进入</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
