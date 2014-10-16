<?php
	include "logincheck.php";
	include_once "myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: adminhome.php?errmsg=".urlencode("Invalid Id, cannot proceed!"));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

$sb_uid=$_REQUEST["sb_uid"];
	$sbq_job="delete from sbjbs_applications where sb_id=$sb_id";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		header("Location: manage_applications.php?sb_uid=$sb_uid&msg=".urlencode("Application request has been removed!"));
		die();
	}
	else
	{
		header("Location: manage_applications.php?sb_uid=$sb_uid&msg=".urlencode("Unable to remove application request, please try again!"));
		die();
	}
?>