	function validate_blog(validate_form){
		var is_valid = true;

		var blog_title = document.querySelector("input[name=blog_title]").value;
		var post_per_page = document.querySelector("input[name=post_per_page]").value;
		var blog_background_image = document.querySelector("input[name=blog_background_image]").value;
		var blog_status = document.querySelector("input[type=radio]:checked");

		var blog_title_msg = document.querySelector("#blog_title_msg");
		var post_per_page_msg = document.querySelector("#post_per_page_msg");
		var blog_background_image_msg = document.querySelector("#blog_background_image_msg");
		var blog_status_msg = document.querySelector("#blog_status_msg");



		if (!blog_status) {
			is_valid = false;
			blog_status_msg.innerHTML = "This Field is required";
		}
		else{
			blog_status_msg.innerHTML = "";
		}


		if (blog_title=="" || blog_title==" ") {
			is_valid = false;
			blog_title_msg.innerHTML = "This Field is required";
		}
		else{
			blog_title_msg.innerHTML = "";
		}

		if (blog_background_image=="" || blog_background_image==" ") {
			if ($validate_form != "editblog") {
				is_valid = false;
				blog_background_image_msg.innerHTML = "This Field is required";
			}
		}
		else{
			blog_background_image_msg.innerHTML = "";
		}

		if (post_per_page=="" || post_per_page==" ") {
			is_valid = false;
			post_per_page_msg.innerHTML = "This Field is required";
		}
		else{
			post_per_page_msg.innerHTML = "";
			if (!(post_per_page > 0 )) {
				post_per_page_msg.innerHTML = "Must Be Numeric Value and Greater Than 1";
			}
		}



		return is_valid;
	}
