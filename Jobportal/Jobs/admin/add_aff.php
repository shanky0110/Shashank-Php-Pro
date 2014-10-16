<?
include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
$sbad_type=$_REQUEST["sbad_type"];
?>
<SCRIPT language=javascript> 
<!--
  function formValidate() {
  if(document.form1.sbtitle.value == "" )
  {
  	alert('Title is required for identification');
	document.form1.sbtitle.focus();
  	return false;
  }
	if ( (document.form1.sbaff_text.value == "") )
	 {
      alert('Affiliate Text is required!');
		document.form1.sbaff_text.focus();   
	   return false;
	   }
	return true;
  }
// -->
</SCRIPT>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr> 
    <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="11">&nbsp;</td>
          <td width="100%" valign="top">
<form name="form1" method="post" action="insertaff.php" onsubmit="return(formValidate());">
              <TABLE width=100% border=0 cellPadding=1 cellSpacing=8 class="onepxtable">
                <TBODY>
                  <TR valign="middle"> 
                    <TD height="25" colspan="3" align=left bgcolor="#004080"> 
                      <div align="right"></div>
                      <font color="#000000"> <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;New 
                      Affiliate Advertisement</font></strong></font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Title: 
                        </font></strong></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD> <font size="2" face="Arial, Helvetica, sans-serif"> 
                      <input name="sbtitle" type="text" id="sbtitle" maxlength="120">
                      <input name="sbad_type" type="hidden" id="sbad_type" value="<?php echo $sbad_type; ?>">
                      </font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<strong>Affiliate 
                        Text:</strong></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD><font size="2" face="Arial, Helvetica, sans-serif"> 
                      <textarea name="sbaff_text" cols="50" rows="4" id="sbaff_text"></textarea>
                      <font size="1">(Advertisement must be of 468X60 size) </font></font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font> 
                        &nbsp; </div></TD>
                    <TD align=left valign="top">&nbsp;</TD>
                    <TD height="25" align=left valign="top"><input type=submit value="Add Now" name=submit></TD>
                  </TR>
                  </TBODY>
              </TABLE>
            </form></td>
          <td width="13">&nbsp;</td>
        </tr>
        <tr  height="12" > 
          <td height="12" >&nbsp;</td>
          <td height="12"></td>
          <td height="12">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?
}//main()
include "template.php";
?>