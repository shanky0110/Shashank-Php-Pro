<?
include "logincheck.php";
include_once "myconnect.php";
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?>
<script language="JavaScript">
function attachment(box)
{
	str="fileupload1.php?box="  + box;
	sbwin=window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
	sbwin.focus();
}

function removeattachment(box)
{
window.document.form123.list1.value=""
}


function Validator(form)
{
if(isNaN(form.recperpage.value) || (form.recperpage.value<=0)||(form.recperpage.value==""))
{
alert ('Please specify positive numeric value for records per page!');
form.recperpage.focus();
return false;
}
if(isNaN(form.sb_featured_cnt.value) || (form.sb_featured_cnt.value<0)||(form.sb_featured_cnt.value==""))
{
alert ('Please specify positive numeric value for featured/latest jobs!');
form.sb_featured_cnt.focus();
return false;
}
if(isNaN(form.sb_premium_cnt.value) || (form.sb_premium_cnt.value<0)||(form.sb_premium_cnt.value==""))
{
alert ('Please specify positive numeric value for premium employers!');
form.sb_premium_cnt.focus();
return false;
}
if( form.sb_null_char.value== "" )
{
alert ('Please specify null character!');
form.sb_null_char.focus();
return false;
}
if(isNaN(form.sb_image_size.value) || (form.sb_image_size.value<0)||(form.sb_image_size.value==""))
{
alert ('Please specify positive numeric value for image size!');
form.sb_image_size.focus();
return false;
}

if( form.site_keywords.value== "" )
{
alert ('Please specify site keywords!');
form.site_keywords.focus();
return false;
}

if( form.sitename.value== "" )
{
alert ('Please specify website name!');
form.sitename.focus();
return false;
}
if( form.adminemail.value== "" )
{
alert ('Please specify admin email!');
form.adminemail.focus();
return false;
}

if( form.siteaddrs.value== "" )
{
alert ('Please specify website address!');
form.siteaddrs.focus();
return false;
}

if( form.list1.value== "" )
{
alert ('Please specify Site Logo!');
form.list1.focus();
return false;
}

return true;
}

</script>
<form action="update_general_set.php" method="post" name="form123" id="form123"  onSubmit="return Validator(this);" >
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td><table width="100%" border="0" cellspacing="10" cellpadding="2">
          <tr> 
            <td height="25" colspan="3" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Config 
              Site Parameters</font></strong></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td width="48%" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Records 
                Per Page:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td width="52%"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="recperpage" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_recperpage"];?>" size="7">
              <font size="1"><br>
              This will control the default number of records to be shown on every 
              page.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Featured/Latest Jobs:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_featured_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_featured_cnt"];?>" size="7">
              <font size="1"><br>
              This will control the number of featured/latest jobs to be shown 
              on front page.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Premium Employers:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_premium_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_premium_cnt"];?>" size="7">
              <font size="1"><br>
              This will control the number of rows of premium employers to be 
              shown in the left panel.</font></font></td>
          </tr>
          <!--  <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Latest 
                News:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_latest_news_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_latest_news_cnt"];?>" size="7">
              <font size="1"><br>
              This will control the number of recent commented forums to be shown 
              on front page.</font></font></td>
          </tr>-->
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Null 
                Character:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_null_char" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_null_char"];?>" size="7">
              <font size="1"><br>
              This character(s) will be displayed if some value is not available/missing. 
              </font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Image Size:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_image_size" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_image_size"];?>">
              bytes <font size="1"><br>
              This will control the file size of images to be uploaded.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels"> 
              Sign Up Email Verification:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="sb_signup_verification" id="sb_signup_verification">
                <option value="yes" selected>On</option>
                <option value="no" <?php 
			   if ($rs0["sb_signup_verification"]=="no") echo "selected";?>>Off</option>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              <br>
              This will Enable/Disable Signup Verification.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels"> 
              Category Ordering:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="cat_listing" id="cat_listing">
                <option value="alpha" selected>Alphabetical</option>
                <option value="admin" <?php 
			   if ($rs0["sb_cat_listing"]=="admin") echo "selected";?>>Admin Defined</option>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              <br>
              This will control the order in which categories will be displayed.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Website 
                Keywords:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="site_keywords" type="text" class="box1" id="site_keywords" value="<? echo $rs0["sb_site_keywords"];?>" size="35">
              <font size="1"><br>
              Please provide a list of comma seperated keywords required for search 
              engine optimisation.</font></font></td>
          </tr>
          <!-- <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Private 
              Messaging:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="pvt_messaging">
                <option value="enable">Enable</option>
                <option value="disable" <?php 
			if($rs0["sb_pvt_messaging"]=="disable") echo "selected";?>>Disable</option>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will enable private messaging between members.</font></font></td>
          </tr>-->
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Website 
                Name:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sitename" type="text" class="box1" id="sitename" value="<? echo $rs0["sb_site_name"];?>" size="35">
              <font size="2" face="Arial, Helvetica, sans-serif"> </font><font size="1"><br>
              This will control the text in title bar of the browser.</font> </font></td>
          </tr>
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Admin 
                Email:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="adminemail" type="text" class="box1" id="adminemail" value="<? echo $rs0["sb_admin_email"];?>" size="35"  >
              </font><font size="1"><br>
              Any information regarding the site will be sent on this Email ID</font></font></td>
          </tr>
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Website 
                Address:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="siteaddrs" type="text" class="box1" id="siteaddrs" value="<? echo $rs0["sb_site_root"];?>" size="35">
              <font size="1"> <br>
              This will control the website address. Please enter the value including 
              http://www in the site URL e.g. http://www.yoursite.com</font></font></td>
          </tr>
          <tr valign="top" class="onepxtable"> 
            <td align="right" bgcolor="#F5F5F5" class="innertablestyle"><font size="2" face="Arial, Helvetica, sans-serif" class="normal"><strong>Site 
              Logo: </strong></font></td>
            <td><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
              <input name = "list1" type = "text" id="list1" value="<?php echo $rs0["sb_logo"]; ?>" size="20" readOnly >
              <input type=BUTTON name=btn_name2 value="Upload" onClick=attachment('list1')>
              <input type=BUTTON name=buttonname2 value="Remove" onClick=removeattachment()>
              </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font><font class="normal">&nbsp; 
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5" class="row1">&nbsp;</td>
            <td>&nbsp;</td>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="Submit2" type="submit" class="submit" value="Update">
              </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form><?
}// end main
include "template.php";?>