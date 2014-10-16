<?
include "logincheck.php";
include_once "myconnect.php";

			$sb_title_len=(int)$_REQUEST["sb_title_len"];
			$sb_job_desc_len=(int)$_REQUEST["sb_job_desc_len"];
			$sb_resume_desc_len=(int)$_REQUEST["sb_resume_desc_len"];
			$sb_cover_letter_len=(int)$_REQUEST["sb_cover_letter_len"];
			$sb_letter_cnt=(int)$_REQUEST["sb_letter_cnt"];
			$sb_resume_cnt=(int)$_REQUEST["sb_resume_cnt"];
			$sb_job_cnt=(int)$_REQUEST["sb_job_cnt"];
			$sbcomp_cat_cnt=(int)$_REQUEST["sbcomp_cat_cnt"];
			$sb_company_cnt=(int)$_REQUEST["sb_company_cnt"];
$sql="update sbjbs_config set
			sb_title_len=$sb_title_len,
			sb_job_desc_len=$sb_job_desc_len,
			sb_resume_desc_len=$sb_resume_desc_len,
			sb_letter_cnt=$sb_letter_cnt,
			sb_resume_cnt=$sb_resume_cnt,
			sb_job_cnt=$sb_job_cnt,
			sb_cover_letter_len=$sb_cover_letter_len,
			sbcomp_cat_cnt=$sbcomp_cat_cnt,
			sb_company_cnt=$sb_company_cnt
		where sb_id=1";
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_others.php?msg=".urlencode("Mics. Parameters have been updated"));
	die();
}
else
{
	header("Location:"."settings_others.php?msg=".urlencode("Unable to update misc. parameters, please try again"));
	die();
}
?>