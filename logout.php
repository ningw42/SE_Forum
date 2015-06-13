<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2015/6/13
 * Time: 18:11
 */
session_start();
session_destroy();
header('Location:login.html');
