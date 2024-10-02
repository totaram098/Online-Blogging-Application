<?php 
	session_start();
	if (isset($_SESSION['message'])) {
		extract($_SESSION['message']);
		extract($data);
	}
	$id = $_REQUEST['id']??0;
	$query = "SELECT * FROM blog WHERE blog_id = '{$id}'";
	$result = $database->execute_query($query);
?>
	<!-- Edit blog -->
	<div>
		<h1 class="bg-secodary text- shadow px-5 py-3 rounded">EDIT BLOG</h1>
		<?php if ($result->num_rows > 0 || isset($_SESSION['message'])): ?>
			<?php 
				if ($result->num_rows > 0) {
					$user = mysqli_fetch_assoc($result);
					extract($user);
				}
			?>
		<form action="../database/admin/admin-process.php" onsubmit="return validate_blog('editblog');"  method="POST" class="shadow p-sm-3 p-2 rounded"  enctype="multipart/form-data">
			<input type="hidden" name="blog_id" value="<?= isset($_SESSION['message']['data']['blog_id'])?$_SESSION['message']['data']['blog_id'] : $id; ?>">
			<div class="row justify-content-center">
				<div class="col-sm-6">
					<div class="form-floating mb-3">
				  <input type="text" class="form-control" id="floatingInput" placeholder="Blog Title" name="blog_title" value="<?= $blog_title??''; ?>">
				  <label for="floatingInput">Blog Title</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="blog_title_msg">
					<?= $blog_title_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6">
					<div class="form-floating mb-3">
				  <input type="number" class="form-control" id="floatingInput"  min="1" placeholder="Posts Per Page" name="post_per_page" value="<?= $post_per_page??''; ?>">
				  <label for="floatingInput">Posts Per Page</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="post_per_page_msg">
					<?= $post_per_page_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 mb-3">
					<span class="mx-2">
						<b>Blog Status </b>
					</span>
					<br>
					<div class="mx-2 form-check form-check-inline">
				  <input  class="form-check-input" type="radio" id="inlineCheckbox1" value="Active" name="blog_status"  <?= (isset($blog_status) && $blog_status=='Active')?"checked": '';?> >
				  <label class="form-check-label" for="inlineCheckbox1" >Active</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="inlineCheckbox2" value="InActive" name="blog_status"  <?= (isset($blog_status) && $blog_status=='InActive')?"checked": '';?>>
				  <label class="form-check-label" for="inlineCheckbox2">InActive</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="blog_status_msg">
					<?= $blog_status_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">

				<div class="col-sm-6">
					<img src="<?= (isset($blog_background_image))?("../uploads/blog-images/".$blog_background_image):""; ?><?= (isset($blog_image))?("../uploads/blog-images/".$blog_image):""; ?>" style="width: 60px;height: 60px;" class="mt-2">
					<div class="form-floating mb-3">
						<input type="hidden" name="blog_image" value="<?= isset($blog_background_image)?$blog_background_image:$blog_image; ?>">
						  <input type="file" class="form-control" id="floatingInput" placeholder="Featured Image" name="blog_background_image" accept="image/*">
						  <label for="floatingInput">Featured Image</label>
					</div>
					<p class="px-1 text-danger mb-3" style="font-size:12px" id="blog_background_image_msg">
						<?= $blog_background_image_msg ?? '';?>
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 row justify-content-end">
					<div class="col-sm-6">
						<input type="Submit" name="editblog" value="Edit Blog" class="form-control btn btn-primary">
					</div>
				</div>	
			</div>
		</form>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				Bad Request...! No Blog Found..!
			</div>
		<?php endif ?>
	</div>
	<!-- /edit Blog -->
	
	<?php 
	if (isset($_SESSION['message'])) {
		session_destroy();
	}
?>