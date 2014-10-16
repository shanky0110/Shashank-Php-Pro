<?php

include_once "session.php";  

if (!isset($_SESSION["softbiz_jbs_adminid"]))
{
	header("Location: index.php?msg=" .urlencode("You must be logged to access this page!") );
	die();
}
?>