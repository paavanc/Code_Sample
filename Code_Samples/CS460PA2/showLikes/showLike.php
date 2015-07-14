<?php

session_start();

	include 'showLikeActivity.php';
	
	$activity = new showLikeActivity();
	
	$activity->run();
?>