<?
include "logincheck.php";
include_once "myconnect.php";


	if (!get_magic_quotes_gpc()) 
	{
		$sb_how_to_sell=str_replace('$', '\$',addslashes($_REQUEST["sb_how_to_sell"]));
		$sb_how_to_buy=str_replace('$', '\$',addslashes($_REQUEST["sb_how_to_buy"]));
		$sb_legal=str_replace('$', '\$',addslashes($_REQUEST["sb_legal"]));
		$sb_welcome_msg=str_replace('$', '\$',addslashes($_REQUEST["sb_welcome_msg"]));
	}
	else
	{
		$sb_how_to_sell=str_replace('$', '\$',$_REQUEST["sb_how_to_sell"]);
		$sb_how_to_buy=str_replace('$', '\$',$_REQUEST["sb_how_to_buy"]);
		$sb_legal=str_replace('$', '\$',$_REQUEST["sb_legal"]);
		$sb_welcome_msg=str_replace('$', '\$',$_REQUEST["sb_welcome_msg"]);
	}
$sql="update sbjbs_policies set
			sb_terms='$sb_how_to_sell',
			sb_privacy='$sb_how_to_buy',
			sb_welcome_msg='$sb_welcome_msg',
			sb_legal='$sb_legal'
		where sb_id=1";
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_policies.php?msg=".urlencode("Policies Text have been updated"));
	die();
}
else
{
	header("Location:"."settings_policies.php?msg=".urlencode("Unable to update policies, please try again"));
	die();
}
?>