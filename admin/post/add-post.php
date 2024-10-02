<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	if (isset($_SESSION['message'])) {
		extract($_SESSION['message']);
		if (isset($data)) {
			extract($data);
		}
	}

	$query = "SELECT * FROM category WHERE category_status = 'Active'";
	$blog_query = "SELECT * FROM blog WHERE blog_status = 'Active' AND user_id = {$user_id}";
	$result = $database->execute_query($query);
	$blog_result = $database->execute_query($blog_query);
?>
	<!-- add Post -->
	<div>
		<h1 class="bg-secodary shadow px-5 py-3 rounded">ADD POST</h1>
		<?= $_SESSION['msg']?? "" ?>
		<form action="../database/admin/admin-process.php" onsubmit="return  validate_post();" enctype="multipart/form-data" method="POST" class="shadow p-sm-3 p-2 rounded">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="form-floating mb-3">
				  <input type="text" class="form-control" id="floatingInput" name="post_title" placeholder="Post Title" value="<?= $post_title??''; ?>">
				  <label for="floatingInput">Post Title</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="post_title_msg">
					<?= $post_title_msg ?? "";?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="form-floating mb-3">
				  <textarea  name="post_description"  rows="5" class="form-control" placeholder="Post Description" style="height: 150px" id="floatingTextarea" ><?= $post_description??''; ?></textarea>
				  <label for="floatingTextarea">Post Description</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="post_description_msg">
					<?= $post_description_msg ?? "";?>
				</p>
				</div>
			</div>	

			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="form-floating mb-3">
				  <textarea  name="post_summary"  rows="5" class="form-control" placeholder="Post Summary" style="height: 150px" id="floatingTextarea" ><?= $post_summary??''; ?></textarea>
				  <label for="floatingTextarea">Post Summary</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="post_summary_msg">
					<?= $post_summary_msg ?? "";?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="form-floating mb-3">
				  <input type="file"  name="featured_image"  class="form-control" id="floatingInput" placeholder="Post Image">
				  <label for="floatingInput">Post Image</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="featured_image_msg">
					<?= $featured_image_msg ?? "";?>
				</p>
				</div>
			</div>
			<div id="attachment_box">
				<?php 
					if (isset($attachment_title)) {
						foreach ($attachment_title as $key => $value) {
				?>
				<div class="row justify-content-center attachment_inner_box_<?= ($key+1) ?>">	
	  				<div class="mb-3 col-md-6" style="">
		  				<div class="row justify-content-center">
		  					<div class="col-12 text-end mt-2">
		  						<button type="button" class="btn btn-primary"onclick="remove_attachment('attachment_inner_box_<?= ($key+1) ?>')">Remove <i class="fa-solid fa-x"></i></button>
		  					</div>
		  				</div>
		  				<div class="row justify-content-center">
		  					<div class="col-12">
		  						<div class="form-floating mt-3">
								  <input type="text" name="attachment_title[]" class="form-control" id="floatingInput" placeholder="Post Title" value="<?= $attachment_title[$key] ?? '';?>">
								  <label for="floatingInput">Attachment Title</label>
								</div>
								<p class="px-1 text-danger mb-3" style="font-size:12px" id="featured_image_msg">
									<?= $title_msg[$key] ?? "";?>
								</p>
		  					</div>
		  				</div>
		  				<div class="row justify-content-center">
		  					<div class="col-12">
		  						<div class="form-floating">
								  <input type="file" name="attachment[]" class="form-control" id="floatingInput" placeholder="Attachments" accept="multiple">
								  <label for="floatingInput">Attachment</label>
								</div>

								<p class="px-1 text-danger" style="font-size:12px" id="featured_image_msg">
									<?= $attachment_msg[$key] ?? "";?>
								</p>
		  					</div>
		  				</div>
	  				</div>
				</div>
				<?php			
						}
					}
				?>
			</div>

			<div class="row justify-content-center" id="add_attachment_btn">
				<div class="col-md-6">
				<div class="form-floating mb-3 text-end">
					<button type="button" class="btn btn-primary" onclick="add_attachment()">Add Attachment <i class="fa-solid fa-plus"></i></button>
				</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6">
				<div class="form-floating mb-3">
					<select  name="blog_id"  class="form-select" aria-label="Default select example">
					  <option value="" >Select Blog</option>
					  <?php if ($blog_result->num_rows>0): ?>
						  <?php while($blog = mysqli_fetch_assoc($blog_result)): ?>
						  <option value="<?= $blog['blog_id'] ?>" <?= (isset($blog_id) && $blog_id == $blog['blog_id'])? "selected":"" ?> > 
						  	<?= $blog['blog_title']; ?>
						  </option>
						  <?php endwhile ?>
					  <?php endif ?>
					</select>
				  <label for="floatingInput">Blogs</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="blog_id_msg">
					<?= $blog_id_msg ?? "";?>
				</p>
					
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 mb-3">
					<div class="form-floating mb-3">
					<select  name="categories"  class="-select" aria-label="Default select example" id="fruits"  data-placeholder="Select Categories" multiple data-multi-select>
					  <?php if ($result->num_rows>0): ?>
						  <?php while($row = mysqli_fetch_assoc($result)): ?>
						  	<?php 
						  		$selected = "";
						  		foreach ($categories as $key => $value) {
						  			if ($value == $row['category_id']) {
						  				$selected = "selected";
						  			}
						  		}
						  	?>
						  <option value="<?= $row['category_id'] ?>" <?= $selected; ?>> 
						  	<?= $row['category_title']; ?>
						  </option>
					  	
						  <?php endwhile ?>
					  <?php endif ?>
					</select>
				  <!-- <label for="floatingInput">Blogs</label> -->
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="categories_msg">
					<?= $categories_msg ?? "";?>
				</p>

				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 mb-3">
					<span class="mx-2">
						<b>Post Status </b>
					</span>
					<br>
					<div class="mx-2 form-check form-check-inline">
				  <input  class="form-check-input" type="radio" id="inlineCheckbox1" value="Active" name="post_status"  <?= (isset($post_status) && $post_status=='Active')?"checked": "";?> checked>
				  <label class="form-check-label" for="inlineCheckbox1" >Active</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="inlineCheckbox2" value="InActive" name="post_status"  <?= (isset($post_status) && $post_status=='InActive')?"checked": "";?>>
				  <label class="form-check-label" for="inlineCheckbox2">InActive</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="post_status_msg">
					<?= $post_status_msg ?? "";?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 mb-3">
				<div class="mx-2 form-check form-switch">
					<?php 
						$is_checked = "checked";
						if (isset($data)) {
							if (isset($is_comment_allowed)) {
								$is_checked = "checked";
							}else{
								$is_checked = "";
							}
						}
					?>
					<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"   <?= $is_checked ?> name="is_comment_allowed"  value="1">
					<label class="form-check-label" for="flexSwitchCheckChecked">Allow Comments</label>
				</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 row justify-content-end">
					<div class="col-sm-6">
						<input type="Submit" name="addpost" value="Add Post" class="form-control btn btn-primary">
					</div>
				</div>	
			</div>
		</form>
	</div>
	<!-- /add Post -->

	<?php 
	if (isset($_SESSION['message'])) {
		session_destroy();
	}
?>