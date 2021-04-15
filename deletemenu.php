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
$id = $_GET['id'];
 $sql = "SELECT * FROM menu WHERE `id`='$id'";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

    $name = $row['name'];
    $datetime = $row['datetime'];
    $price = $row['price'];
    } 


if(isset($_POST["Submit"])) 
{
 
 $sql = "DELETE FROM menu WHERE `id` = '$id'";
 $result = mysqli_query($con,$sql);

 if ($result) {
  
  
  $_SESSION["SuccesMessage"] = "Item Deleted Succesfully.";
  Redirect_to('addmenu.php');



 } else
 {
  $_SESSION["ErrorMessage"] = "Something went to worng.".mysqli_erorr($con,$result);
  Redirect_to('addmenu.php'); 
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    
  </script>
	<!-- // -->
</head>
<body>
<div class="container">
     
    <h1>Delete Item</h1>
    <?php echo Message();
       echo SuccesMessage(); 
    ?>
  
   <div class="jumbotron">
     <table class="table table-hover table-responsive-sm">
          <tr class="text-info"><th>Name</th><th>Price</th><th>Date & Time</th></tr>
           <tr><td><?php echo $name; ?></td><td><?php echo $price; ?></td><td><?php echo $datetime ?></td></tr>
         </table>
   
         <form method="post">
          <fieldset>
            
          <input class="form-control btn btn-danger" type="Submit" name="Submit" value="Delete Item">
          
          </fieldset>
          <br>
         </form>
         </div>

</body>
</html>