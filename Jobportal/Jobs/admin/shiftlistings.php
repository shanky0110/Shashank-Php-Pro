<?
include_once("myconnect.php");
include_once("logincheck.php");

$errcnt=0;
$showform=true;
$msg="";
$selected=0;
$errcnt=0;

if ( (count($_POST) != 0) && (isset($_REQUEST["Submit"])) && ($_REQUEST["Submit"]=="Shift Now") )
{
	if ( !isset($_REQUEST["sbresumes"]) && !isset($_REQUEST["sbjobs"]) && !isset($_REQUEST["sbprofile"]) )
	{
		$errs[$errcnt]="Atleast one option must be selected";
		$errcnt++;
	}

	if($errcnt == 0)
	{
		$sbresume_count=0;
		$sbjob_count=0;
		$sbprofile_count=0;

		if(isset($_REQUEST["sbresumes"]) && ($_REQUEST["sbresumes"] == 'Yes') )
		{
			mysql_query("update sbjbs_resume_cats set sb_cid=".$_REQUEST["cat1"]." where sb_cid=".$_REQUEST["cid"]);
			$sbresume_count=mysql_affected_rows();
		}

		if(isset($_REQUEST["sbjobs"]) && ($_REQUEST["sbjobs"] == 'Yes') )
		{
			mysql_query("update sbjbs_job_cats set sb_cid=".$_REQUEST["cat1"]." where sb_cid=".$_REQUEST["cid"]);
			$sbjob_count=mysql_affected_rows();
		}
		if(isset($_REQUEST["sbprofile"]) && ($_REQUEST["sbprofile"] == 'Yes') )
		{
			$sbq="update sbjbs_profile_cats set sb_cid=".$_REQUEST["cat1"]." where sb_cid=".$_REQUEST["cid"];
		//	die($sbq);
			mysql_query($sbq);	
			$sbprofile_count=mysql_affected_rows();
		}
		$showform=false;
	}	// 	end if errcnt == 0
} // end if form posted

function main()
{
	global $errs, $errcnt, $showform, $sbresume_count, $sbjob_count, $sbprofile_count;
	
	$cid=$_REQUEST["cid"];
	$list_num=mysql_num_rows(mysql_query("select * from sbjbs_resume_cats where sb_cid=$cid"));
	$list_num1=mysql_num_rows(mysql_query("select * from sbjbs_job_cats where sb_cid=$cid"));
	$list_num3=mysql_num_rows(mysql_query("select * from sbjbs_profile_cats where sb_cid=$cid"));

	$sbtotal=$list_num+$list_num1+$list_num3;
	if( (count($_POST) != 0) && (isset($_REQUEST["Submit"])) && ($_REQUEST["Submit"]=="Shift Now") )
	{		//IF SOME FORM WAS POSTED DO VALIDATION
		if( $errcnt != 0 )
		{
		//	ob_end_flush();
?>
<table width="558" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            
          <td colspan="2"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong>Your Request cannot be processed due to following reasons</strong></font></td>
          </tr>
          <?

for ($i=0;$i<$errcnt;$i++)
{
?>
          <tr> 
            <td width="6%"><strong><font color="#FF0000"><?php echo $i+1; ?></font></strong></td>
            <td width="94%"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><?php echo  $errs[$i]; ?> 
              </font></td>
          </tr>
          <?
}//end for
?>
        </table>
     
      
<?
		}	//end else-errcnt==0
	}		//end if count-post

	if ($showform)
	{		
?>
	<script language="JavaScript">
//<!--
function select_all()
{
  for (var i=0;i<document.form2.elements.length;i++)
  {
    var e =document.form2.elements[i];
    if ((e.name != 'check_all') && (e.type=='checkbox'))
    {
       e.checked = document.form2.check_all.checked;
    }
  }

}

function validate_form(frm)
{
    if ( frm.sbresumes.checked == false && frm.sbjobs.checked == false && frm.sbprofile.checked == false )
    {
		alert("Please select atleast one option");
		frm.check_all.focus();
		return false;
    }

	return true;
}
//-->
</script>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
  <tr> 
    <td height="25" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Shift 
      listing from <font color="#FFcc00"> 
      <?php 
	  $sbq_cat="select * from sbjbs_categories where sb_id=".$_REQUEST["cid"]; 
	  $sbrow_cat=mysql_fetch_array(mysql_query($sbq_cat));
	  echo $sbrow_cat["sb_cat_name"];
	  ?>
      </font> to <font color="#FFcc00"> 
      <?php $sbq_cat="select * from sbjbs_categories where sb_id=".$_REQUEST["cat1"]; 
	  $sbrow_cat=mysql_fetch_array(mysql_query($sbq_cat));
	  echo $sbrow_cat["sb_cat_name"];
	  ?>
      </font></strong></font></td>
  </tr>
  <form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return validate_form(this);">
    <tr> 
      <td align="right" valign="top" bgcolor="#F5F5F5"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <input name="check_all" type="checkbox" id="check_all" onClick="select_all();" value="Yes">
          Shift all <strong>(<?php echo $sbtotal; ?>)</strong></font></div></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="sbresumes" type="checkbox" id="sbresumes" value="Yes">
        Shift only Resumes <strong>(<?php echo $list_num; ?>)</strong></font></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="sbjobs" type="checkbox" id="sbjobs" value="Yes">
        Shift only Jobs<strong>(<?php echo $list_num1; ?>)</strong></font></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="sbprofile" type="checkbox" id="sbprofile" value="Yes">
        Shift only Company Profiles <strong>(<?php echo $list_num3; ?>)</strong></font></td>
    </tr>
    <tr> 
      <td valign="top" bgcolor="#F5F5F5"> 
	  <input name="Submit" type="submit" id="Submit" value="Shift Now"> 
        <input name="cat1" type="hidden" id="cat1" value="<?php echo $_REQUEST["cat1"]; ?>"> 
        <input name="cid" type="hidden" id="cid" value="<?php echo $_REQUEST["cid"]; ?>"> 
      </td>
    </tr>
  </form>
</table>
<?
	}		//end if showform
	else
	{		//show the result	?>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
  <tr> 
    <td height="25" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Following 
      listing shifted from <font color="#FFcc00"> 
      <?php $sbq_cat="select * from sbjbs_categories where sb_id=".$_REQUEST["cid"]; 
	  $sbrow_cat=mysql_fetch_array(mysql_query($sbq_cat));
	  echo $sbrow_cat["sb_cat_name"];
	  ?>
      </font> to <font color="#FFcc00"> 
      <?php $sbq_cat="select * from sbjbs_categories where sb_id=".$_REQUEST["cat1"]; 
	  $sbrow_cat=mysql_fetch_array(mysql_query($sbq_cat));
	  echo $sbrow_cat["sb_cat_name"];
	  ?>
      </font></strong></font></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"> 
      <?php echo ($sbresume_count > 1 )?" $sbresume_count Resumes":" $sbresume_count Resume"; ?> 
      shifted</font></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo ($sbjob_count > 1)?" $sbjob_count Jobs":" $sbjob_count Job"; ?> 
      shifted</font></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#F5F5F5"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo ($sbprofile_count > 1)?" $sbprofile_count Company Profiles":" $sbprofile_count Company Profile"; ?> 
      shifted</font></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#F5F5F5"> <font size="2" face="Arial, Helvetica, sans-serif">Click 
      <a href="browsecats.php?cid=<?php echo $cid; ?>">here</a> 
      to go back to Manage Category Section</font></td>
  </tr>
</table>
<?php
	}
}  //End of main
include_once("template.php");
?>