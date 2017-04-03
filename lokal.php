<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>baza lokalizacje</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
<!--
p				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: thin; }
th.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: right; empty-cells: show; border-style: none; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
td.menu			{  padding: 0px; border-style: none; font-size: 14px;}
td.sekcje		{  padding-right: 2px; padding-left: 2px; text-align: left; border-style: none; }
td.szare		{  text-align: center; background-color: #808080; color: black; width: 15px; }
td.naglowek_v	{  text-align: center; background-color: black; color: white; }
td.naglowek_h	{  text-align: center; background-color: black; color: white; }
td.roboczy		{  text-align: center; background-color: white; color: black; width: 15px; }
td.sobota		{  text-align: center; background-color: #E6FFFF; color: black; width: 15px; }
td.niedziela	{  text-align: center; background-color: #FFB0B0; color: black; width: 15px; }
td.swieto		{  text-align: center; background-color: red; color: black; width: 15px; }
td.rek_urlop	{  text-align: center; background-color: #CDFF9B; color: black; width: 15px; }
td.wolne		{  text-align: center; background-color: #FFFF00; color: black; width: 15px; }
td.firma		{  font-size: 16px; text-align: center; background-color: #E4EEF1; color: black; height: 26px; font-weight: bold;  }
.lewa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: left;  }
.prawa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right;  }

.tabele_glowne	{  border-color: black; border-width: 2px; border-style: none; border-spacing: 0px; padding: 0px; margin: auto; text-align: left; }
.obramuj		{  border-color: black; border-width: thin; border-style: dashed; font-weight: bold;  }

table.menu		{  font-family: Arial, Helvetica, sans-serif; border-style: none; border-spacing: 0px; padding: 0px; margin: auto;  }
div.pozycje		{  width: 300px; background-position: center; position:absolute; z-index:1; border-style: hidden;  }
legend			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;  }
input.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
textarea.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
input			{ text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
select			{ text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</HEAD>

<BODY>
<div style='margin: 0px;'>
	<TABLE class='menu' ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0'>
	<TR>
		<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'></TD>
		<TD class='menu' BGCOLOR='#ccffcc'><form>
<input type=button value="Close Window" onClick="javascript:window.close();">
</form> </TD>
		<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'></TD>
	</TR>
	</TABLE>
  </div>
<BR>
<center><IMG SRC='img/abarcode_show.gif' WIDTH='882' HEIGHT='100' BORDER='0'></center>
<BR>

<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$pole = '';
$pole = $_GET["pole"];

switch ($pole) {
case 'id':					$pole = 'ORDER BY id'; 						break;
case 'part_no':				$pole = 'ORDER BY part_no'; 				break;
case 'part_name':			$pole = 'ORDER BY part_name'; 				break;
case 'lokal':				$pole = 'ORDER BY lokal'; 					break;
default:					$pole = 'ORDER BY id';
}

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM lokalizacje $pole";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

echo "<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1150' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR>
</TR>
<TR BGCOLOR='#F4F4F4'>
 <TH><A HREF='aczytnik_pokaz.php?pole=id'>ID :</A></TH>
 <TH><A HREF='aczytnik_pokaz.php?pole=part_name'>Nazwa produktu 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Part name	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</A></TH>
 <TH><A HREF='aczytnik_pokaz.php?pole=part_no'>Nr seryjny 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; part no 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</A></TH>
 <TH><A HREF='aczytnik_pokaz.php?pole=lokal'>lokalizacja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</A></TH>
 <TH>Drukuj etykiete lokalizacji</TH>
</TR>";

$a = 0;
while ($a < $rekordow){
$id 						= mysql_result($wynik, $a, "id");
$part_no 					= mysql_result($wynik, $a, "part_no");
$part_name 					= mysql_result($wynik, $a, "part_name");
$lokal 						= mysql_result($wynik, $a, "lokal");
if ($a%2 != 0) {$tlo='#fafafa';} else {$tlo='#f0f0f0';}

echo "<TR>
	
		<TD ALIGN='center' BGCOLOR=$tlo>$id</TD>		
		<TD ALIGN='center' BGCOLOR=$tlo>$part_name</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo><b><font size='5'> $lokal</b></font></TD>
		<TD ALIGN='center' VALIGN='middle' BGCOLOR=$tlo><A HREF='lokal_print.php?id=$id'><IMG SRC='img/pioro.gif' WIDTH='20' HEIGHT='20' 
		                             ALT='Drukuj etykiete lokalizacji ' BORDER='0'>Drukuj etykiete lokalizacji</A></TD>
	
	  </TR>";

$a++;
}
echo "
<TR><TD COLSPAN='10' ALIGN='left'></TD></TR>
</TABLE>";
?>


</BODY>
</HTML>
