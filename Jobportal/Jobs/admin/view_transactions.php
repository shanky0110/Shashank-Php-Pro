<?
include "logincheck.php";
include_once "myconnect.php";


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

$strpass="";
	if(isset($_REQUEST["from_day"]) && isset($_REQUEST["from_month"]) && isset($_REQUEST["from_year"]) && isset($_REQUEST["to_day"]) && isset($_REQUEST["to_month"]) && isset($_REQUEST["to_year"]) )		//IF SOME FORM WAS POSTED populate variables
	{
		$from_day=$_REQUEST["from_day"];
		$from_month=$_REQUEST["from_month"];
		$from_year=$_REQUEST["from_year"];
		$to_day=$_REQUEST["to_day"];
		$to_month=$_REQUEST["to_month"];
		$to_year=$_REQUEST["to_year"];

	$strpass="&from_day=".$_REQUEST["from_day"];
	$strpass.="&from_month=".$_REQUEST["from_month"];
	$strpass.="&from_year=".$_REQUEST["from_year"];
	$strpass.="&to_day=".$_REQUEST["to_day"];
	$strpass.="&to_month=".$_REQUEST["to_month"];
	$strpass.="&to_year=".$_REQUEST["to_year"];
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

$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];


$recperpage=$config["sb_recperpage"];

if(isset($_REQUEST["recperpage"]))
{
$recperpage=$_REQUEST["recperpage"];
$strpass.="&recperpage=".$_REQUEST["recperpage"];
}

$label="Billing Transactions ";
$sql="select *,DATE_FORMAT(sb_date_submitted,'%D %b,%Y') as t from sbjbs_transactions where 1 $sbdate_str ";
if(isset($_REQUEST["sb_id"])&&($_REQUEST["sb_id"]<>""))
{
$sql.=" and sb_uid=".$_REQUEST["sb_id"];
$strpass.="&sb_id=".$_REQUEST["sb_id"];
$mem=mysql_fetch_array(mysql_query("select sb_username from sbjbs_employers where sb_id=".$_REQUEST["sb_id"]));
$balance=mysql_fetch_array(mysql_query("select sum(sb_amount) from sbjbs_transactions where sb_uid=".$_REQUEST["sb_id"]));
if($balance[0]=="")
{
$balance[0]=0;
}
$label="Billing Transactions of Employer <font color='#FFCC00'>".$mem["sb_username"]."</font><font size=1>&nbsp;( current balance = $sb_fee_currency ".$balance[0].")</font>";

}
$sql.=" order by sb_id desc";
$query=mysql_query($sql);
$rs_query=mysql_fetch_array($query);
///////////////////////////////////PAGINATION /////////
	if(!isset($_REQUEST["pg"]))
	{
			$pg=1;
	}
	else 
	{
	$pg=$_REQUEST["pg"];
	}

$rcount=mysql_num_rows($query);

if ($rcount==0 )
{ 
	$pages=0;
}	
else
{
	$pages=floor($rcount / $recperpage);
	if  (($rcount%$recperpage) > 0 )
	{
		$pages=$pages+1;
	}
}
$jmpcnt=1;
while ( $jmpcnt<=($pg-1)*$recperpage  && $rs_query = mysql_fetch_array($query) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}

////////////////////////////////////////////////////////////////////////
?> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td valign="top">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
              <tr> 
                <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
                  Transactions</strong></font></td>
              </tr>
              <form name="search_form" action="view_transactions.php" method="post" >
                <tr valign="top"> 
                  <td align="right" bgcolor="#F5F5F5" class="innertablestyle"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="normal">From:</font></strong></td>
                  <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="11%"><font size="2" face="Arial, Helvetica, sans-serif" class="smalltext">Day</font></td>
                        <td width="12%"><font size="2" face="Arial, Helvetica, sans-serif" class="smalltext">Month</font></td>
                        <td width="77%"><font size="2" face="Arial, Helvetica, sans-serif" class="smalltext">Year</font></td>
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
                  <td align="right" bgcolor="#F5F5F5" class="innertablestyle"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="normal">To:</font></strong></td>
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
                  <td width="50%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Employer:</font></strong></td>
                  <td><select name="sb_id" id="sb_id">
                      <option value="" selected >All Employers</option>
                      <?
			  $cats=mysql_query("select * from sbjbs_employers order by sb_id");
			  while($rst=mysql_fetch_array($cats))
			  {
			  		  ?>
                      <option value="<? echo $rst["sb_id"]; ?>" <? 
					  if(isset($_REQUEST["sb_id"])&&($_REQUEST["sb_id"]==$rst["sb_id"]))
					  {
					  echo " selected";
					  }
					  ?>> 
                      <? 
					  echo $rst["sb_username"]; ?>
                      </option>
                      <?
					}//end while
					 ?>
                    </select></td>
                </tr>
                <tr> 
                  <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Record 
                      Per Page:</font></strong></div></td>
                  <td><select name="recperpage">
                      <option value="<?php echo $config["sb_recperpage"];?>" <? 
				if($recperpage==$config["sb_recperpage"]) { echo "selected";}?>>Default</option>
                      <option value="10" <? if($recperpage==10) { echo "selected";}?>>10</option>
                      <option value="20" <? if($recperpage==20) { echo "selected";}?>>20</option>
                      <option value="30" <? if($recperpage==30) { echo "selected";}?>>30</option>
                      <option value="50" <? if($recperpage==50) { echo "selected";}?>>50</option>
                      <option value="100" <? if($recperpage==100) { echo "selected";}?>>100</option>
                    </select></td>
                </tr>
                <tr> 
                  <td bgcolor="#F5F5F5">&nbsp;</td>
                  <td><input type="submit" name="Submit2" value="Search"></td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
              <tr> 
                <td height="25" align="left" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;<? echo $label;?></strong></font></td>
              </tr>
              <tr> 
                <td align="center" valign="top"> 
                  <? if ($rs_query)
				  {
				  ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr align="left"> 
                      <td height="20" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Amount</font></strong></td>
                      <td height="20" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Date</font></strong></td>
                      <td height="20" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Username 
                        </font></strong></td>
                      <td width="30%" height="20" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Description</font></strong></td>
                      <td height="20" align="center" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Options</font></strong></td>
                    </tr>
                    <?
					  $cnt=0;
                      while($rs_query && ($cnt<$recperpage))
					  {
					    $mem=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_id=".$rs_query["sb_uid"]));
					  ?>
                    <tr align="center" <? if($cnt%2<>0) echo "bgcolor='#EEEEEE'";?>> 
                      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                        <? 
					  if($rs_query["sb_amount"]>0)
					  {
					  echo "$sb_fee_currency ".$rs_query["sb_amount"];
					  }
					  else
					  {
					  echo "<font color='#FF0000'>(".$sb_fee_currency;
					  printf("%.2f",$rs_query["sb_amount"]*(-1));
					  echo ")</font>";
					  }?>
                        </font></td>
                      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
						echo $rs_query["t"];
					?>
                        </font></td>
                      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $mem["sb_username"];?></font></td>
                      <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"><? echo str_replace("Your","his/her",$rs_query["sb_description"]);?></font></td>
                      <td width="184" align="center"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><a href="add_transaction.php?id=<? echo $rs_query["sb_uid"];?>">Add</a> 
                          <a href="edit_transaction.php?id=<? echo $rs_query["sb_id"];?>">Edit</a> 
                          <a href="delete_transaction.php?id=<? echo $rs_query["sb_id"];?>">Delete</a> 
                          </font></div></td>
                    </tr>
                    <?
					  $rs_query=mysql_fetch_array($query);
        			  $cnt++;            
					}// end while
					?>
                  </table>
                  <?
					 }// end if not any transaction
					 else
					 {
					 echo "<font size='2' face='Arial, Helvetica, sans-serif'>No transaction found.</font>";
					 }
					?>
                </td>
              </tr>
              <tr> 
                <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td height="25" bgcolor="#004080"> 
                        <p> <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Pages: 
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                          <?

if ($pg>1) 
{
      echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".($pg-1).$strpass."' class='pagelink'><font color='#FFCC00'>"; 
    
}//end if
if ($pages<>1)
echo "Previous";
if ($pg>1)
{
echo "</font></a>&nbsp;";
}//end if
echo " ";
for ($i=1; $i<=$pages; $i++)
{
	if ($pg<>$i)
	{
	echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".$i.$strpass."' class='pagelink'><font color='#FFCC00'>"; 
	echo $i; 
    echo "</font></a>&nbsp;";
	}
	else
	{
	echo "&nbsp;".$i."&nbsp;";
	}
}//for
echo " ";
	if ($pg<$pages )
	{
	echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".($pg+1).$strpass."' class='pagelink'><font color='#FFCC00'>"; 
	}//end if
	if ($pages<>1)
	{
	echo "Next";
	}//end if
	if ($pg<>($pages))
	{
    echo "</font></a>&nbsp;"; 
	}//end if
?>
                          </font> </strong> </font></p></td>
                    </tr>
                  </table></td>
              </tr>
            </table> </td>
        </tr>
      </table></td>
  </tr>
</table>
<?
}// end main
include "template.php";
?>
