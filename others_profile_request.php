<?php 

	require_once('include/others_profile_db_utilities.php');
	$db = new Db_utilities;

	if(isset($_POST['load_user_data'])){
		if($db->checkUser($_POST['user_id'])){
			echo $db->load_user_data($_POST['user_id']);
		} else {
			echo "user_does_not_exist";
		}
	}

	if(isset($_POST['load_user_post_template'])){
		echo $db->load_user_post_template($_POST['user_id']); 
	}

	if(isset($_POST['change_follow_following'])){
		$response = $db->change_follow_following($_POST['user_id']);
		if($response === false){
			echo 'error';
		} else {
			echo $response;
		}
	}

?>