<?
include "logincheck.php";
include_once "myconnect.php";

			$recperpage=(int)$_REQUEST["recperpage"];
			$sb_premium_cnt=(int)$_REQUEST["sb_premium_cnt"];
			$sb_featured_cnt=(int)$_REQUEST["sb_featured_cnt"];
			$sb_image_size=(int)$_REQUEST["sb_image_size"];
		
			if (!get_magic_quotes_gpc()) {
			$sb_null_char=str_replace('$', '\$',addslashes($_REQUEST["sb_null_char"]));
			$site_keywords=str_replace('$', '\$',addslashes($_REQUEST["site_keywords"]));
			$site_name=str_replace('$', '\$',addslashes($_REQUEST["sitename"]));
			$admin_email=str_replace('$', '\$',addslashes($_REQUEST["adminemail"]));
			$site_root=str_replace('$', '\$',addslashes($_REQUEST["siteaddrs"]));
			$sb_logo=str_replace('$', '\$',addslashes($_REQUEST["list1"]));
			$sb_signup_verification=str_replace('$', '\$',addslashes($_REQUEST["sb_signup_verification"]));
			$sb_cat_listing=str_replace('$', '\$',addslashes($_REQUEST["cat_listing"]));
			}
			else
			{
			$sb_null_char=str_replace('$', '\$',$_REQUEST["sb_null_char"]);
			$site_keywords=str_replace('$', '\$',$_REQUEST["site_keywords"]);
			$site_name=str_replace('$', '\$',$_REQUEST["sitename"]);
			$admin_email=str_replace('$', '\$',$_REQUEST["adminemail"]);
			$site_root=str_replace('$', '\$',$_REQUEST["siteaddrs"]);
			$sb_logo=str_replace('$', '\$',$_REQUEST["list1"]);
			$sb_signup_verification=str_replace('$', '\$',$_REQUEST["sb_signup_verification"]);
			$sb_cat_listing=str_replace('$', '\$',$_REQUEST["cat_listing"]);
			}
$sql="update sbjbs_config set
			sb_recperpage=$recperpage,
			sb_premium_cnt=$sb_premium_cnt,
			sb_featured_cnt=$sb_featured_cnt,
			sb_site_keywords='$site_keywords',
			sb_null_char='$sb_null_char',
			sb_site_name='$site_name',
			sb_admin_email='$admin_email',
			sb_site_root='$site_root',
			sb_signup_verification='$sb_signup_verification',
			sb_image_size=$sb_image_size,
			sb_cat_listing='$sb_cat_listing',
			sb_logo='$sb_logo'
		where sb_id=1";
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_general.php?msg=".urlencode("Site parameters have been updated"));
	die();
}
else
{
	header("Location:"."settings_general.php?msg=".urlencode("Unable to update site parameters, please try again"));
	die();
}
?>