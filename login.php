<?php 

	$msg = 'false';
	$valid='true';
	@$msg = $_GET['RegisteredSuccessfully'];
	@$valid = $_GET['login'];
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
	
	.loginPanel{
		margin:auto;
		width: 300px;
		margin-top: 40px;
	}
	input{
		margin-top: 5px;
		margin-bottom: 10px; 
	}
	h2{
		margin-left: 555px;
		margin-top:150px; 
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
	<?php

		if($msg=='true'){
			echo '<p class="alert alert-success" style="width:400px; margin:auto; margin-top:10px;">Please Verify Your Email</p>';
		}

	?>
	<h2>Get Started Again</h2>
	<div class="loginPanel">
		<form method="POST" action="includes/login.inc.php">
			<input type="text" name="username" placeholder="Username" class="form-control">
			<input type="password" name="password" placeholder="Password" class="form-control">
			<button class="btn btn-primary form-control" name="login">LogIn to Continue</button>
			<?php

				if($valid=='false'){
					echo '<p class="alert alert-danger" style="width:300px; margin:auto; margin-top:10px;">Invalid Username/Password</p>';
				}

			?>
		</form>
	</div>
</body>
</html>