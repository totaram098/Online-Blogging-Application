<?php
	function validate_post($validate_form=""){
		global $_POST,$_FILES,$_SESSION;
		extract($_POST);

		$is_valid = true;
		

		$_SESSION['message'] = array();

		foreach ($attachment_title as $key => $value) {
			if ($value =="" || $value =="") {
				$is_valid = false;
				$_SESSION['message']["title_msg"][] = "Title Is Required..!";
			}else{
				$_SESSION['message']["title_msg"][] = "";
			}
			
			if($validate_form != "editpost"){
				if (!$_FILES['attachment']['name'][$key]) {
					$is_valid = false;
					$_SESSION['message']["attachment_msg"][] = "Attachment Is Required..!";
				}else{
					$_SESSION['message']["attachment_msg"][] = "";
				}
			}
			else{
				if (!isset($post_attachments[$key])) {
					if (!$_FILES['attachment']['name'][$key]) {
						$is_valid = false;
						$_SESSION['message']["attachment_msg"][] = "Attachment Is Required..!";
					}else{
						$_SESSION['message']["attachment_msg"][] = "";
					}
				}else{
					$_SESSION['message']["attachment_msg"][] = "";
				}

			}
		}

		if ($post_title=="" || $post_title==" ") {
			$is_valid = false;
			$_SESSION['message']["post_title_msg"] = "This Field is required";
		}

		if ($post_description =="" || $post_description ==" " ) {
			$is_valid = false;
			$_SESSION['message']["post_description_msg"] = "This Field is required";
		}

		if ($post_summary =="" || $post_summary ==" " ) {
			$is_valid = false;
			$_SESSION['message']["post_summary_msg"] = "This Field is required";
		}


		if (!isset($post_status)) {
			$is_valid = false;
			$_SESSION['message']["post_status_msg"] = "This Field is required";
		}


		if (!($blog_id)) {
			$is_valid = false;
			$_SESSION['message']["blog_id_msg"] = "This Field is required";
		}

		if (!isset($categories)) {
			$is_valid = false;
			$_SESSION['message']["categories_msg"] = "This Field is required";
		}

		if (!$_FILES['featured_image']['name']) {
			if ($validate_form != "editpost") {
				$is_valid = false;
				$_SESSION['message']["featured_image_msg"] = "This Field is required";
			}
		}else{
			$type = $_FILES['featured_image']['name'];
			$size = ($_FILES['featured_image']['size'])/1024;
			$type = explode(".", $type);
			$type = end($type);
			$type = strtolower($type);
			if (!($type == 'jpg' || $type == 'jpeg' || $type == 'png')) {
				$is_valid = false;
				$_SESSION['message']["featured_image_msg"] = "Image Type Must be JPG,JPEG or PNG";
			}
			if ($size>=1024) {
				$is_valid = false;
				$_SESSION['message']["featured_image_msg"] = "Image Size Must be Less Than 1MB.";
			}
		}

		return $is_valid;
		
	}
?>