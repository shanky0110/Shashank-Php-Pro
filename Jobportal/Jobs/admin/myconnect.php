<?php
define("SBCURRENCY","$");

// YOU NEED TO CHANGE THE CONTENTS OF THE values of variables given in single quotes

//CONFIGURATION SECTION STARTS ///

$servername='localhost' ;  // Replace this 'localhost' with your server name 
$database_username='e_novative'; // Replace this  with your username 
$database_password='e_novative';  // Replace this  with your password
$database_name='SoftbizJobsAndRecruitmentScript';  // Replace this 'db' with your database name

// CONFIGURATION SECTION ENDS ////



mysql_connect($servername,$database_username,$database_password);
mysql_select_db($database_name);

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