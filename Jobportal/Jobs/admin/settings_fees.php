<?
include "logincheck.php";
include_once "myconnect.php";
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?>
<script language="JavaScript">
function attachment(box)
{
str="fileupload1.php?box="  + box;

window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=350,height=450,location=no,directories=no,scrollbars=yes");
}

function removeattachment(box)
{
window.document.form123.list1.value=""
}

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
	alert("Paypal ID seems incorrect (check @ and .'s)")
	return false
}
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null) {
    alert("Paypal ID seems incorrect (check username).")
    return false
}
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
	  for (var i=1;i<=4;i++) {
	    if (IPArray[i]>255) {
	        alert("Paypal ID seems incorrect (check Destination url)")
		return false
	    }
    }
    return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null) {
	alert("Paypal ID seems incorrect (check domain name)")
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
   var errStr="Paypal ID seems incorrect (missing hostname)"
   alert(errStr)
   return false
}
return true;
}

function Validator(form)
{
     if( form.sb_paypal_id.value!= "" )
     {
		if (!emailCheck (form.sb_paypal_id.value) )
			{
				form.sb_paypal_id.focus();
				return (false);
			}
     }
	 else
	 {
	 alert('Please specify Paypal ID');
				form.sb_paypal_id.focus();
	 return(false);
	 }

if( form.sb_fee_symbol.value=="")
{
alert ('Please specify Fee Currency Symbol!');
form.sb_fee_symbol.focus();
return false;
}

if( form.sb_fee_code.value=="")
{
alert ('Please specify Fee Currency Code!');
form.sb_fee_code.focus();
return false;
}

if(isNaN(form.sb_premium_fee.value) || (form.sb_premium_fee.value<0)||(form.sb_premium_fee.value==""))
{
alert ('Please specify positive numeric value for Premium Fee!');
form.sb_premium_fee.focus();
return false;
}
if(isNaN(form.sb_job_fee.value) || (form.sb_job_fee.value<0)||(form.sb_job_fee.value==""))
{
alert ('Please specify positive numeric value for Job Posting Fee!');
form.sb_job_fee.focus();
return false;
}
if(isNaN(form.sb_job_fee_additional.value) || (form.sb_job_fee_additional.value<0)||(form.sb_job_fee_additional.value==""))
{
alert ('Please specify positive numeric value for Job Posting Additional Fee!');
form.sb_job_fee_additional.focus();
return false;
}
if(isNaN(form.sb_front_featured_fee.value) || (form.sb_front_featured_fee.value<0)||(form.sb_front_featured_fee.value==""))
{
alert ('Please specify positive numeric value for Front Page Featured Fee!');
form.sb_front_featured_fee.focus();
return false;
}
if(isNaN(form.sb_featured_fee.value) || (form.sb_featured_fee.value<0)||(form.sb_featured_fee.value==""))
{
alert ('Please specify positive numeric value for Featured Fee!');
form.sb_featured_fee.focus();
return false;
}
if(isNaN(form.sb_highlight_fee.value) || (form.sb_highlight_fee.value<0)||(form.sb_highlight_fee.value==""))
{
alert ('Please specify positive numeric value for Highlighted Fee!');
form.sb_highlight_fee.focus();
return false;
}
if(isNaN(form.sb_bold_fee.value) || (form.sb_bold_fee.value<0)||(form.sb_bold_fee.value==""))
{
alert ('Please specify positive numeric value for Bold Fee!');
form.sb_bold_fee.focus();
return false;
}

return true;
}

</script>
<form action="update_fee_set.php" method="post" name="form123" id="form123"  onSubmit="return Validator(this);" >
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td><table width="100%" border="0" cellspacing="10" cellpadding="2">
          <tr> 
            <td height="25" colspan="3" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Config 
              Billing Fees</font></strong></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td colspan="3"><font size="1" face="Arial, Helvetica, sans-serif">This 
              will control the Billing Fees of each and every paid feature of 
              the site. If you want some feature to act as free enter zero.</font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Paypal 
                ID :</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              </font><font size="1"> </font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_paypal_id" type="text" class="box1" id="sb_paypal_id" value="<? echo $rs0["sb_paypal_id"];?>" size="35">
              </font><font size="1"><br>
              Please provide your paypal id for the following paid services.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td width="48%" bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Fee 
                Currency Symbol:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td width="52%"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <font size="2" face="Arial, Helvetica, sans-serif"> </font><font size="1"> 
              </font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_fee_symbol" type="text" class="box1" id="sb_fee_symbol" value="<? echo $rs0["sb_fee_symbol"];?>" size="10">
              </font><font size="1"><br>
              This will control the currency for all the transactions, if changed 
              all the existing transactions will be changed.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Fee 
                Currency Code:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> <font size="2" face="Arial, Helvetica, sans-serif"> 
              </font><font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              </font></font><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_fee_code" type="text" class="box1" id="sb_fee_code" value="<? echo $rs0["sb_fee_code"];?>" size="10">
              </font></font><font size="1"><br>
              This will control the currency code used in paypal.</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Premium Member Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_premium_fee" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_premium_fee"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              any employer posts an image for premium gallery. </font> <font size="1">(Enter 
              0 to Disable)</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Job Posting Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_job_fee" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_job_fee"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody posts a job. </font> <font size="1">(Enter 0 to Disable)</font></font></td>
          </tr>
          <!--  <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Latest 
                News:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_latest_news_cnt" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_latest_news_cnt"];?>" size="10">
              <font size="1"><br>
              This will control the number of recent commented forums to be shown 
              on front page.</font></font></td>
          </tr>-->
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Job 
                Posting Additional Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_job_fee_additional" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_job_fee_additional"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody posts a job in additional location/category as per location/category. 
              </font> <font size="1">(Enter 0 to Disable)</font></font></td>
          </tr>
          <tr valign="top" class="row1"> 
            <td bgcolor="#F5F5F5"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                Front Page Featured Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_front_featured_fee" type="text" class="box1" id="recperpage3" value="<? echo $rs0["sb_front_featured_fee"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody chooses to make their jobs to be appeared in the Front 
              Page Featured Section. </font></font><font size="1" face="Arial, Helvetica, sans-serif">(Enter 
              0 to Disable)</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels"> 
              Featured Fee:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"> 
              </font><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_featured_fee" type="text" class="box1" id="sb_featured_fee" value="<? echo $rs0["sb_featured_fee"];?>" size="10">
              </font></font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody chooses to make their jobs as Featured Jobs. </font> <font size="1">(Enter 
              0 to Disable)</font></font></td>
          </tr>
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Highlighted 
                Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_highlight_fee" type="text" class="box1" id="sb_highlight_fee" value="<? echo $rs0["sb_highlight_fee"];?>" size="10">
              </font><font face="Arial, Helvetica, sans-serif"><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody chooses to make their jobts to be appeared as Highlighted. 
              </font></font><font size="1">(Enter 0 to Disable)</font></font></td>
          </tr>
          <!-- <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Private 
              Messaging:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="pvt_messaging">
                <option value="enable">Enable</option>
                <option value="disable" <?php 
			if($rs0["sb_pvt_messaging"]=="disable") echo "selected";?>>Disable</option>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will enable private messaging between members.</font></font></td>
          </tr>-->
          <tr valign="top"> 
            <td bgcolor="#F5F5F5" class="row1"> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Bold 
                Fee:</strong></font></div></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="sb_bold_fee" type="text" class="box1" id="sb_bold_fee" value="<? echo $rs0["sb_bold_fee"];?>" size="10">
              <font size="2" face="Arial, Helvetica, sans-serif"> </font></font><font face="Arial, Helvetica, sans-serif"><font size="1"><br>
              The amount shown above will be deducted </font> <font size="1">if 
              somebody chooses to make their jobs to be appeared as Bold. </font></font><font size="1" face="Arial, Helvetica, sans-serif">(Enter 
              0 to Disable)</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5" class="row1">&nbsp;</td>
            <td>&nbsp;</td>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="Submit2" type="submit" class="submit" value="Update">
              </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>
<?
}// end main
include "template.php";?>