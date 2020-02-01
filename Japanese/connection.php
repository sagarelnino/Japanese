<?php
	require 'Model/function.php';
	require 'Model/admin.php';
	try{
		$con=new PDO("mysql:host=localhost;dbname=necessaries","root","");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$user = new User($con);
		$admin = new Admin($con);
	}
	catch(PDOException $e) {
			 echo $e->getMessage();
    }
?>