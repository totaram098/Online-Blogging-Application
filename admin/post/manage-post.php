<?php
	require("../config/database.php");
	class Manage_Post{
		function add_post_form($database){
			return include 'add-post.php';
		}
		function get_posts($database){
			return include 'get-posts.php';
		}
		function edit_post($database){
			return include 'edit-post.php';
		}
	}
	$post = new Manage_Post();
?>