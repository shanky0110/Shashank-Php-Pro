<?php
include "logincheck.php";
include_once "myconnect.php";
//include_once "date_time_format.php";

function main()
{
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	$recperpage=$config["sb_recperpage"];
	$strpass="";
	$show=1;
	$id="";
	
	if(isset($_REQUEST["recperpage"]) && ($_REQUEST["recperpage"]<>""))
	{
	$recperpage=$_REQUEST["recperpage"];
	$strpass=$strpass . "&recperpage=".$_REQUEST["recperpage"] ;
	}

	if(isset($_REQUEST["show"]) && ($_REQUEST["show"]<>""))
	{
	$show=$_REQUEST["show"];
	$strpass=$strpass . "&show=".$_REQUEST["show"] ;
	}

	if(isset($_REQUEST["sb_id"])&&($_REQUEST["sb_id"]<>""))
	{
	$id=$_REQUEST["sb_id"];
	$strpass.="&sb_id=$id";
	}

	$sbq_resume='select * from sbjbs_cover_letters where 1';

	if($id<>"")
	{
	$sbq_resume.=" and sb_seeker_id=$id ";
	}
	
	if($show==2)
	{
	$sbq_resume.=" and sb_approved='new'";
	}

	if($show==3)
	{
	$sbq_resume.=" and sb_approved='yes'";
	}

	if($show==4)
	{
	$sbq_resume.=" and sb_approved='no'";
	}
	$sbq_resume.=" order by sb_id";
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
while ( $jmpcnt<=($pg-1)*$recperpage  && $rs_query = mysql_fetch_array($sbq_resume) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}
////////////////////////////////////////////////////////////////////////

	?> 
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
        <tr> 
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
            Cover Letters</strong></font></td>
        </tr>
        <form name="search_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
          <tr> 
            <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Posted 
                By :</font></strong></div></td>
            <td><select name="sb_id">
                <option value="">All Members</option>
                <?php
			 $mem_q=mysql_query("select * from sbjbs_seekers  where sb_suspended='no' order by sb_id desc");
			 while($mem=mysql_fetch_array($mem_q))
			 {
              ?>
                <option value="<?php echo $mem["sb_id"];?>"<?php if($id==$mem["sb_id"]) echo " selected";?>><?php echo $mem["sb_username"];?></option>
                <?php 
			  }
			  ?>
              </select></td>
          </tr>
          <tr align="left" valign="top"> 
            <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Show:</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input name="show" type="radio" value="1" <? if($show==1) { echo "checked";}?>>
              All</font></font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input type="radio" name="show" value="2" <? if($show==2) { echo "checked";}?> >
              New 
              <input type="radio" name="show" value="3" <? if($show==3) { echo "checked";}?> >
              Approved 
              <input type="radio" name="show" value="4" <? if($show==4) { echo "checked";}?> >
              Disapproved </font></td>
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
    <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
        <tr> 
          <td><div align="center"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="1">
                <tr> 
                  <td height="25" bgcolor="#004080"> <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> 
                    &nbsp; Cover Letters</font></strong></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr> 
          <td> <div align="center"> 
              <?
if ($num_jobs<=0)
{
?>
              <br>
              <table width="65%" border="1" align="center" cellpadding="5" bordercolor="#333333" bgcolor="#FEFCFC" >
                <tr> 
                  <td align="center"><font color="#666666"><b><font face="verdana, arial" size="1"> 
                    No Cover Letter satisfies the criteria you specified. </font></b></font></td>
                </tr>
              </table>
              <br>
              <?
}//end if 
?>
            </div></td>
        </tr>
        <tr> 
          <td valign="top"> <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
              <?php 	
							$cnt=0;
							while(($sbrow_resume=mysql_fetch_array($sbq_resume))&&($cnt<$recperpage) )
							{
							$cnt++;
							?>
              <tr valign="top"> 
                <td bgcolor="<? if($cnt%2<>0){echo "#F5F5F5"; }else{echo "#FFFFFF";}?>"> 
                  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td width="50" ><font class="smalltext"># <?php echo $sbrow_resume["sb_id"];?></font></td>
                      <td valign="top"><font class="normal"><strong> 
                        <?php 
                                  echo $sbrow_resume["sb_title"]; 
                                ?>
                        </strong></font></td>
                    </tr>
                    <tr> 
                      <td ><font class="smalltext">&nbsp;</font></td>
                      <td valign="top"><font class="smalltext"> 
                        <?php 
							  if($sbrow_resume["sb_approved"]=="yes")
							  { echo "<em>Approved&nbsp;&nbsp;</em>"; }
							  elseif($sbrow_resume["sb_approved"]=="no")
							  { echo "<em>Waiting Approval&nbsp;&nbsp;</em>"; }
							  else
							  { echo "<em>New Waiting Approval&nbsp;&nbsp;</em>"; }
							  
						//	  echo "&nbsp;Posted on: ".sb_date($sbrow_resume["sbposted"]);
							  ?>
                        </font></td>
                    </tr>
                    <tr> 
                      <td >&nbsp;</td>
                      <td valign="top"><font class="smalltext">&nbsp;[&nbsp;<a href="view_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="View cover letter">View</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="add_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="Update cover letter">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="copy_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" title="Copy cover letter">Duplicate</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link" onClick="return confirm('Do you really want to remove the cover letter ?');" title="Remove cover letter">Delete</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="approve_cover_letter.php?sb_id=<?php echo $sbrow_resume["sb_id"];?>" class="small_link"  title="Approve/Disapprove cover letter"><? if($sbrow_resume["sb_approved"]<>"yes") echo "Approve"; else echo "Disapprove";?></a>&nbsp;]</font></td>
                    </tr>
                  </table></td>
              </tr>
              <?
}
?>
            </table>
            <br> <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
        <tr> 
          <td><div align="center"> </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<?
}// end main
include "template.php";
?>
