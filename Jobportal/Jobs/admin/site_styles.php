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
$id=$rs0["sb_style_list"];
if(isset($_REQUEST["id"]))
{
$id=$_REQUEST["id"];
}
//echo "select * from sbjbs_styles where id=$id";
$style=mysql_fetch_array(mysql_query("select * from sbjbs_styles where sb_id=$id"));
?>
<script language="JavaScript">

		function openpopup(pg)
		{
		window.open(pg,"win","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=600,height=500,location=no,directories=no,scrollbars=yes");
		return false;
		}

	function validate(form)
	{
	if(form.title.value=="")
	{
	alert('Please enter Name of the Style');
	form.title.focus();
	return false;
	}
	if(form.page_bg.value=="")
	{
	alert('Please enter color for Page Background');
	form.page_bg.focus();
	return false;
	}
	if(form.table_bg.value=="")
	{
	alert('Please enter color for Main Table Background');
	form.table_bg.focus();
	return false;
	}
	if(form.seperator.value=="")
	{
	alert('Please enter color for Seperator');
	form.seperator.focus();
	return false;
	}
	if(form.title_bg.value=="")
	{
	alert('Please enter color for Title Background');
	form.title_bg.focus();
	return false;
	}
	if(form.title_font_color.value=="")
	{
	alert('Please enter Title Font Color');
	form.title_font_color.focus();
	return false;
	}
	if(form.normal_table_bg.value=="")
	{
	alert('Please enter color for Inner Table Background');
	form.normal_table_bg.focus();
	return false;
	}
	if(form.inner_table_bg.value=="")
	{
	alert('Please enter color for Inner Table Row Background');
	form.inner_table_bg.focus();
	return false;
	}
	if(form.sub_title_bg.value=="")
	{
	alert('Please enter color for Inner Table Row Background');
	form.sub_title_bg.focus();
	return false;
	}
	if(form.highlighted.value=="")
	{
	alert('Please enter color for Highlighted Row Background');
	form.highlighted.focus();
	return false;
	}
	if(form.highlighted1.value=="")
	{
	alert('Please enter color for Highlighted Row Background');
	form.highlighted1.focus();
	return false;
	}
	if(form.side_title_bg.value=="")
	{
	alert('Please enter Side Title Color');
	form.side_title_bg.focus();
	return false;
	}
	if(form.side_title_font_color.value=="")
	{
	alert('Please enter Side Title Font Color');
	form.side_title_font_color.focus();
	return false;
	}
	if(form.normal_font_color.value=="")
	{
	alert('Please enter Normal Text Style Color');
	form.normal_font_color.focus();
	return false;
	}
	if(form.link_font_color.value=="")
	{
	alert('Please enter Link Style Color');
	form.link_font_color.focus();
	return false;
	}
	
	return true;
	}
	function set_values(form)
	{
	form.title.value=form2.title.value;
	form.page_bg.value=form2.page_bg.value;
	form.table_bg.value=form2.table_bg.value;
	form.seperator.value=form2.seperator.value;
	form.title_bg.value=form2.title_bg.value;
	//form.title_font.value=form2.title_font.value;
	form.title_font_color.value=form2.title_font_color.value;
	//form.title_font_size.value=form2.title_font_size.value;
	form.normal_font.value=form2.normal_font.value;
	form.normal_font_size.value=form2.normal_font_size.value;
	form.normal_font_color.value=form2.normal_font_color.value;
	form.link_font.value=form2.link_font.value;
	form.link_font_size.value=form2.link_font_size.value;
	form.link_font_color.value=form2.link_font_color.value;
	form.normal_table_bg.value=form2.normal_table_bg.value;
	//form.tb_font.value=form2.tb_font.value;
	//form.tb_font_size.value=form2.tb_font_size.value;
	form.highlight_bg_color.value=form2.highlight_bg_color.value;
	form.stat_yes_color.value=form2.stat_yes_color.value;
	form.stat_no_color.value=form2.stat_no_color.value;
		}
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function sb_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<!--- COLOR PICKER HERE --->
<script language="Javascript">
     var perline = 9;
     var divSet = false;
     var curId;
     var colorLevels = Array('0', '3', '6', '9', 'C', 'F');
     var colorArray = Array();
     var ie = false;
     var nocolor = 'none';
	 if (document.all) { ie = true; nocolor = ''; }
	 function getObj(id) {
		if (ie) { return document.all[id]; } 
		else {	return document.getElementById(id);	}
	 }

     function addColor(r, g, b) {
     	var red = colorLevels[r];
     	var green = colorLevels[g];
     	var blue = colorLevels[b];
     	addColorValue(red, green, blue);
     }

     function addColorValue(r, g, b) {
     	colorArray[colorArray.length] = '#' + r + r + g + g + b + b;
     }
     
     function setColor(color) {
     	var link = getObj(curId);
     	var field = getObj(curId + 'field');
     	var picker = getObj('colorpicker');
     	field.value = color;
     	if (color == '') {
	     	link.style.background = nocolor;
	     	link.style.color = nocolor;
	     	color = nocolor;
     	} else {
	     	link.style.background = color;
	     	link.style.color = color;
	    }
     	picker.style.display = 'none';
	    eval(getObj(curId + 'field').title);
     }
        
     function setDiv() {     
     	if (!document.createElement) { return; }
        var elemDiv = document.createElement('div');
        if (typeof(elemDiv.innerHTML) != 'string') { return; }
        genColors();
        elemDiv.id = 'colorpicker';
	    elemDiv.style.position = 'absolute';
        elemDiv.style.display = 'none';
        elemDiv.style.border = '#000000 1px solid';
        elemDiv.style.background = '#FFFFFF';
        elemDiv.innerHTML = '<span style="font-family:Verdana; font-size:11px;">Pick a color: ' 
          	+ '(<a href="javascript:setColor(\'\');">No color</a>)<br>' 
        	+ getColorTable() 
        	+ '<center></center></span>';

        document.body.appendChild(elemDiv);
        divSet = true;
     }
     
     function pickColor(id) {
     	if (!divSet) { setDiv(); }
     	var picker = getObj('colorpicker');     	
		if (id == curId && picker.style.display == 'block') {
			picker.style.display = 'none';
			return;
		}
     	curId = id;
     	var thelink = getObj(id);
     	picker.style.top = getAbsoluteOffsetTop(thelink) + 20;
     	picker.style.left = getAbsoluteOffsetLeft(thelink);     
	picker.style.display = 'block';
     }
     
     function genColors() {
        addColorValue('0','0','0');
        addColorValue('3','3','3');
        addColorValue('6','6','6');
        addColorValue('8','8','8');
        addColorValue('9','9','9');                
        addColorValue('A','A','A');
        addColorValue('C','C','C');
        addColorValue('E','E','E');
        addColorValue('F','F','F');                                
			
        for (a = 1; a < colorLevels.length; a++)
			addColor(0,0,a);
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(a,a,5);

        for (a = 1; a < colorLevels.length; a++)
			addColor(0,a,0);
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(a,5,a);
			
        for (a = 1; a < colorLevels.length; a++)
			addColor(a,0,0);
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(5,a,a);
			
			
        for (a = 1; a < colorLevels.length; a++)
			addColor(a,a,0);
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(5,5,a);
			
        for (a = 1; a < colorLevels.length; a++)
			addColor(0,a,a);
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(a,5,5);

        for (a = 1; a < colorLevels.length; a++)
			addColor(a,0,a);			
        for (a = 1; a < colorLevels.length - 1; a++)
			addColor(5,a,5);
			
       	return colorArray;
     }
     function getColorTable() {
         var colors = colorArray;
      	 var tableCode = '';
         tableCode += '<table border="0" cellspacing="1" cellpadding="1">';
         for (i = 0; i < colors.length; i++) {
              if (i % perline == 0) { tableCode += '<tr>'; }
              tableCode += '<td bgcolor="#000000"><a style="outline: 1px solid #000000; color: ' 
              	  + colors[i] + '; background: ' + colors[i] + ';font-size: 10px;" title="' 
              	  + colors[i] + '" href="javascript:setColor(\'' + colors[i] + '\');">&nbsp;&nbsp;&nbsp;</a></td>';
              if (i % perline == perline - 1) { tableCode += '</tr>'; }
         }
         if (i % perline != 0) { tableCode += '</tr>'; }
         tableCode += '</table>';
      	 return tableCode;
     }
     function relateColor(id, color) {
     	var link = getObj(id);
     	if (color == '') {
	     	link.style.background = nocolor;
	     	link.style.color = nocolor;
	     	color = nocolor;
     	} else {
	     	link.style.background = color;
	     	link.style.color = color;
	    }
	    eval(getObj(id + 'field').title);
     }
     function getAbsoluteOffsetTop(obj) {
     	var top = obj.offsetTop;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		top += parent.offsetTop;
     		parent = parent.offsetParent;
     	}
     	return top;
     }
     
     function getAbsoluteOffsetLeft(obj) {
     	var left = obj.offsetLeft;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		left += parent.offsetLeft;
     		parent = parent.offsetParent;
     	}
     	return left;
     }


</script>
<!--- COLOR PICKER HERE --->


<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top"> <table width="100%" border="0" cellpadding="1" cellspacing="0">
              <tr> 
                <td valign="top"> <table width="100%" height="20" border="0" cellpadding="0" cellspacing="3">
                    <tr> 
                      <td valign="top"> <div align="center"> 
                          
                            
                          <table width="100%" border="0" cellspacing="10" cellpadding="2">
                            <form name="form2" method="post" action="insert_styles.php" onSubmit="return validate(this);">
                              <tr bgcolor="#004080"> 
                                <td height="25" colspan="3"> <div align="left"><font size="3" face="Arial, Helvetica, sans-serif"><font color="#FFFFFF" size="2"><strong>&nbsp;Add/Edit 
                                    Site Styles</strong></font></font></div></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif" class="labels">Pick 
                                    Style</font><font size="2" face="Arial, Helvetica, sans-serif">:</font></strong></div></td>
                                <td width="6" valign="top">&nbsp;</td>
                                <td valign="top"> <select name="style_list" onChange="sb_jumpMenu('parent',this,0)" >
                                    <option value="site_styles.php?id=0" selected>Add 
                                    New</option>
                                    <?
								$rs_query=mysql_query("select * from sbjbs_styles order by sb_title");
								while($rst=mysql_fetch_array($rs_query))
								{ 
								?>
                                    <option value="site_styles.php?id=<? echo $rst["sb_id"];?>" <? if($id==$rst["sb_id"])
								{ echo "selected";}
								?>><? echo $rst["sb_title"];?></option>
                                    <?
                                }
								  ?>
                                  </select> </td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Name 
                                    of the Style:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><font color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</font></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  <input name="title" type="text" id="title2" value="<? echo $style["sb_title"];?>">
                                  <input name="id" type="hidden" id="id" value="<? echo $id;?>">
                                  </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Overall 
                                    Page Background Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*&nbsp;</FONT></TD>
                                <td width="68%" valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  <div class="content" style="text-align: justify;"></div>
                                  # 
                                  <input name="page_bg" type="text" id="page_bg" value="<? echo $style["sb_page_bg"];?>" maxlength="6" >
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font></font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Main 
                                    Table Background Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT><FONT color=red 
                        size=1>&nbsp;</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="table_bg" type="text" id="table_bg" value="<? echo $style["sb_table_bg"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Seperator Line Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="seperator" type="text" id="seperator" value="<? echo $style["sb_seperator"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Title Bar Background Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="title_bg" type="text" id="title_bg" value="<? echo $style["sb_title_bg"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Title Bar Text Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"># 
                                  <input name="title_font_color" type="text" id="title_font_color" value="<? echo $style["sb_title_font_color"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <!--tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Inner Table Background Color:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="normal_table_bg" type="text" id="normal_table_bg" value="<? echo $style["sb_normal_table_bg"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr-->
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Inner 
                                    Table Row Background Color1:<br>
                                    <font size="1">(Used as background color for 
                                    alternate rows)</font> </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="normal_table_bg" type="hidden" id="normal_table_bg" value="F5F5F5" maxlength="6">
                                  <input name="inner_table_bg" type="text" id="inner_table_bg" value="<? echo $style["sb_inner_table_bg"];?>" maxlength="6">
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font> 
                                  </font></td>
                              </tr>
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Inner 
                                    Table Row Background Color2:<br>
                                    <font size="1">(Used as background color for 
                                    alternate rows)</font> </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="sub_title_bg" type="text" id="sub_title_bg" value="<? echo $style["sb_sub_title_bg"];?>" maxlength="6">
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font> 
                                  </font></td>
                              </tr>
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Highlighted 
                                    Row Background Color1:<br>
                                    <font size="1">(Used as background color for 
                                    alternate rows)</font> </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="highlighted" type="text" id="highlighted" value="<? echo $style["sb_highlighted"];?>" maxlength="6">
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font> 
                                  </font></td>
                              </tr>
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Highlighted 
                                    Row Background Color2:<br>
                                    <font size="1">(Used as background color for 
                                    alternate rows)</font> </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  # 
                                  <input name="highlighted1" type="text" id="highlighted1" value="<? echo $style["sb_highlighted1"];?>" maxlength="6">
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font> 
                                  </font></td>
                              </tr>
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Side 
                                    Title Background Color:<br>
                                    </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"># 
                                  <input name="side_title_bg" type="text" id="side_title_bg" value="<? echo $style["sb_side_title_bg"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Side 
                                    Title Font Color:<br>
                                    </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"># 
                                  <input name="side_title_font_color" type="text" id="side_title_font_color" value="<? echo $style["sb_side_title_font_color"];?>" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    Normal Text Style:</font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  <select name="normal_font" id="normal_font">
                                    <option value="Arial, Helvetica, sans-serif" <? 
								  if($style["sb_normal_font"]== "Arial, Helvetica, sans-serif")
								  { echo "selected";}
								  ?>>Arial</option>
                                    <option value="Courier New, Courier, mono" <? 
								  if($style["sb_normal_font"]== "Courier New, Courier, mono")
								  { echo "selected";}
								  ?>>Courier New</option>
                                    <option value="Times New Roman, Times, serif" <? 
								  if($style["sb_normal_font"]== "Times New Roman, Times, serif")
								  { echo "selected";}
								  ?>>Times New Roman</option>
                                    <option value="Verdana, Arial, Helvetica, sans-serif" <? 
								  if($style["sb_normal_font"]== "Verdana, Arial, Helvetica, sans-serif")
								  { echo "selected";}
								  ?>>Verdana</option>
                                  </select>
                                  <select name="normal_font_size" id="select4">
                                    <option value="8" <? 
									if($style["sb_normal_font_size"]==8)
									{ echo "selected";} ?>>8</option>
                                    <option value="9"  <? 
									if($style["sb_normal_font_size"]==9)
									{ echo "selected";} ?>>9</option>
                                    <option value="10"  <? 
									if($style["sb_normal_font_size"]==10)
									{ echo "selected";} ?>>10</option>
                                    <option value="11"  <? 
									if($style["sb_normal_font_size"]==11)
									{ echo "selected";} ?>>11</option>
                                    <option value="12"  <? 
									if(($style["sb_normal_font_size"]==12)||($id==0))
									{ echo "selected";} ?>>12</option>
                                    <option value="14"  <? 
									if($style["sb_normal_font_size"]==14)
									{ echo "selected";} ?>>14</option>
                                    <option value="16"  <? 
									if($style["sb_normal_font_size"]==16)
									{ echo "selected";} ?>>16</option>
                                    <option value="18"  <? 
									if($style["sb_normal_font_size"]==18)
									{ echo "selected";} ?>>18</option>
                                    <option value="20"  <? 
									if($style["sb_normal_font_size"]==20)
									{ echo "selected";} ?>>20</option>
                                    <option value="22"  <? 
									if($style["sb_normal_font_size"]==22)
									{ echo "selected";} ?>>22</option>
                                    <option value="24"  <? 
									if($style["sb_normal_font_size"]==24)
									{ echo "selected";} ?>>24</option>
                                    <option value="26"  <? 
									if($style["sb_normal_font_size"]==26)
									{ echo "selected";} ?>>26</option>
                                    <option value="28"  <? 
									if($style["sb_normal_font_size"]==28)
									{ echo "selected";} ?>>28</option>
                                    <option value="36"  <? 
									if($style["sb_normal_font_size"]==36)
									{ echo "selected";} ?>>36</option>
                                    <option value="48"  <? 
									if($style["sb_normal_font_size"]==48)
									{ echo "selected";} ?>>48</option>
                                    <option value="72"  <? 
									if($style["sb_normal_font_size"]==72)
									{ echo "selected";} ?>>72</option>
                                  </select>
                                  Color # 
                                  <input name="normal_font_color" type="text" id="normal_font_color" value="<? echo $style["sb_normal_font_color"];?>" size="10" maxlength="6">
                                  <br>
                                  <font size="1">(Enter color in Hexadecimal format 
                                  #RRGGBB)</font> </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif">Link 
                                    Style: </font></strong></div></td>
                                <TD align=left valign="top" class="onepxtable"><FONT color=red 
                        size=2 face="Arial, Helvetica, sans-serif">*</FONT></TD>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  <select name="link_font" id="link_font">
                                    <option value="Arial, Helvetica, sans-serif" <? 
								  if($style["sb_link_font"]== "Arial, Helvetica, sans-serif")
								  { echo "selected";}
								  ?>>Arial</option>
                                    <option value="Courier New, Courier, mono" <? 
								  if($style["sb_link_font"]== "Courier New, Courier, mono")
								  { echo "selected";}
								  ?>>Courier New</option>
                                    <option value="Times New Roman, Times, serif" <? 
								  if($style["sb_link_font"]== "Times New Roman, Times, serif")
								  { echo "selected";}
								  ?>>Times New Roman</option>
                                    <option value="Verdana, Arial, Helvetica, sans-serif" <? 
								  if($style["sb_link_font"]== "Verdana, Arial, Helvetica, sans-serif")
								  { echo "selected";}
								  ?>>Verdana</option>
                                  </select>
                                  <select name="link_font_size" id="select6">
                                    <option value="8" <? 
									if($style["sb_link_font_size"]==8)
									{ echo "selected";} ?>>8</option>
                                    <option value="9"  <? 
									if($style["sb_link_font_size"]==9)
									{ echo "selected";} ?>>9</option>
                                    <option value="10"  <? 
									if($style["sb_link_font_size"]==10)
									{ echo "selected";} ?>>10</option>
                                    <option value="11"  <? 
									if($style["sb_link_font_size"]==11)
									{ echo "selected";} ?>>11</option>
                                    <option value="12"  <? 
									if(($style["sb_link_font_size"]==12)||($id==0))
									{ echo "selected";} ?>>12</option>
                                    <option value="14"  <? 
									if($style["sb_link_font_size"]==14)
									{ echo "selected";} ?>>14</option>
                                    <option value="16"  <? 
									if($style["sb_link_font_size"]==16)
									{ echo "selected";} ?>>16</option>
                                    <option value="18"  <? 
									if($style["sb_link_font_size"]==18)
									{ echo "selected";} ?>>18</option>
                                    <option value="20"  <? 
									if($style["sb_link_font_size"]==20)
									{ echo "selected";} ?>>20</option>
                                    <option value="22"  <? 
									if($style["sb_link_font_size"]==22)
									{ echo "selected";} ?>>22</option>
                                    <option value="24"  <? 
									if($style["sb_link_font_size"]==24)
									{ echo "selected";} ?>>24</option>
                                    <option value="26"  <? 
									if($style["sb_link_font_size"]==26)
									{ echo "selected";} ?>>26</option>
                                    <option value="28"  <? 
									if($style["sb_link_font_size"]==28)
									{ echo "selected";} ?>>28</option>
                                    <option value="36"  <? 
									if($style["sb_link_font_size"]==36)
									{ echo "selected";} ?>>36</option>
                                    <option value="48"  <? 
									if($style["sb_link_font_size"]==48)
									{ echo "selected";} ?>>48</option>
                                    <option value="72"  <? 
									if($style["sb_link_font_size"]==72)
									{ echo "selected";} ?>>72</option>
                                  </select>
                                  Color # 
                                  <input name="link_font_color" type="text" id="link_font_color" value="<? echo $style["sb_link_font_color"];?>" size="10" maxlength="6">
                                  <font size="1"><br>
                                  (Enter color in Hexadecimal format #RRGGBB)</font> 
                                  </font></td>
                              </tr>
                              <tr> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"><div align="right"><strong><font size="2" face="Arial, Helvetica, sans-serif"> 
                                    </font></strong></div></td>
                                <td width="6" valign="top">&nbsp;</td>
                                <td valign="top"><font size="2" face="Arial, Helvetica, sans-serif"> 
                                  <input type="submit" name="Submit" value="Save">
                                  </font></td>
                              </tr>
                            </form>
                            <!--<form name=form3 target="_other" action="preview.php" onsubmit="return set_values(this);">
                              <tr align="left"> 
                                <td width="40%" valign="top" bgcolor="#F5F5F5"> 
                                  <input name="title" type="hidden" id="title"> 
                                  <input name="page_bg" type="hidden" id="page_bg"> 
                                  <input name="table_bg" type="hidden" id="table_bg"> 
                                  <input name="seperator" type="hidden" id="seperator"> 
                                  <input name="title_bg" type="hidden" id="title_bg"> 
                                  <input name="normal_table_bg" type="hidden" id="normal_table_bg"> 
                                  <input name="title_font_color" type="hidden" id="title_font_color"> 
                                  <input name="normal_font" type="hidden" id="normal_font"> 
                                  <input name="normal_font_size" type="hidden" id="normal_font_size"> 
                                  <input name="normal_font_color" type="hidden" id="normal_font_color"> 
                                  <input name="highlight_bg_color" type="hidden" id="highlight_bg_color"> 
                                  <input name="link_font" type="hidden" id="link_font"> 
                                  <input name="link_font_size" type="hidden" id="link_font_size"> 
                                  <input name="link_font_color" type="hidden" id="link_font_color"> 
                                  <input name="stat_yes_color" type="hidden" id="stat_yes_color"> 
                                  <input name="stat_no_color" type="hidden" id="stat_no_color"></td>
                                <td valign="top"> 
                                  <input name="preview" type="submit" id="preview" value="Preview" > 
                                </td>
                              </tr>
                            </form>-->
                          </table>
                         
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