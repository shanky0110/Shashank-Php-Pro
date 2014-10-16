<?
include "logincheck.php";
include_once "../myconnect.php";

function main()
{
$balance=mysql_fetch_array(mysql_query("select sum(sb_amount) as total from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"]));
if($balance["total"]=="")
{
$balance["total"]=0;
}
$rs_a=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
//$sbq_con="select * from sbjbs_config where sb_id=1";
//$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
$sb_fee_currency=$rs_a['sb_fee_symbol'];
$sb_fee_currency_name=$rs_a['sb_fee_code'];
/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$rs_a['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/

?>
<script language="JavaScript">
function Validate(form)
{

if(isNaN(form.amount.value) || (form.amount.value== "") || form.amount.value<=0)
{
alert (' Enter a numeric value (greater than 0) for money!');
return false;
}
return true;
}

function Validate1(form)
{

if(isNaN(form.total.value) || (form.total.value== "") || form.total.value<=0)
{
alert (' Enter a numeric value (greater than 0) for money!');
return false;
}
return true;
}
</script>
 
<table width="100%" border="0" cellpadding="0" cellspacing="0" dwcopytype="CopyTableRow">
  <tr> 
    <td valign="top"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td align="center" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td valign="top"> 
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post"  onSubmit="return Validate(this);"><!--form action="ipn.php" method="post"  onSubmit="return Validate(this);"-->
                    <div align="center">
                      <table width="85%" border="0" cellspacing="0" cellpadding="0" class="onepxtable">
                        <tr> 
                          <td align="left" valign="middle" class="titlestyle">&nbsp;Add 
                            Money Through Paypal</td>
                        </tr>
                        <tr> 
                          <td><table width="100%" border="0" cellpadding="2" cellspacing="5">
                              <tr> 
                                <td align="center" valign="middle" class="innertablestyle"> 
                                  <div align="left"><font class='normal'><strong>Your 
                                    current balance is <?php echo $sb_fee_currency;
							  printf(" %0.2f",$balance["total"]);?></strong></font></div></td>
                              </tr>
                              <tr> 
                                <td align="center" valign="middle" class="innertablestyle"> 
                                  <div align="left"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                                    <input type="hidden" name="description" value="Added Money To Your Account">
                                    </strong></font><font class='normal'><strong>Add 
                                    <?php echo $sb_fee_currency; ?> 
                                    <input name="amount" type="text" id="amount"  size="6">
                                    to my account</strong></font> </div></td>
                              </tr>
                              <tr> 
                                <td align="center" class="innertablestyle"> <div align="left"> 
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="business" value="<?php echo $rs_a["sb_paypal_id"]; ?>">
                                    <input type="hidden" name="item_name" value="Add Money to account">
                                    <input type="hidden" name="item_number" value="P1">
                                    <input type="hidden" name="custom" value="<?php echo $_SESSION["sbjbs_emp_userid"] ?>">
                                    <input type="hidden" name="return" value="<?php echo $rs_a["sb_site_root"]; ?>/employer/thanks.php">
                                    <input type="hidden" name="cancel_return" value="<?php echo $rs_a["sb_site_root"]; ?>/employer/cancelpurchase.php">
                                    <input type="hidden" name="rm" value="2">
                                    <input type="hidden" name="notify_url" value="<?php echo $rs_a["sb_site_root"]; ?>/employer/ipn/ipn.php">
                                    <input type="hidden" name="no_note" value="1">
                                    <input type="hidden" name="currency_code" value="<?php echo $sb_fee_currency_name;?>">
                                    <input type="submit" name="Submit" value="Continue to Paypal Payment">
                                  </div></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                      
                    </div>
                  </form></td>
              </tr>
            </table>
            <br> </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
  <?
}// end main
include "template.php";
?>