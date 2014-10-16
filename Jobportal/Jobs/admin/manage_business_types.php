<?
include "logincheck.php";
include "myconnect.php";
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////

/////////add new code
if(count($_POST)>0)
{
			if (!get_magic_quotes_gpc()) {
			$sb_businesstype=str_replace('$', '\$',addslashes($_REQUEST["sb_businesstype"]));
			}
			else
			{
			$sb_businesstype=str_replace('$', '\$',$_REQUEST["sb_businesstype"]);
			}
		$errcnt=0;
		if(strlen(trim($_POST["sb_businesstype"]))==0)
		{
			$errmsg[$errcnt]="Please specify Business Type.";
			$errcnt++;
		}
		else
		{
			$rst=mysql_fetch_array(mysql_query("select * from sbjbs_businesstypes where
			sb_businesstype='$sb_businesstype'"));
			if($rst)
			{
				$errmsg[$errcnt]="Business Type already exists.";
				$errcnt++;
			}
		}
if($errcnt==0)
{
    mysql_query("insert into sbjbs_businesstypes (sb_businesstype) values ('$sb_businesstype')");
	if(mysql_affected_rows()>0)
	{
	header("Location: "."manage_business_types.php?msg=".urlencode("Business Type has been added."));
	die();
	}
	else
	{
	header("Location: "."manage_business_types.php?msg=".urlencode("Some error occurred, please try again."));
	die();
	}
}
}
/////////////////////

function main()
{
global $errcnt,$errmsg;
$sb_businesstype="";

//////////////////////////////////
////////////////////////////////
?>
<script language="JavaScript1.1">
function Validator()
{

if ( frm1.sb_businesstype.value=='' )
{
	alert("Please specify Business Type");
	document.frm1.sb_businesstype.focus();
	return (false);
}
return (true);
}

</script>
<?
if(count($_POST)>0)
{
$sb_businesstype=$_POST["sb_businesstype"];

if($errcnt<>0)
	{
	?>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
  <tr> 
    <td colspan="2"><strong>&nbsp;Your request cannot be processed due to following 
      reasons</strong></td>
  </tr>
  <tr height="10"> 
    <td colspan="2"></td>
  </tr>
  <?

for ($i=0;$i<$errcnt;$i++)
{
?>
  <tr valign="top"> 
    <td width="6%">&nbsp;<?php echo $i+1;?></td>
    <td width="94%"><?php echo  $errmsg[$i]; ?></td>
  </tr>
  <?
}
?>
</table>
<?
	}
	}		

?>
<table width="90%" height="20" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="2" valign="top"> <div align="center"> 
        <table width="100%" border="0" cellspacing="10" cellpadding="2">
          <form action="<? echo $_SERVER['PHP_SELF'];?>" method="post" name="frm1" id="frm1"  
		  onSubmit="return Validator();" >
            <tr align="left" class="row1"> 
              <td height="25" colspan="3" bgcolor="#004080"><font size="3" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF" size="2"><strong>&nbsp;Add 
                Business Type</strong></font></font></td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Business Type:</strong></font></div></td>
              <TD align=left valign="top" class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
              <td width="60%"> <input name="sb_businesstype" type="text" class="box" id="sb_businesstype" value="<? echo $sb_businesstype;?>"> 
              </td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
              <td width="6">&nbsp;</td>
              <td width="60%"> <input name="Submit" type="submit" class="submit" value="Add New"></td>
            </tr>
          </form>
        </table>
      </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="2">
        <tr> 
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Business 
            Types </strong></font></td>
        </tr>
        <?
			  $loc_query=mysql_query("select * from sbjbs_businesstypes order by sb_businesstype");
			  while($loc=mysql_fetch_array($loc_query))
			  {
              ?><tr> 
          <td width="50%" valign="top"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
            <? 
		  echo $loc["sb_businesstype"];?>
            </font></td>
          <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;[&nbsp;<a href="edit_business_type.php?id=<? echo $loc["sb_id"];?>" ><font size="1" face="Arial, Helvetica, sans-serif">Edit</font></a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_business_type.php?id=<? echo $loc["sb_id"];?>" onClick="javascript: return confirm('Do you really want to remove the business type?');">Delete</a>&nbsp;]&nbsp;</font></td>
        </tr>
        <?
					  }
                    ?>
      </table>
		</td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top"> <div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;</strong></font></div></td>
  </tr>
</table><?

}//end main
include "template.php";
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////


?>