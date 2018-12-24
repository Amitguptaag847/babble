<?php 

	session_start();
	require_once('db.php');

	class Db_utilities extends Database{
		function __construct(){
			parent::__construct();
		}

		public function load_user_info(){
			$user_id = $_SESSION['user_id'];
			$sql = 'SELECT * FROM `babble`.`users` WHERE id = :user_id';
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['user_id'=>$user_id]);
			if($stmt->rowCount() === 1){
				$row = $stmt->fetch();
				$row->password = '';
				return json_encode($row);
			} else {
				return 'error';
			}
		}

		public function update_user_info($fullname,$username,$email,$phonenumber,$user_bio,$gender,$website){
			$user_id = $_SESSION['user_id'];
			$sql = "UPDATE `babble`.`users` SET fullname = :fullname , username = :username , email = :email , phonenumber = :phonenumber, bio = :bio, gender = :gender, website = :website WHERE id = $user_id";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'fullname'=>$fullname,
				'username'=>$username,
				'email'=>$email,
				'phonenumber'=>$phonenumber,
				'bio'=>$user_bio,
				'gender'=>$gender,
				'website'=>$website
			];
			if($stmt->execute($exe)){
				return true;
			} else {
				return false;
			}
		}

		public function upload_profile_photo($image_name){
			$user_id = $_SESSION['user_id'];
			$sql = "UPDATE `babble`.`users` SET profileimage = :image_name WHERE id = $user_id";
			$stmt = $this->pdo->prepare($sql);
			if($stmt->execute(['image_name'=>$image_name])){
				return true;
			} else {
				return false;
			}
		}

		public function remove_photo(){
			$image_name = 'unknown.jpg';
			$user_id = $_SESSION['user_id'];
			$sql = "UPDATE `babble`.`users` SET profileimage = :image_name WHERE id = $user_id";
			$stmt = $this->pdo->prepare($sql);
			if($stmt->execute(['image_name'=>$image_name])){
				return true;
			} else {
				return false;
			}
		}
	}
?>