<?php 
	
	require_once('include/change_password_db_utilities.php');

	$db = new Db_utilities();

	
	if(isset($_POST['change_password'])){
		if($db->verify_user($_POST['oldpassword'])){
			if($db->update_password($_POST['newpassword'])){
				echo "success";
			} else {
				echo "error";
			}
		} else {
			echo "passwordNotMatch";
		}
	}

?>