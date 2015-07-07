<?php header("Content-type:text/html;charset=utf8");?>
<?php
	// Connect database
	$con = mysql_connect("localhost","root","123456");

	mysql_select_db('forum', $con);

	mysql_query("SET NAMES 'utf8'");

    $DEFAULT_PHOTO = "images/Akari.png";
?>