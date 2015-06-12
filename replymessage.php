<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/12/2015
 * Time: 12:25 AM
 */

include("connect.php");
//$sql = "delete from forum_message WHERE m_id = ".$_GET['m_id'];
//$result = mysql_query($sql);
echo $_GET['receiver_id'];
echo $_GET['mesg_content'];