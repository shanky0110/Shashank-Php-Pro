<?php
include "logincheck.php";
include_once "myconnect.php";
function main()
{

$keyword="";
$sbexpiry=1;
$sbapproval=1;
$recperpage=10;
?> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" dwcopytype="CopyTableCell">
  <tr>
    <td valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
              <tr> 
                <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
                  Jobs</strong></font></td>
              </tr>
              <form name="search_form" action="jobs.php" method="post" >
                <tr> 
                  <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Keyword:</font></strong></div></td>
                  <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
                </tr>
                <tr align="left" valign="top"> 
                  <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Employer:</strong></font></div></td>
                  <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
                    <select name="sb_id">
                      <option value="">All Members</option>
                      <?php
			 $mem_q=mysql_query("select * from sbjbs_employers  where sb_suspended='no' order by sb_username");
			 while($mem=mysql_fetch_array($mem_q))
			 {
              ?>
                      <option value="<?php echo $mem["sb_id"];?>"><?php echo $mem["sb_username"];?></option>
                      <?php 
			  }
			  ?>
                    </select>
                    </font></font></td>
                </tr>
                <tr align="left" valign="top"> 
                  <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Show:</strong></font></div></td>
                  <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
                    <input name="show" type="radio" value="1" checked>
                    All</font></font><font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="show" value="2" >
                    Approved 
                    <input type="radio" name="show" value="3" >
                    Unapproved</font></td>
                </tr>
                <tr> 
                  <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Record 
                      Per Page:</font></strong></div></td>
                  <td><select name="recperpage">
                      <option value="<?php echo $config["sb_recperpage"];?>" >Default</option>
                      <option value="10" >10</option>
                      <option value="20" >20</option>
                      <option value="30" >30</option>
                      <option value="50" >50</option>
                      <option value="100" >100</option>
                    </select></td>
                </tr>
                <tr> 
                  <td bgcolor="#F5F5F5">&nbsp;</td>
                  <td><input type="submit" name="Submit2" value="Search"> </td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr> 
          <td align="left" valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
              <tr bgcolor="#004080"> 
                <td height="25" colspan="2"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Site 
                  Statistics </strong></font></td>
              </tr>
              <tr> 
                <td width="50%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Categories:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_categories"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
              <tr> 
                <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Job Seekers:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_seekers "));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
              <tr> 
                <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Company Profiles:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*)  from sbjbs_companies where 1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
              <tr> 
                <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Employers:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*)  from sbjbs_employers where 1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
              <tr> 
                <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Jobs:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_jobs where 1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
              <tr> 
                <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Total 
                  Resumes:</font></strong></td>
                <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                  <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_resumes where 1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                  </font></strong></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="2">
              <tr> 
                <td height="25"  bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Recent 
                  Statistics</strong></font></td>
              </tr>
			  <tr><td><table width="100%" align="center" cellpadding="2" cellspacing="1">
                    <tr> 
                      <td height="25" align="right" bgcolor="#F5F5F5"><strong></strong></td>
                      <td align="center" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Jobs 
                        Posted </font></strong></td>
                      <td align="center" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Resumes 
                        Posted </font></strong></td>
                      <td height="25" align="center" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Employer 
                        Signups</font></strong></td>
                      <td height="25" align="center" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Job 
                        Seeker Signups</font></strong></td>
                    </tr>
                    <tr> 
                      <td height="25" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Today</font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_jobs where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))=0"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_resumes where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))=0"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_employers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))=0"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_seekers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))=0"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                    </tr>
                    <tr> 
                      <td height="25" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Yesterday</font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_jobs where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))=1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_resumes where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))=1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_employers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))=1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_seekers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))=1"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                    </tr>
                    <tr> 
                      <td height="25" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Last 
                        7 Days</font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_jobs where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))<=7"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_resumes where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))<=7"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_employers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))<=7"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_seekers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))<=7"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        </font></strong></td>
                    </tr>
                    <tr> 
                      <td height="25" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Last 
                        30 Days</font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        &nbsp; 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_jobs where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))<=30"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        &nbsp;</font></strong></td>
                      <td align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        &nbsp; 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_resumes where
				(TO_DAYS(NOW()) - TO_DAYS(sb_posted_on))<=30"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        &nbsp;</font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        &nbsp; 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_employers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))<=30"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        &nbsp;</font></strong></td>
                      <td height="25" align="center"><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        &nbsp; 
                        <?
				$num=mysql_fetch_array(mysql_query("select count(*) from sbjbs_seekers where
				(TO_DAYS(NOW()) - TO_DAYS(sb_signup_on))<=30"));
				if($num)
				{ echo $num[0]; }
				else
				{ echo "0";}
				?>
                        &nbsp;</font></strong></td>
                    </tr>
                  </table></td></tr>
            </table></td>
        </tr>
      </table> </td>
  </tr>
</table>
<?
}// end main

include_once "template.php";
?>