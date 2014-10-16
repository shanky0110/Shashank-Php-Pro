<?
include_once("logincheck.php");
include_once("myconnect.php");
function main()
{
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
            Bànner Àdvertisements</font></strong><font color="#FFFFFF">&nbsp;</font><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="11">&nbsp;</td>
          <td width="100%" valign="top"><table width="100%" border="0">
              <tr> 
                <td><table width="100%" border="0">
                    <tr> 
                      <td><font size="1" face="Arial, Helvetica, sans-serif">Bànner 
                        àdvertisements require a Bànner URL (i.e.URL of the image 
                        to be displayed) &amp; URL (i.e. the place where the visitor 
                        is supposed to be taken after clicking on the àdvertisement).</font></td>
                    </tr>
                    <tr> 
                      <td align="right"><font size="1" face="Arial, Helvetica, sans-serif" color="#000000">[ <a href="addad.php?sbad_type=<?php echo $sbad_type; ?>" class="sbsidelink"><font size="1" face="Arial, Helvetica, sans-serif">Insert 
                        New Bànner</font></a> ]</font></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="2" cellspacing="2">
              <?
	$sql="select * from sbjbs_ads where 1 order by id desc";
	$rs0_query=mysql_query ($sql);
	if(mysql_num_rows($rs0_query) > 0)
	{
$cnt=0;
while ($rs0=mysql_fetch_array($rs0_query))
{
$cnt++;
?>
              <tr bgcolor="<? if($cnt%2) echo "#F5F5F5"; else echo "#FFFFFF";?>"> 
                <td height="25" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="middle"> 
                      <td height="75" colspan="2" align="center">&nbsp;<img src='<? echo $rs0["bannerurl"]; ?>' width=468 height=60 border=0 alt="<? echo $rs0["sbtitle"];?>"></td>
                    </tr>
                    <tr> 
                      <td width="70%"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="19%"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Website 
                              Title</font></strong></font></strong></font></td>
                            <td width="81%"><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><?
								  echo  $rs0["sbtitle"]; ?></font></td>
                          </tr>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Website 
                              URL </font></strong></font></strong></font></td>
                            <td><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><? echo  $rs0["url"]; ?></font></td>
                          </tr>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Banner 
                              URL </font></strong></font></strong></font></td>
                            <td><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><? echo $rs0["bannerurl"]; ?></font></td>
                          </tr>
                          <tr> 
                            <td colspan="2">&nbsp;&nbsp;<font size="1" face="Arial, Helvetica, sans-serif">[ 
                              <a href="editad.php?id=<?php echo $rs0["id"]; ?>&sbad_type=<?php echo $sbad_type; ?>" class="sbsidelink"><font size="1">Edit</font></a> 
                              ]</font><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;[ 
                              <a href="deletead.php?id=<?php echo $rs0["id"]; ?>&sbad_type=<?php echo $sbad_type; ?>" class="sbsidelink" onClick="javascript:return confirm('Do you really want to delete the banner');">Delete</a> 
                              ]</font></td>
                          </tr>
                        </table></td>
                      <td width="30%"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="40%"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Total 
                              Credits </font></strong></font></strong></font></td>
                            <td width="60%"><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><? echo $rs0["credits"]; ?></font></td>
                          </tr>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                              &nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Displays</font></strong></font></strong></font></td>
                            <td><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><? echo $rs0["displays"]; ?></font></td>
                          </tr>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Balance</font></strong></font></strong></font></td>
                            <td><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"><? echo ($rs0["credits"]-$rs0["displays"]); ?></font></td>
                          </tr>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif">Status</font></strong></font></strong></font></td>
                            <td><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                              <? 
							if($rs0["approved"]=="yes")
							{ echo "Approved"; }
							else
							{ echo "Waiting Approval";}?>
                              </font></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <?
 }
  	}		//end if mysql_num_rows($rs0_query) > 0
	else
	{?>
              <tr> 
                <td height="25"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;No 
                  Bànner exists</font></strong></td>
              </tr>
              <?php	
	}		//end else ?>
            </table>
            <table width="100%" border="0">
              <tr> 
                <td>&nbsp;</td>
              </tr>
            </table></td>
          <td width="13">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php 
}		// end if
}//main()
include "template.php";
?>
