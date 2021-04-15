<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login();
if($_SESSION['mail'] !== "chaichaukhat@gmail.com") {
      $_SESSION["ErrorMessage"]=ucwords(" You can not access.");
      Redirect_to('registration.php');
     } 
?>
<?php  
$explodeItems = null;
$items_A = array();
$items_B = array();
$x = 1;
$items_count = null;
$items_value = null;
// $items_B['0'] = 10;
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
    // $items  = $items . $row['items'];
    $explodeItems = explode(", ", $row['items']);
    $length = sizeof($explodeItems);
    for ($i=0; $i <$length ; $i++) {
    
       $items_count1 = substr($explodeItems[$i], 0,1);
       $items_count2 = substr($explodeItems[$i], 0,2);
       $items_count3 = substr($explodeItems[$i], 0,3);
       if (is_numeric($items_count3)) {
        $items_count = $items_count3;
        $items_value = substr($explodeItems[$i], 3); 
       }elseif(is_numeric($items_count2)) {
        $items_count = $items_count2;
        $items_value = substr($explodeItems[$i], 2); 
       }else{
        $items_count = $items_count1;
        $items_value = substr($explodeItems[$i], 1);
       }
      
        $index = array_search($items_value, $items_B);
       if($index){
        $items_A[$index]+=$items_count;
     }else{
     $items_A[$x] = $items_count;
     $items_B[$x] = $items_value;
     $x++;
    }
     }
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

}


?>






<!DOCTYPE html>
<html>
<head>
	<title>Product Report</title>
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
      echo'<li class="nav-item"> 
              <a class="nav-link" href="total.php">Earning</a>
            </li>';
        echo'<li class="nav-item active"> 
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
   <!-- <div class="row"> -->
      <!-- <div class="col-lg-6"> -->
      			<h1>Product Report Portal</h1>
            <?php echo Message();
       echo SuccesMessage(); 
    ?>
    

      
		<form action="product-report.php" method="POST">
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
	<!-- 
      <h1>Receipt</h1> -->
      <br>
      
      <div class="jumbotron">
        <div class="container">
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

          <table class="table table-responsive-sm table-hover">
            <tr><th>Sold Items</th><th>Number</th></tr>

            <?php 
     function insertionSort(&$arr,&$brr,$n) 
   { 
    for ($i = 2; $i < $n; $i++) 
    { 
        $key = $arr[$i];
        $key1 = $brr[$i]; 
        $j = $i-1;  
        while ($j >= 1 && $arr[$j] < $key) 
        { 
            $arr[$j + 1] = $arr[$j]; 
            $brr[$j + 1] = $brr[$j]; 
            $j = $j - 1; 
        } 
          
        $arr[$j + 1] = $key;
        $brr[$j + 1] = $key1; 
    } 

} 

      $z = sizeof($items_B);
     insertionSort($items_A,$items_B,$z);
     for ($l=1; $l <$z ; $l++) { 
      echo "<tr><td>".ucwords($items_B[$l])."</td><td>".$items_A[$l]."</td></tr>";
      // echo $items_B[$l]."- ".$items_A[$l];
    }

            ?>
          </table>
        </div>
      </div>
 


 
  </div>
</body>
</html>