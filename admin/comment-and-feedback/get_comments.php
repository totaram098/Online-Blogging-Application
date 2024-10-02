
<!-- All Comments -->
<?php 
    $user_data = unserialize($_COOKIE['user_data']);
    $user_id = $user_data['user_id'];
    	$query = "SELECT pc.*,p.post_title,u.first_name,u.last_name FROM post p 
                 JOIN blog b USING(blog_id) 
                 JOIN post_comment pc USING(post_id) 
                 JOIN user u ON pc.user_id  = u.user_id WHERE b.user_id = {$user_id}
                 ORDER BY pc.post_comment_id DESC";
	$result = $database->execute_query($query);
?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">ALL COMMENTS</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Post Title</th>
            <th>Comment</th>
            <th>Commentor Name</th>
            <th>Comment Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
   <tbody>
   		<?php if ($result->num_rows > 0): ?>
   			<?php $i = 1; ?>
	   		<?php while ($rows = mysqli_fetch_assoc($result)): ?>
	   			<?php extract($rows); ?>
		        <tr>
		            <td><?= $i++ ?></td>
		            <td><?= $post_title ?></td>
		            <td><?= $comment ?></td>
		            <td><?= $first_name." ".$last_name ?></td>
                    <td><?= $is_active ?></td>
                    <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
                    <td>
                        <?php $status =  ($is_active=="Active")?"InActive":"Active" ?>
                        <a style="cursor: pointer;" onclick="change_status('post_comment','is_active',<?= $post_comment_id ?>,'<?= $status ?>','get_comments')" class="btn <?= ($is_active=="Active")?"btn-danger":"btn-success" ?>">
                            <?= $status ?>
                        </a>
                    </td>
		        </tr>
	        <?php endwhile ?>
   		<?php else: ?>
   			<tr>
   				<td colspan="13">
   					<p class="alert alert-danger" role="role" >
   						No Feedback Yet..!
   					</p>
   				</td>
   			</tr>
   		<?php endif ?>
   </tbody>
    <tfoot>
        <tr>
            <th>Sr.No</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Feedback</th>
            <th>User Type</th>
            <th>Created At</th>
        </tr>
    </tfoot>
</table>
</div>
<!-- /All Comments -->