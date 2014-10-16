<?php
include_once "../session.php";
include_once "../myconnect.php";

if(isset($_SESSION["sbjbs_emp_userid"])&&($_SESSION["sbjbs_emp_userid"]<>""))
{
	header("Location: gen_confirm.php?errmsg=".urlencode('You are already logged in as '.$_SESSION["sbjbs_emp_username"]));
	die();
}

function main()
{
?>
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" class="msgstyle">
  <tr align="left"> 
    <td colspan="2"><strong>Welcome to the employer's area<?php //echo $_SESSION["sbjbs_emp_username"];?>, you have successfully logged-in.</strong></td>
  </tr>
  <?
	if(isset($_REQUEST["return_path"]) && ($_REQUEST["return_path"]<>""))
	{
		$return_path=$_REQUEST["return_path"]."?sb_id=".$_REQUEST["id"]."&sb_type=".$_REQUEST["sb_type"];
  ?>
  <tr> 
    <td width="2%" align="center">&nbsp;</td>
    <td width="100%" align="left"> Click <a href="<?php echo $return_path;?>">here</a> 
      <?php
		if(preg_match("/\/cart_items.php/",$_REQUEST["return_path"]))
		{ echo " to view your inquiry basket.";}
		elseif(preg_match("/\/add_favorites.php/",$_REQUEST["return_path"]))
		{ echo " to add offers/profiles to your favorite list.";}
		elseif(preg_match("/\/addtocart.php/",$_REQUEST["return_path"]))
		{ echo " to add offers/products to your inquiry basket.";}
		elseif(preg_match("/\/contactuser.php/",$_REQUEST["return_path"]))
		{ echo " to send inquiries to member.";}
		else
		{ echo " to continue";}
    ?>
    </td>
  </tr>
  <?
  	}
	if($_REQUEST["sb_type"]<>0)
	{
  		switch($_REQUEST["sb_type"])
		{
			case 1:
				$return_path="view_offer.php?id=".$_REQUEST["id"];
				break;
			case 2:
				$return_path="view_offer_buy.php?id=".$_REQUEST["id"];
				break;
			case 3:
				$return_path="view_product.php?id=".$_REQUEST["id"];
				break;
			case 4:
				$return_path="view_profile.php?id=".$_REQUEST["id"];
				break;
		}

  ?>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left">Click <a href="<?php echo $return_path;?>">here</a> to view offer/profile detail page. 
    </td>
  </tr><?php
  	}
  ?><tr> 
    <td align="center">&nbsp;</td>
    <td align="left">Click <a href="emp_home.php">here</a> to go to member area. 
    </td>
  </tr>
  <tr> 
    <td align="center">&nbsp;</td>
    <td align="left">Click <a href="logout.php">here</a> to logout. </td>
  </tr>
</table>
<?
}		//end main

if(!isset($_REQUEST['username']) || ($_REQUEST['username']=="") || !isset($_REQUEST['pwd']) || ($_REQUEST['pwd']=="") )
{
	header("Location: signin_emp.php?errmsg=".urlencode("Please enter login information."));
	die();
}

if (!get_magic_quotes_gpc()) 
{
	$username=str_replace('$', '\$',addslashes($_REQUEST["username"]));
	$pwd=str_replace('$', '\$',addslashes($_REQUEST["pwd"]));
}
else
{
	$username=str_replace('$', '\$',$_REQUEST["username"]);
	$pwd=str_replace('$', '\$',$_REQUEST["pwd"]);
}
			

$sql = "SELECT * FROM sbjbs_employers WHERE sb_username = '$username' AND sb_password = '$pwd'" ;

$rs_query=mysql_query($sql);
if ( $rs=mysql_fetch_array($rs_query)  )
{
	if($rs["sb_suspended"]=="no")
	{
		if($rs["sb_password"]===$_REQUEST['pwd'])
		{
			$_SESSION["sbjbs_emp_username"]=$rs["sb_username"] ;
			$_SESSION["sbjbs_emp_userid"]=$rs["sb_id"] ;
		//	$_SESSION["sbjbs_emp_memtype"]=$rs["sb_memtype"];
			
			mysql_query("update sbjbs_employers set sb_last_login='".date("YmdHis",time())."' where sb_id=".$rs["sb_id"]);
			include_once "template.php";
			die();
		}
	}//not suspended
	else
	{
		header("Location: gen_confirm.php?errmsg=". urlencode("Your Account has been suspended by Admin.") );
		die();
	}
}

header("Location: signin_emp.php?errmsg=".urlencode("Please enter correct login information."));
die();
?>