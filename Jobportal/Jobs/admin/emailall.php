<?
include_once "logincheck.php"; 
include_once "myconnect.php";
function main()
{
$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?>
<script language="JavaScript">
<!--
function emailCheck (emailStr) {
var emailPat=/^(.+)@(.+)$/
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
var validChars="\[^\\s" + specialChars + "\]"
var quotedUser="(\"[^\"]*\")"
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
var atom=validChars + '+'
var word="(" + atom + "|" + quotedUser + ")"
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
var matchArray=emailStr.match(emailPat)
if (matchArray==null) {
	alert("Email address seems incorrect (check @ and .'s)")
	return false
}
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null) {
    alert("The username doesn't seem to be valid.")
    return false
}
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
	  for (var i=1;i<=4;i++) {
	    if (IPArray[i]>255) {
	        alert("Destination IP address is invalid!")
		return false
	    }
    }
    return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null) {
	alert("The domain name doesn't seem to be valid.")
    return false
}
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 || 
		domArr[domArr.length-1].length>4) {
	   alert("The address must end in a valid domain, or two letter country.")
   return false
}
if (len<2) {
   var errStr="This address is missing a hostname!"
   alert(errStr)
   return false
}
return true;
}

function Validate()
{
if (form123.email.value=='')
{
	alert("Please Enter Sender's Email Address in From field");
	document.form123.email.focus();
	return (false);
}
if (!emailCheck (form123.email.value) )
			{
				form123.email.focus();
				return (false);
			}
if (form123.subject.value=='')
{
	alert("Please Enter Subject");
	document.form123.subject.focus();
	return (false);
}

if (form123.message.value=='')
{
	alert("Please Enter Message");
	document.form123.message.focus();
	return (false);
}


return(true);
}

//-->
</script>
<form action="sendmessageall.php" method="post" name="form123" id="form123" onsubmit="return Validate();">
  <div align="center">
    <table width="90%" border="0" align="center" cellpadding="2" cellspacing="10">
      <tr> 
        <td height="25" colspan="2" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"> 
          <strong>&nbsp; Send Mail to All Members</strong></font></strong></td>
      </tr>
      <tr> 
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">To:</font></b></td>
        <td width="60%" valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <input name="radiobutton" type="radio" value="A" checked>
          All Job Seekers</font> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <br>
          <input name="radiobutton" type="radio" value="E">
          All Employers</font> <font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
          </font><font size="2" face="Arial, Helvetica, sans-serif"> <br>
          <input type="radio" name="radiobutton" value="M">
          All Subscribers <br>
          <input type="radio" name="radiobutton" value="B">
          All</font></td>
      </tr>
      <tr> 
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">From:</font></b></td>
        <td width="60%">
<input name="email" type="text" value="<? echo $config["sb_admin_email"];?>" size="24" border="0"></td>
      </tr>
      <tr> 
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Subject 
          :</font></b></td>
        <td width="60%">
<input name="subject" type="text" size="50" border="0"></td>
      </tr>
      <tr> 
        <td width="40%" height="219" align="right" valign="top" bgcolor="#F5F5F5"><b><font size="2" face="Arial, Helvetica, sans-serif">Message:</font></b></td>
        <td width="60%">
<textarea name="message" cols="45" rows="12" id="textarea2" border="0"></textarea> 
        </td>
      </tr>
      <tr>
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5">&nbsp;</td>
        <td width="60%"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <input name="html" type="checkbox" id="html" value="yes">
          Send in HTML Format</font></td>
      </tr>
      <tr> 
        <td width="40%" align="right" valign="top" bgcolor="#F5F5F5"> 
          <div align="center"> 
            <font size="2" face="Arial, Helvetica, sans-serif"><br>
            </font></div></td>
        <td width="60%">
<input type="submit" name="submitButtonName" value="Send" border="0"></td>
      </tr>
    </table>
  </div>
</form>
<?
}//main()
include "template.php";
?>
