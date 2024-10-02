<?php 
	include('user/manage-user.php');
	include('blog/manage-blog.php');
	include('post/manage-post.php');
	include('comment-and-feedback/comment-and-feedback-manage.php');
	include('category/manage-category.php');
	if (isset($_REQUEST['dashboard'])) {

	}elseif (isset($_REQUEST['get_users'])) {
		$user->get_users($database);
		
	}elseif (isset($_REQUEST['add_user'])) {
		$user->add_user_form($database);

	}elseif (isset($_REQUEST['edit_user'])) {
		$user->edit_user($database);
		
	}elseif (isset($_REQUEST['pending_users'])) {
		$user->pending_users($database);
		
	}elseif (isset($_REQUEST['rejected_users'])) {
		$user->rejected_users($database);
		
	}elseif (isset($_REQUEST['get_blogs'])) {
		$blog->get_blogs($database);
		
	}elseif (isset($_REQUEST['get_blog_followers'])) {
		$blog->get_blog_followers($database);
		
	}elseif (isset($_REQUEST['add_blog'])) {
		$blog->add_blog_form();
		
	}elseif (isset($_REQUEST['edit_blog'])) {
		$blog->edit_blog($database);
		
	}elseif (isset($_REQUEST['get_posts'])) {
		$post->get_posts($database);
		
	}elseif (isset($_REQUEST['add_post'])) {
		$post->add_post_form($database);
		
	}elseif (isset($_REQUEST['edit_post'])) {
		$post->edit_post($database);
		
	}elseif (isset($_REQUEST['get_categories'])) {
		$category->get_categories($database);
		
	}elseif (isset($_REQUEST['add_category'])) {
		$category->add_category_form();
		
	}elseif (isset($_REQUEST['edit_category'])) {
		$category->edit_category($database);
		
	}elseif (isset($_REQUEST['get_comments'])) {
		$comment_feedback->get_comments($database);
		
	}elseif (isset($_REQUEST['get_feedback'])) {
		$comment_feedback->get_feedback($database);
		
	}
?>