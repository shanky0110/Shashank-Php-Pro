<?php
	include "logincheck.php";
	include_once "../myconnect.php";
//	include_once "../date_time_format.php";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

	$sbq_job_chk="select * from `sbjbs_jobs` where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	$sbrow_job_chk=mysql_fetch_array(mysql_query($sbq_job_chk));
	if(!$sbrow_job_chk)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unauthorised access, cannot proceed."));
		die();
	}
	$sb_title=$sbrow_job_chk["sb_title"];
///////------------getting money in account-------/////////
$sbq_tra="select sum(sb_amount) as sb_total_balance from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"];
$sbrow_tra=mysql_fetch_array(mysql_query($sbq_tra));
if(!$sbrow_tra)
{
	$sb_total_balance=0;
}
else
{
	$sb_total_balance=$sbrow_tra["sb_total_balance"];
}
//////////////--------end of getting money---------------////

$sbq_con="select * from sbjbs_config where sb_id=1";
$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
$sb_total_cost=$sbrow_con["sb_featured_fee"];

$sb_fee_currency=$sbrow_con['sb_fee_symbol'];
$sb_fee_currency_name=$sbrow_con['sb_fee_code'];

//$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$sbrow_con['sb_fee_currency'];
//$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
//$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
if( ($sb_total_cost > 0) && ($sb_total_cost > $sb_total_balance) )
{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("You must have atleast $sb_total_cost $sb_fee_currency_name in account to make your job appear as featured, please add some money first."));
	die();
}
	$sb_uid=$_SESSION["sbjbs_emp_userid"];
	$sb_date=date("YmdHis",time());
	
	$sbq_job="update `sbjbs_jobs` set sb_featured='yes' where sb_id=$sb_id and sb_uid=$sb_uid";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
///----------adding transaction
		if( ($sbrow_con["sb_featured_fee"] > 0) )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sb_total_cost.", 'Made your job ''$sb_title'' to appear as Featured', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}

		header("Location: manage_jobs.php?msg=".urlencode("Job has been made featured."));
		die();
	}
	else
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unable to make job featured, please try again."));
		die();
	}

?>