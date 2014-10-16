<?php
include_once "myconnect.php";
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];
$id=$_REQUEST["id"];
$rst1=mysql_fetch_array(mysql_query("select * from sbjbs_transactions where sb_id=$id"));
$total=mysql_fetch_array(mysql_query("select sum(sb_amount) as balance from sbjbs_transactions where sb_uid=".$rst1["sb_uid"]));
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_id=".$rst1["sb_uid"]));
?>
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="10">
  <form action="delete_tc.php" >
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Delete 
        a Transaction from <font color='#FFCC00'><? echo $rst["sb_username"];?>'s</font> Account </strong></font></td>
    </tr>
    <tr> 
      <td colspan="2" align="center" valign="top"><font size="2" face="Arial, Helvetica, sans-serif" color="#FF0000"> 
        <input name="id" type="hidden" id="id" value="<? echo $id;?>">
        If you proceed then an amount of 
        <? 
		echo $sb_fee_currency;
		printf("%.2f",abs($rst1["sb_amount"]));?>
        will be 
        <? if($rst1["sb_amount"]<0)
		{
		echo "added to ";
		}
		else
		{
		echo "deducted from ";
		}
 echo $rst["sb_username"];?>'s Account Balance.</font></td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#F5F5F5"> 
        <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Current 
          Balance:</font></strong></div></td>
      <td width="280" align="left"><font size="1" face="Arial, Helvetica, sans-serif"><?
	  if($total["balance"]<>"")
	  { 
	  	echo $sb_fee_currency;
		echo $total["balance"];
	}
	else
	{ echo $config["sb_null_char"];}	?></font></td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#F5F5F5"> 
        <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Transaction:</font></strong></div></td>
      <td align="left"><font size="1" face="Arial, Helvetica, sans-serif"><? 	echo $sb_fee_currency;
	  echo $rst1["sb_amount"];?></font></td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#F5F5F5"> 
        <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Balance 
          after Transaction:</font></strong></div></td>
      <td align="left">
<div align="left"><font size="1" face="Arial, Helvetica, sans-serif"><? 
	echo $sb_fee_currency;
	printf("%.2f", $total["balance"]-$rst1["sb_amount"]);?></font></div></td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
      <td align="left"> 
        <input name="Back" type="button" id="Back2" value=" Go Back" onClick="javascript:window.history.go(-1);"> 
        <input type="submit" name="Submit" value="Delete"></td>
    </tr>
  </form>
</table>
<?
}
include_once "template.php";
?>
