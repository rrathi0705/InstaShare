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
	.msg p{
		font-size: 30px;
		font-family: 'Lobster';
		margin:10px;
	}
	span{
		font-size: 20px;
		font-family: 'Pacifico';
		margin-left: 40px;
	}
	.loginPanel{
		float: right;
		margin-right: 0px;
		width: 300px;
		position: relative;
		top: -50px;
	}
	input{
		margin-top: 5px;
		margin-bottom: 5px; 
	}
	.body{
		background-color: #eee;
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
	<div class="container">
		<div class="body jumbotron">
			<img src="images/Lighthouse.jpg" style="width: 100%;height: 320px;">
			<div class="msg"><p>WelCome to the World of Images Sharing</p></div>
			<span>InstaShare Provides:
			Images Uploading,Deleting,Editing,Searching</span>
			<div class="loginPanel">
				<form method="POST" action="includes/login.inc.php">
					<input type="text" name="username" placeholder="Username" class="form-control">
					<input type="password" name="password" placeholder="Password" class="form-control">
					<button class="btn btn-primary form-control" name="login">LogIn to Continue</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>