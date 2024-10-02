<?php 	
		include ('../assets/admin/admin-header.php');
?>
  			<!-- middle content -->
  			<div class="col-md-9" style="min-height: 100vh;">
			  	<div class="row">
	  				<!-- header -->
			  		<div class="col-12 d-flex justify-content-between border-bottom border-1 bg-info-subtle  py-3">
			  			<nav class="navbar p-0 m-0">
						  <div class="container p-0 m-0">
						    <a class="navbar-brand" href="#">
						  	<span class="d-md-none mx-3" onclick="open_sidebar()">
						  		<i class="fa-solid fa-bars" ></i>
						  	</span>
						    <img src="../assets/images/logo.png" alt="LOGO" class="d-md-none" width="100" height="50">
						    </a>
						  </div>
						</nav>
				        	<div class="profile  position-relative m-1 text-end" style="right: 0px;">
					      		<span><?= $user_data['first_name']." ".$user_data['last_name'] ?></span>
							    <img src="../uploads/profile-images/<?= $user_data['user_image']  ?>" alt="Profile" width="52" height="52" class="rounded-circle" style="cursor: pointer;" onclick="open_close_profile()">
							    <div class="text-start rounded d-none mt-2 position-absolute profile_box shadow bg-light p-2" style="right: 5px;z-index: 10;" id="profile">
							    	<ul class="p-0 m-0" style="list-style: 	none;min-width: 200px;">
							    		<li class="p-2 rounded"><a href="../index.php" class="text-decoration-none text-dark"><i class="fa-solid fa-house mx-2"></i>Home</a></li>
							    		<li class="p-2 rounded"><a href="../edit-profile.php?profile" class="text-decoration-none text-dark"><i class="fa-solid fa-user mx-2"></i>Profile</a></li>
							    		
							    		<li class=" p-2 rounded mt-1"><a href="../change-password.php?change_password" class="text-decoration-none text-dark"><i class="fa-solid fa-gear mx-2"></i>Change Password</a></li>

							    		<li class=" p-2 rounded mt-1"><a href="../assets/common-pages/logout.php" class="text-decoration-none text-dark"><i class="fa-solid fa-right-from-bracket mx-2"></i>Logout</a></li>
							    	</ul>
							    </div>
							</div>
						<!-- <div class="profile position-relative my-1">
							<span class="mx-2 d-sm-inline d-none">Totaram Meghwar</span>

						    <img src="../assets/images/profile.jpg" alt="Profile" width="52" height="52" class="rounded-circle" style="cursor: pointer;" onclick="open_close_profile()">
						    <div class="rounded d-none  mt-2 position-absolute profile_box shadow bg-light p-2" style="right: 5px;z-index: 10;" id="profile">
						    	<ul class="p-0 m-0" style="list-style: 	none;min-width: 150px;">
						    		<li class="p-2 d-sm-none  border-bottom border-1"><span href="#" class="text-decoration-none text-dark">Totaram Meghwar</span></li>
						    		<li class="p-2 rounded"><a href="#" class="text-decoration-none text-dark"><i class="fa-solid fa-user mx-2"></i>Profile</a></li>
						    		<li class=" p-2 rounded mt-1"><a href="#" class="text-decoration-none text-dark"><i class="fa-solid fa-gear mx-2"></i>Setting</a></li>
						    		<li class=" p-2 rounded mt-1"><a href="#" class="text-decoration-none text-dark"><i class="fa-solid fa-right-from-bracket mx-2"></i>Logout</a></li>
						    		<li class=" p-2 rounded mt-1"><a href="#" class="text-decoration-none text-dark"><i class="fa-solid fa-bars mx-2"></i>Preferences</a></li>
						    	</ul>
						    </div>
						</div> -->
			  		</div>
	  				<!-- /header -->
	  				<!-- content -->
			  		<div class="col-12 p-3" id="content">
			  			<!-- dashboard -->
			  			<h1 class="bg-secodary text- shadow px-5 py-3 rounded">DASHBOARD</h1>
			  			<div class="row">
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"   onclick="get_content('get_users')" class="text-decoration-none">
				  					<div class="card  border border-0 shadow h-100">
									  	<div class="card-body">
									   		<h3 class="">Users</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span> 
											   			<?php
											   				$query = "SELECT COUNT(user_id) total_users FROM user";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$total_users = mysqli_fetch_assoc($result);
											   					$total_users = $total_users['total_users'];
											   				}
											   			?>
											   			Total Users <b class="badge bg-warning text-dark"><?= $total_users??0 ?></b>
											   		</span>
											   	</div>
											</div>	
									    </div>
									</div>
			  					</a>
			  				</div>
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"  onclick="get_content('pending_users')" class="text-decoration-none">
				  					<div class="card border border-0 shadow h-100 h-100">
										<div class="card-body">
									   		<h3 class="">Pending Users</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span>
											   			<?php
											   				$query = "SELECT COUNT(user_id) pending_users FROM user WHERE is_approved = 'pending'";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$pending_users = mysqli_fetch_assoc($result);
											   					$pending_users = $pending_users['pending_users'];
											   				}
											   			?> 
											   			Pending Requests <b class="badge bg-warning text-dark"><?= $pending_users??0;?></b>
											   		</span>
											   	</div>
											</div>	
										</div>
									</div>
			  					</a>
			  				</div>
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"  onclick="get_content('get_blogs')" class="text-decoration-none">
				  					<div class="card border border-0 shadow h-100">
										<div class="card-body">
									   		<h3 class="">Blogs</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span> 
											   			<?php
											   				$query = "SELECT COUNT(blog_id) total_blogs FROM blog";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$total_blogs = mysqli_fetch_assoc($result);
											   					$total_blogs = $total_blogs['total_blogs'];
											   				}
											   			?>
											   			Total Blogs <b class="badge bg-warning text-dark"><?= $total_blogs??0;?></b>
											   		</span>
											   	</div>			
											</div>	
										</div>
									</div>
			  					</a>
			  				</div>
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"   onclick="get_content('get_posts')" class="text-decoration-none">
				  					<div class="card border border-0 shadow h-100">
										<div class="card-body">
									   		<h3 class="">Posts</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span> 

											   			<?php
											   				$query = "SELECT COUNT(post_id) total_posts FROM post";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$total_posts = mysqli_fetch_assoc($result);
											   					$total_posts = $total_posts['total_posts'];
											   				}
											   			?>
											   			Total Post <b class="badge bg-warning text-dark"><?= $total_posts??0; ?></b>
											   		</span>
											   	</div>	
											</div>	
										</div>
									</div>
			  					</a>
			  				</div>
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"  onclick="get_content('get_categories')" class="text-decoration-none">
				  					<div class="card border border-0 shadow h-100">
										<div class="card-body">
									   		<h3 class="">Categories</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span>
											   			<?php
											   				$query = "SELECT COUNT(category_id) total_categories FROM category";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$total_categories = mysqli_fetch_assoc($result);
											   					$total_categories = $total_categories['total_categories'];
											   				}
											   			?> 
											   			All Categories <b class="badge bg-warning text-dark"><?= $total_categories??0; ?></b>
											   		</span>
											   	</div>	
											</div>	
										</div>
									</div>
			  					</a>
			  				</div>
			  				<div class="col-lg-4  col-md-6 mb-3">
			  					<a style="cursor:pointer;"  onclick="get_content('get_feedback')"  class="text-decoration-none">
				  					<div class="card border border-0 shadow h-100 h-100">
										<div class="card-body">
									   		<h3 class="">Feedback</h3>
									   		<div class="d-flex flex-wrap">	
										   		<div class="bg-info-subtle p-1 m-1 rounded">	
											   		<span>
											   			<?php
											   				$query = "SELECT COUNT(feedback_id) total_feedback FROM user_feedback";
											   				$result = $database->execute_query($query);
											   				if ($result->num_rows > 0) {
											   					$total_feedback = mysqli_fetch_assoc($result);
											   					$total_feedback = $total_feedback['total_feedback'];
											   				}
											   			?>  
											   			Total Feedback <b class="badge bg-warning text-dark"><?= $total_feedback??0; ?></b>
											   		</span>
											   	</div>
											</div>	
										</div>
									</div>
			  					</a>
			  				</div>
			  			</div>
			  			<!-- /dashboard -->
			  		</div>
	  				<!-- /content -->
		  		</div>

  			</div>
  			<!-- /middle content -->
<?php 	
		include ('../assets/admin/admin-footer.php');
?>