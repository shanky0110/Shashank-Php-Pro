<?
include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];


//$sbq_con="select * from sbjbs_config where sb_id=1";
//$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$config['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/
//$sb_premium_fee=$sbrow_con["sb_premium_fee"];		//used later

$sql="select * from sbjbs_plans order by credits";

$rs0_query=mysql_query ($sql);
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
<div align="center">
  <table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Resume 
        Search Plans</font></strong></td>
    </tr>
    <tr> 
      <td colspan="2"><div align="justify"><font size="1" face="Arial, Helvetica, sans-serif">User 
          can purchase plan for searching resumes. Here duration means the period 
          for which the search facility will remain available. For adding a new 
          Plan just enter related information in &quot;Add New Plan form&quot; 
          e.g. if you want to add a plan saying '100 days for $7' then enter 100 
          in duration field and 7 in fee field.</font></div></td>
    </tr>
    <tr> 
      <td colspan="2"><table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr> 
            <td width="182" height="20" bgcolor="#f5f5f5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Duration 
              (Days)</font></strong></td>
            <td width="215" height="20" bgcolor="#f5f5f5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Fee 
              (<?php echo $sb_fee_currency; ?>)</font></strong></td>
            <td width="132" height="20" bgcolor="#f5f5f5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Edit</font></strong></td>
            <td width="138" height="20" bgcolor="#f5f5f5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Delete</font></strong></td>
          </tr>
          <?
$cnt=0;
while ($rs0=mysql_fetch_array($rs0_query))
{
$cnt++;
?>
          <tr> 
            <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo  $rs0["credits"]; ?></font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rs0["price"]; ?></font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><a href="editplan.php?id=<?php echo $rs0["id"]; ?>">Edit</a></font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><a href="deleteplan.php?id=<?php echo $rs0["id"]; ?>" onClick="javascript: return confirm('Do you really want to delete the Plan.');">Delete</a></font></td>
          </tr>
          <?
 }
 ?>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="4">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Add 
        New Plan</font></strong></td>
    </tr>
    <form action="insertplan.php" method="post" name="form123" id="form123" onsubmit="return Validate();">
      <tr valign="top"> 
        <td width="40%" height="39" align="right" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Duration 
          :</font></b></td>
        <td> <input name="credits" type="text" size="7" border="0">
          <font size="2" face="Arial, Helvetica, sans-serif">Days</font><font size="1" face="Arial, Helvetica, sans-serif"><br>
          Search will be available for the value specified above for this particular 
          plan.</font></td>
      </tr>
      <tr> 
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Fee 
          :</font></b></td>
        <td><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $sb_fee_currency; ?></font> 
          <input name="price" type="text" size="7" border="0"> <font size="1" face="Arial, Helvetica, sans-serif"><br>
          This amount will be deducted from user's account on choosing this particular 
          plan</font><font size="1" face="Arial, Helvetica, sans-serif">.</font></td>
      </tr>
      <tr> 
        <td width="40%" align="right" bgcolor="#F5F5F5">&nbsp;</td>
        <td><input type="submit" name="submitButtonName" value="Add" border="0"></td>
      </tr>
    </form>
  </table>
 </div><?
}//main()
include "template.php";
?>

