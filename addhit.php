<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/14
 * Time: 17:42
 */

$pid = $_GET['id'];

require('checkvalid.php');
require('connect.php');

$sql = "update posts_topic set hits = hits + 1 where p_id = $pid";
$query = mysql_query($sql)
or die("Error!");

header("Location:detail.php?id=$pid");
