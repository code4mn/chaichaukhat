<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if (isset($_SESSION['City'])) {
 	Redirect_to('registration.php');
 	exit;
 } 
elseif (isset($_POST['submit'])){
$Email = strtolower(mysqli_real_escape_string($con,$_POST['email']));
$Password = mysqli_real_escape_string($con,$_POST['Password']);
// login_try($Email,$Password,$con);
$find_account = login_try($Email,$Password,$con);

if ($find_account) {
   $_SESSION['userid'] = $find_account['id']; 
   $_SESSION['mail'] = $find_account['email'];
   $_SESSION['City'] = $find_account['city']; 

	Redirect_to('registration.php');
}else{
	$_SESSION['ErrorMessage'] = "Email / Password is invalid";
}


}







?>








<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Login To Admin</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->

	<!-- css files -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web-fonts -->
	<style>
.container {
    position: relative;
}
	</style>
</head>

<body>
	<!-- title -->
	<h1>
		Welcome To Chai Chaukhat
	</h1>
	<?php //if ((Message() !=null) || (SuccesMessage() !=null)) { ?>
	 <div class="">
	 	
	 </div>

	<?php //} ?>

	
	
	<!-- //title -->
	<div class="container">
		<div class="n1 col-sm-4 offset-4">
		<?php echo Message();
	 	echo SuccesMessage(); ?>
	 </div>
		<div id="clouds">
			<div class="cloud x1"></div>
			<!-- Time for multiple clouds to dance around -->
			<div class="cloud x2"></div>
			<div class="cloud x3"></div>
			<div class="cloud x4"></div>
			<div class="cloud x5"></div>
		</div>
		<!-- content form -->
		<div class="sub-main-w3">
			<form action="login.php" method="POST">
				<div class="form-style-agile">
					<label>
						<i class="fas fa-user"></i>
						Username

					</label>
					<input class="color" placeholder="Username" name="email" type="text" required="">
				</div>
				<div class="form-style-agile">
					<label>
						<i class="fas fa-unlock-alt"></i>
						Password

					</label>
					<input class="color" placeholder="Password" name="Password" type="password" required="">
				</div>
				<input type="submit" name="submit" value="Log In">
      				<div class="form-style-agile">
					<label>
						<a style="color: #fff;" href="Forgot.php">Reset Your Password ?</a>
					</label>
				</div> 
			</form>
		</div>

		<!-- //content form -->
	</div>
	<!-- //content -->
     <!-- <div class="linkforgot"><a style="color: #fff;" href="signup.php">Want to  Signup ?</a></div> -->
	<!-- copyright -->
	<div class="footer">
		<h2>&copy;<?php echo date("Y")."chaichaukhat.in"; ?>. All rights reserved | Design by
			<a href="https://www.instagram.com/v1dya5agar/">Vidyasagar</a>
		</h2>
	</div>
	<!-- //copyright -->


</body>

</html>