    
    <?php 
    	
    	session_start();
    	if(!isset($_SESSION['user_id'])){
    		header('location:account/login_signup.php');
    	}

    	require_once('include/header.php');
    ?>

    <link rel="stylesheet" href="css/croppie.css">
    <link rel="stylesheet" href="css/user_self_profile.css">

</head>
<body>
	
	<div class="pre_loader spinner"></div>

    <div class="conatiner">

    	<?php require_once('include/nav.php'); ?>
			
		<section class="center">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-10 main_container">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-10">
							<div class="row profile_details_container d-flex align-items-center">
								<div class="col-md-3">
									<div class="profile_picture_wrapper">
										<img src="" alt="">
									</div>
								</div>
								<div class="col-md-8">
									<div class="profile_info">
										<div class="row profile_edit_container d-flex align-items-center">
											<div>
												<h3 class="user_self_username"></h3>
											</div>
											<div>
												<button class="btn edit_profile_btn">Edit Profile</button>
											</div>
											<div>
												<button class="btn setting_icon" data-toggle="modal" data-target="#setting_options"><i class="fas fa-cog"></i></button>
												<div class="modal" id="setting_options" tabindex="-1" role="dialog" aria-labelledby="setting_options" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
														<div class="modal-content">
															<a href="change_password.php">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Change Password</p>
																</span>
															</a>
															<a href="#">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Notifications</p>
																</span>
															</a>
															<a href="#">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Privacy and Security</p>
																</span>
															</a>
															<a href="#" class="logout_btn">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Log Out</p>
																</span>
															</a>
															<a href="#" data-dismiss="modal" aria-label="close">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Cancel</p>
																</span>
															</a>
														</div>
														
													</div>
												</div>
											</div>
										</div>
										<div class="row posts_follower_count_container d-flex align-items-center">
											<div>
												<p><span class="font-weight-bold posts_count">0 </span>Posts</p>
											</div>
											<div>
												<a href="#"><p><span class="font-weight-bold followers_count">0 </span>followers</p></a>
											</div>
											<div>
												<a href="#"><p><span class="font-weight-bold followings_count">0 </span>following</p></a>
											</div>
										</div>
										<div class="row full_name_bio_website_container d-flex align-items-center">
											<div class="users_name_container">
												<p class="font-weight-bold"></p>
											</div>
											<div class="users_bio_container">
												<p></p>
											</div>
											<div class="users_wesite_container">
												<a href="#"><p class="font-weight-bold"></p></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<hr>
					
					<div class="row d-flex justify-content-center view_add_posts_stories">
						<div>
							<p class="user_self_posts"><a href="#" class="active"><i class="fas fa-th"></i> Posts</a></p>
						</div>
						<div>
							<p class="user_posts_saved"><a href="#"><i class="fas fa-bookmark"></i> Saved</a></p>
						</div>
						<div>
							<p class="user_add_posts"><a href="#"><i class="fas fa-plus-square"></i> Add Posts</a></p>
						</div>
						<div>
							<p class="user_add_stories"><a href="#"><i class="fas fa-plus"></i> Add Stories</a></p>
						</div>
					</div>

					<div class="row posts_template_container d-none">
						<div class="posts_template" id="template0">
							<div class="posts_template_overlay d-flex align-items-center">
								<a href="#">
									<div class="d-flex justify-content-center align-items-center">
										<p class="posts_template_overlay_text"><span class="posts_template_likes"><i class="fas fa-heart"></i> <span id="likes_count"></span></span><span class="posts_template_comments"><i class="fas fa-comment"></i> <span id="comments_count"></span></span></p>
									</div>
								</a>
							</div>
							<div class="posts_type posts_type_video">
								<i class="fas fa-video"></i>
							</div>
							<div class="posts_type posts_type_multi_pic">
								<i class="fas fa-clone"></i>
							</div>
							<img src="image/image1.jpg" alt="">
						</div>
					</div>

					<div class="row posts_template_container" id="self_posts_template_container">
					</div>
					<div class="row posts_template_container" id="saved_posts_template_container"></div>

					<div class="row d-flex justify-content-center add_posts_container">
						<div class="col-md-7 temp d-none">
							<div class="row d-flex add_upload_photo_btn_container">
								<div class="btn btn-primary add_video_btn">
									<p class="d-flex align-items-center justify-content-center">Add Video</p>
									<input type="file" name="video" accept="video/mp4,video/x-m4v,video/*">
								</div>
								<div class="btn btn-primary add_photo_btn">
									<p class="d-flex align-items-center justify-content-center">Add Photo</p>
									<input type="file" name="image" accept="image/*" multiple>
								</div>
								<button class="btn btn-primary upload_post_btn">
									Upload Posts
								</button>
							</div>
							<div class="row d-flex justify-content-between description_container">
								<div class="form-group">
									Write Description :
									<textarea name="description" id="description" cols="100" rows="1" class="form-control" title="Write Description"></textarea>
								</div>
							</div>
							<div class="row added_photo_container">
								<div class="added_photo" id="added_photo-0">
									<button class="btn remove_photo_btn" title="remove photo">&times;</button>
									<img src="" alt="">
								</div>
								<div class="row added_photo_preview">
									
								</div>
							</div>
							<div class="row added_video_container">
								<div class="added_video" id="added_video-0">
									<button class="btn remove_video_btn" title="remove video">&times;</button>
									<video src="" controls></video>
								</div>
								<div class="row added_video_preview">
									
								</div>
							</div>

						</div>
					</div>

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
    <script src="js/user_self_profile.js"></script>

</body>
</html>