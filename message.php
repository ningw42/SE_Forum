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
        <table class="table table-striped table-hover table-content">
            <thead>
                <tr>
                    <th>发送者</th>
                    <th>内容</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <?php
            /**
            * Created by PhpStorm.
            * User: Ning
            * Date: 6/10/2015
            * Time: 8:26 PM
            */
            include('connect.php');
            $sql = 'select * from forum_message';
            $result = mysql_query($sql);?>
            <tbody  id="mesgtable">
                <?php
                while ($row = mysql_fetch_array($result)) { ?>
                <tr class="table-hover">
                    <td width="10%">
                        <a href="#">长门有希</a>
                    </td>
                    <td width="60%">
                        <p style="margin-bottom: 0px"><?php echo $row['content'] ?></p>
                    </td>
                    <td width="20%">
                        <p style="margin-bottom: 0px"><?php echo $row['send_time'] ?></p>
                    </td>
                    <td width="10%" align="center">
                        <button class="btn btn-danger btn-xs" <?php echo 'value='.$row['m_id'] ?> onclick='deletemesg(this);'>删除</button>
                        <button class="btn btn-success btn-xs" <?php echo 'value='.$row['sender_id'] ?> onclick='replymesg(this);'>回复</button>
                    </td>
                </tr>
                <?php } ?>
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

<a href="#" class="modal" id="modal-one" aria-hidden="true"></a>
<div class="modal-dialog">
    <div class="modal-header">
        <span>发送给XXX</span>
        <a href="#" class="btn-close" style="float: right" aria-hidden="true">×</a>
    </div>
    <div class="modal-body">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="主题">
            <textarea class="form-control input-textarea" rows="5" placeholder="站短内容"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success">发送</a>
    </div>
</div>

<script type="text/javascript">
    function deletemesg (d) {
        var messageID = d.getAttribute("value");
    };
    function replymesg(d) {
        var senderID = d.getAttribute("value");
    }
</script>
</body>
</html>