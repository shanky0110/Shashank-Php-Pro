<?php
include_once("logincheck.php");
include_once("../myconnect.php");
$showform="";

	if(!isset($_REQUEST["sb_id"]) || !is_numeric($_REQUEST["sb_id"]) || ($_REQUEST["sb_id"] < 1))
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Invalid Id, cannot proceed."));
		die();
	}
	$sb_id=$_REQUEST["sb_id"];

//////---------------checking whether company exists----------
/*
	$sbq_com="select * from sbjbs_companies where sb_uid=".$_SESSION["sbjbs_emp_userid"];
//	die($sbq_com); 
	$sbrow_com=mysql_fetch_array(mysql_query($sbq_com));
	if(!$sbrow_com)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("You cannot post a job before creating company profile!"));
		die();
	}
*/
///////////--------------------------------------------------

///////------------getting money in account-------/////////

$sbq_tra="select sum(sb_amount) as sb_total_balance from sbjbs_transactions where sb_uid=".$_SESSION["sbjbs_emp_userid"];
$sbrow_tra=mysql_fetch_array(mysql_query($sbq_tra));
if(!$sbrow_tra)
{
	$sb_total_balance=0;
}
else
{
	$sb_total_balance=$sbrow_tra["sb_total_balance"];
}

//////////////--------end of getting money---------------////

$sbq_con="select * from sbjbs_config where sb_id=1";
$sbrow_con=mysql_fetch_array(mysql_query($sbq_con));
$sb_cat_listing=$sbrow_con["sb_cat_listing"];

//$sbq_cur="select * from sbjbs_currencies where sbcur_id=".$sbrow_con['sb_fee_currency'];
//$sbrow_cur=mysql_fetch_array(mysql_query($sbq_cur));

$sb_fee_currency=$sbrow_con['sb_fee_symbol'];
$sb_fee_currency_name=$sbrow_con['sb_fee_code'];
$sb_total_cost=$sbrow_con["sb_job_fee"];		//used later

/////////--------checking whether enough balances for posting		
/*
if( ($sbrow_con["sb_job_fee"] > 0) && ($sbrow_con["sb_job_fee"] > $sb_total_balance) )
{
	header("Location: gen_confirm_mem.php?errmsg=".urlencode("You cannot post job due to lack of funds, please add some money first!"));
	die();
}
*/
/////////-end ---checking whether enough balances for posting		

$errcnt=0;
if(count($_POST)>0)		//IF SOME FORM WAS POSTED DO VALIDATION
{
///////getting into variables for returning back to counter any type of error after initializing////////
	$sbcomp_id='';

	$sb_title='';
	$sb_role='';
	$sb_vacancies='';
	$sb_experience='-1';
	$sb_education='';
	$skl_list='';
	$skl_id_list='';
	$sb_min_salary='';
	$sb_max_salary='';
	$sb_currency='';
	$sb_salary_type='';
	$sb_career_level='';
	$job_type=0;
	$job_status=0;
	$sb_description='';
	$sb_show_profile='no';

	$cat_list='';
	$cid_list='';
	$loc_list='';
	$loc_id_list='';


//	$sb_front_featured='no';
//	$sb_featured='no';
//	$sb_highlight='no';
//	$sb_bold='no';
	
	if(isset($_REQUEST["sbcomp_id"]))
		$sbcomp_id=$_REQUEST["sbcomp_id"];

	if(isset($_REQUEST["sb_title"]))
		$sb_title=$_REQUEST["sb_title"];
	if(isset($_REQUEST["sb_role"]))
		$sb_role=$_REQUEST["sb_role"];
	if(isset($_REQUEST["sb_vacancies"]))
		$sb_vacancies=$_REQUEST["sb_vacancies"];
	if(isset($_REQUEST["sb_experience"]))
		$sb_experience=$_REQUEST["sb_experience"];
	if(isset($_REQUEST["sb_education"]))
		$sb_education=$_REQUEST["sb_education"];
	if(isset($_REQUEST["skill"]))
		$skl_list=$_REQUEST["skill"];
	if(isset($_REQUEST["skl_id"]))
		$skl_id_list=$_REQUEST["skl_id"];
	if(isset($_REQUEST["sb_min_salary"]))
		$sb_min_salary=$_REQUEST["sb_min_salary"];
	if(isset($_REQUEST["sb_max_salary"]))
		$sb_max_salary=$_REQUEST["sb_max_salary"];
	if(isset($_REQUEST["sb_currency"]))
		$sb_currency=$_REQUEST["sb_currency"];
	if(isset($_REQUEST["sb_salary_type"]))
		$sb_salary_type=$_REQUEST["sb_salary_type"];
	if(isset($_REQUEST["sb_permanent"]))
		$sb_permanent=$_REQUEST["sb_permanent"];
	if(isset($_REQUEST["sb_career_level"]))
		$sb_career_level=$_REQUEST["sb_career_level"];
	if(isset($_REQUEST["sb_description"]))
		$sb_description=$_REQUEST["sb_description"];
	if(isset($_REQUEST["sb_show_profile"]))
		$sb_show_profile='yes';

	if(isset($_REQUEST["category"]))
		$cat_list=$_REQUEST["category"];
	if(isset($_REQUEST["cid1"]))
		$cid_list=$_REQUEST["cid1"];
	if(isset($_REQUEST["location"]))
		$loc_list=$_REQUEST["location"];
	if(isset($_REQUEST["loc_id"]))
		$loc_id_list=$_REQUEST["loc_id"];

	
	$job_type=0;
	if(isset($_REQUEST["sb_permanent"]))
		$job_type=$job_type|$_REQUEST["sb_permanent"];
	if(isset($_REQUEST["sb_intern"]))
		$job_type=$job_type|$_REQUEST["sb_intern"];
	if(isset($_REQUEST["sb_contract"]))
		$job_type=$job_type|$_REQUEST["sb_contract"];
	$job_status=0;
	if(isset($_REQUEST["sb_fulltime"]))
		$job_status=$job_status|$_REQUEST["sb_fulltime"];
	if(isset($_REQUEST["sb_parttime"]))
		$job_status=$job_status|$_REQUEST["sb_parttime"];

/////////////error notifications////////////////////////
	if(!isset($_REQUEST["sb_title"]) || (strlen(trim($_REQUEST["sb_title"]))==0) )
	{
		$errs[$errcnt]="Job Title must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[&<>]/", $_REQUEST["sb_title"]))
	{
		$errs[$errcnt]="Job Title must not contain any special character i.e. < > &";
   		$errcnt++;
	}

	if(!isset($_REQUEST["sb_role"]) || (strlen(trim($_REQUEST["sb_role"]))==0) )
	{
		$errs[$errcnt]="Role must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[&<>]/", $_REQUEST["sb_role"]))
	{
		$errs[$errcnt]="Role must not contain any special character i.e. < > &";
   		$errcnt++;
	}

	if(!isset($_REQUEST["sbcomp_id"]) || ($_REQUEST["sbcomp_id"]=="0") )
	{
		$errs[$errcnt]="Company must be provided";
   		$errcnt++;
	}

	if(!isset($_REQUEST["cid1"]) || ( strlen(trim($_REQUEST["cid1"]))==0 ) )
	{
		$errs[$errcnt]="Category must be provided";
   		$errcnt++;
	}

	if(!isset($_REQUEST["loc_id"]) || (strlen(trim($_REQUEST["loc_id"]))==0) )
	{
		$errs[$errcnt]="Location must be provided";
   		$errcnt++;
	}

	if(isset($_REQUEST["sb_vacancies"]) && ($_REQUEST["sb_vacancies"]!="") && ( (!is_numeric($_REQUEST["sb_vacancies"])) || ($_REQUEST["sb_vacancies"]<1)) )
	{
		$errs[$errcnt]="Vacancies must be a positive number";
   		$errcnt++;
	}

	if(!isset($_REQUEST["sb_experience"]) )
	{
		$errs[$errcnt]="Experience must be provided";
   		$errcnt++;
	}
	
	if(!isset($_REQUEST["sb_education"]) )
	{
		$errs[$errcnt]="Educational Qualification must be provided";
   		$errcnt++;
	}
	if(!isset($_REQUEST["skl_id"]) || (strlen(trim($_REQUEST["skl_id"]))==0) )
	{
		$errs[$errcnt]="Skills Required must be provided";
   		$errcnt++;
	}
	if( isset($_REQUEST["sb_min_salary"]) && ($_REQUEST["sb_min_salary"]!="") ) 
	{
		if( !is_numeric($_REQUEST["sb_min_salary"]) )
		{
			$errs[$errcnt]="Minimum Salary must be a number";
   			$errcnt++;
		}
		elseif(!isset($_REQUEST["sb_currency"]) || ($_REQUEST["sb_currency"]=="0"))
		{
			$errs[$errcnt]="Salary Currency must be provided";
			$errcnt++;
		}
		elseif(!isset($_REQUEST["sb_salary_type"]) || ($_REQUEST["sb_salary_type"]=="0"))
		{
			$errs[$errcnt]="Salary Type must be provided";
			$errcnt++;
		}
	}
	
	if( isset($_REQUEST["sb_max_salary"]) && ($_REQUEST["sb_max_salary"]!="") ) 
	{
		if( !is_numeric($_REQUEST["sb_max_salary"]) )
		{
			$errs[$errcnt]="Maximum Salary must be a number";
   			$errcnt++;
		}
		elseif(!isset($_REQUEST["sb_currency"]) || ($_REQUEST["sb_currency"]=="0"))
		{
			$errs[$errcnt]="Salary Currency must be provided";
			$errcnt++;
		}
		elseif(!isset($_REQUEST["sb_salary_type"]) || ($_REQUEST["sb_salary_type"]=="0"))
		{
			$errs[$errcnt]="Salary Type must be provided";
			$errcnt++;
		}
	}
	if(!isset($_REQUEST["sb_career_level"]) || ($_REQUEST["sb_career_level"]=="0") )
	{
		$errs[$errcnt]="Career Level must be provided";
   		$errcnt++;
	}

	if ( $job_type == 0 )
	{
		$errs[$errcnt]="Job Type must be provided";
   		$errcnt++;
	}
	if ( $job_status == 0 )
	{
		$errs[$errcnt]="Job Status must be provided";
   		$errcnt++;
	}

	if(!isset($_REQUEST["sb_description"]) || (strlen(trim($_REQUEST["sb_description"]))==0) )
	{
		$errs[$errcnt]="Job Description must be provided";
   		$errcnt++;
	}
	elseif(preg_match ("/[&<>]/", $_REQUEST["sb_description"]))
	{
		$errs[$errcnt]="Job Description must not contain any special character i.e. < > &";
   		$errcnt++;
	}
/////////--------checking whether enough balances for posting with multi cats & locs
	$sbq_job="select * from sbjbs_jobs where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	$sbrow_job=mysql_fetch_array(mysql_query($sbq_job));

	$cid_list_array=explode(';',$cid_list);	
	$loc_id_list_array=explode(';',$loc_id_list);

	$cid_list_temp=array_unique($cid_list_array);			//removes duplicate entries
	$loc_id_list_temp=array_unique($loc_id_list_array);

	$sbcategory_list=$cid_list_temp;
	$sblocation_list=$loc_id_list_temp;

	$sb_cat_count=count($sbcategory_list)-$sbrow_job['sb_cat_count'];
	$sb_loc_count=count($sblocation_list)-$sbrow_job['sb_loc_count'];

	$sb_extra_cat_cost=0;
	$sb_extra_loc_cost=0;
	$sb_tobe_added_cat_count=0;
	if($sb_cat_count > 0)
	{
		$sb_tobe_added_cat_count=$sb_cat_count;
		$sb_extra_cat_cost=$sb_cat_count*$sbrow_con["sb_job_fee_additional"];
		
	}
	$sb_tobe_added_loc_count=0;
	if($sb_loc_count > 0)
	{
		$sb_tobe_added_loc_count=$sb_loc_count;
		$sb_extra_loc_cost=$sb_loc_count*$sbrow_con["sb_job_fee_additional"];
	}
	
	$sbtemp_total=$sb_extra_cat_cost+$sb_extra_loc_cost;
if( ( $sbtemp_total > 0) && ($sbtemp_total > $sb_total_balance) )
{
		$errs[$errcnt]="You do not have sufficient funds, please either remove some paid options or add some money first";
   		$errcnt++;
//	header("Location: gen_confirm_mem.php?errmsg=".urlencode("You cannot post job due to lack of funds, please add some money first!"));
//	die();
}

/////////-end ---checking whether enough balances for posting		
	if($errcnt==0)
	{
	
		$sb_vacancies=(int)$sb_vacancies;
		$sb_experience=(int)$sb_experience;
		$sb_education=(int)$sb_education;
		$sb_currency=(int)$sb_currency;
		$sb_salary_type=(int)$sb_salary_type;
		if($sb_max_salary=="")
			$sb_max_salary=0;
		if($sb_min_salary=="")
			$sb_min_salary=0;
		
		if(!get_magic_quotes_gpc())
		{
			$sb_title=str_replace("$","\$",addslashes($_REQUEST["sb_title"]));
			$sb_role=str_replace("$","\$",addslashes($_REQUEST["sb_role"]));
			$sb_career_level=str_replace("$","\$",addslashes($_REQUEST["sb_career_level"]));
			$sb_description=str_replace("$","\$",addslashes($_REQUEST["sb_description"]));
		}
		else
		{
			$sb_title=str_replace("$","\$",$_REQUEST["sb_title"]);
			$sb_role=str_replace("$","\$",$_REQUEST["sb_role"]);
			$sb_career_level=str_replace("$","\$",$_REQUEST["sb_career_level"]);
			$sb_description=str_replace("$","\$",$_REQUEST["sb_description"]);
		}
	
		$sbq_com="select * from sbjbs_companies where sb_uid=".$_SESSION["sbjbs_emp_userid"];
		$sbrow_com=mysql_fetch_array(mysql_query($sbq_com));
		if(!$sbrow_com)
		{
			header("Location: gen_confirm_mem.php?errmsg=".urlencode("Error, please create company profile first."));
			die();
		}
		
		$sb_company_id=$sbrow_com["sb_id"];
	//	$sb_posted_on=date("YmdHis",time());
		
		if($sbrow_con["sb_job_approval"]=='auto')
		{
//			$sb_approved='yes';
			$query_update="update `sbjbs_jobs` set  sb_title='$sb_title', sb_role='$sb_role', sb_vacancies=$sb_vacancies, sb_experience=$sb_experience, sb_education='$sb_education', sb_min_salary=$sb_min_salary, sb_max_salary=$sb_max_salary, sb_currency=$sb_currency, sb_salary_type=$sb_salary_type, sb_career_level='$sb_career_level', sb_job_type=$job_type, sb_job_status=$job_status, sb_description='$sb_description', sb_company_id=$sbcomp_id, sb_cat_count=sb_cat_count+$sb_tobe_added_cat_count,  sb_loc_count=sb_loc_count+$sb_tobe_added_loc_count where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
			$msg="Job has been updated";
		}
		else
		{
			$sb_approved='no';
			$query_update="update `sbjbs_jobs` set  sb_title='$sb_title', sb_role='$sb_role', sb_vacancies=$sb_vacancies, sb_experience=$sb_experience, sb_education='$sb_education', sb_min_salary=$sb_min_salary, sb_max_salary=$sb_max_salary, sb_currency=$sb_currency, sb_salary_type=$sb_salary_type, sb_career_level='$sb_career_level', sb_job_type=$job_type, sb_job_status=$job_status, sb_description='$sb_description', sb_company_id=$sbcomp_id,sb_approved='$sb_approved', sb_cat_count=sb_cat_count+$sb_tobe_added_cat_count,  sb_loc_count=sb_loc_count+$sb_tobe_added_loc_count  where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
			$msg="Your updated job has been sent for admin approval";
		}
//echo $query_update;
//die();
		mysql_query($query_update);
//		if(mysql_affected_rows()>0)
		{
///--------adding to categories
			$sbqu_cat="delete from sbjbs_job_cats where sb_job_id=$sb_id";
			mysql_query($sbqu_cat);
			foreach($sbcategory_list as $key => $value) 
			{
				$sbqi_cat="insert into sbjbs_job_cats (sb_cid, sb_job_id) values ($value, $sb_id)";
				mysql_query($sbqi_cat);
			}
		
///--------adding to location
			$sbqu_cat="delete from sbjbs_job_locs where sb_job_id=$sb_id";
			mysql_query($sbqu_cat);
			foreach($sblocation_list as $key => $value) 
			{
				$sbqi_cat="insert into sbjbs_job_locs (sb_lid, sb_job_id) values ($value, $sb_id)";
				mysql_query($sbqi_cat);
			}
		
////////--------adding skills
			$sbqu_cat="delete from sbjbs_job_skls where sb_job_id=$sb_id";
			mysql_query($sbqu_cat);
	//		echo "HI----".$skl_id_list;
			$sbskill_list=explode(';',$skl_id_list);	
			$sbskill_list=array_unique($sbskill_list);			//removes duplicate entries
			foreach($sbskill_list as $key => $value) 
			{
		//		echo "<br>$value";
				$sbqi_skl="insert into sbjbs_job_skls (sb_sid, sb_job_id) values ($value, $sb_id)";
				mysql_query($sbqi_skl);
			}

///////--------add to the transaction table
			$sb_uid=$_SESSION["sbjbs_emp_userid"];
			$sb_date=date("YmdHis",time());
			
/*			if( $sbrow_con["sb_job_fee"] > 0 )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_con["sb_job_fee"].", 'Posted your job ''$sb_title''', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
*/			if( ($sbrow_con["sb_job_fee_additional"] > 0) && ($sb_cat_count > 0) )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sb_extra_cat_cost.", 'Updated job ''$sb_title'' posted in $sb_cat_count additional categoies', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
			if(  ($sbrow_con["sb_job_fee_additional"] > 0) && ($sb_loc_count > 0) )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sb_extra_loc_cost.", 'Updated job ''$sb_title'' posted in $sb_loc_count additional locations', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
			
/*
			if( ($sb_paid_options) && ($sb_front_featured=='yes') )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_con["sb_front_featured_fee"].", 'Made your job ''$sb_title'' to appear as Front Featured', $sb_date)";
				//die($sbqi_tra);
				mysql_query($sbqi_tra);
			}
			if( ($sb_paid_options) && ($sb_featured=='yes') )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_con["sb_featured_fee"].", 'Made your job ''$sb_title'' to appear as Featured', $sb_date)";
				mysql_query($sbqi_tra);
			}
			if( ($sb_paid_options) && ($sb_highlight=='yes') )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_con["sb_highlight_fee"].", 'Made your job ''$sb_title'' to appear as Highlighted', $sb_date)";
				mysql_query($sbqi_tra);
			}
			if( ($sb_paid_options) && ($sb_bold=='yes') )
			{
				$sbqi_tra="insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values ($sb_uid, ".-$sbrow_con["sb_bold_fee"].", 'Made your job ''$sb_title'' to appear as Bold', $sb_date)";
				mysql_query($sbqi_tra);
			}
*/
///////------end of add to the transaction table
			if($sbrow_con["sb_job_approval"]=="admin")
			{	//sending mail to admin
//				$sbrow_con=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
	//			$sbq_job="select max(sb_id) as max_id from `sbjbs_jobs` where 1";
	//			$sbrow_job=mysql_fetch_array(mysql_query($sbq_job));
	//			$max_id=$sbrow_job["max_id"];
				
				$sb_null_char=$sbrow_con["sb_null_char"];
//				$login_url=$sbrow_con["sb_site_root"]."/employer/signin.php";
							
				$row_emp= mysql_fetch_array(mysql_query("SELECT * FROM sbjbs_employers WHERE sb_id=".$_SESSION["sbjbs_emp_userid"]));
				if($row_emp)			
				{
				//Reads email to be sebt
					$sbq_mail= "SELECT * FROM sbjbs_mails where sb_mailid=6" ;
					$sbrs_mail=mysql_query($sbq_mail);
					
					if ( $sbrow_mail=mysql_fetch_array($sbrs_mail)  )// if mail
					{
						if($sbrow_mail["sb_status"]=="yes")	
						{
							 $from =$sbrow_mail["sb_fromid"];
							 $to = $sbrow_con["sb_admin_email"];
							 $subject =$sbrow_mail["sb_subject"];
								
	  	$body=str_replace("%title%", $row_emp["sb_title"],str_replace("%email%", $row_emp["sb_email_addr"],str_replace("%password%",$sb_null_char,str_replace("%lname%", $row_emp["sb_lastname"],str_replace("%fname%", $row_emp["sb_firstname"],str_replace("%username%", $row_emp["sb_username"], $sbrow_mail["sb_mail"]) ))))); 
				
		$body=str_replace("%signup_url%",$sb_null_char,str_replace("%login_url%",$sb_null_char,$body));
	
		$body=str_replace("%company_profile_url%",$sb_null_char,str_replace("%company_name%",$sb_null_char,str_replace("%company_id%",$sb_null_char,$body)));				

		$body=str_replace("%job_url%",$sb_null_char,str_replace("%job_title%",$sb_title,str_replace("%job_id%",$sb_id,$body)));				
	
	  	$header="From:" . $from . "\r\n" ."Reply-To:". $from  ;
	
							if(isset($rs["sb_html_format"])&&($rs["sb_html_format"]=="yes"))
							{
								$header .= "\r\nMIME-Version: 1.0";
								$header .= "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
								//$body=str_replace("\n","<br>",$body);
							}

// 	echo "--from:-$from----to:-$to---sub:-$subject----head:-$header----";
// 	echo "<pre>$body</pre>";
//	die();
				 			mail($to,$subject,$body,$header);
		  				}// end if status is on
		  			}// end if mail 
				}		//end if rs0
			}	//if approval==admin		
			//mail ends here
			header("Location: gen_confirm_mem.php?errmsg=".urlencode($msg));
			die();
		}	//end if mysql_affected_rows() > 0 i.e.success
/*		else
		{
			header("Location: gen_confirm_mem.php?errmsg=".urlencode("Some error occurred, please try again!"));
			die();
		}
*/	}			//end if-errcnt==0
}			//end if count-post
else
{		
	$sbq_job="select * from sbjbs_jobs where sb_id=$sb_id and sb_uid=".$_SESSION["sbjbs_emp_userid"];
	$sbrow_job=mysql_fetch_array(mysql_query($sbq_job));
	if(!$sbrow_job)
	{
		header("Location: gen_confirm_mem.php?errmsg=".urlencode("Unauthorised access, denied."));
		die();
	}
	
	$sb_title=$sbrow_job['sb_title'];
	$sb_role=$sbrow_job['sb_role'];
	$sbcomp_id=$sbrow_job['sb_company_id'];
//	$cat_list='';
//	$cid_list='';
//	$loc_list='';
//	$loc_id_list='';
	$sb_vacancies=($sbrow_job['sb_vacancies']>0)?$sbrow_job['sb_vacancies']:'';
	$sb_experience=$sbrow_job['sb_experience'];
	$sb_education=$sbrow_job['sb_education'];
	$sb_min_salary=($sbrow_job['sb_min_salary']>0)?$sbrow_job['sb_min_salary']:'';
	$sb_max_salary=($sbrow_job['sb_max_salary']>0)?$sbrow_job['sb_max_salary']:'';
	$sb_currency=$sbrow_job['sb_currency'];
	$sb_salary_type=$sbrow_job['sb_salary_type'];
	$sb_career_level=$sbrow_job['sb_career_level'];
	$job_type=$sbrow_job['sb_job_type'];
	$job_status=$sbrow_job['sb_job_status'];
	$sb_description=$sbrow_job['sb_description'];

	$sb_cat_count=$sbrow_job['sb_cat_count'];
	$sb_loc_count=$sbrow_job['sb_loc_count'];
///---getting cats
	$sbq_off_cat="select * from sbjbs_job_cats where sb_job_id=$sb_id";
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

/////-------getting locations
	$sbq_off_cat="select * from sbjbs_job_locs where sb_job_id=$sb_id";
	$sbrs_off_cat=mysql_query($sbq_off_cat);

$loc_list="";
$loc_id_list="";
while($sbrow_off_cat=mysql_fetch_array($sbrs_off_cat))
{
//	$cat_id=$rs["cat".$i];
	$rs_t=mysql_query("Select * from sbjbs_locations  where sb_id =".$sbrow_off_cat["sb_lid"]);
	if ($rs_t=mysql_fetch_array($rs_t))
	{
		  $cat_path=$rs_t["sb_loc_name"];
 		  $par=mysql_query("select * from sbjbs_locations where sb_id=".$rs_t["sb_pid"]);
		  while($parent=mysql_fetch_array($par))
		  {
			$cat_path=$parent["sb_loc_name"]."-".$cat_path;
			$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
			}
		if($loc_list=="")
		{

		$loc_list=$cat_path;
		$loc_id_list=$rs_t["sb_id"];
		}
		else
		{
		$loc_list.=";".$cat_path;
		$loc_id_list.=";".$rs_t["sb_id"];
		}
	}
}


///-geting skills
	$sb_skill_list_str='-1';
	$sbq1_skl="select * from sbjbs_job_skls where sb_job_id=$sb_id";
	$sbrs1_skl=mysql_query($sbq1_skl);
	while($sbrow1_skl=mysql_fetch_array($sbrs1_skl))
		$sb_skill_list_str.=','.$sbrow1_skl["sb_sid"];
	
	
	$sbq_skl="select * from sbjbs_skills where sb_id in (".$sb_skill_list_str.")";
	$sbrs_skl=mysql_query($sbq_skl);
	$sbrow_skl=mysql_fetch_array($sbrs_skl);
	
	$skl_list=$sbrow_skl["sb_name"];		//reads first skill and stores
	$skl_id_list=$sbrow_skl["sb_id"];
	
	while($sbrow_skl=mysql_fetch_array($sbrs_skl))	//reads all subsequent skills separated by semi colon
	{
		$skl_list.=";".$sbrow_skl["sb_name"];
		$skl_id_list.=";".$sbrow_skl["sb_id"];
	}

//	$sb_front_featured='';
//	$sb_featured='';
//	$sb_highlight='';
//	$sb_bold='';
}	

function main()
{
	global $sbcomp_id, $sb_fee_currency, $sb_fee_currency_name, $sbrow_con, $sb_total_balance, $sb_id, $errs, $errcnt, $sb_title, $sb_role, $sb_vacancies, $sb_experience, $sb_education, $skl_list, $skl_id_list, $sb_min_salary, $sb_max_salary, $sb_currency, $sb_salary_type, $sb_career_level, $job_type, $job_status, $sb_description, $sb_show_profile, $cat_list, $cid_list, $loc_list, $loc_id_list, $sb_cat_count, $sb_loc_count, $sb_cat_listing;

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


					function add_location()
					{
					if(document.form123.locs.value!=0)
					{
					var id=document.form123.locs.selectedIndex;
					
					var cid_list=form123.loc_id.value.split(";");
					var cnt=0;
					var posted="no";
					while(cnt<cid_list.length)
					{
						if(cid_list[cnt]==document.form123.locs.value)
						{ posted="yes";}
						cnt++;
					}
					if(posted=="yes")
					{
						alert('This location is already in the list');
						return false;
					}

					
					if(document.form123.location.value=="")
					{
					document.form123.loc_id.value=document.form123.locs.value;
					document.form123.location.value=document.form123.locs.options[id].text;
					document.form123.location.focus();
					document.form123.locs.selectedIndex=0;
					}
					else
					{
					document.form123.loc_id.value=document.form123.loc_id.value+";"+document.form123.locs.value;
					document.form123.location.value=document.form123.location.value+";"+document.form123.locs.options[id].text;
					document.form123.location.focus();
					document.form123.locs.selectedIndex=0;
					}
					}
					else
					{
					alert('Choose a Location to add!');
					}
					}
					
					function remove_location()
					{
					var s1=window.document.form123.location.value;
					var s2=s1.split(";");
					var i=0;
					var id=document.form123.locs.selectedIndex;
					var s3=document.form123.locs.options[id].text;
					
					var id_list=document.form123.loc_id.value;
					var id_split=id_list.split(";");
					var rem_id=document.form123.locs.value;
										
					window.document.form123.location.value="";
					window.document.form123.loc_id.value="";
					
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
							if(document.form123.location.value=="")
							{
							document.form123.location.value=s2[i];
							}
							else
							{
							document.form123.location.value=document.form123.location.value+";"+s2[i];
							}
						
						}
						if(rem_id==id_split[i])
						{
						//continue;
						//	alert('Removing'+s3);
						}
						else
						{
							if(document.form123.loc_id.value=="")
							{
							document.form123.loc_id.value=id_split[i];
							}
							else
							{
							document.form123.loc_id.value=document.form123.loc_id.value+";"+id_split[i];
							}
						
						}
					i++;
					}
					//window.document.form123.related.value="";
					//window.document.form123.rel_id.value="";
					}
					function add_skill()
					{
					if(document.form123.skls.value!=0)
					{
					var id=document.form123.skls.selectedIndex;
					
					var cid_list=form123.skl_id.value.split(";");
					var cnt=0;
					var posted="no";
					while(cnt<cid_list.length)
					{
						if(cid_list[cnt]==document.form123.skls.value)
						{ posted="yes";}
						cnt++;
					}
					if(posted=="yes")
					{
						alert('This skill is already in the list');
						return false;
					}
					
					if(document.form123.skill.value=="")
					{
					document.form123.skl_id.value=document.form123.skls.value;
					document.form123.skill.value=document.form123.skls.options[id].text;
					document.form123.skill.focus();
					document.form123.skls.selectedIndex=0;
					}
					else
					{
					document.form123.skl_id.value=document.form123.skl_id.value+";"+document.form123.skls.value;
					document.form123.skill.value=document.form123.skill.value+";"+document.form123.skls.options[id].text;
					document.form123.skill.focus();
					document.form123.skls.selectedIndex=0;
					}
					}
					else
					{
					alert('Choose a Skill to add!');
					}
					}

					function remove_skill()
					{
					var s1=window.document.form123.skill.value;
					var s2=s1.split(";");
					var i=0;
					var id=document.form123.skls.selectedIndex;
					var s3=document.form123.skls.options[id].text;
					
					var id_list=document.form123.skl_id.value;
					var id_split=id_list.split(";");
					var rem_id=document.form123.skls.value;
										
					window.document.form123.skill.value="";
					window.document.form123.skl_id.value="";
					
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
							if(document.form123.skill.value=="")
							{
							document.form123.skill.value=s2[i];
							}
							else
							{
							document.form123.skill.value=document.form123.skill.value+";"+s2[i];
							}
						
						}
						if(rem_id==id_split[i])
						{
						//continue;
						//	alert('Removing'+s3);
						}
						else
						{
							if(document.form123.skl_id.value=="")
							{
							document.form123.skl_id.value=id_split[i];
							}
							else
							{
							document.form123.skl_id.value=document.form123.skl_id.value+";"+id_split[i];
							}
						
						}
					i++;
					}
					//window.document.form123.related.value="";
					//window.document.form123.rel_id.value="";
					}

function calculate_cost(form)
{	//calculates total cost
	var total_cost=0;
	var sb_cat_count=<?php echo $sb_cat_count;?>;
	var sb_loc_count=<?php echo $sb_loc_count;?>;
/////category cost
	var s1=form.cid1.value;
	var s2=s1.split(";");
	var no_of_cats=s2.length;
	var s1_loc=form.loc_id.value;
	var s2_loc=s1_loc.split(";");
	var no_of_locs=s2_loc.length;
	var extra_cats=0;
	var extra_locs=0;
	
	if(no_of_cats > sb_cat_count)
	{
		extra_cats=no_of_cats-sb_cat_count;
		total_cost+=extra_cats*<?php echo $sbrow_con["sb_job_fee_additional"]; ?>;
	}
	if(no_of_locs > sb_loc_count)
	{
		extra_locs=no_of_locs-sb_loc_count;
		total_cost+=extra_locs*<?php echo $sbrow_con["sb_job_fee_additional"]; ?>;
	}

	if(total_cost > 0 && total_cost > <?php echo $sb_total_balance;?>)
	{
		alert('Extra Categories added='+extra_cats+'\nExtra Locations added='+extra_locs+'\nTotal cost for updating this job exceeds the current balance in your account. \n\nCurrent Balance in Your Account\t=  <? echo $sb_total_balance." ".$sb_fee_currency_name; ?>\nTotal Cost for updating this job\t=  '+total_cost+'<?php echo " ".$sb_fee_currency_name; ?>\n\nPlease remove extra categories /locations to proceed.');
		return false;
	} 
	else
	{
		return confirm('Extra Categories added='+extra_cats+'\nExtra Locations added='+extra_locs+'\nCurrent Balance in Your Account\t=  <?php echo $sb_total_balance." ".$sb_fee_currency_name; ?>\nTotal Cost for updating this job\t=  '+total_cost+'<?php echo " ".$sb_fee_currency_name; ?>\n\nDo you want to proceed ?');
	}

}

function validate(form) 
{
	if ( (form.sb_title.value == "")) 
	{
    	alert('Please specify Job Title!');
		form.sb_title.focus();
	   	return false;
	}
	else if((form.sb_title.value.match(/[<>&]+/)))
	{
		alert("Please remove special characters from Job Title i.e. & < >");
		form.sb_title.focus();
		form.sb_title.select();
		return(false);
	}
	if ( (form.sb_role.value == "")) 
	{
       	alert('Please specify Role!');
		form.sb_role.focus();
	   	return false;
	}
	else if((form.sb_role.value.match(/[<>&]+/)))
	{
		alert("Please remove special characters from Role i.e. & < >");
		form.sb_role.focus();
		form.sb_role.select();
		return(false);
	}

		if(form.sbcomp_id.selectedIndex==0)
		{
			alert('Please specify Company!');
			form.sbcomp_id.focus();
			return false;
		}
	
	if ( (form.cid1.value == "")) 
	{
       	alert('Please specify Category!');
		form.add.focus();
	   	return false;
	}
	
	if ( (form.loc_id.value == "")) 
	{
       	alert('Please specify Location!');
		form.add2.focus();
	   	return false;
	}
	if ( (form.sb_vacancies.value != "") && isNaN(form.sb_vacancies.value) ) 
	{
       	alert('Please specify numeric value for Vacancies!');
		form.sb_vacancies.focus();
	   	return false;
	}

	if ( (form.skl_id.value == "")) 
	{
       	alert('Please specify Skills Required!');
		form.add21.focus();
	   	return false;
	}
	if ( (form.sb_min_salary.value != "") && (isNaN(form.sb_min_salary.value) || form.sb_min_salary.value<=0) ) 
	{
       	alert('Please specify positive non-zero numeric value for Minimum Salary!');
		form.sb_min_salary.focus();
		form.sb_min_salary.select();
	   	return false;
	}
	if ( (form.sb_max_salary.value != "") && (isNaN(form.sb_max_salary.value) || form.sb_max_salary.value<=0) ) 
	{
       	alert('Please specify positive non-zero numeric value for Maximum Salary!');
		form.sb_max_salary.focus();
		form.sb_max_salary.select();
	   	return false;
	}

	if ( (form.sb_min_salary.value != "") || (form.sb_max_salary.value != "") ) 
	{
		if( parseInt(form.sb_min_salary.value) > parseInt(form.sb_max_salary.value) )
		{
			alert("Maximum Salary can't be lesser than Minimum Salary!");
			form.sb_max_salary.focus();
			form.sb_max_salary.select();
	   	return false;
		}
	}

	if ( (form.sb_min_salary.value != "" && form.sb_min_salary.value > 0) || (form.sb_max_salary.value != "" && form.sb_max_salary.value > 0) ) 
	{
		if(form.sb_currency.selectedIndex==0)
		{
			alert('Please specify Salary Currency!');
			form.sb_currency.focus();
			return false;
		}
		else if(form.sb_salary_type.selectedIndex==0)
		{
			alert('Please specify Salary Type!');
			form.sb_salary_type.focus();
			return false;
		}
	}

		if(form.sb_career_level.selectedIndex==0)
		{
			alert('Please specify Career Level!');
			form.sb_career_level.focus();
			return false;
		}


	if(form.sb_permanent.checked==false && form.sb_intern.checked==false && form.sb_contract.checked==false )
	{
		alert('Please specify Job Type!');
		form.sb_permanent.focus();
		return false;
	}

	if(form.sb_fulltime.checked==false && form.sb_parttime.checked==false )
	{
		alert('Please specify Job Status!');
		form.sb_fulltime.focus();
		return false;
	}

	if ( (form.sb_description.value == "")) 
	{
    	alert('Please specify Job Description!');
		form.sb_description.focus();
	   	return false;
	}
	else if((form.sb_description.value.match(/[<>&]+/)))
	{
		alert("Please remove special characters from Job Description i.e. & < >");
		form.sb_description.focus();
		form.sb_description.select();
		return(false);
	}
	
	return calculate_cost(form);
}  
  
// -->
</SCRIPT>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form123" id="form123" onSubmit="return validate(this);">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="onepxtable">
          <tr class="titlestyle"> 
            <td >&nbsp;Edit Job</td>
          </tr>
   <tr>
      <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="5">
          <tr valign="top"> 
            <td colspan="3" align="center" class="innertablestyle"><font class="normal"> 
              <?php 
			if($sbrow_con["sb_job_fee_additional"] > 0)
			{
				echo "Please be advised that each additional Category and/or Location selection will incur an additional charge of <strong>$sb_fee_currency ".$sbrow_con["sb_job_fee_additional"]."</strong>. Once posted, these charges are NOT refundable.";
			}
		?>
              </font> </td>
          </tr>
          <tr valign="top"> 
            <td width="40%" align="right" class="innertablestyle"><font class="normal"><strong>Job 
              Title </strong></font></td>
            <td width="6"><font class="red">*</font></td>
            <td width="60%"> <input name="sb_title" type="text" id="sb_title"  value="<?php echo $sb_title  ; ?>" size="45" maxlength="255"> 
            </td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Role</strong></font></td>
            <td><font class="red">*</font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="sb_role" type="text" id="sb_role" value="<?php echo $sb_role; ?>" size="45" maxlength="255">
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Company</strong></font></td>
            <td><font class="red">*</font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <select name="sbcomp_id" id="sbcomp_id">
                <option value="0">Select a Company</option>
                <?php 	$sbq_com="select * from sbjbs_companies where sb_approved='yes' and sb_uid=".$_SESSION["sbjbs_emp_userid"];
//	die($sbq_com); 
		$sbrs_com=mysql_query($sbq_com);
		while($sbrow_com=mysql_fetch_array($sbrs_com))
		{
			echo '<option value="'.$sbrow_com["sb_id"].'"';
			echo ($sbrow_com["sb_id"]==$sbcomp_id)?'selected':'';
			echo '>'.$sbrow_com["sb_name"].'</option>';
		}
?>
              </select>
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Category<br>
              </strong></font></td>
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
	$rs_query=mysql_query("select * from sbjbs_categories order by sb_pid");
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
              <input name="add" type="button" id="add" value="Add" onClick="add_category()">
              <input name="Remove" type="button" id="Remove2" value="Remove" onClick="remove_category()">
              &nbsp; </font><font class="normal">&nbsp; </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Location<br>
              </strong></font></td>
            <td><font class="red">*</font></td>
            <td><font class="smalltext"> 
              <textarea name="location" cols="37" rows="5" readonly="readonly" id="location"><? echo $loc_list;?></textarea>
              <br>
              <select name="locs" id="locs" >
                <option value="0">Choose a location</option>
                <?
			$rs_query=mysql_query("select * from sbjbs_locations where sb_pid=0 order by  sb_default desc,sb_loc_name");
			  
			 while($rst=mysql_fetch_array($rs_query))
			  {
//				  $cat_path="";
		/*$child=mysql_fetch_array(mysql_query("select * from sbjbs_locations where sb_pid=".$rst["sb_id"]));
									  if($child)
									  {
									  continue;
									  }*///
									  $cat_path=$rst["sb_loc_name"];
/*		 $par=mysql_query("select * from sbjbs_locations where sb_id=".$rst["sb_pid"]);
		 				while($parent=mysql_fetch_array($par))
		 				{
						$cat_path=$parent["sb_loc_name"]."-".$cat_path;
						$par=mysql_query("select * from sbjbs_locations where sb_id=".$parent["sb_pid"]);
						}*/
                                      ?>
                <option value="<? echo $rst["sb_id"];?>" ><? echo $cat_path;?></option>
                <?
									  
									loc_order($rst["sb_id"]);
									}
									  ?>
              </select>
              <input name="loc_id" type="hidden" id="loc_id" value="<? echo $loc_id_list;?>">
              <input name="add2" type="button" id="add2" value="Add" onClick="add_location()">
              <input name="Remove2" type="button" id="Remove2" value="Remove" onClick="remove_location()">
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Vacancies</strong></font></td>
            <td>&nbsp;</td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <input name="sb_vacancies" type="text" id="sb_vacancies"  value="<?php echo $sb_vacancies; ?>" size="30" maxlength="30">
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Experience</strong></font></td>
            <td><font class="red">*</font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <select name="sb_experience" id="sb_experience">
                <option value="-1"<?php if($sb_experience==-1) echo " selected";?>>No 
                preference</option>
                <option value="0"<?php if($sb_experience==0) echo " selected";?>>Fresher</option>
                <option value="1"<?php if($sb_experience==1) echo " selected";?>>Less 
                than 1 Year</option>
                <option value="2"<?php if($sb_experience==2) echo " selected";?>>1 
                to 2 Years</option>
                <option value="3"<?php if($sb_experience==3) echo " selected";?>>2 
                to 5 Years</option>
                <option value="4"<?php if($sb_experience==4) echo " selected";?>>5 
                to 7 Years</option>
                <option value="5"<?php if($sb_experience==5) echo " selected";?>>7 
                to 10 Years</option>
                <option value="6"<?php if($sb_experience==6) echo " selected";?>>10 
                to 15 Years</option>
                <option value="7"<?php if($sb_experience==7) echo " selected";?>>More 
                than 15 Years</option>
              </select>
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Educational 
              Qualification </strong></font></td>
            <td><font class="red">*</font></td>
            <td><font face="Arial, Helvetica, sans-serif" size="2"> 
              <select name="sb_education" id="sb_education">
                <option value="0"<?php if($sb_education==0) echo " selected";?>>No 
                preference</option>
                <?php 	$sbq_cur="select * from sbjbs_degrees where 1";
					$sbrs_cur=mysql_query($sbq_cur);
					while($sbrow_cur=mysql_fetch_array($sbrs_cur))
					{
						echo '<option value="'.$sbrow_cur['sb_id'].'"';
						echo ($sbrow_cur['sb_id']==$sb_education)?'selected':'';
						echo '>'.$sbrow_cur['sb_degree'].'</option>';
					}
			?>
              </select>
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Skills 
              Required </strong></font></td>
            <td><font class="red">*</font></td>
            <td><font class="smalltext"> 
              <textarea name="skill" cols="37" rows="5" readonly="readonly" id="skill"><? echo $skl_list;?></textarea>
              <br>
              <select name="skls" id="skls" >
                <option value="0">Choose a skill</option>
                <?php
				  $rs_query=mysql_query("select * from sbjbs_skills order by sb_id");
				  
				  while($rst=mysql_fetch_array($rs_query))
				  {          ?>
                <option value="<? echo $rst["sb_id"];?>" ><? echo $rst["sb_name"];?></option>
                <?php	  }		//end while		  ?>
              </select>
              <input name="skl_id" type="hidden" id="skl_id" value="<? echo $skl_id_list;?>">
              <input name="add21" type="button" id="add21" value="Add" onClick="add_skill()">
              <input name="Remove21" type="button" id="Remove21" value="Remove" onClick="remove_skill()">
              </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Salary</strong></font></td>
            <td>&nbsp;</td>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><font class="smalltext">Minimum</font></td>
                  <td><font class="smalltext">Maximum</font></td>
                  <td><font class="smalltext">Currency</font></td>
                  <td><font class="smalltext">Type</font></td>
                </tr>
                <tr> 
                  <td><input name="sb_min_salary" type="text" id="sb_min_salary2" value="<?php echo $sb_min_salary; ?>" size="15" maxlength="15"></td>
                  <td> <input name="sb_max_salary" type="text" id="sb_max_salary2" value="<?php echo $sb_max_salary; ?>" size="15" maxlength="15"></td>
                  <td> <select name="sb_currency">
                      <option value="0">-</option>
                      <?php 	$sbq_cur="select * from sbjbs_currencies where 1";
					$sbrs_cur=mysql_query($sbq_cur);
					while($sbrow_cur=mysql_fetch_array($sbrs_cur))
					{
						echo '<option value="'.$sbrow_cur['sbcur_id'].'"';
						echo ($sbrow_cur['sbcur_id']==$sb_currency)?'selected':'';
						echo '>'.$sbrow_cur['sbcur_name'].'</option>';
					}
					
			?>
                    </select></td>
                  <td><select name="sb_salary_type" id="sb_salary_type">
                      <option value="0" <?php echo ($sb_salary_type==0)?'selected':''; ?>>-</option>
                      <option value="1" <?php echo ($sb_salary_type==1)?'selected':''; ?>>Per 
                      Year</option>
                      <option value="2" <?php echo ($sb_salary_type==2)?'selected':''; ?>>Per 
                      Month</option>
                      <option value="3" <?php echo ($sb_salary_type==3)?'selected':''; ?>>Per 
                      Week</option>
                      <option value="4" <?php echo ($sb_salary_type==4)?'selected':''; ?>>Fortnightly</option>
                      <option value="5" <?php echo ($sb_salary_type==5)?'selected':''; ?>>Per 
                      Hour</option>
                    </select> </td>
                </tr>
              </table></td>
          </tr>
          <tr valign="top"> 
            <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Career 
              Level </strong></font></td>
            <td><font class="red">*</font></td>
            <td><select name="sb_career_level">
                <option value="0" >Select Career Level</option>
                <option value="1" <?php echo ($sb_career_level==1)?'selected':''; ?>>Student</option>
                <option value="2" <?php echo ($sb_career_level==2)?'selected':''; ?>>Student 
                (High School)</option>
                <option value="3" <?php echo ($sb_career_level==3)?'selected':''; ?>>Entry 
                Level (less than 2 years experience)</option>
                <option value="4" <?php echo ($sb_career_level==4)?'selected':''; ?>>Mid 
                Career (2+ years of experience)</option>
                <option value="5" <?php echo ($sb_career_level==5)?'selected':''; ?>>Management 
                (Manager/Director of Staff)</option>
                <option value="6" <?php echo ($sb_career_level==6)?'selected':''; ?>>Executive 
                (SVP, EVP, VP)</option>
                <option value="7" <?php echo ($sb_career_level==7)?'selected':''; ?>>Senior 
                Executive (President, CEO)</option>
              </select></td>
          </tr>
          <tr valign="top"> 
            <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Job 
              Type </strong></font></td>
            <td><font class="red">*</font></td>
            <td><font class="smalltext"> 
              <input type="checkbox" value="1" name="sb_permanent" <?php 
			  if(($job_type&1)==1) echo "checked";?>>
              Permanent <br>
              <input type="checkbox" value="2" name="sb_intern" <?php 
			  if(($job_type&2)==2) echo "checked";?>>
              Intern / Work Experience<br>
              <input type="checkbox" value="4" name="sb_contract" <?php 
			  if(($job_type&4)==4) echo "checked";?>>
              Temporary/Contract/Project</font></td>
          </tr>
          <tr valign="top"> 
            <td height="24" align="right" class="innertablestyle"><font class="normal"><strong>Job 
              Status </strong></font></td>
            <td><font class="red">*</font></td>
            <td><font class="smalltext"> 
              <input type="checkbox" value="1" name="sb_fulltime"  <?php 
			  if(($job_status&1)==1) echo "checked";?>>
              Full Time &nbsp; 
              <input type="checkbox" value="2" name="sb_parttime" <?php 
			  if(($job_status&2)==2) echo "checked";?>>
              Part Time</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle"><font class="normal"><strong>Job 
              Description </strong></font></td>
            <td><font class="red">*</font></td>
            <td> <textarea name="sb_description" cols="40" rows="5" id="sb_description"><?php echo $sb_description; ?></textarea> 
            </td>
          </tr>
          <tr valign="top"> 
            <td align="right" class="innertablestyle">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="submit"  type="submit" value="Update"> <input name="sb_id" type="hidden" id="sb_id" value="<?php echo $sb_id; ?>"></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>
<?php
}	//end main
include_once("template.php");
?>