<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php 
if (isset($_GET['token'])) {
	$TokenUrl = $_GET['token'];
if (isset($_POST['submit'])) {
	$Password = mysqli_real_escape_string($con,$_POST['Password']);
    $confirmpassword = mysqli_real_escape_string($con,$_POST['confirmpassword']);
   if (strlen($Password)<4) {
   $_SESSION['ErrorMessage'] = "Password lenth is at least 4";
   }elseif ($Password !== $confirmpassword) {
   $_SESSION['ErrorMessage'] = "Password is not matched";
   }else{
   	$TokenUrl = $_GET['token'];
   	 $sql = "SELECT `email` FROM `admins` WHERE `token`= '$TokenUrl'";
     $result = mysqli_query($con,$sql);
     if ($result) {
     	if (mysqli_num_rows($result)==1){
     		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $Email = $row['email'];
       	   $Token = bin2hex(openssl_random_pseudo_bytes(40));
           $Hash_Password = Password_Encryption($Password);
          $sql  = "UPDATE admins SET password = '$Hash_Password', token='$Token' WHERE email='$Email'";
          $result = mysqli_query($con,$sql);
          if ($result) {
          	$_SESSION["SuccesMessage"] = "Reset Password Succesfull.";
     	Redirect_to('login.php');
          } else{
         echo mysqli_error($con);
          }
     	}else{
     		$_SESSION["ErrorMessage"] = ucwords("invalid your link try again.");
     	}
     }else{
         echo mysqli_error($con);
     }
   }
}
}else
{
$_SESSION['ErrorMessage'] =ucwords("invalid your link try again.");	
}
?>




<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Reset Password</title>
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
	
  <style>

  .container {
    position: relative;
    top: -90px;
}
  

  	</style>";
  
</head>

<body>
	<!-- //title -->

	<!-- content -->


	<div class=" container-fluid">
		<h1>Reset Password</h1>
		<div class="row">

   <div class="mes col-sm-4 offset-sm-4">
   	<?php echo Message();
       echo SuccesMessage(); 
   	?>
   </div>			
		</div>
	</div>
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
			<form action="reset.php?token=<?php echo $TokenUrl;?>" method="post">
				<div class="form-style-agile">
					<label>
						<i class="fas fa-unlock-alt"></i>
						New Password

					</label>
					<input class="color" placeholder="Password" name="Password" type="password" required="">
				</div>
				<div class="form-style-agile">
					<label>
						<i class="fas fa-unlock-alt"></i>
					 confirm Password

					</label>
					<input class="color" placeholder="Confirm Password" name="confirmpassword" type="password" required="">
				</div>
				<input type="submit" name="submit" value="Reset Password">
			</form>
		</div>
		<!-- //content form -->
	</div>
	<!-- //content -->

	<!-- copyright -->
<!-- 	<div class="footer">
		<h2>&copy; 2019 Chay Chaukhat. All rights reserved | Design by
			<a href="">Vidyasagar</a>
		</h2>
	</div> -->
	<!-- //copyright -->


</body>

</html>