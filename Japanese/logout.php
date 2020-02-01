<?php 
	require 'session_required.php';
	unset($_SESSION['message']);
	unset($_SESSION['id']);
	session_destroy();
	header("Location:index.php");
	exit;
?>