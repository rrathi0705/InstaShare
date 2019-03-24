<?php
	session_start();
	include_once 'dbh.inc.php';
	$hash=$_GET['activation_code'];
	$sql = "UPDATE users SET verified='1' where hash='$hash'";
	mysqli_query($conn,$sql);
	header("location: ../login.php");
?>