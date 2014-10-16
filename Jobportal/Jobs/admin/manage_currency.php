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
			$sbcur_symbol=str_replace('$', '\$',addslashes($_REQUEST["sbcur_symbol"]));
			$sbcur_name=str_replace('$', '\$',addslashes($_REQUEST["sbcur_name"]));
			}
			else
			{
			$sbcur_symbol=str_replace('$', '\$',$_REQUEST["sbcur_symbol"]);
			$sbcur_name=str_replace('$', '\$',$_REQUEST["sbcur_name"]);
			}
		$errcnt=0;
		if(strlen(trim($_POST["sbcur_symbol"]))==0)
		{
			$errmsg[$errcnt]="Please specify Currency Symbol.";
			$errcnt++;
		}
		if(strlen(trim($_POST["sbcur_name"]))==0)
		{
			$errmsg[$errcnt]="Please specify Currency Code.";
			$errcnt++;
		}
		else
		{
			$rst=mysql_fetch_array(mysql_query("select * from sbjbs_currencies where
			sbcur_name='$sbcur_name'"));
			if($rst)
			{
				$errmsg[$errcnt]="Currency with the same code already exists.";
				$errcnt++;
			}
		}

if($errcnt==0)
{
   mysql_query("insert into sbjbs_currencies (sbcur_symbol,sbcur_name) values ('$sbcur_symbol','$sbcur_name')");
	if(mysql_affected_rows()>0)
	{
	header("Location: "."manage_currency.php?msg=".urlencode("Currency has been added."));
	die();
	}
	else
	{
	header("Location: "."manage_currency.php?msg=".urlencode("Some error occurred, please try again."));
	die();
	}
}
}
/////////////////////

function main()
{
global $errcnt,$errmsg;
$sbcur_symbol="";
$sbcur_name="";

//////////////////////////////////
////////////////////////////////
?>
<script language="JavaScript1.1">
function Validator()
{

if ( frm1.sbcur_symbol.value=='' )
{
	alert("Please specify Currency Symbol");
	document.frm1.sbcur_symbol.focus();
	return (false);
}
if ( frm1.sbcur_name.value=='' )
{
	alert("Please specify Currency Code");
	document.frm1.sbcur_name.focus();
	return (false);
}
return (true);
}

</script>
<?
if(count($_POST)>0)
{
$sbcur_symbol=$_POST["sbcur_symbol"];
$sbcur_name=$_POST["sbcur_name"];	

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
          <form action="manage_currency.php" method="post" name="frm1" id="frm1"  onSubmit="return Validator();" >
            <tr align="left" class="row1"> 
              <td height="25" colspan="3" bgcolor="#004080"><font size="3" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF" size="2"><strong>&nbsp;Add 
                Currency</strong></font></font></td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Currency 
                  Symbol:</strong></font></div></td>
              <TD align=left valign="top" class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
              <td width="60%"> <input name="sbcur_symbol" type="text" class="box" id="sbcur_symbol" value="<? echo $sbcur_symbol;?>"> 
              </td>
            </tr>
            <tr valign="top" class="row1"> 
              <td align="right" bgcolor="#F5F5F5"><font face="Verdana, Arial, Helvetica, sans-serif"><strong><font size="2" face="Arial, Helvetica, sans-serif">Currency 
                Code:</font></strong></font></td>
              <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
              <td><input name="sbcur_name" type="text" class="box" id="sbcur_name" value="<? echo $sbcur_name;?>"></td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
              <td width="6">&nbsp;</td>
              <td width="60%"> <input name="Submit" type="submit" class="submit" value="Add New"></td>
            </tr>
            <tr align="left" class="row1"> 
              <td colspan="3" valign="top" bgcolor="#F5F5F5"><font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">Once 
                you add a currency symbol, members will be able to add their listings 
                in that currency.</font></td>
            </tr>
          </form>
        </table>
      </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="2">
        <tr> 
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Currencies 
            </strong></font></td>
        </tr>
        <?
			  $loc_query=mysql_query("select * from sbjbs_currencies order by sbcur_id desc");
					  while($loc=mysql_fetch_array($loc_query))
					  {
                      ?>
        <tr> 
          <td width="50%" valign="top"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
            <? 
		  echo $loc["sbcur_name"]."&nbsp;(".$loc["sbcur_symbol"].")";?>
            </font></td>
          <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;[&nbsp;<a href="edit_currency.php?id=<? echo $loc["sbcur_id"];?>" ><font size="1" face="Arial, Helvetica, sans-serif">Edit</font></a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_currency.php?id=<? echo $loc["sbcur_id"];?>" onClick="javascript: return confirm('Do you really want to remove the currency?');">Delete</a>&nbsp;]&nbsp;</font></td>
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