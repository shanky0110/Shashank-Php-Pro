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
								$errs[$errcnt]="Category with name <b>$cat_name</b> already exists.";
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

						$sql="Insert into sbjbs_categories (sb_cat_name,sb_pid) values ('$cat_name',".$_REQUEST["cid"].")";
						$rs=mysql_query( $sql);
						$cat_name="";
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

						?><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Category 
                    	has been Added</font><?
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
                      <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Your Add Category Request cannot be processed due to following Reasons</font></td>
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
                          <? 
						  if($cid<>0) { echo "Subcategory";} else { echo "Category";}?>
                          </font></strong></td>
                      </tr><form name="form2" method="post" action="add_cat.php">
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Category 
                            Name:&nbsp;</font></strong></div></td>
                        <td width="448"><font size="2" face="Arial, Helvetica, sans-serif"> 
                          <input name="cat_name" type="text" value="<? echo $catname;?>" size="40">
                          </font></td>
                      </tr>
                      <tr> 
                        <td align="right" bgcolor="#F5F5F5"> <div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Parent 
                            Category:&nbsp;</font></strong></div></td>
                        <td><font face="Arial, Helvetica, sans-serif" size="2"> 
                          <select name="cid" id="select" >
						  <option value="0">ROOT</option>
                            <?
	$sbcat_arr=array();
	$sbord_arr=array();
	$rs_query=mysql_query("select * from sbjbs_categories order by sb_pid");
	while($rst=mysql_fetch_array($rs_query))
	{
		$cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_pid=".$rst["sb_id"]));
		
		$cat_path.=$rst["sb_cat_name"];
		$par=mysql_query("select * from sbjbs_categories where sb_id=".$rst["sb_pid"]);
		while($parent=mysql_fetch_array($par))
		{
			$cat_path=$parent["sb_cat_name"].">".$cat_path;
			$par=mysql_query("select * from sbjbs_categories where sb_id=".$parent["sb_pid"]);
		}
		$sbcat_arr[$rst["sb_id"]]=$cat_path;
		$sbord_arr[$rst["sb_id"]]=$rst["sb_order_index"];
	}

	if($sb_cat_listing=='admin')
	{
		asort($sbord_arr);
		foreach($sbord_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
			echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbcat_arr[$sbkey].'</option>';
		}
	}
	else
	{
		asort($sbcat_arr);
		foreach($sbcat_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
			echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbval.'</option>';
		}
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