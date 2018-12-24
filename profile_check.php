<?php  

	session_start();

	if(isset($_GET['user_id'])){
		if($_GET['user_id'] == $_SESSION['user_id']){
			header('location:user_self_profile.php');
		} else {
			header('location:others_profile.php?user_id='.$_GET['user_id']);
		}
	} else {
		header('location:index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
		body{
			background-color: #efeded; 
		}

		.spinner:before{
			content:"";
			box-sizing: border-box;
			position: absolute;
			top:50%;
			left:50%;
			height: 40px;
			width: 40px;
			margin-top: -20px;
			margin-left: -20px;
			border-radius: 50%;
			border:4px solid lightgray;
			border-top:4px solid #ff27b7;
			animation: spin 0.7s linear infinite;
		}

		@keyframes spin{
			to{
				transform: rotate(360deg);
			}
		}
	</style>
</head>
<body>
	<div class="spinner"></div>
</body>
</html>