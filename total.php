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



$amount = 0;
$disamount = 0;
$days = 0;
$eDate = "Y-M-D";
$sDate = "Y-M-D";
if (isset($_POST['submit'])) {
$City = strtolower($_POST['Select_City']);
$tableRegular = $City . "regular";
$sDate = mysqli_real_escape_string($con,$_POST['startDate']);
$eDate = mysqli_real_escape_string($con,$_POST['endDate']);
$datetime = istime();
// Declare two dates 
$start_date = strtotime($sDate); 
$end_date = strtotime($eDate); 
$days = ($end_date - $start_date)/60/60/24;
$days = $days + 1; 


if (empty($sDate)) {
 $_SESSION["ErrorMessage"]="Select Date From Start !";
 $eDate = "Y-M-D";
 $sDate = "Y-M-D";
 $days = 0;
}elseif (empty($eDate)) {
 $_SESSION["ErrorMessage"]="Select Date To End !";
$eDate = "Y-M-D";
 $sDate = "Y-M-D";
 $days = 0;
}elseif ($sDate>$eDate) {
$_SESSION["ErrorMessage"]=ucwords("start date should be before end date");
 $eDate = "Y-M-D";
 $sDate = "Y-M-D";
 $days = 0;
}else
{
  $sql = "SELECT * FROM $tableRegular ORDER BY datetime desc";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $datetime = $row['datetime'];
  $exdate = (explode(" ",$datetime));
  $after = $exdate['0'];
  // 
  $sql = "SELECT * FROM $tableRegular ORDER BY datetime asc";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $datetime = $row['datetime'];
  $exdate = (explode(" ",$datetime));
  $before = $exdate['0'];

  if ($sDate>=$before && $eDate<=$after ) {
     $sql = "SELECT * FROM $tableRegular";
  $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

    $datetime = $row['datetime'];
     $exdate = (explode(" ",$datetime));
     if ($exdate['0']<=$eDate && $exdate['0']>=$sDate ) {
    $amount = $amount + $row['amount'];
    $disamount = $disamount + $row['disamount'];
     }
    

  } 
  }else {
    if(!$before){
      $_SESSION["ErrorMessage"]=ucwords("Data is empty");
    }else
     $_SESSION["ErrorMessage"]=ucwords("only date is valid from ") . $before . " To " .$after;
     $eDate = "Y-M-D";
     $sDate = "Y-M-D";
     $days = 0;
  }




}





// if (empty($mobile)) {
//   $_SESSION["ErrorMessage"]="Enter Mobile Number ! ";

// }elseif (empty($Amount)) {
// $_SESSION["ErrorMessage"]="Enter Amount ! ";
// }
//  else{
//   if (empty($damount)) {
//     $damount = 0;
//   }
// $sql = "SELECT `mobile`,`name` FROM `$tableName` WHERE `mobile`= '$mobile'";
// $result = mysqli_query($con,$sql);
//   if(mysqli_num_rows($result)>0) {
//     $row = mysqli_fetch_assoc($result);
//     $rowname = $row['name'];

//    $sql = "INSERT INTO $tableRegular(mobile,amount,disamount,datetime) VALUES('$mobile','$Amount','$damount','$datetime')";

//   $result = mysqli_query($con,$sql);
//     if ($result) {
//        $_SESSION['ErrorMessage'] = $rowname;
//        $rname = $rowname;
//        $rmobile = "+91".$mobile;
//        $rdatetime =  $datetime;
//        $ramount = $Amount;
//        $rdamount = $damount;
//        $rtotal = $Amount - $damount;
//     }else 
//     {
//       echo mysqli_error($con);
//     }

//   }else
//   {
//     $_SESSION['ErrorMessage'] = "Number is not registored";
//   }
// //

// }

  
}


?>
















<!DOCTYPE html>
<html>
<head>
	<title>Earing Calculation</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<!-- css files -->

	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/MyStyle.css" type="text/css" media="all" />
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web-fonts -->
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- // -->
</head>
<body>
	<!-- modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle">Dash Board</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="dmodal">
       	<a class="lmodal" href="Registration.php">New Registration</a>
       </div>
       <div class="dmodal">
       	<a class="lmodal" href="OldCustomer.php">Regular Customer</a>
       </div> 
       <div class="dmodal">
       	<a class="lmodal" href="LogOut.php">Log Out</a>
       </div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	<!-- //madal -->
	<!--  -->
	<div class="container">
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
      <li class="nav-item">
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
      echo'<li class="nav-item active"> 
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
   <div class="row">
      <div class="col-lg-6">
      			<h1>Total Earning Portal</h1>
            <?php echo Message();
       echo SuccesMessage(); 
    ?>
    

      
		<form action="total.php" method="POST">
      <div class="form-group">
      <label class="label" for="Select_City">Select City</label>
      <select class="form-control" id="Select_City" name="Select_City">
        <?php
     $sql = "SELECT * FROM admins ORDER BY datetime";
    $result = mysqli_query($con,$sql);
    if ($result) {
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    ?>
    <option><?php echo ucwords($row['city']); ?></option>

  <?php }
    ?>
    <?php
  }else{
    echo mysqli_erorr($con,$result);
  }
    
        ?>
      </select>

      </div>
			<div class="form-group">
			<label class="label" for="startdate">Start Date :</label>
			<input class="form-control" type="Date" id="startdate" name="startDate" placeholder="Start Date">
			</div>
			<br>
			
			<div class="form-group">
			<label class="label" for="endDate">End Date :</label>
			<input class="form-control" type="Date" id="endDate" name="endDate" placeholder="End Date">
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

     <div class="col-lg-6">
      <h1>Receipt</h1>
      <br>
      <div class="jumbotron">
                  <ul class="ul">
                    <li class="listhead">Start Date</li>
                    <li class="listitem"><?php echo $sDate; ?></li>
                  </ul>
                  <br>
                  <ul class="ul">
                    <li class="listhead">End Date</li>
                    <li class="listitem"><?php echo $eDate; ?></li>
                  </ul>
                  <br>
                  <ul class="ul">
                    <li class="listhead">Days</li>
                    <li class="listitem"><?php echo $days; ?></li>
                  </ul>

                  <br>
                  <ul class="ul">
                    <li class="listhead">Amount</li>
                    <li class="listitem"><?php echo $amount; ?></li>
                  </ul>
                  <br>
                  <ul class="ul">
                    <li class="listhead">Discount Amount</li>
                    <li class="listitem"><?php echo "₹". '&nbsp;'. $disamount; ?></li>
                  </ul>
                  <br>
                  <ul class="ul">
                    <li class="listhead">Total Amount</li>
                    <li class="listitem"><?php echo "₹". '&nbsp;'.($amount-$disamount); ?></li>
                  </ul>

      </div>
      
     </div>

     </div>
  </div>
</body>
</html>