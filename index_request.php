<?php 

	require_once('include/index_db_utilities.php');

	$db_utilities = new IndexDb;

	if(isset($_POST['loadposts'])){
		echo $db_utilities->loadposts($_POST['limit_start'],$_POST['count']);
	}

	if(isset($_POST['post_user_id'])){
		echo $db_utilities->get_user_data($_POST['post_user_id']);
	}

	if(isset($_POST['comments_post_id'])){
		echo  $db_utilities->load_post_comments($_POST['comments_post_id']);
	}

	if(isset($_POST['check_likes_save_post_id'])){
		echo  $db_utilities->check_likes_save($_POST['check_likes_save_post_id']);
	}

	if(isset($_POST['add_comment'])){
		$db_utilities->add_comment($_POST['comment'],$_POST['add_comment_post_id']);
		echo $db_utilities->load_post_comments($_POST['add_comment_post_id']);
	}

	if(isset($_POST['liked_not_liked'])){
		echo $db_utilities->like_change_like_not_like($_POST['liked_not_liked_id']);
	}

	if(isset($_POST['saved_not_saved'])){
		echo $db_utilities->save_change_saved_not_saved($_POST['saved_not_saved_id']);
	}

	if(isset($_POST['load_user_self_data'])){
		echo $db_utilities->load_user_self_data();
	}

	if(isset($_POST['unfollow_user'])){
		$response = $db_utilities->unfollow_user($_POST['user_id']);
		if($response === false){
			echo 'error';
		} else {
			echo $response;
		}
	}

	if(isset($_POST['delete_post'])){
		$response = $db_utilities->delete_post($_POST['post_id']);
		if($response === false){
			echo 'error';
		} else {
			echo $response;
		}
	}

	if(isset($_POST['load_more_comments'])){
		echo $db_utilities->load_more_comments($_POST['more_comments_post_id'],$_POST['last_comment_id']);
	}

?>