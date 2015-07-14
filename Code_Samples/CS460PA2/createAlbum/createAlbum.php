<?php
session_start();
	include 'createAlbumActivity.php';
	$activity = new createAlbumActivity();
	$activity->run();
?>