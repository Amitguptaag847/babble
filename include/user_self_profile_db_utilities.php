<?php 

	session_start();
	require_once('db.php');

	class Db_utilities extends Database{
		function __construct(){
			parent::__construct();
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

		public function load_user_data(){
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`users` WHERE id = $user_id";
			$stmt = $this->pdo->query($sql);
			$row = $stmt->fetch();
			$row->password = "";

			$no_of_follower = $this->getNumberOfFollowers($user_id);
			$no_of_following = $this->getNumberOfFollowings($user_id);
			$no_of_posts = $this->getNumberOfPosts($user_id);

			$row = (object) array_merge((array)$row , array('no_of_follower'=>$no_of_follower));
			$row = (object) array_merge((array)$row , array('no_of_following'=>$no_of_following));
			$row = (object) array_merge((array)$row , array('no_of_posts'=>$no_of_posts));
			
			return json_encode($row);
		}

		public function load_user_self_post_template(){
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`posts` WHERE user_id = $user_id";
			$stmt = $this->pdo->query($sql);
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

		public function load_user_saved_post_template(){
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`savedposts` WHERE user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			$savedposts = array();
			while ($row_temp = $stmt->fetch()) {
				$savedpost_id = $row_temp->post_id;
				$sql_post = "SELECT * FROM `babble`.`posts` WHERE id = $savedpost_id";
				$stmt_post = $this->pdo->query($sql_post);
				while($row = $stmt_post->fetch()){
					$data = array();
					$data['id'] = $row->id;
					$data['thumbnail'] = $row->thumbnail;
					$data['post_type'] = $row->post_type;
					$data['no_of_likes'] = $this->getNumberOfLikes($row->id);
					$data['no_of_comments'] = $this->getNumberOfComments($row->id);
					$savedposts[] = $data;
				}
			}
			return json_encode($savedposts);
		}

		public function upload_post_type_photo($image_names_array,$description){
			$post_type = 'image';
			if(count($image_names_array)>1){
				$post_type = 'images';
			}
			$images_names = join('-',$image_names_array);
			$user_id = $_SESSION['user_id'];
			$thumbnail = $image_names_array[0];
			$sql = "INSERT INTO `babble`.`posts`(user_id,images_name,thumbnail,post_type,description) VALUES (:user_id,:images_name,:thumbnail,:post_type,:description)";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'user_id'=>$user_id,
				'images_name'=>$images_names,
				'thumbnail'=>$thumbnail,
				'post_type'=>$post_type,
				'description'=>$description
			];
			return $stmt->execute($exe);
		}

		public function upload_post_type_video($video_name,$description,$thumbnail){
			$post_type = 'video';
			$user_id = $_SESSION['user_id'];
			$sql = "INSERT INTO `babble`.`posts`(user_id,video,thumbnail,post_type,description) VALUES (:user_id,:video,:thumbnail,:post_type,:description)";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
				'user_id'=>$user_id,
				'video'=>$video_name,
				'thumbnail'=>$thumbnail,
				'post_type'=>$post_type,
				'description'=>$description
			];
			return $stmt->execute($exe);
		}
	}

	//$db = new Db_utilities;
	//echo $db->load_user_data();

?>