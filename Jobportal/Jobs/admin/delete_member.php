<?
include_once "logincheck.php";
include_once "myconnect.php";
$id=$_REQUEST["id"];

$rs_query=mysql_query("select * from sbjbs_resumes where sb_seeker_id=$id");
while($rst=mysql_fetch_array($rs_query))
{
mysql_query("delete from sbjbs_resume_cats where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_resume_locs where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_experience where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_references where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_education where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_affiliations where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_resume_skills where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_resume_language where sb_resume_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_applications where sb_resume_id=".$rst["sb_id"]);

}
mysql_query("delete from sbjbs_resumes where sb_seeker_id=$id");
mysql_query("delete from sbjbs_cover_letters where sb_seeker_id=$id");
mysql_query("delete from sbjbs_applications where sb_seeker_id=$id");
mysql_query("delete from sbjbs_search_results where sb_uid=$id");
mysql_query("delete from sbjbs_seekers where sb_id=$id");

$msg=urlencode("Member has been deleted successfully");
header("Location:"."members.php?msg=$msg");
die();
?>