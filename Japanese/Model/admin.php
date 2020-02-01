<?php 
	/**
	 * 
	 */
	class Admin
	{
		public $db;	
		function __construct($con)
		{
			if(!isset($this->db)){
				$this->db = $con;
			}
		}
		public function isExistAdminByEmailAndPassword($email,$password){
			$st =$this->db->prepare("SELECT * FROM admin WHERE email=:email AND password=:password");
			$st->bindParam(':email',$email);
			$st->bindparam(':password',$password);
			$st->execute();
			if($st->rowCount()){
				return true;
			}
			return false;
		}
		public function getAdminByEmailAndPassword($email,$password){
			$st =$this->db->prepare("SELECT * FROM admin WHERE email=:email AND password=:password");
			$st->bindParam(':email',$email);
			$st->bindparam(':password',$password);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_OBJ);
			return $resultSet;
		}
	}
?>