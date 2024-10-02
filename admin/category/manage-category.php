<?php
	class Manage_Category{
		function add_category_form(){
			return include 'add-category.php';
		}
		function get_categories($database){
			return include 'get-categories.php';
		}
		function edit_category($database){
			return include 'edit-category.php';
		}
	}
	$category = new Manage_Category();
?>