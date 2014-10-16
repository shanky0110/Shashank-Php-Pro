<?php 
include_once"logincheck.php";
include_once"myconnect.php";

if( isset($_REQUEST["loc_id"]) && ($_REQUEST["loc_id"] != 0) )//&& isset($_REQUEST["sbapp"]) )
{		
	$loc_id=$_REQUEST["loc_id"];
	mysql_query("update sbjbs_locations set sb_default=0 where sb_id<>$loc_id");
	mysql_query("update sbjbs_locations set sb_default=1 where sb_id=$loc_id");
	if(mysql_affected_rows() >0)
	{
	header("Location: browselocs.php?msg=".urlencode("Location has been made as default"));
	die();	
	}	
	else	
	{		
	header("Location: browselocs.php?msg=".urlencode("Some error occurred, please try again"));
	die();
	}
}		//end if top most
	//if nothing came
	header("Location: adminhome.php?msg=".urlencode("Invalid operation, denied"));
	die();

?>