<?php
	function validate_blog($validate_form=""){
		global $_POST,$_FILES,$_SESSION;
		extract($_POST);

		$is_valid = true;
		

		$_SESSION['message'] = array();

		if ($blog_title=="") {
			$is_valid = false;
			$_SESSION['message']["blog_title_msg"] = "This Field is required";
		}

		if (empty($post_per_page)) {
			$is_valid = false;
			$_SESSION['message']["post_per_page_msg"] = "This Field is required";
		}else{
			if (!$post_per_page>0) {
				$_SESSION['message']["post_per_page_msg"] = "Must Be Numeric Value and Greater Than 1";
			}
		}

		if (!isset($blog_status)) {
			$is_valid = false;
			$_SESSION['message']["blog_status_msg"] = "This Field is required";
		}

		if (!$_FILES['blog_background_image']['name']) {
			if ($validate_form != "editblog") {
				$is_valid = false;
				$_SESSION['message']["blog_background_image_msg"] = "This Field is required";
			}
		}else{
			$type = $_FILES['blog_background_image']['name'];
			$size = ($_FILES['blog_background_image']['size'])/1024;
			$type = explode(".", $type);
			$type = end($type);
			$type = strtolower($type);
			if (!($type == 'jpg' || $type == 'jpeg' || $type == 'png')) {
				$_SESSION['message']["blog_background_image_msg"] = "Image Type Must be JPG,JPEG or PNG";
				$is_valid = false;
			}
			if ($size>=1024) {
				$_SESSION['message']["blog_background_image_msg"] = "Image Size Must be Less Than 1MB.";
				$is_valid = false;
			}
		}

		return $is_valid;
		
	}
?>