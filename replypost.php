<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/13/2015
 * Time: 8:41 PM
 */

include("connect.php");

$content = $_GET['content'];
$p_id = $_GET['p_id'];
$replier_id = $_GET['replier_id'];
$replier = $_GET['replier'];

$sql = "insert into posts_reply (`p_id`, `replier_id`, `replier`, `content`) VALUES ('".$p_id."', '".$replier_id."', '".$replier."', '".$content."')";

$result = mysql_query($sql);

if (!$result) {
    echo "failure";
} else {
    echo "success";
}