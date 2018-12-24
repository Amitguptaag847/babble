
	<?php 
		session_start();
		if(!isset($_SESSION['user_id'])){
			header('location:account/login_signup.php');
		} 
		if(!isset($_GET['user_id'])){
			header('location:index.php');
		}
		if($_SESSION['user_id'] === $_GET['user_id']){
			header('location:user_self_profile.php');
		}
		require_once('include/header.php');
	?>

    <link rel="stylesheet" href="css/others_profile.css">

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
										<img src="image/image1.jpg" alt="">
									</div>
								</div>
								<div class="col-md-8">
									<div class="profile_info">
										<div class="row profile_info_details_container d-flex align-items-center">
											<div>
												<h3 class="user_self_username">amitgupta.ag847</h3>
											</div>
											<div>
												<button class="btn follow_following_btn">Following</button> <!--Change css too-->
											</div>
											<div>
												<button class="btn user_options_btn" style="background: transparent;" data-toggle="modal" data-target="#user_options"><i class="fas fa-ellipsis-h"></i></button>
												<div class="modal" id="user_options" tabindex="-1" role="dialog" aria-labelledby="user_options" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
														<div class="modal-content">
															<a href="#">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Block this user</p>
																</span>
															</a>
															<a href="#">
																<span class="modal-header">
																	<p class="modal-title w-100 text-center">Report user</p>
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

					<hr><br>

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

					<div class="row posts_template_container" id="user_posts_template_container">
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
    <script src="js/others_profile.js"></script>

</body>
</html>