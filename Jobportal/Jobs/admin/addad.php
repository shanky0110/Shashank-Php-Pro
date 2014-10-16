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
  	alert('Website Title is required!');
	document.form1.sbtitle.focus();
  	return false;
  }
	if ( (document.form1.url.value == "http://")  || (document.form1.url.value == "") )
	 {
      alert('Website Url is required!');
		document.form1.url.focus();   
	   return false;
	   }

        if( (document.form1.bannerurl.value == "http://") || (document.form1.bannerurl.value == "") )
		{
	   alert('Banner url is required.');
	   document.form1.bannerurl.focus();
           return false; 
           }
		   
		   
		   if (document.form1.credits.value==''  || isNaN(document.form1.credits.value) || document.form1.credits.value<=0  )
{
	alert("Please provide some non-negative numeric value  for credits");
	document.form1.credits.focus();
	return (false);
}
if (isNaN(document.form1.displays.value) || document.form1.displays.value<0  )
{
	alert("Please provide some non-negative numeric value for displays");
	document.form1.displays.focus();
	return (false);
}

	return true;
  }
// -->
</SCRIPT>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="11">&nbsp;</td>
          <td width="100%" valign="top"> <form name="form1" method="post" action="insertad.php" onsubmit="return(formValidate());">
              <TABLE width=100% border=0 cellPadding=1 cellSpacing=8 class="onepxtable">
                <TBODY>
                  <TR valign="middle"> 
                    <TD height="25" colspan="3" align=left bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;New 
                      Banner Advertisement</strong></font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Website Title: 
                        </font></strong></div></TD>
                    <TD width="2%" align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%"> 
                      <INPUT name="sbtitle" class="box1" value="" maxLength=120> 
                      <font size="2" face="Arial, Helvetica, sans-serif"> 
                      <input name="sbad_type" type="hidden" id="sbad_type" value="<?php echo $sbad_type; ?>">
                      </font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Website 
                        Url:</font></strong></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT name=url class="box1" value="http://" size=25 
                        maxLength=120></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Banner 
                        Url:</font></strong></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT name=bannerurl class="box1" value="http://" size=35 
                        maxLength=120> <font color="#0057AE" size="2" face="Arial, Helvetica, sans-serif"><br>
                      </font><font size="1" face="Arial, Helvetica, sans-serif">(Banner 
                      must be of 468X60 size)</font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Credits: 
                        </font></strong></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT class="box1" maxLength=120 size=5 name=credits></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Ad 
                        Displays:</font></strong></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<input name=displays class="box1" value="0" size=5 maxlength=120></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></TD>
                    <TD align=left valign="top">&nbsp;</TD>
                    <TD width="60%">
<INPUT type=submit value="Add Now" name=submit> &nbsp; 
                    </TD>
                  </TR>
                </TBODY>
              </TABLE>
            </form></td>
          <td width="13">&nbsp;</td>
        </tr>
        <tr  height="12" > 
          <td height="12" >&nbsp;</td>
          <td height="12"></td>
          <td height="12" >&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?
}//main()
include "template.php";
?>