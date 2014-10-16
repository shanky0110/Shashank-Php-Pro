<?php
include_once "../myconnect.php";

//--------------------------------------------------------------------------------------//
// uncomment the following code while integration with paypal and comment out headers   //
//--------------------------------------------------------------------------------------//


//if (   isset($_REQUEST["payment_status"])  &&  isset($_REQUEST["custom"])  &&  isset($_REQUEST["item_number"]) &&  isset($_REQUEST["amount"]) )
{

//////////// IT WAS AN ADD MONEY REQUEST //////////////
//if (   ($_REQUEST["payment_status"]=="Completed")  && ($_REQUEST["item_number"]=="A1")  )
{
$amount=$_REQUEST["amount"];
$description="Money added through paypal";
mysql_query("insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values
(".$_REQUEST["custom"].", $amount, '$description', '".date("YmdHis",time())."')");
}
header("Location:"."myaccount.php");
die();
//////////////// MONEY ADDED ///////////////////////
}
?>