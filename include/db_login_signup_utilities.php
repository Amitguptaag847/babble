<?php 

	session_start();
	require_once('db.php');
	
	class DbLoginSignup extends Database{

		function __construct(){
			parent::__construct();
		}

		public function checkUsername($username){
			$sql = "SELECT * FROM `babble`.`users` WHERE username = :username";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['username'=>$username]);
			return $stmt->rowCount();
		}

		public function checkEmail($email){
			$sql = "SELECT * FROM `babble`.`users` WHERE email = :email";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['email'=>$email]);
			return $stmt->rowCount();
		}

		public function checkPhonenumber($phonenumber){
			$sql = "SELECT * FROM `babble`.`users` WHERE phonenumber = :phonenumber";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['phonenumber'=>$phonenumber]);
			return $stmt->rowCount();
		}

		public function setSession($username){
			$sql = "SELECT * FROM `babble`.`users` WHERE username = :username";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['username'=>$username]);
			$row = $stmt->fetch();
			$_SESSION['username'] = $row->username;
			$_SESSION['user_id'] = $row->id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['profileimage'] = $row->profileimage;
		}

		public function addUser($username,$emailOrPhonenumber,$fullname,$password){
			$cost = [
				'cost' => 10,
			];
			$hashedpassword = password_hash($password,PASSWORD_BCRYPT,$cost);
			$email = "";
			$phonenumber = "";
			if(filter_var($emailOrPhonenumber,FILTER_VALIDATE_EMAIL)){
				$email = $emailOrPhonenumber;
			} else {
				$phonenumber = $emailOrPhonenumber;
			}
			$sql = "INSERT INTO `babble`.`users` (username,email,phonenumber,fullname,password) VALUES (:username , :email , :phonenumber , :fullname , :password)";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'username' => $username,
				'email' => $email,
				'phonenumber' => $phonenumber,
				'fullname' => $fullname,
				'password' => $hashedpassword,
			];
			$execution = $stmt->execute($exe);
			$this->setSession($username);
			return $execution;
		}

		public function loginTypeEmail($email,$password){
			$sql = "SELECT * FROM `babble`.`users` WHERE email = :email";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['email'=>$email]);
			if($stmt->rowCount()==1){
				$row = $stmt->fetch();
				$user_password = $row->password;
				if(password_verify($password,$user_password)){
					$this->setSession($row->username);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function loginTypePhonenumber($phonenumber,$password){
			$sql = "SELECT * FROM `babble`.`users` WHERE phonenumber = :phonenumber";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['phonenumber'=>$phonenumber]);
			if($stmt->rowCount()==1){
				$row = $stmt->fetch();
				$user_password = $row->password;
				if(password_verify($password,$user_password)){
					$this->setSession($row->username);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function loginTypeUsername($username,$password){
			$sql = "SELECT * FROM `babble`.`users` WHERE username = :username";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['username'=>$username]);
			if($stmt->rowCount()==1){
				$row = $stmt->fetch();
				$user_password = $row->password;
				if(password_verify($password,$user_password)){
					$this->setSession($row->username);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

?>