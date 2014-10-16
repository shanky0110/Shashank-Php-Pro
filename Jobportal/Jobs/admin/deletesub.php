<?
include_once("logincheck.php");
include_once("myconnect.php");

if(!isset($_REQUEST["sbsub_id"]))
	die("Invalid Operation, can't continue");
$sql1="DELETE FROM sbjbs_newsletter where sb_id=".$_REQUEST["sbsub_id"];

mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: managesub.php?msg=" .urlencode("Subscriber has been removed from the list") );
	die();
}
else
{
	header("Location: managesub.php?msg=" .urlencode("Some error occurred, Please try again") );
	die();
}
?>