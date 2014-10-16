<?

include_once "logincheck.php";
include_once "myconnect.php";
 
			if (!get_magic_quotes_gpc()) {
			$credits=str_replace('$', '\$',addslashes($_REQUEST["credits"]));
			$price=str_replace('$', '\$',addslashes($_REQUEST["price"]));
			}
			else
			{
			$credits=str_replace('$', '\$',$_REQUEST["credits"]);
			$price=str_replace('$', '\$',$_REQUEST["price"]);
			}
mysql_query("UPDATE sbjbs_plans SET credits='".$credits."' ,  price='".$price."' Where id= ".$_REQUEST["id"]); 
if(mysql_affected_rows() == 1)
	header("Location:"."plans.php?&msg=".urlencode("Plan has been updated"));
else
	header("Location:"."plans.php?&msg=".urlencode("Unable to update plan"));
die();
?>