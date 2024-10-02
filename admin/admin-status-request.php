<?php 
	session_start();
	require("../config/database.php");
	require('../Mailing and PDF/PHPMailer.php');
	require("../Mailing and PDF/mailing/manage-emails.php");
	$table = $_REQUEST['table'];
	$field = $_REQUEST['field'];
	$id = $_REQUEST['id'];
	$value = $_REQUEST['value'];
	$id_field = $table."_id";
	$query = "UPDATE $table SET $field = '{$value}' WHERE $id_field = '{$id}'";

	$result = $database->execute_query($query);
	if ($table == "user") {
		$send_email->account_status($id,$value);
	}

	if (!$result) {
		$_SESSION['msg'] = '<p class="alert alert-danger shadow my-3" role="alert"> Could Not Change Status..!<br>Please Try Again..!</p>';
	}
?>