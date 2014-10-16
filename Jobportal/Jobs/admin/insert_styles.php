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
$page_bg=str_replace('$', '\$',addslashes($_REQUEST["page_bg"]));
$table_bg=str_replace('$', '\$',addslashes($_REQUEST["table_bg"]));
$normal_table_bg=str_replace('$', '\$',addslashes($_REQUEST["normal_table_bg"]));
$seperator=str_replace('$', '\$',addslashes($_REQUEST["seperator"]));
$title_bg=str_replace('$', '\$',addslashes($_REQUEST["title_bg"]));
//$title_font=str_replace('$', '\$',addslashes($_REQUEST["title_font"]));
$title_font_color=str_replace('$', '\$',addslashes($_REQUEST["title_font_color"]));
//$title_font_size=str_replace('$', '\$',addslashes($_REQUEST["title_font_size"]));
$normal_font=str_replace('$', '\$',addslashes($_REQUEST["normal_font"]));
$normal_font_color=str_replace('$', '\$',addslashes($_REQUEST["normal_font_color"]));
$normal_font_size=str_replace('$', '\$',addslashes($_REQUEST["normal_font_size"]));
//$tb_font_size=str_replace('$', '\$',addslashes($_REQUEST["tb_font_size"]));
//$tb_font=str_replace('$', '\$',addslashes($_REQUEST["tb_font"]));
$side_title_font_color=str_replace('$', '\$',addslashes($_REQUEST["side_title_font_color"]));
$link_font_size=str_replace('$', '\$',addslashes($_REQUEST["link_font_size"]));
$link_font_color=str_replace('$', '\$',addslashes($_REQUEST["link_font_color"]));
$link_font=str_replace('$', '\$',addslashes($_REQUEST["link_font"]));
$inner_table_bg=str_replace('$', '\$',addslashes($_REQUEST["inner_table_bg"]));
$sub_title_bg=str_replace('$', '\$',addslashes($_REQUEST["sub_title_bg"]));
$side_title_bg=str_replace('$', '\$',addslashes($_REQUEST["side_title_bg"]));
$highlighted=str_replace('$', '\$',addslashes($_REQUEST["highlighted"]));
$highlighted1=str_replace('$', '\$',addslashes($_REQUEST["highlighted1"]));
}
else
{
$title=str_replace('$', '\$',$_REQUEST["title"]);
$page_bg=str_replace('$', '\$',$_REQUEST["page_bg"]);
$table_bg=str_replace('$', '\$',$_REQUEST["table_bg"]);
$normal_table_bg=str_replace('$', '\$',$_REQUEST["normal_table_bg"]);
$seperator=str_replace('$', '\$',$_REQUEST["seperator"]);
$title_bg=str_replace('$', '\$',$_REQUEST["title_bg"]);
//$title_font=str_replace('$', '\$',$_REQUEST["title_font"]);
$title_font_color=str_replace('$', '\$',$_REQUEST["title_font_color"]);
//$title_font_size=str_replace('$', '\$',$_REQUEST["title_font_size"]);
$normal_font=str_replace('$', '\$',$_REQUEST["normal_font"]);
$normal_font_color=str_replace('$', '\$',$_REQUEST["normal_font_color"]);
$normal_font_size=str_replace('$', '\$',$_REQUEST["normal_font_size"]);
//$tb_font_size=str_replace('$', '\$',$_REQUEST["tb_font_size"]);
//$tb_font=str_replace('$', '\$',$_REQUEST["tb_font"]);
$side_title_font_color=str_replace('$', '\$',$_REQUEST["side_title_font_color"]);
$link_font_size=str_replace('$', '\$',$_REQUEST["link_font_size"]);
$link_font_color=str_replace('$', '\$',$_REQUEST["link_font_color"]);
$link_font=str_replace('$', '\$',$_REQUEST["link_font"]);
$inner_table_bg=str_replace('$', '\$',$_REQUEST["inner_table_bg"]);
$sub_title_bg=str_replace('$', '\$',$_REQUEST["sub_title_bg"]);
$side_title_bg=str_replace('$', '\$',$_REQUEST["side_title_bg"]);
$highlighted=str_replace('$', '\$',$_REQUEST["highlighted"]);
$highlighted1=str_replace('$', '\$',$_REQUEST["highlighted1"]);
}
$id=$_REQUEST["id"];
if($id==0)
{
mysql_query("insert into sbjbs_styles
(sb_title,sb_page_bg,sb_table_bg,sb_normal_table_bg,sb_seperator,sb_title_bg,sb_title_font_color,sb_normal_font,sb_normal_font_color,sb_normal_font_size,sb_side_title_font_color,sb_link_font_size,sb_link_font_color,sb_link_font,sb_inner_table_bg,sb_sub_title_bg,sb_side_title_bg,sb_highlighted,sb_highlighted1) 
values
('$title','$page_bg','$table_bg','$normal_table_bg','$seperator','$title_bg','$title_font_color','$normal_font','$normal_font_color','$normal_font_size','$side_title_font_color','$link_font_size','$link_font_color','$link_font','$inner_table_bg','$sub_title_bg','$side_title_bg','$highlighted','$highlighted1')");
$id=mysql_insert_id();
}
else
{
mysql_query("update sbjbs_styles set
sb_title='$title',
sb_page_bg='$page_bg',
sb_table_bg='$table_bg',
sb_normal_table_bg='$normal_table_bg',
sb_seperator='$seperator',
sb_title_bg='$title_bg',
sb_title_font_color='$title_font_color',
sb_normal_font='$normal_font',
sb_normal_font_color='$normal_font_color',
sb_normal_font_size='$normal_font_size',
sb_side_title_font_color='$side_title_font_color',
sb_link_font_size='$link_font_size',
sb_link_font_color='$link_font_color',
sb_link_font='$link_font',
sb_inner_table_bg='$inner_table_bg',
sb_sub_title_bg='$sub_title_bg' ,
sb_side_title_bg='$side_title_bg',
sb_highlighted='$highlighted',
sb_highlighted1='$highlighted1'
where sb_id=$id");

}
header("Location:"."site_styles.php?id=$id&msg=".urlencode("You have successfully saved a style "));
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