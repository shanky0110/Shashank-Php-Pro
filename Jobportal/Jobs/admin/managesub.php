<?php 
include_once"logincheck.php";
include_once"myconnect.php";
function main()
{
	if(!isset($_REQUEST["pg"]))
		$pg=1;
	else 
		$pg=$_REQUEST["pg"];

	$sbquery_cfg="select * from sbjbs_config where sb_id=1";
	$sbrs_cfg=mysql_query($sbquery_cfg);
	$sbrow_cfg=mysql_fetch_array($sbrs_cfg);
	$sbrec_per_page_db=$sbrow_cfg["sb_recperpage"];

//--------------------------------------------------
	$sbkeyword_str="";
	$strpass="";

	if( isset($_REQUEST["sbkeyword"]) && ($_REQUEST["sbkeyword"] != "") )
	{
		if(!get_magic_quotes_gpc())
			$sbkeyword=str_replace("$","\$",addslashes($_REQUEST["sbkeyword"]));
		else
			$sbkeyword=str_replace("$","\$",$_REQUEST["sbkeyword"]);
			
		$sbkeyword_str=" and sb_email like '%$sbkeyword%' ";
		$strpass.="&sbkeyword=".$sbkeyword;
	}
	else
		$sbkeyword="";
?>
<script language="JavaScript" src="../details_j.js"></script>
<form name="form1" method="post" action="managesub.php">
                    
  <table width="89%" border="0" align="center" cellpadding="0" cellspacing="8">
    <tr bgcolor="#004080"> 
                        <td height="25" colspan="2">&nbsp;<font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>Search 
                          Subscribers</strong></font></td>
                      </tr>
                      <tr> 
                        <td height="25" bgcolor="#f5f5f5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Search 
                            Keyword :</strong></font> </div></td>
                        <td><input name="sbkeyword" type="text" id="sbkeyword" value="<?php echo stripslashes($sbkeyword); ?>" maxlength="255"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="25" colspan="2"><div align="center"> 
                            <input type="submit" name="Submit" value="Search">
                          </div></td>
                      </tr>
                    </table>
                  </form>
			
<table width="87%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="25" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
            Results</strong></font></td>
        </tr>
      </table></td>
              </tr>
              <tr> 
                <td height="100%"> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
          <td width="100%" valign="top">
            <?php 
					$sbquery_sub="SELECT * FROM `sbjbs_newsletter` WHERE 1 $sbkeyword_str  ORDER BY sb_id desc";
			//			  die($sbquery_jok);
						  $sbrs_sub=mysql_query($sbquery_sub);
////---------------------------------PAGING BEGINS --------------------------
	$rcount=mysql_num_rows($sbrs_sub);
	if($rcount <= 0)
	{						//no records found then stop 
	?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
                <td width="650" height="25" valign="middle"> 
                  <h2><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;No 
                    match found satisfying your search criteria.</strong></font></h2></td>
  </tr>
  </table>
            <?php	
	}					// end if no records found
	else
	{					//records found
	$recperpage=$sbrec_per_page_db;
	if ($rcount==0 )
		$pages=0;
	else
	{
		$pages=floor($rcount / $recperpage);
		if  (($rcount%$recperpage) > 0 )
			$pages=$pages+1;
	}
	$jmpcnt=1;
	while ( $jmpcnt<=($pg-1)*$recperpage  && ($sbrow_sub=mysql_fetch_array($sbrs_sub)) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}
//die($strpass);
////---------------------------------PAGING --------------------------

					  
					  ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" bgcolor="#f5f5f5"><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Email 
                  Id </strong></font></td>
                <td bgcolor="#f5f5f5"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Options</strong></font></div></td>
              </tr>
              <?php 			$sbrcount=0;
								while( ($sbrow_sub=mysql_fetch_array($sbrs_sub)) && ($sbrcount < $sbrec_per_page_db) )
								{		
									$sbrcount++;
											?>
              <tr> 
                <td width="50%" height="25"> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<?php echo $sbrow_sub["sb_email"]; ?> 
                  </font></td>
                <td width="50%"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif">[<a href="email.php?id=<?php echo $sbrow_sub["sb_email"]; ?>" class="sbsidelink">Email</a>] 
                    [<a href="deletesub.php?sbsub_id=<?php echo $sbrow_sub["sb_id"]; ?>" class="sbsidelink" onClick="javascript:return(confirm('Do you really want to delete the subscriber ?'));">Delete</a>]</font></div></td>
              </tr>
              <?php
						  	 	}			//end while $sbrow-jok
							?>
              <tr> 
                <td height="20" colspan="2" valign="top"> <table width="100%" border="0">
                    <tr> 
                      <td height="25" bgcolor="#004080"> <p> <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Pages: 
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
                          </font></strong> </font></p></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td><?php	}	//end else records found  ?>
                      
          <td width="13">&nbsp;</td>
                    </tr>
                    <tr  height="12" > 
                      
          <td height="12" >&nbsp;</td>
          <td height="12"></td>
		              </tr>
                  </table></td>
              </tr>
            </table><?php 
		}		//end of main
	include_once"template.php";			
?>