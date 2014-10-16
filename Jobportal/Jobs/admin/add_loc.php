<?
include_once("myconnect.php");
include_once("logincheck.php");


function main()
{

if ( isset( $_REQUEST["loc_id"] ) && $_REQUEST["loc_id"]!="" )
{
$loc_id=$_REQUEST["loc_id"];
}
else
{
$loc_id=0;
}
$locname="";

  
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="1" >
        <tr> 
          <td valign="top">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr> 
                <td valign="top"> 
               
                    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
                      <tr align="left">
                        <td height="25" colspan="2">
						<?
							$errcnt=0;
							$showform="";

							if ( count($_POST)!=0 )
							{
							
							if ( !isset( $_REQUEST["loc_name"] ) || $_REQUEST["loc_name"]=="" )
							{
								$errs[$errcnt]="Location name must be provided";
								$errcnt++;
							}
							elseif(preg_match ("/[;]/", $_REQUEST["loc_name"]))
							{
								$errs[$errcnt]="Location name can not have semi colon (;) ";
								$errcnt++;
							}
							else
							{
							if (!get_magic_quotes_gpc()) {
							$loc_name=str_replace('$', '\$',addslashes($_REQUEST["loc_name"]));
							}
							else
							{
							$loc_name=str_replace('$', '\$',$_REQUEST["loc_name"]);
							}
							
							$par_cat=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_loc_name='".$loc_name."' and sb_pid=".$_REQUEST["loc_id"]));
							 if($par_cat)
							 {
								$errs[$errcnt]="Location with name <b>$loc_name</b> already exists.";
								$errcnt++;
							 }
							}
							
							/*	$num_ques=0;
								$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_job_locs 
								where sb_lid=".$_REQUEST["loc_id"]));
								$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_resume_locs 
								where sb_loc_id=".$_REQUEST["loc_id"]));
								$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
								where sb_loc_id=".$_REQUEST["loc_id"]));
								
								
								if( $num_ques>0)
								{
									$errs[$errcnt]="This Location contains some listings, you have to shift all these listings to any other Location before adding a subLocation.";
									$errcnt++;
								}*/
							}
					if  (count($_POST)<>0)
					{
					if ( $errcnt==0 )
					{
						if (!get_magic_quotes_gpc()) {
						$loc_name=str_replace('$', '\$',addslashes($_REQUEST["loc_name"]));
						}
						else
						{
						$loc_name=str_replace('$', '\$',$_REQUEST["loc_name"]);
						}
						$sql="Insert into sbjbs_locations (sb_loc_name,sb_pid) values ('$loc_name',".$_REQUEST["loc_id"].")";
						$rs=mysql_query( $sql);
						$loc_name="";

						?><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Location 
                    	has been Added</font><?
						$showform="No";
						}
						else
						{
						$loc_name=$_REQUEST["loc_name"];
						
						
						?>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Your Add Location Request cannot be processed due to following Reasons</font></td>
                    </tr>
                    <?

				for ($i=0;$i<$errcnt;$i++)
				{
				?>
                    <tr valign="top"> 
                      <td width="6%"><font color="#FF0000"><?php echo $i+1; ?></font></td>
                      <td width="94%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">				
					  <?php echo  $errs[$i]; ?> 
                        </font></td>
                    </tr>
                    <?
					}//end for
					?>
                  </table>
                  <?
				}
			}
			?>
           </td>
                      </tr>
                      <tr align="left">    
                        <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Add 
                          New 
                          <? if($loc_id<>0) { echo "Sub Location";} else { echo "Location";}?>
                          </font></strong></td>
                      </tr><form name="form2" method="post" action="add_loc.php">
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Location 
                            Name:&nbsp;</font></strong></div></td>
                        <td width="448"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <input name="loc_name" type="text" value="<? echo $locname;?>" size="40">
                          </font></td>
                      </tr>
                      <tr> 
                        <td align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Parent 
                            Location:&nbsp;</font></strong></div></td>
                        <td><font face="Arial, Helvetica, sans-serif" size="2"> 
                          <select name="loc_id" id="select" >
						  <option value="0">root</option>
                            <?
				  $rs_query=mysql_query("select * from sbjbs_locations order by sb_pid");
				  
				  while($rst=mysql_fetch_array($rs_query))
				  {
				  $cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_pid=".$rst["sb_id"]));
									  
									  $cat_path.=$rst["sb_loc_name"];
		 $par=mysql_query("select * from sbjbs_locations where sb_id=".$rst["sb_pid"]);
		 				while($parent=mysql_fetch_array($par))
		 				{
						$cat_path=$parent["sb_loc_name"].">".$cat_path;
						$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
						}
                                      ?>
                            <option value="<? echo $rst["sb_id"];?>" <?php
				if ( $rst["sb_id"]==$loc_id )
				{
				echo "  selected ";
				}
				?>><? echo $cat_path;?></option>
                            <?
									  }
									  ?>
                          </select>
                          </font> </td>
                      </tr>
                      <tr> 
                        <td bgcolor="#F5F5F5">&nbsp;</td>
                        <td><font face="Arial, Helvetica, sans-serif" size="2"> 
                          <input type="submit" name="Submit" value="Add">
                          </font></td>
                        </tr></form>
                    </table>
					</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?
}  //End of main
include_once("template.php");
?>