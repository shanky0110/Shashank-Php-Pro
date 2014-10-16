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
	$catname="";
	$sql_outter="Select * from sbjbs_locations where sb_id=$loc_id" ;
    $rs_outter=mysql_query($sql_outter );
	if ($rs_outter=mysql_fetch_array($rs_outter))
	{
    $catname = "<font size='2' >&nbsp;-&nbsp;</font><a href=\"browselocs.php?loc_id=" . $rs_outter["sb_id"] . "\"><font size='2' face='Arial, Helvetica, sans-serif'>".$rs_outter["sb_loc_name"]."</font></a>";
    $loc_id = $rs_outter["sb_id"];
	$pid = $rs_outter["sb_pid"];
	
	while($pid<>0)
	{
	$cat=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_id=$pid"));
	$pid=$cat["sb_pid"];
	$catname="<font size='2' > -&nbsp;</font><a href=\"browselocs.php?loc_id=" . $cat["sb_id"] . "\"><font size='2' face='Arial, Helvetica, sans-serif'>" .$cat["sb_loc_name"]."</font></a>" .$catname;
	
	}
	
	}

  
////////////////////////////////////////////////////////////
//////////////////DELETE Location///////////////////////////
////////////////////////////////////////////////////////////
if ( isset( $_REQUEST["delete"] ) && $_REQUEST["delete"]=="Yes" )
{
  	   $sub_cats=mysql_num_rows(mysql_query("select * from sbjbs_locations where sb_pid=".$_REQUEST["delid"]));
	   $listing1=mysql_num_rows(mysql_query("select * from sbjbs_job_locs 
	   where sb_lid=".$_REQUEST["delid"]));
	   $listing2=mysql_num_rows(mysql_query("select * from sbjbs_resume_locs 
	   where sb_loc_id=".$_REQUEST["delid"]));
/*	   $listing3=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
	   where sb_loc_id=".$_REQUEST["delid"]));
	*/   
	   if($sub_cats<>0)
	   {
	   $delmsg=" This Location cannot be deleted as it contains Sub Locations. To delete this Location you need to delete all its sub locations.";
	   }
	   elseif( ($listing1<>0) || ($listing2<>0))// || ($listing3<>0))
	   {
	   		$delmsg="This Location has following contents<br>";
			if($listing1<>0)
	   			$delmsg.=($listing1 > 1)?"$listing1 Jobs<br>":"$listing1 Job<br>";
			if($listing2<>0)
	   			$delmsg.=($listing2 > 1)?"$listing2 Resumes<br>":"$listing2 Resume<br>";
			$delmsg.=" You have to shift all these to any other Location before deletion.";
	   }
	   else
	   {
	   mysql_query("delete from sbjbs_locations where sb_id=" . $_REQUEST["delid"] );
	   $delmsg=" Location has been deleted"; 
	   }

}
//////////////////////////////////////////////////////////////
////////////////  Location has been Deleted //////////////////
//////////////////////////////////////////////////////////////
$loc_name="";
?>
<script language="JavaScript">
function del_confirm()
{
return confirm('Do you really want to delete the Location?');
}

</script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="1" >
        <tr> 
          <td valign="top">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
            
              <tr> 
                <td valign="top"> 
         
                  <table width="100%" border="0" cellspacing="10" cellpadding="2">
                    <tr> 
                      <td> 
                        <?
					$errcnt=0;
					$showform="";
					
					$mailid="";
					$fromid="";
					$subject="";
					$mail="";
					
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
						$errs[$errcnt]="Location with this name already exists.";
						$errcnt++;
					 }
					}
					
/*					$num_ques=0;
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_job_locs
					where sb_lid=".$_REQUEST["loc_id"]));
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_resume_locs 
					where sb_loc_id=".$_REQUEST["loc_id"]));
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
					where sb_loc_id=".$_REQUEST["loc_id"]));
						
					if( $num_ques>0)
					{
						$errs[$errcnt]="This Location contains some listings, you have to shift all these listings to any other Location before adding a sub location.";
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

			$sql="Insert into sbjbs_locations (sb_loc_name,sb_pid) values 
			('$loc_name',".$_REQUEST["loc_id"].")";
			$rs=mysql_query( $sql);
/*			$sql="select max(sb_order_index) from sbjbs_locations";
			if( $rs_t1=mysql_fetch_array(mysql_query($sql) ))
				{
					$val=$rs_t1[0] + 1;
				}
				else
				{
					$val=0;
				}
						
				$sql="select max(sb_id) from sbjbs_locations";
				if( $rs_t1=mysql_fetch_array(mysql_query($sql) ))
				{
					 $sql="UPDATE sbjbs_locations SET sb_order_index=$val  Where  sb_id= ".$rs_t1[0];
					 mysql_query($sql);
				}
*/
	$loc_name="";

?>
                        <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Location 
                        has been Added</font> 
                        <?

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
                            <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> 
                              Your Add Location Request cannot be processed due 
                              to following Reasons</font></td>
                          </tr>
                          <?

		for ($i=0;$i<$errcnt;$i++)
		{
		?>
                          <tr valign="top"> 
                            <td width="6%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $i+1; ?></font></td>
                            <td width="94%" align="left"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo  $errs[$i]; ?> 
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
                        <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> 
                        <?
	   if (isset($delmsg))
	   {
	   echo $delmsg;
	   }
	   ?>
                        </font> </td>
                    </tr>
                    <tr> 
                      <td><a href="browselocs.php?loc_id=0"><font size='2' face='Arial, Helvetica, sans-serif'>All 
                        locations</font></a><font size="2" face="Arial, Helvetica, sans-serif"><? echo $catname;?> 
                        </font></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="50%" height="25" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Location</font></strong></td>
                            <td width="15%" bgcolor="#004080">&nbsp;</td>
                            <td width="35%" height="25" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Options</font></strong></td>
                          </tr>
                          <?php
	$rs_query=mysql_query("Select * from sbjbs_locations where sb_pid=$loc_id order by sb_loc_name" );
	$cat_num=mysql_num_rows($rs_query);
	if($cat_num==0)
	{

	$list_num=mysql_num_rows(mysql_query("select * from sbjbs_job_locs where sb_lid=$loc_id"));
	$sbq_resume="select * from sbjbs_resume_locs where sb_loc_id=$loc_id";
	$list_num2=mysql_num_rows(mysql_query($sbq_resume));
//	$list_num3=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats where sb_loc_id=$loc_id"));	
	?>
                          <tr> 
                            <td colspan="3" align="center">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="3"><font size="2"  color="#990000" face="Arial, Helvetica, sans-serif">This 
                              Location doesn't contain any sub Location. 
                              <? 
							  if($list_num>0)
							  {
							  ?>
                              <br>
                              Click <a href="jobs.php?loc_id=<?php echo $loc_id; ?>">Jobs</a> 
                              (<? echo $list_num;?>) to list the Jobs of this 
                              Location. 
                              <?
							  }
							  if($list_num2>0)
							  {
							  ?>
                              <br>
                              Click <a href="resumes.php?loc_id=<?php echo $loc_id; ?>">Resumes</a> 
                              (
                              <? 
							  echo $list_num2;?>
                              ) to list the resumes of this Location. 
                              <?
							  }
							  /*if($list_num3>0)
							  {
							  ?>
                              <br>
                              Click <a href="profiles.php?loc_id=<?php echo $loc_id; ?>">Company 
                              Profiles</a> (
                              <? 
							  echo $list_num3;?>
                              ) to list the company profiles of this Location. 
                              <?
							  }*/
							  ?>
                              </font></td>
                          </tr>
                          <?php
	}
	else
	{
	while ($rs=mysql_fetch_array($rs_query))
	{
	
			//$rst1_query=mysql_query("Select * from sbjbs_locations where sb_pid=" . $rs["sb_id"] );
			$clist=$rs["sb_id"];
			/*while ( $rst1=mysql_fetch_array($rst1_query) )
			{
				$clist.="," . $rst1["sb_id"];
				while ( $rst1=mysql_fetch_array($rst1_query) )
				{ 
					$clist.="," . $rst1["sb_id"];
				}
				
				$rst1_query=mysql_query("Select * from sbjbs_locations where 
				sb_pid IN (" . $clist . ") and sb_id not in ( ". $clist . ")") ;
				

			}*/
				$list_resumes=mysql_num_rows(mysql_query("select * from sbjbs_resume_locs 
				where sb_loc_id in ($clist)"));
				$list_jobs=mysql_num_rows(mysql_query("select * from sbjbs_job_locs 
				where sb_lid in ($clist)"));


	?>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<a href="browselocs.php?loc_id=<?php echo $rs["sb_id"]; ?>"><?php echo $rs["sb_loc_name"]; ?></a> 
                              <font color="#333333" size="1">( 
                              <? 
							  
							  echo "Resumes ";
							  if($list_resumes>0)
							  { echo "<a href='resumes.php?loc_id=".$rs["sb_id"]."'>$list_resumes</a>";}
							  else
							  { echo $list_resumes;}
							  echo ", Jobs ";
							  if($list_jobs>0)
							  { echo "<a href='jobs.php?loc_id=".$rs["sb_id"]."'>$list_jobs</a>";}
							  else
							  { echo $list_jobs;}
							  ?>
                              )</font></font>&nbsp;</font></td>
                            <td><font  face="Arial, Helvetica, sans-serif" color="#333333" size="1"><? if($rs["sb_default"]<>0) echo "default";?></font></td>
                            <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                              <a href="browselocs.php?delete=Yes&delid=<?php echo $rs["sb_id"]; ?>&loc_id=<?php echo $loc_id;  ?>" onClick="return del_confirm();">Delete</a> 
                              | <a href="editloc.php?loc_id=<?php echo $rs["sb_id"]; ?>">Edit</a>
							  <?php
							  if(($rs["sb_default"]<>1)&&($rs["sb_pid"]==0))
							  {
                              ?>| <a href="make_default.php?loc_id=<?php echo $rs["sb_id"]; ?>">Make Default</a> 
                              <?php
							  }
							  ?></font></td>
                          </tr>
                          <?php
	}
	}
	?>
                          <tr> 
                            <td height="48">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr> 
                <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                    <form name="form2" method="post" action="browselocs.php">
                      <tr bgcolor="#004080"> 
                        <td height="25" colspan="2" align="left"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Add 
                          New 
                          <? if($loc_id<>0) { echo "Sub Location";} else { echo "Location";}?>
                          </font></strong></td>
                      </tr>
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Location</font><font size="2" face="Arial, Helvetica, sans-serif"> 
                            Name:&nbsp;</font></strong></div></td>
                        <td width="448"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <input name="loc_name" type="text" value="<? echo $loc_name;?>" size="40">
                          <input name="loc_id" type="hidden" id="loc_id" value="<? echo $loc_id;?>">
                          </font></td>
                      </tr>
                      <tr> 
                        <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></strong></td>
                        <td> <input type="submit" name="Submit" value="Add"> </td>
                      </tr>
                    </form>
                  </table></td>
              </tr>
              <tr> 
                <td valign="top"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                    <tr> 
                      <td height="25" colspan="2" align="left" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Shift 
                        Listings</font></strong></td>
                    </tr>
                    <script language="JavaScript">
					function validate(form)
					{
					if(form.loc_id.selectedIndex==0)
					{
					alert('Please choose a Location to shift from'); 
					form.loc_id.focus();
					return false;
					}
					if(form.cat1.selectedIndex==0)
					{
					alert('Please choose a Location in which to shift'); 
					form.cat1.focus();
					return false;
					}

					return true;
					}
					
					</script>
                    <form name="form1" method="post" action="shift_locations.php" onSubmit="return validate(this);">
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">From 
                            Location:&nbsp;</font></strong></div></td>
                        <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <select name="loc_id" id="loc_id" >
                            <option value="0">Select a Location</option>
                            <?
				$rs_query=mysql_query("select * from sbjbs_locations order by sb_pid,sb_loc_name");
				
				  while($rst=mysql_fetch_array($rs_query))
				  {
				  $cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_pid=".$rst["sb_id"]));
									  /*if($child)
									  {
									  continue;
									  }*/
									  $cat_path.=$rst["sb_loc_name"];
		 $par=mysql_query("select * from sbjbs_locations where sb_id=".$rst["sb_pid"]);
		 				while($parent=mysql_fetch_array($par))
		 				{
						$cat_path=$parent["sb_loc_name"]."-".$cat_path;
						$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
						}
					$num=0;
				    
					$num+=mysql_num_rows(mysql_query("select * from sbjbs_job_locs 
					where sb_lid=".$rst["sb_id"]));
					
					$num+=mysql_num_rows(mysql_query("select * from sbjbs_resume_locs 
					where sb_loc_id=".$rst["sb_id"]));
					
					/*$num+=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
					where sb_loc_id=".$rst["sb_id"]));*/
					
				if($num==0)
					{
					continue;
					}
						
                    ?>
                    <option value="<? echo $rst["sb_id"];?>" ><? echo $cat_path." (".$num.")";?></option>
                            <?
									  }
									  ?>
                          </select>
                          </font></td>
                      </tr>
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">To 
                            Location:&nbsp;</font></strong></div></td>
                        <td align="left"> <div align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                            <select name="cat1" id="select3" >
                              <option value="0">Select a Location</option>
                              <?
				  $rs_query=mysql_query("select * from sbjbs_locations order by sb_pid,sb_loc_name ");
				  
				  while($rst=mysql_fetch_array($rs_query))
				  {
				  $cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_pid=".$rst["sb_id"]));
						/*			  if($child)
									  {
									  continue;
									  }
							*/		  $cat_path.=$rst["sb_loc_name"];
		 $par=mysql_query("select * from sbjbs_locations where sb_id=".$rst["sb_pid"]);
		 				while($parent=mysql_fetch_array($par))
		 				{
						$cat_path=$parent["sb_loc_name"]."-".$cat_path;
						$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
						}
                                      ?>
                              <option value="<? echo $rst["sb_id"];?>" ><? echo $cat_path;?></option>
                              <?
									  }
									  ?>
                            </select>
                           </font></div></td>
                      </tr>
                      <tr> 
                        <td align="right" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"></font></div></td>
                        <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <input type="Submit" name="no3" value="Go" >
                          </font></td>
                      </tr>
                    </form>
                  </table></td>
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