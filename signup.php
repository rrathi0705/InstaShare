<?php
	$msg="";
	@$msg = $_GET['signup'];
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
	<link rel="stylesheet" type="text/css" href="css/index.css">
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
		margin-top: 50px;
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
	
	.signupPanel{
		margin:auto;
		width: 400px;
		margin-top: 40px;
	}
	input{
		margin-top: 5px;
		margin-bottom: 10px; 
	}
	h2{
		margin-left: 555px;
		margin-top:100px; 
	}
	.msg{
		color: red;
	}
</style>
<script type="text/javascript">
	function loginpage(){
		window.location.href="login.php";
	}
	function signuppage(){
		window.location.href="signup.php";
	}
</script>
<body>
	<div class="heading">
		<span><img src="images/logo.jpg" style="width: 30px;">InstaShare</span>
		<div class="menu">
			<button class="btn btn-primary" onclick="loginpage()">Login</button>
			<button class="btn btn-primary" onclick="signuppage()">SignUp</button>
		</div>
	</div>
	<h2>Get Started Now</h2>
	<div class="signupPanel">
		<form method="POST" action="includes/signup.inc.php">
			<input type="text" name="username" placeholder="Username" class="form-control"><?php  if($msg!=""){
					echo "<span class='msg'>Username not available</span>";
			}?>
			<input type="text" name="fname" placeholder="Firstname" class="form-control">
			<input type="text" name="lname" placeholder="Lastname" class="form-control">
			<input type="email" name="email" placeholder="Email" class="form-control">
			<input type="password" name="password" placeholder="Password" class="form-control">
			<button class="btn btn-primary form-control" name="signup">SignUp for free</button>
		</form>
	</div>
</body>
</html>