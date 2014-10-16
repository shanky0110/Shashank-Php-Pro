<?php
include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
$sql="select * from sbjbs_ads  where id=" . $_REQUEST["id"] ;
$rs0_query=mysql_query ($sql);
$rs0=mysql_fetch_array($rs0_query);
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
	if ( (document.form1.url.value == "http://")  || (document.form1.url.value == ""))
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
	alert("Please provide some non-negative numeric value  for displays");
	document.form1.displays.focus();
	return (false);
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
<form name="form1" method="post" action="updatead.php" onsubmit="return(formValidate());">
              <TABLE width=100% border=0 cellPadding=1 cellSpacing=8 class="onepxtable">
                <TBODY>
                  <TR valign="middle"> 
                    <TD height="25" colspan="3" align=left bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Edit 
                      Banner</strong></font> <font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong> 
                      Advertisement</strong></font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="24" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><B>Website 
                        Title:</B></font></div></TD>
                    <TD width="3%" align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%"> 
                      <INPUT name="sbtitle" class="box1" value="<? echo $rs0["sbtitle"];?>" 
                        maxLength=120>
                    </TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><B>Website 
                        Url: </B></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT name=url class="box1" value="<? echo $rs0["url"];?>" size=35 
                        maxLength=120></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><B>Banner 
                        Url: </B></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT name=bannerurl class="box1" value="<? echo $rs0["bannerurl"];?>" size=35 
                        maxLength=120> <font color="#333333" size="2" face="Arial, Helvetica, sans-serif"><br>
                      </font><font size="2" face="Arial, Helvetica, sans-serif"><font size="1">(Banner 
                      must be of 468X60 size)</font></font></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><b><font size="2" face="Arial, Helvetica, sans-serif">C</font></b><font size="2" face="Arial, Helvetica, sans-serif"><B>redits:</B></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<INPUT name=credits class="box1" value="<? echo $rs0["credits"];?>" size=5 
                        maxLength=120></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Ad 
                        Displays:</strong></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<input name=displays class="box1" value="<? echo $rs0["displays"];?>" size=5 
                        maxlength=120> <input type="hidden" name="id" value="<? echo $_REQUEST["id"]; ?>"></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Approved:</strong></font></div></TD>
                    <TD align=left valign="top"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                    <TD width="60%">
<select name="approved">
                        <option value="yes">yes</option>
                        <option value="no"
						<? 
			if ($rs0["approved"]!="yes")
			{
			  echo " selected ";
			}
			?>

			
			>no</option>
                      </select></TD>
                  </TR>
                  <TR> 
                    <TD width="40%" height="25" align=left valign="top" bgcolor="#F5F5F5"> 
                      <div align="center"> 
                        &nbsp; </div></TD>
                    <TD height="25" align=left valign="top">&nbsp;</TD>
                    <TD width="60%" height="25" align=left valign="top">
<input type=submit value="Update Now" name=submit></TD>
                  </TR>
                </TBODY>
              </TABLE>
            </form></td>
          <td width="13">&nbsp;</td>
        </tr>
        <tr  height="12" > 
          <td height="12">&nbsp;</td>
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