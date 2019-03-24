<?php 
	include_once 'dbh.inc.php';
	$image = $_POST['query'];
	$sql = "SELECT * from download where image = '$image'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		$c = $row['count'];
		$c++;
		$increment = "UPDATE download set count = '$c' where image = '$image'";
		mysqli_query($conn,$increment);
	}else{
		$insert = "INSERT into download(image,count) values ('$image','1')";
		mysqli_query($conn,$insert);
	}
	echo $c;
?>