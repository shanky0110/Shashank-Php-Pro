<?
include "logincheck.php";
include_once "myconnect.php";
function main()
{
$rs0=mysql_fetch_array(mysql_query("select * from sbjbs_config"));
?>
<script language="JavaScript">
function Validator(form)
{
/*if(isNaN(form.th_width.value) || (form.th_width.value<=0)||(form.th_width.value==""))
{
alert ('Enter a non negative numeric value for thumbnail width!');
form.th_width.focus();
return false;
}
if(isNaN(form.th_width2.value) || (form.th_width2.value<=0)||(form.th_width2.value==""))
{
alert ('Enter a non negative numeric value for thumbnail width2!');
form.th_width2.focus();
return false;
}*/
	return true;
}

</script>
<form action="update_layout_set.php" method="post" name="frm1" id="frm1"  onSubmit="return Validator(this);" >
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr> 
      <td valign="top">
<table width="100%" border="0" cellspacing="10" cellpadding="2">
          <tr> 
            <td height="25" colspan="3" bgcolor="#004080"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">&nbsp;Config 
              Layout Parameters</font></strong></td>
          </tr>
          <!--tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Thumbnail 
              Width:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font size="1" face="Arial, Helvetica, sans-serif"> 
              <input name="th_width" type="text" class="box1" id="th_width" value="<? echo $rs0["sb_th_width"];?>" size=" 7">
              pixels<br>
              This will control the width of thumbnails. </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Thumbnail 
              Width 2:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font size="1" face="Arial, Helvetica, sans-serif"> 
              <input name="th_width2" type="text" class="box1" id="th_width2" value="<? echo $rs0["sb_th_width2"];?>" size=" 7">
              pixels<br>
              This will control the width of thumbnails. </font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Image 
              Magik :</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input type="radio" name="im_status" value="enable" <?
			  if($rs0["sb_image_magik"]=="enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Enabled 
              <input type="radio" name="im_status" value="disable" <?
			  if($rs0["sb_image_magik"]<>"enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Disabled </font></font><font size="1" face="Arial, Helvetica, sans-serif"><br>
              Some functions of the site depend on these settings, contact your 
              web host regarding this.</font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Water 
              Marking:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><font face="Arial, Helvetica, sans-serif"> <font size="2"> 
              <input type="radio" name="water_mark" value="enable" <?
			  if($rs0["sb_water_marking"]=="enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Enabled 
              <input type="radio" name="water_mark" value="disable" <?
			  if($rs0["sb_water_marking"]<>"enable")
			  {
			  echo " checked";
			  }
			  ?>>
              Disabled </font></font><font size="1" face="Arial, Helvetica, sans-serif"><br>
              Relevant if Image Magick is enabled.</font></td>
          </tr-->
          <tr valign="top"> 
            <td width="48%" align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Choose 
              Icons:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td width="52%"><select name="icon_list" id="icon_list">
                <?
								$rs_query=mysql_query("select * from sbjbs_icons");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                <option value="<? echo $rst["sb_id"];?>" <? if($rs0["sb_icon_list"]==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_title"];?></option>
                <?
                                }
								  ?>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the icons for the Front end. You can Add more 
              and edit existing icons in Site Icons Section.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Choose 
              Style:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="style_list">
                <?
								$rs_query=mysql_query("select * from sbjbs_styles");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                <option value="<? echo $rst["sb_id"];?>" <? if($rs0["sb_style_list"]==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_title"];?></option>
                <?
                                }
								  ?>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the color scheme for the Front end. You can Add 
              more and edit existing style in Site Styles Section.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Date 
              Format:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="date_format" id="date_format">
                <?
								$rs_query=mysql_query("select * from sbjbs_dateformats order by sb_id desc");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                <option value="<? echo $rst["sb_id"];?>" <? if($rs0["sb_date_format"]==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_format"];?></option>
                <?
                                }
								  ?>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the date string format for displaying date on 
              the site.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Time 
              Format:</font></strong></td>
            <TD align=left class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
            <td><select name="time_format" id="time_format">
                <?
								$rs_query=mysql_query("select * from sbjbs_timeformats order by sb_id desc");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                <option value="<? echo $rst["sb_id"];?>" <? if($rs0["sb_time_format"]==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_format"];?></option>
                <?
                                }
								  ?>
              </select> <font size="2" face="Arial, Helvetica, sans-serif"><font size="1"></font></font><font size="2" face="Arial, Helvetica, sans-serif"><font size="1"><br>
              This will control the time string format for displaying time on 
              the site.</font></font></td>
          </tr>
          <tr valign="top"> 
            <td align="right" bgcolor="#F5F5F5" class="row1">&nbsp;</td>
            <td>&nbsp;</td>
            <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="Submit2" type="submit" class="submit" value="Update">
              </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </form>

<?
}// end main
include "template.php";?>