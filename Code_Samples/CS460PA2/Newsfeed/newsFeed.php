<?php

session_start();

	include 'newsFeedActivity.php';
	
	$activity = new newsFeedActivity();
	
	$activity->run();
?>