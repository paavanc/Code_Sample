

<?php
session_start();
	include 'RegistrationActivity.php';
	
	$activity = new RegistrationActivity();
	$activity->run();
?>