<?php
function main()
{

?>
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr> 
    <td></td>
  </tr>
  <tr height="20"> 
    <td ></td>
  </tr><?php
  if(isset($_REQUEST["errmsg"])&&($_REQUEST["errmsg"]<>""))
  {
  ?><tr>
    <td>        
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="msgstyle">
        <tr align="left"> 
          <td colspan="2"><strong><?php echo $_REQUEST["errmsg"];?></strong></td>
        </tr>
        <?php
		if(isset($_REQUEST["err"])&&($_REQUEST["err"]<>""))
		{
		 $return_path=$_REQUEST["err"].".php"; 
		
        ?>
        <tr> 
          <td width="3%" align="center">&nbsp;</td>
          <td width="97%" align="left"> Click <a href="<?php echo $return_path;?>">here</a> 
            to try again.</td>
        </tr>
        <?php
		} 
		if(isset($_REQUEST["sb_type"])&&($_REQUEST["sb_type"]<>0))
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
          <td align="left">Click <a href="<?php echo $return_path;?>">here</a> 
            to view offer/profile detail page. </td>
        </tr>
        <?php
  }

        ?>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="signin_emp.php">here</a> to login as 
            employer. </td>
        </tr>
        <?php
		if(isset($_SESSION["sbjbs_emp_userid"]))
		{
        ?>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="emp_home.php">here</a> to go to member 
            area. </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="logout.php">here</a> to logout. </td>
        </tr>
        <?
		}
      ?>
      </table>
      
    </td>
  </tr><?php
  }
  ?><tr> 
    <td> <div align="center"> </div></td>
  </tr>
</table>
  
<? 
}// end of main()
include "template.php";
?>