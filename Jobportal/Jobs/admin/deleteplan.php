<?php
include_once("logincheck.php");
include_once("myconnect.php");

$sql1="DELETE FROM sbjbs_plans  where id=" . $_REQUEST["id"];

mysql_query($sql1 );
if(mysql_affected_rows() == 1)
	header("Location: ". "plans.php?msg=" .urlencode("Plan has been removed") );
else
	header("Location: ". "plans.php?msg=" .urlencode("Unable to remove, please try again") );
die();
?>