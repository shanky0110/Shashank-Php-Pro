<?php
	include "logincheck.php";
	include_once "../myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: gen_confirm.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];
	$sbq_job="delete from sbjbs_companies where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
	$job_list=-1;
	$job_q=mysql_query("select * from sbjbs_jobs where sb_company_id=$sb_id");
	while($job=mysql_fetch_array($job_q))
	{
	$job_list.=",".$job["sb_id"];
	}
	mysql_query("delete from sbjbs_jobs where sb_company_id=$sb_id");
	mysql_query("delete from sbjbs_job_cats where sb_job_id in ($job_list)");
	mysql_query("delete from sbjbs_job_locs where sb_job_id in ($job_list)");
	mysql_query("delete from sbjbs_job_skls where sb_job_id in ($job_list)");
	mysql_query("delete from sbjbs_applications where sb_job_id in ($job_list)");
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("Company has been removed."));
	die();
	}
	else
	{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unable to remove the company, please try again."));
		die();
	}
?>