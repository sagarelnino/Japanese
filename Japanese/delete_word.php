<?php
	require 'session_required.php';
	require 'connection.php';
	if(isset($_GET['id'])){
		$user->deleteWord($_GET['id']);
		$_SESSION['message'] = 'Word deleted successfully';
		header('location:words_admin.php');
	}
?>