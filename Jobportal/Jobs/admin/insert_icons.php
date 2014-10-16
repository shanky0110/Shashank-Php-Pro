<?php
include_once "logincheck.php";
include_once "myconnect.php";
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////
if (!get_magic_quotes_gpc()) {
$title=str_replace('$', '\$',addslashes($_REQUEST["title"]));
$apply_now=str_replace('$', '\$',addslashes($_REQUEST["list1"]));
$join_now=str_replace('$', '\$',addslashes($_REQUEST["list2"]));
$refer_friend=str_replace('$', '\$',addslashes($_REQUEST["list4"]));
$profile=str_replace('$', '\$',addslashes($_REQUEST["list3"]));
$bar=str_replace('$', '\$',addslashes($_REQUEST["list5"]));
//$mem_opt=str_replace('$', '\$',addslashes($_REQUEST["list6"]));
}
else
{
$title=str_replace('$', '\$',$_REQUEST["title"]);
$apply_now=str_replace('$', '\$',$_REQUEST["list1"]);
$join_now=str_replace('$', '\$',$_REQUEST["list2"]);
$refer_friend=str_replace('$', '\$',$_REQUEST["list4"]);
$profile=str_replace('$', '\$',$_REQUEST["list3"]);
$bar=str_replace('$', '\$',$_REQUEST["list5"]);
//$mem_opt=str_replace('$', '\$',$_REQUEST["list6"]);
}
$id=$_REQUEST["id"];
if($id==0)
{
mysql_query("insert into sbjbs_icons 
(sb_title,sb_apply_now,sb_join_now,sb_refer_friend,sb_profile,sb_bar) 
values
('$title','$apply_now','$join_now','$refer_friend','$profile','$bar')");//,sb_mem_opt,'$mem_opt'

$id=mysql_insert_id();

}
else
{
mysql_query("update sbjbs_icons set
sb_title='$title',
sb_apply_now='$apply_now',
sb_join_now='$join_now',
sb_refer_friend='$refer_friend',
sb_profile='$profile',
sb_bar='$bar' where sb_id=$id");//,sb_mem_opt='$mem_opt'

}
//


header("Location:"."site_icons.php?id=$id&msg=".urlencode("You have successfully saved an icon list"));
die();
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////


?>