<?php

include "../session.php";  

if (!isset($_SESSION["sbjbs_emp_userid"]))
{
	$errmsg="You must be logged to access this page.";
	$sb_id=0;
	$sb_type=0;
	
	if(isset($_REQUEST["sb_id"]))
		$sb_id=$_REQUEST["sb_id"];
	
	if(isset($_REQUEST["sb_type"]))
		$sb_type=$_REQUEST["sb_type"];
	
	$return_add=$_SERVER['PHP_SELF'];
	
	header("Location: signin_emp.php?id=$sb_id&return_add=$return_add&sb_type=$sb_type&errmsg=" .urlencode($errmsg) );
	die();
}
?>