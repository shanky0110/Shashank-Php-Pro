<?php 
include_once"logincheck.php";
include_once"myconnect.php";

if( isset($_REQUEST["sb_id"]) && ($_REQUEST["sb_id"] != 0) )//&& isset($_REQUEST["sbapp"]) )
{		
	$sb_id=$_REQUEST["sb_id"];
	
		$sbq_res="select * from sbjbs_employers where sb_id=$sb_id";
		$sbrow_res=mysql_fetch_array(mysql_query($sbq_res));
		if($sbrow_res["sb_search_allowed"] == 'no')
		{
///////redirecting to ask for duration if expired
		$sbq_res1="select * from sbjbs_employers where sb_id=$sb_id and (TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) <= 0 or ISNULL(TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) ) )";
//		echo $sbq_res1;
		$sbrow_res1=mysql_fetch_array(mysql_query($sbq_res1));
		if($sbrow_res1)
		{
			header("Location: search_duration.php?sb_id=$sb_id");
			die();	
		}
			$sbmsg_part="allowed";
			$sb_approved='yes';
			$sbfail_msg='allow';
		}
		else
		{
			$sbmsg_part="prohibited";
			$sb_approved='no';
			$sbfail_msg='prohibit';
		}
	$query_ope="update sbjbs_employers set sb_search_allowed='$sb_approved' where sb_id=$sb_id";
	//	die($query_ope);
		$rs_ope=mysql_query($query_ope);
		if(mysql_affected_rows() == 1)
		{
			header("Location: employers.php?msg=".urlencode("Search has been $sbmsg_part"));
			die();	
		}	
		else	
		{		
			header("Location: employers.php?msg=".urlencode("Unable to $sbfail_msg search, please try again"));
			die();
		}
}		//end if top most
	//if nothing came
	header("Location: adminhome.php?msg=".urlencode("Invalid operation, denied"));
	die();

?>