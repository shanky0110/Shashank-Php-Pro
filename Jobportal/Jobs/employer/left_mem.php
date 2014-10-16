<?
function left_mem()
{

$sbq_con="select * from sbjbs_config where sb_id=1";
$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
//$sb_recent_count=$sbrow_con["sb_recent_count"];
$sbq_icon="select * from sbjbs_icons where sb_id=".$sbrow_con["sb_icon_list"];
$sbrow_icon=mysql_fetch_array(mysql_query($sbq_icon));
$sb_bar=$sbrow_icon["sb_bar"];
$sb_mem_opt=$sbrow_icon["sb_mem_opt"];
?> 
<table width="150" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top"> <table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;General 
            Options</strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25">&nbsp;<a href="../index.php" class="sidelink">Home</a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" >&nbsp;<a href="emp_home.php" class="sidelink">Member 
            Home </a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" >&nbsp;<a href="logout.php" class="sidelink">Logout</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;My 
            Financials</strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25">&nbsp;<a href="myaccount.php" class="sidelink">View 
            Account </a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" >&nbsp;<a href="addmoney.php" class="sidelink">Add Money 
            </a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;My 
            Job Offers</strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25">&nbsp;<a href="manage_jobs.php" class="sidelink">Manage 
            Job Offers</a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" >&nbsp;<a href="post_job.php" class="sidelink">Post 
            Job Offer</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;Applications</strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25">&nbsp;<a href="manage_applications.php" class="sidelink">Manage 
            Applications</a></td>
        </tr>
        <tr class='innertablestyle'>
          <td>&nbsp;</td>
          <td height="25">&nbsp;<a href="search_resume.php" class="sidelink">Search 
            Resumes </a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;My 
            Companies</strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25"> 
            
            <a href="manage_profiles.php" class="sidelink">Manage Companies</a> 
            </td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" ><a href="companyprofile.php" class="sidelink">Add Company</a></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="150" border="0" cellspacing="1" cellpadding="2" class="onepxtable">
        <tr class="sidetitle"> 
          <td height="25" colspan="2"><strong><img src="../admin/sbjbs_icons/<?php echo $sb_bar; ?>"  align="absmiddle" border="0">&nbsp;Member 
            Account </strong></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4">&nbsp;</td>
          <td width="133" height="25"><a href="editemployer.php" class="sidelink">Edit 
            Personal Profile</a></td>
        </tr>
        <?php 
		////////--------already premium
	$query_chk="select * from sbjbs_premium_gallery where sb_emp_id=".$_SESSION["sbjbs_emp_userid"];
//	echo($query_chk);
	$row_chk=mysql_fetch_array(mysql_query($query_chk));
	?><tr class='innertablestyle'> 
          <td >&nbsp;</td>
          <td height="25" ><?
		  	if(!$row_chk)
			{ echo "<a href='make_premium.php' class='sidelink'>Become Premium</a>";} 
			else 
			{ echo "<a href='edit_premium.php' class='sidelink'>Edit Premium</a>";} 
            ?></td>
        </tr>
        <tr class='innertablestyle'>
          <td >&nbsp;</td>
          <td height="25" ><a href="enable_search.php" class="sidelink">Enable 
            Searching </a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" ><a href="changepassword.php" class="sidelink">Change 
            Password </a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td width="4" >&nbsp;</td>
          <td height="25" ><a href="subscribe.php"> 
            <?php
		  $sub=mysql_num_rows(mysql_query("select * from sbjbs_newsletter,sbjbs_employers
		  where sbjbs_newsletter.sb_email=sbjbs_employers.sb_email_addr and 
		  sbjbs_employers.sb_id=".$_SESSION["sbjbs_emp_userid"]));
		  //echo $sub;
		  if($sub>0)
		  {  echo "Unsubscribe Newsletter";}
		  else
		  { echo "Subscribe Newsletter";}
		  
		  ?>
            </a></td>
        </tr>
        <!--<tr class='innertablestyle'> 
          <td >&nbsp;</td>
          <td height="25" >&nbsp;<a href="#" class="sidelink">Upgrade Membership</a></td>
        </tr>
        <tr class='innertablestyle'> 
          <td >&nbsp;</td>
          <td height="25" >&nbsp;<a href="#" class="sidelink">Subscribe Newsletter</a></td>
        </tr>-->
      </table></td>
  </tr>
  <tr> 
    <td height="100%">&nbsp;</td>
  </tr>
</table>
<?
}// end left
?>
