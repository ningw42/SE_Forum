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
                    <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">用户名
                        <!-- <span class="caret"></span> -->
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">编辑信息</a></li>
                        <li><a href="#">短消息 <span class="badge">42</span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">注销</a></li>
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
            <li class="active">所在板块</li>
        </ol>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <ul class="list-group">
            <?php
            require("connect.php");
            $topics_one_page = 20;   //display at most 20 posts in one page
            $page_navigation = 5;

            if(!isset($_GET['current_page'])){
                $current_page = 0;
            }
            else{
                $current_page = $_GET['current_page'];
            }




            $bid = $_GET['b_id'];
           // echo $bid;
            $sql = "select count(*) from posts_topic where board_id = $bid";
            $query = mysql_query($sql)
                or die("Error!");
            $row = mysql_fetch_array($query);   //num of posts
            $num_row = $row[0];
            //echo $num_row;
            $num_page = $num_row / $topics_one_page + 1;

            $start = $current_page*$topics_one_page;
            $sql = "select * from posts_topic where board_id = $bid limit $start,$topics_one_page ";
            $query = mysql_query($sql)
                or die("Error!");
            while($row = mysql_fetch_array($query,MYSQL_BOTH)) {
                //fetch all the posts in the board
                ?>
                <li class="list-group-item">
                    <a href="detail.php?pid =<?php echo $row['pid'] ?>  "><?php echo $row['title']?></a>
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
<nav>
    <div class="paginator-wrapper">
        <ul class="pagination paginator">
            <?php
            if($current_page/$page_navigation==0){//disable class previous
                ?>
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <?php
            }
            else{
                ?>
                <li><a href="?b_id=<?php echo $bid?>&current_page=<?php echo $current_page-1?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <?php
            }

            for($i=$current_page/$page_navigation*$page_navigation+1;$i<($current_page/$page_navigation+1)*$page_navigation+1;$i++){
                if($i==$current_page){
                    ?>
                    <li class="active"><a href="?b_id=<?php echo $bid?>&current_page=<?php echo $i?>"><?php echo $i?> <span class="sr-only">(current)</span></a></li>
                <?php
                }
                else{
                    ?>
                    <li><a href="?b_id=<?php echo $bid?>&current_page=<?php echo $i?>"><?php echo $i?></a></li>
                <?php
                }
            }
            if($current_page/$page_navigation==$num_page-1){
                ?>
                <li class=disabled"> <a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
            <?php
            }
            else{
                ?>
                <li> <a href="?b_id=<?php echo $bid?>&current_page=<?php echo $current_page+1?>" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
            <?php
            }
            ?>


        </ul>
    </div>
</nav>
</body>
</html>










