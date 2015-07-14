<?php

session_start();

	include 'showPopTagsActivity.php';
	
	$activity = new showPopTagsActivity();
	
	$activity->run();
?>