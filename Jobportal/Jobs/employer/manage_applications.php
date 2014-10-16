<?php
include "logincheck.php";
include_once "../myconnect.php";
include_once "../date_time_format.php";

$sb_id=0;
$sb_job_str='';
if(isset($_REQUEST["sb_id"]) && is_numeric($_REQUEST["sb_id"]) && ($_REQUEST["sb_id"] > 0))
{
	$sb_id=$_REQUEST["sb_id"];
	$sb_job_str=" and sb_id=$sb_id";
	
}
$sbq_job="select * from sbjbs_jobs where sb_approved='yes' $sb_job_str and sb_uid=".$_SESSION["sbjbs_emp_userid"];
//echo $sbq_job;
$sbrs_job=mysql_query($sbq_job);
//$sbrow_count=mysql_num_rows($sbrs_job);

/*	$sb_job_id_str='-1';
	while($sbrow_job=mysql_fetch_array($sbrs_job))
	{
		$sb_job_id_str.=",".$sbrow_job["sb_id"];
	}

echo $sb_job_id_str;
//die();
/*
if($sbrow_count<1)
{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode(""));
	die();
}
*/


function main()
{
	global $sbrs_job, $sb_id;

	$sb_job_id_str='-1';
	while($sbrow_job=mysql_fetch_array($sbrs_job))
	{
		$sb_job_id_str.=",".$sbrow_job["sb_id"];
	}
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$sb_job_cnt=$config["sb_job_cnt"];
	$sb_front_featured_fee=$config["sb_front_featured_fee"];
	$sb_featured_fee=$config["sb_featured_fee"];
	$sb_highlight_fee=$config["sb_highlight_fee"];
	$sb_bold_fee=$config["sb_bold_fee"];
/*
$sb_fee_currency=$config['sb_fee_symbol'];
$sb_fee_currency_name=$config['sb_fee_code'];


$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$config['sb_fee_currency'];
$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
$sb_fee_currency=$sbrow_cur['sbcur_symbol'];
*/

	$sbq_resume="select *,UNIX_TIMESTAMP(sb_applied_on) as sbposted from sbjbs_applications 
	where sb_job_id in ($sb_job_id_str) order by sb_id desc";
//	echo $sbq_resume;
	$sbq_resume=mysql_query($sbq_resume);
	$num_resumes=mysql_num_rows($sbq_resume);

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
          <td valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
                            <tr align="left" valign="top"> 
                              <td class="titlestyle">&nbsp;Application 
                                Received</td>
                            </tr>
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr > 
                      <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="5" >
                          <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <tr valign="top"> 
                              <td width="40%" align="right" class="innertablestyle"><font class='normal'><strong>Select 
                                a Job</strong></font></td>
                              <td width="6" class="maintext">&nbsp;</td>
                              <td width="60%" class="maintext"> <font class='normal'> 
                                <select name="sb_id" id="sb_id">
                                  <option value="">All Jobs</option>
                                  <?php	$sbq1_job="select * from sbjbs_jobs where sb_approved='yes' and sb_uid=".$_SESSION["sbjbs_emp_userid"];
//echo $sbq_job;
			$sbrs1_job=mysql_query($sbq1_job);
 			while($sbrow1_job=mysql_fetch_array($sbrs1_job))
 			{
				echo '<option value="'.$sbrow1_job["sb_id"].'"';
				echo ($sbrow1_job["sb_id"]==$sb_id)?'selected':'';
				echo '>'.$sbrow1_job["sb_title"].'</option>';
			}
							?>
                                </select>
                                </font></td>
                            </tr>
                            <tr valign="top"> 
                              <td width="40%" align="right" class="innertablestyle"><font class='normal'>&nbsp;</font></td>
                              <td width="6" class="maintext">&nbsp;</td>
                              <td width="60%" class="maintext"><font class='normal'> 
                                <input type="submit" name="Submit" value="Search">
                                </font></td>
                            </tr>
                          </form>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            
          </td>
        </tr>
        <tr> 
          <td valign="top">&nbsp;</td>
        </tr>
        <tr> 
          <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
              <tr > 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
                    <tr> 
                      <td height="25" class="titlestyle">&nbsp;<?php 
					  if($sb_id>0)
					  	{
					  		$sbq2="select * from sbjbs_jobs where sb_id=$sb_id";
							$sbrow2=mysql_fetch_array(mysql_query($sbq2));
							echo ($sbrow2)?'Application Received for '.$sbrow2["sb_title"]:'Application Received';
					  	}
						else
							echo 'Application Received';
							 ?></td>
                    </tr><?php 	if($num_resumes > 0)
								{		?>
                    <tr> 
                      <td valign="top">&nbsp; </td>
                    </tr>
                    <tr> 
                      <td valign="top">
                          <?php 	
							$cnt=0;
							while( $sbrow_resume=mysql_fetch_array($sbq_resume) )
							{
							$cnt++;
							?>
                          
                        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1"
							 class="<? if($cnt%2<>0){echo "innertablestyle"; }else{echo "alternatecolor";}?>">
                          <tr> 
                            <td width="692" ><font class="normal"><a href="../view_resume.php?resume_id=<?php echo $sbrow_resume["sb_resume_id"]; ?>" target="_blank" title="View Resume"> 
                              <?php 
								
		$sbq_res="select * from sbjbs_resumes where sb_id=".$sbrow_resume["sb_resume_id"];
	//	echo $sbq_res;
		$sbrow_res=mysql_fetch_array(mysql_query($sbq_res));
		echo $sbrow_res["sb_title"]; 
                                ?>
                              </a></font></td>
                          </tr>
                          <tr> 
                            <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?
					//	  if($view=="desc")
						  {                          ?>
                                <tr valign="top"> 
                                  <td width="20%"><strong><font class="smalltext">Objective</font></strong></td>
                                  <td width="83%"><font class="smalltext"> 
                                    <?php 
							
							if (strlen ($sbrow_res["sb_objective"])>150)
							{
							 echo substr($sbrow_res["sb_objective"], 0,  strrpos( substr($sbrow_res["sb_objective"], 0, 150),' ' ))." ...";  
							}
							else
							{
							 echo $sbrow_res["sb_objective"];  
							}
							?>
                                    </font></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="20%"><strong><font class="smalltext">Target 
                                    Job</font></strong></td>
                                  <td><font class="smalltext"> <?php echo $sbrow_res["sb_target_job"]; ?> 
                                    </font></td>
                                </tr>
                                <?php
						  }//if descriptive view
                          ?>
                                <tr valign="top"> 
                                  <td width="20%"><strong><font class="smalltext">Career 
                                    Level</font></strong></td>
                                  <td><font class="smalltext"> 
                                    <?php 
								  switch($sbrow_res["sb_career_level"])
								  {
								  case 1: echo "Student (High School)"; break;
								  case 2: echo "Student"; break;
								  case 3: echo "Entry Level (less than 2 years of experience)"; break;
								  case 4: echo "Mid Career (2+ years of experience)"; break;
								  case 5: echo "Manager"; break;
								  case 6: echo "Senior Management (VP and equivalent)"; break;
								  case 7: echo "Top Management (CEO and equivalent)"; break;
								  }
								  ?>
                                    </font></td>
                                </tr>
                                <tr valign="top"> 
                                  <td width="20%"><strong><font class="smalltext">Total 
                                    Experience</font></strong></td>
                                  <td><font class="smalltext"> 
                                    <?php
							switch($sbrow_res["sb_relevent_experience"])
							{
							 case 0: echo "Fresher"; break;
							 case 1: echo "Less than 1 Year"; break;
							 case 2: echo "1 to 2 Years"; break;
							 case 3: echo "2 to 5 Years"; break;
							 case 4: echo "5 to 7 Years"; break;
							 case 5: echo "7 to 10 Years"; break;
							 case 6: echo "10 to 15 Years"; break;
							 case 7: echo "More than 15 Years"; break;
							}
							?>
                                    </font></td>
                                </tr>
                                <tr valign="top"> 
                                  <td><strong><font class="smalltext">Applied 
                                    On </font></strong></td>
                                  <td><font class="smalltext"> 
                                    <?php
							  echo sb_date($sbrow_resume["sbposted"]);
							  ?>
                                    </font></td>
                                </tr>
                                <tr valign="top"> 
                                  <td><font class="smalltext"><strong>Options</strong></font> 
                                  </td>
                                  <td><font class="smalltext">&nbsp;[&nbsp;<a href="delete_application.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" onClick="return confirm('Do you really want to remove the request ?');" title="Remove this request">Delete</a>&nbsp;]<?php 
		if($sbrow_resume["sb_cover_id"]>0) 	{ ?>&nbsp;&nbsp;[&nbsp;<a href="../view_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_cover_id"];?>" class="small_link" title="View cover letter" target="_blank">View 
                                    Cover Letter</a>&nbsp;]<?php 
											}	//end if	?></font></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                          <?
}
?></td>
                    </tr><?php 	}	//end if end of rs
								else
								{?><tr> 
                      <td height="25"> 
                        <div align="center"><font class="normal">No application 
                          found satisfying your search criteria</font></div></td>
                    </tr><?php 	}	//end else		?>
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