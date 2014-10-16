<?
include_once("logincheck.php");
include_once("myconnect.php");

$sql1="DELETE FROM sbjbs_affiliate_banner where sbaff_id=".$_REQUEST["id"];

mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special_aff.php?sbad_type=top&msg=" .urlencode("Affiliate Ad has been Deleted") );
	die();
}
else
{
	header("Location: manage_special_aff.php?sbad_type=top&msg=" .urlencode("Some error occurred, Please try again") );
	die();
}
?>