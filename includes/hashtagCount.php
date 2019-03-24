<?php 
	include_once 'dbh.inc.php';
	$hashtag = $_POST['query'];
	$sql = "SELECT * from hashtagCount where hashtag = '$hashtag'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array($result);
		$c = $row['count'];
		$c++;
		$increment = "UPDATE hashtagCount set count = '$c' where hashtag = '$hashtag'";
		mysqli_query($conn,$increment);
	}else{
		$insert = "INSERT into hashtagCount(hashtag,count) values ('$hashtag','1')";
		mysqli_query($conn,$insert);
	}
	echo $c;
?>