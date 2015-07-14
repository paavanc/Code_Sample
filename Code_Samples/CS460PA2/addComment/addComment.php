<?php

session_start();

	include 'addCommentActivity.php';
	
	$activity = new addCommentActivity();
	
	$activity->run();
?>