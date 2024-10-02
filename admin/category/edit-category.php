<?php 
	session_start();
	if (isset($_SESSION['message'])) {
		extract($_SESSION['message']);
		extract($data);
	}
	$id = $_REQUEST['id']??0;
	$query = "SELECT * FROM category WHERE category_id = '{$id}'";
	$result = $database->execute_query($query);
?>
	<!-- Edit category -->
	<div>
		<h1 class="bg-secodary text- shadow px-5 py-3 rounded">EDIT CATEGORY</h1>
		<?php if ($result->num_rows > 0 || isset($_SESSION['message'])): ?>
			<?php 
				if ($result->num_rows > 0) {
					$user = mysqli_fetch_assoc($result);
					extract($user);
				}
			?>
		<form action="../database/admin/admin-process.php" onsubmit="return  validate_category();"  method="POST" class="shadow p-sm-3 p-2 rounded"  enctype="multipart/form-data">
			
			<input type="hidden" name="category_id" value="<?= isset($_SESSION['message']['data']['category_id'])?$_SESSION['message']['data']['category_id'] : $id; ?>">
			<div class="row justify-content-center">
				<div class="col-sm-6">
					<div class="form-floating mb-3">
				  <input type="text" class="form-control" id="floatingInput" placeholder="Category Title" name="category_title" value="<?= $category_title??''; ?>">
				  <label for="floatingInput">Category Title</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="category_title_msg">
					<?= $category_title_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6">
					<div class="form-floating mb-3">
				  <input type="text" class="form-control" id="floatingInput" placeholder="Category Description" name="category_description" value="<?= $category_description??''; ?>">
				  <label for="floatingInput">Category Description</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="category_description_msg">
					<?= $category_description_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 mb-3">
					<span class="mx-2">
						<b>Category Status </b>
					</span>
					<br>
					<div class="mx-2 form-check form-check-inline">
				  <input  class="form-check-input" type="radio" id="inlineCheckbox1" value="Active" name="category_status"  <?= (isset($category_status) && $category_status=='Active')?"checked": '';?> >
				  <label class="form-check-label" for="inlineCheckbox1" >Active</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="inlineCheckbox2" value="InActive" name="category_status"  <?= (isset($category_status) && $category_status=='InActive')?"checked": '';?>>
				  <label class="form-check-label" for="inlineCheckbox2">InActive</label>
				</div>
				<p class="px-1 text-danger mb-3" style="font-size:12px" id="category_status_msg">
					<?= $category_status_msg ?? '';?>
				</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-sm-6 row justify-content-end">
					<div class="col-sm-6">
						<input type="Submit" name="editcategory" value="EDIT Category" class="form-control btn btn-primary">
					</div>
				</div>	
			</div>
		</form>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				Bad Request...! No Category Found..!
			</div>
		<?php endif ?>
	</div>
	<!-- /edit category -->
	
	<?php 
	if (isset($_SESSION['message'])) {
		session_destroy();
	}
?>