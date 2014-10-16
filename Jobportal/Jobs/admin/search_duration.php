<?php
include_once("logincheck.php");
include_once("myconnect.php");

if(!isset($_REQUEST["sb_id"]) || !isset($_REQUEST["sb_id"]))
{
	header("Location: employers.php?msg=".urlencode("Invalid Id, cannot continue"));
	die();
}
$sb_id=$_REQUEST["sb_id"];

$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
	$logo=(int)$_REQUEST["list1"];

	if ( !isset($_REQUEST["list1"]) || !is_numeric($_REQUEST["list1"]) || ($_REQUEST["list1"] < 1) )
	{
		$errs[$errcnt]="Duration must be a positive non-zero number";
   		$errcnt++;
	}


if($errcnt==0)
{
		$sb_uid=$sb_id;
		$sb_date=date("YmdHis",time());
		$sb_duration=$logo;
		
		$sbq_emp_chk="select *, TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) as sb_expiry from sbjbs_employers where sb_id=$sb_uid and TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) >0";
		$sbrow_emp_chk=mysql_fetch_array(mysql_query($sbq_emp_chk));
		if($sbrow_emp_chk)
		{		//search enabled means add the duration
			$sb_duration+=$sbrow_emp_chk["sb_expiry"];
		}	
//		DATE_ADD('$data_time',INTERVAL 1 YEAR)
		$insert_query="update sbjbs_employers set sb_search_allowed='yes', sb_search_expiry=DATE_ADD($sb_date,INTERVAL $sb_duration DAY) where sb_id=$sb_uid";
	//	$insert_query="update sbjbs_premium_gallery set sb_img_url='$logo' where sb_emp_id=$sb_id";
		$sb_msg='Search has been enabled';

//	echo($insert_query);
		mysql_query($insert_query);
		if(mysql_affected_rows()>0)
		{	//success
			header("Location: employers.php?msg=".urlencode($sb_msg));
			die();
		}
		else
		{	//failed
			header("Location: employers.php?msg=".urlencode("unable to enable search, please try again"));
			die();
		}	
				
	}// end if no errs
}//if form posted
else
{
	$logo='';
}
function main()
{
	global $logo, $errs, $errcnt, $sb_id;

{
?>
<script language="JavaScript">
<!--


function validate(form)
{
	if(form.list1.value=='' || isNaN(form.list1.value))
	{
		alert("Please specify Duration as a positive non-zero number");
		form.list1.focus();
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
            <td colspan="3">&nbsp;Enable Search</td>
          </tr>
          <tr valign="top"> 
            <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Duration</strong></font></td>
            <td width="6">&nbsp;</td>
            <td width="60%"> <input name = "list1" type = "text" id="list1" value="<?php echo $logo; ?>" size="20">
              <font size="2" face="Arial, Helvetica, sans-serif">Days</font><br>
              <font size="1" face="Arial, Helvetica, sans-serif">(Please specify number of days for which 
              this facility will be enabled for the employer)</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Done">
              <input name="sb_id" type="hidden" id="sb_id" value="<?php echo  $sb_id; ?>">
              </td>
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