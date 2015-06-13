<!DOCTYPE html>
<?php Session_start(); ?>
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
<!--    <link href='css/popbox.css' rel='stylesheet'>-->

    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Popup -->
<!--    <script src="js/popbox.min.js"></script>-->
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
                <a href="#" id="username-nav" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['username']; ?>
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
            $tz = new DateTimeZone('Asia/Shanghai');
            $sql = 'select * from forum_message where receiver_id = '.$_SESSION['u_id'].' order by send_time desc';
            $result = mysql_query($sql);?>
            <tbody  id="mesgtable">
                <?php
                while ($row = mysql_fetch_array($result)) { ?>
                <tr class="table-hover">
                    <td width="10%">
                        <a href="#"> <?php echo $row['sender'] ?> </a>
                    </td>
                    <td width="60%">
                        <p style="margin-bottom: 0px"><?php echo $row['content'] ?></p>
                    </td>
                    <td width="20%">
                        <p style="margin-bottom: 0px">
                            <?php
                            $utc_date = DateTime::createFromFormat(
                                'Y-m-d H:i:s',
                                $row['send_time'],
                                new DateTimeZone('UTC')
                            );
                            $local_date = $utc_date;
                            $local_date->setTimezone($tz);
                            echo $local_date->format('Y-m-d H:i:s');
                            ?>
                        </p>
                    </td>
                    <td width="10%" align="center">
                        <button class="btn btn-danger btn-xs" <?php echo 'data-m_id='.$row['m_id'] ?> data-toggle="modal" data-target="#confirmModal">删除</button>
                        <button class="btn btn-success btn-xs" <?php echo 'data-sender='.$row['sender'];?>  <?php echo ' data-loginuserid='.$_SESSION['u_id'];?> data-toggle="modal" data-target="#replyModal" <?php echo 'data-sender_id='.$row['sender_id'];?> >回复</button>
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

<!-- replyModal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="input-group" style="width: 100%;">
                    <textarea id="mesgarea" class="form-control" rows="5" placeholder="站短内容"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button id="sendbutton" data-toggle="modal" data-target="#resultModal" type="button" class="btn btn-success" >发送站短</button>
            </div>
        </div>
    </div>
</div>

<!-- resultModal -->
<div class="modal fade bs-example-modal-sm" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">发送成功</h4>
            </div>
        </div>
    </div>
</div>

<!-- confirmModal -->
<div class="modal fade bs-example-modal-sm" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">确认删除？</h4>
            </div>
            <div class="modal-footer">
                <button id="confirm" type="button" class="btn btn-danger" onclick='deletemesg(this);'>确定</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deletemesg (d) {
        var messageID = d.getAttribute("m_id");
        $.get('deletemessage.php', {m_id : messageID}, function (response) {
            var confirmModal = $('#confirmModal');
            setTimeout(function(){
                confirmModal.modal('hide');
            }, 100);
        })
    };
    var replyModal = $('#replyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('sender') // Extract info from data-* attributes
        var recipientID = button.data('sender_id') // Extract info from data-* attributes
        var loginUser = button.data('loginuserid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('发送给' + recipient)
        modal.find('.btn-success').attr({'userid' : recipientID})
        modal.find('.btn-success').attr({'loginid' : loginUser})
    })
    var confirmModal = $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var mid = button.data('m_id') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.btn-danger').attr({'m_id' : mid})
    })
    $('#sendbutton').on('click', function () {
//        console.log(this)
        var id = $(this).attr('userid')
        var login_id = $(this).attr('loginid')
        var content = $("#mesgarea").val()
        // TO-DO empty content
        $.get('replymessage.php', {receiver_id : id, sender_id : login_id, mesg_content: content}, function (response) {
            if (response == "success") {
                alert("fuck")
            }
        })
    })
    $(function(){
        $('#resultModal').on('shown.bs.modal', function(){
            var resultModal = $(this);
            clearTimeout(resultModal.data('5000'));
            resultModal.data('5000', setTimeout(function(){
                resultModal.modal('hide');
            }, 1000));
            // 收起result Modal

            var replyModal = $('#replyModal');
            replyModal.data('hideInterval', setTimeout(function(){
                replyModal.modal('hide');
            }, 50));
            // 收起input Modal
        });
    });
</script>
</body>
</html>