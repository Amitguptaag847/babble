<?php 
	
	require_once('../include/db_login_signup_utilities.php');

	$db_utilities = new DbLoginSignup;

	#signup phone number chech

	if(isset($_POST['signupEmailPhonenumberValidate'])){
		$valid = 0;
		if(filter_var($_POST['signupEmailPhonenumberValidate'], FILTER_VALIDATE_EMAIL)){
			if($db_utilities->checkEmail($_POST['signupEmailPhonenumberValidate']) == 0){
				$valid = 1;
			}
		} else if(preg_match("/^[0-9]{10}$/",$_POST['signupEmailPhonenumberValidate'])){
			if($db_utilities->checkPhonenumber($_POST['signupEmailPhonenumberValidate']) == 0){
				$valid = 1;
			}
		}
		echo $valid;
	}

	#username check

	if(isset($_POST['usernameValidate'])){
		if($db_utilities->checkUsername($_POST['usernameValidate']) == 0){
			echo 1;
		} else {
			echo 0;
		}
	}


	#password validation

	if(isset($_POST['passwordValidate'])){
		$pattern = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@$#&%^*])[0-9A-Za-z!@$#&%^*]{8,18}$/";
		if(preg_match($pattern,$_POST['passwordValidate'])){
			echo 1;
		} else {
			echo 0;
		}
	}

	#signup check

	if(isset($_POST['signup'])){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$emailOrPhonenumber = $_POST['emailOrPhonenumber'];
		$password = $_POST['password'];
		if($db_utilities->addUser($username,$emailOrPhonenumber,$fullname,$password)){
			echo 1;
		} else {
			echo 0;
		}
	}

	#login check

	if(isset($_POST['login'])){
		$usernameOrEmailOrPhonenumber = $_POST['usernameOrEmailOrPhonenumber'];
		$password = $_POST['loginpassword'];
		$email = '';
		$phonenumber = '';
		$username = '';
		if(filter_var($usernameOrEmailOrPhonenumber,FILTER_VALIDATE_EMAIL)){
			$email = $usernameOrEmailOrPhonenumber;
			if($db_utilities->loginTypeEmail($email,$password)){
				echo 1;
			} else {
				echo "Email and Password does not match";
			}
		} else if(preg_match("/^[0-9]{10}$/",$usernameOrEmailOrPhonenumber)){
			$phonenumber = $usernameOrEmailOrPhonenumber;
			if($db_utilities->loginTypePhonenumber($phonenumber,$password)){
				echo 1;
			} else {
				echo "Phone number and Password does not match";
			}
		} else {
			$username = $usernameOrEmailOrPhonenumber;
			if($db_utilities->loginTypeUsername($username,$password)){
				echo 1;
			} else {
				echo "Username and Password does not match";
			}
		}
	}

?>