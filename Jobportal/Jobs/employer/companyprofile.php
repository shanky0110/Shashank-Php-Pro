<?
include_once("../myconnect.php");
include_once("logincheck.php");

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$company_cnt=$config["sb_company_cnt"];
$sb_cat_listing=$config["sb_cat_listing"];

$total_companies=mysql_num_rows(mysql_query("select * from sbjbs_companies where sb_uid=".$_SESSION["sbjbs_emp_userid"]));

if(($total_companies>=$company_cnt)&&(!isset($_REQUEST["sb_id"])||($_REQUEST["sb_id"]=="")))
{
header("Location:"."gen_confirm_mem.php?errmsg=".urlencode("You have already posted the maximum number of companies allowed."));
die();
}

function RTESafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = trim($strText);
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}
$errcnt=0;
if(count($_POST)<>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{

	$sql="Select * from sbjbs_config where 1";
	$rs0_query=mysql_query($sql);
	$rs0=mysql_fetch_array($rs0_query);
	
    $cats=$rs0["sbcomp_cat_cnt"];
	
//    $cats=$rs0["sb_profilecat_cnt"];

//	$allowed= $rs0["sb_profile"];
//	$posturl= $rs0["sb_posturl"];
	
		if(!get_magic_quotes_gpc())
		{
			$companyname=str_replace("$","\$",addslashes($_REQUEST["companyname"]));
			$logo=str_replace("$","\$",addslashes($_REQUEST["list1"]));
			$businesstype=str_replace("$","\$",addslashes($_REQUEST["businesstype"]));
			$state=str_replace("$","\$",addslashes($_REQUEST["state"]));
			$other_state=str_replace("$","\$",addslashes($_REQUEST["other_state"]));
			$sb_country=str_replace("$","\$",addslashes($_REQUEST["sb_country"]));
			$sb_industry=str_replace("$","\$",addslashes($_REQUEST["sb_industry"]));
			$sb_sales=str_replace("$","\$",addslashes($_REQUEST["sb_sales"]));
			$sb_currency=str_replace("$","\$",addslashes($_REQUEST["sb_currency"]));
			$sb_multiplier=str_replace("$","\$",addslashes($_REQUEST["sb_multiplier"]));
			$sb_no_of_emps=str_replace("$","\$",addslashes($_REQUEST["sb_no_of_emps"]));
			$sb_no_of_officies=str_replace("$","\$",addslashes($_REQUEST["sb_no_of_officies"]));
			$sb_no_of_emps=str_replace("$","\$",addslashes($_REQUEST["sb_no_of_emps"]));
			$sb_profile=str_replace("$","\$",addslashes($_REQUEST["sb_profile"]));
			$website=str_replace("$","\$",addslashes($_REQUEST["website"]));
		}
		else
		{
			$companyname=str_replace("$","\$",$_REQUEST["companyname"]);
			$logo=str_replace("$","\$",$_REQUEST["list1"]);
			$businesstype=str_replace("$","\$",$_REQUEST["businesstype"]);
			$state=str_replace("$","\$",$_REQUEST["state"]);
			$other_state=str_replace("$","\$",$_REQUEST["other_state"]);
			$sb_country=str_replace("$","\$",$_REQUEST["sb_country"]);
			$sb_industry=str_replace("$","\$",$_REQUEST["sb_industry"]);
			$sb_sales=str_replace("$","\$",$_REQUEST["sb_sales"]);
			$sb_currency=str_replace("$","\$",$_REQUEST["sb_currency"]);
			$sb_multiplier=str_replace("$","\$",$_REQUEST["sb_multiplier"]);
			$sb_no_of_emps=str_replace("$","\$",$_REQUEST["sb_no_of_emps"]);
			$sb_no_of_officies=str_replace("$","\$",$_REQUEST["sb_no_of_officies"]);
			$sb_no_of_emps=str_replace("$","\$",$_REQUEST["sb_no_of_emps"]);
			$sb_profile=str_replace("$","\$",$_REQUEST["sb_profile"]);
			$website=str_replace("$","\$",$_REQUEST["website"]);
	}
	if($state=="")
	{ $state=$other_state; }

	if(isset($_REQUEST["sb_show_profile"]) && ($_REQUEST["sb_show_profile"]=='no'))
		$sb_show_profile='no';
	else	
		$sb_show_profile='yes';
	
	$cat_name=str_replace(";",",",$_REQUEST["category"]);
	$sbcid_list=str_replace(";",",",$_REQUEST["cid1"]);
	$cat=explode(",",$sbcid_list);

	if ( strlen(trim($companyname)) == 0 )
	{
		$errs[$errcnt]="Company Name must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[;<>&]/", $_REQUEST["companyname"]))
	{
		$errs[$errcnt]="Company Name can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}

	if ( $_REQUEST["businesstype"]=="" )
	{
		$errs[$errcnt]="Business Type must be choosen";
		$errcnt++;
	}
	
	if ( $_REQUEST["cid1"]=="")
	{
		$errs[$errcnt]="Category(ies) must be provided";
		$errcnt++;
	}
	
	if ( count($cat)>$cats)
	{
		$errs[$errcnt]="You are not allowed to choose more than $cats category(ies).";
		$errcnt++;
	}

	if ( strlen(trim($state)) == 0 )
	{
		$errs[$errcnt]="State must be provided";
		$errcnt++;
	}

	if ( strlen(trim($sb_country)) == 0 )
	{
		$errs[$errcnt]="Country must be provided";
		$errcnt++;
	}

	if ( $_REQUEST["sb_industry"]=="" )
	{
		$errs[$errcnt]="Industry must be choosen";
		$errcnt++;
	}
	if ( $_REQUEST["sb_sales"]=="" )
	{
		$errs[$errcnt]="Sales Turnover must be choosen";
		$errcnt++;
	}
	if ( $_REQUEST["sb_currency"]=="" )
	{
		$errs[$errcnt]="Currency in Sales Turnover must be choosen";
		$errcnt++;
	}
	if ( $_REQUEST["sb_multiplier"]=="" )
	{
		$errs[$errcnt]="Multiplier in Sales Turnover must be choosen";
		$errcnt++;
	}
	if ( $_REQUEST["sb_no_of_emps"]=="" )
	{
		$errs[$errcnt]="Number of Employees must be choosen";
		$errcnt++;
	}
	if ( $_REQUEST["sb_no_of_officies"]=="" )
	{
		$errs[$errcnt]="Number of Officies must be choosen";
		$errcnt++;
	}

	if ( strlen(trim($sb_profile)) == 0 )
	{
		$errs[$errcnt]="Company Profile must be provided";
		$errcnt++;
	}
	/*elseif(preg_match ("/[;<>&]/", $_REQUEST["companyprofile"]))
	{
		$errs[$errcnt]="Company Profile can not have any special character (e.g. & ; < >)";
   		$errcnt++;
	}*/
	

if($errcnt==0)
{
	$approved="yes";
	$sb_msg='Company Profile has been updated.';
	$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	if($config["sb_profile_approval"]=="admin")
	{
		$approved="no";
		$sb_msg='Company Profile has been sent for admin approval.';
	}
	
	if($_POST["sb_id"]==0)
	{
		if($approved=="no")
		{ $approved="new";}
	
		$sbuserid=$_SESSION["sbjbs_emp_userid"];
		$sbcurrent=date("YmdHis",time());
		$insert_query="insert into sbjbs_companies (sb_name,sb_logo,sb_type, sb_location, sb_country,  sb_industry, sb_sales, sb_currency, sb_multiplier, sb_no_of_emps, sb_no_of_officies, sb_profile, sb_website, sb_uid, sb_approved, sb_viewed, sb_posted_on, sb_show_profile) values ('$companyname','$logo', $businesstype,'$state', $sb_country, '$sb_industry' , '$sb_sales', $sb_currency, '$sb_multiplier', '$sb_no_of_emps', '$sb_no_of_officies', '$sb_profile', '$website', $sbuserid, '$approved', 0, $sbcurrent, '$sb_show_profile')";
//	die($insert_query);
		mysql_query($insert_query);
		if(mysql_affected_rows()>0)
		{	//success
			$sbq_job="select max(sb_id) as max_id from sbjbs_companies where 1";
			$sbrow_job=mysql_fetch_array(mysql_query($sbq_job));
			$max_id=$sbrow_job["max_id"];
			
//////////--------adding to categories
			foreach($cat as $key => $value) 
			{
				$sbqi_cat="insert into sbjbs_profile_cats (sb_cid, sb_company_id) values ($value, $max_id)";
				mysql_query($sbqi_cat);
			}
		
			
			if($approved=="yes")
			{
				$sb_msg='Company Profile has been created';
				header ("Location: gen_confirm_mem.php?sb_type=3&id=$sb_offer_id&errmsg=".urlencode($sb_msg));
			}
			else
			{
				$sb_msg='Company Profile has been created and sent for admin approval.';
			//////////////------------------mail to admin
		$sbq_com="select max(sb_id) as new_id from sbjbs_companies where 1";
		//die($sbq_com);
		$sbrow_com=mysql_fetch_array(mysql_query($sbq_com));
		$new_id=$sbrow_com["new_id"];
		
		$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
		$sb_null_char=$sbrow_con["sb_null_char"];
		$sb_site_root=$sbrow_con["sb_site_root"];
//		$sb_comp_url=$sbrow_con["sb_site_root"]."/view_profile.php?id=$new_id";

		$sb_admin_email=$sbrow_con["sb_admin_email"];	
		//Reads email to be sebt
			$sql = "SELECT * FROM sbjbs_mails where sb_mailid=2" ;
			$rs_query=mysql_query($sql);
	//		$login_url=$sb_site_root."/employer/signin.php";
		
			if ( $rs=mysql_fetch_array($rs_query)  )// if mail
			{
			 	if($rs["sb_status"]=="yes")	
			  	{
					$from =$rs["sb_fromid"];
					$to = $sb_admin_email;
					$subject =$rs["sb_subject"];
									
					$body=str_replace("%title%", $sb_null_char,str_replace("%email%", $sb_null_char,str_replace("%password%",$sb_null_char,str_replace("%lname%", $sb_null_char,str_replace("%fname%", $sb_null_char,str_replace("%username%", $sb_null_char, $rs["sb_mail"]) ))))); 
					
					$body=str_replace("%signup_url%",$sb_null_char,str_replace("%login_url%",$sb_null_char,$body));
					
					$body=str_replace("%company_profile_url%",$sb_null_char,str_replace("%company_name%",$companyname,str_replace("%company_id%",$new_id,$body)));
	
					$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
					if(isset($rs["sb_html_format"])&&($rs["sb_html_format"]=="yes"))
					{
						$header .= "\r\nMIME-Version: 1.0";
						$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
						//$body=str_replace("\n","%br>",$body);
					}
	
	//				echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
	//				echo "<pre>$body</pre>";
				//	die();
					 mail($to,$subject,$body,$header);
				}// end if status is on
			}// end if mail 
///////////-------------------end mail to admin			
				header("Location: gen_confirm_mem.php?errmsg=".urlencode($sb_msg));

			}
			die();
		}
		else
		{	//failed
			header("Location: gen_confirm_mem.php?err=companyprofile&errmsg=".urlencode("Sorry, no updations carried out."));
			die();
		}	
	}		// end if _POST["profile_id"]==0 i.e. insert record
	else
	{		// update record i.e. profile exists
		$sb_sendmail=false;
		$approved="yes";
		$sb_msg='Company Profile has been updated.';
		$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
		if($config["sb_profile_approval"]=="admin")
		{
			$sb_sendmail=true;
			$approved="no";
			$sb_msg='Updated Company Profile has been sent for admin approval.';
			$update_query="update sbjbs_companies set 
			sb_name='$companyname',
			sb_logo='$logo',
			sb_type='$businesstype',
			sb_location='$state',
			sb_country=$sb_country,
			sb_industry='$sb_industry',
			sb_sales='$sb_sales',
			sb_currency=$sb_currency,
			sb_multiplier='$sb_multiplier',
			sb_no_of_emps='$sb_no_of_emps',
			sb_no_of_officies='$sb_no_of_officies',
			sb_profile='$sb_profile',
			sb_website='$website',
			sb_approved='$approved', 
			sb_show_profile='$sb_show_profile'
			where sb_id=".$_REQUEST["sb_id"];
		}
		else
		{	//keep the current approval intact
			$update_query="update sbjbs_companies set 
			sb_name='$companyname',
			sb_logo='$logo',
			sb_type='$businesstype',
			sb_location='$state',
			sb_country=$sb_country,
			sb_industry='$sb_industry',
			sb_sales='$sb_sales',
			sb_currency=$sb_currency,
			sb_multiplier='$sb_multiplier',
			sb_no_of_emps='$sb_no_of_emps',
			sb_no_of_officies='$sb_no_of_officies',
			sb_profile='$sb_profile',
			sb_website='$website',
			sb_show_profile='$sb_show_profile'
			where sb_id=".$_REQUEST["sb_id"];
		}
		
	//	die($update_query);
		mysql_query($update_query);

//		if(mysql_affected_rows()>0)
		{
///--------adding to categories
	//		$sbq3_com="select * from sbjbs_companies where sb_uid=".$_SESSION["sbjbs_emp_userid"];
	//		$sbrow3_com=mysql_fetch_array(mysql_query($sbq3_com));
	//		$sb_id=$sbrow3_com['sb_id'];
			
			$sb_id=$_REQUEST["sb_id"];
			$sbqu_cat="delete from sbjbs_profile_cats where sb_company_id=$sb_id";
			mysql_query($sbqu_cat);
			foreach($cat as $key => $value) 
			{
				$sbqi_cat="insert into sbjbs_profile_cats (sb_cid, sb_company_id) values ($value, $sb_id)";
				mysql_query($sbqi_cat);
			}		
		
			if($sb_sendmail)
			{	//---------send mail to adm---------------------------------------------- 
		$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
		$sb_null_char=$sbrow_con["sb_null_char"];
		$sb_site_root=$sbrow_con["sb_site_root"];
//		$sb_comp_url=$sbrow_con["sb_site_root"]."/view_profile.php?id=".$_POST["profile_id"];
		$sb_admin_email=$sbrow_con["sb_admin_email"];	

		//Reads email to be sebt
			$sql = "SELECT * FROM sbjbs_mails where sb_mailid=3" ;
			$rs_query=mysql_query($sql);
	//		$login_url=$sb_site_root."/employer/signin.php";
		
			if ( $rs=mysql_fetch_array($rs_query)  )// if mail
			{
			 	if($rs["sb_status"]=="yes")	
			  	{
					$from =$rs["sb_fromid"];
					$to = $sb_admin_email;
					$subject =$rs["sb_subject"];
									
					$body=str_replace("%title%", $sb_null_char,str_replace("%email%", $sb_null_char,str_replace("%password%",$sb_null_char,str_replace("%lname%", $sb_null_char,str_replace("%fname%", $sb_null_char,str_replace("%username%", $sb_null_char, $rs["sb_mail"]) ))))); 
					
					$body=str_replace("%signup_url%",$sb_null_char,str_replace("%login_url%",$sb_null_char,$body));
					
					$body=str_replace("%company_profile_url%",$sb_null_char,str_replace("%company_name%",$companyname,str_replace("%company_id%",$_POST["profile_id"],$body)));
	
					$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
					if(isset($rs["sb_html_format"])&&($rs["sb_html_format"]=="yes"))
					{
						$header .= "\r\nMIME-Version: 1.0";
						$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
						//$body=str_replace("\n","<br>",$body);
					}
	
//					echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
//					echo "<pre>$body</pre>";
				//	die();
					 mail($to,$subject,$body,$header);
				}// end if status is on
			}// end if mail 
///////////-------------------end mail to admin			
				
			}	//end if sb_sendmail
		
			if($approved=="yes")
			{
				header("Location: gen_confirm_mem.php?sb_type=3&id=$sb_offer_id&errmsg=".urlencode($sb_msg));
			}
			else
			{	////admin 
				header ("Location: gen_confirm_mem.php?errmsg=".urlencode($sb_msg));
			}
			die();
		}
		header("Location: gen_confirm_mem.php?err=companyprofile&errmsg=".urlencode("Sorry, no updations carried out."));
		die();
		}
	}// end if no errs
}//if form posted
function main()
{
	global $errs, $errcnt, $sb_cat_listing;

	$sql="Select * from sbjbs_config where 1";
	$rs0_query=mysql_query($sql);
	$rs0=mysql_fetch_array($rs0_query);
	
    $cats=$rs0["sbcomp_cat_cnt"];
	$allowed='yes';


?>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<script language="JavaScript">
<!--

					function add_category()
					{
					if(document.form123.cats.value!=0)
					{
					var id=document.form123.cats.selectedIndex;
					
					var cid_list=form123.cid1.value.split(";");
					var cnt=0;
					var posted="no";
					while(cnt<cid_list.length)
					{
						if(cid_list[cnt]==document.form123.cats.value)
						{ posted="yes";}
						cnt++;
						}
						if(posted=="yes")
						{
						alert('This category is already in the list');
						return false;
					}


//////-------checking max no. of categories
				var sblength;
				if(document.form123.category.value == "")
					sblength=0;
				else
					sblength=cid_list.length
				if( sblength >= <?php echo $cats; ?> )
				{
					alert("You can't choose more than <?php echo ($cats==1)?$cats.' category':$cats.' categories'; ?>");
					return false;
				}
//////-------checking max no. of categories

					if(document.form123.category.value=="")
					{
					document.form123.cid1.value=document.form123.cats.value;
					document.form123.category.value=document.form123.cats.options[id].text;
					document.form123.category.focus();
					document.form123.cats.selectedIndex=0;
					}
					else
					{
					document.form123.cid1.value=document.form123.cid1.value+";"+document.form123.cats.value;
					document.form123.category.value=document.form123.category.value+";"+document.form123.cats.options[id].text;
					document.form123.category.focus();
					document.form123.cats.selectedIndex=0;
					}
					}
					else
					{
					alert('Choose a Category to add!');
					}
					}
					function remove_category()
					{
					var s1=window.document.form123.category.value;
					var s2=s1.split(";");
					var i=0;
					var id=document.form123.cats.selectedIndex;
					var s3=document.form123.cats.options[id].text;
					
					var id_list=document.form123.cid1.value;
					var id_split=id_list.split(";");
					var rem_id=document.form123.cats.value;
										
					window.document.form123.category.value="";
					window.document.form123.cid1.value="";
					
					while(i<s2.length)
					{
					//alert('Checking '+s2[i]+' nnn  with'+s3+' mm');
						if(s3==s2[i])
						{
						//continue;
						//	alert('Removing'+s3);
						}
						else
						{
							if(document.form123.category.value=="")
							{
							document.form123.category.value=s2[i];
							}
							else
							{
							document.form123.category.value=document.form123.category.value+";"+s2[i];
							}
						
						}
						if(rem_id==id_split[i])
						{
						//continue;
						//	alert('Removing'+s3);
						}
						else
						{
							if(document.form123.cid1.value=="")
							{
							document.form123.cid1.value=id_split[i];
							}
							else
							{
							document.form123.cid1.value=document.form123.cid1.value+";"+id_split[i];
							}
						
						}
					i++;
					}
					//window.document.form123.related.value="";
					//window.document.form123.rel_id.value="";
					}

function attachment(box)
{
	str="fileupload.php?box="  + box;
	sbwin=window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
	sbwin.focus();
}

/*function category(box)
{
str="choosecategory.php?box="  + box;

window.open(str,"Category","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
}
*/


function removeattachment(box)
{
window.document.form123.list1.value=""
}

function validate(form)
{
	updateRTEs();
	if ( form.companyname.value == "" ) {
       	   alert('Please specify Company Name!');
		   form.companyname.focus();
	   return false;
	   }
	if(form.companyname.value.match(/[&<>]+/))
		{
			alert("Please remove invalid characters from Company Name (e.g. &  < >)");
			form.companyname.focus();
			form.companyname.select();
			return(false);
		}
	if ( form.businesstype.value == "" ) {
       	   alert('Please choose a Business Type!');
		   form.businesstype.focus();
	   return false;
	   }
	if ( form.cid1.value == "" ) {
   	   alert('Please choose Category!');
	   form.cats.focus();
	   return false;
	   }
	if ( (form.state.selectedIndex == 0 ) && (form.other_state.value == "") ) {
       	   alert('Please specify State!');
		   form.state.focus();
	   return false;
	   }
		if(form.other_state.value.match(/[&<>]+/))
		{
			alert("Please remove invalid characters from State (e.g. &  < >)");
			form.other_state.focus();
			form.other_state.select();
			return(false);
		}
	if ( (form.sb_country.selectedIndex == 0 ) ) 
	{
       alert('Please choose Country!');
	   form.sb_country.focus();
	   return false;
	}
/*	if(form.state.selectedIndex != 0 && form.sb_country.selectedIndex != 211)
	{
		alert("Please choose correct state/country combination");
		form.sb_country.focus();
		return false;
	}
*/
	if ( form.sb_industry.selectedIndex== 0) {
       	   alert('Please choose Industry!');
		   form.sb_industry.focus();
	   return false;
	   }
	if ( form.sb_sales.selectedIndex == 0 ) {
   	   alert('Please choose Sales Turnover!');
	   form.sb_sales.focus();
	   return false;
	   }
	if ( form.sb_currency.selectedIndex == 0 ) {
       	   alert("Please choose Currency for Sales Turnover!");
		   form.sb_currency.focus();
	   return false;
	   }
	if ( form.sb_multiplier.selectedIndex == 0 ) {
       	   alert("Please choose Multiplier for Sales Turnover!");
		   form.sb_multiplier.focus();
	   return false;
	   }
	if ( form.sb_no_of_emps.selectedIndex == 0 ) {
       	   alert("Please choose Number of Employees!");
		   form.sb_no_of_emps.focus();
	   return false;
	   }
	if ( form.sb_no_of_officies.selectedIndex == 0 ) {
       	   alert("Please choose Number of Officies!");
		   form.sb_no_of_officies.focus();
	   return false;
	   }
	if ( form.sb_profile.value == "" ) {
       	   alert("Please specify Company Profile!");
		   //form.sb_profile.focus();
	   return false;
	   }
	return true;

}
/*
function choose_country()
{
	if(document.form123.state.selectedIndex != 0)
		document.form123.sb_country.selectedIndex=211;
	else
		document.form123.sb_country.selectedIndex=0;
	return;
}
*/
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td> 
      <?

$profile_id=0;
if(isset($_REQUEST["sb_id"])&&($_REQUEST["sb_id"]<>""))
{
$profile_id=$_REQUEST["sb_id"];
}
if($profile_id<>0)
{
	$rs=mysql_query("Select * from sbjbs_companies where sb_id=$profile_id && sb_uid =" . $_SESSION["sbjbs_emp_userid"] );
	$profile=mysql_fetch_array($rs);
	if($profile)
	{
	$profile_id=$profile["sb_id"];
	$companyname=$profile["sb_name"];
	$sb_country=$profile["sb_country"];
	$logo=$profile["sb_logo"];
	$businesstype=$profile["sb_type"];
	$state=$profile["sb_location"];
	$other_state=$state;
	
	$sb_industry=$profile["sb_industry"];
	$sb_sales=$profile["sb_sales"];
	$sb_currency=$profile["sb_currency"];
	$sb_multiplier=$profile["sb_multiplier"];
	$sb_no_of_emps=$profile["sb_no_of_emps"];
	$sb_no_of_officies=$profile["sb_no_of_officies"];
	$sb_profile=$profile["sb_profile"];
	$website=$profile["sb_website"];
	$sb_show_profile=$profile["sb_show_profile"];
	//$sbtemp_cid=$profile["sb_cid"];
	$cat_list="";
	$cid_list="";
	
	///---getting cats
		$sbq_off_cat="select * from sbjbs_profile_cats where sb_company_id=$profile_id";
		$sbrs_off_cat=mysql_query($sbq_off_cat);
	
	$cat_list="";
	$cid_list="";
	while($sbrow_off_cat=mysql_fetch_array($sbrs_off_cat))
	{
	//	$cat_id=$rs["cat".$i];
		$rs_t=mysql_query("Select * from sbjbs_categories  where sb_id =".$sbrow_off_cat["sb_cid"]);
		if ($rs_t=mysql_fetch_array($rs_t))
		{
			  $cat_path=$rs_t["sb_cat_name"];
			  $par=mysql_query("select * from sbjbs_categories where sb_id=".$rs_t["sb_pid"]);
			  while($parent=mysql_fetch_array($par))
			  {
				$cat_path=$parent["sb_cat_name"]."-".$cat_path;
				$par=mysql_query("select * from sbjbs_categories where sb_id=".$parent["sb_pid"]);
				}
			if($cat_list=="")
			{
	
			$cat_list=$cat_path;
			$cid_list=$rs_t["sb_id"];
			}
			else
			{
			$cat_list.=";".$cat_path;
			$cid_list.=";".$rs_t["sb_id"];
			}
		}
	}
	
	}
	else
	{
		echo "<p>&nbsp;</p><p>&nbsp;</p><br><br><br><div align='center'><font class='normal'>Invalid Access. Click <a href='emp_home.php' >here</a> to continue</font></div><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
		return;
	}
}
else
{
$sb_profile='';
$state='';
$other_state='';
$sb_country='';
$sb_no_of_officies='';
$sb_no_of_emps='';
$sb_sales='';
$sb_currency='';
$sb_multiplier='';
$sb_industry='';
$cid_list="";
$companyname="";
$logo="";
$businesstype="";
$services="";
$yearestablished="";
$markets="";
$othermarkets="";
$productfocus="";
$employees="";
$ceo="";
$website="";
$cat_list="";

$phone="";
$phone1="";
$phone2="";

$fax="";
$fax1="";
$fax2="";
$sb_show_profile='';
}
//IF SOME FORM WAS POSTED DO VALIDATION
if ( count($_POST)<>0 )
{

			$companyname=$_REQUEST["companyname"];
			$logo=$_REQUEST["list1"];
			$businesstype=$_REQUEST["businesstype"];
			$state=$_REQUEST["state"];
			$sb_country=$_REQUEST['sb_country'];
			$other_state=$_REQUEST["other_state"];
			$sb_industry=$_REQUEST["sb_industry"];
			$sb_sales=$_REQUEST["sb_sales"];
			$sb_currency=$_REQUEST["sb_currency"];
			$sb_multiplier=$_REQUEST["sb_multiplier"];
			$sb_no_of_emps=$_REQUEST["sb_no_of_emps"];
			$sb_no_of_officies=$_REQUEST["sb_no_of_officies"];
			$sb_no_of_emps=$_REQUEST["sb_no_of_emps"];
			$sb_profile=$_REQUEST["sb_profile"];
			$website=$_REQUEST["website"];
			if(isset($_REQUEST["sb_show_profile"]))
			$sb_show_profile=$_REQUEST["sb_show_profile"];

$cid_list=$_REQUEST["cid1"];
$cat_list=$_REQUEST["category"];

}

if  (count($_POST)>0)
{
if ( $errcnt<>0 )
{

?>
      <table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="errorstyle">
        <tr> 
          <td colspan="2"><strong>&nbsp;Your request cannot be processed due to 
            following reasons</strong></td>
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
?><form name="form123" method="post" action="companyprofile.php" onSubmit="return validate(this);">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
                <tr class="titlestyle"> 
                  <td>&nbsp;Company Profile</td>
                </tr>
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="5" >
                <tr valign="top"> 
                  <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Company 
                    Name </strong></font></td>
                  <td width="6"><font class="red">*</font></td>
                  <td width="60%"><font class="normal"> 
                    <input name="companyname" type="text" value="<?php echo $companyname ; ?>">
                    <input name="sb_id" type="hidden" id="sb_id" value="<? echo $profile_id;?>">
                    </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Company 
                    Logo </strong></font></td>
                  <td>&nbsp;</td>
                  <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                    <input name = "list1" type = "text" id="list1" value="<?php echo $logo; ?>" size="20" readOnly >
                    <input type=BUTTON name=btn_name2 value="Upload" onClick=attachment('list1')>
                    <input type=BUTTON name=buttonname2 value="Remove" onClick=removeattachment()>
                    </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font><font class="normal">&nbsp; 
                    </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Business 
                    Type </strong></font></td>
                  <td><font class="red">*</font></td>
                  <td><font class="normal"> 
                    <select name="businesstype">
                      <option value="">Please Select</option>
                      <?
				$rs_query=mysql_query("Select * from sbjbs_businesstypes where 1" );
	while ($rs=mysql_fetch_array($rs_query))
	{
				?>
                      <option value="<?php echo $rs["sb_id"]; ?>"
				<?php
				if ( $rs["sb_id"]==$businesstype )
				{
				echo "  selected ";
				}
				?>
				
				><?php echo $rs["sb_businesstype"]; ?></option>
                      <?
			  }
			  ?>
                    </select>
                    &nbsp; </font><font class="normal">&nbsp; </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Category<br>
                    </strong></font><font class="smalltext">(max <? echo "<b>".$cats."</b>";
			  echo ($cats>1)?" categories":' category'; ?>)</font></td>
                  <td><font class="red">*</font></td>
                  <td><font class="normal"> 
                    <?
						 						 
                            ?>
                    <textarea name="category" cols="37" rows="5" readonly="readonly" id="textarea"><? echo $cat_list;?></textarea>
                    <br>
                    <font class="normal"> 
                    <select name="cats" id="select" >
                      <option value="0">Choose a category</option>
                      <?
	$sbcat_arr=array();
	$sbord_arr=array();
	$rs_query=mysql_query("select * from sbjbs_categories");
	while($rst=mysql_fetch_array($rs_query))
	{
		$cat_path="";
		$child=mysql_fetch_array(mysql_query("select * from sbjbs_categories where sb_pid=".$rst["sb_id"]));
		if($child)
			continue;
		$cat_path.=$rst["sb_cat_name"];
		$par=mysql_query("select * from sbjbs_categories where sb_id=".$rst["sb_pid"]);
		while($parent=mysql_fetch_array($par))
		{
			$cat_path=$parent["sb_cat_name"]."-".$cat_path;
			$par=mysql_query("select * from sbjbs_categories where sb_id=".$parent["sb_pid"]);
		}
		$sbcat_arr[$rst["sb_id"]]=$cat_path;
		$sbord_arr[$rst["sb_id"]]=$rst["sb_order_index"];
	}
	if($sb_cat_listing=='admin')
	{
		asort($sbord_arr);
		foreach($sbord_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbcat_arr[$sbkey].'</option>';
		}
	}
	else
	{
		asort($sbcat_arr);
		foreach($sbcat_arr as $sbkey => $sbval)
		{
			echo '<option value="'.$sbkey.'"';
		//	echo($sbkey==$cid)?'selected':'';
			echo ' >'.$sbval.'</option>';
		}
	}					  
									  ?>
                    </select>
                    </font> 
                    <input name="cid1" type="hidden" id="cid1" value="<? echo $cid_list;?>">
                    <input name="add" type="button" id="add2" value="Add" onClick="add_category()">
                    <input name="Remove" type="button" id="Remove2" value="Remove" onClick="remove_category()">
                    &nbsp; </font><font class="normal">&nbsp; </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>State</strong></font></td>
                  <td><font class="red">*</font></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><font class='normal'>US</font></td>
                        <td> <select name="state" id="state" >
                            <option value="" selected >Select State</option>
                            <? 
						  $state1=mysql_query("select * from sbjbs_us_states order by sb_state");
						  while($rst= mysql_fetch_array($state1))
						  {
						  ?>
                            <option value="<? echo $rst["sb_state"];?>" <? if($rst["sb_state"]==$state) {echo " selected ";}?>><? echo $rst["sb_state"];?></option>
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
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Country</strong></font></td>
                  <td><font class="red">*</font></td>
                  <td><font face="Arial, Helvetica, sans-serif" size="2"><strong><font color="#004566"> 
                    <select name="sb_country" id="sb_country" >
                      <option selected value="">Select Country</option>
                      <?
$rs_t_query=mysql_query ("select * from sbjbs_country order by country");
while ($rs_t=mysql_fetch_array($rs_t_query))    
{
?>
                      <option  value="<? echo $rs_t["id"]  ?>"
		  <?php
				if ($sb_country== $rs_t["id"] ) 
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
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Industry</strong></font></td>
                  <td><font class="red">*</font></td>
                  <td><select name="sb_industry" id="sb_industry">
                      <option value="">Please Select</option>
                      <?
				$rs_query=mysql_query("Select * from sbjbs_industries" );
	while ($rs=mysql_fetch_array($rs_query))
	{
				?>
                      <option value="<?php echo $rs["sb_id"]; ?>"
				<?php
				if ( $rs["sb_id"]==$sb_industry)
				{
				echo "  selected ";
				}
				?>
				
				><?php echo $rs["sb_name"]; ?></option>
                      <?
			  }
			  ?>
                    </select></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Sales 
                    Turnover </strong></font></td>
                  <td><font class="red">*</font></td>
                  <td> <select name="sb_sales">
                      <option value="">Select Turnover</option>
                      <option value="1" <?php echo ($sb_sales=="1")?'selected':''; ?>>Less 
                      than 1</option>
                      <option value="1-10" <?php echo ($sb_sales=="1-10")?'selected':''; ?>>1 
                      - 10</option>
                      <option value="10-100" <?php echo ($sb_sales=="10-100")?'selected':''; ?>>10 
                      - 100</option>
                      <option value="100-500" <?php echo ($sb_sales=="100-500")?'selected':''; ?>>100 
                      - 500</option>
                      <option value="500+" <?php echo ($sb_sales=="500+")?'selected':''; ?>>500+</option>
                    </select> &nbsp; <select name="sb_currency">
                      <option value="">Select Currency</option>
                      <?php 	$sbq_cur="select * from sbjbs_currencies where 1";
					$sbrs_cur=mysql_query($sbq_cur);
					while($sbrow_cur=mysql_fetch_array($sbrs_cur))
					{
						echo '<option value="'.$sbrow_cur['sbcur_id'].'"';
						echo ($sbrow_cur['sbcur_id']==$sb_currency)?'selected':'';
						echo '>'.$sbrow_cur['sbcur_name'].'</option>';
					}
					
			?>
                    </select> &nbsp; <select name="sb_multiplier">
                      <option value="">Select Multiplier</option>
                      <option value="million" <?php echo ($sb_multiplier=="million")?'selected':''; ?>>Million</option>
                      <option value="billion" <?php echo ($sb_multiplier=="billion")?'selected':''; ?>>Billion</option>
                    </select></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Number 
                    of Employees</strong></font></td>
                  <td><font class="red">*</font></td>
                  <td><SELECT name="sb_no_of_emps">
                      <option value="">Select Employees</option>
                      <option value="Less than 10 People" <?php echo ($sb_no_of_emps=="Less than 10 People")?'selected':''; ?>>Less 
                      than 10 People</option>
                      <option value="10-25 People" <?php echo ($sb_no_of_emps=="10-25 People")?'selected':''; ?>>10-25 
                      People</option>
                      <option value="25-100 People" <?php echo ($sb_no_of_emps=="25-100 People")?'selected':''; ?>>25-100 
                      People</option>
                      <option value="100-500 People" <?php echo ($sb_no_of_emps=="100-500 People")?'selected':''; ?>>100-500 
                      People</option>
                      <option value="500 People" <?php echo ($sb_no_of_emps=="500 People")?'selected':''; ?>>500+ 
                      People</option>
                    </SELECT></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Number 
                    of Offices</strong></font></td>
                  <td><font class="red">*</font></td>
                  <td> <SELECT name="sb_no_of_officies">
                      <option value="">Select Offices</option>
                      <option value="1" <?php echo ($sb_no_of_officies=="1")?'selected':''; ?>>1</option>
                      <option value="1-5" <?php echo ($sb_no_of_officies=="1-5")?'selected':''; ?>>1-5</option>
                      <option value="5-10" <?php echo ($sb_no_of_officies=="5-10")?'selected':''; ?>>5-10</option>
                      <option value="10+" <?php echo ($sb_no_of_officies=="10+")?'selected':''; ?>>10+</option>
                    </SELECT> </td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Company 
                    Profile</strong></font></td>
                  <td><font class="red">*</font></td>
                  <TD valign="middle"> <font class='normal'> 
                    <script language="JavaScript" type="text/javascript">
<!--

<?
$content = $sb_profile;
$content = RTESafe($content);
?>//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("../images/", "", "");

//Usage: writeRichText(fieldname, html, width, height, buttons)
writeRichText('sb_profile', '<?=$content?>', 450, 200, true, false);

//uncomment the following to see a demo of multiple RTEs on one page
//document.writeln('<br><br>');
//writeRichText('rte2', 'read-only text', 450, 100, true, false);
//-->
/*document.write("<br><font class='smalltext'>Description length must not exceed <?php echo $sbrow_con['sb_description_length'];?> characters</font>");*/
</script>
                    </font> <noscript>
                    <p><font class="normal"><b>Javascript must be enabled to use 
                      this form.</b></font></p>
                    </noscript></TD>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Homepage</strong></font></td>
                  <td>&nbsp;</td>
                  <td><font class='normal'>http:// 
                    <input name="website" type="text" id="website" value="<?php echo $website;  ?>">
                    &nbsp; </font><font class="normal">&nbsp; </font></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle"><font class="normal"><strong>Hide 
                    Profile </strong></font></td>
                  <td>&nbsp;</td>
                  <td><input name="sb_show_profile" type="checkbox" id="sb_show_profile" value="no" <?php echo ($sb_show_profile=='no')?'checked':'';?>></td>
                </tr>
                <tr valign="top"> 
                  <td align="right" class="innertablestyle">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><table width="340" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr> 
                        <td width="143"> <input type="reset" name="Reset" value="Revert Changes"> 
                        </td>
                        <td width="197"> <input type="submit" name="Submit2" value="Post / Edit Profile"> 
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <p align="center">&nbsp;</p>
        </form>
</td>
  </tr>
</table>
<?

}  //End of main
include_once("template.php");
?>


