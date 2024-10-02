<?php
	class Manage_Blog{
		function add_blog_form(){
			return include 'add-blog.php';
		}
		function get_blogs($database){
			return include 'get-blogs.php';
		}
		function edit_blog($database){
			return include 'edit-blog.php';
		}
		function get_blog_followers($database){
			return include 'get-blog-followers.php';
		}
	}
	$blog = new Manage_Blog();
?>