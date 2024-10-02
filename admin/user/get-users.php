
<!-- All Users -->
<?php 
	session_start();
	$user_data = unserialize($_COOKIE['user_data']);
	$user_id = $user_data['user_id'];
	$query = "SELECT u.*,r.role_type FROM user u JOIN role r  USING(role_id) WHERE u.is_approved = 'Approved' AND u.user_id != {$user_id}  ORDER BY u.user_id DESC ";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">All USERS</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Role</th>
            <th>Approval Status</th>
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
		            <td>
		            	<a href="../uploads/profile-images/<?= $user_image ?>"  target="__blank">
			            	<img src="../uploads/profile-images/<?= $user_image ?>" alt="" style="width: 50px;height: 50px;border-radius: 50px;">
		            	</a>
		            </td>
		            <td><?= $first_name." ".$last_name ?></td>
		            <td><?= $email ?></td>
		            <td><?= $gender ?></td>
		            <td><?= $address ?></td>
		            <td><?= $role_type ?></td>
		            <td><?= $is_approved ?></td>
		            <td><?= $is_active ?></td>
		            <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
		            <td><?= ($updated_at)?date("d-m-Y H:i:s A",strtotime($updated_at)):"" ?></td>

		            <td>
		            	<a style="cursor: pointer;" onclick="get_content('edit_user','user',<?= $user_id ?>)" class="btn btn-success m-1">Edit</a>
		            	<?php $status =  ($is_active=="Active")?"InActive":"Active" ?>
		            	<a style="cursor: pointer;" onclick="change_status('user','is_active',<?= $user_id ?>,'<?= $status ?>','get_users')" class="btn <?= ($is_active=="Active")?"btn-danger":"btn-success" ?>">
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
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Role</th>
            <th>Approval Status</th>
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
<!-- /All Users -->