<?php 

	require_once('nav_db_utilities.php');

	$nav_db = new nav_db_utilities; 	

	if(isset($_POST['searhing'])){
		echo $nav_db->search_user($_POST['search_user_name']);
	}

	if(isset($_POST['get_user_self_id'])){
		echo $nav_db->get_user_self_id();
	}
?>