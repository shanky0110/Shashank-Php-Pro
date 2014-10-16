<?
include_once "logincheck.php"; 
include_once "myconnect.php";
///////////////////////////////////////////////////////////////////////////////
///      THE CODE OF THIS SCRIPT HAS BEEN DEVELOPED BY SOFTBIZ SOLUTIONS  /////
///      AND IS MEANT TO BE USED ON THIS SITE ONLY AND IS NOT FOR REUSE,  /////
///      RESALE OR REDISTRIBUTION.                                        ///// 
///      IF YOU NOTICE ANY VIOLATION OF ABOVE PLEASE REPORT AT:           /////
///      admin@softbizscripts.com                                         /////
///      http://www.softbizscripts.com                                    /////
///      http://www.softbizsolutions.com                                  /////  
///////////////////////////////////////////////////////////////////////////////
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
$id=$rs0["sb_icon_list"];
if(isset($_REQUEST["id"]))
{
$id=$_REQUEST["id"];
}
//echo "select * from sbjbs_icons where id=$id";
$icon=mysql_fetch_array(mysql_query("select * from sbjbs_icons where sb_id=$id"));
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function sb_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<script language="JavaScript">

function attachment(box)
{
	str="fileupload1.php?box="  + box;
	sbwin=window.open(str,"Attachment","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=550,height=450,location=no,directories=no,scrollbars=yes");
	sbwin.focus();
}
					
					function removeattachment1(box)
					{
					window.document.form123.list1.value="";
					}
					
					function removeattachment2(box)
					{
					window.document.form123.list2.value="";
					}
					
					function removeattachment3(box)
					{
					window.document.form123.list3.value="";
					}
					
					function removeattachment4(box)
					{
					window.document.form123.list4.value="";
					}
					
					function removeattachment5(box)
					{
					window.document.form123.list5.value="";
					}
					
					function removeattachment6(box)
					{
					window.document.form123.list6.value="";
					}
					

	function validate(form)
	{
	if(form.title.value=="")
	{
	alert('Please enter Title');
	
	return false;
	}
	if(form.list1.value=="")
	{
	alert('Please choose an icon for Apply Now Button');
	return false;
	}
	if(form.list2.value=="")
	{
	alert('Please choose an icon for Join Now');
	return false;
	}
	if(form.list3.value=="")
	{
	alert('Please choose an icon View Company Profile Button');
	return false;
	}
	if(form.list4.value=="")
	{
	alert('Please choose an icon for Refer to Friend Button');
	return false;
	}
	if(form.list5.value=="")
	{
	alert('Please choose an icon for Title Bar Bullet');
	return false;
	}
	/*if(form.list6.value=="")
	{
	alert('Please choose an icon for Member Option Bullet');
	return false;
	}*/
	return true;
	}
</script>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="0">
              <tr> 
                <td valign="top"> <table width="100%" height="20" border="0" cellpadding="0" cellspacing="3">
                    <tr> 
                      <td valign="top"> <div align="center">
                          <form name="form123" method="post" action="insert_icons.php" onSubmit="return validate(this);" >
                            <table width="100%" border="0" cellspacing="10" cellpadding="2">
                              <tr valign="middle" bgcolor="#004080"> 
                                <td height="25" colspan="3"> <div align="left"><font size="3" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF" size="2"><strong>Add/Edit 
                                    Site Icons</strong></font></font></div></td>
                              </tr>
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Pick 
                                    Icon List:</font></strong></div></td>
                                <td>&nbsp;</td>
                                <td><select name="icon_list" onChange="sb_jumpMenu('parent',this,0)" >
                                    <option value="site_icons.php?id=0" selected>Add 
                                    New</option>
                                    <?
								$rs_query=mysql_query("select * from sbjbs_icons");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                                    <option value="site_icons.php?id=<? echo $rst["sb_id"];?>" <? if($id==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_title"];?></option>
                                    <?
                                }
								  ?>
                                  </select></td>
                              </tr>
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Title:</font></strong></div></td>
                                <td>&nbsp;</td>
                                <td><input name="title" type="text" id="title2" value="<? echo $icon["sb_title"];?>"> 
                                  <input name="id" type="hidden" id="id3" value="<? echo $id;?>"> 
                                </td>
                              </tr>
                              <tr valign="top"> 
                                <td colspan="3" bgcolor="#F5F5F5"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Note: 
                                    Changes will be visible only after saving 
                                    the scheme.</font></div></td>
                              </tr>
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Apply 
                                    Now Button: </font></strong></div></td>
                                <td width="6%"> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_apply_now"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td width="66%"><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list1" type = "text" id="list1" value="<? echo $icon["sb_apply_now"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name2 value="Upload" onClick=attachment('list1')>
                                  <input type=BUTTON name=buttonname2 value="Remove" onClick=removeattachment1('list1')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr>
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Join Now Button:</font></strong></div></td>
                                <td> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_join_now"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list2" type = "text" id="list2" value="<? echo $icon["sb_join_now"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name23 value="Upload" onClick=attachment('list2')>
                                  <input type=BUTTON name=buttonname23 value="Remove" onClick=removeattachment2('list2')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr>
                              <tr valign="top"> 
                                <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">View 
                                    Company Profile Button: </font></strong></div></td>
                                <td> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_profile"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list3" type = "text" id="list3" value="<? echo $icon["sb_profile"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name24 value="Upload" onClick=attachment('list3')>
                                  <input type=BUTTON name=buttonname24 value="Remove" onClick=removeattachment3('list3')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr>
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Refer 
                                    to Friend Button: </font></strong></div></td>
                                <td> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_refer_friend"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list4" type = "text" id="list4" value="<? echo $icon["sb_refer_friend"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name25 value="Upload" onClick=attachment('list4')>
                                  <input type=BUTTON name=buttonname25 value="Remove" onClick=removeattachment4('list4')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr>
                              <tr valign="top"> 
                                <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Title 
                                    Bar Bullet:</font></strong></div></td>
                                <td> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_bar"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list5" type = "text" id="list5" value="<? echo $icon["sb_bar"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name29 value="Upload" onClick=attachment('list5')>
                                  <input type=BUTTON name=buttonname29 value="Remove" onClick=removeattachment5('list5')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr>
                              <!--tr valign="top"> 
                                <td bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Member 
                                    Options Bullet:</font></strong></div></td>
                                <td> 
                                  <? if($id<>0)
								{
								?>
                                  <div align="center"><img src="sbjbs_icons/<? echo $icon["sb_mem_opt"];?>"> 
                                    <?
								}
								?>
                                  </div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif" color="#666666"> 
                                  <input name = "list6" type = "text" id="list6" value="<? echo $icon["sb_mem_opt"];?>" size="20" readOnly >
                                  <input type=BUTTON name=btn_name29 value="Attach" onClick=attachment('list6')>
                                  <input type=BUTTON name=buttonname29 value="Remove" onClick=removeattachment6('list6')>
                                  </font><font size="2" face="Arial, Helvetica, sans-serif">&nbsp; 
                                  </font></td>
                              </tr-->
                              <tr valign="top"> 
                                <td width="40%" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    </font></strong></div></td>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="Submit" value="Save Scheme"></td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?
}//main()
include "template.php";
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
