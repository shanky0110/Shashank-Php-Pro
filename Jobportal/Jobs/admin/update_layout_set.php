<?
include "logincheck.php";
include_once "myconnect.php";

			if (!get_magic_quotes_gpc()) {
			$icon_list=str_replace('$', '\$',addslashes($_REQUEST["icon_list"]));
			$style_list=str_replace('$', '\$',addslashes($_REQUEST["style_list"]));
			$date_format=str_replace('$', '\$',addslashes($_REQUEST["date_format"]));
			$time_format=str_replace('$', '\$',addslashes($_REQUEST["time_format"]));
			/*$th_width=str_replace('$', '\$',addslashes($_REQUEST["th_width"]));
			$th_width2=str_replace('$', '\$',addslashes($_REQUEST["th_width2"]));
			*/}
			else
			{
			$icon_list=str_replace('$', '\$',$_REQUEST["icon_list"]);
			$style_list=str_replace('$', '\$',$_REQUEST["style_list"]);
			$date_format=str_replace('$', '\$',$_REQUEST["date_format"]);
			$time_format=str_replace('$', '\$',$_REQUEST["time_format"]);
			/*$th_width=str_replace('$', '\$',$_REQUEST["th_width"]);
			$th_width2=str_replace('$', '\$',$_REQUEST["th_width2"]);
			*/}

		/*$image_magik=$_REQUEST["im_status"];
		$water_marking=$_REQUEST["water_mark"];*/
$sql="update sbjbs_config set
			sb_icon_list='$icon_list',
			sb_style_list='$style_list',
			sb_date_format='$date_format',
			sb_time_format='$time_format' where sb_id=1";
			//,	sb_th_width='$th_width',sb_th_width2='$th_width2',	sb_image_magik='$image_magik',		sb_water_marking='$water_marking'
		
//die ($sql);
mysql_query($sql);

if(mysql_affected_rows() == 1)
{
	header("Location:"."settings_layout.php?msg=".urlencode("Layout parameters have been updated"));
	die();
}
else
{
	header("Location:"."settings_layout.php?msg=".urlencode("Unable to update layout parameters, please try again"));
	die();
}
?>