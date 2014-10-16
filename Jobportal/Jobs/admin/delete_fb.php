<?
include_once "logincheck.php"; 
include_once "myconnect.php";

mysql_query("DELETE  from sbjbs_feedback Where sb_id= ".$_REQUEST["id"]);

header("Location:"."feedback.php?msg=".urlencode("You have successfully removed the feedback entry."));
die();
?>