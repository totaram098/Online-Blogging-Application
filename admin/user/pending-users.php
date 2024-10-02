
<!-- All Users -->
<?php 
	session_start();
	$query = "SELECT u.*,r.role_type FROM user u JOIN role r  USING(role_id) WHERE u.is_approved = 'Pending' ORDER BY u.user_id DESC";
	$result = $database->execute_query($query);
?>
<?= $_SESSION['msg']?? "" ?>
<div class="table-responsive">
	<h1 class="bg-secodary text- shadow px-5 py-3 rounded">PENDING USERS</h1>
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
            <th>Created At</th>
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
		            	<a href="../uploads/profile-images/<?= $user_image ?>" target="__blank">
			            	<img src="../uploads/profile-images/<?= $user_image ?>" alt="" style="width: 50px;height: 50px;border-radius: 50px;">
		            	</a>
		            </td>
		            <td><?= $first_name." ".$last_name ?></td>
		            <td><?= $email ?></td>
		            <td><?= $gender ?></td>
		            <td><?= $address ?></td>
		            <td><?= $role_type ?></td>
		            <td><?= $created_at ?></td>

		            <td>
		            	<a style="cursor: pointer;" onclick="change_status('user','is_approved',<?= $user_id ?>,'Approved','pending_users')" class="btn btn-success">
		            		Approve
		            	</a>
		            	<a style="cursor: pointer;" onclick="change_status('user','is_approved',<?= $user_id ?>,'Rejected','pending_users')" class="btn btn-danger">
		            		Reject
		            	</a>
		            </td>
		        </tr>
	        <?php endwhile ?>
   		<?php else: ?>
   			<tr>
   				<td colspan="13">
   					<p class="alert alert-danger" role="role" >
   						No Pending User Found..!
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
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
</div>
<?php 
	session_destroy();
?>
<!-- /All Users -->