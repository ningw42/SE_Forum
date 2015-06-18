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

$r1 = mysql_query("INSERT INTO posts_reply (`p_id`, `replier_id`, `replier`, `content`) VALUES ('".$p_id."', '".$replier_id."', '".$replier."', '".$content."')");

if ($r1) {
    echo "success";
} else {
    echo "failure";
}