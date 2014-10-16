<?php 
include_once "session.php";

if(!isset($_SESSION["softbiz_jbs_adminid"]) )
	die();

$sbdontshowfinish=0;
function handleupload() 
{
	global $sbdontshowfinish;
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) 
	{
		$realname = $_FILES['userfile']['name'];
	///////--------chking extension	
		if(!preg_match("/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i",$realname))
			die();
	///////--------end chking extension	
		if ($_FILES['userfile']['size']>(60000))
		{
			echo "Uploaded files must be less than 60k. Please close this window and try again";
			echo "<script language=\"JavaScript\">";
			echo "fname = ''";
			echo "</script>";
		}
		else
		{
			echo $realname . ", size: ". $_FILES['userfile']['size'] . " [ ";
			switch($_FILES['userfile']['error'])
			{ case 0: $mess = "Ok";
			  break;
			  case 1:
			  case 2: $mess = "Error : File size more than 512000 bytes";
			  break;
			  case 3: $mess = "Error : File partially uploaded";
			  break;
			  case 4: $mess = "Error : No File Uploaded";
			  break;
			}
			echo $mess . " ]  ";

			mt_srand((double)microtime()*1000000);
			$randvar =  mt_rand(1,10000000);
			settype($randvar,"string");
			$extension=explode(".",$realname);
			$newfilename = "sbjbs_icons/" . $randvar.".".$extension[count($extension)-1];
			$shortfname = $randvar.".".$extension[count($extension)-1];
			while ( file_exists($newfilename) != FALSE )
			{
				$randvar =  mt_rand(1,10000000);
				settype($randvar,"string");
				$newfilename = "sbjbs_icons/" . $randvar.".".$extension[count($extension)-1];
				$shortfname =  $randvar.".".$extension[count($extension)-1];
			}
			copy($_FILES['userfile']['tmp_name'], $newfilename);
			echo "<script language=\"JavaScript\">";
			echo "fname = '" . $shortfname . "'";
			echo "</script>";
		}// Else fr more than 60k
	} 
	else 
	{
		echo "<font face='verdana,arial' color=#dd0000 size=2><div align=center>Error : File Not Uploaded. Check Size & Try Again.<br><a href=\" javascript: onclick=history.go(-1);\">Go Back</a></div></font>";
		$sbdontshowfinish = 1;
	}
}
?>

<html>
<head><title>Uploaded File Status</title>
<Script Language="JavaScript">
function closewin(fname)
{
window.opener.document.form123.<?php echo $_REQUEST["box"];?>.value=fname
window.close()
}
</script>
</head>

<body>

<table width="100%" bgcolor="#F2F2F2">
  <tr>
    <td> <strong><font color="#006699" size="3" face="Arial, Helvetica, sans-serif">Image 
      Uploader </font></strong> </td>
  </tr>
<tr>
    <td>
<hr>
</td></tr>
<tr>
    <td> <strong><font color="#CC3300" size="3" face="Arial, Helvetica, sans-serif"> 
      <?php handleupload(); ?>
      </font></strong> </td>
  </tr>
<tr>
    <td>&nbsp; </td>
  </tr>
<tr>
    <td>
<hr>
</td></tr>
<tr>
    <td align=center> <strong><font color="#CC3300" size="3" face="Arial, Helvetica, sans-serif"> 
      <?php if($sbdontshowfinish!=1)	{?>
      <a href="javascript:onclick=closewin(fname)" class="insidelink">FINISH</a> 
      <?php }	//end if?>
      </font></strong> </td>
  </tr>
</table>
</body>
</html>