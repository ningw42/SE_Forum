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
/**
 * Created by PhpStorm.
 * User: Henry
 * Date: 2015/6/15
 * Time: 20:46
 */

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
                        <?php if($role == 0){ ?>
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
                <li class="active"><a href="top10.php">热门帖子</a></li>
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
        <ul class="breadcrumb breadcrumb-post">
            <li class="active">十大热帖</li>
            <li><a class = "btn btn-success" href = "index.php">返回首页</a></li>
        </ul>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <ul class="list-group">
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
            require("connect.php");

            $sql = "select p_id, hits, reply_count, post_time from posts_topic where is_announcement = 0 and week(now()) - week(post_time) <= 1";
            $query = mysql_query($sql)
            or die("Error!");
            $post_rank = array();

            while($row = mysql_fetch_array($query, MYSQL_BOTH)) {
                //fetch all the posts within two weeks

                $sql2 = "select count(DISTINCT replier_id) from posts_reply where p_id = " . $row['p_id'];
                $query2 = mysql_query($sql2)
                or die("Error!");
                $follower_count = mysql_fetch_array($query2)[0];

                $hits = $row['hits'];
                $replies = $row['reply_count'];
                $post_time = $row['post_time'];
                $last_time = (time() - strtotime($post_time))/86400;

                if($replies == 0){
                    $replies = 1;
                }
                if($hits == 0){
                    $hits = 1;
                }
                if($follower_count == 0){
                    $follower_count = 1;
                }
                $post_rank[$row['p_id']] = $follower_count*(0.5*$replies)*(0.25*$hits)/$last_time;
            }
            arsort($post_rank);
            $ranked_p_id = array_keys($post_rank);
            $k = 0;

            while($k < 10) {
                //fetch all the posts in the board

                $sql = "select p_id, board_id, author, post_time, reply_count, title, hits  from posts_topic where p_id = " . $ranked_p_id[$k];
                $query = mysql_query($sql)
                or die("Error!");
                $row = mysql_fetch_array($query);

                $sql = "select b_name from forum_board where b_id = " . $row['board_id'];
                $query = mysql_query($sql)
                or die("Error!");
                $b_name = mysql_fetch_array($query)[0];

                $sql2 = "select count(DISTINCT replier_id) from posts_reply where p_id = " . $row['p_id'];
                $query2 = mysql_query($sql2)
                or die("Error!");
                $follower_count = mysql_fetch_array($query2)[0];

                ?>
                <tr class = "table-hover">
                    <td width="30%">
                        <a href = "detail.php?id=<?php echo $row['p_id'] ?>"><?php echo $row['title']?></a>
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
                </tr>

            <?php
                $k++;
            }

            mysql_close();
            ?>
            </ul>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <ul class="pagination">
    </ul>
</div>
</body>
</html>
