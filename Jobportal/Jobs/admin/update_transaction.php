<?
include_once "logincheck.php";
include_once "myconnect.php";
$id=$_REQUEST["id"];

			if (!get_magic_quotes_gpc()) {
			$amount=str_replace('$', '\$',addslashes($_REQUEST["amount"]));
			$description=str_replace('$', '\$',addslashes($_REQUEST["comments"]));
			}
			else
			{
			$amount=str_replace('$', '\$',$_REQUEST["amount"]);
			$description=str_replace('$', '\$',addslashes($_REQUEST["comments"]));
			}
mysql_query("update sbjbs_transactions set 
sb_amount=$amount,sb_description='$description' where sb_id=$id");
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_transactions where sb_id=$id"));
$id=$rst["sb_uid"];
header("Location:"."view_transactions.php?sb_id=$id&msg=".urlencode("Successfully updated a transaction."));
die();
?>