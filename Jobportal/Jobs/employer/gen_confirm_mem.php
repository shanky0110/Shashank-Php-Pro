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
          <td width="102%" colspan="2"><strong><?php echo $_REQUEST["errmsg"];?></strong></td>
        </tr>
        <?php
		if(isset($_REQUEST["err"])&&($_REQUEST["err"]<>""))
		{
		 $return_path=$_REQUEST["err"].".php";
		 if(isset($_REQUEST["id"])&&($_REQUEST["id"]<>""))
		 { $return_path.="?sb_id=".$_REQUEST["id"];} 
		
        ?>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left"> Click <a href="<?php echo $return_path;?>">here</a> 
            to try again.</td>
        </tr>
        <?php
		}
	
 ?>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left"> Click <a href="emp_home.php">here</a> to goto employer 
            home. </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="myaccount.php">here</a> to view financial 
            account information. </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="manage_jobs.php">here</a> to manage 
            job offers. </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="editemployer.php">here</a> to edit personal 
            profile. </td>
        </tr>
        <tr> 
          <td align="center">&nbsp;</td>
          <td align="left">Click <a href="logout.php">here</a> to logout. </td>
        </tr>
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