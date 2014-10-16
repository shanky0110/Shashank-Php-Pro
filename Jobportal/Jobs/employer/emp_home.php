<?php
include_once "logincheck.php";

include_once "../session.php";

function main()
{
$id=0;
if(isset($_SESSION["sbjbs_emp_userid"]))
{
$id=$_SESSION["sbjbs_emp_userid"];
}
if(isset($_REQUEST["tmp"]))
{
$id=$_REQUEST["tmp"];
}
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
//$config["null_char"]="-";
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" dwcopytype="CopyTableCell">
  <tr> 
    <td valign="top">&nbsp;</td>
  </tr>
  <tr align="center"> 
    <td align="right" valign="top"> <table width="95%" border="0" cellspacing="0" cellpadding="0" class="maintablestyle" align="center">
        <tr> 
          <td width="100%" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
                    <tr> 
                      <td height="25" class="titlestyle"><div align="left">&nbsp;User 
                          Statistics</div></td>
                    </tr>
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="5">
                    <tr> 
                      <td width="48%" height="25" class="innertablestyle"><div align="right"><strong><font class='normal'>&nbsp;Total 
                          Number of Job Offers Posted</font></strong></div></td>
                      <td width="52%"><font class='normal'><strong> 
                        <?php 
			$sbq_off="select * from sbjbs_jobs where sb_uid=".$_SESSION["sbjbs_emp_userid"];
			$sbrs_off=mysql_query($sbq_off);
			echo mysql_num_rows($sbrs_off);
			$sbjob_id_str='-1';
			while($sbrow_off=mysql_fetch_array($sbrs_off))
				$sbjob_id_str.=','.$sbrow_off["sb_id"];
			 ?>
                        </strong></font></td>
                    </tr>
                    <tr> 
                      <td height="25" class="innertablestyle"><div align="right"><strong><font class='normal'>&nbsp;Total 
                          Applications Received</font></strong></div></td>
                      <td><strong><font color="#FF6600" size="2" face="Arial, Helvetica, sans-serif"> 
                        </font><font class='normal'> 
                        <? 
				  $num=mysql_num_rows(mysql_query("select * from sbjbs_applications where sb_job_id in ($sbjob_id_str)"));
				  
				  echo $num;
				  
				  ?>
                        </font></strong></td>
                    </tr>
                  </table></td>
              </tr>
            </table> 
            
          </td>
        </tr>
      </table>
      <br> </td>
  </tr>
</table>
<?
}// end main
include_once "template.php";
?>