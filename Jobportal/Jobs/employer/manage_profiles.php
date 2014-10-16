<?php
include "logincheck.php";
include_once "../myconnect.php";
include_once "../date_time_format.php";

function main()
{
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$sb_company_cnt=$config["sb_company_cnt"];

	$sbq_resume='select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_companies 
	where sb_uid='.$_SESSION["sbjbs_emp_userid"].' order by sb_id desc';
//	echo $sbq_off;
	$sbq_resume=mysql_query($sbq_resume);
	$num_jobs=mysql_num_rows($sbq_resume);
	
	$premium_pro=0;
	$premium=mysql_fetch_array(mysql_query("select * from sbjbs_premium_gallery where sb_emp_id=".$_SESSION["sbjbs_emp_userid"]));
	if($premium)
	{
	$premium_pro=$premium["sb_profile_id"];
	}
	?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" > <div align="center"><font class='red'> </font> </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
              <tr > 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
                    <tr> 
                      <td height="25" class="titlestyle">&nbsp;My Companies</td>
                    </tr>
                    <tr> 
                      <td><font class='normal'>Posted - <strong><font class='red'><?php echo $num_jobs; ?></font></strong><?php 
					  if($sb_company_cnt>0) 	{?>  Maximum Allowed - <strong><font class='red'><?php echo $sb_company_cnt; ?></font></strong> <?php 			}		//end if?>
                        </font></td>
                    </tr>
                    <?php if($num_jobs < 1)	{?>
                    <tr> 
                      <td valign="top"><font class="normal">&nbsp;You have not 
                        posted any company profile.</font></td>
                    </tr><?php 	}	//end if $num_jobs < 1
					else	
					{	//jobs exist 	?>
                    <tr> 
                      <td valign="top"><?php 	
							$cnt=0;
							while( $sbrow_resume=mysql_fetch_array($sbq_resume) )
							{
							$cnt++;
							?>
							
                          <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1"
							 class="<? if($cnt%2<>0){echo "innertablestyle"; }else{echo "alternatecolor";}?>">
                            <tr> 
                              <td width="75" ><font class="smalltext"> #&nbsp;<?php echo $sbrow_resume["sb_id"];//$cnt;?></font></td>
                              
                            <td valign="top"><font class="normal"><strong> </strong></font> 
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><font class="normal"><strong>
                                    <?php 
                                  echo $sbrow_resume["sb_name"]; 
                                ?>
                                    </strong></font></td>
                                  <td align="right"><font class="smalltext"><font class="red"><strong><?php
								  if($sbrow_resume["sb_id"]==$premium_pro)
								  {
								  echo "Premium Profile";
								  }
								  ?></strong></font></font></td>
                                </tr>
                              </table>
                              
                            </td>
                            </tr>
                            <tr> 
                              <td ><font class="smalltext">&nbsp;</font></td>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td><font class="smalltext"> 
                                      <?php 
							  if($sbrow_resume["sb_approved"]=="yes")
							  { echo "<em>Approved&nbsp;&nbsp;</em>"; }
							  elseif($sbrow_resume["sb_approved"]=="no")
							  { echo "<em>Waiting Approval&nbsp;&nbsp;</em>"; }
							  else
							  { echo "<em>New Waiting Approval&nbsp;&nbsp;</em>"; }
							  
							  if($sbrow_resume["sb_show_profile"]=="yes")
							  { echo "<font class='red'><b>Profile not hidden&nbsp;&nbsp;</b></font>";}
							  else
							  { echo "<font class='red'><b>Profile hidden&nbsp;&nbsp;</b></font>";}
						
/*							  if($sbrow_resume["sb_search_enable"]=="yes")
							  { echo "<em>Searchable&nbsp;&nbsp;</em>"; }
							  else
							  { echo "<em>Not Searchable&nbsp;&nbsp;</em>"; }
*/
							  echo "&nbsp;Posted on: ".sb_date($sbrow_resume["sbposted"]);
							  ?>
                                      </font></td>
                                    <td width="250" align="right"><font class="smalltext">Jobs 
                                      Posted ( 
                                      <?php 
			$sbq_app="select * from sbjbs_jobs where sb_company_id=".$sbrow_resume["sb_id"];
			$sbrs_app=mysql_query($sbq_app);
			$sbrow_count=mysql_num_rows($sbrs_app);
			echo ($sbrow_count>0)?'<a href="manage_jobs.php?sb_company_id='.$sbrow_resume["sb_id"].'" title="View jobs posted for the company">'.$sbrow_count.'</a>':$sbrow_count;
			?>
                                      )</font></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td >&nbsp; </td>
                              <td valign="top"><font class="smalltext">&nbsp;[&nbsp;<a href="../view_profile.php?id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="View company profile">View</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="companyprofile.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="Update Job">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_profile.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" onClick="return confirm('Do you really want to remove the company ?');" title="Remove company">Delete</a>&nbsp;]</font></td>
                            </tr>
                          </table>
                            <?
}
?><?php }	//end else if $num_jobs > 1?></td>
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
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
  <?
}// end main
include "template.php";
?>