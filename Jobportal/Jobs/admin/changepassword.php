<?
include "logincheck.php";
include "myconnect.php";
function main()
{
//$len=mysql_fetch_array(mysql_query("select pwd_len from sbjbs_config"));
//$pwd_len=$len["pwd_len"];
?>

<script language="JavaScript1.1">
function Validator()
{

if ( frm1.currpassword.value=='' )
{
	alert("Please enter Current Password");
	document.frm1.currpassword.focus();
	return (false);
}
/*if (frm1.newpassword.value.length<<? echo $pwd_len;?>) {
	   alert(' New Password must be atleast <? echo $pwd_len;?> characters long');
	   document.frm1.newpassword.focus();
	   return false;
	   }*/
if ( frm1.newpassword.value=='' )
{
	alert("Please enter New Password");
	document.frm1.newpassword.focus();
	return (false);
}
if ( frm1.retypepassword.value !=frm1.newpassword.value)
{
	alert("Retyped password does not match the new Password");
	document.frm1.retypepassword.value="";
	document.frm1.newpassword.focus();
	document.frm1.newpassword.select();
	return (false);
}
return (true);
}

</script>
<form action="updatepassword.php" method="post" name="frm1" id="frm1"  onSubmit="return Validator();" >
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td><table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
          <tr bgcolor="#004080"> 
            <td height="25" colspan="2"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<font face="Arial, Helvetica, sans-serif">Change 
              Password</font></font></strong></td>
          </tr>
          <tr> 
            <td width="50%" valign="top" bgcolor="#F5F5F5" class="row1"> 
              <div align="right"><font face="Arial, Helvetica, sans-serif"><strong><font size="2">Current 
                Password :</font></strong></font></div></td>
            <td width="59%" class="row1"> <input name="currpassword" type="password" class="box" id="currpassword" value=""> 
            </td>
          </tr>
          <tr> 
            <td valign="top" bgcolor="#F5F5F5" class="row2"> 
              <div align="right"><font face="Arial, Helvetica, sans-serif"><strong><font size="2">New 
                Password :</font></strong></font></div></td>
            <td class="row2"> <input name="newpassword" type="password" class="box" id="newpassword" >
              <font size="1" face="Verdana, Arial, Helvetica, sans-serif" value="" ><br>
              <!--<font face="Arial, Helvetica, sans-serif">must be atleast <? echo $pwd_len;?> 
              characters long</font>--></font></td>
          </tr>
          <tr> 
            <td valign="top" bgcolor="#F5F5F5" class="row1"> 
              <div align="right"><font face="Arial, Helvetica, sans-serif"><strong><font size="2">Retype 
                Password :</font></strong></font></div></td>
            <td class="row1"> <input name="retypepassword" type="password" class="box" id="retypepassword">
              <font size="1" face="Verdana, Arial, Helvetica, sans-serif" value="" ><br>
              </font></td>
          </tr>
          <tr> 
            <td valign="top" bgcolor="#F5F5F5">&nbsp;</td>
            <td><input name="Submit" type="submit" class="submit" value="Update Password"></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>

<?
}//end main
include "template.php";?>