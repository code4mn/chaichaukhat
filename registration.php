<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login(); ?>
<?php  


if (isset($_POST['submit'])) {

$tableName = $_SESSION['City'] . "newcustomer";
$name = strtolower(mysqli_real_escape_string($con,$_POST['name']));
$mobile = strtolower(mysqli_real_escape_string($con,$_POST['mobile']));
$Email = strtolower(mysqli_real_escape_string($con,$_POST['email']));
$datetime = istime();
if (empty($name)) {
	$_SESSION["ErrorMessage"]="Enter Name";

}elseif (empty($mobile)) {
	$_SESSION["ErrorMessage"]="Enter Mobile Number ! ";
}else{
      $sql = "SELECT mobile FROM $tableName WHERE mobile = '$mobile'";
	  $result = mysqli_query($con,$sql);
      if ($result) {
       $rowcount=mysqli_num_rows($result);
       if ($rowcount>0) {
        $_SESSION["ErrorMessage"]=" Number is Registered";
     }else{ 
          $sql = "INSERT INTO $tableName(name,mobile,email,datetime) VALUES('$name','$mobile','$Email','$datetime')";
          $result = mysqli_query($con,$sql);
          if ($result) {
          	$_SESSION["SuccesMessage"] = "Registration Succesfull !";
            Redirect_to('oldcustomer.php');
          }else { echo mysqli_error($con); }
      }

      }else { echo mysqli_error($con);

      }

}


	
}


?>





<!DOCTYPE html>
<html>
<head>
	<title>Registration New customer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<!-- css files -->

	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
			<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web-fonts -->
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/MyStyle.css" type="text/css" media="all" />
	<script>
		
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
	</script>
	<!-- // -->
</head>
<body>
	<!--  -->
  
	<!--  -->

	<div class="container">
		<!--  -->
    <nav class="navbar navbar-expand-lg bgnav">
  <a class="navbar-brand" href="#">chaiChaukhat</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    	<span id="menui1" class="menuicon"></span>
    	<span id="menui2" class="menuicon"></span>
    	<span id="menui3" class="menuicon"></span>
    </span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="registration.php">Registration<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="oldcustomer.php">MyCustomer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addmenu.php">Menu</a>
      </li>
      <?php
       if($_SESSION['mail'] == "chaichaukhat@gmail.com"){
      echo'<li class="nav-item"> 
              <a class="nav-link" href="total.php">Earning</a>
            </li>';
          echo'<li class="nav-item"> 
              <a class="nav-link" href="product-report.php">SoldItems</a>
            </li>';
            echo'<li class="nav-item"> 
              <a class="nav-link" href="signup.php">AddAccount</a>
            </li>';


        }
        ?>
        
    </ul>
    <ul class="nav navbar-nav navbar-right">
    	<li id="log" class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<!-- <nav class="navigation">
	<div class="navbar-toggler-icon">
		
	<div class="menuicon"></div>
	<div class="menuicon"></div>
	<div class="menuicon"></div>
	</div>
</nav> -->
		<!-- // -->
		<h1>Register To New Customer</h1>
		<?php echo Message(); 
		echo SuccesMessage();?>
		<form action="registration.php" method="POST">
			<div class="form-group">
			<label class="label" for="Name">Name :</label>
			<input class="form-control" type="name" id="Name" name="name" placeholder="Name">
			</div>
			<br>
			<div class="form-group">
			<label class="label" for="mobile">Mobile Number :</label>

            <div class="input-group">
          <span class="input-group-addon"><span class="input-group" id="code">+91</span></span>

             <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Mobile Number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" min="0" onkeypress="return isNumberKey(event)"/>
           </div>
			</div>
			<br>
			<div class="form-group">
			<label class="label" for="Email">Email :</label>
			<input class="form-control" type="Email" id="Email" name="email" placeholder="Email">
		    </div>
		    <br>
		    
		    	<input class="btn btn-info form-control bt1" type="submit" name="submit" value="Submit">
		</form>
		<!-- <div class="Launch">
			<button type="button" class="btn btn-info bt1" data-toggle="modal" data-target="#exampleModalLong">
        Dash Board
</button>
		</div> -->
	</div>

</body>
</html>