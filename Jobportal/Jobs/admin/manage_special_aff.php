<?
include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
?>
<?php 
$sbad_type=$_REQUEST["sbad_type"];
if( (isset($_REQUEST["sbad_type"])) && ($_REQUEST["sbad_type"] == 'top') )
{
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#004080"> 
          <td height="25"> <div align="right"></div>
            <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
            Affiliate Àdvertisements</font></strong><font color="#FFFFFF">&nbsp;</font><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="11">&nbsp;</td>
          <td width="100%" valign="top"><table width="100%" border="0">
              <tr> 
                <td valign="top"> <table width="100%" border="0">
                    <tr> 
                      <td><font size="1" face="Arial, Helvetica, sans-serif">The 
                        affiliate àdvertisements require text which is given by 
                        some Affiliate partner e.g. google adwords gives to display 
                        their àdvertisements.</font></td>
                    </tr>
                    <tr>
                      <td align="right"><font size="1" face="Arial, Helvetica, sans-serif">[ <a href="add_aff.php?sbad_type=top" class="sbsidelink">Insert 
                        New Affiliate</a> ]</font></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0">
              <tr> 
                <td><table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <?
	$sql="select * from sbjbs_affiliate_banner where 1 order by sbaff_id desc";
	$rs0_query=mysql_query ($sql);
	if(mysql_num_rows($rs0_query) > 0)
	{
$cnt=0;
while ($rs0=mysql_fetch_array($rs0_query))
{
$cnt++;
?>
                    <tr bgcolor="<? if($cnt%2) echo "#F5F5F5"; else echo "#FFFFFF";?>"> 
                      <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr> 
                            <td><div align="center"><?php echo $rs0["sbaff_text"];?></div></td>
                          </tr>
                          <tr> 
                            <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;<? echo  $rs0["sbaff_title"]; ?>&nbsp;&nbsp; 
                              <? 
							if($rs0["sbaff_active"]=="yes")
							echo "Approved";
							else
							echo "Waiting Approval"; ?>
                              </strong></font></td>
                          </tr>
                          <tr> 
                            <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;[ 
                              <a href="editaff.php?id=<?php echo $rs0["sbaff_id"]; ?>&sbad_type=<?php echo $sbad_type; ?>" class="sbsidelink">Edit</a> 
                              ]&nbsp;[ <a href="delete_aff.php?id=<?php echo $rs0["sbaff_id"]; ?>&sbad_type=<?php echo $sbad_type; ?>" class="sbsidelink" onClick="javascript:return confirm('Do you really want to delete the affiliate ad');" >Delete</a> 
                              ]</font></td>
                          </tr>
                        </table></td>
                    </tr>
                    <?
 }
 ?>
                    <?php	
  	}		//end if mysql_num_rows($rs0_query) > 0
	else
	{?>
                    <tr> 
                      <td height="25"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;No 
                        Affiliate Àdvertisement exists</font></strong></td>
                    </tr>
                    <?php	
	}
		//end else ?>
                  </table></td>
              </tr>
            </table></td>
          
          <td width="13">&nbsp;</td>
        </tr>
        <tr  height="12" > 
          <td height="12" >&nbsp;</td>
          <td height="12"></td>
          <td height="12">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php 
}		// end if
}//main()
include "template.php";
?>
