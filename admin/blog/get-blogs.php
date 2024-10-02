
<!-- All blogs -->
<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	$query = "SELECT * FROM blog WHERE user_id = {$user_id}
						ORDER BY blog_id DESC";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">All BLOGS</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Blog Title</th>
            <th>Posts Per Page</th>
            <th>Blog Image</th>
            <th>Status</th>
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
		            <td><?= $blog_title ?></td>
		            <td><?= $post_per_page ?></td>
		            <td>
		            	<a href="../uploads/blog-images/<?= $blog_background_image ?>">
			            	<img src="../uploads/blog-images/<?= $blog_background_image ?>" alt="" style="width: 50px;height: 50px;">
		            	</a>
		            </td>
		            <td><?= $blog_status ?></td>
		            <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
		            <td><?= ($updated_at)?date("d-m-Y H:i:s A",strtotime($updated_at)):"" ?></td>


		            <td>
		            	<a style="cursor: pointer;" onclick="get_content('edit_blog','blog',<?= $blog_id ?>)" class="btn btn-success m-1">Edit</a>
		            	<?php $status =  ($blog_status=="Active")?"InActive":"Active" ?>
		            	<a style="cursor: pointer;" onclick="change_status('blog','blog_status',<?= $blog_id ?>,'<?= $status ?>','get_blogs')" class="btn <?= ($blog_status=="Active")?"btn-danger":"btn-success" ?>">
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
            <th>Blog Title</th>
            <th>Posts Per Page</th>
            <th>Blog Image</th>
            <th>Status</th>
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
<!-- /All blogs -->