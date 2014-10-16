<?php
include_once("logincheck.php");
include_once("../myconnect.php");

////////--------
		$sbq_emp_chk1="select * from sbjbs_employers where sb_search_allowed='no' and TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) > 0  and sb_id=".$_SESSION["sbjbs_emp_userid"];
		// and TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) >0";
		$sbrow_emp_chk1=mysql_fetch_array(mysql_query($sbq_emp_chk1));
		if($sbrow_emp_chk1)
		{		//search enabled means add the duration
			header ("Location: gen_confirm_mem.php?errmsg=".urlencode("This facility is disabled for your account by admin"));
			die();

		}	


///////------------getting money in account-------/////////
$sbq_tra="select sum(sb_amount) as sb_total_balance from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"];
$sbrow_tra=mysql_fetch_array(mysql_query($sbq_tra));
if(!$sbrow_tra)
{
	$sb_total_balance=0;
}
else
{
	$sb_total_balance=$sbrow_tra["sb_total_balance"];
}
//////////////--------end of getting money---------------////

$sbq_con="select * from sbjbs_config where sb_id=1";
$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));

$sb_fee_currency=$sbrow_con['sb_fee_symbol'];
$sb_fee_currency_name=$sbrow_con['sb_fee_code'];


/*
$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$sbrow_con['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/
$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
	
	if ( !isset($_REQUEST["plan_id"]) || !is_numeric($_REQUEST["plan_id"]) || ($_REQUEST["plan_id"] < 1))
	{
		$errs[$errcnt]="Plan must be selected";
   		$errcnt++;
	}
	else
	{
		$sbq_plan="select * from sbjbs_plans where id=".$_REQUEST["plan_id"];
		$sbrow_plan=mysql_fetch_array(mysql_query($sbq_plan));
		if(!$sbrow_plan)
		{
			$errs[$errcnt]="Valid Plan must be selected";
   			$errcnt++;
		}
		else
		{
			if( ($sbrow_plan["price"] > 0) && ($sbrow_plan["price"] > $sb_total_balance) )
			{
				header ("Location: gen_confirm_mem.php?errmsg=".urlencode("You do not have sufficient funds, please add some money first"));
				die();
			}
		}
	}
if($errcnt==0)
{
	$approved="yes";
//	$sb_msg='You have been made premium member.';
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	
		$sb_uid=$_SESSION["sbjbs_emp_userid"];
		$sb_date=date("YmdHis",time());
		$sb_duration=$sbrow_plan["credits"];
		
		$sbq_emp_chk="select *, TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) as sb_expiry from sbjbs_employers where sb_search_allowed='yes' and sb_id=$sb_uid and TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) >0";
		$sbrow_emp_chk=mysql_fetch_array(mysql_query($sbq_emp_chk));
		if($sbrow_emp_chk)
		{		//search enabled means add the duration
			$sb_duration+=$sbrow_emp_chk["sb_expiry"];
		}	
		
//		DATE_ADD('$data_time',INTERVAL 1 YEAR)
		$insert_query="update sbjbs_employers set sb_search_allowed='yes', sb_search_expiry=DATE_ADD($sb_date,INTERVAL $sb_duration DAY) where sb_id=$sb_uid";
//	echo($insert_query);
		mysql_query($insert_query);
		if(mysql_affected_rows()>0)
		{	//success
///add to transactions
			
			if( $sbrow_plan["price"] > 0 )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_plan["price"].", 'Enabled resume search for ".$sbrow_plan["credits"]." days', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
///////////-------------------end mail to admin			
			header("Location: gen_confirm_mem.php?errmsg=".urlencode("Search has been enabled for ".$sbrow_plan["credits"]." days"));
			die();
		}
		else
		{	//failed
			header("Location: gen_confirm_mem.php?err=enable_search&errmsg=".urlencode("unable to complete operation, please try again"));
			die();
		}	
				
	}// end if no errs
}//if form posted

function main()
{
	global $errs, $errcnt, $sb_fee_currency;
	
//		$sb_duration=0;
		$sbq_emp_chk="select *, TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) as sb_expiry from sbjbs_employers where sb_search_allowed='yes' and sb_id=".$_SESSION["sbjbs_emp_userid"];// and TO_DAYS(sb_search_expiry) - TO_DAYS(NOW()) >0";
		$sbrow_emp_chk=mysql_fetch_array(mysql_query($sbq_emp_chk));
		if($sbrow_emp_chk)
		{		//search enabled means add the duration
			$sb_duration=$sbrow_emp_chk["sb_expiry"];
		}	
	$sbq_plan="select * from sbjbs_plans where 1";
	$sbrs_plan=mysql_query($sbq_plan);
	$sbrow_count=mysql_num_rows($sbrs_plan);
?>
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
      <form name="form123" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
                <tr class="titlestyle"> 
                  <td >&nbsp;Make Search Available</td>
                </tr>
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="5">
                <?php if($sbrow_emp_chk)	{ ?>
                <tr valign="top"> 
                  <td colspan="2" class="innertablestyle"><font class="normal">&nbsp;Your 
                    Resume Search facility 
                    <?php 	if($sb_duration>=0)
				echo ($sb_duration!=1)?" expires in $sb_duration days":" expires in $sb_duration day";
			else
				echo (abs($sb_duration)!=1)?" expired ".abs($sb_duration)." days ago":" expired ".abs($sb_duration)." day ago"; ?>
                    .</font></td>
                </tr>
                <?php 	}	//end if $sbrow_emp_chk ?>
                <?php 	if( $sbrow_count > 0 )	
		  			{
						$cnt=0;
						while($sbrow_plan=mysql_fetch_array($sbrs_plan))
						{
							$cnt++;
							?>
                <tr valign="top"> 
                  <td width="24%" align="right" class="innertablestyle">&nbsp;</td>
                  <td width="76%"><input type="radio" name="plan_id" value="<?php echo $sbrow_plan["id"]; ?>" <?php echo($cnt==1)?'checked':''; ?> > 
                    <font class="normal">Plan <?php echo $cnt; ?> <strong>(<?php echo "$sb_fee_currency ".$sbrow_plan["price"]." for ".$sbrow_plan["credits"]." days"; ?>)</strong></font> 
                  </td>
                </tr>
                <?php 		}	//end while sbrow_plan	
		  			}	//end if record found
		  			else
					{?>
                <tr valign="top"> 
                  <td colspan="2" class="innertablestyle"><font class="normal">No 
                    plans have been defined</font> </td>
                </tr>
                <?php 	}	//end else no record found			?>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle">&nbsp;</td>
                  <td><input type="submit" name="Submit" value="Done"></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <p align="center">&nbsp;</p>
        </form>
</td>
  </tr>
</table>
<?
}  //End of main
include_once("template.php");
?>