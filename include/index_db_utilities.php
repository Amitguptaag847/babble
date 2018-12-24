<?php 
	
	session_start();
	header('Content-Type: application/json');
	require_once('db.php');

	class IndexDb extends Database {
		function __construct(){
			parent::__construct();
		}

		public function following_list(){
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`follower` WHERE user_id = $user_id AND following = 1";
			$stmt = $this->pdo->query($sql);
			$list = array();
			while($row = $stmt->fetch()){
				$list[] = $row->following_user_id;
			}
			$list[] = $_SESSION['user_id']; // For seeing users own post's
			return $list;
		}

		public function sortposts($posts,$limit,$count){
			$orderedposts = array();
			$posts_length = count($posts);
			for($i=0;$i<$posts_length;$i++){
				$max = $i;
				for($j=$i+1;$j<$posts_length;$j++){
					if($posts[$max]->id < $posts[$j]->id){
						$max = $j;
					}
				}

				$temp = $posts[$max];
				$posts[$max] = $posts[$i];
				$posts[$i] = $temp;
				if($limit == 0){
					$orderedposts[] = $posts[$i];
				} else {
					$limit--;
				}
				if(count($orderedposts) >= $count){
					break;
				}
			}
			return $orderedposts;
		}

		public function getNumberOfLikes($post_id){
			$sql = "SELECT * FROM `babble`.`likes` WHERE post_id = $post_id";
			$stmt = $this->pdo->query($sql);
			return $stmt->rowCount();
		}

		public function loadposts($limit,$count){
			$list = $this->following_list();
			$list_length = count($list);
			if(!$list){   #empty array itself is false
				return false;
			} else {
				$posts = array();
				$sql = "SELECT * FROM `babble`.`posts` ORDER BY id DESC";
				$stmt = $this->pdo->query($sql);
				while($row = $stmt->fetch()){
					if(in_array($row->user_id,$list)){
						if($row->user_id === $_SESSION['user_id']){
							$row = (object) array_merge((array)$row , array('users_self_post'=>true));
						} else {
							$row = (object) array_merge((array)$row , array('users_self_post'=>false));
						}
						$no_of_likes = $this->getNumberOfLikes($row->id);
						$row = (object) array_merge((array)$row , array('no_of_likes'=>$no_of_likes));
						$posts[] = $row;
					}
				}
				$posts = $this->sortposts($posts,$limit,$count);
				return json_encode($posts);
			}
		}

		public function get_user_data($user_id){
			$sql = "SELECT * FROM `babble`.`users` WHERE id = $user_id";
			$stmt = $this->pdo->query($sql);
			$row = $stmt->fetch();
			return json_encode($row);
		}

		public function load_post_comments($comment_post_id){
			$comments = array();
			$sql = "SELECT * FROM `babble`.`comments` WHERE post_id = $comment_post_id ORDER BY id DESC";
			$stmt = $this->pdo->query($sql);
			//echo $stmt->rowCount();
			while($row = $stmt->fetch()){
				$username = json_decode($this->get_user_data($row->commenter_id));
				$comment_data = $row->comment;
				$comment = array();
				$comment['commenter_id'] = $row->commenter_id;
				$comment['id'] = $row->id;
				$comment['username'] = $username->username;
				$comment['comment'] = $comment_data;
				$comments[] = $comment; 
				//echo $stmt->rowCount()."<br>";
				if(count($comments) >= 5){
					break;
				}
			}
			return json_encode($comments);
		}

		public function check_likes_save($check_likes_save_post_id){
			$data = array();
			$user_id =$_SESSION['user_id'];
			$sql = "SELECT * FROM `babble`.`likes` WHERE post_id = $check_likes_save_post_id AND user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			if($stmt->rowCount() == 0){
				$data['liked'] = false;
			} else {
				$row = $stmt->fetch();
				if($row->liked == 0){
					$data['liked'] = false;
				} else {
					$data['liked'] = true;
				}
			}
			$sql = "SELECT * FROM `babble`.`savedposts` WHERE post_id = $check_likes_save_post_id AND user_id = $user_id";
			$stmt = $this->pdo->query($sql);
			if($stmt->rowCount() == 0){
				$data['saved'] = false;
			} else {
				$row = $stmt->fetch();
				if($row->saved == 0){
					$data['saved'] = false;
				} else {
					$data['saved'] = true;
				}
			}
			return json_encode($data);
		}

		public function add_comment($comment,$post_id){
			$user_id = $_SESSION['user_id'];
			$sql = "INSERT INTO `babble`.`comments`(post_id,commenter_id,comment) VALUES(:post_id,:commenter_id,:comment)";
			$stmt = $this->pdo->prepare($sql);
			$exe = [
					'post_id'=>$post_id,
					'commenter_id'=>$user_id,
					'comment'=>$comment,
				];
			$stmt->execute($exe);
		}

		public function like_change_like_not_like($post_id){
			$user_id = $_SESSION['user_id'];
			$sql_check = "SELECT * FROM `babble`.`likes` WHERE user_id = $user_id AND post_id = $post_id";
			$stmt_check = $this->pdo->query($sql_check);
			if($stmt_check->rowCount() === 0){
				$sql = "INSERT INTO `babble`.`likes` (user_id,post_id) VALUES ($user_id,$post_id)";
				$stmt = $this->pdo->query($sql);

				$sql_count = "SELECT * FROM `babble`.`likes` WHERE post_id = $post_id";
				$stmt_count = $this->pdo->query($sql_count);
				$count = $stmt_count->rowCount();

				$json = array('liked'=>true,'notliked'=>false,'count'=>$count);

				return json_encode($json);
			} else {
				$row =  $stmt_check->fetch();
				if($row->liked == 1){
					$sql = "UPDATE `babble`.`likes` SET liked = 0 WHERE post_id = $post_id AND user_id = $user_id";
					$stmt = $this->pdo->query($sql);

					$sql_count = "SELECT * FROM `babble`.`likes` WHERE post_id = $post_id";
					$stmt_count = $this->pdo->query($sql_count);
					$count = $stmt_count->rowCount();

					$json = array('liked'=>false,'notliked'=>true,'count'=>$count);

					return json_encode($json);
				} else {
					$sql = "UPDATE `babble`.`likes` SET liked = 1 WHERE post_id = $post_id AND user_id = $user_id";
					$stmt = $this->pdo->query($sql);

					$sql_count = "SELECT * FROM `babble`.`likes` WHERE post_id = $post_id";
					$stmt_count = $this->pdo->query($sql_count);
					$count = $stmt_count->rowCount();

					$json = array('liked'=>true,'notliked'=>false,'count'=>$count);
					
					return json_encode($json);
				}
			}
		}

		public function save_change_saved_not_saved($post_id){
			$user_id = $_SESSION['user_id'];
			$sql_check = "SELECT * FROM `babble`.`savedposts` WHERE user_id = $user_id AND post_id = $post_id";
			$stmt_check = $this->pdo->query($sql_check);
			if($stmt_check->rowCount() === 0){
				$sql = "INSERT INTO `babble`.`savedposts` (user_id,post_id) VALUES ($user_id,$post_id)";
				$stmt = $this->pdo->query($sql);

				$json = array('saved'=>true,'notsaved'=>false);

				return json_encode($json);
			} else {
				$row =  $stmt_check->fetch();
				if($row->saved == 1){
					$sql = "UPDATE `babble`.`savedposts` SET saved = 0 WHERE post_id = $post_id AND user_id = $user_id";
					$stmt = $this->pdo->query($sql);

					$json = array('saved'=>false,'notsaved'=>true);
					
					return json_encode($json);
				} else {
					$sql = "UPDATE `babble`.`savedposts` SET saved = 1 WHERE post_id = $post_id AND user_id = $user_id";
					$stmt = $this->pdo->query($sql);

					$json = array('saved'=>true,'notsaved'=>false);
					
					return json_encode($json);
				}
			}
		}

		function load_user_self_data(){
			$datas = json_decode($this->get_user_data($_SESSION['user_id']));
			$data = array();
			$data['username'] = $datas->username;
			$data['user_id'] = $_SESSION['user_id'];
			$data['profileimage'] = $datas->profileimage;
			$data['fullname'] =  $datas->fullname;
			return json_encode($data);
		}

		public function unfollow_user($user_id){
			$user_self_id = $_SESSION['user_id'];
			$sql_check = "SELECT * FROM `babble`.`follower` WHERE user_id = $user_self_id AND following_user_id = :user_id";
			$stmt_check = $this->pdo->prepare($sql_check);
			$stmt_check->execute(['user_id'=>$user_id]);
			if($stmt_check->rowCount() === 0){
				return false;
			} else {
				$row = $stmt_check->fetch();
				if($row->following == 1){ // dont give === they are of different type
					$sql_update = 'UPDATE `babble`.`follower` SET following = 0 WHERE user_id = :user_self_id AND following_user_id = :user_id';
					$stmt_update = $this->pdo->prepare($sql_update);
					if($stmt_update->execute(['user_self_id'=>$user_self_id,'user_id'=>$user_id])){
						return 'success';
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		}

		public function delete_post($post_id){
			$post_user_id = $_SESSION['user_id'];
			$sql_check = "SELECT * FROM `babble`.`posts` WHERE user_id = $post_user_id AND id = :post_id";
			$stmt_check = $this->pdo->prepare($sql_check);
			$stmt_check->execute(['post_id'=>$post_id]);
			if($stmt_check->rowCount() === 0){
				return false;
			} else {
				$sql_delete = 'DELETE FROM `babble`.`posts` WHERE id = :post_id';
				$stmt_delete = $this->pdo->prepare($sql_delete);
				if($stmt_delete->execute(['post_id'=>$post_id])){
					return 'success';
				} else {
					return false;
				}
			}
		}

		public function load_more_comments($post_id,$last_comment_id){
			$comments = array();
			$sql = "SELECT * FROM `babble`.`comments` WHERE post_id = $post_id AND id < $last_comment_id ORDER BY id DESC";
			$stmt = $this->pdo->query($sql);
			//echo $stmt->rowCount();
			while($row = $stmt->fetch()){
				$username = json_decode($this->get_user_data($row->commenter_id));
				$comment_data = $row->comment;
				$comment = array();
				$comment['commenter_id'] = $row->commenter_id;
				$comment['id'] = $row->id;
				$comment['username'] = $username->username;
				$comment['comment'] = $comment_data;
				$comments[] = $comment; 
				//echo $stmt->rowCount()."<br>";
				if(count($comments) >= 11){
					break;
				}
			}
			return json_encode($comments);
		}

	}

	// $db = new IndexDb;
	// $db->add_comment("new",7);

?>