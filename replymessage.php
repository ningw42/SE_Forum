<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/12/2015
 * Time: 12:25 AM
 */

include("connect.php");
$sql = "select username from user_simple WHERE u_id=".$_GET['sender_id'];
$result = mysql_query($sql);
$name = mysql_fetch_array($result)['username'];

$senderid = $_GET['sender_id'];
$receiverid = $_GET['receiver_id'];
$content = $_GET['mesg_content'];

date_default_timezone_set("UTC");
$stamp = date('Y-m-d H:i:s', time());
$sql = "insert into forum_message (`sender_id`, `sender`, `receiver_id`, `send_time`, `content`) VALUES ('".$senderid."', '".$name."', '".$receiverid."', '".$stamp."', '".$content."')";
//echo $sql;

$result = mysql_query($sql);
if (!$result){
    echo "failure";
} else {
    echo "success";
}