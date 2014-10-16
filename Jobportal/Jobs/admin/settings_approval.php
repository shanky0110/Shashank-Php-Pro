<?
include "logincheck.php";
include_once "myconnect.php";
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?>
<script language="JavaScript">
function Validator(form)
{
/*if(isNaN(form.th_width.value) || (form.th_width.value<=0)||(form.th_width.value==""))
{
alert ('Enter a non negative numeric value for thumbnail width!');
form.th_width.focus();
return false;
}
if(isNaN(form.th_width2.value) || (form.th_width2.value<=0)||(form.th_width2.value==""))
{
alert ('Enter a non negative numeric value for thumbnail width2!');
form.th_width2.focus();
return false;
}*/
	return true;
}

</script>
<form action="update_approval_set.php" method="post" name="frm1" id="frm1"  onSubmit="return Validator(this);" >
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td valign="top">
<table width="100%" border="0" cellspacing="10" cellpadding="2">
          <tr> 
            <td height="25" colspan="3" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Config 
              Approval Parameters</font></strong></td>
          </tr>
          <!--tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Thumbnail 
              Width:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font size="1" face="Arial, Helvetica, sans-serif"> 
              <input name="th_width" type="text" class="box1" id="th_width" value="<? echo $rs0["sb_th_width"];?>" size=" 7">
              pixels<br>
              This will control the width of thumbnails. </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Thumbnail 
              Width 2:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font size="1" face="Arial, Helvetica, sans-serif"> 
              <input name="th_width2" type="text" class="box1" id="th_width2" value="<? echo $rs0["sb_th_width2"];?>" size=" 7">
              pixels<br>
              This will control the width of thumbnails. </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Image 
              Magik :</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input type="radio" name="im_status" value="enable" <?
			  if($rs0["sb_image_magik"]=="enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Enabled 
              <input type="radio" name="im_status" value="disable" <?
			  if($rs0["sb_image_magik"]<>"enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Disabled </font></font><font size="1" face="Arial, Helvetica, sans-serif"><br>
              Some functions of the site depend on these settings, contact your 
              web host regarding this.</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Water 
              Marking:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input type="radio" name="water_mark" value="enable" <?
			  if($rs0["sb_water_marking"]=="enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Enabled 
              <input type="radio" name="water_mark" value="disable" <?
			  if($rs0["sb_water_marking"]<>"enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Disabled </font></font><font size="1" face="Arial, Helvetica, sans-serif"><br>
              Relevant if Image Magick is enabled.</font></td>
          </tr-->
          <tr valign="top"> 
            <td width="48%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Member 
              Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td width="52%"><select name="sb_mem_approval" id="sb_mem_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_mem_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for new signed 
              up members otherwise Admin has to approve every new signup.</font></font><font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              </font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Premium 
              Employer Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td><select name="sb_premium_approval" id="sb_premium_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_premium_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for premium 
              members otherwise Admin has to approve every new premium request.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Company 
              Profile Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="sb_profile_approval" id="sb_profile_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_profile_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for Company 
              Profiles otherwise Admin has to approve every new company profile.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Job 
              Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td><select name="sb_job_approval" id="sb_job_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_job_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for new job 
              postings otherwise Admin has to approve every new job posting.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Resume 
              Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="sb_resume_approval" id="sb_resume_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_resume_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for new resume 
              posted otherwise Admin has to approve every new resume posted.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Cover 
              Letter Approval Type:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="sb_letter_approval" id="sb_letter_approval">
                <option value="admin" selected>Admin</option>
                <option value="auto" <?php 
			   if ($rs0["sb_letter_approval"]=="auto") echo "selected";?>>Auto</option>
              </select>
              <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              Setting this to Auto, automates the approval process for new cover 
              letters posted otherwise Admin has to approve every new cover letter.</font></font></td>
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