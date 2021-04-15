<?php require_once('include/sessions.php') ?>
<?php require_once('include/functions.php') ?>
<?php
$SESSION['City'] = null;
session_destroy();
Redirect_to('login.php');




?>