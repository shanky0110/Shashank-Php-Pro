<?
include_once("logincheck.php");
include_once("myconnect.php");

$sql1="DELETE FROM sbjbs_ads  where id=" . $_REQUEST["id"];

mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special.php?sbad_type=top&msg=" .urlencode("Banner has been Removed") );
	die();
}
else
{
	header("Location: manage_special.php?sbad_type=top&msg=" .urlencode("Some error occurred, Please try again") );
	die();
}
?>