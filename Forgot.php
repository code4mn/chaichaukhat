<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php

if (isset($_POST['submit'])) {

$Email = strtolower(mysqli_real_escape_string($con,$_POST['email']));
$sql = "SELECT * FROM admins WHERE `email`= '$Email'";
 $result = mysqli_query($con,$sql);
 if (mysqli_num_rows($result)==1){
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $Token = $row['token'];
   $Name = $row['name'];
   //mail
   $subject = "Reset Password";
   $body = "Hi" . $admin['name'] . "Here is link to reset your password" . " " . 'http://chaichaukhat.in/reset.php?token='.$Token;
  if (mail($Email,$subject,$body)) {
  	$_SESSION["SuccesMessage"] = "Check Mail For Reset Password.";
  	Redirect_to('login.php');
  }
 }else{
 	$_SESSION["ErrorMessage"]="Email is not registerd";
 } 


}






?>




<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Forgot Password</title>
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
		Reset Your Password
	</h1>
	<!-- //title -->

	<!-- content -->
     <?php echo Message();
       echo SuccesMessage();?>
	<div class="container">

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
			<form action="Forgot.php" method="post">
				<div class="form-style-agile">
					<label>
						<i class="fas fa-envelope"></i>
					   Enter Your Email

					</label>
					<input class="color" placeholder="Username" name="email" type="text" required="">
				</div>
				<input type="submit" name="submit" value="Send">
			</form>
		</div>
		<!-- //content form -->
	</div>
	<!-- //content -->

	<!-- copyright -->
	<div class="footer">
		<h2>&copy; 2019 Chay Chaukhat. All rights reserved | Design by
			<a href="">Vidyasagar</a>
		</h2>
	</div>
	<!-- //copyright -->


</body>

</html>