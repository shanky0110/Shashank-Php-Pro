<?
include "logincheck.php";
include_once "myconnect.php";

			$sb_premium_fee=(real)$_REQUEST["sb_premium_fee"];
			$sb_job_fee=(real)$_REQUEST["sb_job_fee"];
			$sb_job_fee_additional=(real)$_REQUEST["sb_job_fee_additional"];
			$sb_front_featured_fee=(real)$_REQUEST["sb_front_featured_fee"];
			$sb_bold_fee=(real)$_REQUEST["sb_bold_fee"];
			$sb_highlight_fee=(real)$_REQUEST["sb_highlight_fee"];
			$sb_featured_fee=(real)$_REQUEST["sb_featured_fee"];
	

		if (!get_magic_quotes_gpc()) 
		{
			$sb_paypal_id=str_replace('$', '\$',addslashes($_REQUEST["sb_paypal_id"]));
			$sb_fee_symbol=str_replace('$', '\$',addslashes($_REQUEST["sb_fee_symbol"]));
			$sb_fee_code=str_replace('$', '\$',addslashes($_REQUEST["sb_fee_code"]));
		}
		else
		{
			$sb_paypal_id=str_replace('$', '\$',$_REQUEST["sb_paypal_id"]);
			$sb_fee_symbol=str_replace('$', '\$',$_REQUEST["sb_fee_symbol"]);
			$sb_fee_code=str_replace('$', '\$',$_REQUEST["sb_fee_code"]);
		}
$sql="update sbjbs_config set
			sb_paypal_id='$sb_paypal_id',
			sb_premium_fee=$sb_premium_fee,
			sb_job_fee=$sb_job_fee,
			sb_job_fee_additional=$sb_job_fee_additional,
			sb_bold_fee=$sb_bold_fee,
			sb_highlight_fee=$sb_highlight_fee,
			sb_featured_fee=$sb_featured_fee,
			sb_front_featured_fee=$sb_front_featured_fee,
			sb_fee_symbol='$sb_fee_symbol',
			sb_fee_code='$sb_fee_code'
		where sb_id=1";
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_fees.php?msg=".urlencode("Billing Fees have been updated"));
	die();
}
else
{
	header("Location:"."settings_fees.php?msg=".urlencode("Unable to update billing fees, please try again"));
	die();
}
?>