<?php 
	require('../../config/database.php');
	if (isset($_REQUEST['email'])) {
		extract($_REQUEST);
		$query = "SELECT * FROM user WHERE email = '{$email}'";
		$result = $database->execute_query($query);
		if ($result->num_rows > 0) {
			echo "true";
		}else{
			echo "false";
		}
	}
?>