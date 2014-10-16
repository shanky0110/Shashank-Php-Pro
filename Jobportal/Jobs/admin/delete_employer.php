<?
include_once "logincheck.php";
include_once "myconnect.php";


	if(!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"]) || ($_REQUEST["id"] < 1))
	{
		header("Location: adminhome.php?msg=".urlencode("Invalid Id, cannot proceed!"));
		die();
	}

	$id=$_REQUEST["id"];
//	$sb_id=$_REQUEST["sb_id"];
	$sbq_com="select * from sbjbs_companies where sb_uid=$id";
	$sbrs_com=mysql_query($sbq_com);
	$sbcomp_list='-1';
	while($sbrow_com=mysql_fetch_array($sbrs_com))
		$sbcomp_list.=','.$sbrow_com["sb_id"];

	$sbq_job="delete from sbjbs_employers where sb_id=$id";
	mysql_query($sbq_job);
	if(mysql_affected_rows() == 1)
	{
		$sbq_job="delete from sbjbs_companies where sb_id in ($sbcomp_list)";
		mysql_query($sbq_job);

		$job_list=-1;
		$job_q=mysql_query("select * from sbjbs_jobs where sb_company_id in ($sbcomp_list)");
		while($job=mysql_fetch_array($job_q))
		{
			$job_list.=",".$job["sb_id"];
		}
		mysql_query("delete from sbjbs_jobs where sb_id in ($job_list)");
		mysql_query("delete from sbjbs_job_cats where sb_job_id in ($job_list)");
		mysql_query("delete from sbjbs_job_locs where sb_job_id in ($job_list)");
		mysql_query("delete from sbjbs_job_skls where sb_job_id in ($job_list)");
		
		mysql_query("delete from sbjbs_applications where sb_job_id in ($job_list)");
		
		mysql_query("delete from sbjbs_premium_gallery where sb_emp_id=$id");
		
		header("Location: employers.php?msg=".urlencode("Employer has been removed."));
		die();
	}
	else
	{
		header("Location: employers.php?msg=".urlencode("Unable to remove the employer, please try again."));
		die();
	}
?>