<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login(); ?>
<?php  
$City = $_SESSION['City'];
  $count = 0;
  $fill = 0;
  $showname = null;
  $rname = null;
  $rmobile = null;
  $rdatetime =  null;
  $ramount = null;
  $rdamount = null;
  $rtotal = null;
if (isset($_POST['submit'])) {

$tableName = $City . "newcustomer";
$tableRegular = $City . "regular";
// start
    $finalitems = null; 
    $Amount = 0;
    $solodItem = null;
    $status = 0;
    $arr_amnt = array();
    $c = 0;
    $sql = "SELECT * FROM menu ORDER BY datetime";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    $name = $row['name'];
    $datetime = $row['datetime'];
    $price = $row['price'];
    $id = $row['id'];
    $oo = "nitems" . $id;
    $nitems = strtolower(mysqli_real_escape_string($con,$_POST[$oo]));
    $count++;
    if ($nitems) {
     $solodItem = $nitems.$name.","." ";
     $finalitems.=$solodItem;
     $arr_amnt[$c] = $price;
     $amnt = $nitems * $price;
     $Amount+=$amnt;
     $status = 1;
     $c = $c + 1;
    }
   } 
//end 
$mode = strtolower(mysqli_real_escape_string($con,$_POST['option']));
$mobile = strtolower(mysqli_real_escape_string($con,$_POST['mobile']));
$damount = strtolower(mysqli_real_escape_string($con,$_POST['damount']));
$datetime = istime();
if (empty($mobile)) {
  $_SESSION["ErrorMessage"]="Enter Mobile Number ! ";

}elseif (!$status) {
$_SESSION["ErrorMessage"]="Enter Items! ";
}
 else{
  if (empty($damount)) {
    $damount = 0;
  }

  // 
 $sql = "SELECT `mobile` FROM `$tableRegular` WHERE `mobile`= '$mobile'";
 $result = mysqli_query($con,$sql);
 $items_10 = null;
 $items_10 = mysqli_num_rows($result);
 $show_times = null;
 if($items_10%10==0&&$items_10>=10){
  
   $damount = round($Amount*0.1);
   $show_times = "Congratulation! you get 10% off.";
   

   $_SESSION["SuccesMessage"] = $items_10."Visit Completed.";
 }
  // 
$sql = "SELECT `mobile`,`name` FROM `$tableName` WHERE `mobile`= '$mobile'";
$result = mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    $rowname = $row['name'];
    // $string = string
    $string = substr(trim($finalitems), 0, -1);
   $sql = "INSERT INTO $tableRegular(mobile,amount,disamount,datetime,items,mode) VALUES('$mobile','$Amount','$damount','$datetime','$string','$mode')";
  $result = mysqli_query($con,$sql);
    if ($result) {
       $rname = $rowname;
       $rmobile = "+91"." x x x x x x x ".substr($mobile, -3);
       $rdatetime =  $datetime;
       $ramount = $Amount;
       $rdamount = $damount;
       $rtotal = $Amount - $damount;
       $fill = 1;
    }else 
    {
      echo mysqli_error($con);
    }

  }else
  {
    $_SESSION['ErrorMessage'] = "Number is not Registered";
  }
//

}

  
}


?>




<!DOCTYPE html>
<html>
<head>
	<title>My Customer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<!-- css files -->

	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/MyStyle.css" type="text/css" media="all" />

    <link rel="stylesheet" href="css/display.css" type="text/css" media="all" />
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Encode+Sans+Condensed:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext,vietnamese"
	    rel="stylesheet">
	      <style type="text/css">

.set
{
    float: left;
    width: 33.33%;
}
.PaymentPortal
{
  position: relative;
  padding-top: 50px;
  padding-right: 610px;
}
@media only screen and (max-width: 768px){
.set
{
    width: 50%;
}
}
  </style>
	<!-- //web-fonts -->
	<!-- script -->
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
function PrintDiv() {    
       var divToPrint = document.getElementById('print_recipt');
       var popupWin = window.open('', '_blank', 'width=250,height=300');
        popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
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
  <!-- modal -->
<?php if ($fill == 1) {
 echo '<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle"></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="print_recipt">'?>
      <div style="text-align:center;height: 50px;"><img style="height="35" width="50" src="images/3.jpg"><p style="font-size: 10px;">K.N.I.T Sultanpur<br>+91700711482</p>
        </div>
        <hr style="margin-top: 10px;">
       <div class="dmodal"  style="margin: auto;margin-top: -5px;>
        <p><?php //echo    //$show_times; ?></p>
        <span class="lmodal">&nbsp;</span><span style="font-size: 10px;"><?php echo ucwords($rname); ?></span>
       </div>
       <div class="dmodal">
        <span class="lmodal">&nbsp;</span><span style="font-size: 10px;"><?php echo $rmobile; ?><hr style="size: 2px;"></span>
       </div>
       <div class="dmodal">
        <span class="lmodal" style="font-size: 12px;">
          <span style="display:inline-block;width: 62%;background-color: #ffffff;">Items</span>
          <span style="text-align: right;">Quantity x Price</span>
        </span><span>
          <?php
      //
        $stritems = null;
       $explodeItems = explode(", ", $string);
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
       $stritems.=$items_count." ".ucwords($items_value).", ";
       
       // echo $items_count .$items_value;
       echo '<div style="font-size: 10px; background-color: #ffffff;" ><span style="display:inline-block;width:78%; background-color: #ffffff;">'
        .ucwords($items_value).
        
       '</span>

       <span style="text-align:right;">'.$items_count." x ".$arr_amnt[$i].'</span>
       </div>';
      // echo '<li style="list-style: none; height:10px; font-size:10px; float:left;">'.ucwords($items_value).'</li>';
       
    } 

      // echo substr(trim($stritems), 0, -1); 
    ?>

      <hr>
    </span>
       </div>

       <div class="dmodal">
        <span class="lmodal" style="font-size: 10px;">Discount : &nbsp; &nbsp;&nbsp;</span><span style="font-size: 10px;"><?php echo $damount; ?></span>
       </div>
       <div class="dmodal">
        <span class="lmodal" style="font-size: 10px;" >Amount : &nbsp; &nbsp;&nbsp;</span><span style="font-size: 10px;"><?php echo $rtotal; ?></span>
       </div>
        <hr>
        <?php
        echo $show_times; 
        ?>
    <div style="text-align: center; font-size: 12px;" class="dmodal">
        Get 10% OFF every 10th visit.
        <br>Thanks for visting.
       </div>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-secondary" value="Print" onclick="PrintDiv();" />
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
<?php } ?>
  <!-- //madal -->

<div class="container">
   <!-- <div class="row">
    <div class="col-md-6"> -->
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
      <li class="nav-item ">
        <a class="nav-link" href="registration.php">Registration<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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
     
    <h1>My Customer</h1>
     <?php echo Message();
       echo SuccesMessage(); 
    ?>
    <form action="oldcustomer.php" method="POST">
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
      <!--  <div class="row"> -->
        <?php
        $sr = 0;
    $showname = null; 
    $amounts = 0;
    $sql = "SELECT * FROM menu ORDER BY datetime";
    $result = mysqli_query($con,$sql);

    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    $name = $row['name'];
    $datetime = $row['datetime'];
    $price = $row['price'];
    $id = $row['id'];
    $sr++;
     ?>
 
       <span class="set">
          <input class="hello" <?php echo "name='nitems$id'"; ?>type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" min="0" onkeypress="return isNumberKey(event)"/>
       <!-- // -->
       
     <?php
    echo '<span class="nitems">';echo strtoupper($name);echo'</span>';
     
        ?>
   </span>
  <?php

}
        ?>
      
      <div class="form-group">
      <label class="PaymentPortal label" for="option">Payment Mode:</label>
      <select class="form-control" id="option" name="option" >
        <option>Cash</option>
        <option>Online</option>
      </select>
      </div>
      <br>
      <div class="form-group">
      <label class="label" for="damount">Discount Amount</label>

            <div class="input-group">
          <span class="input-group-addon"><span class="input-group" id="code">₹</span></span>

             <input class="form-control" name="damount" id="damount" type="text" list="cards"placeholder="Discount Amount" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" min="0" onkeypress="return isNumberKey(event)"/>
    <datalist id="cards">
      <option>5</option>
      <option>10</option>
      <option>15</option>
      <option>20</option>
      <option>25</option>
      <option>30</option>
      <option>50</option>
    </datalist>

           </div>
      </div>
      <br>
        
          <input class="clickmodal btn btn-info form-control bt1" type="submit" name="submit" value="Submit">
    </form>
     
      <div class="Launch">
     <!--  <button type="button" class="btn btn-info bt1" data-toggle="modal" data-target="#exampleModalLong">
        Dash Board
</button> -->
    </div>
  </div>
<script type="text/javascript">
//   $(".clickmodal").focus(function(){
//     $("#exampleModalLong").modal("show");
// });
    $(document).ready(function(){

        $("#exampleModalLong").modal('show');

    });
</script>
</body>
</html>