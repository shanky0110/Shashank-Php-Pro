<?php 
include_once"logincheck.php";
include_once"myconnect.php";

if( isset($_REQUEST["sb_id"]) && ($_REQUEST["sb_id"] != 0) )//&& isset($_REQUEST["sbapp"]) )
{		
	$sb_id=$_REQUEST["sb_id"];
	
		$sbq_res="select * from sbjbs_cover_letters where sb_id=$sb_id";
		$sbrow_res=mysql_fetch_array(mysql_query($sbq_res));

		if($sbrow_res["sb_approved"] <> 'yes')
		{
			$sbmsg_part="approved";
			$sb_approved='yes';
			$sbfail_msg='approve';
		}
		else
		{
			$sbmsg_part="disapproved";
			$sb_approved='no';
			$sbfail_msg='disapprove';
		}
		$query_ope="update sbjbs_cover_letters set sb_approved='$sb_approved' where sb_id=$sb_id";
		//die($query_ope);
		$rs_ope=mysql_query($query_ope);
		if(mysql_affected_rows() == 1)
		{
			header("Location: cover_letters.php?sb_id=".$sbrow_res["sb_seeker_id"]."&msg=".urlencode("Cover Letter has been $sbmsg_part"));
			die();	
		}	
		else	
		{		
			header("Location: cover_letters.php?sb_id=".$sbrow_res["sb_seeker_id"]."&msg=".urlencode("Unable to $sbfail_msg, please try again"));
			die();
		}
}		//end if top most
	//if nothing came
	header("Location: adminhome.php?msg=".urlencode("Invalid operation, denied"));
	die();

?>