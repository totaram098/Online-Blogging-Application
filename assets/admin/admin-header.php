<?php 
	require('../config/database.php');
	if (!isset($_COOKIE['user_data'])) {
			header("location:../index.php");
			exit();
	}else{
		$user_data = unserialize($_COOKIE['user_data']);
		if ($user_data['role_type'] != "Admin") {
			header("location:../index.php");
		}
	}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

  	<script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Admin Panel</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../assets/sidebars.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/8e452e995a.js" crossorigin="anonymous"></script>
	<script src="../assets/datatable/jquery-3.7.1.js"></script>
	<script src="../assets/datatable/dataTables.js"></script>
	<link rel="stylesheet" href="../assets/datatable/dataTables.dataTables.css">
	<link rel="stylesheet" href="../assets/multiSelect.css">

    <style>
    	*{
    		font-family: "Poppins", sans-serif;
			font-weight: 400;
			font-style: normal;
    	}
    	.sidebar{
    		z-index: 100;
    	}
    	.sidebar a{
    		cursor: pointer;
    	}
    	.close_sidebar{
    		animation: close_sidebar;
    		animation-duration: 0.5s;
    		animation-iteration-count: 1;
    	}
    	.open_sidebar{
    		animation: open_sidebar;
    		animation-duration: 0.5s;
    		animation-iteration-count: 1;
    	}
    	@keyframes close_sidebar {
    		from{
    			width: 100%;
    		}
    		to{
    			width: 0;

    		}
    	}
    	@keyframes open_sidebar {
    		from{
    			width: 0;
    		}
    		to{
    			width: 100%;

    		}
    	}
    	.profile_box li:hover{
    		background-color: lightgray;
    	}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

  </head>
  <body>
	<!-- loader -->
	<div id="loader_start" class="">
		<div style="position:fixed;display: flex;top:0;left:0;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.9); z-index: 100;text-align: center;align-items: center;justify-content: center;">
		<span class="loader"></span>
		</div>
	</div>
	<!-- /loader -->
  	<div class="container-fluid">
  		<div class="row">
  			<!-- sidebar for desktop -->
  			<div class="col-3 border-end border-1 d-none d-md-block m-0 p-0">
					<main class="p-0 m-0" style="min-height: 110vh;">
					  <div class="">
					  	<div class="row p-0 m-0">
					  		<div class="col-12 border-bottom border-1 bg-info-subtle py-3">
					  			<nav class="navbar p-0 m-0">
								  <div class="container">
								    <a class="navbar-brand" href="../index.php">
								     <img src="../assets/images/logo.png" alt="Bootstrap" width="100" height="50">
								    </a>
								  </div>
								</nav>
					  		</div>
					  		<div class="col-12 p-0 m-0 px-2 sidebar">
							    <ul class="list-unstyled ps-0">
							      <li class=" px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed">
							          <a href="../index.php" class="text-decoration-none text-dark fw-bold">Home</a>
							        </button>
							      </li>
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('dashboard')">
							          Dashboard
							        </button>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="true">
							         Manage Users
							        </button>
							        <div class="collapse show" id="users-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_users')">All Users</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('add_user')">Add User</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('pending_users')">Pending Users</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('rejected_users')">Rejected User</a></li>
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#blogs-collapse" aria-expanded="false">
							         Manage Blogs
							        </button>
							        <div class="collapse" id="blogs-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_blogs')">All Blog</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('add_blog')">Add Blog</a></li> 
							             <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_blog_followers')">Blog Followers</a></li>
							            
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#posts-collapse" aria-expanded="false">
							         Manage Posts
							        </button>
							        <div class="collapse" id="posts-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('get_posts')">All Posts</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('add_post','post')">Add Posts</a></li>
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#Categories-collapse" aria-expanded="false">
							         Manage Categories
							        </button>
							        <div class="collapse" id="Categories-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('get_categories')">All Categories</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('add_category')">Add Category</a></li>
							            <!-- <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('edit_category')">Edit Category</a></li> -->
							          </ul>
							        </div>
							      </li>
							      
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('get_comments')">
							          Comments
							        </button>
							      </li>
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('get_feedback')">
							          Feedback
							        </button>
							      </li>
							      <li class="border-top my-3"></li>
							      <li class="mb-1 px-3">
							        <button class="btn shadow btn-dark fw-bold d-inline-flex align-items-center rounded border-0 collapsed">
							         <a href="../assets/common-pages/logout.php" class="text-decoration-none text-light">Logout</a>
							        </button>
							      </li>
							    </ul>
					  		</div>
					  	</div>
					  </div>
					  <!-- <div class="b-example-divider b-example-vr"></div> -->
					</main>
  			</div>
  			<!-- /sidebar for desktop -->
  			<!-- sidebar for small devices -->
  			<div class="col-sm-5 bg-light sidebar sidebar_animation position-fixed border-end border-1 d-md-none d-none m-0 p-0" id="sidebar" style="z-index: 100;">
					<main class=" p-0 m-0">
					  <!-- <div class="b-example-divider b-example-vr"></div> -->
					  <div class="">
					  	<div class="row p-0 m-0">
					  		<div class="col-12 border-bottom border-1  bg-info-subtle py-3">
					  			<nav class="navbar p-0 m-0">
								  <div class="container">
								    <a class="navbar-brand" href="#">
								     <img src="../assets/images/logo.png" alt="Bootstrap" width="100" height="50">
								    </a>
								    <span onclick="close_sidebar()" style="cursor: 	pointer;">
								    	<i class="fa-solid fa-x"></i>
								    	
								    </span>
								  </div>
								</nav>
					  		</div>
					  		<div class="col-12 p-0 m-0 px-2">
							    <ul class="list-unstyled ps-0">
							      <li class=" px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed">
							          <a href="../index.php" class="text-decoration-none text-dark fw-bold">Home</a>
							        </button>
							      </li>
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('dashboard')">
							          Dashboard
							        </button>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="true">
							         Manage Users
							        </button>
							        <div class="collapse show" id="users-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_users')">All Users</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('add_user')">Add User</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('pending_users')">Pending Users</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('rejected_users')">Rejected User</a></li>
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#blogs-collapse" aria-expanded="false">
							         Manage Blogs
							        </button>
							        <div class="collapse" id="blogs-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_blogs')">All Blog</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('add_blog')">Add Blog</a></li> 
							             <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded" onclick="get_content('get_blog_followers')">Blog Followers</a></li>
							            
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#posts-collapse" aria-expanded="false">
							         Manage Posts
							        </button>
							        <div class="collapse" id="posts-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('get_posts')">All Posts</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('add_post','post')">Add Posts</a></li>
							          </ul>
							        </div>
							      </li>
							      <li class="mb-1">
							        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#Categories-collapse" aria-expanded="false">
							         Manage Categories
							        </button>
							        <div class="collapse" id="Categories-collapse">
							          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('get_categories')">All Categories</a></li>
							            <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('add_category')">Add Category</a></li>
							            <!-- <li><a class="link-body-emphasis d-inline-flex text-decoration-none rounded"  onclick="get_content('edit_category')">Edit Category</a></li> -->
							          </ul>
							        </div>
							      </li>
							      
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('get_comments')">
							          Comments
							        </button>
							      </li>
							      <li class="px-3">
							        <button type="button" class="btn fw-bold d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" onclick="get_content('get_feedback')">
							          Feedback
							        </button>
							      </li>
							      <li class="border-top my-3"></li>
							      <li class="mb-1 px-3">
							        <button class="btn shadow btn-dark fw-bold d-inline-flex align-items-center rounded border-0 collapsed">
							         <a href="../assets/common-pages/logout.php" class="text-decoration-none text-light">Logout</a>
							        </button>
							      </li>
							    </ul>
					  		</div>
					  	</div>
					  </div>
					  <!-- <div class="b-example-divider b-example-vr"></div> -->
					</main>
  			</div>
  			<!-- /sidebar for small devices -->
