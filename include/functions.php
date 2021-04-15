<?php require_once("include/DB.php"); ?>
<?php require_once("include/sessions.php"); ?>




<?php
function Redirect_to($New_Location)
 {
 	header("Location:".$New_Location);
 	exit;
 }
// function valid_email($str) {
// 	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
// }

 function valid_email($str) {
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function valid_name($name)
{
	return (!preg_match("/^[a-zA-Z ]*$/",$name))?FALSE :TRUE;
}
//
function Password_Encryption($Password)
{
 $BlowFish_Hash_Format ="$2y$10$";
 $Salt = Generate_Salt(22);
 $Formating_BlowFish_With_Salt = $BlowFish_Hash_Format . $Salt;
 $Hash = crypt($Password,$Formating_BlowFish_With_Salt);
 return $Hash;

}

function Generate_Salt($length)
{
  $Unique_Random = md5(uniqid(mt_rand(),true));
  $Base64_String = base64_encode($Unique_Random);
  $Modified_base64 = str_replace('+', '.',$Base64_String);
  $Salt = substr($Modified_base64,0,$length);
  return $Salt;
}
function Password_Check($Password,$Existing_Hash){
  $Hash = crypt($Password,$Existing_Hash);
if($Hash == $Existing_Hash){
  return true;
  }
   else 
   	{ 
  return false; 
 }
}


//


function istime(){
date_default_timezone_set('Asia/Kolkata');
 $currentTime = time();
 return strftime("%Y-%m-%d %H:%M:%S",$currentTime); 
}

function login_try($email,$password,$conn)
{
 $sql = "SELECT * FROM admins WHERE email = '$email'";
 $result = mysqli_query($conn,$sql);
 if ($result){
 	if ($admin = mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		if (Password_Check($password,$admin['password'])) {
 			return $admin;
 		}else {
 			return null;
 		}
 		
 	}
 }else { mysqli_error($conn);
  }
}

// function login_try($user,$pass,$connection)
// {
//   $sql = "SELECT * FROM admins WHERE `email` = '$user'";
//   $result = mysqli_query($connection,$sql);
//   if ($result) {
//     if ($admin =mysqli_fetch_array($result,MYSQLI_ASSOC)) {
//         if ($admin['email'] == $user && $admin['password'] == $pass) {
//          $_SESSION['userid'] = $admin['id'];

//          $_SESSION["SuccesMessage"] = "Wellcome back ! ".ucfirst($admin['name']);
//           Redirect_to('Admins.php');

//         }else
//         {
//           $_SESSION["ErrorMessage"] ="Username or Password is Not Matched";
//         }
//     }
//     else 
//     {
//       $_SESSION["ErrorMessage"] = "User Name is Not esxits";
//     }
    
//   }else
//   {
//     $_SESSION["ErrorMessage"] =mysqli_error($connection);

//   }


// }
// function margin()
// {
// 	if ($_SESSION["ErrorMessage"] != null || $_SESSION["SuccesMessage"] != null ) {
		
// 		return true;
// 	}el
// }

 function login()
 {
 	if (isset($_SESSION['City'])) {

 		return TRUE;
 	}
 }
 function confirm_login()
 {
 	if (!login()) {
 		$_SESSION["ErrorMessage"] ="Log in Requerd";
 		Redirect_to('login.php');

 	}
 }


 ?>