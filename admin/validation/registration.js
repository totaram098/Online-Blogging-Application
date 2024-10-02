	function validate_registration(validate_form){
		var is_valid = true;
		var $password_matched = true;

		var name_pattern = /^[A-Z]{1}[A-Za-z\s]{2,}/;
		var last_name_pattern = /^[A-Z]{1}[A-Za-z\s]{2,}/;
		var email_pattern = /^[a-z]{1,}[0-9]*@[a-z]{1,}[.][a-z]{1,}/;
		var password_alphabetical_pattern = /[a-z]{1}/;
		var password_capital_pattern = /[A-Z]{1}/;
		var password_numeric_pattern = /[0-9]{1}/;


		var first_name = document.querySelector("input[name=first_name]").value;
		var last_name = document.querySelector("input[name=last_name]").value;
		var email = document.querySelector("input[name=email]").value;
		var date_of_birth = document.querySelector("input[name=date_of_birth]").value;
		var user_image = document.querySelector("input[name=user_image]").value;
		var password = document.querySelector("input[name=password]").value;
		var gender = document.querySelector("input[type=radio]:checked");
		var role = document.querySelector("select[name=role_id]").value;
		var address = document.querySelector("textarea[name=address]").value;
		var first_name_msg = document.querySelector("#first_name_msg");
		var last_name_msg = document.querySelector("#last_name_msg");
		var email_msg = document.querySelector("#email_msg");
		var user_image_msg = document.querySelector("#user_image_msg");
		var date_of_birth_msg = document.querySelector("#date_of_birth_msg");
		var password_msg = document.querySelector("#password_msg");
		var gender_msg = document.querySelector("#gender_msg");
		var role_msg = document.querySelector("#role_msg");
		var address_msg = document.querySelector("#address_msg");



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
			var birth_date = new Date(date_of_birth);
			var current_time = new Date();
			var age = current_time.getTime() - birth_date.getTime();
			age = (age/(1000*3600*24*365));

			if (age < 15) {
				is_valid = false;
				date_of_birth_msg.innerHTML = "Your Age Must Be greater Than 15 Years..!";
			}
		}
		if (address=="" || address==" ") {
			is_valid = false;
			address_msg.innerHTML = "This Field is required";
		}
		else{
			address_msg.innerHTML = "";
		}


		if (password=="" || password==" ") {
			is_valid = false;
			$password_matched = false;
			password_msg.innerHTML = "This Field is required";
		}
		else{
			password_msg.innerHTML = "";
			is_correct_password = true;
			if((password.length < 8 )){
				is_correct_password = false;
				is_valid = false;
			}
			else if(!(password_alphabetical_pattern.test(password))){
				is_valid = false;
				is_correct_password = false;
			}
			else if(!(password_numeric_pattern.test(password))){
				is_valid = false;
				is_correct_password = false;
			}
			else if(!(password_capital_pattern.test(password))){
				is_valid = false;
				is_correct_password = false;
			}

			if(!is_correct_password){
				password_msg.innerHTML = "Password Must Contain at Least 8 Characters, Capital, Small and Numeric Characters.";
			}
		}


		if (validate_form != "edit_user") {

			if (user_image=="" || user_image==" ") {
				is_valid = false;
				user_image_msg.innerHTML = "This Field is required";
			}
			else{
				user_image_msg.innerHTML = "";
			}
			
			var confirm_password = document.querySelector("input[name=confirm_password]").value;
			var confirm_password_msg = document.querySelector("#confirm_password_msg");
			if (confirm_password =="" || confirm_password==" ") {
				is_valid = false;
				$password_matched = false;
				confirm_password_msg.innerHTML = "This Field is required";
			}
			else{
				confirm_password_msg.innerHTML = "";
			}

			if (confirm_password != password) {
				is_valid = false;
				confirm_password_msg.innerHTML = "Doesn`t Match Password";
			}
		}

		return is_valid;
	}
