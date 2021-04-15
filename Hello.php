<!DOCTYPE html>
<html>
<body>

<?php
$Password= "1010";
echo crypt(Password_Encryption($Password));
?>

</body>
</html>


<?php 

function Password_Encryption($Password)
{
 $BlowFish_Hash_Format ="$2y$10$";
 $Salt_Length = 22;
 $Salt = Generate_Salt($Salt_Length);
 $Formating_BlowFish_With_Salt = $BlowFish_Hash_Format . $Salt;
 $Hash = crypt($Password,$Formating_BlowFish_With_Salt);
 return $Hash;

}

function Generate_Salt()
{
  $Unique_Random = md5(uniqid(mt_rand(),true));
  $Base64_String = base64_encode($Unique_Random);
  $Modified_base64 = str_replace('+', '.',$Base64_String);
  $Salt = substr($Modified_base64,0,22);
  return $Salt;
}
function Password_Check($Password,$Existing_Hash){
  $Hash = crypt($Password,$Existing_Hash);
if ($Hash === $Existing_Hash) {
  return true;
}else { return false; }
}

















 ?>





















  <?php 
  // if (isset($_POST['submit'])) {
  //  $date = $_POST['date'];
  //  echo $date;
  //}








  ?>
 <!--  <!DOCTYPE html>
  <html>
  <head>
    <title>Date</title>
  </head>
  <body>
  <form action="hello.php" method="POST">
    <input type="date" name="date">
    <input type="submit" name="submit">
  </form>
  </body>
  </html> -->