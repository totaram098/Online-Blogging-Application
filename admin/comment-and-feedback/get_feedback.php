
<!-- All Feedback -->
<?php 
	$query = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
	$result = $database->execute_query($query);
?>
<h1 class="bg-secodary text- shadow px-5 py-3 rounded">ALL FEEDBACK</h1>
<div class="table-responsive">
	<table id="example" class="table display">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Feedback</th>
            <th>User Type</th>
            <th>Created At</th>
        </tr>
    </thead>
   <tbody>
   		<?php if ($result->num_rows > 0): ?>
   			<?php $i = 1; ?>
	   		<?php while ($rows = mysqli_fetch_assoc($result)): ?>
	   			<?php extract($rows); ?>
		        <tr>
		            <td><?= $i++ ?></td>
		            <td><?= $user_name ?></td>
		            <td><?= $user_email ?></td>
		            <td><?= $feedback ?></td>
		            <td><?= ($user_id)?"Registered User":"Guest User" ?></td>
                    <td><?= date("d-m-Y H:i:s A",strtotime($created_at)) ?></td>
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
<!-- /All Feedback -->