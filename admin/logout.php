<?php 
	$auth = 0;

	include "includes/constants.php";
	include "includes/db.php";
	include "includes/auth.php";

	$_SESSION = array();
	header('Location:' . WEBROOT . 'admin/index.php');
?>