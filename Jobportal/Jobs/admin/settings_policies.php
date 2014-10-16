<?
include_once("myconnect.php");
include_once("logincheck.php");

function main()
{
	$sbq_con="select * from sbjbs_policies where sb_id=1";
	$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
	$sb_how_to_sell=$sbrow_con["sb_terms"];
	$sb_how_to_buy=$sbrow_con["sb_privacy"];
	$sb_legal=$sbrow_con["sb_legal"];
	$sb_welcome_msg=$sbrow_con["sb_welcome_msg"];
?>
<script language="JavaScript">
<!--

function validate(form)
{
	if ( form.sb_welcome_msg.value == "" ) 
	{
      	alert('Please specify welcome message!');
	   form.sb_welcome_msg.focus();	
		return false;
	}
	if ( form.sb_how_to_sell.value == "" ) 
	{
      	alert('Please specify terms of use!');
	   form.sb_how_to_sell.focus();	
		return false;
	}
	if ( form.sb_how_to_buy.value == "" ) 
	{
       alert('Please specify privacy policy!');
	   form.sb_how_to_buy.focus();
	   return false;
	}
	if ( form.sb_legal.value == "" ) 
	{
       alert('Please specify legal policy!');
	   form.sb_legal.focus();
	   return false;
	}
	return true;
}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td> 
      <form name="form123" method="post" action="update_policies_set.php" onSubmit="return validate(this);">
        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" class="onepxtable">
          <tr class="titlestyle"> 
            <td colspan="3">&nbsp;Config Policies Text</td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Welcome 
              Message </strong></font></td>
            <td><font class="red">*</font></td>
            <TD valign="middle"><textarea name="sb_welcome_msg" cols="50" rows="8" id="sb_welcome_msg"><?php echo $sb_welcome_msg; ?></textarea></TD>
          </tr>
          <tr valign="top"> 
            <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Terms 
              of Use</strong></font></td>
            <td width="6"><font class="red">*</font></td>
            <TD width="60%" valign="middle"><textarea name="sb_how_to_sell" cols="50" rows="8" id="sb_how_to_sell"><?php echo $sb_how_to_sell; ?></textarea></TD>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Privacy 
              Policy</strong></font></td>
            <td><font class="red">*</font></td>
            <TD valign="middle"><textarea name="sb_how_to_buy" cols="50" rows="8" id="sb_how_to_buy"><?php echo $sb_how_to_buy; ?></textarea></TD>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Legal 
              Policy</strong></font></td>
            <td><font class="red">*</font></td>
            <TD valign="middle"><textarea name="sb_legal" cols="50" rows="8" id="sb_legal"><?php echo $sb_legal; ?></textarea></TD>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit2" value="Update"> </td>
          </tr>
        </table>
        </form>
</td>
  </tr>
</table>
<?
}  //End of main
include_once("template.php");
?>