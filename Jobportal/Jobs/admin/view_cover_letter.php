<?php
include_once "myconnect.php";

$sbq_resume='select * from sbjbs_cover_letters where sb_id='.$_REQUEST["sb_id"];
$resume=mysql_fetch_array(mysql_query($sbq_resume));

if(!$resume)
{
	header("Location: cover_letters.php?msg=".urlencode("Cover Letter not found."));
	die();
}

function main()
{
	global $resume;

?><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" > <div align="center"><font class='red'> </font> </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
              <tr > 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
                    <tr> 
                      <td height="25" class="titlestyle">&nbsp;View Cover Letter</td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top"> <table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tr valign="top"> 
                            <td> 
                              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                <tr> 
                                  <td><strong><font class="normal">&nbsp; 
                                    <?php 
								  echo $resume["sb_title"];
								  ?>
                                    </font></strong></td>
                                </tr>
                                <tr > 
                                  <td> 
                                    <form name="form1" method="post" action="">
                                      &nbsp; 
                                    <textarea name="textfield"  id="textfield" readonly class="letterstyle"><?php
                            echo $resume["sb_contents"];        
								    ?></textarea>
                                    </form></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td align="center"></td>
        </tr>
        <tr> 
          <td valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
  <?
}// end main
include "template.php";
?>