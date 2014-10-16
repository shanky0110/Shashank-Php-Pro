<?php

include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));

$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];

/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$config['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/
$sql="select * from sbjbs_plans   where id=" . $_REQUEST["id"];
$rs0_query=mysql_query ($sql);
$rs0=mysql_fetch_array($rs0_query);
?>
<script language="JavaScript">
<!--
function Validate()
{

if (form123.credits.value==''  || isNaN(form123.credits.value) || form123.credits.value<=0  )
{
	alert("Please specify positive numeric value for Duration");
	document.form123.credits.focus();
	return (false);
}
if (form123.price.value==''  || isNaN(form123.price.value) || form123.price.value<=0  )
{
	alert("Please specify positive numeric value for Fee");
	document.form123.price.focus();
	return (false);
}


return(true);
}

//-->
</script>
<form action="updateplan.php" method="post" name="form123" id="form123" onsubmit="return Validate();">
  <div align="center"> <font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
    </font> 
    <table border="0" cellspacing="10" cellpadding="0">
      <tr bgcolor="#0057AE"> 
        <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;<font face="Arial, Helvetica, sans-serif">Edit 
          Plan</font></font></strong></td>
      </tr>
      <tr> 
        <td align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Durations 
          :</font></b></td>
        <td> <input name="credits" type="text" value="<?php echo $rs0["credits"]; ?>" size="7" border="0">
          <font size="2" face="Arial, Helvetica, sans-serif">Days</font><font size="1" face="Arial, Helvetica, sans-serif"><br>
          Search will be available for the value specified above for this particular 
          plan.</font></td>
      </tr>
      <tr> 
        <td width="152" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Fee 
          :</font></b></td>
        <td width="402"> <font size="2" face="Arial, Helvetica, sans-serif"><?php echo $sb_fee_currency; ?></font> 
          <input name="price" type="text" value="<?php echo $rs0["price"]; ?>" size="7" border="0">
          <input type="hidden" name="id" value="<? echo $_REQUEST["id"]; ?>" >
          <font size="1" face="Arial, Helvetica, sans-serif"><br>
          This amount will be deducted from user's account on choosing this particular 
          plan</font><font size="1" face="Arial, Helvetica, sans-serif">.</font></td>
      </tr>
   <tr> 
        <td align="right" valign="top" bgcolor="#F5F5F5"> 
          <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"><br>
            </font></div></td>
        <td><input type="submit" name="submitButtonName" value="Update Plan" border="0"></td>
      </tr>
    </table>
  </div>
</form>
<?
}//main()
include "template.php";
?>

