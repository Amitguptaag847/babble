<?php 

	session_start();
	require_once('db.php');

	class nav_db_utilities extends Database{
		function __construct(){
			parent::__construct();
		}

		public function search_user($username){
			$sql = "SELECT * FROM `babble`.`users` WHERE username LIKE ? LIMIT 30";
			$stmt = $this->pdo->prepare($sql);
			$exe = $username.'%';
			$stmt->bindParam(1,$exe);
			$stmt->execute();
			$datas = array();
			while($row = $stmt->fetch()){
				if($row->id != $_SESSION['user_id']){
					$data = array();
					$data['id'] = $row->id;
					$data['username'] = $row->username;
					$data['profile_image'] = $row->profileimage;
					$data['full_name'] = $row->fullname;
					$datas[] = $data;
				}
			}
			return json_encode($datas);
		}

		public function get_user_self_id(){
			return $_SESSION['user_id'];
		}
	}
?>