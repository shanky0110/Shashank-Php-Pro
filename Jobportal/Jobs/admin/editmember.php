<?
include_once "logincheck.php";
include_once("myconnect.php");

$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
	$sb_dob_day=(int)$_REQUEST['sb_dob_day'];
	$sb_dob_month=(int)$_REQUEST['sb_dob_month'];
	$sb_dob_year=(int)$_REQUEST['sb_dob_year'];

		if(!get_magic_quotes_gpc())
		{
			$password=str_replace("$","\$",addslashes($_REQUEST["password"]));
			$sb_title=str_replace("$","\$",addslashes($_REQUEST["sb_title"]));
			$firstname=str_replace("$","\$",addslashes($_REQUEST["firstname"]));
			$lastname=str_replace("$","\$",addslashes($_REQUEST["lastname"]));
			$email=str_replace("$","\$",addslashes($_REQUEST["email"]));
			$street=str_replace("$","\$",addslashes($_REQUEST["street"]));
			$city=str_replace("$","\$",addslashes($_REQUEST["city"]));
			$state=str_replace("$","\$",addslashes($_REQUEST["state"]));
			$other_state=str_replace("$","\$",addslashes($_REQUEST["other_state"]));
			$phone=str_replace("$","\$",addslashes($_REQUEST["phone"]));
			$phone1=str_replace("$","\$",addslashes($_REQUEST["phone1"]));
			$phone2=str_replace("$","\$",addslashes($_REQUEST["phone2"]));
			$mobile=str_replace("$","\$",addslashes($_REQUEST["mobile"]));
			$zip_code=str_replace("$","\$",addslashes($_REQUEST["zip_code"]));
		}
		else
		{
			$password=str_replace("$","\$",$_REQUEST["password"]);
			$sb_title=str_replace("$","\$",$_REQUEST["sb_title"]);
			$firstname=str_replace("$","\$",$_REQUEST["firstname"]);
			$lastname=str_replace("$","\$",$_REQUEST["lastname"]);
			$email=str_replace("$","\$",$_REQUEST["email"]);
			$street=str_replace("$","\$",$_REQUEST["street"]);
			$city=str_replace("$","\$",$_REQUEST["city"]);
			$state=str_replace("$","\$",$_REQUEST["state"]);
			$other_state=str_replace("$","\$",$_REQUEST["other_state"]);
			$phone=str_replace("$","\$",$_REQUEST["phone"]);
			$phone1=str_replace("$","\$",$_REQUEST["phone1"]);
			$phone2=str_replace("$","\$",$_REQUEST["phone2"]);
			$mobile=str_replace("$","\$",$_REQUEST["mobile"]);
			$zip_code=str_replace("$","\$",$_REQUEST["zip_code"]);
	}
	if($state=="")
	{ $state=$other_state; }
	
	$phone_no="";
	if(strlen(trim($phone))<>0)
	{$phone_no.=$phone;}
	$phone_no.="-";
	if(strlen(trim($phone1))<>0)
	{$phone_no.=$phone1;}
	$phone_no.="-";
	if(strlen(trim($phone2))<>0)
	{$phone_no.=$phone2;}

	if ( !isset( $_REQUEST["password"] ) || (strlen(trim($_REQUEST["password"])) == 0) )
	{
		$errs[$errcnt]="Password must be provided";
   		$errcnt++;
	}

	if ( strlen(trim($firstname)) == 0 )
	{
		$errs[$errcnt]="Firstname must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["firstname"]))
	{
		$errs[$errcnt]="Firstname can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if ( strlen(trim($lastname)) == 0 )
	{
		$errs[$errcnt]="Lastname must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["lastname"]))
	{
		$errs[$errcnt]="Lastname can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if(!checkdate($sb_dob_month, $sb_dob_day, $sb_dob_year))	
	{
		$errs[$errcnt]="Date of Birth must be a valid date";
   		$errcnt++;
	}
	elseif( ($sb_dob_year< date("Y",time())-100 ) || ($sb_dob_year>=date("Y",time())) )
	{
		$errs[$errcnt]="Date of Birth has suspecious year value";
   		$errcnt++;
	}
		if ( !isset( $_REQUEST["email"] ) || (strlen(trim($_REQUEST["email"] )) == 0) )
		{
			$errs[$errcnt]="Email Address must be provided";
			$errcnt++;
		}
		elseif(preg_match ("/[;<>&]/", $_REQUEST["email"]))
		{
			$errs[$errcnt]="Email can not have any special character (e.g. & ; < >)";
			$errcnt++;
		}
		elseif(mysql_num_rows(mysql_query("select * from sbjbs_seekers where sb_email_addr='$email' and sb_id<>".$_REQUEST["id"]))!= 0)
	{
			$errs[$errcnt]="Some member with same Email Address already exists";
    		$errcnt++;
	}

	if ( strlen(trim($street)) == 0 )
	{
		$errs[$errcnt]="Street must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["street"]))
	{
		$errs[$errcnt]="Street can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}
	
	if ( strlen(trim($city)) == 0 )
	{
		$errs[$errcnt]="City must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["city"]))
	{
		$errs[$errcnt]="City can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}
	
	if ( strlen(trim($state)) == 0 )
	{
		$errs[$errcnt]="State must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["state"]))
	{
		$errs[$errcnt]="State can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}
	
	if ( strlen(trim($zip_code)) == 0 )
	{
		$errs[$errcnt]="Zip/Postal Code must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["zip_code"]))
	{
		$errs[$errcnt]="Zip/Postal Code can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}
	
	if ( $_REQUEST["country"]== 0 )
	{
		$errs[$errcnt]="Country must be choosen";
   		$errcnt++;
	}
	
	if(preg_match ("/[;<>&]/", $phone_no))
	{
		$errs[$errcnt]="Phone No. can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if(preg_match ("/[;<>&]/", $mobile))
	{
		$errs[$errcnt]="Mobile can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if($errcnt==0)
	{

		if($sb_dob_month<10)
			$sb_dob_month="0".$sb_dob_month;
		if($sb_dob_day<10)
			$sb_dob_day="0".$sb_dob_day;
		$sb_dob=$sb_dob_year.$sb_dob_month.$sb_dob_day."000000";
	$query_update="update `sbjbs_seekers` set 
	sb_title='$sb_title',
	sb_firstname='$firstname' ,
	sb_lastname='$lastname' , 
	sb_addr1='$street' , 
	sb_city='$city' , 
	sb_state='$state' , 
	sb_zip='$zip_code' , 
	sb_country=".$_REQUEST["country"]." , 
	sb_telephone='$phone_no', 
	sb_mobile='$mobile',
	sb_password='$password',
	sb_dob='$sb_dob',
	sb_email_addr='$email' 
	where sb_id=".$_REQUEST["id"];
//echo $query_update;
//die();
	$rs_update=mysql_query($query_update);
	
	if(mysql_affected_rows()>0)
	{
		header("Location: members.php?msg=".urlencode("Member profile has been updated."));
		die();
	}
	else
	{
		header("Location: members.php?msg=".urlencode("No updations carried out. Please try again!"));
		die();
	}
 }			//end if-errcnt==0
}			//end if count-post


function main()
{
global $errs, $errcnt;

$mem=mysql_fetch_array(mysql_query("select *,DATE_FORMAT(sb_dob,'%Y-%m-%d') as sbdob from sbjbs_seekers where sb_id=".$_REQUEST["id"]));

//IF SOME FORM WAS POSTED DO VALIDATION
if ( $mem )
{
$username=$mem["sb_username"];
$password=$mem["sb_password"];
$sb_title=$mem["sb_title"];
$firstname=$mem["sb_firstname"];
$lastname=$mem["sb_lastname"];
$email=$mem["sb_email_addr"];
$street=$mem["sb_addr1"];
$city=$mem["sb_city"];
$state=$mem["sb_state"];
$country=$mem["sb_country"];
$zip_code=$mem["sb_zip"];

$phone_arr=explode("-",$mem["sb_telephone"]);
//if(count
$phone=$phone_arr[0];
$phone1=$phone_arr[1];
$phone2=$phone_arr[2];

$mobile=$mem["sb_mobile"];
$other_state=$mem["sb_state"];
//////---------breaking dob
$sbdob=explode("-",$mem["sbdob"]);
$sb_dob_day=$sbdob[2];
$sb_dob_month=$sbdob[1];
$sb_dob_year=$sbdob[0];
}
else
{
echo "<p>&nbsp;</p><p>&nbsp;</p><br><br><br><div align='center'><font class='normal'>Member Not Found. Click <a href='index.php' >here</a> to continue</font></div><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
return;
}
if  (count($_POST)>0)
{
			$password=$_REQUEST["password"];
			$sb_title=$_REQUEST["sb_title"];
			$firstname=$_REQUEST["firstname"];
			$lastname=$_REQUEST["lastname"];
			$email=$_REQUEST["email"];
			$street=$_REQUEST["street"];
			$city=$_REQUEST["city"];
			$state=$_REQUEST["state"];
			$other_state=$_REQUEST["other_state"];
			$phone=$_REQUEST["phone"];
			$phone1=$_REQUEST["phone1"];
			$phone2=$_REQUEST["phone2"];
			$mobile=$_REQUEST["mobile"];
			$zip_code=$_REQUEST["zip_code"];
	$country=$_REQUEST["country"];
	$sb_dob_day=(int)$_REQUEST['sb_dob_day'];
	$sb_dob_month=(int)$_REQUEST['sb_dob_month'];
	$sb_dob_year=(int)$_REQUEST['sb_dob_year'];

}


if  (count($_POST)>0)
{

if ( $errcnt<>0 )
{
?>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
  <tr> 
    <td colspan="2"><strong>&nbsp;Your Request cannot be processed due 
      to following Reasons</strong></td>
  </tr>
  <tr height="10"> 
    <td colspan="2"></td>
  </tr>
  <?

for ($i=0;$i<$errcnt;$i++)
{
?>
  <tr valign="top"> 
    <td width="6%">&nbsp;<?php echo $i+1;?></td>
    <td width="94%"><?php echo  $errs[$i]; ?></td>
  </tr>
  <?
}
?>
</table>
<?

}

}

?>
<SCRIPT language=javascript> 
//<!--
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


  function validate(form) 
  {
	
       if(form.password.value == "")
		{
	   	   alert('Please Specify Password!');
           form.password.focus();
		   return false; 
        }
	
	if ( form.firstname.value == "" ) {
       	   alert('Please Specify Firstname!');
		   form.firstname.focus();
	   return false;
	   }
	if(form.firstname.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from Firstname (e.g. &  < >)");
			form.firstname.focus();
			return(false);
		}
	if ( form.lastname.value == "" ) {
       	   alert('Please Specify Lastname!');
		   form.lastname.focus();
	   return false;
	   }
	if(form.lastname.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from Lastname (e.g. &  < >)");
			form.lastname.focus();
			return(false);
		}

	 	if ( isNaN(form.sb_dob_year.value) || form.sb_dob_year.value == "" || form.sb_dob_year.value <= 0 ) // || form.sb_dob_year.value<1900 || form.sb_dob_year.value>2000 ) 
		{
       	   	alert('Please Specify valid Year in Date of Birth!');
		   	form.sb_dob_year.focus();
	   		return false;
	   	}

    if(!form.email.value.match(/[a-zA-Z\.\@\d\_]/)) 
		{
           alert('Invalid e-mail address.');
           form.email.focus();
		   return false;
        }
		
	if (!emailCheck (form.email.value) )
		{
			form.email.focus();
			return (false);
		}

	if ( form.street.value == "" ) {
       	   alert('Please Specify Street!');
		   form.street.focus();
	   return false;
	   }
	if(form.street.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from Street (e.g. &  < >)");
			form.street.focus();
			return(false);
		}

	if ( form.city.value == "" ) {
       	   alert('Please Specify City!');
		   form.city.focus();
	   return false;
	   }
		if(form.city.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from City(e.g. &  < >)");
			form.city.focus();
			return(false);
		}
	if ( (form.state.selectedIndex == 0 ) && (form.other_state.value == "") ) {
       	   alert('Please Specify State!');
		   form.state.focus();
	   return false;
	   }
		if(form.other_state.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from State(e.g. &  < >)");
			form.other_state.focus();
			return(false);
		}
		if ( form.zip_code.value == "" ) {
       	   alert('Please Specify Zip/Postal Code!');
		   form.zip_code.focus();
	   return false;
	   }
	if(form.zip_code.value.match(/[&<>]+/))
		{
			alert("Please remove Invalid characters from Zip/Postal Code (e.g. &  < >)");
			form.zip_code.focus();
			return(false);
		}
if ( form.country.selectedIndex == 0 ) {
       	   alert('Please Choose a Country!');
		   form.country.focus();
	   return false;
	   }
	return true;
  }
// -->
</SCRIPT>

<form name="form1" method="post" action="editmember.php" onSubmit="return validate(this);">
  <table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" class="onepxtable">
    <tr class="titlestyle"> 
      <td colspan="3">&nbsp;Edit Personal Profile (Job Seeker)</td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Username</strong></font></td>
      <td>&nbsp;</td>
      <td><font class="smalltext"><?php echo $username  ; ?></font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Password</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="password" type="text"  value="<?php echo $password; ?>" size="30" maxlength="30">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Title</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2">&nbsp; </font><FONT face="Verdana, Arial" size=2> 
        <SELECT name=sb_title id="sb_title">
          <OPTION value="Mr." <?php echo ($sb_title=='Mr.')?'selected':''; ?>>Mr.</OPTION>
          <OPTION value="Ms." <?php echo ($sb_title=='Ms.')?'selected':''; ?>>Ms.</OPTION>
          <OPTION value="Mrs." <?php echo ($sb_title=='Mrs.')?'selected':''; ?>>Mrs.</OPTION>
        </SELECT>
        </FONT><font face="Arial, Helvetica, sans-serif" size="2">&nbsp; </font></td>
    </tr>
    <tr valign="top"> 
      <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Firstname</strong></font></td>
      <td width="6"><font class="red">*</font></td>
      <td width="60%"><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="firstname" type="text"  value="<?php echo $firstname; ?>" size="30" maxlength="30">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Lastname</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="lastname" type="text"  value="<?php echo $lastname  ; ?>" size="30" maxlength="30">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Date 
        of Birth</strong></font></td>
      <td><font class="red">*</font></td>
      <td><table border="0" align="left" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="100"><font class="smalltext">Month</font></td>
            <td width="50"><font class="smalltext">Day</font></td>
            <td><font class="smalltext">Year</font></td>
          </tr>
          <tr> 
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <SELECT name="sb_dob_month">
                <OPTION value="1" <?php echo($sb_dob_month==1)?'selected':''; ?>>January</OPTION>
                <OPTION value="2" <?php echo($sb_dob_month==2)?'selected':''; ?>>February</OPTION>
                <OPTION               value="3" <?php echo($sb_dob_month==3)?'selected':''; ?>>March</OPTION>
                <OPTION               value="4" <?php echo($sb_dob_month==4)?'selected':''; ?>>April</OPTION>
                <OPTION               value="5" <?php echo($sb_dob_month==5)?'selected':''; ?>>May</OPTION>
                <OPTION               value="6" <?php echo($sb_dob_month==6)?'selected':''; ?>>June</OPTION>
                <OPTION               value="7" <?php echo($sb_dob_month==7)?'selected':''; ?>>July</OPTION>
                <OPTION               value="8" <?php echo($sb_dob_month==8)?'selected':''; ?>>August</OPTION>
                <OPTION               value="9" <?php echo($sb_dob_month==9)?'selected':''; ?>>September</OPTION>
                <OPTION               value="10" <?php echo($sb_dob_month==10)?'selected':''; ?>>October</OPTION>
                <OPTION               value="11" <?php echo($sb_dob_month==11)?'selected':''; ?>>November</OPTION>
                <OPTION               value="12" <?php echo($sb_dob_month==12)?'selected':''; ?>>December</OPTION>
              </SELECT>
              </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <SELECT name="sb_dob_day">
                <?php 	for($sbi=1;$sbi<=31;$sbi++)
				{
					echo '<option value="'.$sbi.'" ';
					echo ($sb_dob_day==$sbi)?'selected':'';
					echo '>'.$sbi.'</option>';
				}?>
              </SELECT>
              </font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <INPUT type="text" name="sb_dob_year" value="<?php echo $sb_dob_year; ?>" size="8" 
                              maxLength="4">
              </font></td>
          </tr>
        </table>
        <font face="Arial, Helvetica, sans-serif" size="2">&nbsp;</font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Email</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="email" type="text"  value="<?php echo $email; ?>" size="30" maxlength="40">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Street</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input type="text"  size="30" maxlength="30" name="street" value="<?php echo $street; ?>" >
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>City</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input type="text"  size="30" maxlength="30" name="city"  value="<?php echo $city; ?>" >
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>State</strong></font></td>
      <td><font class="red">*</font></td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><font class='normal'>US</font></td>
            <td> <select name="state" >
                <option value="" selected >Select State</option>
                <? 
						  $state1=mysql_query("select * from sbjbs_us_states order by sb_state");
						  while($rst= mysql_fetch_array($state1))
						  {
						  ?>
                <option value=<? echo $rst["sb_state"];?> <? if($rst["sb_state"]==$state) {echo " selected ";}?>><? echo $rst["sb_state"];?></option>
                <?
							   } // wend
							   ?>
              </select> </td>
          </tr>
          <tr> 
            <td><font class='normal'>Non US</font></td>
            <td><input name="other_state" type="text" id="other_state" value="<? echo $other_state;?>"></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="top"> 
      <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Zip/Postal 
        Code </strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="zip_code" type="text"  id="zip_code"  value="<?php echo $zip_code; ?>" size="30" maxlength="30" >
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Country</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"><strong><font color="#004566"> 
        <select name="country" >
          <option selected value="">Select Country</option>
          <?
$rs_t_query=mysql_query ("select * from sbjbs_country order by country");
while ($rs_t=mysql_fetch_array($rs_t_query))    
{
?>
          <option  value="<? echo $rs_t["id"]  ?>"
		  <?php
				if ($country== $rs_t["id"] ) 
				{
				echo "  selected ";
				}
				?>
		  
		  ><? echo $rs_t["country"]  ; ?></option>
          <?
		  }
		  		  ?>
        </select>
        </font></strong></font></td>
    </tr>
    <tr valign="top"> 
      <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Phone</strong></font></td>
      <td>&nbsp;</td>
      <td><table border="0" align="left" cellpadding="0" cellspacing="0">
          <tr> 
            <td><font class="smalltext">Country Code </font></td>
            <td><font class="smalltext">Area Code </font></td>
            <td><font class="smalltext">Phone Number</font></td>
          </tr>
          <tr> 
            <td width="90"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="phone" type="text"  id="phone"  value="<?php echo $phone; ?>" size="5" maxlength="5" >
              </font></td>
            <td width="77"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="phone1" type="text"  id="phone1"   value="<?php echo $phone1; ?>" size="8" maxlength="8" >
              </font></td>
            <td width="148"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="phone2" type="text"  id="phone2"   value="<?php echo $phone2; ?>" size="20" maxlength="20" >
              </font></td>
          </tr>
        </table>
        <font face="Arial, Helvetica, sans-serif" size="2">&nbsp; </font></td>
    </tr>
    <tr valign="top"> 
      <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Mobile</strong></font></td>
      <td>&nbsp;</td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input type="text" name="mobile"  size="30" maxlength="30"   value="<?php echo $mobile; ?>" >
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle">&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="submit"  type="submit" value="Update"> <input name="id" type="hidden" id="id" value="<?php echo $_REQUEST["id"]; ?>"></td>
    </tr>
  </table>
  </form>
<?

}
include_once("template.php");

?>
