<?php 

	session_start();
	require_once('db.php');

	class Db_utilities extends Database{
		function __construct(){
			parent::__construct();
		}

		public function checkUser($user_id){
			$sql = "SELECT * FROM `babble`.`users` WHERE id = :user_id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['user_id'=>$user_id]);
			if($stmt->rowCount() === 1){
				return true;
			} else {
				return false;
			}
		}

		public function getNumberOfLikes($post_id){
			$sql = "SELECT * FROM `babble`.`likes` WHERE post_id = $post_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}

		public function getNumberOfComments($post_id){
			$sql = "SELECT * FROM `babble`.`comments` WHERE post_id = $post_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}

		public function getNumberOfFollowers($user_id){
			$sql = "SELECT * FROM `babble`.`follower` WHERE following_user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}

		public function getNumberOfFollowings($user_id){
			$sql = "SELECT * FROM `babble`.`follower` WHERE user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}

		public function getNumberOfPosts($user_id){
			$sql = "SELECT * FROM `babble`.`posts` WHERE user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}
		public function load_user_data($user_id){
			$user_self_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`users` WHERE id = :user_id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['user_id'=>$user_id]);
			$row = $stmt->fetch();
			$row->password = "";

			$no_of_follower = $this->getNumberOfFollowers($user_id);
			$no_of_following = $this->getNumberOfFollowings($user_id);
			$no_of_posts = $this->getNumberOfPosts($user_id);

			$row = (object) array_merge((array)$row , array('no_of_follower'=>$no_of_follower));
			$row = (object) array_merge((array)$row , array('no_of_following'=>$no_of_following));
			$row = (object) array_merge((array)$row , array('no_of_posts'=>$no_of_posts));
			
			$sql_following = "SELECT * FROM `babble`.`follower` WHERE user_id = :user_self_id AND following_user_id = :user_id AND following = 1";
			$stmt_following = $this->pdo->prepare($sql_following);
			$stmt_following->execute(['user_self_id'=>$user_self_id, 'user_id'=>$user_id]);
			if($stmt_following->rowCount() === 0){
				$row = (object) array_merge((array)$row , array('following'=>false));
			} else {
				$row = (object) array_merge((array)$row , array('following'=>true));
			}
			return json_encode($row);
		}

		public function load_user_post_template($user_id){
			$sql = "SELECT * FROM `babble`.`posts` WHERE user_id = :user_id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(['user_id'=>$user_id]);
			$datas = array();
			while($row = $stmt->fetch()){
				$data = array();
				$data['id'] = $row->id;
				$data['thumbnail'] = $row->thumbnail;
				$data['post_type'] = $row->post_type;
				$data['no_of_likes'] = $this->getNumberOfLikes($row->id);
				$data['no_of_comments'] = $this->getNumberOfComments($row->id);
				$datas[] = $data;
			}
			return json_encode($datas);
		}

		public function change_follow_following($user_id){
			$user_self_id = $_SESSION['user_id'];
			$sql_check = "SELECT * FROM `babble`.`follower` WHERE user_id = $user_self_id AND following_user_id = :user_id";
			$stmt_check = $this->pdo->prepare($sql_check);
			$stmt_check->execute(['user_id'=>$user_id]);
			if($stmt_check->rowCount() === 0){
				$sql_insert = 'INSERT INTO `babble`.`follower`(user_id,following_user_id) VALUES (:user_self_id,:user_id)';
				$stmt_insert = $this->pdo->prepare($sql_insert);
				if($stmt_insert->execute(['user_self_id'=>$user_self_id,'user_id'=>$user_id])){
					return 'Following';
				} else {
					return false;
				}
			} else {
				$row = $stmt_check->fetch();
				if($row->following == 1){ // dont give === they are of different type
					$sql_update = 'UPDATE `babble`.`follower` SET following = 0 WHERE user_id = :user_self_id AND following_user_id = :user_id';
					$stmt_update = $this->pdo->prepare($sql_update);
					if($stmt_update->execute(['user_self_id'=>$user_self_id,'user_id'=>$user_id])){
						return 'Follow';
					} else {
						return false;
					}
				} else {
					$sql_update = 'UPDATE `babble`.`follower` SET following = 1 WHERE user_id = :user_self_id AND following_user_id = :user_id';
					$stmt_update = $this->pdo->prepare($sql_update);
					if($stmt_update->execute(['user_self_id'=>$user_self_id,'user_id'=>$user_id])){
						return 'Following';
					} else {
						return false;
					}
				}
			}
		}
	}

	// $db = new Db_utilities;
	// echo $db->load_user_post_template(2);

?>