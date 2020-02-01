<?php 
session_start();
if(empty($_SESSION['adminId'])){
	header("location:login.php");
}
?>