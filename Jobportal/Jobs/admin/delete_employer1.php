<?
include_once "logincheck.php";
include_once "myconnect.php";
$id=$_REQUEST["id"];

$rs_query=mysql_query("select * from sbjbs_jobs where sb_uid=$id");
while($rst=mysql_fetch_array($rs_query))
{
mysql_query("delete from sbjbs_job_cats where sb_job_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_job_locs where sb_job_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_job_skls where sb_job_id=".$rst["sb_id"]);
mysql_query("delete from sbjbs_applications where sb_job_id=".$rst["sb_id"]);
}

mysql_query("delete from sbjbs_jobs where sb_uid=$id");
mysql_query("delete from sbjbs_companies where sb_uid=$id");

mysql_query("delete from sbjbs_premium_gallery where sb_emp_id=$id");

mysql_query("delete from sbjbs_employers where sb_id=$id");

$msg=urlencode("Employer has been deleted successfully");
header("Location:"."employers.php?msg=$msg");
die();

?>