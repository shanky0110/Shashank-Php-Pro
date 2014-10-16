<?php
include_once "session.php";
include_once "styles.php";

if(!isset($_SESSION["softbiz_jbs_adminid"]) )
	die();
?>
<html>
<head>
<Title>Image Uploader</Title>
<script language="JavaScript">
function checkFile()
{
	if (form1.userfile.value == "")
	{
		alert("Please choose a file to upload");
		form1.userfile.focus();
		return (false);
	}
	if ( !form1.userfile.value.match(/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i) )
	{
		alert("Please upload .gif/.jpg/.jpeg/.bmp/.png files only");
		form1.userfile.focus();
		return (false);
	}
	return(true);
}
function submit_frm(frm)
{
	if(checkFile(frm))
	{
		frm.action="doupload.php?box=<?php echo $_REQUEST["box"]; ?>";
		frm.submit();
	}
}

</script>


</head>

<body>
<FORM ENCTYPE="multipart/form-data" METHOD=post ID=form1 NAME=form1 onSubmit="javscript:return checkFile(form1);"> 
  <table class="innertablestyle">
    <tr> 
      <td class="titlestyle"><b><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;Upload 
        Image</font></b></TD>
    </TR>
    <tr> 
      <td> <table>
          <tr> 
            <td valign="top"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">1.</font></td>
            <td><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">To 
              add an image, click the 'Browse' button &amp; select the file, or 
              type the path to the file in the 'Text-box' below.</font></td>
          </tr>
          <tr> 
            <td valign="top"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">2.</font></td>
            <td><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Then 
              click 'Upload' button to complete the process.</font></td>
          </tr>
          <tr> 
            <td valign="top"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">3.</font></td>
            <td valign="top"><font color="#990000" size="2" face="Arial, Helvetica, sans-serif">NOTE</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">: 
              The file transfer can take from a few seconds to a few minutes depending 
              on the size of the file. Please have patience while the file is 
              being uploaded.</font></td>
          </tr>
          <tr> 
            <td valign="top"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">4.</font></td>
            <td><font color="#990000" size="2" face="Arial, Helvetica, sans-serif">NOTE</font><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">: 
              The file will be renamed if the file with the same name is already 
              present.</font></td>
          </tr>
        </table></TD>
    </TR>
    <TR> 
      <TD><font size="2" face="Arial, Helvetica, sans-serif"><STRONG>Hit the [Browse] 
        button to find the file on your computer.</STRONG><BR>
        </font></TD>
    </TR>
    <TR> 
      <TD><font size="2" face="Arial, Helvetica, sans-serif"><strong>Image</strong> 
        <INPUT NAME=userfile SIZE=30 TYPE=file   MaxFileSize="1000000">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        </font></TD>
    </TR>
    <TR> 
      <TD><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></TD>
    </TR>
    <TR> 
      <TD><font size="2" face="Arial, Helvetica, sans-serif"> 
        <input type="button" value="Upload" name="uploadfile" onClick="javascript:submit_frm(this.form);">
        </font></TD>
    </TR>
    <TR> 
      <TD><font color="#990000" size="2" face="Arial, Helvetica, sans-serif">NOTE:</font><font size="2" face="Arial, Helvetica, sans-serif"> 
        Please have<font color="#006699"> </font> patience, you will not receive 
        any notification until the file is completely transferred.<BR>
        </font></TD>
    </TR>
  </table>

</FORM>

   
</body>

</html>