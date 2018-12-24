<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Babble</title>
    <link rel="icon" type="image/jpg" href="../image/logo.jfif">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome-all.css">
    <link rel="stylesheet" href="../css/login_signup.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Dancing+Script|Lobster|Pacifico|Philosopher" rel="stylesheet"> 

</head>
<body class="main">

    <div class="preloader spinner-1"></div>

    <div class="login_signup_page">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand title" href="#">Babble</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>

        <section>
            <div class="row">
                <div class="col-lg-8"> <!--Start Left Section-->
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block custom_height" src="../image/image1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block custom_height" src="../image/image2.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block custom_height" src="../image/image3.jpg" alt="Third slide">
                            </div>
                        </div>
                    </div>
                </div> <!--End Slider Section-->

                <div class="col-lg-4 custom_right_section"> <!--Start Right Section-->
                    <div class="row form_header">  <!--Start Form head heading -->
                        <div class="col-md-12">
                            <h1>Babble</h1>
                            <p>Sign up to see photos and videos from your friends.</p>
                        </div>
                    </div> <!--End Form head heading -->
                    <div class="row"> <!--Start Signin using social media-->
                        <div class="col-md-12">
                            
                        </div>
                    </div> <!--End Signin using social media-->
                    <hr>
                    <div class="row custom_form_container"> <!--Start Login Signup-->
                        <div class="col-md-12"> 
                            <div class="row custom_signup_container"> <!--Start Signup Part-->
                                <div class="col-md-12">
                                    <form action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_input" required>
                                            <span class="floating_label">Mobile number or Email</span>
                                            <span class="wrong_input"><i class="far fa-times-circle"></i></span>
                                            <span class="right_input"><i class="far fa-check-circle"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_input" required>
                                            <span class="floating_label">Full Name</span>
                                            <span class="wrong_input"><i class="far fa-times-circle"></i></span>
                                            <span class="right_input"><i class="far fa-check-circle"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_input" required>
                                            <span class="floating_label">Username</span>
                                            <span class="wrong_input"><i class="far fa-times-circle"></i></span>
                                            <span class="right_input"><i class="far fa-check-circle"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control custom_input"  title="Password length must atlest 8 and should contain one small ,one capital, one special character and one digit"required>
                                            <span class="floating_label">Password</span>
                                            <span class="wrong_input"><i class="far fa-times-circle"></i></span>
                                            <span class="right_input"><i class="far fa-check-circle"></i></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary form-control signup_btn" value="Sign Up">
                                        </div>
                                        <div class="form-group">
                                            <button class="form-control btn btn-danger change_to_login">Existing User Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div> <!--End Signup Part-->

                            <div class="row custom_login_container" tabindex="-1"> <!--Start Login Part-->
                                <div class="col-md-12">
                                    <form action="">
                                        <div class="form-group">
                                            <button class="form-control btn btn-danger change_to_signup">New User Sign Up</button>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control custom_input" required>
                                            <span class="floating_label">Mobile number or Email or Username</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control custom_input" required>
                                            <span class="floating_label">Password</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary form-control login_btn" value="Log In">
                                        </div>
                                    </form>
                                </div> <!-- End Login Part-->
                            </div>
                        </div>
                    </div>  <!--End Login Signup-->

                    <div class="row terms_policy">
                        <div class="col-sm-12">
                            <p class="signup_errors"></p>
                            <p class="signup_terms">By signing up, you agree to our <a href="#"><strong>Terms</strong></a>, <a href="#"><strong>Data Policy</strong></a> and <a href="#"><strong>Cookies Policy</strong></a>.</p>
                            <p class="login_errors"></p>
                            <p class="forgot_password"><a href="#">Forgot Password?</a></p>
                        </div>
                    </div>
                </div> <!--End Right Section-->
            </div>

            <div class="row get_app">
                <div class="col-ld-12 col-sm-12">
                    <p>Get the app.</p>
                    <a href="#"><img class="btn_image" src="../image/googleplay_get_it.png"></a>
                    <a href="#"><img class="btn_image" src="../image/apple_get_it.png"></a>
                </div>
            </div>
        </section>

        <footer>
            <p><a href="#"><strong>About Devloper </strong></a><span>&copy; 2018</span> <a href="#"><strong> Babble</strong></a><span>.</span></p>
        </footer>

    </div>

    

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/login_signup.js"></script>
</body>
</html>