<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login(); ?>
<?php

if (isset($_POST['submit'])) {

$name = strtolower(mysqli_real_escape_string($con,$_POST['name']));
$price = mysqli_real_escape_string($con,$_POST['price']);

if (empty($name) || empty($price)) {
  $_SESSION['ErrorMessage'] = "Item Name or Price is Missing";
}else{
  date_default_timezone_set('Asia/Kolkata');
 $currentTime = time();
 $datetime = strftime("%Y-%m-%d %H:%M:%S",$currentTime);
 $sql = "SELECT `name` FROM menu WHERE `name`='$name'";
 $result = mysqli_query($con,$sql);
 if ($result) {
    if(mysqli_num_rows($result)==1)
 {
  $_SESSION['ErrorMessage'] = "This Item is Alrady exsit.";
 }
 else{
  $sql = "INSERT INTO menu(name,price,datetime) VALUES('$name','$price','$datetime')";
 $result = mysqli_query($con,$sql);
 if($result){
  $_SESSION["SuccesMessage"] = "item added succesfully.";
 }else{
  echo mysqli_error($con);
 }
}
 }else{
  echo mysqli_error($con);
 }
 }
 

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Menu</title>
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
	<!-- //web-fonts -->
	<!-- script -->
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
      <li class="nav-item active">
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
     
    <h1>Add Menu</h1>
    <?php echo Message();
       echo SuccesMessage(); 
    ?>
    <form action="addmenu.php" method="POST">
      <div class="form-group">
      <label class="label" for="Name">Item Name :</label>
      <input class="form-control" type="name" id="Name" name="name" placeholder="Item Name">
      </div>
      <br>
      <div class="form-group">
      <label class="label" for="price">Price :</label>

            <div class="input-group">
          <span class="input-group-addon"><span class="input-group" id="code">₹</span></span>

             <input class="form-control" name="price" id="price" type="text" placeholder="Price" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" min="0" onkeypress="return isNumberKey(event)"/>
           </div>
      </div>
      <br>
        
    <input class="btn btn-info form-control bt1" type="submit" name="submit" value="Add MenuItem">
    </form>
    <br>
     <h2 class="menu_list"> Menu List </h2>
    

     <div class="jumbotron">
       <div class="container">
    

         <table class="table table-responsive-sm table-hover">
          <tr><th>Sr.N</th><th>Name</th><th>Price</th><th>Date & Time</th><th>Delete Buttons</th></tr>
    <?php 
    $srN = 0;
    $sql = "SELECT * FROM menu ORDER BY datetime";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

    $name = $row['name'];
    $datetime = $row['datetime'];
    $price = $row['price'];
    $id = $row['id'];

    $srN++;
      ?>
      <tr><td><?php echo $srN ?></td><td><?php echo ucwords($name); ?></td><td><?php echo $price ?></td><td><?php echo $datetime ?></td><td>
        <?php
       if($_SESSION['mail'] !== "chaichaukhat@gmail.com"){
        $href = "addmenu.php";
        $id = null;
       }else{$href = "deletemenu.php";}
        ?>
       <a href="<?php echo $href.'?id='. $id ?>"><span <?php 
     //
       if($_SESSION['mail'] !== "chaichaukhat@gmail.com") {
      echo 'style="cursor: no-drop;" class="btn btn-danger disabled"';
     }else{
      echo 'class="btn btn-danger"';
     }
      //

       ?> >Delete</span></a></td></tr>

   <?php } ?>
         </table>
         </div>
        

       
        </div>
  </div>

</body>
</html>