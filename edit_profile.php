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
					<div class="row form_title_lists active">
						<a href="edit_profile.php" id="edit_profile">
							<div class="form_title d-flex align-items-center">
								Edit Profile
							</div>
						</a>
					</div>
					<div class="row form_title_lists">
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
								<a href="" data-toggle="modal" data-target="#change_profile_photo_modal"><img src="" alt=""></a>
							</div>
						</div>
						<div class="col-md-6 d-flex align-items-center right_content">
							<div class="user_info_container">
								<p class="displayed_username">Username</p>
								<p class="edit_profile_photo"><a href="" data-toggle="modal" data-target="#change_profile_photo_modal">Edit Profile Photo</a></p>
							</div>
						</div>
						<div class="modal" id="change_profile_photo_modal" tabindex="-1" role="dialog" aria-labelledby="change_profile_photo_modal" aria-hidden="true">
  							<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title w-100 text-center">Change Profile Photo</h5>
									</div>
									<div class="modal-header upload_profile_photo">
									    <p class="modal-title w-100 text-center text-primary"><b>Upload Photo</b></p>
									    <input type="file" name="profile_image" accept="image/*">
									</div>
									<a href="#" id='remove_photo'>
										<div class="modal-header">
										    <p class="modal-title w-100 text-center text-danger"><b>Remove Current Photo</b></p>
										</div>
									</a>
						      		<a href="#" id='cancel_modal' data-dismiss="modal" aria-label="Close">
										<div class="modal-header">
						        			<p class="modal-title w-100 text-center">Cancel</p>
										</div>
									</a>
								</div>
						  	</div>
						</div>
					</div>

					<form action="" id="info_form">
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Name</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="text" id="name" name="fullname" class="form-control custom-form-control" value="">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Username</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="text" id="username" name="username" class="form-control custom-form-control" value="">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Website</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="text" id="website" name="website" class="form-control custom-form-control" value="">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Bio</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<textarea name="user_bio" id="user_bio" rows="1" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
							</div>
							<div class="col-md-6 d-flex right_content">
								<div>
									<p class="private_info_text">Private Information</p>
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Email</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="text" id="email" name="email" class="form-control custom-form-control" value="amitgupta.ag847@gmail.com">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Phone Number</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group custom-form-group">
									<input type="text" id="phonenumber" name="phonenumber" class="form-control custom-form-control" value="8013011730">
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								<p>Gender</p>
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="form-group">
									<select name="gender" id="gender" class="form-control">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="not_specified">Not Specified</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row d-flex custom-form-row">
							<div class="col-md-3 d-flex justify-content-end left_content">
								
							</div>
							<div class="col-md-6 d-flex right_content">
								<div class="">
									<input type="submit" id="submit_user_info" name="submit_user_info" class="form-control btn btn-primary submit_btn" value="Submit">
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
    <script src="js/edit_profile.js"></script>

</body>
</html>