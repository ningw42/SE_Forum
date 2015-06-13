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
                    <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">用户名
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
            <li class="active">所在板块</li>
        </ol>
    </div>
    <div class="panel-body" style="padding-bottom: 0px">
        <table class="table table-striped table-hover table-content">
            <thead>
            <tr>
                <th align="center">板块ID</th>
                <th>板块名</th>
                <th>板块简介</th>
                <th>板块帖子数</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * Created by PhpStorm.
             * User: Henry
             * Date: 2015/6/10
             * Time: 20:02
             */

            include('connect.php');

            $sql = "SELECT `b_id`, `b_name`, `description`, `posts_count` FROM `forum_board`;";
            $query = mysql_query($sql);
            while ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
                ?>

                <tr class="table-hover">
                    <td width="10%">
                        <a href="posts.php?b_id=<?php echo $row['b_id'] ?>"><?php echo $row['b_id']; $b_id = $row['b_id'] ?></a>
                    </td>
                    <td width="15%">
                        <a href="posts.php?b_id=<?php echo $row['b_id'] ?>"><?php echo $row['b_name'] ?></a>
                    </td>
                    <td width="55%">
                        <p style="margin-bottom: 0px"><?php echo $row['description'] ?></p>
                    </td>
                    <td width="10%">
                        <p style="margin-bottom: 0px"><?php echo $row['posts_count'] ?></p>
                    </td>
                    <td width="10%" align="center">
                        <button class="btn btn-danger btn-xs" onclick="javascript:if(confirm('确定删除该板块?'))location='deleteboard.php?del=<?php echo $row['b_id'] ?>'">删除板块</button>
                    </td>
                </tr>
            <?php
            }
            ?>

            <script type="text/javascript">
                function checkSubmit(){
                    if ( confirm("确定新建版块？")){
                        var name = document.createboard.name.value;
                        var description = document.createboard.description.value;
                        if( name == "" || description == "" ){
                            alert("请输入版块名或版块简介！");
                            document.createboard.name.focus();
                            return false;
                        }
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>

            <form name="createboard" action="createboard.php?id=<?php echo $b_id + 1 ?>" class="form-horizontal" method="post" onsubmit="return checkSubmit()">
            <tr class="table-hover">
                <td width="10%">
                    <a href="#" onclick="return false"><?php echo $b_id + 1 ?></a>
                </td>
                <td width="15%">
                    <div class="input-group input-group-sm" style="width: 100%">
                        <input type="text" class="form-control" placeholder="板块名" name="name">
                    </div>
                </td>
                <td width="55%">
                    <div class="input-group input-group-sm" style="width: 100%">
                        <input type="text" class="form-control" placeholder="板块简介" name="description">
                    </div>
                </td>
                <td width="10%">
                    <p style="margin-bottom: 0px">
                        <span class="glyphicon glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                    </p>
                </td>
                <td width="10%" align="center">
                    <button class="btn btn-success btn-sm" type="submit" name="sub">新建板块</button>
                </td>
            </tr>
            </form>
            </tbody>
        </table>
    </div>
</div>
<nav>
    <div class="paginator-wrapper">
        <ul class="pagination paginator">
            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li> <a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
        </ul>
    </div>
</nav>
</body>
</html>
