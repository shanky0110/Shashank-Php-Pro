<?
include_once "logincheck.php";
include_once "myconnect.php";
include_once "date_time_format.php";
include_once "styles.php";
//=============================================================
function loc_order($pid)
{
	$rs_query=mysql_query("select * from sbjbs_locations where sb_pid=$pid order by sb_loc_name");
	while($rst=mysql_fetch_array($rs_query))
	{
	  $cat_path="";
	  $cat_path.=$rst["sb_loc_name"];
 	  $par=mysql_query("select * from sbjbs_locations where sb_id=".$rst["sb_pid"]);
	  while($parent=mysql_fetch_array($par))
	  {
		$cat_path=$parent["sb_loc_name"]."-".$cat_path;
		$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
	  }
      echo "<option value='".$rst["sb_id"]."' >$cat_path</option>";
	  $child=mysql_fetch_array(mysql_query("select * from sbjbs_locations where 
	  sb_pid=".$rst["sb_id"]));
	  if($child)
	  {
		loc_order($child["sb_pid"]);
	  }
	}
}
//=============================================================



$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo $config["sb_site_name"];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="#660033" alink="#660033" link="#660033">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><div align="center"> 
        <table width="100%" border="0" cellpadding="4" cellspacing="4" bgcolor="#F3FAFF" class="maintablestyle1">
          <tr> 
            <td valign="bottom"><div align="center"><img src="../images/logo.gif" width="227" height="73"> 
                <font size="2" face="Arial, Helvetica, sans-serif">Admin Panel</font></div></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr> 
    <td valign="top"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr align="center" valign="middle"> 
          <td>&nbsp;</td>
          <td >&nbsp; 
            <?
if ( isset($_REQUEST["msg"])&&$_REQUEST['msg']<>"")
{
?>
            <font face="verdana, arial" size="1" color="#666666"> 
            <?
print($_REQUEST['msg']); 

?>
            </font> 
            <?
}//end if
?>
          </td>
        </tr>
        <tr valign="top"> 
          <td width="155"> <? include_once ("left_panel.php");?> </td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="7">
              <tr> 
                <td align="left" valign="top"> 
                  <? main();?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td colspan="2"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1">Powered 
              by Softbiz 
              Scripts</font></font> </div></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
