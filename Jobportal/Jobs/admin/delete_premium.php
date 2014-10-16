<?
include_once "logincheck.php";
include_once "myconnect.php";
$id=$_REQUEST["id"];


mysql_query("delete from sbjbs_premium_gallery where sb_id=$id");

$msg=urlencode("Employer has been removed from premium list");

if(mysql_affected_rows() == 1)
	header("Location:"."premium_mem.php?msg=$msg");
else
	header("Location:"."premium_mem.php?msg=".urlencode("Unable to remove employer from premium list"));

die();
?>