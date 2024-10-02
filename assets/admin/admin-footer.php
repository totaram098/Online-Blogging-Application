
  			<div class="col-12 border-top border-3">
  				 <!-- footer -->
                <div class="">
                    <div class="row justify-content-around bg-info-subtle pt-sm-4">
                        <div class="col-lg-3 mb-3">
                            <p class="m-0"><i class="fa-solid fa-phone px-2"></i> +92-xxx-xxxxxxx</p>
                            <p class="m-0"><i class="fa-solid fa-envelope px-2"></i> official.blog@gmail.com</p>
                            <p class="m-0"><i class="fa-solid fa-house px-2"></i> ABC Building Jamshoro,Sindh</p>
                        </div>
                        <div class="col-lg-3 mb-3">
                          <div class="row align-items-center text-decoration-none">
                            <div class="col-sm-6">
                              <a class=" text-dark" href="../index.php">Home</a>
                            </div>
                            <div class="col-sm-6">
                              <a class=" text-dark" href="../assets/common-pages/logout.php">Logout</a>
                            </div>
                            <div class="col-sm-6">
                              <a class=" text-dark" href="../edit-profile.php?profile">Profile</a>
                            </div>

                            <div class="col-sm-6">
                              <a class=" text-dark" href="index.php">Dashbord</a>
                            </div>
                          </div>

                        </div>
                        <div class="col-lg-3 ">
                            <span>
                                <i class="fa-brands fa-google p-1 fa-2x"></i>
                            </span>
                            <span>
                                <i class="fa-brands fa-x-twitter p-1 fa-2x"></i>
                            </span>
                            <span>
                                <i class="fa-brands fa-youtube p-1 fa-2x"></i>
                            </span>
                            <span>
                                <i class="fa-brands fa-facebook p-1 fa-2x"></i>
                            </span>
                            <span>
                                <i class="fa-brands fa-linkedin p-1 fa-2x "></i>
                            </span>
                        </div>
                        <div class="col-12 mt-3  text-center py-3 border-top border-1 border-dark">
                            <p class="p-0 m-0"> 
                                HIST 21500 All &copy;Copy right Reserved
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /footer -->
  			</div>
  		</div>
  	</div>
	<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/sidebars.js"></script>
    <script src="../assets/multistyle.js"></script>
    <script src="validation/registration.js"></script>
    <script src="validation/blog.js"></script>
    <script src="validation/post.js"></script>
    <script src="validation/category.js"></script>
    <script src="../assets/common-pages/email_check.js"></script>
    <script>
    	function open_sidebar(){
    		var element = document.getElementById("sidebar");
    		element.classList.add("open_sidebar");
    		element.classList.remove("close_sidebar");
    		setTimeout(function(){
	    		element.classList.remove("d-none");
    		},500);
    	}
    	function close_sidebar(){
    		var element = document.getElementById("sidebar");
    		element.classList.remove("open_sidebar");
    		element.classList.add("close_sidebar");
    		setTimeout(function(){
	    		element.classList.add("d-none");
    		},500);
    	}

        function open_close_profile(){
            var element = document.getElementById("profile");
            element.classList.toggle("d-none");
        }
        var counter = 1;
        function add_attachment(){
            var node = document.createElement("div");
            counter++;
            var particular_attachment= "attachment_"+counter;
            node.classList.add("row");
            node.classList.add("justify-content-center");
            node.classList.add(particular_attachment);
            var content = ` 
                            <div class="mb-3 col-md-6" style="">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-end mt-2">
                                        <button onclick="remove_attachment('attachment_`+counter+`')" type="button" class="btn btn-primary" >Remove <i class="fa-solid fa-x"></i></button>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="form-floating my-3">
                                          <input type="text" class="form-control" id="floatingInput" name="attachment_title[]" placeholder="Post Title">
                                          <label for="floatingInput">Attachment Title</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                          <input type="file" name="attachment[]" class="form-control" id="floatingInput" placeholder="Attachments" accept="multiple">
                                          <label for="floatingInput">Attachment</label>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            node.innerHTML = content;
            document.getElementById("attachment_box").appendChild(node);
        }
        function remove_attachment(classname){
            var element = document.getElementsByClassName(classname);
            element[0].remove();
        }

        var content_box = document.getElementById("content");
        var dashboard = document.getElementById("content").innerHTML;
        function get_content(action,optional="",data=""){
            if (action=="dashboard") {
                content_box.innerHTML = dashboard;
            }else{
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        content_box.innerHTML = xhr.responseText;
                        new DataTable('#example');
                    }
                }
                xhr.open("GET","admin-ajax-request.php?"+action+"= &id="+data);
                xhr.send();
            }
            if (optional == "post") {
                setTimeout(function() {
                    document.querySelectorAll('[data-multi-select]').forEach(select => new MultiSelect(select));
                }, 500);
            }
        }

        function change_status(table,field,id,value,show_content){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    get_content(show_content);
                }
            }
            xhr.open("GET","admin-status-request.php?table="+table+"&field="+field+"&id="+id+"&value="+value);
            xhr.send();
        }

        window.onload = function(){
            document.querySelector("#loader_start").classList.add("d-none");
        }

    </script>
   
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($_REQUEST['adduser'])): ?>
        <script>
            get_content("add_user");
        </script>
    <?php elseif (isset($_REQUEST['edituser'])): ?>
        <script>
            get_content("edit_user");
        </script> 
    <?php elseif (isset($_REQUEST['getusers'])): ?>
        <script>
            get_content("get_users");
        </script>
    <?php elseif (isset($_REQUEST['addblog'])): ?>
        <script>
            get_content("add_blog");
        </script>
    <?php elseif (isset($_REQUEST['editblog'])): ?>
        <script>
            get_content("edit_blog");
        </script>
    <?php elseif (isset($_REQUEST['getblogs'])): ?>
        <script>
            get_content("get_blogs");
        </script>
    <?php elseif (isset($_REQUEST['addpost'])): ?>
        <script>
            get_content("add_post","post");
        </script>
    <?php elseif (isset($_REQUEST['getposts'])): ?>
        <script>
            get_content("get_posts");
        </script>
    <?php elseif (isset($_REQUEST['editpost'])): ?>
        <script>
            get_content("edit_post","post");
        </script>
    <?php elseif (isset($_REQUEST['addcategory'])): ?>
        <script>
            get_content("add_category");
        </script>
    <?php elseif (isset($_REQUEST['editcategory'])): ?>
        <script>
            get_content("edit_category");
        </script>
    <?php elseif (isset($_REQUEST['getcategories'])): ?>
        <script>
            get_content("get_categories");
        </script>
    <?php elseif (isset($_REQUEST['get_comments'])): ?>
        <script>
            get_content("get_comments");
        </script>
    <?php endif ?>
</body>
</html>
