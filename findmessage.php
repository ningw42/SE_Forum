<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 6/10/2015
 * Time: 8:26 PM
 */
include('connect.php');
$sql = 'select * from forum_message';
$result = mysql_query($sql);
echo '[';
$row = mysql_fetch_array($result);
while ($row) {
    echo json_encode($row);
    if ($row = mysql_fetch_array($result))
        echo ',';
}
echo ']';