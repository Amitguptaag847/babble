<?php 

	session_start();
	require_once('db.php');

	class Db_utilities extends Database{
		function __construct(){
			parent::__construct();
		}

		public function verify_user($password){
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT password FROM `babble`.`users` WHERE id = $user_id";
			$stmt = $this->pdo->query($sql);
			$row = $stmt->fetch();
			return password_verify($password,$row->password);
		}

		public function update_password($password){
			$user_id = $_SESSION['user_id'];
			$option = [
				'cost'=>10,
			];
			$hashed_password = password_hash($password,PASSWORD_BCRYPT,$option);
			$sql = "UPDATE `babble`.`users` SET password = :hashed_password WHERE id = $user_id";
			$stmt = $this->pdo->prepare($sql);
			return $stmt->execute(['hashed_password'=>$hashed_password]);
		}
	}
?>