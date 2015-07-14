<?php


	mysql_connect("localhost", "root", "root") or die (mysql_error());
	mysql_select_db("cs460") or die (mysql_error());

	$id = addslashes(($_REQUEST['id']));
	//$id = 18;
	//echo "wjkqndewj";

	$image = mysql_query("SELECT * FROM photos WHERE photoid = '$id'");
	//echo "qw";
	//echo $id;

	
	//echo $image;
	//echo "qw2";


	$image = mysql_fetch_assoc($image);

	//echo $image;
	//echo "qw3";
	$image = $image ['binary'];
	//echo "qw4";

	header("Content-type: image/png");

	echo $image;




?>