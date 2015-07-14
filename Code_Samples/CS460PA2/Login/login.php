<?php
session_start();
	include 'LoginActivity.php';
	$activity = new LoginActivity();
	$activity->run();
?>