<?
include "logincheck.php";
include "myconnect.php";
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////
		if(count($_POST)>0)
		{
			if (!get_magic_quotes_gpc()) {
			$multiple=str_replace('$', '\$',addslashes($_REQUEST["multiple"]));
			}
			else
			{
			$multiple=str_replace('$', '\$',$_REQUEST["multiple"]);
			}
			$id=(int)$_REQUEST["id"];
			$cur_id=(int)$_REQUEST["cur_id"];

			if(strlen(trim($multiple))==0)
			{
		header("Location: "."delete_currency.php?id=$id&msg=".urlencode("Please Specify Multiplication Factor."));
		die();
			}
		/*changing jobs */
		mysql_query("update	sbjbs_jobs set sb_max_salary=sb_max_salary*$multiple,
		sb_min_salary=sb_min_salary*$multiple, sb_currency=$cur_id where sb_currency=$id");
		/*changing resumes */
		mysql_query("update	sbjbs_resumes set sb_salary=sb_salary*$multiple, sb_salary_currency=$cur_id
		where sb_salary_currency=$id");
			
		mysql_query("delete from sbjbs_currencies where sbcur_id=".$_REQUEST["id"]);
		header("Location: "."manage_currency.php?msg=".urlencode("Currency has been removed from the list."));
		die();
		}

function main()
{
$id=$_REQUEST["id"];
$cur=mysql_fetch_array(mysql_query("select * from sbjbs_currencies where sbcur_id=$id"));
$num=mysql_num_rows(mysql_query("select sb_id from sbjbs_resumes where sb_salary_currency=$id"));
$num+=mysql_num_rows(mysql_query("select sb_id from sbjbs_jobs where sb_currency=$id"));
?>
<script language="JavaScript">
function validate(form)
{
	if(form.multiple.value=="" || isNaN(form.multiple.value) || form.multiple.value<=0)
	{
	alert('Please specify Multiplication Factor as a non-zero positive number');
	return false;
	}
	return true;
}
</script>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td valign="top"> <form name="form2" method="post" action="delete_currency.php" onSubmit="return validate(this);">
        <div align="right"> 
          <table width="100%" border="0" cellspacing="10" cellpadding="2">
            <tr align="left" bgcolor="#004080"> 
              <td height="25" colspan="2"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Delete 
                Currency&nbsp; <font color="#FFCC00"><? echo $cur["sbcur_name"];?></font></strong></font></td>
            </tr>
            <tr align="center" bgcolor="#F5F5F5"> 
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Total 
                <strong><? echo $num;?></strong> listings have been posted with 
                currency <strong><? echo $cur["sbcur_name"];?></strong>. Please 
                provide followings to delete the currency. Currency of existing 
                listings will be changed to Alternate Currency and the corresponding fields will be multiplied with multiplication factor.</font></td>
            </tr>
            <tr> 
              <td width="40%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Alternate 
                Currency:</font></strong></td>
              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                <select name="cur_id">
                  <?
			  $cats=mysql_query("select * from sbjbs_currencies where sbcur_id<>$id ");
			  while($rst=mysql_fetch_array($cats))
			  {
			  		  ?>
                  <option value="<? echo $rst["sbcur_id"]; ?>"><? echo $rst["sbcur_name"]."&nbsp;(".$rst["sbcur_symbol"].")"; ?></option>
                  <?
					}//end while
					 ?>
                </select>
                </font></td>
            </tr>
            <tr> 
              <td width="40%" height="28" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Multiplication 
                Factor:</font></strong></td>
              <td><input name="multiple" type="text" id="multiple" value="1" size="4"></td>
            </tr>
            <tr> 
              <td width="40%" align="right" bgcolor="#F5F5F5">&nbsp;</td>
              <td><input name="id" type="hidden" id="id" value="<? echo $_REQUEST["id"];?>">
                <input type="submit" name="yes" value="Delete" ></td>
            </tr>
            <tr align="center" bgcolor="#F5F5F5"> 
              <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong>This 
                operation is non reversible. Once changed, information can't be 
                restored.</strong></font></td>
            </tr>
          </table>
        </div>
      </form></td>
  </tr>
</table>
<?
} //end of main

include "template.php";?>
