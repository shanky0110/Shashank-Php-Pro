<?
//include "logincheck.php";
include_once "myconnect.php";
include_once "date_time_format.php";

function main()
{

	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$recperpage=$config["sb_recperpage"];
	
	$sb_null_char=$config["sb_null_char"];
	$strpass="";
	$keyword="";
	$catpath="";
	$searchkeyword="";
	$cid_list="";
	$loc_id_list="";
	$view="brief";
	$company_id=0;
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
	$cid=0;
	if(isset($_REQUEST["cid"])&&($_REQUEST["cid"]<>""))
	{
	$strpass.="&cid=".$_REQUEST["cid"];
			$cid=$_REQUEST["cid"];
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
	
	//=================================catpath code
	$catname="";
	$category=0;
  	
  	$cat_query=mysql_query("Select * from sbjbs_categories where sb_id=" . $cid );
	if ($cat=mysql_fetch_array($cat_query))
	{
	$catname=$cat["sb_cat_name"];
	$category=$cat["sb_id"];
	}

	$catpath="";
  	$cat_query=mysql_query("Select * from sbjbs_categories where sb_id=" . $cid );
	while ($rs=mysql_fetch_array($cat_query))
    {
    $catpath =" > <a href=\"browsecats.php?cid=" . $rs["sb_id"] . "\">" .$rs["sb_cat_name"]."</a>".$catpath; 
  	$cat_query=mysql_query("Select * from sbjbs_categories where sb_id=" . $rs["sb_pid"] );
	 
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
	
	$sb_approval_str='';
	$show=1;
	if(isset($_REQUEST["show"]) && is_numeric($_REQUEST["show"]))
	{
		$strpass.="&show=".$_REQUEST["show"];
		if($_REQUEST["show"]==2)
		{
			$sb_approval_str=" and sb_approved='yes'";
			$show=2;
		}
		elseif($_REQUEST["show"]==3)
		{
			$sb_approval_str=" and sb_approved='no'";
			$show=3;
		}
	}
	$sbq_job="select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_jobs where 1 $sb_approval_str";
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
				$search_str="(sb_title like '%$key%' or sb_description like '%$key%' 
				or sb_role like '%$key%') ";
				}
				else
				{
				$search_str.=" $log_operator (sb_title like '%$key%' or sb_description like '%$key%' 
				or sb_role like '%$key%') ";
				}
			}
			$sbq_job.=" and ($search_str)";
		}// end if AND/ OR keywords	
		else
		{
		$sbq_job.=" and (sb_title like '%$searchkeyword%' or sb_description like '%$searchkeyword%' 
		or sb_role like '%$searchkeyword%') ";
		}
}	
	//============================================================
//=======================category search==========================
if((count($cid_list)>0)&&($cid_list<>""))
{
	$cat_str="-1";
	$job_cat_q=mysql_query("select * from sbjbs_job_cats where sb_cid in ($cid_list)");
	while($job_cat=mysql_fetch_array($job_cat_q))
	{
		$cat_str.=",".$job_cat["sb_job_id"];
	}	
	
	$sbq_job.=" and sb_id in ($cat_str)";
}
//================================================================
//=======================Location search==========================
if((count($loc_id_list)>0)&&($loc_id_list<>""))
{
	$loc_str="-1";
	$job_loc_q=mysql_query("select * from sbjbs_job_locs where sb_lid in ($loc_id_list)");
	while($job_loc=mysql_fetch_array($job_loc_q))
	{
		$loc_str.=",".$job_loc["sb_job_id"];
	}	
	
	$sbq_job.=" and sb_id in ($loc_str)";
}
//================================================================
	if(isset($_REQUEST["recperpage"]) && (is_numeric($_REQUEST["recperpage"])) )
	{
		$strpass.="&recperpage=".$_REQUEST["recperpage"];
		$recperpage=$_REQUEST["recperpage"];
	//	$sbq_job.=" and sb_uid=$id";
	}

/////----------------------------------------------------
	$id=0;
	if(isset($_REQUEST["sb_id"]) && (is_numeric($_REQUEST["sb_id"])) )
	{
		$strpass.="&sb_id=".$_REQUEST["sb_id"];
		$id=$_REQUEST["sb_id"];
		$sbq_job.=" and sb_uid=$id";
	}

//===================================== Experience Search =================================
if(isset($_REQUEST["work_exp"])&&($_REQUEST["work_exp"]<>""))
{
	$strpass.="&work_exp=".$_REQUEST["work_exp"];
	$sbq_job.=" and (sb_experience=".$_REQUEST["work_exp"]." or sb_experience=-1)";
}
//===================================Company Search===========================================
if(isset($_REQUEST["company"]) &&($_REQUEST["company"]<>""))
{
	$strpass.="&company=".$_REQUEST["company"];
	$company_id=$_REQUEST["company"];
	$sbq_job.=" and sb_company_id=".$_REQUEST["company"];
}
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




<table width="100%" border="0" cellspacing="10" cellpadding="2" class="maintablestyle">
  <tr>
    <td ><table width="92%" border="0" align="center" cellpadding="2" cellspacing="10">
        <tr> 
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
            Jobs</strong></font></td>
        </tr>
        <form name="search_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
          <tr> 
            <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Keyword:</font></strong></div></td>
            <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
          </tr>
          <tr align="left" valign="top"> 
            <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Company:</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <select name="company" id="company">
                <option value="">All Companies</option>
                <?php
			 $mem_q=mysql_query("select * from sbjbs_companies order by sb_name");
			 while($mem=mysql_fetch_array($mem_q))
			 {
              ?>
                <option value="<?php echo $mem["sb_id"];?>"<?php if($company_id==$mem["sb_id"]) echo " selected";?>><?php echo $mem["sb_name"];?></option>
                <?php 
			  }
			  ?>
              </select>
              </font></font></td>
          </tr>
          <tr align="left" valign="top"> 
            <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Show:</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input name="show" type="radio" value="1" <? if($show==1) { echo "checked";}?>>
              All</font></font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input type="radio" name="show" value="2" <? if($show==2) { echo "checked";}?> >
              Approved 
              <input type="radio" name="show" value="3" <? if($show==3) { echo "checked";}?> >
              Unapproved</font></td>
          </tr>
          <tr> 
            <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Record 
                Per Page:</font></strong></div></td>
            <td><select name="recperpage">
                <option value="<?php echo $config["sb_recperpage"];?>" <? 
				if($recperpage==$config["sb_recperpage"]) { echo "selected";}?>>Default</option>
                <option value="10" <? if($recperpage==10) { echo "selected";}?>>10</option>
                <option value="20" <? if($recperpage==20) { echo "selected";}?>>20</option>
                <option value="30" <? if($recperpage==30) { echo "selected";}?>>30</option>
                <option value="50" <? if($recperpage==50) { echo "selected";}?>>50</option>
                <option value="100" <? if($recperpage==100) { echo "selected";}?>>100</option>
              </select></td>
          </tr>
          <tr> 
            <td bgcolor="#F5F5F5">&nbsp;</td>
            <td><input type="submit" name="Submit2" value="Search"> </td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr> 
    <td > <table width="90%" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><font class="normal">Total <font class="red"><b><?php echo $rcount;?></b></font> 
            Job(s) Found</font></td>
          <?php 
		  if(isset($_SESSION["sbjbs_userid"]) && isset($_REQUEST["show_save"]) &&($rcount > 0))
		  {
          ?>
          <form name="save_search"  id="save_search" method="post">
          </form>
          <?
			}
        ?>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr > 
          <td colspan="2" valign="top" class="onepxtable"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertablestyle">
              <tr> 
                <td height="25" class="titlestyle"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="titlestyle">
                    <tr> 
                      <td>&nbsp;&nbsp;All Jobs</td>
                      <?php
					if($view=="brief")
                    {
					?>
                      <td width="40%">&nbsp;Company</td>
                      <td width="20%">&nbsp;Experience</td>
                      <?php
					}
                  ?>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td align="left" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <?php 
					$cnt=0;
						while(($job=mysql_fetch_array($sbq_job))&&($cnt<$recperpage))
					  	{
						$cnt++;	
						
						$bgcolor="#FFFFFF";
						if($cnt%2==0)
						{ $bgcolor="#F5F5F5"; }
						?>
                    <tr valign="top"> 
                      <td> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="<? echo $bgcolor;?>">
                          <tr> 
                            <td> 
                              <?
						  if($view=="desc")
						  {
                          ?>
                              <table width="100%" border="0" cellspacing="1" cellpadding="1" >
                                <tr> 
                                  <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<strong><a href="view_job.php?sb_id=<?php echo $job["sb_id"]; ?>"  title="View job"><?php 
							 echo $job["sb_title"];
							?></a></strong></font></td>
                                </tr>
                                <tr> 
                                  <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                      <tr valign="top"> 
                                        <td ><font class="smalltext"><strong>Role</strong></font></td>
                                        <td ><font class="normal"><? echo $job["sb_role"];?></font></td>
                                      </tr>
                                      <tr valign="top"> 
                                        <td width="25%" ><font class="smalltext"><strong>Experience 
                                          Level</strong></font></td>
                                        <td width="75%" ><font class="normal"> 
                                          <?php 
    	switch($job["sb_experience"])
		{
			case -1:	echo 'No preference'; break;
			case 0:		echo 'Fresher'; break;
			case 1:		echo 'Less than 1 Year'; break;
			case 2:		echo '1 to 2 Years'; break;
			case 3:		echo '2 to 5 Years'; break;
			case 4:		echo '5 to 7 Years'; break;
			case 5:		echo '7 to 10 Years'; break;
			case 6:		echo '10 to 15 Years'; break;
			case 7:		echo 'More than 15 Years'; break;
		}	//end switch ?>
                                          </font> </td>
                                      </tr>
                                      <tr valign="top"> 
                                        <td width="25%" ><font class="smalltext"><strong>Educational 
                                          Qualification</strong></font></td>
                                        <td ><font class="normal"> 
                                          <?php 	
					$sbq_cur="select * from sbjbs_degrees where sb_id=".$job["sb_education"];
					//echo $sbq_cur;
					$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));
					if($sbrow_cur)
						echo $sbrow_cur['sb_degree'];
					else
						echo 'No preference';	?>
                                          </font></td>
                                      </tr>
                                      <tr valign="top"> 
                                        <td width="25%" ><font class="smalltext"><strong>Salary</strong></font></td>
                                        <td ><font class="normal"> 
                                          <?php 
			if( ($job["sb_min_salary"] > 0) || ($job["sb_max_salary"] > 0) )
	  		{	
				$sbq_cur='select * from sbjbs_currencies where sbcur_id='.$job["sb_currency"];
			 	$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));	
				echo ($job["sb_min_salary"]>0)?"Minimum - ".number_format($job["sb_min_salary"],2):'';
				echo ( ($job["sb_min_salary"]>0) && ($job["sb_max_salary"]>0) )?', ':'';
				echo ($job["sb_max_salary"]>0)?"Maximum - ".number_format($job["sb_max_salary"],2).' ':' ';
				echo $sbrow_cur["sbcur_name"].' ';
				switch($job["sb_salary_type"])
				{
                	case 0: echo $sb_null_char; break;
					case 1: echo "Per Year"; break;
					case 2: echo "Per Month"; break;
					case 3: echo "Per Week"; break;
					case 4: echo "Fortnightly"; break;
					case 5: echo "Per Hour"; break;
				}	//end switch
				
			}	//end if job["sb_min_salary"]
			else
				echo $sb_null_char;	?>
                                          </font></td>
                                      </tr>
                                      <tr valign="top"> 
                                        <td ><font class="smalltext"><strong>Description</strong></font></td>
                                        <td ><font class="normal"><font class="smalltext"> 
                                          <?php 
							
							if (strlen ($job["sb_description"])>150)
							{
							 echo substr($job["sb_description"], 0,  strrpos( substr($job["sb_description"], 0, 150),' ' ))." ...";  
							}
							else
							{
							 echo $job["sb_description"];  
							}
							?>
                                          </font></font></td>
                                      </tr>
                                      <tr valign="top"> 
                                        <td ><font class="smalltext"><strong>Company</strong></font></td>
                                        <td ><font class="normal"><a href="view_profile.php?id=<?php echo $job["sb_company_id"]; ?>"  title="View company profile"><? 
							$comp=mysql_fetch_array(mysql_query("select * from sbjbs_companies 
							where sb_id=".$job["sb_company_id"]));
							
							echo $comp["sb_name"];?></a>
                                          </font>,&nbsp;&nbsp;<font class="smalltext"> 
                                          <?php
							echo "Vacancies <font class='red'>[ ";
							if($job["sb_vacancies"]>0)
							echo $job["sb_vacancies"];
							else
							echo $config["sb_null_char"];
							echo " ]</font>";
							
							echo "&nbsp;&nbsp;Posted on:&nbsp;".sb_date($job["sbposted"]); 
							 ?>
                                          </font></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td></td>
                                </tr>
                              </table>
                              <?php
						  }//if descriptive view
						  else
						  {
                          ?>
                              <table width="100%" border="0" cellspacing="1" cellpadding="1"  bgcolor="<? echo $bgcolor;?>">
                                <tr> 
                                  <td width="40%"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<strong><a href="view_job.php?sb_id=<?php echo $job["sb_id"]; ?>"  title="View job"><?php 
							echo $job["sb_title"];
							?></a></strong></font></td>
                                  <td width="40%"><font class="normal"><a href="view_profile.php?id=<?php echo $job["sb_company_id"]; ?>"  title="View company profile" ><? 
							$comp=mysql_fetch_array(mysql_query("select * from sbjbs_companies 
							where sb_id=".$job["sb_company_id"]));
							
							
							echo $comp["sb_name"];
							
							
							?></a>
                                    </font></td>
                                  <td><font class="normal"> 
                                    <?php 
							
    	switch($job["sb_experience"])
		{
			case -1:	echo 'No preference'; break;
			case 0:		echo 'Fresher'; break;
			case 1:		echo 'Less than 1 Year'; break;
			case 2:		echo '1 to 2 Years'; break;
			case 3:		echo '2 to 5 Years'; break;
			case 4:		echo '5 to 7 Years'; break;
			case 5:		echo '7 to 10 Years'; break;
			case 6:		echo '10 to 15 Years'; break;
			case 7:		echo 'More than 15 Years'; break;
		}	//end switch 
							
							?>
                                    </font></td>
                                </tr>
                                <tr> 
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                              </table>
                              <?php
						  }// end if brief view
						  ?>
                            </td>
                          </tr>
                          <tr> 
                            <td><font face="Arial, Helvetica, sans-serif" size="1">&nbsp;&nbsp;[&nbsp;<a href="approve_job.php?sb_id=<? echo $job["sb_id"];?>"  title="Approve/disapprove job"><?php echo($job["sb_approved"]=='yes')?'Disapprove':'Approve';?></a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="edit_job.php?sb_id=<? echo $job["sb_id"];?>"  title="Update job">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_job.php?sb_id=<? echo $job["sb_id"];?>"  title="Remi\ove job" onClick="javascript: return confirm('Do you really want to delete the job ?');">Delete</a>&nbsp;]&nbsp;</font></td>
                          </tr>
                          <tr>
                            <td height="5"></td>
                          </tr>
                        </table>
                        
                      </td>
                    </tr>
                    <?php 
						}		//end while 
						if($cnt==0)
						{?>
                    
                          <tr> 
                            <td align="center" height="25"> <font class='normal'>No 
                              jobs found satisfying your search criteria</font></td>
                          </tr>
                          <?php 
				}
                  ?>
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
                <td><font class="normal">&nbsp; 
                  
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
                
          <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" bgcolor="#004080"> <p> <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> 
                    &nbsp;Pages: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <?

if ($pg>1) 
{
      echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".($pg-1).$strpass."' class='pagelink'><font color='#FFCC00'>"; 
    
}//end if
if ($pages<>1)
echo "Previous";
if ($pg>1)
{
echo "</font></a>&nbsp;";
}//end if
echo " ";
for ($i=1; $i<=$pages; $i++)
{
	if ($pg<>$i)
	{
	echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".$i.$strpass."' class='pagelink'><font color='#FFCC00'>"; 
	echo $i; 
    echo "</font></a>&nbsp;";
	}
	else
	{
	echo "&nbsp;".$i."&nbsp;";
	}
}//for
echo " ";
	if ($pg<$pages )
	{
	echo "&nbsp;<a href='".$_SERVER['PHP_SELF']."?pg=".($pg+1).$strpass."' class='pagelink'><font color='#FFCC00'>"; 
	}//end if
	if ($pages<>1)
	{
	echo "Next";
	}//end if
	if ($pg<>($pages))
	{
    echo "</font></a>&nbsp;"; 
	}//end if
?>
                    </font></strong></p></td>
              </tr>
            </table></td>
              </tr>
              <?php
		}
      ?>
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
