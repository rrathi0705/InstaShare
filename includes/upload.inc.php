<?php
	session_start();
	include_once 'dbh.inc.php';
	$username = $_SESSION['username'];
	$destinationFile='';
	if(isset($_POST['upload'])){
		if(isset($_FILES['image'])){
			$tags = $_POST['tags'];
			$image =  $_FILES['image'];
			print_r($image);
			$imagename = $_FILES['image']['name'];
			$fileExtension = explode('.', $imagename);
			$fileCheck = strtolower(end($fileExtension));
			$fileExtensionStored = array('png','jpg','jpeg');
			if(in_array($fileCheck, $fileExtensionStored)){
				$destinationFile = '../images/'.$imagename;
				move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
				$d = date("y/m/d");
				$sql = "INSERT into uploads (username,tags,image,uploadDate) values ('$username','$tags','$destinationFile','$d')";

				mysqli_query($conn,$sql);
				header("location:../home.php?Upload=true");
			}
		}
		
	}
?>