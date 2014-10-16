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
if(isNaN(form.sb_title_len.value) || (form.sb_title_len.value<0)||(form.sb_title_len.value==""))
{
alert ('Please specify positive numeric value for Title Length!');
form.sb_title_len.focus();
return false;
}
if(isNaN(form.sb_job_desc_len.value) || (form.sb_job_desc_len.value<0)||(form.sb_job_desc_len.value==""))
{
alert ('Please specify positive numeric value for Job Description Length!');
form.sb_job_desc_len.focus();
return false;
}
if(isNaN(form.sb_resume_desc_len.value) || (form.sb_resume_desc_len.value<0)||(form.sb_resume_desc_len.value==""))
{
alert ('Please specify positive numeric value for Resume Description Length!');
form.sb_resume_desc_len.focus();
return false;
}
if(isNaN(form.sb_cover_letter_len.value) || (form.sb_cover_letter_len.value<0)||(form.sb_cover_letter_len.value==""))
{
alert ('Please specify positive numeric value for Cover Letter Length!');
form.sb_cover_letter_len.focus();
return false;
}
if(isNaN(form.sb_company_cnt.value) || (form.sb_company_cnt.value<=0)||(form.sb_company_cnt.value==""))
{
alert ('Please specify positive non-zero value for Maximum Company Profiles!');
form.sb_company_cnt.focus();
return false;
}
if(isNaN(form.sb_job_cnt.value) || (form.sb_job_cnt.value<0)||(form.sb_job_cnt.value==""))
{
alert ('Please specify positive numeric value for Maximum Jobs Posted!');
form.sb_job_cnt.focus();
return false;
}
if(isNaN(form.sb_resume_cnt.value) || (form.sb_resume_cnt.value<0)||(form.sb_resume_cnt.value==""))
{
alert ('Please specify positive numeric value for Maximum Resume Posted!');
form.sb_resume_cnt.focus();
return false;
}
if(isNaN(form.sb_letter_cnt.value) || (form.sb_letter_cnt.value<0)||(form.sb_letter_cnt.value==""))
{
alert ('Please specify positive numeric value for Maximum Cover Letters Posted!');
form.sb_letter_cnt.focus();
return false;
}
if(isNaN(form.sbcomp_cat_cnt.value) || (form.sbcomp_cat_cnt.value<0)||(form.sbcomp_cat_cnt.value==""))
{
alert ('Please specify positive numeric value for Company Categories!');
form.sbcomp_cat_cnt.focus();
return false;
}
return true;
}

</script>
<form action="update_others_set.php" method="post" name="form123" id="form123"  onSubmit="return Validator(this);" >
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td><table width="100%" border="0" cellspacing="10" cellpadding="2">
          <tr> 
            <td height="25" colspan="3" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Config 
              Misc. Parameters</font></strong></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td width="48%" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Title Length:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td width="52%"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_title_len" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_title_len"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of characters in the title 
              field of job/resume/cover letter.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Job Description Length:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_job_desc_len" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_job_desc_len"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of characters in Job Description 
              field.</font></font> </td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Resume Description Length:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_resume_desc_len" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_resume_desc_len"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of characters in Resume Descriptive 
              fields.</font></font> </td>
          </tr>
          <!--  <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Latest 
                News:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_latest_news_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_latest_news_cnt"];?>" size="10">
              <font size="1"><br>
              This will control the number of recent commented forums to be shown 
              on front page.</font></font></td>
          </tr>-->
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Cover 
                Letter Length:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_cover_letter_len" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_cover_letter_len"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of characters in the cover 
              letter contents.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Maximum Company Profiles:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_company_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_company_cnt"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of company profiles one can 
              post.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Maximum Jobs Posted:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_job_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_job_cnt"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of jobs one can post.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels"> 
              Maximum Resume Posted:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              </font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_resume_cnt" type="text" class="box1" id="sb_resume_cnt" value="<? echo $rs0["sb_resume_cnt"];?>" size="10">
              </font></font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of resumes one can post.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Maximum 
                Cover Letters Posted:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_letter_cnt" type="text" class="box1" id="sb_letter_cnt" value="<? echo $rs0["sb_letter_cnt"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of cover letters one can post.</font></font> 
            </td>
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
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Company 
                Categories:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sbcomp_cat_cnt" type="text" class="box1" id="sbcomp_cat_cnt" value="<? echo $rs0["sbcomp_cat_cnt"];?>" size="10">
              <font size="2" face="Arial, Helvetica, sans-serif"> </font></font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the maximum number of categories in which a company 
              profile can be posted.</font></font></td>
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
  </form>

<?
}// end main
include "template.php";?>