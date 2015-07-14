<?php
session_start();
	include 'createPhotoActivity.php';
	$activity = new createPhotoActivity();
	$activity->run();
?>