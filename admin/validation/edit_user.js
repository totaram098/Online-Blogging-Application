	function validate_edit_user(){
		var is_valid = true;
		var $password_matched = true;

		var name_pattern = /^[A-Z]{1}[a-z]{2,}/;
		var last_name_pattern = /^[A-Z]{1}[a-z]{2,}/;
		var hometown_pattern = /[A-Za-z]{3,}/;


		var first_name = document.querySelector("input[name=first_name]").value;
		var last_name = document.querySelector("input[name=last_name]").value;
		var date_of_birth = document.querySelector("input[name=date_of_birth]").value;
		var profile_image = document.querySelector("input[name=profile_image]").value;
		var hometown = document.querySelector("input[name=hometown]").value;
		var gender = document.querySelector("input[type=radio]:checked");
		var role = document.querySelector("select[name=role]").value;

		var first_name_msg = document.querySelector("#first_name_msg");
		var last_name_msg = document.querySelector("#last_name_msg");
		var profile_image_msg = document.querySelector("#profile_image_msg");
		var date_of_birth_msg = document.querySelector("#date_of_birth_msg");
		var gender_msg = document.querySelector("#gender_msg");
		var hometown_msg = document.querySelector("#hometown_msg");
		var role_msg = document.querySelector("#role_msg");



		if (first_name=="") {
			is_valid = false;
			first_name_msg.innerHTML = "This Field is required";
		}
		else{
			first_name_msg.innerHTML = "";
			if (!(name_pattern.test(first_name))) {
				is_valid = false;
				first_name_msg.innerHTML = "First Character must be Capital and other small.";
			}
		}

		if (last_name=="") {
			is_valid = false;
			last_name_msg.innerHTML = "This Field is required";
		}
		else{
			last_name_msg.innerHTML = "";
			if (!(last_name_pattern.test(last_name))) {
				is_valid = false;
				last_name_msg.innerHTML = "First Character must be Capital and other small.";
			}
		}

		if (email=="") {
			is_valid = false;
			email_msg.innerHTML = "This Field is required";
		}
		else{
			email_msg.innerHTML = "";
			if (!(email_pattern.test(email))) {
				is_valid = false;
				email_msg.innerHTML = "Email must be like example123@gmail.com";
			}
		}

		if (!gender) {
			is_valid = false;
			gender_msg.innerHTML = "This Field is required";
		}
		else{
			gender_msg.innerHTML = "";
		}

		if (!role) {
			is_valid = false;
			role_msg.innerHTML = "This Field is required";
		}
		else{
			role_msg.innerHTML = "";
		}

		if (date_of_birth=="" || date_of_birth==" ") {
			is_valid = false;
			date_of_birth_msg.innerHTML = "This Field is required";
		}
		else{
			date_of_birth_msg.innerHTML = "";
		}

		if (profile_image=="" || profile_image==" ") {
			is_valid = false;
			profile_image_msg.innerHTML = "This Field is required";
		}
		else{
			profile_image_msg.innerHTML = "";
		}

		if (hometown=="" || hometown==" ") {
			is_valid = false;
			hometown_msg.innerHTML = "This Field is required";
		}
		else{
			hometown_msg.innerHTML = "";
			if (!(hometown_pattern.test(hometown))) {
				is_valid = false;
				hometown_msg.innerHTML = "Home Town Must Contain Atleast 3 Alphabetical Characters";
			}
		}

		if (password=="" || password==" ") {
			is_valid = false;
			$password_matched = false;
			password_msg.innerHTML = "This Field is required";
		}
		else{
			password_msg.innerHTML = "";
			is_correct_password = true;
			if(!(password.length > 7 )){
				is_correct_password = false;
			}
			else if(!(password_alphabetical_pattern.test(password))){
				is_correct_password = false;
			}
			else if(!(password_numeric_pattern.test(password))){
				is_correct_password = false;
			}
			else if(!(password_capital_pattern.test(password))){
				is_correct_password = false;
			}

			if(!is_correct_password){
				password_msg.innerHTML = "Password Must Contain at Least 8 Characters, Capital, Small and Numeric Characters.";
			}
		}

		if (confirm_password =="" || confirm_password==" ") {
			is_valid = false;
			$password_matched = false;
			confirm_password_msg.innerHTML = "This Field is required";
		}
		else{
			confirm_password_msg.innerHTML = "";
		}

		if (confirm_password != password && $password_matched) {
			is_valid = false;
			confirm_password_msg.innerHTML = "Doesn`t Match Password";
		}


		return is_valid;
	}
