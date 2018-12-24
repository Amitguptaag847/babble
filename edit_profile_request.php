<?php 
	
	require_once('include/edit_profile_db_utilities.php');

	$db = new Db_utilities();

	if(isset($_POST['load_user_info'])){
		echo $db->load_user_info();
	}

	if(isset($_POST['submit_user_info'])){
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$user_bio = $_POST['user_bio'];
		$website = $_POST['website'];
		$phonenumber = $_POST['phonenumber'];
		$gender = $_POST['gender'];
		if($db->update_user_info($fullname,$username,$email,$phonenumber,$user_bio,$gender,$website)){
			echo 'success';
		} else {
			echo 'error';
		}
	}

	if(isset($_POST['upload_profile_photo'])){
		$image_name  = $_FILES['profilephoto']['name'];
		$image_tmp_name = $_FILES['profilephoto']['tmp_name'];
		$image_error = $_FILES['profilephoto']['error'];
		$image_name_array = explode('.',$image_name);
		$image_extension = strtolower(end($image_name_array));
		$allowed_image_type = array('jpeg','jpg','png');
		if($image_error === 0){
			if(in_array($image_extension, $allowed_image_type)){
				$image_name = uniqid('',true).".".$image_extension;
				$image_destination = 'image/'.$image_name;
				move_uploaded_file($image_tmp_name, $image_destination);
				if($db->upload_profile_photo($image_name)){
					echo "success";
				} else {
					echo "error";
				}
			} else {
				echo "error";
			}
		} else {
			echo "error";
		}
	}

	if(isset($_POST['remove_photo'])){
		if($db->remove_photo()){
			echo "success";
		} else {
			echo "error";
		}
	}
?>