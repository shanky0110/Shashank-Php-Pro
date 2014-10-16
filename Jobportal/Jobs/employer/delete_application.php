<?php
	include "logincheck.php";
	include_once "../myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

	$sbq_app_chk="select * from sbjbs_applications where sb_id=$sb_id";
//	echo $sbq_resume;
	$sbrow_app_chk=mysql_fetch_array(mysql_query($sbq_app_chk));
	if(!$sbrow_app_chk)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	
	$sbq_job_chk="select * from sbjbs_jobs where sb_id=".$sbrow_app_chk["sb_job_id"]." and sb_uid=".$_SESSION["sbjbs_emp_userid"];
//	echo $sbq_resume;
	$sbrow_job_chk=mysql_fetch_array(mysql_query($sbq_job_chk));
	if(!$sbrow_job_chk)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid access, denied."));
		die();
	}
	$sbq_job="delete from sbjbs_applications where sb_id=$sb_id";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Application request has been removed."));
		die();
	}
	else
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unable to remove application request, please try again."));
		die();
	}
?>