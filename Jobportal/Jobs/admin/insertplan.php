<?
include_once("logincheck.php");
include_once("myconnect.php");

			if (!get_magic_quotes_gpc()) {
			$credits=str_replace('$', '\$',addslashes($_REQUEST["credits"]));
			$price=str_replace('$', '\$',addslashes($_REQUEST["price"]));
			}
			else
			{
			$credits=str_replace('$', '\$',$_REQUEST["credits"]);
			$price=str_replace('$', '\$',$_REQUEST["price"]);
			}
$sql1="insert into sbjbs_plans (credits,price) Values(" .
" " .$credits . ","  .
" " .$price . ")";
mysql_query($sql1 );
if(mysql_affected_rows() == 1)
	header("Location: ". "plans.php?id=".$_REQUEST["id"]."&msg=".urlencode("New plan has been added"));
else
	header("Location: ". "plans.php?&msg=".urlencode("Unable to add new plan"));
 
die();

?>