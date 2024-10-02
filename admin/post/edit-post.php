<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	if (isset($_SESSION['message'])) {
		// $message = unserialize($_REQUEST['message']);
		extract($_SESSION['message']);
		if (isset($data)) {
			extract($data);
		}
	}
	$id = $_REQUEST['id']??0;
	$post_query = "SELECT * FROM post  WHERE post_id = '{$id}'";
	$query_category = "SELECT * FROM category c JOIN post_category pc USING(category_id) WHERE pc.post_id = '{$id}'";
	$query_category_all = "SELECT * FROM category";
	$query_attachment = "SELECT * FROM post_atachment WHERE post_id = '{$id}'";
	$blog_query = "SELECT * FROM blog WHERE user_id = {$user_id}";

	$result_post = $database->execute_query($post_query);
	$result_category = $database->execute_query($query_category);
	$result_attachment = $database->execute_query($query_attachment);
	$result = $database->execute_query($query_category_all);
	$blog_result = $database->execute_query($blog_query);

	// selected categories
	$category_ids = isset($categories)?$categories : array();
	if ($result_category->num_rows>0) {
		while ($post_category = mysqli_fetch_assoc($result_category)) {
			$category_ids[] = $post_category['category_id'];  
		}
	}
?>
	<!-- add Post -->
	<div>
		<h1 class="bg-secodary shadow px-5 py-3 rounded">EDIT POST</h1>
		<?= $_SESSION['msg']?? "" ?>
		<?php if ($result_post->num_rows > 0 || isset($_SESSION['message'])): ?>
			<?php 
				if ($result_post->num_rows > 0) {
					$post_data = mysqli_fetch_assoc($result_post);
					extract($post_data);
				}
			?>
			<form action="../database/admin/admin-process.php" onsubmit="return validate_post('editpost');" enctype="multipart/form-data" method="POST" class="shadow p-sm-3 p-2 rounded">
				<input type="hidden" name="post_id" value="<?= isset($_SESSION['message']['data']['post_id'])?$_SESSION['message']['data']['post_id'] : $id; ?>">
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
						<img src="<?= (isset($featured_image))?('../uploads/post-images/'.$featured_image):''; ?><?= (isset($post_image))?('../uploads/post-images/'.$post_image):''; ?>" style="width: 60px;height: 60px;" class="mb-2">
						<div class="form-floating mb-3">
							<input type="hidden" name="post_image" value="<?= isset($featured_image)?$featured_image : $post_image; ?>">
						  <input type="file"  name="featured_image"  class="form-control" id="floatingInput" placeholder="Post Image" >
						  <label for="floatingInput">Post Image</label>
					</div>
					<p class="px-1 text-danger mb-3" style="font-size:12px" id="featured_image_msg">
						<?= $featured_image_msg ?? "";?>
					</p>
					</div>
				</div>
				<div id="attachment_box">
					<?php if ($result_attachment->num_rows>0 || isset($post_attachments)): ?>
						<?php $i = 1; ?>
						<?php while (isset($post_attachments[$i-1]) || ($attachments = mysqli_fetch_assoc($result_attachment))): ?>
							<?php 
								if ($result_attachment->num_rows>0) {
									extract($attachments);
								}
								$attachment_name = "attachment_name_".$i;
								
							 ?>
							<div class="row justify-content-center <?= $attachment_name ?>">	
				  				<div class="mb-3 col-md-6" style="">
					  				<div class="row justify-content-center">
					  					<div class="col-12 text-end mt-2">
					  						<button type="button" class="btn btn-primary"onclick="remove_attachment('<?= $attachment_name ?>')">Remove <i class="fa-solid fa-x"></i></button>
					  					</div>
					  				</div>
					  				<div class="row justify-content-center">
					  					<div class="col-12">
					  						<a href="../uploads/attachments/<?= isset($post_attachment_path)?$post_attachment_path: $post_attachments[$i-1];?>" download>
					  								<?= isset($post_attachment_title)?$post_attachment_title: $attachment_title[$i-1];?>
					  							</a>
					  						<div class="form-floating mt-3">
					  							<input type="hidden" name="post_attachments[]" value="<?= isset($post_attachment_path)?$post_attachment_path: $post_attachments[$i-1];?>">
											  <input type="text" name="attachment_title[]" class="form-control" id="floatingInput" placeholder="Post Title" value="<?= isset($post_attachment_title)?$post_attachment_title: $attachment_title[$i-1];?>">
											  <label for="floatingInput">Attachment Title</label>
											</div>
											<p class="px-1 text-danger mb-3" style="font-size:12px" id="featured_image_msg">
												<?= $title_msg[$i-1] ?? "";?>
											</p>
					  					</div>
					  				</div>
					  				<div class="row justify-content-center">
					  					<div class="col-12">
					  						<div class="form-floating mb-3">
											  <input type="file" name="attachment[]" class="form-control" id="floatingInput" placeholder="Attachments" accept="multiple">
											  <label for="floatingInput">Attachment</label>
											</div>
					  					</div>
					  				</div>
				  				</div>
							</div>
							<?php $i++; ?>
						<?php endwhile ?>
					<?php endif ?>

					<!-- extra attachments -->
					<?php 
						if (isset($attachment_title)) {
							for ($k=($i-1); isset($attachment_title[$k]) ; $k++) { 
							
					?>
					<div class="row justify-content-center attachment_inner_box_<?= ($k+1) ?>">	
		  				<div class="mb-3 col-md-6" style="">
			  				<div class="row justify-content-center">
			  					<div class="col-12 text-end mt-2">
			  						<button type="button" class="btn btn-primary"onclick="remove_attachment('attachment_inner_box_<?= ($k+1) ?>')">Remove <i class="fa-solid fa-x"></i></button>
			  					</div>
			  				</div>
			  				<div class="row justify-content-center">
			  					<div class="col-12">
			  						<div class="form-floating mt-3">
									  <input type="text" name="attachment_title[]" class="form-control" id="floatingInput" placeholder="Post Title" value="<?= $attachment_title[$k] ?? '';?>">
									  <label for="floatingInput">Attachment Title</label>
									</div>
									<p class="px-1 text-danger mb-3" style="font-size:12px" id="featured_image_msg">
										<?= $title_msg[$k] ?? "";?>
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
										<?= $attachment_msg[$k] ?? "";?>
									</p>
			  					</div>
			  				</div>
		  				</div>
					</div>
					<?php			
							}
						}
					?>
					<!-- /extra attachments -->

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
							  <option value="<?= $blog['blog_id'] ?>" <?= ($blog['blog_id']==$blog_id)?'selected':'' ?> > <?= $blog['blog_title']; ?></option>
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
							  		$selected_category = false;
							  		foreach ($category_ids as $ids) {
							  			if ($row['category_id'] == $ids) {
							  				$selected_category = true;
							  			}
							  		}
							  	?>
							    <option value="<?= $row['category_id'] ?>" <?= ($selected_category)?'selected':'' ?> > <?= $row['category_title']; ?></option>
						  	
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
						<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"   <?= (isset($is_comment_allowed) &&  $is_comment_allowed== 1)?"checked": "";?> name="is_comment_allowed" value="1">
						<label class="form-check-label" for="flexSwitchCheckChecked">Allow Comments</label>
					</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm-6 row justify-content-end">
						<div class="col-sm-6">
							<input type="Submit" name="editpost" value="Edit Post" class="form-control btn btn-primary">
						</div>
					</div>	
				</div>
			</form>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				Bad Request...! No Post Found
			</div>
		<?php endif ?>
	</div>
	<!-- /add Post -->

	<?php 
	if (isset($_SESSION['message'])) {
		session_destroy();
	}
?>