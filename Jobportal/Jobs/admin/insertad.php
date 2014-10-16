<?php
include_once("logincheck.php");
include_once("myconnect.php");
$sbad_type=$_REQUEST["sbad_type"];
					   
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

$credits=(int)$_POST["credits"];
$displays=(int)$_POST["displays"];
$sql1="insert into sbjbs_ads (sbtitle, url, bannerurl, credits, displays, approved) Values( '$sbtitle', '$url', '$bannerurl', $credits, $displays, 'yes')";
mysql_query($sql1 );
if(mysql_affected_rows() == 1 )
{
	header("Location: manage_special.php?id=".$_REQUEST["id"]."&sbad_type=$sbad_type&msg=" .urlencode("New Banner has been added") );
	die();
}
else
{
	header("Location: manage_special.php?id=".$_REQUEST["id"]."&sbad_type=$sbad_type&msg=" .urlencode("Some error occurred, Please try again") );
	die();
}
?>