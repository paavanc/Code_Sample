<?php
session_start();
	include 'addFriendActivity.php';
	$activity = new addFriendActivity();
	$activity->run();
?>