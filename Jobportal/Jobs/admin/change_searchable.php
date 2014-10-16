<?php
	include "logincheck.php";
	include_once "myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: adminhome.php?errmsg=".urlencode("Invalid Id, cannot proceed!"));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

	$sbq1_job="select * from sbjbs_resumes where sb_id=$sb_id ";
	$sbrow1_job=mysql_fetch_array(mysql_query($sbq1_job));
	if(!$sbrow1_job)	
	{	
		header("Location: adminhome.php?errmsg=".urlencode("Unauthorised Access, denied!"));
		die();
	}
	if($sbrow1_job["sb_search_enable"]=='yes')
	{
		$sb_conf='no';
		$msg='not searchable';
	}
	else
	{
		$sb_conf='yes';
		$msg='seachable';
	}
	$sbq1_job="update sbjbs_resumes set sb_search_enable='no' where sb_id<>$sb_id and sb_seeker_id=".$sbrow1_job["sb_seeker_id"];
	mysql_query($sbq1_job);
	
	$sbq_job="update sbjbs_resumes set sb_search_enable='$sb_conf' where sb_id=$sb_id ";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		header("Location: resumes.php?sb_id=".$sbrow1_job["sb_seeker_id"]."&msg=".urlencode("Resume has been made $msg!"));
		die();
	}
	else
	{
		header("Location: resumes.php?sb_id=".$sbrow1_job["sb_seeker_id"]."&msg=".urlencode("Unable to make resume $msg, please try again!"));
		die();
	}
?>