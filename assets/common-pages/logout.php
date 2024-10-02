<?php 
	setcookie("user_data","",time()-100,"/");
	header("location:../../index.php");
?>