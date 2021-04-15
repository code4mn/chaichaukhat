<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login();

if($_SESSION['mail'] !== "chaichaukhat@gmail.com") {
      $_SESSION["ErrorMessage"]=ucwords(" You can not signup");
      Redirect_to('registration.php');
     }
 ?>

<?php 
if (isset($_POST['submit'])) {
$Username = strtolower(mysqli_real_escape_string($con,$_POST['Name']));
$Email = strtolower(mysqli_real_escape_string($con,$_POST['email']));
$City = strtolower(mysqli_real_escape_string($con,$_POST['City']));
$Password = mysqli_real_escape_string($con,$_POST['Password']);
$confirmpassword = mysqli_real_escape_string($con,$_POST['confirmpassword']);
date_default_timezone_set('Asia/Kolkata');
 $currentTime = time();
 $datetime = strftime("%Y-%m-%d %H:%M:%S",$currentTime); 
if (valid_email($Email)) {
 if(strlen($Password)<4){
 	$_SESSION['ErrorMessage'] = "Password lenth is at least 4";
 }
elseif ($Password == $confirmpassword) {

    $sql = "SELECT `email` FROM `admins` WHERE `email`= '$Email'";
    $result = mysqli_query($con,$sql);
    $sql1 = "SELECT `city` FROM `admins` WHERE `city`= '$City'";
    $result1 = mysqli_query($con,$sql1);


     if (mysqli_num_rows($result)==1) 
     {
     $_SESSION["ErrorMessage"]="Email Already Registered Login Now ! ";
     }elseif (mysqli_num_rows($result1)==1) {
        $_SESSION["ErrorMessage"]=" This City Already Registered !";
     }
     elseif($_SESSION['mail'] !== "chaichaukhat@gmail.com") {
      $_SESSION["ErrorMessage"]=ucwords(" You can not signup");
     }
     else
     {
     $Token = bin2hex(openssl_random_pseudo_bytes(40));
      $Hash_Password = Password_Encryption($Password);
     $sql = "INSERT INTO admins(name,email,city,password,token,datetime) VALUES('$Username','$Email','$City','$Hash_Password','$Token','$datetime')";
   $result = mysqli_query($con,$sql);
   // 
   $tablename = $City . "newcustomer";
   $sqlcreatenew = "CREATE TABLE $tablename (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
mobile VARCHAR(50) NOT NULL,
email VARCHAR(50),
datetime VARCHAR(50) NOT NULL)";
 $resultcreate = mysqli_query($con,$sqlcreatenew);
 // 
 $tablename = $City . "regular";
 $sql = "CREATE TABLE $tablename (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
mobile VARCHAR(50) NOT NULL,
amount VARCHAR(50) NOT NULL,
disamount VARCHAR(50) NOT NULL DEFAULT 0,
items VARCHAR(500) NOT NULL,
mode VARCHAR(50) NOT NULL,
datetime VARCHAR(50) NOT NULL)";
 $resultregular = mysqli_query($con,$sql);
   // 
   if ($result && $resultcreate && $resultregular) {
   	$_SESSION["SuccesMessage"] = "Registration Succesfull ! Log in Now";
     Redirect_to('login.php');

   }else{
   echo "Error: " . $sql . "<br>" . mysqli_error($con);
   }	
     }
    


} 
 else{
 	$_SESSION['ErrorMessage'] = "Password is not Matched";
 }
  
}else{
$_SESSION['ErrorMessage'] = "Please Enter Valid Email";
   Redirect_to('signup.php');
}

}

?>




<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Sign Up</title>
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
	<?php
  if (isset($_POST['submit'])) {
  	
  	echo "<style>

  .container {
    position: relative;
}
  }

  	</style>";
  }



	  ?>
</head>

<body>
	<!-- //title -->

	<!-- content -->


	<div class=" container-fluid">
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
			
			<form action="signup.php" method="post">
				<div class="form-style-agile">
					<label>
						<i class="fas fa-user"></i>
						Name

					</label>
					<input class="color" placeholder="Name" name="Name" type="text" required="">
				</div>
					<div class="form-style-agile">
					<label>
						<i class="fa fa-envelope"></i>
						Email

					</label>
					<input class="color" placeholder="Email" name="email" type="text" required="">
				</div>
				<div class="form-style-agile">
					<label>
						<i class="fa fa-building"></i>
						City

					</label>
					<input class="color" placeholder="City" name="City" type="text" required="">
				</div>
				<div class="form-style-agile">
					<label>
						<i class="fas fa-unlock-alt"></i>
						Password

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
				<input type="submit" name="submit" value="Sign Up">
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