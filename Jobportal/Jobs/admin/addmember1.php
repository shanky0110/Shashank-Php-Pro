<?
include_once("myconnect.php");

$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
//		ob_start();
		if(!get_magic_quotes_gpc())
		{
			$username=str_replace("$","\$",addslashes($_REQUEST["username"]));
			$password=str_replace("$","\$",addslashes($_REQUEST["password"]));
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
			$fax=str_replace("$","\$",addslashes($_REQUEST["fax"]));
			$fax1=str_replace("$","\$",addslashes($_REQUEST["fax1"]));
			$fax2=str_replace("$","\$",addslashes($_REQUEST["fax2"]));
			$mobile=str_replace("$","\$",addslashes($_REQUEST["mobile"]));
			$zip_code=str_replace("$","\$",addslashes($_REQUEST["zip_code"]));
		}
		else
		{
			$username=str_replace("$","\$",$_REQUEST["username"]);
			$password=str_replace("$","\$",$_REQUEST["password"]);
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
			$fax=str_replace("$","\$",$_REQUEST["fax"]);
			$fax1=str_replace("$","\$",$_REQUEST["fax1"]);
			$fax2=str_replace("$","\$",$_REQUEST["fax2"]);
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

	$fax_no="";
	if(strlen(trim($fax))<>0)
	{$fax_no.=$fax;}
	$fax_no.="-";
	if(strlen(trim($fax1))<>0)
	{$fax_no.=$fax1;}
	$fax_no.="-";
	if(strlen(trim($fax2))<>0)
	{$fax_no.=$fax2;}

	if ( strlen(trim($username)) == 0 )
	{
		$errs[$errcnt]="Username must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[^a-zA-Z0-9_]/", $_REQUEST["username"]))
	{
		$errs[$errcnt]="Username can contain only Alpha-Numeric and Underscore character";
   		$errcnt++;
	}
	elseif(mysql_num_rows(mysql_query("select * from sbjbs_seekers where sb_username='$username' or sb_email='$email'"))!= 0)
	{
			$errs[$errcnt]="Some Member with same Username or Email Address already exists";
    		$errcnt++;
	}

	if ( !isset( $_REQUEST["password"] ) || (strlen(trim($_REQUEST["password"])) == 0) )
	{
		$errs[$errcnt]="Password must be provided";
   		$errcnt++;
	}
	elseif( strcmp($_REQUEST["password"],$_REQUEST["pwd2"]) != 0)
	{
		$errs[$errcnt]="Retyped Password does not match the Password";
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

	if ( strlen(trim($email)) == 0 )
	{
		$errs[$errcnt]="Email must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["email"]))
	{
		$errs[$errcnt]="Email can not have any special character (e.g. & ; < >)";
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

	if(preg_match ("/[;<>&]/", $fax_no))
	{
		$errs[$errcnt]="Fax can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if(preg_match ("/[;<>&]/", $mobile))
	{
		$errs[$errcnt]="Mobile can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if($errcnt==0)
	{
 	$suspended="no";
	$mem_type=0;
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	
	if($config["sb_memtype"]<>"")
	{ $mem_type=$config["sb_memtype"];}
	
	$query_insert="Insert into `sbjbs_seekers` 
	( sb_username ,sb_password ,sb_lastlogin,sb_ondate,sb_suspended, sb_firstname , sb_lastname , sb_email , sb_street , sb_city , sb_state , sb_zip , sb_country , sb_phone, sb_fax , sb_mobile ,sb_memtype )
VALUES 	( '$username' ,'$password',0,'".date("YmdHis",time())."','$suspended', '$firstname' , '$lastname','$email','$street','$city','$state','$zip_code' ,".$_REQUEST["country"].",'$phone_no','$fax_no','$mobile',$mem_type )
";
echo $query_insert;
//die();
		$rs_insert=mysql_query($query_insert);
		if(mysql_affected_rows()>0)
		{
		if(isset($_REQUEST["subscribe"])&&($_REQUEST["subscribe"]=="yes"))
		{
		  $check_prev=mysql_fetch_array(mysql_query("select * from sbjbs_newsletter where sb_email='$email'"));
		  if(!$check_prev)
		  {
		  mysql_query("insert into sbjbs_newsletter (sb_email) values ('$email')");
		  }
		}

		$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
		$sb_null_char=$sbrow_con["sb_null_char"];
		$sb_site_root=$sbrow_con["sb_site_root"];
					
		$rs0= mysql_fetch_array(mysql_query("SELECT * FROM sbjbs_seekers WHERE sb_email='$email'"));
		if($rs0)
		{
		//Reads email to be sebt
		$sql = "SELECT * FROM sbjbs_mails where sb_id=1" ;
		$rs_query=mysql_query($sql);
		$login_url=$sb_site_root."/signin.php";
		
		if ( $rs=mysql_fetch_array($rs_query)  )// if mail
		{
		 if($rs["sb_status"]=="yes")	
		  {
					 $from =$rs["sb_fromid"];
					 $to = $rs0["sb_email"];
					 $subject =$rs["sb_subject"];
							
	  	$body=str_replace("<email>", $rs0["sb_email"],str_replace("<password>",$rs0["sb_password"],str_replace("<lname>", $rs0["sb_lastname"],str_replace("<fname>", $rs0["sb_firstname"],str_replace("<username>", $rs0["sb_username"], $rs["sb_mail"]) )))); 
				
		$body=str_replace("<signup_url>",$sb_null_char,str_replace("<login_url>",$login_url,$body));
				
	  	$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
	 	if(isset($rs["sb_html_format"])&&($rs["sb_html_format"]=="yes"))
		{
			$header .= "\r\nMIME-Version: 1.0";
			$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
			$body=str_replace("\n","<br>",$body);
		}

  	echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
 	echo "<pre>$body</pre>";
//	die();
			if( $rs["sb_status"]=='yes')
				 mail($to,$subject,$body,$header);
		  }// end if status is on
		  }// end if mail 
		}
		echo("Location: members.php?msg=".urlencode("Member has been added"));
		die();
		}
		else
		{
			echo("Location: index.php?msg=".urlencode("Some error occurred, please try again!"));
			die();
		}
	}			//end if-errcnt==0
}			//end if count-post


function main()
{
global $errs, $errcnt;
$showform="";
$username="";
$password="";
$firstname="";
$lastname="";
$email="";
$street="";
$city="";
$state="";
$country="";
$zip_code="";
$phone="";
$phone1="";
$phone2="";
$fax="";
$fax1="";
$fax2="";
$mobile="";
$subscribe="";
$other_state="";

//IF SOME FORM WAS POSTED DO VALIDATION
if ( count($_POST)>0 )
{
$username=$_REQUEST["username"];
$firstname=$_REQUEST["firstname"];
$lastname=$_REQUEST["lastname"];
$email=$_REQUEST["email"];
$street=$_REQUEST["street"];
$city=$_REQUEST["city"];
$state=$_REQUEST["state"];
$country=$_REQUEST["country"];
$zip_code=$_REQUEST["zip_code"];
$phone=$_REQUEST["phone"];
$phone1=$_REQUEST["phone1"];
$phone2=$_REQUEST["phone2"];
$fax=$_REQUEST["fax"];
$fax1=$_REQUEST["fax1"];
$fax2=$_REQUEST["fax2"];
$mobile=$_REQUEST["mobile"];
if(isset($_REQUEST["subscribe"]))
$subscribe=$_REQUEST["subscribe"];
$other_state=$_REQUEST["other_state"];
}


if  (count($_POST)>0)
{

if ( $errcnt<>0 )
{
?>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
  <tr> 
    <td colspan="2"><strong>&nbsp;Your request cannot be processed due to following 
      reasons</strong></td>
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
	if ( (form.username.value == "")) {
       	   alert('Please Specify Username!');
		   form.username.focus();
	   return false;
	   }
	if((form.username.value.match(/[^a-zA-Z0-9_]/)))
		{
			alert("Username can contain only alphanumeric and underscore character");
			form.username.focus();
			return(false);
		}
	   
        if(form.password.value == "")
		{
	   	   alert('Please Specify Password.');
           form.password.focus();
		   return false; 
        }
		if (form.password.value != form.pwd2.value)
		{
			alert('Passwords do not match.');
			form.pwd2.value="";
			form.password.focus();
			form.password.select();
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

<form name="form1" method="post" action="addmember.php" onSubmit="return validate(this);">
  <table width="90%" border="0" align="center" cellpadding="2" cellspacing="5" class="onepxtable">
    <tr class="titlestyle"> 
      <td colspan="3">&nbsp;Add New Member</td>
    </tr>
    <tr valign="top"> 
      <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Username</strong></font></td>
      <td width="6"><font class="red">*</font></td>
      <td width="60%"> <input name="username" type="text"  value="<?php echo $username  ; ?>" size="30" maxlength="30"> 
        <br> <font class="smalltext">can not be changed Later</font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Password</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="password" type="password"  value="<?php echo $password; ?>" size="30" maxlength="30">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Retype 
        Password </strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input name="pwd2" type="password" id="pwd2"  value="<?php echo $password; ?>" size="30" maxlength="30">
        </font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle"><font class="normal"><strong>Firstname</strong></font></td>
      <td><font class="red">*</font></td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
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
      <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Fax</strong></font></td>
      <td>&nbsp;</td>
      <td> <table border="0" align="left" cellpadding="0" cellspacing="0">
          <tr> 
            <td><font class="smalltext">Country Code </font></td>
            <td><font class="smalltext">Area Code </font></td>
            <td><font class="smalltext">Number</font></td>
          </tr>
          <tr> 
            <td width="90"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="fax" type="text"  id="fax"   value="<?php echo $fax; ?>" size="5" maxlength="5" >
              </font></td>
            <td width="77"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="fax1" type="text"  id="fax1"   value="<?php echo $fax1; ?>" size="8" maxlength="8" >
              </font></td>
            <td width="148"><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="fax2" type="text"  id="fax2"   value="<?php echo $fax2; ?>" size="20" maxlength="20" >
              </font></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="top"> 
      <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Mobile</strong></font></td>
      <td>&nbsp;</td>
      <td><font face="Arial, Helvetica, sans-serif" size="2"> 
        <input type="text" name="mobile"  size="30" maxlength="30"   value="<?php echo $mobile; ?>" >
        </font></td>
    </tr>
    <tr valign="top"> 
      <td height="24" align="right" class="innertablestyle">&nbsp;</td>
      <td>&nbsp;</td>
      <td><font class='normal'> 
        <input name="subscribe" type="checkbox" id="subscribe" value="yes" <?php 
								if($subscribe == "yes")
									echo "checked"; ?>>
        Subscribe Newsletter</font></td>
    </tr>
    <tr valign="top"> 
      <td align="right" class="innertablestyle">&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="submit"  type="submit" value="Add Now"></td>
    </tr>
  </table>
  </form>
<?

}
include_once("template.php");

?>
