<?php
include_once("logincheck.php");
include_once("myconnect.php");

if(!isset($_REQUEST["sb_id"]) || !isset($_REQUEST["sb_id"]))
{
	header("Location: premium_mem.php?msg=".urlencode("Invalid Id, cannot continue"));
	die();
}
$sb_id=$_REQUEST["sb_id"];

$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
	$sb_found=$_REQUEST["sb_found"];
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
	$sbuserid=$_REQUEST["sb_id"];
	$sbcurrent=date("YmdHis",time());
//echo "hey--------$sb_found------hey";
	if($sb_found)
	{
		$insert_query="update sbjbs_premium_gallery set sb_img_url='$logo',sb_profile_id=$profile_id where sb_emp_id=$sb_id";
		$sb_msg='Premium member has been updated';
		$sb_errmsg='update';
	}
	else
	{
		$sb_errmsg='add';
		$sb_msg='Premium member has been added';
		$insert_query="insert into sbjbs_premium_gallery (sb_emp_id, sb_img_url, sb_posted_on, sb_approved,sb_profile_id) values ($sbuserid, '$logo', $sbcurrent, 'yes',$profile_id)";
	}
//	echo($insert_query);
		mysql_query($insert_query);
		if(mysql_affected_rows()>0)
		{	//success
			header("Location: premium_mem.php?msg=".urlencode($sb_msg));
			die();
		}
		else
		{	//failed
			header("Location: premium_mem.php?msg=".urlencode("unable to sb_errmsg premium member, please try again"));
			die();
		}	
				
	}// end if no errs
}//if form posted
else
{
	$sbq_pre="select * from sbjbs_premium_gallery where sb_emp_id=$sb_id";
//	echo $sbq_pre;
	$sbrow_pre=mysql_fetch_array(mysql_query($sbq_pre));
	$sb_found=1;
	if(!$sbrow_pre)	
	{
		$sb_found=0;
		$logo='';
		$profile_id="";	
//		header("Location: premium_mem.php?msg=".urlencode("No such premium member exists"));
//		die();
	}
	else
	{
		$logo=$sbrow_pre["sb_img_url"];
		$profile_id=$sbrow_pre["sb_profile_id"];
	}	
}
function main()
{
	global $sb_found, $logo, $errs, $errcnt, $sb_id,$profile_id;

{
?>
<script language="JavaScript">
<!--

function attachment(box)
{
	str="fileupload.php?box="  + box;
	sbwin=window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
	sbwin.focus();
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
      <form name="form123" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return validate(this);">
        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" class="onepxtable">
          <tr class="titlestyle"> 
            <td colspan="3">&nbsp;Edit Premium Member</td>
          </tr>
          <tr valign="top"> 
            <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Image</strong></font></td>
            <td width="6">&nbsp;</td>
            <td width="60%"> <input name = "list1" type = "text" id="list1" value="<?php echo $logo; ?>" size="20" readOnly > 
              <input type=BUTTON name="btn_name2" value="Upload" onClick=attachment('list1')> 
              <input type=BUTTON name=buttonname2 value="Remove" onClick=removeattachment()> 
              &nbsp;<br> <font class="smalltext"> (Uploaded image will be displayed 
              in the side panel on random basis, the size of the image must be 
              70 X 50 px i.e. width X height ) </font></td>
          </tr>
          <tr valign="top">
            <td align="right" class="innertablestyle"><font class="normal"><strong>Company</strong></font></td>
            <td>&nbsp;</td>
            <td><font face="Arial, Helvetica, sans-serif" size="2">
              <select name="profile_id" id="profile_id">
                <option value="0">Select a Company</option>
                <?php 	$sbq_com="select * from sbjbs_companies where sb_approved='yes' and sb_show_profile='yes' and sb_uid=$sb_id";
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
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Done"> <input name="sb_id" type="hidden" id="sb_id" value="<?php echo  $sb_id; ?>"> 
              <input name="sb_found" type="hidden" id="sb_found" value="<?php echo $sb_found; ?>"></td>
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