<?
include_once("myconnect.php");
include_once("logincheck.php");

function main()
{

	$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$sb_cat_listing=$sbrow_con["sb_cat_listing"];

if ( isset( $_REQUEST["cid"] ) && $_REQUEST["cid"]!="" )
{
$cid=$_REQUEST["cid"];
}
else
{
$cid=0;
}
	$catname="";
	$sql_outter="Select * from sbjbs_categories where sb_id=$cid" ;
    $rs_outter=mysql_query($sql_outter );
	if ($rs_outter=mysql_fetch_array($rs_outter))
	{
    $catname = "<font size='2' >&nbsp;>&nbsp;</font><a href=\"browsecats.php?cid=" . $rs_outter["sb_id"] . "\"><font size='2' face='Arial, Helvetica, sans-serif'>".$rs_outter["sb_cat_name"]."</font></a>";
    $cid = $rs_outter["sb_id"];
	$pid = $rs_outter["sb_pid"];
	while($pid<>0)
	{
	$cat=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_id=$pid"));
	$pid=$cat["sb_pid"];
	$catname="<font size='2' >>&nbsp;</font><a href=\"browsecats.php?cid=" . $cat["sb_id"] . "\"><font size='2' face='Arial, Helvetica, sans-serif'>" .$cat["sb_cat_name"]."</font></a>" .$catname;
	
	}
	
	}

  
////////////////////////////////////////////////////////////
//////////////////DELETE CATEGORY///////////////////////////
////////////////////////////////////////////////////////////
if ( isset( $_REQUEST["delete"] ) && $_REQUEST["delete"]=="Yes" )
{
  	   $sub_cats=mysql_num_rows(mysql_query("select * from sbjbs_categories where sb_pid=".$_REQUEST["delid"]));
	   $listing1=mysql_num_rows(mysql_query("select * from sbjbs_job_cats 
	   where sb_cid=".$_REQUEST["delid"]));
	   $listing2=mysql_num_rows(mysql_query("select * from sbjbs_resume_cats 
	   where sb_cid=".$_REQUEST["delid"]));
	   $listing3=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
	   where sb_cid=".$_REQUEST["delid"]));
	   
	   if($sub_cats<>0)
	   {
	   $delmsg=" This category cannot be deleted as it contains Subcategories. To delete this category you need to delete all its subcategories.";
	   }
	   elseif( ($listing1<>0) || ($listing2<>0) || ($listing3<>0))
	   {
	   		$delmsg="This category has following contents<br>";
			if($listing1<>0)
	   			$delmsg.=($listing1 > 1)?"$listing1 Jobs<br>":"$listing1 Job<br>";
			if($listing2<>0)
	   			$delmsg.=($listing2 > 1)?"$listing2 Resumes<br>":"$listing2 Resume<br>";
			if($listing3<>0)
	   			$delmsg.=($listing3 > 1)?"$listing3 Company Profiles<br>":"$listing3 Company Profiles<br>";
			$delmsg.=" You have to shift all these to any other category before deletion.";
	   }
	   else
	   {
	   mysql_query("delete from sbjbs_categories where sb_id=" . $_REQUEST["delid"] );
	   $delmsg=" Category has been deleted"; 
	   }

}
//////////////////////////////////////////////////////////////
////////////////  CATEGORY has been Deleted //////////////////
//////////////////////////////////////////////////////////////
$cat_name="";
$cat_desc="";
$cost="";
?>
<script language="JavaScript">
function del_confirm()
{
return confirm('Do you really want to delete the category?');
}

</script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="1" dwcopytype="CopyTableCell">
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
					
					if ( !isset( $_REQUEST["cat_name"] ) || $_REQUEST["cat_name"]=="" )
					{
						$errs[$errcnt]="Category name must be provided";
						$errcnt++;
					}
					elseif(preg_match ("/[;]/", $_REQUEST["cat_name"]))
					{
						$errs[$errcnt]="Category name can not have semi colon (;) ";
						$errcnt++;
					}
					else
					{
						if (!get_magic_quotes_gpc()) {
						$cat_name=str_replace('$', '\$',addslashes($_REQUEST["cat_name"]));
						}
						else
						{
						$cat_name=str_replace('$', '\$',$_REQUEST["cat_name"]);
						}

					$par_cat=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_cat_name='".$cat_name."' and sb_pid=".$_REQUEST["cid"]));
					 if($par_cat)
					 {
						$errs[$errcnt]="Category with this name already exists.";
						$errcnt++;
					 }
					}
					
					$num_ques=0;
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_job_cats
					where sb_cid=".$_REQUEST["cid"]));
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_resume_cats 
					where sb_cid=".$_REQUEST["cid"]));
					$num_ques+=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats 
					where sb_cid=".$_REQUEST["cid"]));
						
					if( $num_ques>0)
					{
						$errs[$errcnt]="This category contains some listings, you have to shift all these listings to any other category before adding a subcategory.";
						$errcnt++;
					}
					
					}

	if  (count($_POST)<>0)
	{
	if ( $errcnt==0 )
	{
			if (!get_magic_quotes_gpc()) {
			$cat_name=str_replace('$', '\$',addslashes($_REQUEST["cat_name"]));
			}
			else
			{
			$cat_name=str_replace('$', '\$',$_REQUEST["cat_name"]);
			}

			$sql="Insert into sbjbs_categories (sb_cat_name,sb_pid) values 
			('$cat_name',".$_REQUEST["cid"].")";
			$rs=mysql_query( $sql);
			$sql="select max(sb_order_index) from sbjbs_categories";
			if( $rs_t1=mysql_fetch_array(mysql_query($sql) ))
				{
					$val=$rs_t1[0] + 1;
				}
				else
				{
					$val=0;
				}
						
				$sql="select max(sb_id) from sbjbs_categories";
				if( $rs_t1=mysql_fetch_array(mysql_query($sql) ))
				{
					 $sql="UPDATE sbjbs_categories SET sb_order_index=$val  Where  sb_id= ".$rs_t1[0];
					 mysql_query($sql);
				}

	$cat_name="";

?>
                        <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Category 
                        has been Added</font> 
                        <?

$showform="No";
}
else
{
$cat_name=$_REQUEST["cat_name"];

?>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> 
                              Your Add Category Request cannot be processed due 
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
                      <td><a href="browsecats.php?cid=0"><font size='2' face='Arial, Helvetica, sans-serif'>All 
                        Categories</font></a><font size="2" face="Arial, Helvetica, sans-serif"><? echo $catname;?> 
                        </font></td>
                    </tr>
                    <tr> 
                      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="76%" height="25" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Category</font></strong></td>
                            <td width="24%" height="25" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Options</font></strong></td>
                          </tr>
                          <?php
	$rs_query=mysql_query("Select * from sbjbs_categories where sb_pid=$cid order by sb_order_index" );
	$cat_num=mysql_num_rows($rs_query);
	if($cat_num==0)
	{

	$list_num=mysql_num_rows(mysql_query("select * from sbjbs_job_cats where sb_cid=$cid"));
	$sbq_resume="select * from sbjbs_resume_cats where sb_cid=$cid";
	$list_num2=mysql_num_rows(mysql_query($sbq_resume));
	$list_num3=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats where sb_cid=$cid"));	
	?>
                          <tr> 
                            <td colspan="2" align="center">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="2"><font size="2"  color="#990000" face="Arial, Helvetica, sans-serif">This 
                              Category doesn't contain any sub category. 
                              <? 
							  if($list_num>0)
							  {
							  ?>
                              <br>
                              Click <a href="jobs.php?cid=<?php echo $cid; ?>">Jobs</a> (<? echo $list_num;?>) to list the Jobs of this category.
                              <?
							  }
							  if($list_num2>0)
							  {
							  ?>
                              <br>
                              Click <a href="resumes.php?cid=<?php echo $cid; ?>">Resumes</a> (<? 
							  echo $list_num2;?>) to list the resumes of this category.
                              <?
							  }
							  if($list_num3>0)
							  {
							  ?>
                              <br>
                              Click <a href="manage_profiles.php?cid=<?php echo $cid; ?>">Company Profiles</a> (<? 
							  echo $list_num3;?>) to list the company profiles of this category.
                              <?
							  }
							  ?>
                              </font></td>
                          </tr>
                          <?php
	}
	else
	{
	while ($rs=mysql_fetch_array($rs_query))
	{
	
			$rst1_query=mysql_query("Select * from sbjbs_categories where sb_pid=" . $rs["sb_id"] );
			$clist=$rs["sb_id"];
			while ( $rst1=mysql_fetch_array($rst1_query) )
			{
				$clist.="," . $rst1["sb_id"];
				while ( $rst1=mysql_fetch_array($rst1_query) )
				{ 
					$clist.="," . $rst1["sb_id"];
				}
			
		$rst1_query=mysql_query("Select * from sbjbs_categories where sb_pid IN (" . $clist . ") and sb_id not in ( ". $clist . ")") ;
			}


	?>
                          <tr> 
                            <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<a href="browsecats.php?cid=<?php echo $rs["sb_id"]; ?>"><?php echo $rs["sb_cat_name"]; ?></a><!--font color="#666666" size="1">&nbsp; 
                              ( <? //echo $list_num;?> )</font--></font></td>
                            <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                              <a href="browsecats.php?delete=Yes&delid=<?php echo $rs["sb_id"]; ?>&cid=<?php echo $cid;  ?>" onClick="return del_confirm();">Delete</a> 
                              | <a href="editcat.php?cid=<?php echo $rs["sb_id"]; ?>">Edit</a> 
                              </font></td>
                          </tr>
                          <?php
	}
	}
	?>
                          <tr> 
                            <td height="48">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr> 
                <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                    <form name="form2" method="post" action="browsecats.php">
                      <tr bgcolor="#004080"> 
                        <td height="25" colspan="2" align="left"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Add 
                          New 
                          <? if($cid<>0) { echo "Subcategory";} else { echo "Category";}?>
                          </font></strong></td>
                      </tr>
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Category</font><font size="2" face="Arial, Helvetica, sans-serif"> 
                            Name:&nbsp;</font></strong></div></td>
                        <td width="448"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <input name="cat_name" type="text" value="<? echo $cat_name;?>" size="40">
                          <input name="cid" type="hidden" id="cid" value="<? echo $cid;?>">
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
					if(form.cid.selectedIndex==0)
					{
					alert('Please choose a category to shift from'); 
					form.cid.focus();
					return false;
					}
					if(form.cat1.selectedIndex==0)
					{
					alert('Please choose a category in which to shift'); 
					form.cat1.focus();
					return false;
					}

					return true;
					}
					
					</script>
                    <form name="form1" method="post" action="shiftlistings.php" onSubmit="return validate(this);">
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">From 
                            Category:&nbsp;</font></strong></div></td>
                        <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <select name="cid" id="cid" >
                            <option value="0">Select a category</option>
                            <?
	$sbcat_arr=array();
	$sbord_arr=array();
	$rs_query=mysql_query("select * from sbjbs_categories order by sb_pid,sb_order_index");
	while($rst=mysql_fetch_array($rs_query))
	{
		$cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_pid=".$rst["sb_id"]));
		if($child)
			continue;
		$cat_path.=$rst["sb_cat_name"];
		$par=mysql_query("select * from sbjbs_categories where sb_id=".$rst["sb_pid"]);
		while($parent=mysql_fetch_array($par))
		{
			$cat_path=$parent["sb_cat_name"].">".$cat_path;
			$par=mysql_query("select * from sbjbs_categories where sb_id=".$parent["sb_pid"]);
		}
		$num=0;
	
		$num+=mysql_num_rows(mysql_query("select * from sbjbs_job_cats where sb_cid=".$rst["sb_id"]));
		$num+=mysql_num_rows(mysql_query("select * from sbjbs_resume_cats where sb_cid=".$rst["sb_id"]));
		$num+=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats where sb_cid=".$rst["sb_id"]));
	
		if($num==0)
			continue;
		$sbcat_arr[$rst["sb_id"]]=$cat_path." (".$num.")";
		$sbord_arr[$rst["sb_id"]]=$rst["sb_order_index"];
	}

	if($sb_cat_listing=='admin')
	{
		asort($sbord_arr);
		foreach($sbord_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbcat_arr[$sbkey].'</option>';
		}
	}
	else
	{
		asort($sbcat_arr);
		foreach($sbcat_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbval.'</option>';
		}
	}					  
									  ?>
                          </select>
                          </font></td>
                      </tr>
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">To 
                            Category:&nbsp;</font></strong></div></td>
                        <td align="left"> <div align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
                            <select name="cat1" id="select3" >
                              <option value="0">Select a category</option>
                              <?
	$sbcat_arr=array();
	$sbord_arr=array();
	$rs_query=mysql_query("select * from sbjbs_categories order by sb_pid,sb_order_index ");
	while($rst=mysql_fetch_array($rs_query))
	{
		$cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_pid=".$rst["sb_id"]));
		if($child)
			continue;
		$cat_path.=$rst["sb_cat_name"];
		$par=mysql_query("select * from sbjbs_categories where sb_id=".$rst["sb_pid"]);
		while($parent=mysql_fetch_array($par))
		{
			$cat_path=$parent["sb_cat_name"].">".$cat_path;
			$par=mysql_query("select * from sbjbs_categories where sb_id=".$parent["sb_pid"]);
		}
		$sbcat_arr[$rst["sb_id"]]=$cat_path;
		$sbord_arr[$rst["sb_id"]]=$rst["sb_order_index"];
	?>
			<!--option value="<? echo $rst["sb_id"];?>" ><? echo $cat_path;?></option-->
	<?
	}
	if($sb_cat_listing=='admin')
	{
		asort($sbord_arr);
		foreach($sbord_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbcat_arr[$sbkey].'</option>';
		}
	}
	else
	{
		asort($sbcat_arr);
		foreach($sbcat_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbval.'</option>';
		}
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