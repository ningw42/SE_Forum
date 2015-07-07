<?php
/**
 * Created by PhpStorm.
 * User: Henry
 * Date: 2015/7/7
 * Time: 19:57
 */
    header("Content-type: application/octet-stream");

    header('Content-Disposition: attachment; filename="'. basename($_GET['filename']).'"');

    header("Content-Length: ". filesize($_GET['filename']));

    readfile($_GET['filename']);
?>