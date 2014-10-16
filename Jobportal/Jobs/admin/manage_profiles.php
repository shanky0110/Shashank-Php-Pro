<?php
include "logincheck.php";
include_once "myconnect.php";

function main()
{
	$strpass="";
	$keyword="";
	$searchkeyword="";
	$recperpage=0;
	$show=1;
	$id=0;
	$search_str="";
	$cat_str="";
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$recperpage=$config["sb_recperpage"];
	//=============================================keyword search
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
				$search_str="(sb_name like '%$key%' or sb_profile like '%$key%') ";
				}
				else
				{
				$search_str.=" $log_operator (sb_name like '%$key%' or sb_profile like '%$key%') ";
				}
			}
			$search_str=" and ($search_str)";
		}// end if AND/ OR keywords	
		else
		{
		$search_str=" and (sb_name like '%$searchkeyword%' or sb_profile like '%$searchkeyword%') ";
		}

	}
	//=================================================category search
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
	$cat_str="-1";
	$job_cat_q=mysql_query("select * from sbjbs_profile_cats where sb_cid in ($cid_list)");
	while($job_cat=mysql_fetch_array($job_cat_q))
	{
		$cat_str.=",".$job_cat["sb_company_id"];
	}	
	
	$cat_str=" and sb_id in ($cat_str)";

	}
	//=============================================approved/not approved
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
	//====================================================Employer Search
	$id=0;
	$emp_str="";
	if(isset($_REQUEST["sb_id"]) && (is_numeric($_REQUEST["sb_id"])) )
	{
		$strpass.="&sb_id=".$_REQUEST["sb_id"];
		$id=$_REQUEST["sb_id"];
		$emp_str=" and sb_uid=$id";
	}
	//===============
	$sbq_resume="select *,UNIX_TIMESTAMP(sb_posted_on) as sbposted from sbjbs_companies 
	where 1 $search_str $sb_approval_str $cat_str $emp_str order by sb_id desc";
	//echo $sbq_resume;
	$sbq_resume=mysql_query($sbq_resume);
	$num_jobs=mysql_num_rows($sbq_resume);
///////////////////////////////////PAGINATION /////////
	if(!isset($_REQUEST["pg"]))
	{
			$pg=1;
	}
	else 
	{
	$pg=$_REQUEST["pg"];
	}
	
$rcount=mysql_num_rows($sbq_resume);
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
while ( $jmpcnt<=($pg-1)*$recperpage  && $row = mysql_fetch_array($sbq_resume) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}

//////////////////////////////////////////////////////////////////////// 

	?>
	
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr> 
    <td valign="top" > <div align="center"><font class='red'> </font> </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
              <tr> 
                <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
                  Companies</strong></font></td>
              </tr>
              <form name="search_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
                <tr> 
                  <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Keyword:</font></strong></div></td>
                  <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
                </tr>
                <tr align="left" valign="top"> 
                  <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Employer:</strong></font></div></td>
                  <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
                    <select name="sb_id">
                      <option value="">All Members</option>
                      <?php
			 $mem_q=mysql_query("select * from sbjbs_employers order by sb_username");
			 while($mem=mysql_fetch_array($mem_q))
			 {
              ?>
                      <option value="<?php echo $mem["sb_id"];?>"<?php if($id==$mem["sb_id"]) echo " selected";?>><?php echo $mem["sb_username"];?></option>
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
          <td valign="top"> <table width="90%" border="0" align="center" cellpadding="2" cellspacing="10" class="onepxtable">
              <tr > 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="innertablestyle">
                    <tr> 
                      <td height="25" class="titlestyle">&nbsp;Company Profiles</td>
                    </tr>
                    <tr> 
                        <td valign="top"><?php 
				$cnt=0;
					while( ($sbrow_resume=mysql_fetch_array($sbq_resume)) && ($cnt<$recperpage))
							{
							$mem=mysql_fetch_array(mysql_query("select * from sbjbs_employers where sb_id=".$sbrow_resume["sb_uid"]));
							$cnt++;
							?>
                          <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1"
							 bgcolor="<? if($cnt%2<>0){echo "#F5F5F5"; }else{echo "#FFFFFF";}?>">
                            <tr> 
                              <td width="75" ><font class="smalltext"> #&nbsp;<?php echo $sbrow_resume["sb_id"];//$cnt;?></font></td>
                              <td valign="top"><font class="normal"><strong> 
                                <?php 
                                  echo $sbrow_resume["sb_name"]; 
                                ?>
                                </strong></font> <font color="#444444" size="1" face="Arial, Helvetica, sans-serif">Posted 
                                by <?php echo $mem["sb_username"];?></font></td>
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
			echo ($sbrow_count>0)?'<a href="jobs.php?company='.$sbrow_resume["sb_id"].'" title="View jobs posted for the company">'.$sbrow_count.'</a>':$sbrow_count;
			?>
                                      )</font></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td >&nbsp; </td>
                              <td valign="top"><font class="smalltext">&nbsp;[&nbsp;<a href="view_profile.php?id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="View company profile">View</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="companyprofile.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="Update Job">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_comp_profile.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" onClick="return confirm('Do you really want to remove the company ?');" title="Remove company">Delete</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="approve_profile.php?sb_id=<? echo $sbrow_resume["sb_id"];?>"  title="Approve/disapprove company"><?php echo($sbrow_resume["sb_approved"]=='yes')?'Disapprove':'Approve';?></a>&nbsp;]&nbsp;</font></td>
                            </tr>
                          </table>
                          <?
						}
						if($cnt==0)
						{
						
              ?><br>
              <table width="65%" border="1" align="center" cellpadding="5" bordercolor="#333333" bgcolor="#FEFCFC" >
                <tr> 
                  <td align="center"><font color="#666666"><b><font face="verdana, arial" size="1"> 
                    No Company satisfies the criteria you specified. </font></b></font></td>
                </tr>
              </table>
              <br><?php
						}
                        ?></td>
                    </tr>
                    <tr>
                      <td height="25" valign="top" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Pages: 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
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
                        </font></strong></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td align="center"></td>
        </tr>
      </table></td>
  </tr>
</table>
  <?
}// end main
include "template.php";
?>