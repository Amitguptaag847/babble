<?php 

	require_once('include/user_self_profile_db_utilities.php');

	/*

	Commands

	-i Input file name
	-an Disabled audio
	-ss Get image from X seconds in the video
	-s Size of image

	*/

	$db = new Db_utilities;

	if(isset($_POST['load_user_data'])){
		echo $db->load_user_data();
	}

	if(isset($_POST['load_user_self_post_template'])){
		echo $db->load_user_self_post_template();
	}

	if(isset($_POST['load_user_saved_post_template'])){
		echo $db->load_user_saved_post_template();
	}

	if(isset($_POST['upload_post'])){
		if($_POST['upload_type'] === 'photos'){
			$images_names = array();
			$allowed_image_type = array('jpeg','jpg','png');
			foreach ($_FILES as $key => $value) {
				$image_name = $_FILES[$key]['name'];
				$image_tmp_name = $_FILES[$key]['tmp_name'];
				$image_error = $_FILES[$key]['error'];
				$image_name_arr = explode('.',$image_name);
				$ext = strtolower(end($image_name_arr));
				if($image_error === 0){
					if(in_array($ext, $allowed_image_type)){
						$image_name = uniqid('',true).".".$ext;
						$image_destination = 'image/'.$image_name;
						$images_names[] = $image_name;
						move_uploaded_file($image_tmp_name, $image_destination);
					} else {
						echo "failed_due_to_image_type_error";
						return;
					}
				} else {
					echo 'failed_due_to_image_error';
					return;
				}
			}
			if($db->upload_post_type_photo($images_names,$_POST['description'])){
				echo 'success';
			} else {
				echo  'failed_due_to_database_error';
			}
		} else if($_POST['upload_type'] === 'video'){

			$ffmpeg = "C:\\FFmpeg\\bin\\ffmpeg";
			$thumnail = '';
			foreach ($_FILES as $key => $value) {
				$video_name = $_FILES[$key]['name'];
				$video_tmp_name = $_FILES[$key]['tmp_name'];
				$video_error = $_FILES[$key]['error'];
				$video_name_arr = explode('.',$video_name);
				$ext = strtolower(end($video_name_arr));
				if($video_error === 0){
					$video_name = uniqid('',true).".".$ext;
					$thumnail = uniqid('',true).".jpg";
					$thumnail_destination = 'image/'.$thumnail;
					$size = "640x640";
					$getFromSeconds = 5;
					$cmd = "$ffmpeg -i $video_tmp_name -an -ss $getFromSeconds -s $size $thumnail_destination";
					shell_exec($cmd);
					$video_destination = 'video/'.$video_name;
					move_uploaded_file($video_tmp_name, $video_destination);
				} else {
					echo 'failed_due_to_video_error';
					return;
				}
			}
			if($db->upload_post_type_video($video_name,$_POST['description'],$thumnail)){
				echo 'success';
			} else {
				echo  'failed_due_to_database_error';
			}
		}
	}
?>