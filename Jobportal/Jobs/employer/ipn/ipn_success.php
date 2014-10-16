<?php
/*
 * ipn_success.php
 *
 * PHP Toolkit for PayPal v0.50
 * http://www.paypal.com/pdn
 *
 * Copyright (c) 2004 PayPal Inc
 *
 * Released under Common Public License 1.0
 * http://opensource.org/licenses/cpl.php
 *
*/

//log successful transaction to file or database
include_once('global_config.inc.php'); 
include_once "../../myconnect.php";

$config=mysql_fetch_array(mysql_query("select * from sbjbs_config"));

//create_csv_file("logs/ipn_success.txt",$_POST);
if (   isset($_REQUEST["payment_status"])  &&  isset($_REQUEST["custom"])  &&  isset($_REQUEST["item_number"]) &&  isset($_REQUEST["mc_gross"]) && isset($_REQUEST["receiver_email"]) && ($_REQUEST["receiver_email"]==$config["sb_paypal_id"]))
{

//////////// IT WAS AN ADD MONEY REQUEST //////////////
if (   ($_REQUEST["payment_status"]=="Completed")  && ($_REQUEST["item_number"]=="P1")  )
{
$amount=str_replace("'","''",$_REQUEST["mc_gross"]);
$description="Money added through paypal";
mysql_query("insert into sbjbs_transactions (sb_uid, sb_amount, sb_description, sb_date_submitted) values
(".$_REQUEST["custom"].", $amount, '$description', '".date("YmdHis",time())."')");
}
//////////////// MONEY ADDED ///////////////////////

}

?> 