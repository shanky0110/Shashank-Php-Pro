<?php
include "logincheck.php";
include_once "../myconnect.php";
include_once "../date_time_format.php";

$sbq_mem="select * from sbjbs_employers where sb_id=".$_SESSION["sbjbs_emp_userid"];
//die($sbq_mem);
$sbrow_mem=mysql_fetch_array(mysql_query($sbq_mem));
if(!$sbrow_mem)
{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("No such member exists, denied"));
	die();
}
if($sbrow_mem["sb_search_allowed"]!='yes')
{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("You do not have privilege to perform search operation"));
	die();
}

function main()
{
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$recperpage=$config["sb_recperpage"];
	$sb_null_char=$config["sb_null_char"];
	$strpass="";
	$keyword="";
	$searchkeyword="";
	$cid_list="";
	$loc_id_list="";
	$skl_id_list="";
	$view="brief";
	
	$suspended_list="-1";
	$mem_q=mysql_query("select * from sbjbs_seekers where sb_suspended='yes'");
	while($mem=mysql_fetch_array($mem_q))
	{ $suspended_list.=",".$mem["sb_id"];}
	
	if(isset($_REQUEST["keyword"])&&($_REQUEST["keyword"]<>""))
	{
		$keyword=$_REQUEST["keyword"];
		$strpass.="&keyword=".$_REQUEST["keyword"];
		if (!get_magic_quotes_gpc()) 
		{
		$searchkeyword=str_replace('$', '\$',addslashes($_REQUEST["keyword"]));
		}
		else
		{
		$searchkeyword=str_replace('$', '\$',$_REQUEST["keyword"]);
		}
		$searchkeyword=trim($searchkeyword);
	}
	if(isset($_REQUEST["cid_list"])&&($_REQUEST["cid_list"]<>""))
	{
	$strpass.="&cid_list=".$_REQUEST["cid_list"];
	$cid_list=str_replace(";",",",$_REQUEST["cid_list"]);
	//$cid_list=explode(";",$_REQUEST["cid_list"]);
	}
	if(isset($_REQUEST["cid"])&&($_REQUEST["cid"]<>""))
	{
	$strpass.="&cid=".$_REQUEST["cid"];
			
			$c_list=$_REQUEST["cid"];
			$child_cat=mysql_query("select * from sbjbs_categories where sb_pid=".$_REQUEST["cid"]);
				
				while ( $child=mysql_fetch_array($child_cat) )
				{
					$c_list.="," . $child["sb_id"];
					while ( $child=mysql_fetch_array($child_cat) )
					{ 
						$c_list.="," . $child["sb_id"];
					}
						
				$child_cat=mysql_query("Select * from sbjbs_categories where 
				sb_pid IN (" . $c_list . ") and sb_id not in ( ". $c_list . ")") ;
				}
		$cid_list=$c_list;
		}
	
//================================== LOC SEARCH [MULTI LOCATION CODE] ====================================
	if(isset($_REQUEST["loc_id"])&&($_REQUEST["loc_id"]<>""))
	{
		$strpass.="&loc_id=".$_REQUEST["loc_id"];
		$loc_id_list=str_replace(";",",",$_REQUEST["loc_id"]);
		$loc_q=mysql_query("select * from sbjbs_locations where sb_id in ($loc_id_list)");
		while($loc=mysql_fetch_array($loc_q))
		  {
		  	$clist=$loc["sb_id"];
			$child_loc=mysql_query("select * from sbjbs_locations where sb_pid=".$loc["sb_id"]);
				
				while ( $child=mysql_fetch_array($child_loc) )
				{
					$clist.="," . $child["sb_id"];
					while ( $child=mysql_fetch_array($child_loc) )
					{ 
						$clist.="," . $child["sb_id"];
					}
						
				$child_loc=mysql_query("Select * from sbjbs_locations where 
				sb_pid IN (" . $clist . ") and sb_id not in ( ". $clist . ")") ;
				}

		  }
		$loc_id_list.=",".$clist;
		//$loc_id_list=explode(",",$loc_id_list);
	}

//////////--------------------------
//	$sbq_job="select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_jobs where sb_approved='yes' ";
	$sbq_job="select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_resumes where sb_approved='yes' and sb_seeker_id not in ($suspended_list) and sb_search_enable='yes'";

//===================================== keyword search ==================================================
	if($searchkeyword<>"")
	{
	if(isset($_REQUEST["search_method"])&&(($_REQUEST["search_method"]==2)||($_REQUEST["search_method"]==3)))
		{
			$log_operator="OR";
			if($_REQUEST["search_method"]==2)
			$log_operator="AND";
			
			$search_str="";
			$keyword_arr=explode(" ",$searchkeyword);
			foreach($keyword_arr as $key)
			{
				if($search_str=="")
				{
				$search_str="(sb_title like '%$key%' or sb_objective like '%$key%' 
				or sb_additional_info like '%$key%') ";
				}
				else
				{
				$search_str.=" $log_operator (sb_title like '%$key%' or sb_objective like '%$key%' 
				or sb_additional_info like '%$key%') ";
				}
			}
			$sbq_job.=" and ($search_str)";
		}// end if AND/ OR keywords	
		else
		{
		$sbq_job.=" and (sb_title like '%$searchkeyword%' or sb_objective like '%$searchkeyword%' 
		or sb_additional_info like '%$searchkeyword%') ";
		}
}	
	//============================================================
//=======================category search==========================
if((count($cid_list)>0)&&($cid_list<>""))
{
	$cat_str="-1";
	$job_cat_q=mysql_query("select * from sbjbs_resume_cats where sb_cid in ($cid_list)");
	while($job_cat=mysql_fetch_array($job_cat_q))
	{
		$cat_str.=",".$job_cat["sb_resume_id"];
	}	

	
	$sbq_job.=" and sb_id in ($cat_str)";
}
//================================================================
//////////----------skill search
	if(isset($_REQUEST["skl_id"])&&($_REQUEST["skl_id"]<>""))
	{
		$strpass.="&skl_id=".$_REQUEST["skl_id"];
		$skl_id_list=str_replace(";",",",$_REQUEST["skl_id"]);

		$skl_str="-1";
		$job_skl_q=mysql_query("select * from sbjbs_resume_skills where sb_skill_id in ($skl_id_list)");
		while($job_skl=mysql_fetch_array($job_skl_q))
		{
			$skl_str.=",".$job_skl["sb_resume_id"];
		}	
		$sbq_job.=" and sb_id in ($skl_str)";
	}

//=======================Location search==========================
if((count($loc_id_list)>0)&&($loc_id_list<>""))
{
	$loc_str="-1";
	$job_loc_q=mysql_query("select * from sbjbs_resume_locs where sb_loc_id in ($loc_id_list)");
	while($job_loc=mysql_fetch_array($job_loc_q))
	{
		$loc_str.=",".$job_loc["sb_resume_id"];
	}	
	
	$sbq_job.=" and sb_id in ($loc_str)";
}
//================================================================
//===================================== Experience Search =================================
/*
if(isset($_REQUEST["work_exp"])&&($_REQUEST["work_exp"]<>""))
{
	$strpass.="&work_exp=".$_REQUEST["work_exp"];
	$sbq_job.=" and (sb_experience=".$_REQUEST["work_exp"]." or sb_experience=-1)";
}*/
//===================================Company Search===========================================

//===================================== career Search =================================
if(isset($_REQUEST["sb_career_level"])&&($_REQUEST["sb_career_level"]<>""))
{
	$strpass.="&sb_career_level=".$_REQUEST["sb_career_level"];
	$sbq_job.=" and (sb_career_level=".$_REQUEST["sb_career_level"].")";
}
//===================================Company Search===========================================

/*
if(isset($_REQUEST["company"]) &&($_REQUEST["company"]<>""))
{
	$strpass.="&company=".$_REQUEST["company"];
	$sbq_job.=" and sb_company_id=".$_REQUEST["company"];
}
*/
//=========================================================================================
	$sbq_job.=" order by sb_id desc";
//	echo $sbq_job;
	$sbq_job=mysql_query($sbq_job);
	$num_job=mysql_num_rows($sbq_job);
	$strpass1=$strpass;
	if(isset($_REQUEST["view"])&&($_REQUEST["view"]<>""))
	{
	$strpass.="&view=".$_REQUEST["view"];
	$view=$_REQUEST["view"];
	}

///////////////////////////////////PAGINATION /////////
	if(!isset($_REQUEST["pg"]))
	{
			$pg=1;
	}
	else 
	{
	$pg=$_REQUEST["pg"];
	}
	
$rcount=mysql_num_rows($sbq_job);
if ($rcount==0 )
{ 
	$pages=0;
}	
else
{
	$pages=floor($rcount / $recperpage);
	if  (($rcount%$recperpage) > 0 )
	{
		$pages=$pages+1;
	}
}
$jmpcnt=1;
while ( $jmpcnt<=($pg-1)*$recperpage  && $row = mysql_fetch_array($sbq_job) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}

//////////////////////////////////////////////////////////////////////// 
	
	$label=1;
	$featured_label=1;

?> 
<script language="JavaScript">
function submit_form()
{
	document.save_search.action="save_search_popup.php";
	window.open("","win","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=530,height=220,location=no,directories=no,scrollbars=no");
	document.save_search.method="post";
	document.save_search.target="win";
	document.save_search.submit();
}
</script>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr > 
          <td colspan="2" valign="top" class="onepxtable"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
              <tr> 
                
              
          <td height="25" class="titlestyle">&nbsp;Search Results for Resumes<font class="smalltext">&nbsp; 
            </font></td>
              </tr>
              <tr> 
                <td align="left" valign="top"> <table width="100%" border="0" cellpadding="2" cellspacing="0"><?php 
					$cnt=0;
					while(($job=mysql_fetch_array($sbq_job))&&($cnt<$recperpage))
				  	{
						$cnt++;	
						
						$rec_class="innertable";
						if($cnt%2==0)
						{ $rec_class="alternatecolor"; }
							
				?> 
		        
				    <tr valign="top"> 
                      <td><table width="100%" border="0" cellspacing="1" cellpadding="1" class="<? echo $rec_class;?>">
                    <tr> 
                      <td><a href="../view_resume.php?resume_id=<?php echo $job["sb_id"]; ?>" target="_blank"> 
                        <?php 
							 echo $job["sb_title"];
							?>
                        </a></td>
                    </tr>
                    
                    <tr> 
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <?
						  if($view=="desc")
						  {
                          ?>
                          <tr valign="top"> 
                            <td width="20%"><strong><font class="smalltext">Objective</font></strong></td>
                            <td><font class="smalltext"> 
                              <?php 
							
							if (strlen ($job["sb_objective"])>150)
							{
							 echo substr($job["sb_objective"], 0,  strrpos( substr($job["sb_objective"], 0, 150),' ' ))." ...";  
							}
							else
							{
							 echo $job["sb_objective"];  
							}
							?>
                              </font></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="20%"><strong><font class="smalltext">Target 
                              Job</font></strong></td>
                            <td><font class="smalltext"> 
                              <?php echo $job["sb_target_job"]; ?>
                              </font></td>
                          </tr>
                          <tr valign="top"> 
                            <td width="20%"><strong><font class="smalltext">Desired 
                              Salary</font></strong></td>
                            <td width="83%"><font class="smalltext"> 
                              <?php 
							 $cur=mysql_fetch_array(mysql_query("Select * from sbjbs_currencies where sbcur_id=".$job["sb_salary_currency"])); 
								  echo number_format($job["sb_salary"],2)." ".$cur["sbcur_name"]." ";
								  switch($job["sb_salary_type"])
								  {
								  case 1: echo "Per Year"; break;
								  case 2: echo "Per Month"; break;
								  case 3: echo "Per Week"; break;
								  case 4: echo "Fortnightly"; break;
								  case 5: echo "Per Hour"; break;
								  }
								  ?>
                              </font></td>
                          </tr><?php
						  }//if descriptive view
                          ?>
                          <tr valign="top"> 
                            <td width="20%"><strong><font class="smalltext">Career 
                              Level</font></strong></td>
                            <td><font class="smalltext"> 
                              <?php 
								  switch($job["sb_career_level"])
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
							switch($job["sb_relevent_experience"])
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
                        </table></td>
                    </tr>
                    
                    <tr> 
                      <td></td>
                    </tr>
                  </table></td>
                    </tr>
                    <?php //echo "<br>$cnt";
						}		//end while 
						if($cnt==0)
						{?><tr> 
          					
                <td colspan="2" valign="top" ><div align="center"><font class='normal'>No 
                    resumes found satisfying your search criteria</font> </div></td>
              </tr><?php }	?>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
      
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr ></tr>
        <?PHP
		if($pages>0)
		{
        ?>
        <tr valign="top"> 
          <td><font class="normal">
            <?php
		  	if($pages>1)
			{	
			echo "Page $pg of $pages<br>";	
			}
			?>
            </font></td>
          <td width="40%" align="right"><font class="normal"> 
            <?php 
		  if($view=="desc")
		  {
		  echo "<a href='".$_SERVER['PHP_SELF']."?view=brief&pg=$pg".$strpass1."'>Brief</a>";
		  echo "&nbsp;|&nbsp;Descriptive";
		  }
		  else
		  {
		  echo "Brief&nbsp;|&nbsp;";
		  echo "<a href='".$_SERVER['PHP_SELF']."?view=desc&pg=$pg".$strpass1."'>Descriptive</a>";
		  }
		  ?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td colspan="2"> <TABLE border=0 cellPadding=0 cellSpacing=0>
              <TBODY>
                <TR> 
                  <TD> <font class="normal"> 
                    <?
			if($pages>1)
			{	
			//echo "Page $pg of $pages<br>";	
			if ($pg!=1)
			{
			?>
                    <a  href="<? echo $_SERVER['PHP_SELF'];?>?pg=<?php echo ($pg-1).$strpass; ?>" > 
                    <?
			 }
			?>
                    Prev 
                    <?
			if ($pg!=1)
			{
			?>
                    </a> 
                    <?php
			} 
			?>
                    <B>&nbsp; 
                    <?
			if ($pages>1)
			{
				?>
                    </B> 
                    <?php
			if ($pg<=5)
			{
				$jmpcnt=1;
			}
			else
			{
			  $jmpcnt=$pg-5;
			}
			$cnt=0;

			while (  $jmpcnt<=$pages   && ($cnt<=5) )
   			{	
			$cnt++;
		   if ($jmpcnt!=$pg)
		   {
		   ?>
                    <a href="<? echo $_SERVER['PHP_SELF'];?>?pg=<?php echo "$jmpcnt$strpass"; ?>" > 
                    <?
			}
			else
			{
			echo "<b>";
			}
			echo $jmpcnt;
    	   if ($jmpcnt!=$pg)
		   {
		   ?>
                    </a> 
                    <?php
			}else{
			echo "</b>";
			}
			if ($jmpcnt<$pages)
            echo " &nbsp; ";
            ?>
                    <?php
		    $jmpcnt = $jmpcnt + 1;
    	    }
			?>
                    &nbsp;</font> <font class="normal"> 
                    <?
				}
				
			if ( $pg!=$pages && $pages<>0)
			{
			?>
                    <a   href="<? echo $_SERVER['PHP_SELF'];?>?pg=<?php echo ($pg+1); ?><?php echo "$strpass"; ?>" > 
                    <?
			 }
			?>
                    Next 
                    <? if ($pg!=$pages && $pages<>0)
			{
			?>
                    </a> 
                    <?
			 }
			}
			?>
                    </font> </TD>
                </TR>
              </TBODY>
            </TABLE></td>
        </tr>
        <?php
		}
      ?>
      </table>
<?
}// end main
include "template.php";
?>
