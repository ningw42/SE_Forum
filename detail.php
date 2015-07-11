<!DOCTYPE html>
<?php
    require('checkvalid.php');
    // session_start();
    header("Content-type: text/html; charset=utf-8");
    $postid = $_GET['id'];
    if(!isset($_GET['page'])){
        $pageby10 = 0;
    }else {
        $pageby10 = ($_GET['page'] - 1) * 10;
    }
    $userid = $_SESSION['u_id'];
    $username = $_SESSION['username'];
    $avatar = $_SESSION['avatar'];
    $post_count = 0;
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

    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
</head>

<body>
<?php
// post title
mysql_query("UPDATE posts_topic SET hits=hits+1 WHERE p_id=".$postid);
$sql = "select * from posts_topic WHERE p_id=".$postid;
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$isannouncement = $row['is_announcement'];
$topic_owner_id = $row['author_id'];
$topic_owner_Avatar = mysql_fetch_array(mysql_query("select photo from user_details WHERE u_id=".$topic_owner_id))['photo'];
if (!$topic_owner_Avatar) {
    $topic_owner_Avatar = $DEFAULT_PHOTO;
} else {
    $topic_owner_Avatar = 'userAvatar/'.$topic_owner_Avatar;
}
?>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="nav-wrapper">
    <div class="container-fluid">
        <ul class="nav navbar-nav ">
            <li class="divider-vertical"></li>
            <li><a href="index.php"><b>论坛首页</b></a></li>
        </ul>
        <form class="navbar-form navbar-left" role="search" method="post" action="posts.php?b_id=<?php echo $row['board_id'] ?>">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="帖子主题">
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
                <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?php echo $_SESSION['username']; ?>
                    <!-- <span class="caret"></span> -->
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="editinfo.php">编辑信息</a></li>
                    <li><a href="message.php">短消息</a></li>
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
        <?php
        echo $row['title'];
        ?>
        <div style="float: right">
            <button class="btn btn-success btn-xs" type="button" >回复主题</button>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-hover table-content">
            <tbody>
                <?php if ($pageby10 == 0) {
                    $post_count++;
                ?>
                <tr class="table-hover">
                    <td width="15%" align="center">
                        <div style="margin-bottom: 5px">
                            <span class="label label-default"><?php echo $row['author'] ?></span>
                        </div>
                        <img src="<?php echo $topic_owner_Avatar; ?>" class="img-thumbnail" width="100%">
                        <div style="margin-bottom: 5px">
                            <span class="label label-default" id="timestamp"><?php echo $row['post_time'] ?></span>
                        </div>
                        <button class="btn btn-success btn-xs" type="button">发送站短</button>
                    </td>
                    <td>
                        <div class="panel panel-default panel-content">
                            <div class="panel-body">
                                <?php
                                $sql = "select * from posts_content WHERE p_id=".$postid;
                                $result = mysql_query($sql);
                                $row = mysql_fetch_array($result);
                                $attachment = $row['attachment'];
                                $postcontent = $row['content'];
                                echo $postcontent . "</br></br>";
                                if($attachment != NULL){
                                ?>
                                    <a href="download.php?filename=<?php echo $attachment; ?>">附件下载: <?php echo explode('_', $attachment)[1]; ?>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php }
                $sql = "select * from posts_reply WHERE p_id=".$postid." order by reply_time LIMIT ".$pageby10.", 10";
                $result = mysql_query($sql);
//                 echo $sql;
                while ($row = mysql_fetch_array($result) and $post_count++ < 10) {
                    $tempUserId = $row['replier_id'];
                    $tempAvatar = mysql_fetch_array(mysql_query("select photo from user_details WHERE u_id=".$tempUserId))['photo'];

//                    echo "select photo from user_details WHERE u_id=".$tempUserId;
                    if (!$tempAvatar) {
                        $tempAvatar = $DEFAULT_PHOTO;
                    } else {
                        $tempAvatar = 'userAvatar/'.$tempAvatar;
                    }
//                    echo $tempAvatar;
                ?>
                <tr class="table-hover">
                    <td width="15%" align="center">
                        <div style="margin-bottom: 5px">
                            <span class="label label-default"><?php echo $row['replier'] ?></span>
                        </div>
                        <img src="<?php echo $tempAvatar;?>" class="img-thumbnail" width="100%">
                        <div style="margin-bottom: 5px">
                            <span class="label label-default" id="timestamp"><?php echo $row['reply_time'] ?></span>
                        </div>
                        <button class="btn btn-success btn-xs" type="button">发送站短</button>
                    </td>
                    <td>
                        <div class="panel panel-default panel-content">
                            <div class="panel-body">
                                <?php echo $row['content'] ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <ul class="pagination">
    </ul>
</div>
<?php if(!$isannouncement){ ?>
<div class="panel panel-default" style="width: 80%; margin: 0px auto">
    <div class="panel-heading">
        <ol class="breadcrumb breadcrumb-post">
            <li class="active">快速回复主题</li>
        </ol>
    </div>
    <div class="panel-body">
        <form action="#">
            <div class="input-group">
                <!-- <span class="input-group-addon" id="title">主题</span> -->
                <textarea id="replyonpage" class="form-control" rows="5" placeholder="回复内容"></textarea>
                <span id="sendreply" class="input-group-addon btn btn-success">回复</span>
            </div>
        </form>
    </div>
</div>
<?php } ?>
</body>
<?php
$sql = "select count(*) from posts_reply WHERE p_id=".$postid." order by r_id";
$result = mysql_query($sql);
$totalreplycount = mysql_fetch_array($result)[0];
?>
<script type="text/javascript">
    $('#sendreply').on('click', function () {
        var ban = <?php echo $_SESSION['status'];?>;
        if (ban == 1) {
            alert('你被禁言');
        }
        else {
            var reply_content = $('#replyonpage').val();
            if (reply_content.length == 0) {
                // TO-DO bootstrap warning
                alert("empty");
                return;
            }
            var p_id = <?php echo $postid ?>;
            var replier_id = <?php echo $userid ?>;
            var replier = "<?php echo $username ?>";
            $.get('replypost.php', {p_id : p_id, replier_id : replier_id, replier : replier, content : reply_content}, function (response) {
                console.log(response);
                location.reload();
            })
        }
    });

    $('.pagination').twbsPagination({
        totalPages: <?php echo ceil($totalreplycount / 10.0) ?>,
        visiblePages: 10,
        href : '?id=' + <?php echo $postid ?> + '&page={{number}}'
//        onPageClick: function (event, page) {
//            $('#page-content').text('Page ' + page);
//        }
    });
</script>
</html>