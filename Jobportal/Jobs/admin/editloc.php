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
	$sql_outter="Select * from sbjbs_locations where sb_id=$loc_id" ;
    $rs_outter=mysql_query($sql_outter );
	if ($rs_outter=mysql_fetch_array($rs_outter))
	{
	$catname=$rs_outter["sb_loc_name"];
	$cat_pid=$rs_outter["sb_pid"];
    $catname = "<font size='1' >&nbsp;-&nbsp;</font><a href=\"browselocs.php?loc_id=" . $rs_outter["sb_id"] . "\"><font  size='2' face='Arial, Helvetica, sans-serif'>".$rs_outter["sb_loc_name"]."</font></a>";
    $loc_id = $rs_outter["sb_id"];
	$pid = $rs_outter["sb_pid"];
	$temp_pid=$rs_outter["sb_pid"];
	$loc_name=$rs_outter["sb_loc_name"];
	while($temp_pid<>0)
	{
	$cat=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_id=$temp_pid"));
	$temp_pid=$cat["sb_pid"];
	$catname="<font size='2' >&nbsp;-&nbsp;</font><a href=\"browselocs.php?loc_id=" . $cat["sb_id"] . "\"><font  size='2' face='Arial, Helvetica, sans-serif'>" .$cat["sb_loc_name"]."</font></a>" .$catname;
	
	}
	
	}
?> 
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="1" dwcopytype="CopyTableCell">
        <tr> 
          <td valign="top">
<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="left" valign="top"> 
				
                    
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="10">
                    <form name="form2" method="post" action="editloc.php">
                      <tr align="left"> 
                        <td colspan="2"> 
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
else
{
							if (!get_magic_quotes_gpc()) {
							$loc_name=str_replace('$', '\$',addslashes($_REQUEST["loc_name"]));
							}
							else
							{
							$loc_name=str_replace('$', '\$',$_REQUEST["loc_name"]);
							}
							

$par_cat=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_loc_name='".$loc_name."' and sb_pid=$cat_pid and sb_id<>".$_REQUEST["loc_id"]));
 if($par_cat)
 {
	$errs[$errcnt]="Location with name <b>$loc_name</b> already exists.";
    $errcnt++;
 }
}



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
$sql="Update  sbjbs_locations set sb_loc_name='$loc_name' where sb_id=" .  $_REQUEST["loc_id"] ;
$rs=mysql_query( $sql);
/*////// IF ORDER CHANGE REQUEST WAS MADE //////////////////

if ( isset($_REQUEST["order_index"]) && $_REQUEST["order_index"]=="top")
{
$sql="select min(sb_order_index) from sbjbs_locations";
if( $rs_t1=mysql_fetch_array(mysql_query($sql) ))
{
$val=$rs_t1[0] - 1;
}
else
{
$val=0;
}
$sql="UPDATE sbjbs_locations SET sb_order_index=$val  Where  sb_id= ".$_REQUEST["loc_id"];
mysql_query($sql);
}
else
{

if ( isset($_REQUEST["order_index"]) && $_REQUEST["order_index"]<>"")
{
$rs_query_t=mysql_query("Select * from sbjbs_locations where sb_id=" . $_REQUEST["order_index"] );
if($rs_t=mysql_fetch_array($rs_query_t))
{
$new_order_index=$rs_t["sb_order_index"]+1;
mysql_query("UPDATE sbjbs_locations SET sb_order_index=sb_order_index+1  Where sb_order_index> ".$rs_t["sb_order_index"]);
mysql_query("UPDATE sbjbs_locations SET sb_order_index=$new_order_index Where sb_id= ".$_REQUEST["loc_id"]);
}					
}

}


/////////////////// ORDER CHANGED ////////////////////////*/

  	$rs_query=mysql_query("Select * from sbjbs_locations where sb_id=" . $loc_id );
	if ($rs=mysql_fetch_array($rs_query))
	{
	$loc_name=$rs["sb_loc_name"];
	$Location=$rs["sb_id"];
	$loc_id=$rs["sb_id"];
	$pid=$rs["sb_pid"];
	}


?>
                          <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Location 
                          has been Updated</font> 
                          <?
$showform="No";
}
else
{
$loc_name=$_REQUEST["loc_name"];
$Location=$_REQUEST["loc_id"];

?>
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">Your 
                                Edit Location Request cannot be processed due 
                                to following Reasons</font></td>
                            </tr>
                            <?

				for ($i=0;$i<$errcnt;$i++)
				{
                   ?>
                            <tr> 
                              <td width="6%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo $i+1; ?></font></td>
                              <td width="94%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo  $errs[$i]; ?> 
                                </font></td>
                            </tr>
                            <?
				}//end for
                  ?>
                          </table>
                          <?
				}
				}
				$loc_name="";
	$sql_outter="Select * from sbjbs_locations where sb_id=$loc_id" ;
    $rs_outter=mysql_query($sql_outter );
	if ($rs_outter=mysql_fetch_array($rs_outter))
	{
	$catname=$rs_outter["sb_loc_name"];
	$cat_pid=$rs_outter["sb_pid"];
    $catname = "<font size='1' >&nbsp;-&nbsp;</font><a href=\"browselocs.php?loc_id=" . $rs_outter["sb_id"] . "\"><font  size='2' face='Arial, Helvetica, sans-serif'>".$rs_outter["sb_loc_name"]."</font></a>";
    $loc_id = $rs_outter["sb_id"];
	$pid = $rs_outter["sb_pid"];
	$temp_pid=$rs_outter["sb_pid"];
	$loc_name=$rs_outter["sb_loc_name"];
	while($temp_pid<>0)
	{
	$cat=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_id=$temp_pid"));
	$temp_pid=$cat["sb_pid"];
	$catname="<font size='2' >-&nbsp;</font><a href=\"browselocs.php?loc_id=" . $cat["sb_id"] . "\"><font  size='2' face='Arial, Helvetica, sans-serif'>" .$cat["sb_loc_name"]."</font></a>" .$catname;
	
	}
	
	}

				?>
                        </td>
                      </tr>
                      <tr align="left"> 
                        <td colspan="2">&nbsp;<a href="browselocs.php?loc_id=0"><font size='2' face='Arial, Helvetica, sans-serif'>All 
                          locations</font></a><font size="2" face="Arial, Helvetica, sans-serif"><? echo $catname;?> 
                          </font></td>
                      </tr>
                      <tr align="left"> 
                        <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Edit 
                          Location</font></strong></td>
                      </tr>
                      <tr> 
                        <td width="50%" align="right" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Location 
                            Name: </strong></font></div></td>
                        <td><input name="loc_id" type="hidden" value="<?php echo $loc_id; ?>"> 
                          <input name="loc_name" type="text" value="<?php echo $loc_name; ?>" size="40"></td>
                      </tr>
                      <!--tr>
                        <td align="right" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Order: 
                          </strong></font></td>
                        <td><select name="order_index">
<option value="">Select</option>
<option value="top">Top</option><?
	    $rs_query_t=mysql_query("Select * from sbjbs_locations where sb_id<>$loc_id and sb_pid=$pid order by sb_order_index,sb_id asc"	);
                        while($rs_t=mysql_fetch_array($rs_query_t))
						{
				?><option value="<? echo $rs_t["sb_id"];?>">After <? echo $rs_t["sb_loc_name"] ;?></option><?
				  }  ?></select></td>
                      </tr-->
                      <tr> 
                        <td bgcolor="#F5F5F5"><strong></strong></td>
                        <td> <input type="submit" name="Submit" value="Update"> 
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2"><div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">.</font></div></td>
                      </tr>
                    </form>
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