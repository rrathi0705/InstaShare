<?php
	session_start();
	include_once 'dbh.inc.php';
	$username = $_SESSION['username'];
	$destinationFile='';
	if(isset($_POST['edit'])){
		if(isset($_FILES['image'])){
			$tags = $_POST['tags'];
			$image =  $_FILES['image'];
			$uid = $_POST['uid'];
			print_r($image);
			$imagename = $_FILES['image']['name'];
			$fileExtension = explode('.', $imagename);
			$fileCheck = strtolower(end($fileExtension));
			$fileExtensionStored = array('png','jpg','jpeg');
			if(in_array($fileCheck, $fileExtensionStored)){
				$destinationFile = '../images/'.$imagename;
				move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
				$sql = "UPDATE uploads SET tags = '$tags',image = '$destinationFile' where uid = '$uid'";
				//$sql = "INSERT into uploads (username,tags,image) values ('$username','$tags','$destinationFile')";

				mysqli_query($conn,$sql);
				header("location:../myuploads.php?Edit=true");
			}
		}
		
	}
?>