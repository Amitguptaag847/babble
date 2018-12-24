
	<?php 

		session_start();
		require_once('include/header.php');
		if(!isset($_SESSION['user_id'])){
			header('location:account/login_signup.php');
		} 

	?>

    <link rel="stylesheet" href="css/edit_profile.css">

</head>
<body>
	
	<div class="pre_loader spinner"></div>

    <div class="conatiner">

    	<?php require_once('include/nav.php'); ?>
			
		<section class="center">
			<div class="row d-flex justify-content-center form_container">
				<div class="col-md-2 form_title_container">
					<div class="row form_title_lists">
						<a href="edit_profile.php" id="edit_profile">
							<div class="form_title d-flex align-items-center">
								Edit Profile
							</div>
						</a>
					</div>
					<div class="row form_title_lists active">
						<a href="change_password.php" id="change_password">
							<div class="form_title d-flex align-items-center">
								Change Password
							</div>
						</a>
					</div>
					<div class="row form_title_lists">
						<a href="#" id="aurthorised_application">
							<div class="form_title d-flex align-items-center">
								Aurthorised Applications
							</div>
						</a>
					</div>
					<div class="row form_title_lists">
						<a href="#" id="email_and_sms">
							<div class="form_title d-flex align-items-center">
								Email and SMS
							</div>
						</a>
					</div>
					<div class="row form_title_lists">
						<a href="#" id="manage_contact">
							<div class="form_title d-flex align-items-center">
								Manage Contacts
							</div>
						</a>
					</div>
					<div class="row form_title_lists">
						<a href="#" id="privacy_and_security">
							<div class="form_title d-flex align-items-center">
								Privacy and Security
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-7 form_content_container">
					<div class="row d-flex align-items-center profile_image_container">
						<div class="col-md-3 d-flex align-items-center justify-content-end left_content">
							<div class="profile_image_wrapper">
								<img src="image/amit.jpg" alt="">
							</div>
						</div>
						<div class="col-md-6 d-flex align-items-center right_content">
							<div class="user_info_container">
								<p class="displayed_username">Username</p>
							</div>
						</div>
					</div>

					<form action="" id="password_form">
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Old Password</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="password" id="oldpassword" name="oldpassword" class="form-control custom-form-control">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>New Password</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="password" id="newpassword" name="newpassword" class="form-control custom-form-control" >
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Confirm password</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="password" id="confirmpassword" name="confirmpassword" class="form-control custom-form-control" >
								</div>
							</div>
						</div>

						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="">
									<input type="submit" id="change_password" class="form-control btn btn-primary submit_btn" value="Change Password">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		
		<footer>
            <p><a href="#"><strong>About Devloper </strong></a>. <a href="#"><strong>About Us </strong></a><span>&copy; 2018</span> <a href="#"><strong> Babble</strong></a><span>.</span></p>
        </footer>
	</div>


 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
     <script src="js/nav.js"></script>
    <script src="js/change_password.js"></script>

</body>
</html>