<?php
	session_start();
	$username = $_SESSION['username'];
	include_once 'includes/dbh.inc.php';
	$edit="false";
	@$edit = $_GET['Edit'];
	$delete="false";
	@$delete = $_GET['Delete'];
	$count = "SELECT * from uploads where username = '$username'";
	$result = mysqli_query($conn,$count);
	$x = mysqli_num_rows($result);
	$limit =4;
	$no_of_pages = $x/$limit;

	if(isset($_GET['current']))
		$current = $_GET['current'];
	else
		$current = 1;
	$startPageNo = ($current*$limit) - $limit;
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
	img{
		width:280px;
	}
	.card{
		width: 310px;
		float: left;
		margin: 1%;
		margin-top: 1%;
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
 		$("#add").append('<li class="page-item"><a class="page-link" href="myuploads.php?current=<?php if($current>1)echo $current-1;else echo $current;?>">Previous</a></li><li class="page-item"><a class="page-link" href="#"><?php echo $current;?></a></li><li class="page-item"><a class="page-link" href="myuploads.php?current=<?php if($current<$no_of_pages)echo $current+1;else echo $current;?>">Next</a></li>');


 		$(".downloadCount").click(function(){
 			var x = this.value;
 			$.ajax({
 				url: "includes/download.php",
 				type: 'post',
 				data:{query:x},
 				success: function( data ) {
 					alert(data);
 				}

 			});
 		});
 		$(".hashtagCount").click(function(){
 			var x = $("#searchValue").val();
 			$.ajax({
			    url: "includes/hashtagCount.php",
			    type: 'post',
			    data: {
			     query: x
			    },
			    success: function( data ) {
			    }
			   });
 		});
		
	});
	function edit(x){
		window.location.href = "delupdate.php?action=edit&uid="+x;
	}
	function deleteimage(x){
		window.location.href = "delupdate.php?action=delete&uid="+x;
	}
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
		    <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Filter
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#account">Account Name</button>
		          	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#date">Date of Upload</button>
		          	<button class="dropdown-item" type="button" data-toggle="modal" data-target="#hashtag">HashTags</button>
		        </div>
		    </li>

		</ul>
		<form class="form-inline search" action="includes/searchResult.php" method="POST">
    		<input class="form-control" type="text" placeholder="Search Images" style="width: 350px; margin-right: 20px;" id="searchValue" name="searchedString" required>
    		<button class="btn btn-success" type="submit" name="submit">Search</button>
  		</form>
	</nav>
		<div class="modal fade" id="account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
				    <div class="modal-header">
				      	<h5 class="modal-title" id="exampleModalLabel">Filter According to UserName</h5>
				    </div>
			      	<div class="modal-body">
			        	<form method="post" action="filter.php">
			        		<label>UserName</label>
			        		<input type="text" name="username" class="form-control">
			        		<button type="submit" name="filterAccount" class="btn btn-primary" style="margin-top: 10px;">Filter</button>
			        	</form>
			      	</div>
		    	</div>
		  	</div>
		</div>


		<div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
				    <div class="modal-header">
				      	<h5 class="modal-title" id="exampleModalLabel">Filter According to Date</h5>
				    </div>
			      	<div class="modal-body">
			        	<form method="post" action="filter.php">
			        		<label>From</label>
			        		<input type="date" name="from" class="form-control" required>
			        		<label>To</label>
			        		<input type="date" name="to" class="form-control" required>
			        		<button type="submit" name="filterDate" class="btn btn-primary" style="margin-top: 10px;">Filter</button>
			        	</form>
			      	</div>
		    	</div>
		  	</div>
		</div>


		<div class="modal fade" id="hashtag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
				    <div class="modal-header">
				      	<h5 class="modal-title" id="exampleModalLabel">Filter According to Hashtag</h5>
				    </div>
			      	<div class="modal-body">
			        	<form method="post" action="filter.php">
			        		<label>Hashtag</label>
			        		<input type="text" name="hashtag" class="form-control">
			        		<button type="submit" name="filterHashtag" class="btn btn-primary" style="margin-top: 10px;">Filter</button>
			        	</form>
			      	</div>
		    	</div>
		  	</div>
		</div>
	<?php 
		 if($edit=='true'){
		 	echo '<p class="alert alert-success" style="width:400px; margin:auto; margin-top:10px;">Edited Successfully</p>';
		 }
		 if($delete=='true'){
		 	echo '<p class="alert alert-success" style="width:400px; margin:auto; margin-top:10px;">Deleted Successfully</p>';
		 }
		?>
	<!-- <div class="card-deck"> -->
	<?php 

		$sql = "SELECT * from uploads where username = '$username' order by uid desc limit $startPageNo,$limit";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
				$location = strpos($row['image'],'/');
	?>
		<div class="card">
		    <img class="card-img-top" src="<?php echo substr($row['image'],$location+1);?>" alt="Card image cap" style="width:309px;">
		    <div class="card-body row">
		      	<div class="col-sm-7">
		      		<h5 class="card-title">Tags</h5>
		      		<p class="card-text"><?php echo $row['tags']?></p>
		    	</div>
		    	<div class="col-sm-5">
		      		<h5 class="card-title">Date</h5>
		      		<p class="card-text"><?php echo $row['uploadDate']?></p>
		    	</div>	
		    </div>
		    <div class="card-footer">
		      	<button class="btn btn-primary" type="submit" name="update" onclick="edit(<?php echo $row['uid'];?>)">Edit</button>
		      	<button class="btn btn-danger" type="submit" name="delete" style="margin-left: 20px;" onclick="deleteimage(<?php echo $row['uid'];?>)">Delete</button>
		      	<a download="<?php echo substr($row['image'],10)?>"; href="<?php echo substr($row['image'],3);?>"><button type="button" class="btn btn-primary" name="download">Download</button></a>
		    </div>
	  	</div>
	<?php
			}
		}
	?>
		<div style="margin-left: 43%;">
			<ul class="pagination text-center" id="add" style="clear: both; ">
				
			</ul>
		</div>
	<!-- </div> -->
</body>

</html>