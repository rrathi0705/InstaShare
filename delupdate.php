<?php
	session_start();
	include_once 'includes/dbh.inc.php';
	$uid = $_GET['uid'];
	if($_GET['action']=="delete"){
		$sql = "DELETE from uploads where uid = '$uid'";
		mysqli_query($conn,$sql);
		header("Location:myuploads.php?Delete=true");
		exit();
	}else if($_GET['action']=='edit'){
		$sql = "SELECT * from uploads where uid = '$uid'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>InstaShare</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style type="text/css">
	*{
		margin:0px;
		padding: 0px;
	}
	.heading{
		background-color: #eed;
		height: 60px;
	}
	.heading span {
		color : black;
		font-size: 30px;
		font-style: italic;
		font-family: 'Pacifico';
		margin-left: 50px;
		margin-top: 25px;
	}
	.heading img{
		margin-right:10px;
		margin-bottom: 10px;
	}
	.menu {
		float: right;
		margin-right: 20px;
		margin-top: 10px;
	}
	nav form{
		margin-left: 350px;
	}
	.upload{
		margin: auto;
		margin-top: 30px;
		width: 400px;
	}
	.upload input{
		margin-top: 10px;
		margin-bottom: 10px;
	}

</style>
<script type="text/javascript">
	function logout(){
		window.location.href="includes/logout.php";
	}
	$(document).ready(function(){
		$( "#searchValue" ).autocomplete({
  			source: function( request, response ) {
			   // Fetch data
			   $.ajax({
			    url: "search.php",
			    type: 'post',
			    dataType: "json",
			    data: {
			     query: request.term
			    },
			    success: function( data ) {
			     	response( data );
			    }
			   });
			}
			  
 		});
		
	});
</script>
<body>
	<div class="heading">
		<span><img src="images/logo.jpg" style="width: 30px;">InstaShare</span>
		<div class="menu">
			<button class="btn btn-primary" onclick="logout()">LogOut</button>
		</div>
	</div>
	<nav class="navbar navbar-expand-sm bg-light navbar-light">
		<ul class="navbar-nav">
		    <li class="nav-item">
		      <a class="nav-link" href="home.php">Home</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="upload.php">Upload</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="myuploads.php">My Images</a>
		    </li>
		    
		</ul>
	  	<form class="form-inline" action="search.php" method="POST">
    		<input class="form-control" type="text" placeholder="Search Images" style="width: 350px; margin-right: 20px;" id="searchValue">
    		<button class="btn btn-success" type="submit">Search</button>
  		</form>
	</nav>
	<div class="upload">
		<form method="post" action="includes/edit.inc.php" enctype="multipart/form-data">
			<div class="input-group"> 
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                <label class="custom-file-label" for="inputGroupFile01">Replace Image</label>
              </div>
            </div>
			<input type="text" name="tags" class="form-control" placeholder="Enter comma Seperated Tags" value = "<?php echo $row['tags'];?>">
			<input type="hidden" name="uid" value="<?php echo $uid;?>">
			<button name="edit" class="btn btn-success">Edit</button>
		</form>
	</div>
</body>
</html>

<?php


	}

?>