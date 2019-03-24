<?php
	session_start();
	include_once 'dbh.inc.php';
	$upload="false";
	@$upload = $_GET['Upload'];
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
	.searchForm{
		margin-left: 350px;
	}
	img{
		width:200px;
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
		window.location.href="logout.php";
	}
	$(document).ready(function(){
		$( "#searchValue" ).autocomplete({
  			source: function( request, response ) {
			   // Fetch data
			   $.ajax({
			    url: "../search.php",
			    type: 'post',
			    dataType: "json",
			    data: {
			     query: request.term
			    },
			    success: function( data ) {
			     	//alert(typeof data);
			     	//console.log(data);
			     	response( data );
			    }
			   });
			}
			  
 		});
 		
 		$(".downloadCount").click(function(){
 			var x = this.value;
 			$.ajax({
 				url: "download.php",
 				type: 'post',
 				data:{query:x},
 				success: function( data ) {
 				}

 			});
 		});
 		$(".hashtagCount").click(function(){
 			var x = $("#searchValue").val();
 			$.ajax({
			    url: "hashtagCount.php",
			    type: 'post',
			    data: {
			     query: x
			    },
			    success: function( data ) {
			    }
			   });
 		});
	});
</script>
<body>
	<div class="heading">
		<span><img src="../images/logo.jpg" style="width: 30px;">InstaShare</span>
		<div class="menu">
			<button class="btn btn-primary" onclick="logout()">LogOut</button>
		</div>
	</div>
	<nav class="navbar navbar-expand-sm bg-light navbar-light">
		<ul class="navbar-nav">
		    <li class="nav-item">
		      <a class="nav-link" href="../home.php">Home</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="../upload.php">Upload</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="../myuploads.php">My Images</a>
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
	  	<form class="form-inline searchForm" action="searchResult.php" method="POST" >
    		<input class="form-control" type="text" placeholder="Search By Tag or Username" style="width: 350px; margin-right: 20px;" id="searchValue" name="searchedString" required>
    		<button class="btn btn-success hashtagCount" type="submit" name="submit">Search</button>
  		</form>
  		
	</nav>
	<div class="modal fade" id="account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
				    <div class="modal-header">
				      	<h5 class="modal-title" id="exampleModalLabel">Filter According to UserName</h5>
				    </div>
			      	<div class="modal-body">
			        	<form method="post" action="../filter.php">
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
			        	<form method="post" action="../filter.php">
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
			        	<form method="post" action="../filter.php">
			        		<label>Hashtag</label>
			        		<input type="text" name="hashtag" class="form-control">
			        		<button type="submit" name="filterHashtag" class="btn btn-primary" style="margin-top: 10px;">Filter</button>
			        	</form>
			      	</div>
		    	</div>
		  	</div>
		</div>

	<?php 
		if($upload=='true'){
			echo '<p class="alert alert-success" style="width:400px; margin:auto; margin-top:10px;">Uploaded Successfully</p>';
		}
		if(isset($_POST['submit'])){
			$query = $_POST['searchedString'];
			if($query[0]=='#'){
				$sql = "SELECT * from uploads";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
						$tagnameArray = explode(',',$row['tags']);
						for($j=0;$j<sizeof($tagnameArray);$j++){
							if($tagnameArray[$j] == $query){
	?>
								<div class="card">
						    		<img class="card-img-top" src="<?php echo $row['image'];?>" alt="Card image cap" style="width:309px;">
						    		<div class="card-body">
								      	<span><label><b>Username::</b></label><i><?php echo $row['username']?></i></span><br>
								      	<span><label><b>Date::</b></label><i><?php echo $row['uploadDate']?></i></span>
								    </div>
								    <div class="card-footer">
								    	<a download="<?php echo substr($row['image'],10)?>"; href="<?php echo $row['image'];?>"><button type="button" class="btn btn-primary downloadCount" name="download" value="<?php echo $row['image'];?>">Download</button></a>
								    </div>
							  	</div>
	<?php 							
							}
						}
					}
				}								
			}else{
	?>
			<div class="text-center">
				<span><h4><label>UserName::</label><?php echo $query;?></h4></span>
			</div>
	<?php
				$sql = "SELECT * from uploads where username = '$query' ORDER BY uid desc";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
	?>
				<div class="card">
				    <img class="card-img-top" src="<?php echo $row['image'];?>" alt="Card image cap" style="width:309px;">
				    <div class="card-body">
				      <h5 class="card-title">Tags</h5>
				      <p class="card-text"><?php echo $row['tags']?></p>
				    </div>
				    <div class="card-footer">
				    	<a download="<?php echo substr($row['image'],10)?>"; href="<?php echo $row['image'];?>"><button type="button" class="btn btn-primary downloadCount" name="download" value="<?php echo $row['image'];?>">Download</button></a>
				    </div>
			  	</div> 
	<?php
					}
				}
			}
		}
	?>



</body>

</html>