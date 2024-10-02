<?php
	function validate_category($validate_form=""){
		global $_POST,$_SESSION;
		extract($_POST);

		$is_valid = true;
		

		$_SESSION['message'] = array();

		if ($category_title=="" || $category_title==" ") {
			$is_valid = false;
			$_SESSION['message']["category_title_msg"] = "This Field is required";
		}

		if ($category_description=="" || $category_description==" ") {
			$is_valid = false;
			$_SESSION['message']["category_description_msg"] = "This Field is required";
		}
		if (!isset($category_status)) {
			$is_valid = false;
			$_SESSION['message']["category_status_msg"] = "This Field is required";
		}

		return $is_valid;
		
	}
?>