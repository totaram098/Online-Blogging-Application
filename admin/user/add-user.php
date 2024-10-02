
			  			<!-- add User -->

						<?php 
							session_start();
							if (isset($_SESSION['message'])) {
								// $message = unserialize($_REQUEST['message']);
								extract($_SESSION['message']);
								if (isset($data)) {
									extract($data);
								}
							}
						?>
			  			<div>
				  			<h1 class="bg-secodary text- shadow px-5 py-3 rounded">ADD USER</h1>
				  			<?= $_SESSION['msg']?? "" ?>
							<form action="../database/admin/admin-process.php" onsubmit="return validate_registration();" method="POST" class="shadow my-3 p-sm-3 p-2 rounded" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="text" class="form-control" name="first_name" id="floatingInput" placeholder="Totaram" value="<?= $first_name??""; ?>">
										  <label for="floatingInput">First Name</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="first_name_msg">
											<?= $first_name_msg ?? "";?>
										</p>
									</div>
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="text" class="form-control" id="floatingInput" name="last_name" placeholder="Meghwar" value="<?= $last_name??""; ?>">
										  <label for="floatingInput">Last Name</label>
										</div>

										<p class="px-1 text-danger mb-3" style="font-size:12px" id="last_name_msg">
											<?= $last_name_msg ?? "";?>
										
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<span class="mx-2">
											<b>Gender </b>
										</span>
										<br>
										<div class="mx-2 form-check form-check-inline">
										  <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Male" name="gender" <?= (isset($gender) && $gender=='Male')?"checked": "";?> >
										  <label class="form-check-label" for="inlineCheckbox1" >Male</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Female" name="gender"  <?= (isset($gender) && $gender=='Female')?"checked": "";?>>
										  <label class="form-check-label" for="inlineCheckbox2">Female</label>
										</div>

										<p class="px-1 text-danger mb-3" style="font-size:12px" id="gender_msg">
											<?= $gender_msg ?? "";?>
										</p>
									</div>
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="text" class="form-control" id="floatingInput" placeholder="example123@gmail.com" name="email" value="<?= $email??""; ?>" onblur="check_email(this,'Admin')" >
										  <label for="floatingInput">Email</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="email_msg">
											<?= $email_msg ?? "";?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="date" class="form-control" id="floatingInput" placeholder="Date of Birth" name="date_of_birth" value="<?= $date_of_birth??""; ?>">
										  <label for="floatingInput">Date Of Birth</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="date_of_birth_msg">
											<?= $date_of_birth_msg ?? "";?>
										</p>
									</div>
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="file" class="form-control" id="floatingInput" placeholder="example123@gmail.com" name="user_image" accept="image/*">
										  <label for="floatingInput">Profile Image</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="user_image_msg">
											<?= $user_image_msg ?? "";?>
										</p>
									</div>
								</div>
				  				<div class="row">
									<div class="col-lg-6">
										<div class="form-floating">
										  <textarea class="form-control" id="floatingInput" placeholder="Address" name="address" value=""><?= $address??""; ?></textarea>
										  <label for="floatingInput">Address</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="address_msg">
											<?= $address_msg ?? "";?>
										</p>
									</div>
				  					<div class="col-lg-6">
										<div class="form-floating mb-3">
											<select name="role_id" class="form-select" aria-label="Default select example">
											  <option value="">Select Role</option>
											  <?php 
											  	$roles = "SELECT * FROM role";
											  	$roles = $database->execute_query($roles);
											  	if ($roles->num_rows >0 ) {
											  		while($user_role = mysqli_fetch_assoc($roles)){
											  ?>
											  <option value="<?= $user_role['role_id'] ?>" <?= (isset($role_id) && $role_id == $user_role['role_id'])?"selected":"" ?>>
											  	<?= $user_role['role_type'] ?>
											  </option>
											  <?php
											  		}
											  	}
											  ?>
											</select>
										  <label for="floatingInput">Role</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="role_msg">
											<?= $role_msg ?? "";?>
										</p>
				  					</div>
				  				</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="password" class="form-control" id="floatingInput" placeholder="Password" name="password" value="<?= $password??""; ?>">
										  <label for="floatingInput">Password</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="password_msg">
											<?= $password_msg ?? "";?>
										</p>
									</div>
									<div class="col-lg-6">
										<div class="form-floating">
										  <input type="password" class="form-control" id="floatingInput" placeholder="Confirm Password" name="confirm_password" value="<?= $confirm_password??""; ?>">
										  <label for="floatingInput">Confirm Password</label>
										</div>
										<p class="px-1 text-danger mb-3" style="font-size:12px" id="confirm_password_msg">
											<?= $confirm_password_msg ?? "";?>
										</p>
									</div>
								</div>
								<div class="row justify-content-end">
									<div class="col-md-3 col-sm-6 mb-2">
										<input type="reset" name="adduser" value="Clear" class="form-control btn btn-danger">
									</div>
									<div class="col-md-3 col-sm-6">
										<input type="Submit" name="adduser" value="Add User" class="form-control btn btn-primary" id="submit_button">
									</div>
								</div>
							</form>
			  			</div>
			  			<!-- /add user -->
			  			
			  			<?php 
							if (isset($_SESSION['message'])) {
								session_destroy();
							}
						?>