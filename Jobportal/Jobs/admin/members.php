<?
include_once "logincheck.php"; 
include_once "myconnect.php";

function main()
{

 /////////////getting null char
$null_char[0]="-";

$strpass="";
$label="All Members";
$radio=1;
$show=1;

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$recperpage=$config["sb_recperpage"];
if(isset($_REQUEST["recperpage"]) && ($_REQUEST["recperpage"]<>""))
{
$recperpage=$_REQUEST["recperpage"];
$strpass=$strpass . "&recperpage=".$_REQUEST["recperpage"] ;
$strpass.="&keyword=".$_REQUEST["keyword"]."&radio=".$_REQUEST["radio"];
$radio=$_REQUEST["radio"];
}
if(isset($_REQUEST["show"])&&($_REQUEST["show"]<>0))
{
$show=$_REQUEST["show"];
$strpass.="&show=".$_REQUEST["show"];
}
$sql0="select *,UNIX_TIMESTAMP(sb_signup_on) as signup, UNIX_TIMESTAMP(sb_last_login) as lastlogin from sbjbs_seekers where 1  ";

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

if(isset($_REQUEST["keyword"]) && ($_REQUEST["keyword"]<>"")&&($_REQUEST["radio"]==1))
{		
		$search_str="";
		$keyword_arr=explode(" ",$searchkeyword);
		foreach($keyword_arr as $key)
		{
			if($search_str=="")
			{
			$search_str="sb_lastname like '%$key%' or sb_firstname like '%$key%' or sb_email_addr like '%$key%' or sb_username like '%$key%'";
			}
			else
			{
			$search_str.=" or sb_lastname like '%$key%' or sb_firstname like '%$key%' or sb_email like '%$key%' or sb_username like '%$key%'";
			}
		}
		$sql0.=" and ($search_str)";
		$label="Member Search Results for keyword <font color='#FFCC00'>".$keyword."</font>";
}//end if

if (isset($_REQUEST["keyword"]) && ($_REQUEST["keyword"]<>"")&&($_REQUEST["radio"]==2))
{		
		$search_str="";
		$keyword_arr=explode(" ",$searchkeyword);
		foreach($keyword_arr as $key)
		{
			if($search_str=="")
			{
			$search_str="sb_lastname like '%$key%' or sb_firstname like '%$key%' or sb_username like '%$key%'";
			}
			else
			{
			$search_str.=" or sb_lastname like '%$key%' or sb_firstname like '%$key%' or sb_username like '%$key%'";
			}
		}
		$sql0.=" and ($search_str)";
$label="Member Search Results for Name/Username <font color='#FFCC00'>".$keyword."</font>";
}//end if

if (isset($_REQUEST["keyword"]) && ($_REQUEST["keyword"]<>"")&&($_REQUEST["radio"]==3))
{		
$keyword=$_REQUEST["keyword"];
$sql0=$sql0." and ( sb_id= ".(int)$searchkeyword.")";
$label="Member Search Results for Member # <font color='#FFCC00'>".$keyword."</font>";
}//end if

if($show==2)
{
$sql0=$sql0." and sb_suspended='no'";
$label=($label=="All Members")?"Unsuspended Members":$label." (Unsuspended only)";
}
if($show==3)
{
$sql0=$sql0." and sb_suspended='yes'";
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
if(isNaN(form.keyword.value)&&(form.radio[2].checked==true))
{
alert('Please Enter a valid numeric value for Member #');
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
            Members</strong></font></td>
        </tr>
        <form name="search_form" action="members.php" method="post" onSubmit="return validate(this);">
          <tr> 
            <td width="50%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Keyword:</font></strong></div></td>
            <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>"></td>
          </tr>
          <tr align="left" valign="top"> 
            <td bgcolor="#F5F5F5"><div align="right"><font color="#006699">&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Search 
                in:</strong></font></div></td>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input name="radio" type="radio" value="1" <? if($radio==1) { echo "checked";}?>>
              All</font></font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input type="radio" name="radio" value="2" <? if($radio==2) { echo "checked";}?> >
              Name/Username 
              <input type="radio" name="radio" value="3" <? if($radio==3) { echo "checked";}?> >
              Member #</font></td>
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
        <tr> 
          <td> <div align="center"> 
              <?
if (!$rs_query)
{
?>
              <br>
              <table width="65%" border="1" align="center" cellpadding="5" bordercolor="#333333" bgcolor="#FEFCFC" >
                <tr> 
                  <td align="center"><font color="#666666"><b><font face="verdana, arial" size="1"> 
                    No Member satisfies the criteria you specified. </font></b></font></td>
                </tr>
              </table>
              <br>
              <?
}//end if 
?>
            </div></td>
        </tr>
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
                  <td bgcolor="<? echo $bgcolor?>">
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
                          <? echo "      ".$rs_query["sb_id"]; ?></font></td>
                        <td height="25" bgcolor="<? echo $bgcolor?>"><font size="1"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><? echo $rs_query["sb_username"]; ?>&nbsp;&nbsp;&nbsp;</font><font size="1"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="email.php?id=<? echo $rs_query["sb_email_addr"];?>&return_str=<? echo $return_str;?>"><? echo $rs_query["sb_email_addr"]; ?></a></font></strong></font></strong></font></td>
                      </tr>
                      <tr valign="top"> 
                        <td width="50" bgcolor="<? echo $bgcolor?>">&nbsp; </td>
                        <td bgcolor="<? echo $bgcolor?>"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="top"> 
                              <td colspan="2"><strong><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Registered 
                                on</strong></font><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                <? 
				  echo sb_date($rs_query["signup"]);
				   ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;</font><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Last 
                                Login on</strong></font><font color="#333333" size="1" face="Arial, Helvetica, sans-serif">&nbsp; 
                                <? 
						  if($rs_query["lastlogin"]<>0)
						  { echo sb_date($rs_query["lastlogin"]);}
						  else
						  { echo $config["sb_null_char"]; }
				  
				   ?>
                                </font></strong></td>
                            </tr>
                            <tr valign="top"> 
                              <td width="50"><font color="#333333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Address</strong></font></td>
                              <td width="463"><strong><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                </font></strong> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td width="60%"><strong><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                      <? 
				  echo $rs_query["sb_firstname"]." ".$rs_query["sb_lastname"];
				  
				   ?>
                                      </font></strong></td>
                                    <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="1">&nbsp;[&nbsp;<a href="editmember.php?id=<? echo $rs_query["sb_id"];?>" >Edit 
                                      Profile</a>&nbsp;]&nbsp;</font><font size="2" face="Arial, Helvetica, sans-serif"><font size="1">&nbsp;[&nbsp;<a href="delete_member.php?id=<? echo $rs_query["sb_id"];?>" onClick="javascript: return confirm('All the Resumes and other information related to the Member will be deleted.\n\nDo you really want to delete the Member?');">Delete</a>&nbsp;]&nbsp;</font></font></font></td>
                                  </tr>
                                  <tr> 
                                    <td><strong><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                      <? 
				  echo $rs_query["sb_addr1"];
				  
				   ?>
                                      </font></strong></td>
                                    <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="1">&nbsp;[&nbsp;<a href="resumes.php?sb_id=<? echo $rs_query["sb_id"];?>">Resumes</a>&nbsp;]</font></font></td>
                                  </tr>
                                  <tr> 
                                    <td><strong><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                      <? 
				  
				  echo  $rs_query["sb_zip"].", ".$rs_query["sb_city"];
				   ?>
                                      </font></strong></td>
                                    <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><font size="1">&nbsp;[&nbsp;<a href="cover_letters.php?sb_id=<? echo $rs_query["sb_id"];?>">Cover 
                                      Letters</a>&nbsp;]</font></font></font></td>
                                  </tr>
                                  <tr valign="top"> 
                                    <td><strong><font color="#333333" size="1" face="Arial, Helvetica, sans-serif"> 
                                      <? 
				  
				  echo $rs_query["sb_state"].", ";
				  $country=mysql_fetch_array(mysql_query("select * from sbjbs_country where id=".$rs_query["sb_country"]));
				  if($country)
				  {
				  echo " ".$country["country"];
				  }
				   ?>
                                      </font></strong></td>
                                    <td height="25"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                      <font size="1"><?php 
                            echo "&nbsp;[&nbsp;<a href='suspend_member.php?sb_id=".$rs_query["sb_id"]."'>";
							if($rs_query["sb_suspended"]=="no")
							{ echo "Suspend";}
							else
							{ echo "Unsuspend";}
							 echo "</a>&nbsp;]&nbsp;";
                                      ?></font></font></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
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
</table><?

}//main()
include "template.php";
?>
