<?php
	include "logincheck.php";
	include_once "myconnect.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: cover_letters.php?errmsg=".urlencode("Invalid Id, cannot proceed!"));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

//--getting seeker_id
	$sb_seeker_id=0;
	$sbq_job1="select * from sbjbs_cover_letters where sb_id=$sb_id ";
	$sbrow_job1=mysql_fetch_array(mysql_query($sbq_job1));
	if($sbrow_job1)
		$sb_seeker_id=$sbrow_job1["sb_seeker_id"];
	$sbq_job="delete from sbjbs_cover_letters where sb_id=$sb_id ";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		header("Location: cover_letters.php?sb_id=$sb_seeker_id&msg=".urlencode("Cover letter has been removed!"));
		die();
	}
	else
	{
		header("Location: cover_letters.php?sb_id=$sb_seeker_id&msg=".urlencode("Unable to remove cover letter, please try again!"));
		die();
	}
?>