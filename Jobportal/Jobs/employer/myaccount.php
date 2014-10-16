<?php
include "logincheck.php";
include_once "../myconnect.php";
include_once "../date_time_format.php";


function main()
{


//--------generating default dates
	  	$from_date="";	
		$current_month=date("m",time());
		$current_year=date("Y",time());
		$initial_date=date ("YmdHis", mktime (0,0,0,$current_month,1,$current_year));
		
//		$initial_date_display=mktime (0,0,0,$current_month,1,$current_year);
		
		$lastday_str = mktime (0,0,0,$current_month+1,0,$current_year);
		$lastday= strftime ("%d", $lastday_str);
		
		$final_date=date ("YmdHis", mktime (23,59,59,$current_month,$lastday,$current_year));
//		$final_date_display=mktime (0,0,0,$current_month,$lastday,$current_year);
///----------end generating defalut dates
/////------------------------initializing variable with default values
		$from_day=1;	
		$from_month=$current_month;
		$from_year=$current_year;
		$to_day=date("d",time());
		$to_month=$current_month;
		$to_year=$current_year;
/////-----------------end initializing variable with default values


	if(count($_POST)<>0)		//IF SOME FORM WAS POSTED populate variables
	{
		$from_day=$_REQUEST["from_day"];
		$from_month=$_REQUEST["from_month"];
		$from_year=$_REQUEST["from_year"];
		$to_day=$_REQUEST["to_day"];
		$to_month=$_REQUEST["to_month"];
		$to_year=$_REQUEST["to_year"];
	}

	
		if($to_day!=0 && $to_month!=0 && $to_year!=0)
		{
			$final_date= date("YmdHis", mktime (23,59,59,$to_month,$to_day,$to_year));	
//			$final_date_display=mktime (0,0,0,$to_month,$to_day,$to_year);
		}
		
		if($from_day!=0 && $from_month!=0 && $from_year!=0)
		{
			$initial_date=date("YmdHis", mktime (0,0,0,$from_month,$from_day,$from_year));	
//			$initial_date_display=mktime (0,0,0,$from_month,$from_day,$from_year);
		}
		elseif($to_day!=0 && $to_month!=0 && $to_year!=0)
		{
			$initial_date=date("YmdHis", mktime (0,0,0,1,1,2000));
//			$initial_date_display=mktime (0,0,0,1,1,2000);
		}

	$sbdate_str="and ((sb_date_submitted >= $initial_date and sb_date_submitted <= $final_date)";
	$sbdate_str.="or (sb_date_submitted <= $initial_date and sb_date_submitted >= $final_date))";	//just to counter the problem that from date must be less then to date

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
//$sbq_con="select * from sbjbs_config where sb_id=1";
//$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];

/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$config['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/
$sbquery="select *,UNIX_TIMESTAMP(sb_date_submitted) as t from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"]." $sbdate_str order by sb_id";
//echo $sbquery;
$sql=mysql_query($sbquery);
$rst=mysql_fetch_array($sql);

$balance=mysql_fetch_array(mysql_query("select sum(sb_amount) as total from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"]));
if(!$balance || $balance["total"]==0 )
	$balance["total"]=0.00;
?>
<?php ///////////////////////////////?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
  <tr>
    <td class="titlestyle">&nbsp;Choose Dates </td>
  </tr>
  <tr> 
    <td>
        <table width="100%" border="0" cellpadding="2" cellspacing="5">
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <tr valign="top"> 
            <td width="40%" align="right" class="innertablestyle"><strong><font class="normal">From</font></strong></td>
            <td width="60%"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="11%"><font class="smalltext">Day</font></td>
                  <td width="12%"><font class="smalltext">Month</font></td>
                  <td width="77%"><font class="smalltext">Year</font></td>
                </tr>
                <tr> 
                  <td><select name="from_day" id="select">
                      <option value="0">-</option>
                      <?php 	for($i=1;$i<=31;$i++)
						{
							echo "<option value=\"$i\"";
							if($from_day == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                  <td><select name="from_month" id="select2">
                      <option value="0">-</option>
                      <?php 	for($i=1;$i<=12;$i++)
						{
							echo "<option value=\"$i\"";
							if($from_month == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                  <td><select name="from_year" id="select3">
                      <option value="0">-</option>
                      <?php 	for($i=2000;$i<=2010;$i++)
						{
							echo "<option value=\"$i\"";
							if($from_year == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                </tr>
              </table></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><strong><font class="normal">To</font></strong></td>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="11%"><select name="to_day" id="select4">
                      <option value="0">-</option>
                      <?php 	for($i=1;$i<=31;$i++)
						{
							echo "<option value=\"$i\"";
							if($to_day == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                  <td width="12%"><select name="to_month" id="select5">
                      <option value="0">-</option>
                      <?php 	for($i=1;$i<=12;$i++)
						{
							echo "<option value=\"$i\"";
							if($to_month == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                  <td width="77%"><select name="to_year" id="select6">
                      <option value="0">-</option>
                      <?php 	for($i=2000;$i<=2010;$i++)
						{
							echo "<option value=\"$i\"";
							if($to_year == $i)
								echo 'selected';
							echo ">$i</option>"; 
						}						?>
                    </select></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td  class="innertablestyle">&nbsp;</td>
            <td width="60%"> <input type="submit" name="Submit" value="Show"></td>
          </tr></form>
        </table>
      </td>
  </tr>
</table>
<?php ///////////////////////////////?>
<br>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr> 
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><font class="normal"><div align="center"><font class="red"><strong>Your current balance 
              is <?php echo $sb_fee_currency.' '.$balance["total"];?></strong></font> <a href="addmoney.php">Add 
              Money</a></div></font></td>
        </tr>
        <tr> 
          <td valign="top"> <div align="center"> 
              <table width="98%" border="0" cellpadding="1" cellspacing="0">
                <tr> 
                  <td align="center" valign="middle"> 
                    <? if ($rst)
				  {
				  ?>
                    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="onepxtable">
                      <tr align="center" class="titlestyle"> 
                        <td height="25" align="left">&nbsp;Amount</td>
                        <td align="left">&nbsp;Date</td>
                        <td align="left">&nbsp;Description</td>
                      </tr>
                      <?
					  $cnt=0;
                      while($rst)
					  {
					  ?>
                      <tr align="center"> 
                        <td align="left" class="<? if($cnt%2<>0){echo "innertablestyle"; }else{echo "alternatecolor";}?>"><font class="smalltext"> 
                          &nbsp; 
                          <? 
					  if($rst["sb_amount"]>0)
					  {
					  echo $sb_fee_currency.' '.$rst["sb_amount"];
					  }
					  else
					  {
					  echo "<font class='red'>($sb_fee_currency ".$rst["sb_amount"]*(-1).")</font>";
					  }?>
                          </font></td>
                        <td align="left" class="<? if($cnt%2<>0){echo "innertablestyle"; }else{echo "alternatecolor";}?>"><font class="smalltext">&nbsp; 
                          <?
						 echo sb_date($rst["t"]);?>
                          </font></td>
                        <td align="left" class="<? if($cnt%2<>0){echo "innertablestyle"; }else{echo "alternatecolor";}?>"><font class="smalltext">&nbsp;<? echo $rst["sb_description"];?></font></td>
                      </tr>
                      <?
					  $rst=mysql_fetch_array($sql);
        			  $cnt++;            
					}// end while
					?>
                    </table>
                    <?
					 }// end transaction found
					 else
					 {
					 //////////////////////////////////////////////////////------------------
					?>
                    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="onepxtable">
                      <tr align="center" class="titlestyle"> 
                        <td height="25" align="left">&nbsp;Transactions</td>
                      </tr>
                      <tr align="center"> 
                        <td align="left" class="innertablestyle"><font class="normal">&nbsp;No 
                          transaction found satisfying your criteria.</font></td>
                      </tr>
                    </table>
                    <?php 
					/////////////////////////////////////////////////////------------------------------------------
					}	//end else i.e. no transaction found ?>
                  </td>
                </tr>
                <tr> 
                  <td align="center">&nbsp; </td>
                </tr>
              </table>
            </div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<?
}// end main
include "template.php";
?>