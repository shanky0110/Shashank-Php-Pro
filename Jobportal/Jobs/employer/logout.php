<?php
// if session exists, unregister all variables that exist and destroy session
include_once("../myconnect.php");
session_start();

mysql_query( "DELETE FROM sbjbs_emp_online WHERE sb_uid=".$_SESSION["sbjbs_emp_userid"]) ;

session_unregister("sbjbs_emp_username");
session_unregister("sbjbs_emp_userid");
//session_unregister("sbjbs_memtype");
/*
if(isset($_SESSION["offer_count"]))
{
	for($id=1;$id<$_SESSION["offer_count"];$id++)
	{
		if(isset($_SESSION["buy_offer_".$id]))
		{
		session_unregister("buy_offer_".$id);
		}
		elseif(isset($_SESSION["sell_offer_".$id]))
		{
		session_unregister("sell_offer_".$id);
		}
		elseif(isset($_SESSION["catalog_offer_".$id]))
		{
		session_unregister("catalog_offer_".$id);
		}
	}
}
session_unregister("offer_count");
*/
header("Location: ". "gen_confirm.php?errmsg=" . urlencode("You have been successfully logged out.") );
die();
?>