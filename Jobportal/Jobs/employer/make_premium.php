<?php
include_once("logincheck.php");
include_once("../myconnect.php");

////////--------already premium
	$query_chk="select * from sbjbs_premium_gallery where sb_emp_id=".$_SESSION["sbjbs_emp_userid"];
//	echo($query_chk);
	$row_chk=mysql_fetch_array(mysql_query($query_chk));
	if($row_chk)
	{
		header ("Location: gen_confirm_mem.php?errmsg=".urlencode("You are already a premium member"));
		die();
	}

///////------------getting money in account-------/////////
$sbq_tra="select sum(sb_amount) as sb_total_balance from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"];
$sbrow_tra=mysql_fetch_array(mysql_query($sbq_tra));
if(!$sbrow_tra)
{
	$sb_total_balance=0;
}
else
{
	$sb_total_balance=$sbrow_tra["sb_total_balance"];
}
//////////////--------end of getting money---------------////
$sbq_con="select * from sbjbs_config where sb_id=1";
$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));

$sb_fee_currency=$sbrow_con['sb_fee_symbol'];
$sb_fee_currency_name=$sbrow_con['sb_fee_code'];

/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$sbrow_con['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/
$sb_premium_fee=$sbrow_con["sb_premium_fee"];		//used later

if( ($sb_premium_fee > 0) && ($sb_premium_fee > $sb_total_balance) )
{
	header ("Location: gen_confirm_mem.php?errmsg=".urlencode("You must have atleast $sb_premium_fee $sb_fee_currency_name in account to appear in premium member list, please add some money first"));
	die();
}

$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
		if(!get_magic_quotes_gpc())
		{
			$logo=str_replace("$","\$",addslashes($_REQUEST["list1"]));
		}
		else
		{
			$logo=str_replace("$","\$",$_REQUEST["list1"]);
		}
		$profile_id=(int)$_REQUEST["profile_id"];
		
	if ( strlen(trim($logo)) == 0 )
	{
		$errs[$errcnt]="Image must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[<>&]/", $logo))
	{
		$errs[$errcnt]="Image can not have any special characters i.e. & < >";
   		$errcnt++;
	}


if($errcnt==0)
{
	$approved="yes";
//	$sb_msg='You have been made premium member.';
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	if($config["sb_premium_approval"]=="admin")
	{
		$approved="no";
//		$sb_msg='Your request has been sent for admin approval.';
	}
	
		if($approved=="no")
		{ $approved="new";}
	
		$sbuserid=$_SESSION["sbjbs_emp_userid"];
		$sbcurrent=date("YmdHis",time());
		$insert_query="insert into sbjbs_premium_gallery (sb_emp_id, sb_img_url, sb_posted_on, sb_approved,sb_profile_id) values ($sbuserid, '$logo', $sbcurrent, '$approved',$profile_id)";
//	echo($insert_query);
		mysql_query($insert_query);
		if(mysql_affected_rows()>0)
		{	//success
///add to transactions
			$sb_uid=$_SESSION["sbjbs_emp_userid"];
			$sb_date=date("YmdHis",time());
			if( $sb_premium_fee > 0 )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sb_premium_fee.", 'Made your membership premium', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
		
		
			if($approved=="yes")
			{	
				$sb_msg='You have been added to premium member list.';
				header ("Location: gen_confirm_mem.php?errmsg=".urlencode($sb_msg));
			}
			else
			{
				$sb_msg='Your request for premium membership has been sent for admin approval.';
			//////////////------------------mail to admin
//				$sbq_com="select max(sb_id) as new_id from sbjbs_premium_gallery where 1";
		//die($sbq_com);
//		$sbrow_com=mysql_fetch_array(mysql_query($sbq_com));
//		$new_id=$sbrow_com["new_id"];
					$sbq_mem="select * from sbjbs_employers where sb_id=".$_SESSION["sbjbs_emp_userid"];
		$sbrow_mem=mysql_fetch_array(mysql_query($sbq_mem));
	//	$new_id=$sbrow_com["new_id"];
		
		$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
		$sb_null_char=$sbrow_con["sb_null_char"];
		$sb_site_root=$sbrow_con["sb_site_root"];
//		$sb_comp_url=$sbrow_con["sb_site_root"]."/view_profile.php?id=$new_id";

		$sb_admin_email=$sbrow_con["sb_admin_email"];	
		//Reads email to be sebt
			$sql = "SELECT * FROM sbjbs_mails where sb_mailid=12" ;
			$rs_query=mysql_query($sql);
	//		$login_url=$sb_site_root."/employer/signin.php";
		
			if ( $rs=mysql_fetch_array($rs_query)  )// if mail
			{
			 	if($rs["sb_status"]=="yes")	
			  	{
					$from =$rs["sb_fromid"];
					$to = $sb_admin_email;
					$subject =$rs["sb_subject"];
									
					$body=str_replace("%title%", $sbrow_mem["sb_title"],str_replace("%email%", $sbrow_mem["sb_email_addr"],str_replace("%password%",$sb_null_char,str_replace("%lname%", $sbrow_mem["sb_lastname"],str_replace("%fname%", $sbrow_mem["sb_firstname"],str_replace("%username%", $sbrow_mem["sb_username"], $rs["sb_mail"]) ))))); 
					
					$body=str_replace("%signup_url%",$sb_null_char,str_replace("%login_url%",$sb_null_char,$body));
					
					$body=str_replace("%company_profile_url%",$sb_null_char,str_replace("%company_name%",$sb_null_char,str_replace("%company_id%",$sb_null_char,$body)));
	
					$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
					if(isset($rs["sb_html_format"])&&($rs["sb_html_format"]=="yes"))
					{
						$header .= "\r\nMIME-Version: 1.0";
						$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				//		$body=str_replace("\n","<br>",$body);
					}
	
	//				echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
	//				echo "<pre>$body</pre>";
				//	die();
					 mail($to,$subject,$body,$header);
				}// end if status is on
			}// end if mail 
///////////-------------------end mail to admin			
				header("Location: gen_confirm_mem.php?errmsg=".urlencode($sb_msg));

			}
			die();
		}
		else
		{	//failed
			header("Location: gen_confirm_mem.php?err=make_premium&errmsg=".urlencode("unable to complete operation, please try again"));
			die();
		}	
				
	}// end if no errs
}//if form posted
else
{
	$logo='';
	$profile_id="";
}
function main()
{
	global $logo, $errs, $errcnt, $sb_fee_currency, $sb_premium_fee,$profile_id ;

{
?>
<script language="JavaScript">
<!--

function attachment(box)
{
str="fileupload.php?box="  + box;

window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=350,height=450,location=no,directories=no,scrollbars=yes");
}

function removeattachment(box)
{
window.document.form123.list1.value=""
}

function validate(form)
{
	if(form.list1.value=='')
	{
		alert("Please specify an image to upload");
		form.btn_name2.focus();
		return false;
	}
	return true;

}

//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td> 
      <?
if  (count($_POST)>0)
{

if ( $errcnt<>0 )
{

?>
      <table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
        <tr> 
          <td colspan="2"><strong>&nbsp;Your request cannot be processed due to 
            following reasons</strong></td>
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
          <td width="94%"><?php echo  $errs[$i]; ?></td>
        </tr>
        <?
}
?>
      </table>
      <?

}

}


?>
      <form name="form123" method="post" action="make_premium.php" onSubmit="return validate(this);">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
                <tr class="titlestyle"> 
                  <td>&nbsp;Make Premium</td>
                </tr>
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="5">
                <?php 	if($sb_premium_fee>0)	
		  				{	?>
                <tr valign="top"> 
                  <td colspan="3" class="innertablestyle"><font class="normal">&nbsp;The 
                    fee for becoming Premium Member is <?php echo "$sb_fee_currency $sb_premium_fee"; ?></font></td>
                </tr>
                <?php 	}		//end if premium_fee		?>
                <tr valign="top"> 
                  <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Image</strong></font></td>
                  <td width="6">&nbsp;</td>
                  <td width="60%"> <input name = "list1" type = "text" id="list1" value="<?php echo $logo; ?>" size="20" readOnly > 
                    <input type=BUTTON name="btn_name2" value="Upload" onClick=attachment('list1')> 
                    <input type=BUTTON name=buttonname2 value="Remove" onClick=removeattachment()> 
                    &nbsp;<br> <font class="smalltext"> (Uploaded image will be 
                    displayed in the side panel on random basis, the size of the 
                    image must be 70 X 50 px i.e. width X height ) </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Company</strong></font></td>
                  <td>&nbsp;</td>
                  <td><font face="Arial, Helvetica, sans-serif" size="2"> 
                    <select name="profile_id" id="profile_id">
                      <option value="0">Select a Company</option>
                      <?php 	$sbq_com="select * from sbjbs_companies where sb_approved='yes' and sb_show_profile='yes' and sb_uid=".$_SESSION["sbjbs_emp_userid"];
//	die($sbq_com); 
		$sbrs_com=mysql_query($sbq_com);
		while($sbrow_com=mysql_fetch_array($sbrs_com))
		{
			echo '<option value="'.$sbrow_com["sb_id"].'"';
			echo ($sbrow_com["sb_id"]==$profile_id)?'selected':'';
			echo '>'.$sbrow_com["sb_name"].'</option>';
		}
?>
                    </select>
                    <br>
                    <font class="smalltext"> (Choose a company to make premium 
                    image a link to that company) </font> </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input type="submit" name="Submit" value="Done"></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <p align="center">&nbsp;</p>
        </form>
</td>
  </tr>
</table>
<?
}
}  //End of main
include_once("template.php");
?>