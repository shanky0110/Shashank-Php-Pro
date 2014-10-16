<?
include "logincheck.php";
include "myconnect.php";

if (!get_magic_quotes_gpc()) {
$currpassword=str_replace('$', '\$',addslashes($_REQUEST["currpassword"]));
}
else
{
$currpassword=str_replace('$', '\$',$_REQUEST["currpassword"]);
}

$rs0=mysql_fetch_array(mysql_query("Select * from sbjbs_admin where sb_id=".$_SESSION["softbiz_jbs_adminid"]. " and sb_pwd='" .$currpassword."'"));
if ($rs0)
{ 
if($rs0["sb_pwd"]===$_REQUEST["currpassword"])
{
$id=$_SESSION["softbiz_jbs_adminid"];
			if (!get_magic_quotes_gpc()) {
			$newpassword=str_replace('$', '\$',addslashes($_REQUEST["newpassword"]));
			}
			else
			{
			$newpassword=str_replace('$', '\$',$_REQUEST["newpassword"]);
			}

mysql_query("Update sbjbs_admin SET sb_pwd='".$newpassword."'  where sb_id=".$_SESSION["softbiz_jbs_adminid"]); 
header("Location:"."adminhome.php?msg=".urlencode("Password has been changed!"));
die();
}
else
{
header("Location:"."changepassword.php?msg=".urlencode("Password COULD NOT be updated because your old password was incorrect"));
die();
}
}
else
{
header("Location:"."changepassword.php?msg=".urlencode("Password COULD NOT be updated because your old password was incorrect"));
die();
}
?>