<?
include_once "logincheck.php"; 
include_once "myconnect.php";
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$recperpage=$rs0["sb_recperpage"];

$sql0="select * from sbjbs_feedback where 1  ";
$sql0=$sql0." order by sb_id desc";

$query=mysql_query($sql0);
$rs_query=mysql_fetch_array($query);
$strpass="";

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
?>

<table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
  <tr> 
    <td height="25" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Feedback 
      </strong></font></td>
  </tr>
  <tr> 
    <td><div align="center"> 
        <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
          <tr bgcolor='#F5F5F5'> 
            <td>&nbsp;</td>
            <td><strong><font size="2" face="Arial, Helvetica, sans-serif">Subject</font></strong></td>
            <td colspan="3"><strong><font size="2" face="Arial, Helvetica, sans-serif">Options</font></strong></td>
          </tr>
          <?
  $cnt=0;
  while ( ($rs_query) && ($cnt<=$recperpage))
  {
?>
          <tr bgcolor='<? if ($cnt%2==0) echo "#FFFFFF"; else echo "#F5F5F5"?>'> 
            <td width="4%"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $jmpcnt;?></font></td>
            <td width="30%"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rs_query["sb_title"];?></font></td>
            <td width="12%"><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;</strong>&nbsp;<a href="email.php?id=<? echo $rs_query["sb_email"];?>">Reply</a></font></td>
            <td width="10%"><font size="1"><font size="1"><a target=other href="view_fb.php?id=<? echo $rs_query["sb_id"];?>"><font size="2" face="Arial, Helvetica, sans-serif">View</font></a></font></font></td>
            <td width="14%"><font size="1"><font size="1"><a href="delete_fb.php?id=<? echo $rs_query["sb_id"];?>" onClick="javascript: return confirm('Do you really want to delete the Feedback.');"><font size="2" face="Arial, Helvetica, sans-serif">Delete</font></a></font></font></td>
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
            <td bgcolor="#0057AE" height=1></td>
          </tr>
          <tr> 
            <td height="25" bgcolor="#004080"> <p> <strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> 
                &nbsp;&nbsp;Pages: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
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
                </font></strong> </p></td>
						  </tr>
        </table>
      </div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
  </tr>
</table>
<?
}//main()
include "template.php";
?>
