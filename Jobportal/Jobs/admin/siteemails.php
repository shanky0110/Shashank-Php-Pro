<?
include_once("myconnect.php");
include "logincheck.php";
function RTESafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = trim($strText);
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}
function main()
{
?> 
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
  <tr> 
    <td colspan="2" valign="top"> 
      <?
		
		$errcnt=0;
		$showform="";
		
		$mailid="";
		$fromid="";
		$subject="";
		$mail="";
		if ( count($_POST)!=0 )
		{
		$mailid=$_REQUEST["mailid"];
		
		if ($_REQUEST["mailid"]!="" )
		{
		$rs=mysql_query("select * from sbjbs_mails where sb_mailid=" . $_REQUEST["mailid"] );
		$rs=mysql_fetch_array($rs);
		$fromid=$rs["sb_fromid"];
		$subject=$rs["sb_subject"];
		$mail=$rs["sb_mail"];
		}
		
		if (  isset( $_REQUEST["update"])  )
		{
		
		if ( !isset( $_REQUEST["fromid"] ) || $_REQUEST["fromid"]=="" )
		{
			$errs[$errcnt]="From/ Reply address must be provided";
			$errcnt++;
		}
		if ( !isset( $_REQUEST["subject"] ) || $_REQUEST["subject"]=="" )
		{
			$errs[$errcnt]="Email Subject must be provided";
			$errcnt++;
		}
		if ( !isset( $_REQUEST["mail"] ) || $_REQUEST["mail"]=="" )
		{
			$errs[$errcnt]="Email Contents must be provided";
			$errcnt++;
		}
		}
		
		}
		if  (count($_POST)<>0)
		{
		if ( $errcnt==0 )
		{
		if (  isset( $_REQUEST["update"])  )
		{
			if (!get_magic_quotes_gpc()) {
			$insert_fromid=str_replace('$', '\$',addslashes($_REQUEST["fromid"]));
			$insert_subject=str_replace('$', '\$',addslashes($_REQUEST["subject"]));
			$insert_mail=str_replace('$', '\$',addslashes($_REQUEST["mail"]));
			}
			else
			{
			$insert_fromid=str_replace('$', '\$',$_REQUEST["fromid"]);
			$insert_subject=str_replace('$', '\$',$_REQUEST["subject"]);
			$insert_mail=str_replace('$', '\$',$_REQUEST["mail"]);
			}
			$html="no";
			if(isset($_REQUEST["html_format"]))
			{
			$html="yes";
			}
		$update_str="update sbjbs_mails set sb_fromid='$insert_fromid', sb_subject='$insert_subject', sb_mail='$insert_mail',sb_status='".$_REQUEST["status"]."',sb_html_format='".$html."' where sb_mailid =" . $_REQUEST["mailid"];
		mysql_query($update_str);
		
		?>
      <div align="center"> <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Mail 
        has been updated</font></div>
      <?
		$showform="No";
		}
		
		}
		else
		{
		?>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Your 
            Update Email Request cannot be processed due to following Reasons</font></td>
        </tr>
        <?

for ($i=0;$i<$errcnt;$i++)
{
?>
        <tr> 
          <td width="6%"><font color="#FF0000"><?php echo $i+1; ?></font></td>
          <td width="94%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo  $errs[$i]; ?> 
            </font></td>
        </tr>
        <?
}//end for
?>
      </table>
      <?

}

}

if (isset($_REQUEST["mailid"])&& ($_REQUEST["mailid"]!="" ))
{
$rs=mysql_query("select * from sbjbs_mails where sb_mailid=" . $_REQUEST["mailid"] );
$rs=mysql_fetch_array($rs);
$fromid=$rs["sb_fromid"];
$subject=$rs["sb_subject"];
$mail=$rs["sb_mail"];
}
 ?>
    </td>
  </tr>
  <tr> 
    <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Configure 
      Site Emails</strong></font></td>
  </tr>
  <tr> 
    <form name="form2" method="post" action="siteemails.php">
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Choose 
        Email:&nbsp; </font></strong> </td>
      <td valign="top"><font size="1" face="Arial, Helvetica, sans-serif"> 
        <select name="mailid" id="mailid">
          <option  value="">Select a mail message</option>
          <option  value="">--------------------------------</option>
          <?php ?>
		  <option value="10" 
				   <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="10")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
				  >Signup Verification Email</option>
          <option value="1" 
				   <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="1")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
				  >Welcome Email</option>
          <option value="4" 				   <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="4")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Forgot Password Email</option>
          <option value="2"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="2")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>New Company Profile Awaiting Approval</option>
          <option value="3"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="3")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Updated Company Profile Awaiting Approval</option>
          <option value="5"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="5")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>New Posted Job Awaiting Approval</option>
          <option value="6"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="6")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Updated Job Awaiting Approval</option>
          <option value="7"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="7")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Comments Posted (for Visitor)</option>
          <option value="8"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="8")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Comments Posted (for Admin)</option>
          <option value="9"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="9")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Refer a Friend</option>
          <option value="11"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="11")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Post Resume</option>
          <option value="12"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="12")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Premium Membership Request</option>
          <option value="13"				   
				  <? 
				  if  (isset($_REQUEST["mailid"]) && $_REQUEST["mailid"]=="13")
				  {
				  echo " Selected ";
				  }
				  
				  ?>
>Mail Alerts</option>
        </select>
        <input type="submit" name="Submit3" value="Select email message">
        <br>
        Choose an Email to configure.</font></td>
    </form>
  </tr>
  <? if(isset($_REQUEST["mailid"])&& ($_REQUEST["mailid"]!="" ))
	  {?>
	  <script language="JavaScript" type="text/javascript" src="richtext.js"></script>
	<script language="JavaScript">
	function validate(form)
	{
		updateRTEs();
	}	
	</script>
  <form name="form1" method="post" action="siteemails.php" onSubmit="validate(this);">
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Custom 
        Shortcuts </strong></font></td>
    </tr>
    <tr> 
      <td colspan="2" valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <strong><font color="#003366">MEMBER/SIGNUP SPECIFIC:</font></strong><br>
        1. %title% will display the user's title i.e. Mr/Mrs etc.<br>
        2. %fname% will display the user's first name.<br>
        3. %lname% will display the user's last name.<br>
        4. %email% will display the user's email id.<br>
        5. %username% will display user's username.<br>
        6. %password% will display the user's password.<br>
        7. %login_url% will display user's login link.<strong><font size="2" face="Arial, Helvetica, sans-serif"><br>
        </font></strong>8<font size="2" face="Arial, Helvetica, sans-serif">. 
        %signup_url% will display new signup link.<br>
        <strong><font color="#003366">JOB SPECIFIC:</font></strong><br>
        1. %job_title% will display the job's title.<br>
        2. %job_id% will display the job's ID.<br>
        3. %job_url% will display the url link for job.<br>
        <strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#003366">COMPANY 
        PROFILE SPECIFIC:</font></strong><br>
        </font></font></strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">1. 
        %company_name% will display the company's title.<br>
        2. %<font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">company</font></font></font>_id% 
        will display the <font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">company</font></font></font>'s 
        ID.<br>
        3. %<font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">company</font></font></font>_profile_url% 
        will display the url link for the company.</font></font><strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><br>
        </font></font><font color="#003366">MESSAGE/FEEDBACK SPECIFIC:</font></strong><br>
        1.%message_text% will display message text.<br>
        2.%message_title% will display message title.<br>
        3.%message_date% will display date/time on which message was received.<br>
        <font size="2" face="Arial, Helvetica, sans-serif">4<font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif">.%visitor_name% 
        will display visitor's name who posted comments/feedbacks.<br>
        5.%friend_name% will display friend's name while refering to a friend.</font></font></font></font></font></font></font></font></font> 
        <br>
        <font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#003366">MAIL 
        ALERT SPECIFIC:</font></strong><br>
        1. %jobcnt% will display the total job count.<br>
        2. %jobstr% will display the job title(s).</font></font></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
        Edit Mail Template</strong></font></strong></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">From 
        / Reply address: 
        <input name="update" type="hidden" id="update" value="Yes">
        <input name="mailid" type="hidden" id="mailid" value="<?php echo $mailid; ?>">
        </font></strong></td>
      <td><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="fromid" type="text" id="fromid" value="<?php echo $fromid; ?>" size="30">
        <br>
        The above Email Address will be sent as Sender's Email.</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Subject:</font></strong></td>
      <td><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="subject" type="text" id="subject" value="<?php echo $subject; ?>" size="30">
        <br>
        The above text will act as a custom subject for the Email</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Email 
        Message:</font></strong></td>
      <td><font class="normal"> 
        <!--textarea name="mail" cols="40" rows="10" id="mail"><?php echo $mail; ?></textarea-->
         
              <script language="JavaScript" type="text/javascript">
//<!--

<?
$content = $mail;
$content = RTESafe($content);
?>//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("../images/", "", "");

//Usage: writeRichText(fieldname, html, width, height, buttons)
writeRichText('mail', '<?=$content?>', 450, 200, true, false);
//-->
</script>
              <noscript>
              <b>Javascript must be enabled to use this 
                form.</b></noscript><br>
        The above text will be sent as automated mail upon certain actions eg. 
        Welcome message when a new user Signs up.</font></td>
    </tr>
    <tr> 
      <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Send 
          this Mail:</font></strong></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="status" type="radio" value="yes" <?php if($rs["sb_status"]=="yes") {echo "checked";}?>>
        Yes 
        <input type="radio" name="status" value="no" <?php if($rs["sb_status"]=="no") {echo "checked";}?>>
        No</font></td>
    </tr>
    <tr> 
      <td bgcolor="#F5F5F5">&nbsp;</td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="html_format" type="checkbox" id="html_format" value="yes" <?php if($rs["sb_html_format"]=="yes") {echo "checked";}?>>
        Send as HTML </font></td>
    </tr>
    <tr> 
      <td width="45%" bgcolor="#F5F5F5">&nbsp;</td>
      <td> <input type="submit" name="Submit22" value="Save message"> </td>
    </tr>
  </form>
  <?
}
?>
</table>
<?
}// end of main()
include "template.php";
?>
