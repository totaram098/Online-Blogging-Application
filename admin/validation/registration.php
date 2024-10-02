<?php
	function validate_registration($validate_form=""){
		global $_POST,$_FILES,$_SESSION;
		extract($_POST);
		$is_valid = true;
		$password_matched = true;

		$name_pattern = "/^[A-Z]{1}[A-Za-z\s]{2,}/";
		$last_name_pattern = "/^[A-Z]{1}[A-Za-z\s]{2,}/";
		$email_pattern = "/^[a-z]{1,}[0-9]*@[a-z]{1,}[.][a-z]{1,}/";
		$password_alphabetical_pattern = "/[a-z]{1}/";
		$password_capital_pattern = "/[A-Z]{1}/";
		$password_numeric_pattern = "/[0-9]{1}/";

		$_SESSION['message'] = array();

		if ($first_name=="") {
			$is_valid = false;
			$_SESSION['message']["first_name_msg"] = "This Field is required";
		}
		else{
			if (!(preg_match($name_pattern, $first_name))) {
				$is_valid = false;
				$_SESSION['message']["first_name_msg"] = "First Character must be Capital and other small.";
			}
		}

		if ($last_name=="") {
			$is_valid = false;
			$_SESSION['message']["last_name_msg"] = "This Field is required";
		}
		else{
			if(!(preg_match($name_pattern, $last_name))) {
				$is_valid = false;
				$_SESSION['message']["last_name_msg"] = "First Character must be Capital and other small.";
			}
		}

		if ($email=="") {
			$is_valid = false;
			$_SESSION['message']["email_msg"] = "This Field is required";
		}
		else{
			if(!(preg_match($email_pattern, $email))) {
				$is_valid = false;
				$_SESSION['message']["email_msg"] = "Email must be like example123@gmail.com";
			}
		}

		if (!isset($gender)) {
			$is_valid = false;
			$_SESSION['message']["gender_msg"] = "This Field is required";
		}

		if (!$role_id) {
			$is_valid = false;
			$_SESSION['message']["role_msg"] = "This Field is required";
		}

		if (!$date_of_birth) {
			$is_valid = false;
			$_SESSION['message']["date_of_birth_msg"] = "This Field is required";
		}else{
			$birth_date = strtotime($date_of_birth);
			$current_time = time();

			$age = $current_time - $birth_date;
			$age = ($age/(3600*24*365));

			if ($age < 15) {
				$is_valid = false;
				$_SESSION['message']["date_of_birth_msg"] =  "Your Age Must Be greater Than 15 Years..!";
			}
		}

		if ($address=="" || $address==" ") {
			$is_valid = false;
			$_SESSION['message']["address_msg"] = "This Field is required";
		}

		if (!isset($_FILES['user_image']['name']) || empty($_FILES['user_image']['name'])) {
			if ($validate_form != "edituser") {
				$is_valid = false;
				$_SESSION['message']["user_image_msg"] = "This Field is required";
			}
		}else{
			$type = $_FILES['user_image']['name'];
			$size = ($_FILES['user_image']['size'])/1024;
			$type = explode(".", $type);
			$type = end($type);
			$type = strtolower($type);
			if (!($type == 'jpg' || $type == 'jpeg' || $type == 'png')) {
				$is_valid = false;
				$_SESSION['message']["user_image_msg"] = "Image Type Must be JPG,JPEG or PNG";
			}
			if ($size>=1024) {
				$is_valid = false;
				$_SESSION['message']["user_image_msg"] = "Image Size Must be Less Than 1MB.";
			}
		}

		if (!$password) {
			$is_valid = false;
			$password_matched = false;
			$_SESSION['message']["password_msg"] = "This Field is required";
		}
		else{
			$is_correct_password = true;
			if(!(strlen($password) > 7 )){
				$is_valid = false;
				$is_correct_password = false;
			}
			else if(!(preg_match($password_alphabetical_pattern,$password))){
				$is_valid = false;
				$is_correct_password = false;
			}
			else if(!(preg_match($password_numeric_pattern,$password))){
				$is_valid = false;
				$is_correct_password = false;
			}
			else if(!(preg_match($password_capital_pattern,$password))){
				$is_valid = false;
				$is_correct_password = false;
			}

			if(!$is_correct_password){
				$_SESSION['message']["password_msg"] = "Password Must Contain at Least 8 Characters, Capital, Small and Numeric Characters.";
			}
		}
		if ($validate_form != "edituser") {
			if (!$confirm_password) {
				$is_valid = false;
				$password_matched = false;
				$_SESSION['message']["confirm_password_msg"] =  "This Field is required";
			}
			if ($confirm_password != $password) {
				$is_valid = false;
				$_SESSION['message']["confirm_password_msg"] = "Doesn`t Match Password";
			}
		}


		return $is_valid;
		
	}
?>