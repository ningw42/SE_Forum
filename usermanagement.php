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
 * Date: 2015/6/16
 * Time: 12:01
 */

require('checkvalid.php');

$username = $_SESSION['username'];
$u_id = $_SESSION['u_id'];
$role = $_SESSION['role'];
$status = $_SESSION['status'];

if($role != 0){
    ?>
    <script>
        alert("权限不足！");
        location.href = "index.php";
    </script>
    <?php
    exit();
}


?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="nav-wrapper">
        <div class="container-fluid">
            <ul class="nav navbar-nav ">
                <li class="divider-vertical"></li>
                <li><a href="index.php"><b>论坛首页</b></a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" method="post" action="posts.php">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="帖子主题">
                </div>
                <button type="submit" class="btn btn-default" name="search">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="navbar-header">
                        <img alt="avatar" src="<?php echo $_SESSION['avatar']; ?>" class="img-nav img-rounded">
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?>
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
            </ul>
        </div>
    </div>
</nav>

<div class="panel panel-default panel-size">
    <div class="panel-heading">
        <ol class="breadcrumb breadcrumb-post">
            <li class="active">用户管理</li>
        </ol>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <table class="table table-striped table-hover table-content">
            <thead>
            <tr>
                <th>用户ID</th>
                <th>用户名</th>
                <th>性别</th>
                <th>个性签名</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>发帖数</th>
                <th>组别</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include('connect.php');

            $sql = "SELECT count(*) FROM `user_simple`;";
            $query = mysql_query($sql);
            $user_number = mysql_fetch_array($query)[0];

            if(!isset($_GET['page'])){
                $pagestart = 0;
            }else {
                $pagestart = ($_GET['page'] - 1) * 10;
            }
            $sql = "SELECT `u_id`, `username`, `role`, `status` FROM `user_simple` order by `u_id`"." LIMIT ".$pagestart.", 10;";
            $sql2 = "SELECT `gender`, `description`, `phone`, `email`, `posts_counts` FROM `user_details` order by `u_id`"." LIMIT ".$pagestart.", 10;";
            $query = mysql_query($sql);
            $query2 = mysql_query($sql2);
            while ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
                $row2 = mysql_fetch_array($query2, MYSQL_BOTH);
            ?>
            <tr class="table-hover">
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo $row['u_id'] ?></p>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo $row['username'] ?></p>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo ($row2['gender'] == 'M') ? "男" : "女" ?></p>
                </td>
                <td width="15%">
                    <p style="margin-bottom: 0px"><?php echo $row2['description'] ?></p>
                </td>
                <td width="15%">
                    <p style="margin-bottom: 0px"><?php echo $row2['phone'] ?></p>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo $row2['email'] ?></p>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo $row2['posts_counts'] ?></p>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px"><?php echo ($row['role'] == 0) ? "管理员" : (($row['role'] == 1) ? "学生" : "教师") ?></p>
                </td>
                <td width="10%" align="center">
                    <?php if($row['status']){ ?>
                        <button class="btn btn-danger btn-xs btn-admit" onclick="javascript:if(confirm('确定恢复正常？'))location='changestatus.php?u_id=<?php echo $row['u_id'] ?>&currentstatus=1'">禁言</button>
                    <?php }else{ ?>
                        <button class="btn btn-success btn-xs btn-forbid" onclick="javascript:if(confirm('确定禁言用户？'))location='changestatus.php?u_id=<?php echo $row['u_id'] ?>&currentstatus=0'">正常</button>
                    <?php } ?>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <ul class="pagination">
    </ul>
</div>
<script type="text/javascript">
    $('.pagination').twbsPagination({
        totalPages: <?php echo ceil($user_number / 10.0) ?>,
        visiblePages: 5,
        href : '?page={{number}}'
//        onPageClick: function (event, page) {
//            $('#page-content').text('Page ' + page);
//        }
    });

    $(".btn-forbid").mouseover(function () {
        this.innerHTML = "禁言"
    })
    $(".btn-forbid").mouseout(function () {
        this.innerHTML = "正常"
    })
    $(".btn-admit").mouseover(function () {
        this.innerHTML = "恢复"
    })
    $(".btn-admit").mouseout(function () {
        this.innerHTML = "禁言"
    })
</script>
</body>
</html>
