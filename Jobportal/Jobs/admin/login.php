<?php

include_once "session.php";
include_once "myconnect.php";

if(!isset($_REQUEST['UserName']) || ($_REQUEST['UserName']=="") || !isset($_REQUEST['Password']) || ($_REQUEST['Password']=="") )
{
	header("Location: index.php?msg=".urlencode("Please enter login information!"));
	die();
}

if (!get_magic_quotes_gpc()) 
{
	$username=str_replace('$', '\$',addslashes($_REQUEST["UserName"]));
	$Password=str_replace('$', '\$',addslashes($_REQUEST["Password"]));
}
else
{
	$username=str_replace('$', '\$',$_REQUEST["UserName"]);
	$Password=str_replace('$', '\$',$_REQUEST["Password"]);
}

$sql="SELECT * FROM sbjbs_admin WHERE sb_admin_name='$username' AND sb_pwd='$Password'";
$rs_query=mysql_query($sql);
if ( $rs=mysql_fetch_array($rs_query)  )
{
	if($rs["sb_pwd"]===$_REQUEST['Password'])
	{
		$_SESSION["softbiz_jbs_adminname"]=$rs["sb_admin_name"];
		$_SESSION["softbiz_jbs_adminid"]=$rs["sb_id"];
		header("Location: login_process.php?msg=".urlencode("Welcome ".$rs["sb_admin_name"]));
		die();
	}
}

header("Location: index.php?msg=". urlencode("Please enter correct login information!") );
die();
?>