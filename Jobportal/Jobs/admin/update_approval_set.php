<?
include "logincheck.php";
include_once "myconnect.php";

			if (!get_magic_quotes_gpc()) {
			$sb_mem_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_mem_approval"]));
			$sb_profile_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_profile_approval"]));
			$sb_resume_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_resume_approval"]));
			$sb_job_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_job_approval"]));
			$sb_premium_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_premium_approval"]));
			$sb_letter_approval=str_replace('$', '\$',addslashes($_REQUEST["sb_letter_approval"]));
			}
			else
			{
			$sb_mem_approval=str_replace('$', '\$',$_REQUEST["sb_mem_approval"]);
			$sb_profile_approval=str_replace('$', '\$',$_REQUEST["sb_profile_approval"]);
			$sb_resume_approval=str_replace('$', '\$',$_REQUEST["sb_resume_approval"]);
			$sb_job_approval=str_replace('$', '\$',$_REQUEST["sb_job_approval"]);
			$sb_premium_approval=str_replace('$', '\$',$_REQUEST["sb_premium_approval"]);
			$sb_letter_approval=str_replace('$', '\$',$_REQUEST["sb_letter_approval"]);
			}

		/*$image_magik=$_REQUEST["im_status"];
		$water_marking=$_REQUEST["water_mark"];*/
$sql="update sbjbs_config set
			sb_mem_approval='$sb_mem_approval',
			sb_profile_approval='$sb_profile_approval',
			sb_resume_approval='$sb_resume_approval',
			sb_job_approval='$sb_job_approval',
			sb_premium_approval='$sb_premium_approval',
			sb_letter_approval='$sb_letter_approval'
			where sb_id=1";
			
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_approval.php?msg=".urlencode("Approval types have been updated"));
	die();
}
else
{
	header("Location:"."settings_approval.php?msg=".urlencode("Unable to update approval types, please try again"));
	die();
}
?>