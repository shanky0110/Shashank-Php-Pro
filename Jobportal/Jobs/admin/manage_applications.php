<?
//include "logincheck.php";
include_once "myconnect.php";
include_once "date_time_format.php";

	if(!isset($_REQUEST["sb_uid"]) || (!is_numeric($_REQUEST["sb_uid"])) )
	{
		header("Location: employers.php?msg=".urlencode("Invalid Id, cannot continue"));
		die();
	}
	$sb_uid=$_REQUEST["sb_uid"];
	$sbq_mem="select * from sbjbs_employers where sb_id=$sb_uid";
//	echo $sbq_mem;
	$sbrow_mem=mysql_fetch_array(mysql_query($sbq_mem));
	if(!$sbrow_mem)
	{
		header("Location: employers.php?msg=".urlencode("Invalid Id, cannot continue"));
		die();
	}
	$sb_empname=$sbrow_mem["sb_username"];
	
	$mem_q=mysql_query("select * from sbjbs_jobs  where sb_uid=$sb_uid order by sb_id desc");
	$sb_job_list='-1';
	while($mem=mysql_fetch_array($mem_q))
		$sb_job_list.=','.$mem["sb_id"];
			 
function main()
{
	global $sb_job_list, $sb_empname, $sb_uid;
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$recperpage=$config["sb_recperpage"];
	
	$sb_null_char=$config["sb_null_char"];
	$strpass="";

	$sblabel="All applications";
	$sbq_job="select *,UNIX_TIMESTAMP(sb_applied_on) as sbposted from sbjbs_applications where 1";
//================================================================
	if(isset($_REQUEST["recperpage"]) && (is_numeric($_REQUEST["recperpage"])) )
	{
		$strpass.="&recperpage=".$_REQUEST["recperpage"];
		$recperpage=$_REQUEST["recperpage"];
	}

/////----------------------------------------------------
	$sb_job_id=0;
	if(isset($_REQUEST["sb_job_id"]) && (is_numeric($_REQUEST["sb_job_id"])) )
	{
		$strpass.="&sb_job_id=".$_REQUEST["sb_job_id"];
		$sb_job_id=$_REQUEST["sb_job_id"];
		$sbq_job.=" and sb_job_id=$sb_job_id";
	}
	else
		$sbq_job.=" and sb_job_id in ($sb_job_list)";
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
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Applications 
            <?php 
			echo ($sb_empname)?" for employer $sb_empname":''; ?></strong></font></td>
        </tr>
        <form name="search_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
          <tr align="left" valign="top"> 
            <td width="50%" bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Job 
                Title :</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <select name="sb_job_id">
                <option value="">All Jobs</option>
                <?php
			 $mem_q=mysql_query("select * from sbjbs_jobs  where sb_uid=$sb_uid order by sb_id desc");
			 while($mem=mysql_fetch_array($mem_q))
			 {
              ?>
                <option value="<?php echo $mem["sb_id"];?>"<?php if($sb_job_id==$mem["sb_id"]) 
				{
					echo "selected";
					$sblabel="Applications received for job ".$mem["sb_title"];
				}	?>><?php echo $mem["sb_title"];?></option>
                <?php 
			  }
			  ?>
              </select>
              </font></font></td>
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
            <td><input type="submit" name="Submit2" value="Search"> 
              <input name="sb_uid" type="hidden" id="sb_uid" value="<?php echo $sb_uid; ?>"> 
            </td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr> 
    <td > <table width="90%" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td><font class="normal">Total <font class="red"><b><?php echo $rcount;?></b></font> 
            application<?php echo ($rcount!=1)?'s':''; ?> found</font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr > 
          <td colspan="2" valign="top" class="onepxtable"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertablestyle">
              <tr> 
                <td height="25" class="titlestyle">&nbsp;<strong><?php echo $sblabel; ?></strong></td>
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
                              <table width="100%" border="0" cellspacing="1" cellpadding="1" >
                                <tr> 
                                  <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp;<a href="view_resume.php?resume_id=<?php echo $job["sb_resume_id"]; ?>" title="View Resume"><?php 
								
		$sbq_res="select * from sbjbs_resumes where sb_id=".$job["sb_resume_id"];
	//	echo $sbq_res;
		$sbrow_res=mysql_fetch_array(mysql_query($sbq_res));
		echo $sbrow_res["sb_title"];               ?></a></font></td>
                                </tr>
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <?
					//	  if($view=="desc")
						  {                          ?>
                                      <tr valign="top"> 
                                        <td width="20%"><strong><font class="smalltext">&nbsp;Objective</font></strong></td>
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
                                        <td width="20%"><strong><font class="smalltext">&nbsp;Target 
                                          Job</font></strong></td>
                                        <td><font class="smalltext"> <?php echo $sbrow_res["sb_target_job"]; ?> 
                                          </font></td>
                                      </tr>
                                      <?php
						  }//if descriptive view
                          ?>
                                      <tr valign="top"> 
                                        <td width="20%"><strong><font class="smalltext">&nbsp;Career 
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
                                        <td width="20%"><strong><font class="smalltext">&nbsp;Total 
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
                                        <td><strong><font class="smalltext">&nbsp;Applied 
                                          On </font></strong></td>
                                        <td><font class="smalltext"> 
                                          <?php
							  echo sb_date($job["sbposted"]);
							  ?>
                                          </font></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td></td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                          <tr> 
                            <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;[&nbsp;<a href="delete_application.php?sb_id=<?php echo $job["sb_id"]."&sb_uid=$sb_uid";?>" class="small_link" onClick="return confirm('Do you really want to remove the request ?');" title="Remove this request">Delete</a>&nbsp;]<?php 
		if($job["sb_cover_id"]>0)
		{
		?>&nbsp;&nbsp;[&nbsp;<a href="view_cover_letter.php?sb_id=<?php echo $job["sb_cover_id"];?>" class="small_link" title="View cover letter" >View 
                              Cover Letter</a>&nbsp;]<?php 
		}		//end if?></font></td>
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
                        applications found satisfying your search criteria</font></td>
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
                <td><font class="normal"> 
                  <?php
		  	if($pages>1)
			{	
			echo "Page $pg of $pages<br>";	
			}
			?>
                  </font></td>
                
          <td width="40%" align="right"><font class="normal">&nbsp; </font></td>
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
