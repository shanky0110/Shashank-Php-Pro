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
			$id=(int)$_REQUEST["id"];
			$type_id=(int)$_REQUEST["type_id"];

		/*changing profiles */
//		mysql_query("update	sbjbs_job_skls set sb_sid=$type_id where sb_sid=$id");
		mysql_query("update	sbjbs_companies set sb_industry=$type_id where sb_industry=$id");
		
			
		mysql_query("delete from sbjbs_industries where sb_id=".$_REQUEST["id"]);
		header("Location: "."manage_industry.php?msg=".urlencode("Industry has been removed from the list."));
		die();
		}

function main()
{
$id=$_REQUEST["id"];
$cur=mysql_fetch_array(mysql_query("select * from sbjbs_industries where sb_id=$id"));
//$num=mysql_num_rows(mysql_query("select sb_id from sbjbs_job_skls where sb_sid=$id"));
$num=mysql_num_rows(mysql_query("select sb_id from sbjbs_companies where sb_industry=$id"));
?>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td valign="top"> <form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        <div align="right"> 
          <table width="100%" border="0" cellspacing="10" cellpadding="2">
            <tr align="left" bgcolor="#004080"> 
              <td height="25" colspan="2"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Delete 
                Industry&nbsp;<font color="#FFCC00"><? echo $cur["sb_name"];?></font></strong></font></td>
            </tr>
            <tr align="center" bgcolor="#F5F5F5"> 
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Total 
                <strong><? echo $num;?></strong> listings have been posted with 
                Industry <strong><? echo $cur["sb_name"];?></strong>.Industry 
                of existing listings will be changed to Alternate Industry.</font></td>
            </tr>
            <tr> 
              <td width="40%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Alternate 
                Industry:</font></strong></td>
              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                <select name="type_id">
                  <?
			  $cats=mysql_query("select * from sbjbs_industries where sb_id<>$id ");
			  while($rst=mysql_fetch_array($cats))
			  {
			  		  ?>
                  <option value="<? echo $rst["sb_id"]; ?>"><? echo $rst["sb_name"]; ?></option>
                  <?
					}//end while
					 ?>
                </select>
                </font></td>
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
