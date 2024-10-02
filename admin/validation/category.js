	function validate_category(validate_form){
		var is_valid = true;

		var category_title = document.querySelector("input[name=category_title]").value;
		var category_description = document.querySelector("input[name=category_description]").value;
		var category_status = document.querySelector("input[type=radio]:checked");

		var category_title_msg = document.querySelector("#category_title_msg");
		var category_description_msg = document.querySelector("#category_description_msg");
		var category_status_msg = document.querySelector("#category_status_msg");



		if (!category_status) {
			is_valid = false;
			category_status_msg.innerHTML = "This Field is required";
		}
		else{
			category_status_msg.innerHTML = "";
		}


		if (category_title=="" || category_title==" ") {
			is_valid = false;
			category_title_msg.innerHTML = "This Field is required";
		}
		else{
			category_title_msg.innerHTML = "";
		}


		if (category_description=="" || category_description==" ") {
			is_valid = false;
			category_description_msg.innerHTML = "This Field is required";
		}
		else{
			category_description_msg.innerHTML = "";
		}

		return is_valid;
	}
