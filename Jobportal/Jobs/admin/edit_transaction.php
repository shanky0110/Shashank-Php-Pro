<?php
include_once "myconnect.php";
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));

$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];
$id=$_REQUEST["id"];
$rst1=mysql_fetch_array(mysql_query("select * from sbjbs_transactions where sb_id=$id"));
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_id=".$rst1["sb_uid"]));
?>
<script language="JavaScript">
function Validate(form)
{
if(isNaN(form.amount.value) || (form.amount.value== "") || (form.amount.value== 0))
{
alert (' Enter a numeric value (not equals to zero) for Amount!');
form.amount.focus();
return false;
}
if((form.comments.value== ""))
{
alert ('Please Enter Description!');
form.comments.focus();
return false;
}
return true;
}
</script>
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="10">
  <form action="update_transaction.php" onSubmit="return Validate(this);">
    <tr bgcolor="#004080"> 
      <td height="25" colspan="2"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
        Edit Transaction of Employer <font color='#FFCC00'><? echo $rst["sb_username"];?></font></strong></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Amount: 
        <input name="id" type="hidden" id="id" value="<? echo $id;?>">
        </font></strong></td>
      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $sb_fee_currency; ?></font><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="amount" type="text" id="amount"style="font-family: courier,monospace;" value="<? echo $rst1["sb_amount"];?>" size="7" >
        <br>
        if you made changes in the amount here it will effect the total balance 
        of employer's account eg. if you change $3 to $ -3 then balance will be 
        reduced by $6.</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Description:</font></strong></td>
      <td align="left"><font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="comments" type="text" value="<? echo $rst1["sb_description"];?>" size="32" maxlength="80"style="font-family: courier,monospace;" >
        <br>
        Description must not be more than 80 characters.</font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" bgcolor="#F5F5F5">&nbsp; </td>
      <td align="left"> <font size="1" face="Arial, Helvetica, sans-serif"> 
        <input name="Back" type="button" id="Back3" value=" Go Back" onClick="javascript:window.history.go(-1);">
        <input type="submit" name="Submit" value="Update">
        </font></td>
    </tr>
  </form>
</table>
<?
}
include_once "template.php";
?>