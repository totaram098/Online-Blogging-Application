<?php 
	class Manage_Comment_Feedback{
		function get_comments($database){
			require 'get_comments.php';
		}
		function get_feedback($database){
			require 'get_feedback.php';
		}
	}
	$comment_feedback = new Manage_Comment_Feedback();
?>