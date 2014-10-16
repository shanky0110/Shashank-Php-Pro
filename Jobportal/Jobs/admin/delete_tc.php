<?
include_once "logincheck.php";
include_once "myconnect.php";
$id=$_REQUEST["id"];
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_transactions where sb_id=$id"));
$uid=$rst["sb_uid"];
mysql_query("delete from sbjbs_transactions where sb_id=$id");

header("Location:"."view_transactions.php?sb_id=$uid&msg=".urlencode("Transaction has been removed."));
die();
?>