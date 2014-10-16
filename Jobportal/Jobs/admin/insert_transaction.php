<?
include_once "logincheck.php";
include_once "myconnect.php";
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));

$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];

			if (!get_magic_quotes_gpc()) {
			$amount=str_replace('$', '\$',addslashes($_REQUEST["amount"]));
			$description=str_replace('$', '\$',addslashes($_REQUEST["comments"]));
			$username=str_replace('$', '\$',addslashes($_REQUEST["username"]));
			}
			else
			{
			$amount=str_replace('$', '\$',$_REQUEST["amount"]);
			$description=str_replace('$', '\$',$_REQUEST["comments"]);
			$username=str_replace('$', '\$',$_REQUEST["username"]);
			}
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_username='$username'"));
if($rst)
{
	$id=$rst["sb_id"];
	mysql_query("insert into sbjbs_transactions (sb_uid,sb_amount,sb_description,sb_date_submitted) 
	values ($id,$amount,'$description','".date("Ymdhis",time())."')");
	$msg="Successfully added $sb_fee_currency ".$amount." to member account"; 
	if($amount<0)
	{
	$msg="Successfully deducted $sb_fee_currency ".((-1)*$amount)." from member account"; 
	}
}
else
{
	$msg="No Employer found with such username";
	header("Location:"."add_transaction.php?msg=".urlencode($msg));
	die();
}
header("Location:"."view_transactions.php?sb_id=$id&msg=".urlencode($msg));
die();
?>