<?php

session_start();

	include 'addLikeActivity.php';
	
	$activity = new addLikeActivity();
	
	$activity->run();
?>