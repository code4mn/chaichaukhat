<?php 
session_start();

function Message()

{
	if (isset($_SESSION["ErrorMessage"])) {
		$output="<div class=\"alert alert-danger\">";
		$output.=htmlentities($_SESSION["ErrorMessage"]);
		$output.="</div>";
		$_SESSION["ErrorMessage"]=null;
		return $output;
	}
}


function SuccesMessage()

{
	if (isset($_SESSION["SuccesMessage"])) {
		$output="<div class=\"alert alert-success\">";
		$output.=htmlentities($_SESSION["SuccesMessage"]);
		$output.="</div>";
		$_SESSION["SuccesMessage"]=null;
		return $output;
	}
}


 ?>