<?
include_once("myconnect.php");
include_once("logincheck.php");

function main()
{

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config where sb_id=1"));

?>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
  <tr> 
    <td  valign="top"> 
      <?

$errcnt=0;
$showform="";
$msg="";
$selected=0;
if ( count($_POST)!=0 )
{
////////===================Delete Icons
if(isset($_REQUEST["deleteicons"]))
{
	$selected=1;
	$cnt=0;
	$dir = opendir("sbjbs_icons");
	while($item = readdir($dir))
	{
		$used=0;
		$icon_query=mysql_query("select * from sbjbs_icons");
		while ( $icon=mysql_fetch_array($icon_query))
		{
			for($i=2;$i<=7;$i++)
			{
				//echo $icon[$i]."==".$item."<br>";
				if ($icon[$i]==$item)
				{
				$used=1;
				}
			}
		}
///////////---------------
//USED IN site logo 
$sql1="select * from sbjbs_config where 1";
$rs_query=mysql_query($sql1);
while ( $rs=mysql_fetch_array($rs_query))
{
if ($rs["sb_logo"]==$item )
{
	$used=1;
}
}
/////////////-------------
		if ($used==0 && $item!="." && $item!=".."  )
		{
		//echo "-$item-";
		unlink("sbjbs_icons/".$item);
		$cnt++;
		}
	}// end while
	closedir($dir);
	$msg .= ($cnt==1)?"$cnt Icon":"$cnt Icons"; 
	$msg .= " Removed <br>";
}


///////////////-----------------
if (  isset( $_REQUEST["deleteimages"])  )
{
	$selected=1;

$cnt=0;
$dir = opendir("../uploadedimages");
while($item = readdir($dir)){
       //if(strchr($item,".")) continue;
$used=0;


//USED AS LOGO
$sql1="select sb_logo from sbjbs_companies where 1";
$rs_query=mysql_query($sql1);
while ( $rs=mysql_fetch_array($rs_query))
{
if ($rs["sb_logo"]==$item)
{
$used=1;
}
}
//USED IN SELL ADD
$sql1="select * from sbjbs_resumes where 1";
$rs_query=mysql_query($sql1);
while ( $rs=mysql_fetch_array($rs_query))
{
if ($rs["sb_img_url"]==$item )
{
	$used=1;
}
}
//USED IN SELL ADD
$sql1="select sb_img_url from sbjbs_premium_gallery where 1";
$rs_query=mysql_query($sql1);
while ( $rs=mysql_fetch_array($rs_query))
{
if ($rs["sb_img_url"]==$item )
{
	$used=1;
}
}

if ( ($used==0) && ($item!=".") && ($item!="..") )
{
//echo "-$item-";
unlink("../uploadedimages/".$item);
$cnt++;
}
else
{
//echo "[[$item]]";

}

}
closedir($dir);

	$msg .= ($cnt==1)?"$cnt Image":"$cnt Images"; 
	$msg .= " Removed <br>";

}

///////================================
} //IF form was posted

if  (count($_POST)<>0)
{
?>
      <font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"> 
      <?php if($selected<>0)
	  {
	  ?>
      Cleanup has been completed<br>
      <?
	  }
	  else
	  { 
	  	echo "Please select the option.";
	  }
		if (isset($msg) )
		{
		echo $msg;
		}
		?>
      </font> 
      <?
}
?>
    </td>
  </tr>
  <tr> 
    <td height="25" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Cleanup</strong></font></td>
  </tr>
  <script language="JavaScript">
  function validate_form(frm)
  {
  	if(frm.deleteicons.checked==false && frm.deleteimages.checked==false )
	{
		alert('Please select some option');
		frm.deleteicons.focus();
		return false;
	}
	return true;
  }
  </script>
  <form name="form1" method="post" action="cleanup.php" onSubmit="return validate_form(this);">
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"> <font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="deleteicons" type="checkbox" id="deleteicons" value="Yes">
        Remove all unused uploaded icons. </font> </td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input type="checkbox" name="deleteimages" value="Yes">
        Delete any images not being used in resume/ company logo/ premium member 
        etc.</font></td>
    </tr>
    <!--<tr> 
      <td align="left" valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="deleteicons" type="checkbox" id="deleteexp" value="Yes">
        Delete all icons not being used in the site. </font></td>
    </tr>-->
    <tr> 
      <td align="right" valign="top" bgcolor="#F5F5F5"><div align="left"> 
          <p><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif">This 
            operation is non reversible. Once removed, information can't be retrieved.<br>
            </font><font size="2" face="Arial, Helvetica, sans-serif"><br>
            <input type="submit" name="Submit2" value="Start the Cleanup" >
            </font></p>
        </div></td>
    </tr>
  </form>
</table>
<?
}  //End of main
include_once("template.php");
?>