
<!-- All CATEGORIES -->
<?php 
	session_start();
	$query = "SELECT * FROM category ORDER BY category_id DESC";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">All CATEGORIES</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Category Title</th>
            <th>Category Description</th>
            <th>Category Status</th>
            <th>Created At</th>
            <th>Last Updated On</th>
            <th>Actions</th>
        </tr>
    </thead>
   <tbody>
   		<?php if ($result->num_rows > 0): ?>
   			<?php $i = 1; ?>
	   		<?php while ($rows = mysqli_fetch_assoc($result)): ?>
	   			<?php extract($rows); ?>
		        <tr>
		            <td><?= $i++ ?></td>
		            <td><?= $category_title ?></td>
		            <td><?= $category_description ?></td>
		            <td><?= $category_status ?></td>
		            <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
		            <td><?= ($updated_at)?date("d-m-Y H:i:s A",strtotime($updated_at)):"" ?></td>

		            <td>
		            	<a style="cursor: pointer;" onclick="get_content('edit_category','category',<?= $category_id ?>)" class="btn btn-success m-1">Edit</a>
		            	<?php $status =  ($category_status=="Active")?"InActive":"Active" ?>
		            	<a style="cursor: pointer;" onclick="change_status('category','category_status',<?= $category_id ?>,'<?= $status ?>','get_categories')" class="btn <?= ($category_status=="Active")?"btn-danger":"btn-success" ?>">
		            		<?= $status ?>
		            	</a>
		            </td>
		        </tr>
	        <?php endwhile ?>
   		<?php else: ?>
   			<tr>
   				<td colspan="13">
   					<p class="alert alert-danger" role="role" >
   						No Post Found..!
   					</p>
   				</td>
   			</tr>
   		<?php endif ?>
   </tbody>
    <tfoot>
          <tr>
            <th>Sr.No</th>
            <th>Category Title</th>
            <th>Category Description</th>
            <th>Category Status</th>
            <th>Created At</th>
            <th>Last Updated On</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
</div>
<?php 
	session_destroy();
?>
<!-- /All CATEGORIES -->