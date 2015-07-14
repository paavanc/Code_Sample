<?php

session_start();

	include 'addTagActivity.php';
	
	$activity = new addTagActivity();
	
	$activity->run();
?>