<?
include_once("logincheck.php");
include_once("myconnect.php");
					   
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
		
if($_REQUEST["approved"] == 'yes')
	$sbaff_active="yes";
else
	$sbaff_active="no";
$sql1="update sbjbs_affiliate_banner set sbaff_title='$sbtitle', sbaff_text='$sbaff_text', sbaff_active='$sbaff_active' where sbaff_id=".$_REQUEST["id"];

//die($sql1);
mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special_aff.php?sbad_type=top&msg=" .urlencode("Affiliate Ad has been updated") );
	die();
}
else
{
	header("Location: manage_special_aff.php?sbad_type=top&msg=" .urlencode("No updation carried") );
	die();
}
?>