<?php

session_start();

	include 'showContributerActivity.php';
	
	$activity = new showContributerActivity();
	
	$activity->run();
?>