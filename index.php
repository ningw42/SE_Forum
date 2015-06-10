<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/10
 * Time: 17:06
 */
include 'index.html';
$server = "localhost";
$db = "forum";
$db_user = "root";
$db_password = "19940807";

$conn = new mysqli($server,$db_user,$db_password,$db);
if($conn->connect_error){//连接失败
    die("Connection failed!");
}




