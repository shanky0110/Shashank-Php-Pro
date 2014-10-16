<?
include_once "logincheck.php"; 
include_once "myconnect.php";

$id=$_REQUEST["id"];
$rst=mysql_fetch_array(mysql_query("select * from sbjbs_feedback where sb_id=$id"));
?>
<div align="center">
  <table width="70%" border="0" align="center" cellpadding="2" cellspacing="10">
    <tr> 
      <td height="25" colspan="2" bgcolor="#004080"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;View 
        Feedback </strong></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Subject:</font></strong></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rst["sb_title"];?></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Name:</font></strong></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rst["sb_fname"]." ".$rst["sb_lname"];?></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Comments:</font></strong></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo str_replace("\n","<br>",$rst["sb_comments"]);?></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">Email:</font></strong></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rst["sb_email"];?></font></td>
    </tr>
    <tr> 
      <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif">URL:</font></strong></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $rst["sb_url"];?></font></td>
    </tr>
  </table>
</div>