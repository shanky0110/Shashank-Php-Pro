<?
include_once "logincheck.php"; 
include_once "myconnect.php";

function main()
{

 /////////////getting null char
$null_char[0]="-";

$strpass="";
$label="All Members";
$radio=3;
$show=1;

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$recperpage=$config["sb_recperpage"];
if(isset($_REQUEST["recperpage"]) && ($_REQUEST["recperpage"]<>""))
{
$recperpage=$_REQUEST["recperpage"];
$strpass=$strpass . "&recperpage=".$_REQUEST["recperpage"] ;
$strpass.="&keyword=".$_REQUEST["keyword"];
}
if(isset($_REQUEST["show"])&&($_REQUEST["show"]<>0))
{
$show=$_REQUEST["show"];
$strpass.="&show=".$_REQUEST["show"];
}
$sql0="select *,UNIX_TIMESTAMP(sb_posted_on) as signup from sbjbs_premium_gallery where 1  ";

$keyword="";
$searchkeyword="";
if(isset($_REQUEST["keyword"]))
{
			$keyword=$_REQUEST["keyword"];

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


if (isset($_REQUEST["keyword"]) && is_numeric($_REQUEST["keyword"]) )
{		
$keyword=$_REQUEST["keyword"];
$sql0=$sql0." and ( sb_emp_id= ".(int)$searchkeyword.")";
$label="Member Search Results for Member # <font color='#FFCC00'>".$keyword."</font>";
}//end if

if($show==2)
{
$sql0=$sql0." and sb_approved='yes'";
$label=($label=="All Members")?"Unsuspended Members":$label." (Unsuspended only)";
}
if($show==3)
{
$sql0=$sql0." and sb_approved='no'";
$label=($label=="All Members")?"Suspended Members":$label." (Suspended only)";
}

$sql0=$sql0." order by sb_id desc";
//echo $sql0;
$query=mysql_query($sql0);

$rs_query=mysql_fetch_array($query);
///////////////////////////////////PAGINATION /////////
	if(!isset($_REQUEST["pg"]))
	{
			$pg=1;
	}
	else 
	{
	$pg=$_REQUEST["pg"];
	}

$rcount=mysql_num_rows($query);

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
while ( $jmpcnt<=($pg-1)*$recperpage  && $rs_query = mysql_fetch_array($query) )
    {	
		$jmpcnt = $jmpcnt + 1;
	}
////////////////////////////////////////////////////////////////////////
?><script language="JavaScript">
//<!--
function validate(form)
{
if(isNaN(form.keyword.value))
{
alert('Please Enter a valid numeric value for Member Id');
form.keyword.select();
form.keyword.focus();
return false;
}
return true;
}
//-->
</script>
<? $return_str=$_SERVER['PHP_SELF'];?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
        <tr> 
          <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
            Premium Employers</strong></font></td>
        </tr>
        <form name="search_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" onSubmit="return validate(this);">
          <tr> 
            <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Member 
                Id:</font></strong></div></td>
            <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
          </tr>
          <tr align="left" valign="top"> 
            <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Show:</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input name="show" type="radio" value="1" <? if($show==1) { echo "checked";}?>>
              All</font></font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input type="radio" name="show" value="2" <? if($show==2) { echo "checked";}?> >
              Unsuspended 
              <input type="radio" name="show" value="3" <? if($show==3) { echo "checked";}?> >
              Suspended</font></td>
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
    <td valign="top">
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="10">
        <tr> 
          <td><div align="center"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="1">
                <tr> 
                  <td height="25" bgcolor="#004080"> <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> 
                    &nbsp; 
                    <? echo $label;?>
                    </font></strong></td>
                </tr>
              </table>
            </div></td>
        </tr>
              <?
if (!$rs_query)
{
?>        <tr> 
          <td> <div align="center"> 

              <br>
              <table width="65%" border="1" align="center" cellpadding="5" bordercolor="#333333" bgcolor="#FEFCFC" >
                <tr> 
                  <td align="center"><font color="#666666"><b><font face="verdana, arial" size="1"> 
                    No Member satisfies the criteria you specified. </font></b></font></td>
                </tr>
              </table>
              <br>
           </div></td>
        </tr>
              <?
}//end if 
?>
         <tr> 
          <td valign="top">
<div align="center"> 
              <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
                <?
  $cnt=1;
  while ( ($rs_query) && ($cnt<=$recperpage))
    {
	 if($cnt%2<>0)
	 $bgcolor="#F5F5F5"; 
	 else
	 $bgcolor="#FFFFFF";
?>
                <tr valign="top"> 
                  <td> 
                    <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
                      <?
  $cnt=1;
  while ( ($rs_query) && ($cnt<=$recperpage))
    {
	 if($cnt%2<>0)
	 $bgcolor="#F5F5F5"; 
	 else
	 $bgcolor="#FFFFFF";
?>
                      <tr valign="middle"> 
                        <td width="50" bgcolor="<? echo $bgcolor?>"><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"># 
                          <? echo "      ".$rs_query["sb_emp_id"]; ?></font></td>
                        <td height="20" bgcolor="<? echo $bgcolor?>"><font size="1"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <? 
			$sbq_mem="select * from sbjbs_employers where sb_id=".$rs_query["sb_emp_id"];
			$sbrow_mem=mysql_fetch_array(mysql_query($sbq_mem));
			echo $sbrow_mem["sb_username"]; ?>
                          &nbsp;&nbsp;&nbsp;<font size="1"><strong><a href="email.php?id=<? echo $sbrow_mem["sb_email_addr"];?>&return_str=<? echo $return_str;?>"><? echo $sbrow_mem["sb_email_addr"]; ?></a></strong></font></font></strong></font><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font></td>
                        <td rowspan="4" bgcolor="<? echo $bgcolor?>"><img src="<?php echo "../uploadedimages/".$rs_query["sb_img_url"]; ?>" border="0" width="70" height="50" ></td>
                      </tr>
                      <tr valign="middle">
                        <td height="10" bgcolor="<? echo $bgcolor?>"></td>
                        <td height="10" bgcolor="<? echo $bgcolor?>"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Company 
                          Profile:</strong> <?php 
						  $profile=mysql_fetch_array(mysql_query("select * from sbjbs_companies where sb_id=".$rs_query["sb_profile_id"]));
						  if($profile)
						  {
						  echo "<a href='view_profile.php?id=".$rs_query["sb_profile_id"]."'>".$profile["sb_name"]."</a>"; 
						  }
						  else
						  {
						  echo $config["sb_null_char"];
						  }
						  ?></font></td>
                      </tr>
                      <tr valign="middle"> 
                        <td height="10" bgcolor="<? echo $bgcolor?>"></td>
                        <td height="10" bgcolor="<? echo $bgcolor?>"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Posted 
                          on:</strong> <?php echo sb_date($rs_query["signup"]); ?></font></td>
                      </tr>
                      <tr valign="middle"> 
                        <td height="10" bgcolor="<? echo $bgcolor?>"></td>
                        <td height="10" bgcolor="<? echo $bgcolor?>"><font size="1" face="Arial, Helvetica, sans-serif">[&nbsp;<a href="suspend_premium.php?sb_id=<? echo $rs_query["sb_id"];?>"  title="Suspend/Unsuspend employer from premium list">
                          <?php 	echo($rs_query["sb_approved"]=='yes')?'Suspend':'Unsuspend'; ?>
                          </a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="edit_premium.php?sb_id=<? echo $rs_query["sb_emp_id"];?>" title="Edit uploaded image">Edit</a>&nbsp;]&nbsp;&nbsp;[&nbsp;<a href="delete_premium.php?id=<? echo $rs_query["sb_id"];?>" onClick="javascript: return confirm('Do you really want to remove the employer from premium list ?');" title="Remove employer from premium list">Delete</a>&nbsp;]</font></td>
                      </tr>
                      <?
	  $cnt=$cnt+1;
	  $jmpcnt=$jmpcnt+1;
	  $rs_query=mysql_fetch_array($query);
	  }//  wend
	?>
                    </table></td>
                </tr>
                <?
	  $cnt=$cnt+1;
	  $jmpcnt=$jmpcnt+1;
	  $rs_query=mysql_fetch_array($query);
	  }//  wend
	?>
              </table>
              <br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
              </table>
            </div></td>
        </tr>
        <tr> 
          <td><div align="center"> </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<?
}//main()
include "template.php";
?>
