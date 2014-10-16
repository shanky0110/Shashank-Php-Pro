<?
include_once("logincheck.php");
include_once("myconnect.php");
					   


$id=$_REQUEST["id"];

		if(!get_magic_quotes_gpc())
		{
			$sbtitle=str_replace("$","\$",addslashes($_POST["sbtitle"]));
			$url=str_replace("$","\$",addslashes($_POST["url"]));
			$bannerurl=str_replace("$","\$",addslashes($_POST["bannerurl"]));
		}
		else
		{
			$sbtitle=str_replace("$","\$",$_POST["sbtitle"]);
			$url=str_replace("$","\$",$_POST["url"]);
			$bannerurl=str_replace("$","\$",$_POST["bannerurl"]);
		}
$approved=$_POST["approved"];

$credits=$_POST["credits"];
$displays=$_POST["displays"];

$sql1="update sbjbs_ads set url='$url', sbtitle='$sbtitle', bannerurl='$bannerurl', credits='$credits',displays='$displays',approved='$approved' where id=$id";
mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special.php?id=" . $_REQUEST["id"] . "&sbad_type=top&msg=" .urlencode("Banner has been updated") );
	die();
}
else
{
	header("Location: manage_special.php?id=".$_REQUEST["id"]."&sbad_type=top&msg=" .urlencode("No updation carried") );
	die();
}
?>