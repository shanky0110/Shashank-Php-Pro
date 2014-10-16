<?php
	include "logincheck.php";
	include_once "../myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

	$sbq1_job="select * from sbjbs_jobs where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	$sbrow1_job=mysql_fetch_array(mysql_query($sbq1_job));
	if(!$sbrow1_job)	
	{	
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unauthorised Access, denied."));
		die();
	}
	if($sbrow1_job["sb_show_profile"]=='yes')
	{
		$sb_conf='no';
		$msg='confidential';
	}
	else
	{
		$sb_conf='yes';
		$msg='public';
	}
	
	$sbq_job="update sbjbs_jobs set sb_show_profile='$sb_conf' where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		header("Location: manage_jobs.php?msg=".urlencode("Company profile has been made $msg."));
		die();
	}
	else
	{
		header("Location: manage_jobs.php?msg=".urlencode("Unable to make company profile $msg, please try again."));
		die();
	}
?>