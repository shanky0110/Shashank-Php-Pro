<?
include_once("logincheck.php");
include_once("myconnect.php");
$sbad_type=$_REQUEST["sbad_type"];
		if(!get_magic_quotes_gpc())
		{
			$sbtitle=str_replace("$","\$",addslashes($_REQUEST["sbtitle"]));
			$sbaff_text=str_replace("$","\$",addslashes($_REQUEST["sbaff_text"]));
		}
		else
		{
			$sbtitle=str_replace("$","\$",$_REQUEST["sbtitle"]);
			$sbaff_text=str_replace("$","\$",$_REQUEST["sbaff_text"]);
		}
$sql1="insert into sbjbs_affiliate_banner (sbaff_title, sbaff_text, sbaff_active) Values('$sbtitle', '$sbaff_text', 'yes')";

mysql_query($sql1 );

if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special_aff.php?sbad_type=$sbad_type&msg=" .urlencode("New Affiliate Ad has been added") );
	die();
}
else
{
	header("Location: manage_special_aff.php?sbad_type=$sbad_type&msg=" .urlencode("Some error occurred, Please try again") );
	die();
}
?>