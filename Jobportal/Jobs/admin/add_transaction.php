<?php
include_once "myconnect.php";
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));

$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];

$id=0;
$username="";
if(isset($_REQUEST["id"]))
{
$id=$_REQUEST["id"];
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_id=$id"));
$username=$rst["sb_username"];
}
?>
<script language="JavaScript">
function Validate(form)
{
if((form.username.value== ""))
{
alert (' Please Enter Employer Username!');
form.username.focus();
return false;
}
if(isNaN(form.amount.value) || (form.amount.value== "") || (form.amount.value==0))
{
alert (' Please Enter a numeric value (not equal to zero) for Amount!');
form.amount.focus();
return false;
}
if((form.comments.value== ""))
{
alert (' Please Enter Description!');
form.comments.focus();
return false;
}
return true;
}
</script>
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="10">
  <form action="insert_transaction.php" onSubmit="return Validate(this);">
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Make 
        a Transaction</strong></font></td>
    </tr>
    <tr> 
      <td align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Employer Username:</font></strong></td>
      <td align="left"><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="username" type="text" id="username" value="<? echo $username;?>" style="font-family: courier,monospace;" size="32" >
        </font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Amount:</font></strong></td>
      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $sb_fee_currency;?></font><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="amount" type="text" id="amount" style="font-family: courier,monospace;" value="" size="7" >
        <br>
        If you want to deduct money or a withdrawl transaction then enter amount 
        as negative entry.</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Description:</font></strong></td>
      <td align="left"><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="comments" type="text" value="" size="32" maxlength="80"style="font-family: courier,monospace;" >
        <br>
        Description must not be more than 80 characters.</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5">&nbsp;</td>
      <td align="left"> <font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="Back" type="button" id="Back2" value=" Go Back" onClick="javascript:window.history.go(-1);">
        <input type="submit" name="Submit" value="Add">
        </font></td>
    </tr>
  </form>
</table>
<?
}
include_once "template.php";
?>
