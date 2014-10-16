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
			$sb_name=str_replace('$', '\$',addslashes($_REQUEST["sb_name"]));
			}
			else
			{
			$sb_name=str_replace('$', '\$',$_REQUEST["sb_name"]);
			}
		$errcnt=0;
		if(strlen(trim($_POST["sb_name"]))==0)
		{
			$errmsg[$errcnt]="Please specify Industry.";
			$errcnt++;
		}
		else
		{
			$rst=mysql_fetch_array(mysql_query("select * from sbjbs_industries where
			sb_name='$sb_name' and sb_id<>".$_POST["id"]));
			if($rst)
			{
				$errmsg[$errcnt]="Industry already exists.";
				$errcnt++;
			}
		}

if($errcnt==0)
{

    mysql_query("update sbjbs_industries set sb_name='$sb_name' 
	where sb_id=".$_POST["id"]);
	if(mysql_affected_rows()>0)
	{
	header("Location: "."manage_industry.php?msg=".urlencode("Industry has been updated."));
	die();
	}
	else
	{
	header("Location: "."manage_industry.php?id=".$_POST["id"]."&msg=".urlencode("Some error occurred. Please try again."));
	die();
	}
}
}
/////////////////////

function main()
{
global $errcnt,$errmsg;
$id=$_REQUEST["id"];
$cur=mysql_fetch_array(mysql_query("select * from sbjbs_industries where sb_id=$id"));

$sb_name=$cur["sb_name"];


?>
<script language="JavaScript1.1">
function Validator()
{

if ( frm1.sb_name.value=='' )
{
	alert("Please specify Industry");
	document.frm1.sb_name.focus();
	return (false);
}
return (true);
}

</script>
<?
if(count($_POST)>0)
{
$sb_name=$_POST["sb_name"];
 
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
    <td valign="top"> <div align="center"> 
        <table width="100%" border="0" cellspacing="10" cellpadding="2">
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frm1" id="frm1"  
		  onSubmit="return Validator();" >
            <tr align="left" class="row1"> 
              <td height="25" colspan="3" bgcolor="#004080"><font size="3" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF" size="2"><strong>&nbsp;Edit 
                Industry</strong></font></font></td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                  <input name="id" type="hidden" id="id" value="<? echo $id;?>">
                  Industry:</strong></font></div></td>
              <TD align=left valign="top" class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
              <td width="60%"> <input name="sb_name" type="text" class="box" id="sb_name" value="<? echo $sb_name;?>"> 
              </td>
            </tr>
            <tr class="row1"> 
              <td width="40%" align="right" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
              <td width="6">&nbsp;</td>
              <td width="60%"> <input name="Submit" type="submit" class="submit" value="Update"></td>
            </tr>
          </form>
        </table>
      </div></td>
  </tr>
  <tr> 
    <td align="left" valign="top"> <div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;</strong></font></div></td>
  </tr>
</table>
<?
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