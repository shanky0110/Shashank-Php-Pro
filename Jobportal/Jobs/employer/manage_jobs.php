<?php
include "logincheck.php";
include_once "../myconnect.php";
include_once "../date_time_format.php";

function main()
{
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$sb_job_cnt=$config["sb_job_cnt"];
	$sb_front_featured_fee=$config["sb_front_featured_fee"];
	$sb_featured_fee=$config["sb_featured_fee"];
	$sb_highlight_fee=$config["sb_highlight_fee"];
	$sb_bold_fee=$config["sb_bold_fee"];

//$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$config['sb_fee_currency'];
//$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
	$sb_fee_currency=$config['sb_fee_symbol'];
	$sb_fee_currency_name=$config['sb_fee_code'];

$comp_str="";

//===================================Company Search===========================================
if(isset($_REQUEST["sb_company_id"]) &&($_REQUEST["sb_company_id"]<>""))
{
//	$strpass.="&company=".$_REQUEST["company"];
	$comp_str=" and sb_company_id=".$_REQUEST["sb_company_id"];
}
//=========================================================================================
	$sbq_resume='select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_jobs 
	where sb_uid='.$_SESSION["sbjbs_emp_userid"].$comp_str.'  order by sb_id desc';
	//echo $sbq_resume;
	$sbq_resume=mysql_query($sbq_resume);
	$num_jobs=mysql_num_rows($sbq_resume);

	?>
	<script language="JavaScript">
//<!--
function select_all()
{
  for (var i=0;i<document.form2.elements.length;i++)
  {
    var e =document. form2.elements[i];
    if ((e.name != 'check_all') && (e.type=='checkbox'))
    {
       e.checked = document.form2.check_all.checked;
    }
  }

}


//-->
</script>
	
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top" > <div align="center"><font class='red'> </font> </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
              <tr > 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
                    <tr> 
                      <td height="25" class="titlestyle">&nbsp;My Jobs</td>
                    </tr>
                    <tr> 
                      <td><font class='normal'>Posted - <strong><font class='red'><?php echo $num_jobs; ?></font></strong> 
                     <?php if($sb_job_cnt>0) 	{?>  Maximum Allowed - <strong><font class='red'><?php echo $sb_job_cnt; ?></font></strong> <?php 			}		//end if?>
                        </font></td>
                    </tr><?php if($num_jobs < 1)	{?>
                    <tr> 
                      <td valign="top"><font class="normal">&nbsp;You have not 
                        posted any job.</font></td>
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
                              <td width="75" ><font class="smalltext">Job #&nbsp;<?php echo $sbrow_resume["sb_id"];//$cnt;?></font></td>
                              <td valign="top"><font class="normal"><strong>
                                <?php 
                                  echo $sbrow_resume["sb_title"]; 
                                ?>
                                </strong></font></td>
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
							  
						/*	  if($sbrow_resume["sb_show_profile"]=="yes")
							  { echo "<font class='red'><b>Profile not hidden&nbsp;&nbsp;</b></font>";}
							  else
							  { echo "<font class='red'><b>Profile hidden&nbsp;&nbsp;</b></font>";}
							*/
/*							  if($sbrow_resume["sb_search_enable"]=="yes")
							  { echo "<em>Searchable&nbsp;&nbsp;</em>"; }
							  else
							  { echo "<em>Not Searchable&nbsp;&nbsp;</em>"; }
*/
							  echo "&nbsp;Posted on: ".sb_date($sbrow_resume["sbposted"]);
							  ?>
                                      </font></td>
                                    <td width="250" align="right"><font class="smalltext">Applications 
                                      Received (<?php 
			$sbq_app="select * from sbjbs_applications where sb_job_id=".$sbrow_resume["sb_id"];
			$sbrs_app=mysql_query($sbq_app);
			$sbrow_count=mysql_num_rows($sbrs_app);
			echo ($sbrow_count>0)?'<a href="manage_applications.php?sb_id='.$sbrow_resume["sb_id"].'" title="View applications received for the job">'.$sbrow_count.'</a>':$sbrow_count;
			?>)</font></td>
                                  </tr>
                                </table></td>
                            </tr><?php 
							if( ($sbrow_resume["sb_front_featured"]=='no') || ($sbrow_resume["sb_featured"]=='no') || ($sbrow_resume["sb_highlight"]=='no') || ($sbrow_resume["sb_bold"]=='no') )
							{?>
                            <tr>
                              <td ><font class="smalltext"><strong>Paid Options</strong></font>
							  </td>
                              <td valign="top"> <font class="smalltext"> 
                                <?php 
			if($sbrow_resume["sb_front_featured"]=='no')
			{?>
                                &nbsp;[&nbsp;<a href="make_front_fea.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" <?php echo ($sb_front_featured_fee > 0)?'onClick="return confirm(\'This will cost you '.$sb_front_featured_fee.' '.$sb_fee_currency_name.'. Do you want to continue ?\');"':''; ?>>Front 
                                Featured </a>&nbsp;]&nbsp; 
                                <?php 
			}	//end if
			if($sbrow_resume["sb_featured"]=='no')
			{?>
                                &nbsp;[&nbsp;<a href="make_featured.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" <?php echo ($sb_featured_fee > 0)?'onClick="return confirm(\'This will cost you '.$sb_featured_fee.' '.$sb_fee_currency_name.'. Do you want to continue ?\');"':''; ?>>Featured</a>&nbsp;]&nbsp; 
                                <?php 
			}	//end if
			if($sbrow_resume["sb_highlight"]=='no')
			{?>
                                &nbsp;[&nbsp;<a href="make_high.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" <?php echo ($sb_highlight_fee > 0)?'onClick="return confirm(\'This will cost you '.$sb_highlight_fee.' '.$sb_fee_currency_name.'. Do you want to continue ?\');"':''; ?>>Highlighted</a>&nbsp;]&nbsp; 
                                <?php 
			}
			if($sbrow_resume["sb_bold"]=='no')
			{?>
                                &nbsp;[&nbsp;<a href="make_bold.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" <?php echo ($sb_bold_fee > 0)?'onClick="return confirm(\'This will cost you '.$sb_bold_fee.' '.$sb_fee_currency_name.'. Do you want to continue ?\');"':''; ?>>Bold</a>&nbsp;]&nbsp; 
                                <?php 
			}?>
                                </font></td>
                            </tr><?php 
							}		//end if any paid option remains?>
                            <tr> 
                              <td ><font class="smalltext"><strong>Options</strong></font> 
                              </td>
                              <td valign="top"><font class="smalltext">&nbsp;[&nbsp;<a href="../view_job.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="View job description">View</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="edit_job.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="Update Job">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_job.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" onClick="return confirm('Do you really want to remove the job ?');" title="Remove job">Delete</a>&nbsp;]</font></td>
                            </tr>
                          </table>
                            <?
}
?></td>
                    </tr><?php }	//end else if $num_jobs > 1?>
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