<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>baza produkty</TITLE>
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
<div style="margin: 0px;">
	<TABLE class="menu" ALIGN="center" WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0" >
	<TR>
	<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'><A HREF='czytnik_pokaz.php'>Przegladanie bazy / Reading data base </A></TD>
		<TD class='menu' BGCOLOR='#ccffcc'><A HREF='index.php'>MENU</A></TD>
		<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'><A HREF='rcp_z_czytnika.php'>Czytanie kodów linia /Reading the code line</A></TD>
	</TR>
	</TABLE>
</div>
<BR>
<center><IMG SRC='/barcode/img/barcode_show_gen.gif' WIDTH='882' HEIGHT='170' BORDER='0'></center>
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
case 'linia':				$pole = 'ORDER BY linia'; 					break;
case 'pojazd':				$pole = 'ORDER BY pojazd'; 					break;
case 'part_no':				$pole = 'ORDER BY part_no'; 				break;
case 'shinchang_part_no':	$pole = 'ORDER BY shinchang_part_no'; 		break;
case 'part_name':			$pole = 'ORDER BY part_name'; 				break;
case 'qty_box':				$pole = 'ORDER BY qty_box'; 				break;
case 'data':				$pole = 'ORDER BY data';					break;
case 'partia':				$pole = 'ORDER BY partia'; 					break;
case 'inne':				$pole = 'ORDER BY inne'; 					break;
default:					$pole = 'ORDER BY linia';
}

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got $pole";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

echo "<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1000' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR BGCOLOR='#F4F4F4'>
 <TH VALIGN='middle'><H6>&nbsp;</H6></TH>
  <TH><A HREF='czytnik_pokaz.php?pole=id'>ID :</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=linia'>Linie / linia :</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=pojazd'>Pojazd / Wehicle</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=part_no'>Nr seryjny / part no</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=shinchang_part_no'>Numer seryjny shinchang / Shinchang Part no</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=part_name'>Nazwa produktu / Part name</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=qty_box'>Iloœæ w pude³ku / Qty box</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=data'>Data_produkcji_1_partii / Date of first production</A></TH>
 <TH><A HREF='czytnik_pokaz.php?pole=partia'>Partia</A></TH>
</TR>";

$a = 0;
while ($a < $rekordow){
$id 						= mysql_result($wynik, $a, "id");
$linia 						= mysql_result($wynik, $a, "linia");
$pojazd 					= mysql_result($wynik, $a, "pojazd");
$part_no 					= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 			= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 					= mysql_result($wynik, $a, "part_name");
$qty_box 					= mysql_result($wynik, $a, "qty_box");
$data	 					= mysql_result($wynik, $a, "data");
$partia						= mysql_result($wynik, $a, "partia");
$inne 						= mysql_result($wynik, $a, "inne");
if ($a%2 != 0) {$tlo='#fafafa';} else {$tlo='#f0f0f0';}

echo "<TR>
		<TD ALIGN='center' VALIGN='middle' BGCOLOR=$tlo><A HREF='kod_gen.php?id=$id' target='_blank' ><IMG SRC='/barcode/img/gen.gif' WIDTH='108' HEIGHT='25' ALT='Edit  data / Edytuj dane ' BORDER='0'></A></TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$id</TD>	
		<TD ALIGN='center' BGCOLOR=$tlo><IMG SRC='/barcode/genbr/png_kod_128.php?kod=000$linia'WIDTH='108' HEIGHT='25'></TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$pojazd</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$shinchang_part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_name</TD>
		<TD ALIGN='center' BGCOLOR=$tlo><IMG SRC='/barcode/genbr/png_kod_128.php?kod=000$qty_box'WIDTH='108' HEIGHT='25'></TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$data</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$partia</TD>
	  </TR>";

$a++;
}
echo "
<TR><TD COLSPAN='10' ALIGN='left'><A HREF='czytnik_dodaj.php' TARGET='_self'><br>Dodaj Wpis/ Add iten</A></TD></TR>
</TABLE>";
?>


</BODY>
</HTML>
