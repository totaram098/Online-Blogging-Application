
<!-- All Followers -->
<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	$query = "SELECT * FROM blog WHERE user_id = {$user_id}
						ORDER BY blog_id DESC";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">All FOLLOWERS</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Blog Title</th>
            <th>Followers</th>
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
		            </td>
		            <td>
		            	<?php 
			            		$follower_query = "SELECT u.* FROM following_blog fb JOIN USER u ON fb.follower_id = u.user_id WHERE fb.blog_following_id = {$blog_id} AND fb.follower_id != {$user_id}
			            			ORDER BY fb.follow_id DESC";
			            		$follower_result = $database->execute_query($follower_query);
			            		if ($follower_result->num_rows > 0) {
			            				$k = 0;
			            				while ($follower_data = mysqli_fetch_assoc($follower_result)) {
			            					if ($k++ > 0) {
			            						echo "<hr>";
			            					}
			            					?>
			            					<div>
			            						<img src="../uploads/profile-images/<?= $follower_data['user_image'] ?>" alt="" style="width: 40px;height: 40px;border-radius: 50px;">
			            						<?= $follower_data['first_name']." ". $follower_data['last_name']?>
			            					</div>
			            					<?php
			            				}
			            		}else{
			            			echo "No Any Follower..!";
			            		}
		            	?>
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
            <th>Followers</th>
        </tr>
    </tfoot>
</table>
</div>
<?php 
	session_destroy();
?>
<!-- /All Followers -->