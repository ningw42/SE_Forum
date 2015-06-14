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
    <script src="js/jquery.twbsPagination.min.js"></script>

</head>

<body>
<?php
require('checkvalid.php');
session_start();
$username = $_SESSION['username'];
$u_id = $_SESSION['u_id'];
$bid = $_GET['b_id'];
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
                <li><a href="announcement.php?b_id=<?php echo $bid?>">公告</a></li>
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
        <ul class="breadcrumb breadcrumb-post">
            <?php
            //require('checkvalid.php');

             require("connect.php");
            $sql = "select b_name from forum_board where b_id = $bid";
            $query = mysql_query($sql)
                or die("Error!");
            $row = mysql_fetch_array($query);   //num of posts
            $b_name = $row[0];
            ?>
            <li class="active">所在板块:<a href=""#><?php echo $b_name?></a></li>
            <li><a class = "btn btn-success" href = "post.php?b_id=<?php echo $bid ?>">发布新主题</a></li>
        </ul>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <ul class="list-group">
            <?php

            $topics_one_page = 10;   //display at most 20 posts in one page
            $page_navigation = 5;

            if(!isset($_GET['current_page'])){
                $current_page = 1;
            }
            else{
                $current_page = $_GET['current_page'];
            }



           // echo $bid;
            $sql = "select count(*) from posts_topic where board_id = $bid and is_announcement = 0";
            $query = mysql_query($sql)
                or die("Error!");
            $row = mysql_fetch_array($query);   //num of posts
            $num_row = $row[0];
            //echo $num_row;
            $num_page = floor($num_row / $topics_one_page) + 1;

            $start = ($current_page-1)*$topics_one_page;
            $sql = "select * from posts_topic where board_id = $bid and is_announcement = 0 limit $start,$topics_one_page ";
            $query = mysql_query($sql)
                or die("Error!");
            while($row = mysql_fetch_array($query,MYSQL_BOTH)) {
                //fetch all the posts in the board
                ?>
                <li class="list-group-item">
                    <a href="addHit.php?id=<?php echo $row['p_id']?>"><?php echo $row['title']?></a>
                    <span class="badge"><?php echo $row['reply_count']?> reply/<?php echo $row['hits']?>hit(s)</span>
                    <span class="badge"><?php $row['post_time']?></span>
                    <span class="badge"><?php $row['author']?></span>
                </li>
            <?php
            }
            mysql_close();
            ?>
        </ul>
    </div>
</div>
<div class="text-center">
    <ul class="pagination">
    </ul>
</div>
<script>
    $('.pagination').twbsPagination({
        totalPages: <?php echo $num_page ?>,
        visiblePages: 10,
        href : '?b_id=' + <?php echo $bid ?> + '&current_page={{number}}'
//        onPageClick: function (event, page) {
//            $('#page-content').text('Page ' + page);
//        }
    });
</script>
</body>
</html>










