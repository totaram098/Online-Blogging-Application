	function validate_post(validate_form){
		var is_valid = true;

		var post_title = document.querySelector("input[name=post_title]").value;
		var post_description = document.querySelector("textarea[name=post_description]").value;
		var post_summary = document.querySelector("textarea[name=post_summary]").value;
		var featured_image = document.querySelector("input[name=featured_image]").value;
		var post_status = document.querySelector("input[type=radio]:checked");
		var blog_id = document.querySelector("select[name=blog_id]").value;


		var categories = document.querySelector("#fruits");
		var post_title_msg = document.querySelector("#post_title_msg");
		var post_description_msg = document.querySelector("#post_description_msg");
		var post_summary_msg = document.querySelector("#post_summary_msg");
		var featured_image_msg = document.querySelector("#featured_image_msg");
		var post_status_msg = document.querySelector("#post_status_msg");
		var blog_id_msg = document.querySelector("#blog_id_msg");
		var categories_msg = document.querySelector("#categories_msg");

		if (!post_status) {
			is_valid = false;
			post_status_msg.innerHTML = "This Field is required";
		}
		else{
			post_status_msg.innerHTML = "";
		}


		if (post_title=="" || post_title==" ") {
			is_valid = false;
			post_title_msg.innerHTML = "This Field is required";
		}
		else{
			post_title_msg.innerHTML = "";
		}

		if (post_description=="" || post_description==" ") {
			is_valid = false;
			post_description_msg.innerHTML = "This Field is required";
		}
		else{
			post_description_msg.innerHTML = "";
		}
		
		if (post_summary=="" || post_summary==" ") {
			is_valid = false;
			post_summary_msg.innerHTML = "This Field is required";
		}
		else{
			post_summary_msg.innerHTML = "";
		}

		if (validate_form != "editpost") {
			if (featured_image=="" || featured_image==" ") {
				is_valid = false;
				featured_image_msg.innerHTML = "This Field is required";
			}
			else{
				featured_image_msg.innerHTML = "";
			}
		}

		if (blog_id=="" || blog_id==" ") {
			is_valid = false;
			blog_id_msg.innerHTML = "This Field is required";
		}
		else{
			blog_id_msg.innerHTML = "";
		}

		if (categories.innerText == "Select Categories") {
			is_valid = false;
			categories_msg.innerHTML = "This Field is required";
		}
		else{
			categories_msg.innerHTML = "";
		}

		return is_valid;
	}
