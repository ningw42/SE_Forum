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
// session_start();
$username = $_SESSION['username'];
$u_id = $_SESSION['u_id'];
$role = $_SESSION['role'];
$status = $_SESSION['status'];
if(isset($_GET['b_id'])){
    $bid = $_GET['b_id'];
}else{
    $bid = 0;
}
require("connect.php");
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
                <?php if($bid != 0){ ?>
                <li class="active"><a href="posts.php?b_id=<?php echo $bid ?>">浏览 <span class="sr-only">(current)</span></a></li>
                <?php }else{ ?>
                    <li><a>浏览 <span class="sr-only">(current)</span></a></li>
                <?php } ?>
                <li class="divider-vertical"></li>
                <li><a href="top10.php">热门帖子</a></li>
                <li class="divider-vertical"></li>
                <?php if($bid != 0){ ?>
                <li><a href="announcement.php?b_id=<?php echo $bid?>">公告</a></li>
                <?php }else{ ?>
                    <li><a>公告</a></li>
                <?php } ?>
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
            if($bid != 0) {
                $sql = "select b_name from forum_board where b_id = $bid";
                $query = mysql_query($sql)
                or die("Error1!");
//                echo "2" . $sql;
                $row = mysql_fetch_array($query);   //num of posts
                $b_name = $row[0];
            ?>
            <li class="active">所在板块:<a href="posts.php?b_id=<?php echo $bid ?>"><?php echo  $b_name ?></a></li>
                <li><a class="btn btn-success" href="post.php?b_id=<?php echo $bid ?>" onclick="return checkPost()">发布新主题</a></li>
            <?php }else{ ?>
                <li class="active">全站搜索</li>
            <?php } ?>
        </ul>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <!--<ul class="list-group">-->
        <table class="table table-striped table-hover table-content">
            <thead>
            <tr>
                <th align="center">主题</th>
                <th>版块名</th>
                <th>作者</th>
                <th>发帖时间</th>
                <th>关注人数</th>
                <th>点击/回复</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $topics_one_page = 10;   //display at most 20 posts in one page
            $page_navigation = 5;

            if(!isset($_GET['current_page'])){
                $current_page = 1;
            }
            else{
                $current_page = $_GET['current_page'];
            }

            if($bid != 0) {
                $sql = "select count(*) from posts_topic where board_id = $bid and is_announcement = 0";
            }else{
                $sql = "select count(*) from posts_topic where is_announcement = 0";
            }
//            echo "3" . $sql;
            $query = mysql_query($sql)
                or die("Error2!");
            $row = mysql_fetch_array($query);   //num of posts
            $num_row = $row[0];
//            echo "4" . $num_row;
            $num_page = floor($num_row / $topics_one_page) + 1;

            $start = ($current_page-1)*$topics_one_page;
            if(isset($_POST['search']) && $bid != 0){
                $keyword = $_POST['keyword'];
                $sql = "select * from posts_topic where board_id = $bid and is_announcement = 0 and title LIKE '%$keyword%' ORDER BY p_id limit $start,$topics_one_page ";
            }else if($bid != 0) {
                $sql = "select * from posts_topic where board_id = $bid and is_announcement = 0 ORDER BY p_id limit $start,$topics_one_page ";
            }else if(isset($_POST['search'])) {
                $keyword = $_POST['keyword'];
                $sql = "select * from posts_topic where is_announcement = 0 and title LIKE '%$keyword%' ORDER BY p_id limit $start,$topics_one_page ";
            }else {
                $sql = "select * from posts_topic where is_announcement = 0 ORDER BY p_id limit $start,$topics_one_page ";
            }
            $query = mysql_query($sql)
            or die("Error3!");
//            echo "5" . $sql;
            while($row = mysql_fetch_array($query,MYSQL_BOTH)) {
                //fetch all the posts in the board
                $sql2 = "select b_name from forum_board where b_id = " . $row['board_id'];
                $query2 = mysql_query($sql2)
                or die("Error!");
                $b_name = mysql_fetch_array($query2)[0];

                $sql2 = "select count(DISTINCT replier_id) from posts_reply where p_id = " . $row['p_id'];
                $query2 = mysql_query($sql2)
                or die("Error!");
                $follower_count = mysql_fetch_array($query2)[0];

                ?>
                <tr class = "table-hover">
                    <td width="30%">
                        <a href = "addhit.php?id=<?php echo $row['p_id'] ?>"><?php echo $row['title']?></a>
                    </td>
                    <td width="10%">
                        <a href = "posts.php?b_id=<?php echo $row['board_id'] ?>"><?php echo $b_name?></a>
                    </td>
                    <td width="10%">
                        <span class="badge"><?php echo $row['author']?></span>
                    </td>
                    <td width="20%">
                        <span class="badge"><?php echo $row['post_time']?></span>
                    </td>
                    <td width="20">
                        <span class="badge"><?php echo $follower_count ?></span>
                    </td>
                    <td width="10">
                        <span class="badge"><?php echo $row['reply_count']?> reply/<?php echo $row['hits']?>hit(s)</span>
                    </td>
<!--                    <td width="50%">-->
<!--                        <a href = "detail.php?id=--><?php //echo $row['p_id'] ?><!--">--><?php //echo $row['title']?><!--</a>-->
<!--                    </td>-->
<!--                    <td width="10%">-->
<!--                        <span class="badge">--><?php //echo $row['author']?><!--</span>-->
<!--                    </td>-->
<!--                    <td width="20%">-->
<!--                        <span class="badge">--><?php //echo $row['post_time']?><!--</span>-->
<!--                    </td>-->
<!--                    <td width="10">-->
<!--                        <span class="badge">--><?php //echo $row['reply_count']?><!-- reply/--><?php //echo $row['hits']?><!--hit(s)</span>-->
<!--                    </td>-->
                    <?php
                    if($role==0){//管理员 add delete button
                        ?>
                        <td width="10">
                            <button class = "btn btn-danger btn-xs"
                                    onclick="if(confirm('确定删除这条帖子?'))location='deletepost.php?b_id=<?php echo $bid?>&p_id=<?php echo $row['p_id']?>'">
                                删除
                            </button>
                        </td>
                    <?php

                    }
                    ?>
                </tr>

            <?php
            }

            mysql_close();
            ?>
            <!--</ul>-->
            </tbody>
        </table>
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
<script>
    function checkPost(){
        if(<?php echo $status?>) {
            alert("摊上事了，被禁言了，快联系管理员吧亲！");
            return false;
        }
        return true;
    }
</script>
</body>
</html>










