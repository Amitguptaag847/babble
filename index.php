	
	<?php 

		session_start();
		require_once('include/header.php');
		if(!isset($_SESSION['user_id'])){
			header('location:account/login_signup.php');
		} 

	?>

</head>
<body>
	
	<div class="pre_loader spinner"></div>

    <div class="conatiner"><!--Dont correct the spelling wesite will Look realy bad :( -->

    	<?php require_once('include/nav.php'); ?>
	
		<section class="center">
			<div class="row d-flex justify-content-center">

				<div class="col-lg-6"><!--Start Left Section-->
					<div class="posts_container">
						<div class="row posts" id="post0">
							<div class="col-lg-12">
								<div class="row user_posts_title_container d-flex align-items-center">
									<div class="profile_image_wrapper">
										<a href="#"><img src="image/amit.jpg" alt=""></a>
									</div>
									<div class="user_info_container">
										<p class="user_username"><a href="#">Username</a></p>
									</div>
								</div>
								<div class="row images_post">
									<div class="col-lg-12">
										<div id="imageIndicators" class="carousel slide" data-ride="carousel">
											<ol class="carousel-indicators">
											    <!--Indicators will append here-->
											</ol>
											<div class="carousel-inner">
											    <!--Items will append here-->
											</div>
											<a class="carousel-control-prev" href="#imageIndicators" role="button" data-slide="prev">
											    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
											    <span class="sr-only">Previous</span>
											</a>
											  	<a class="carousel-control-next" href="#imageIndicators" role="button" data-slide="next">
											    <span class="carousel-control-next-icon" aria-hidden="true"></span>
											    <span class="sr-only">Next</span>
											</a>
										</div>
									</div>
								</div>
								<div class="row image_post">
									<div class="col-lg-12">
										<div class="image_post_container">
											<img src="" alt="">
										</div>
									</div>
								</div>
								<div class="row video_post">
									<div class="col-lg-12">
										<div class="video_posts_container">
											<video src="" controls></video>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 likes_comment_container">
										<p><span class="not_liked"><i class="far fa-heart"></i></span><span class="liked"><i class="fas fa-heart"></i></span><span class="comment_icon_btn"><i class="far fa-comment"></i></span><span class="not_saved float-right"><i class="far fa-bookmark"></i></span><span class="saved float-right"><i class="fas fa-bookmark"></i></span></p>
										<p class="likes_count"><!--Likes count will append here--></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 posts_description_container">
										<p><span class="user_username"><a href="#">Username </a></span>    <span class="posts_description"></span><span class="more_description d-none"></span><span class="more_description_link">... <a href="#">more</a></span></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 comments_view_container">
										<p class="load_more_comments d-none"><a href="load_more_comments" id="">Load More Comments</a></p>
										<p class="comments d-none" id="comment_view_template"><span class="user_username"><a href="#"></a></span> <span class="user_comment"></span></p>
										<div>
											<!--Comments Will Append Here-->
										</div>
										<p class="posts_date_time" title="29 June">13 HOURS AGO</p>
									</div>
								</div>
								<hr>
								<div class="row writing_section">
									<div class="col-lg-11 write_comment" id="your_comment_input0">
										<form>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Add a comment">
											</div>
										</form>
									</div>
									<div class="col-lg-1">
										<button class="btn post_modal_activator_btn" data-toggle="modal" data-target="#posts_options_modal">...</button>
										<div class="modal" id="posts_options_modal" tabindex="-1" role="dialog" aria-labelledby="posts_options_modal" aria-hidden="true">
  											<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
										    	<div class="modal-content">
										    		<a href="" class="go_to_post">
										      			<div class="modal-header">
										        			<p class="modal-title w-100 text-center">Go To Post</p>
										      			</div>
										      		</a>
										      		<a href="" class="reprort_inappropriate d-none">
										      			<div class="modal-header">
										        			<p class="modal-title w-100 text-center">Reprort inappropriate</p>
										      			</div>
										      		</a>
										      		<a href="" class="delete_post d-none">
										      			<div class="modal-header">
										        			<p class="modal-title w-100 text-center">Delete post</p>
										      			</div>
										      		</a>
										      		<a href="" class="unfollow_user d-none">
										      			<div class="modal-header">
										        			<p class="modal-title w-100 text-center">Unfollow</p>
										      			</div>
										      		</a>
										      		<a href=""  data-dismiss="modal" aria-label="Close">
										      			<div class="modal-header">
										        			<p class="modal-title w-100 text-center">Cancel</p>
										      			</div>
										      		</a>
										    	</div>
										  	</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="post_loader"><div></div></div>
					
				</div><!--End Left Section-->



				<div class="col-md-3"><!--Start Right Section-->
					<div class="right_section">
						<div class="row user_profile_container d-flex align-items-center"> <!--Profile Conatiner-->
							<div class="profile_image_wrapper">
								<a href=""><img src="" alt=""></a>
							</div>
							<div class="user_info_container">
								<p class="user_username"><a href="">Username</a></p>
								<p class="user_full_name">Full Name</p>
							</div>
						</div> <!--End Profile Conatiner-->
						<hr>

						<div class="row stories_container"> <!--Stories Conatiner-->
							<div class="col-md-12">
								<div class="row stories_title_container">
									<p>Stories</p>
									<p class="ml-auto watch_all_stories"><a href="#">Watch All</a></p>
								</div>
								
								<div class="stories_content_container"><!--Start Stories-->

									<div class="row stories d-flex align-items-center"> <!--Start story-->
										<div class="profile_image_wrapper">
											<a href="#"><img src="image/amit.jpg" alt=""></a>
										</div>
										<div class="user_info_container">
											<p class="user_username"><a href="#">Username</a></p>
											<p class="user_story_time">10 HOURS AGO</p>
										</div>	
									</div><!--End story-->

									<div class="row stories d-flex align-items-center"> <!--Start story-->
										<div class="profile_image_wrapper">
											<a href="#"><img src="image/amit.jpg" alt=""></a>
										</div>
										<div class="user_info_container">
											<p class="user_username"><a href="#">Username</a></p>
											<p class="user_story_time">10 HOURS AGO</p>
										</div>	
									</div><!--End story-->

									<div class="row stories d-flex align-items-center"> <!--Start story-->
										<div class="profile_image_wrapper">
											<a href="#"><img src="image/amit.jpg" alt=""></a>
										</div>
										<div class="user_info_container">
											<p class="user_username"><a href="#">Username</a></p>
											<p class="user_story_time">10 HOURS AGO</p>
										</div>	
									</div><!--End story-->

									<div class="row stories d-flex align-items-center"> <!--Start story-->
										<div class="profile_image_wrapper">
											<a href="#"><img src="image/amit.jpg" alt=""></a>
										</div>
										<div class="user_info_container">
											<p class="user_username"><a href="#">Username</a></p>
											<p class="user_story_time">10 HOURS AGO</p>
										</div>	
									</div><!--End story-->

									<div class="row stories d-flex align-items-center"> <!--Start story-->
										<div class="profile_image_wrapper">
											<a href="#"><img src="image/amit.jpg" alt=""></a>
										</div>
										<div class="user_info_container">
											<p class="user_username"><a href="#">Username</a></p>
											<p class="user_story_time">10 HOURS AGO</p>
										</div>	
									</div><!--End story-->

								</div><!--End Stories-->

							</div>
						</div> <!--End Stories Conatiner-->

						<div class="row footer">
							<p class="d-block w-100 text-center"><span class="footer_links"><a href="#">About Us</a>.</span><span class="footer_links"><a href="#">About Developer</a>.</span><span class="footer_links"><a href="#">Support</a></span></p>
							<p class="d-block w-100 text-center"> &copy; 2018 <span class="footer_links"><a href="#">Babble</a></span></p>
						</div>
					</div>
				</div><!--End Right Section-->
			</div>
		</section>
	</div>

 	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/index.js"></script>
</body>
</html>