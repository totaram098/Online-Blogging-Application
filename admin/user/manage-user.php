<?php
	class Manage_User{
		function add_user_form($database){
			return include 'add-user.php';
		}
		function get_users($database){
			return include 'get-users.php';
		}
		function edit_user($database){
			return include 'edit-user.php';
		}
		function pending_users($database){
			return include 'pending-users.php';
		}
		function rejected_users($database){
			return include 'rejected-users.php';
		}
	}
	$user = new Manage_User();
?>