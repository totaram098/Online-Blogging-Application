
<!-- All Posts -->
<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	$query = "SELECT p.*,b.blog_title FROM post p JOIN blog b  USING(blog_id) 
			WHERE b.user_id = {$user_id} ORDER BY p.post_id DESC";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">All POSTS</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Featured Image</th>
            <th>Post Title</th>
            <th>Post Summary</th>
            <th>Post Description</th>
            <th>Status</th>
            <th>Comment Status</th>
            <th>Blog</th>
            <th>Attachments</th>
            <th>Categories</th>
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
		            <td>
		            	<a href="../uploads/post-images/<?= $featured_image ?>" target="__blank">
			            	<img src="../uploads/post-images/<?= $featured_image ?>" alt="" style="width: 50px;height: 50px;">
		            	</a>
		            </td>
		            <td><?= $post_title ?></td>
		            <td><?= substr($post_summary, 0,80) ?>...</td>
		            <td><?= substr($post_description, 0,80) ?>...</td>
		            <td><?= $post_status ?></td>
		            <td><?= ($is_comment_allowed==1)?"Allowed":"Not Allowed" ?></td>
		            <td><?= $blog_title ?></td>
		            <td>
		            	<?php
		            		$attachment_query = "SELECT * FROM post_atachment WHERE post_id = '{$post_id}'";
		            		$attachment_result = $database->execute_query($attachment_query);
		            		if ($attachment_result->num_rows > 0) {
				            	$k = 0; 
		            			while ($attachments = mysqli_fetch_assoc($attachment_result)) {
		            				if ($k++ > 0) {
		            						echo "<hr>";
		            				}
	            				require_once('../assets/user/file-types.php');
								$type = $attachments['post_attachment_path'];
								$type = explode(".", $type);
								$type = end($type);
								$type = strtolower($type);
								$icon = null;
								foreach ($file_types as $key => $value) {
									if ($key == $type) {
										$icon = $value;
									}
								}
								$icon = $icon??$file_types['other'];

		            	?>

		            	<a href="../uploads/attachments/<?= $attachments['post_attachment_path']; ?>" target="__blank">
		            		<img src="../assets/images/<?= $icon ?>" style="width:20px;">
		            		<?= $attachments['post_attachment_title'] ?>
		            	</a>
		            	<?php
		            							
		            			}
		            		}
		            	?>
		            </td>
		            <td>
		            	<?php 
		            		$category_query = "SELECT c.category_title FROM post_category pc JOIN category c USING(category_id) WHERE pc.post_id = '{$post_id}'";
		            		$category_result = $database->execute_query($category_query);
		            		if ($category_result->num_rows > 0) {
		            			while ($category = mysqli_fetch_assoc($category_result)) {
		            	?>
				            	<span class="badge bg-warning">
				            		<?= $category['category_title'] ?>
				            	</span>
		            	<?php			
		            			}
		            		}
		            	?>
		            </td>
		            <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
		            <td><?= ($updated_at)?date("d-m-Y H:i:s A",strtotime($updated_at)):"" ?></td>

		            <td>
		            	<a style="cursor: pointer;" onclick="get_content('edit_post','post',<?= $post_id ?>)" class="btn btn-success m-1">Edit</a>
		            	<?php $status =  ($post_status=="Active")?"InActive":"Active" ?>
		            	<a style="cursor: pointer;" onclick="change_status('post','post_status',<?= $post_id ?>,'<?= $status ?>','get_posts')" class="btn <?= ($post_status=="Active")?"btn-danger":"btn-success" ?>">
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
            <th>Featured Image</th>
            <th>Post Title</th>
            <th>Post Summary</th>
            <th>Post Description</th>
            <th>Status</th>
            <th>Comment Status</th>
            <th>Created At</th>
            <th>Last Updated On</th>
            <th>Blog</th>
            <th>Attachments</th>
            <th>Categories</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
</div>
<?php 
	session_destroy();
?>
<!-- /All Posts -->