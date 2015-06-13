<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/11/2015
 * Time: 9:44 PM
 */
include("connect.php");
$sql = "delete from forum_message WHERE m_id = ".$_GET['m_id'];
$result = mysql_query($sql);
if (!$result) {
	echo "failure";
} else {
	echo "success";
}