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
<center><IMG SRC='/barcode/img/barcode_show_gen.gif' WIDTH='682' HEIGHT='60' BORDER='0'></center>
<BR>

<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 

$prodt = $_GET["prodt"];
session_start(); 
$prodt=$_SESSION['sprodt'];                 
$pojazd_s=$_SESSION['spojazd']; 

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$tekst_n = "SELECT * FROM prod_got WHERE part_name=";
$kwerenda1 = "$tekst_n'$prodt' AND  pojazd='$pojazd_s'";
$wynik1 = mysql_query($kwerenda1);
$rekordow1 = mysql_numrows($wynik1);
mysql_close();

echo "<FIELDSET>
  <LEGEND><hr><center>Nazwa wybranego projektu-pojazdu:$space  <font size='4'> $pojazd_s </font>
   $space Typ grupy produktow $space  <font size='4'> $prodt </center><HR> </font> </LEGEND>
  
  </fieldset>


<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1000' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR BGCOLOR='#F4F4F4'>
 <TH VALIGN='middle'><H6>&nbsp;</H6></TH>
 <TH>Linie / linia :</TH>
 <TH>Pojazd / Wehicle</TH>
 <TH>Nr_seryjny_/_part_no</TH>
 <TH>Numer_seryjny_shinchang / Shinchang Part no</TH>
 <TH>Nazwa_produktu_/_Part_name</TH>
 <TH>Iloœæ w pude³ku / Qty box</TH>
 <TH>Data_produkcji_1_partii / Date of first production</TH>
 <TH>Ilosc sztuk / Number of copies</TH>
</TR>";

$a = 0;
while ($a < $rekordow1){
$id 						= mysql_result($wynik1, $a, "id");
$linia 						= mysql_result($wynik1, $a, "linia");
$pojazd 					= mysql_result($wynik1, $a, "pojazd");
$part_no 					= mysql_result($wynik1, $a, "part_no");
$shinchang_part_no 			= mysql_result($wynik1, $a, "shinchang_part_no");
$part_name 					= mysql_result($wynik1, $a, "part_name");
$qty_box 					= mysql_result($wynik1, $a, "qty_box");
$data	 					= mysql_result($wynik1, $a, "data");
$partia						= mysql_result($wynik1, $a, "partia");
$inne 						= mysql_result($wynik1, $a, "inne");
if ($a%2 != 0) {$tlo='#f0f0f0';} else {$tlo='#c0c0c0';}

echo "

<TR><FORM ACTION='kod_g.php' METHOD='POST'>
		<TD ALIGN='center' BGCOLOR=$tlo><INPUT TYPE='submit' VALUE='.. Drukuj / Print  ..'></TD>
		 <INPUT TYPE='hidden' NAME='id' VALUE='$id'>
		<TD ALIGN='center' BGCOLOR=$tlo>$linia</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$pojazd</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$shinchang_part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_name</TD>
		<TD ALIGN='center' BGCOLOR=$tlo><INPUT TYPE='text' NAME='qty_box' VALUE='$qty_box' SIZE='8' MAXLENGTH='8'></TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$data</TD>
		<TD ALIGN='center' BGCOLOR=$tlo><INPUT TYPE='text' NAME='partia' VALUE='$partia' SIZE='8' MAXLENGTH='8'></TD>
		
	  </form></TR>";
    
$a++;
}

?>


</BODY>
</HTML>
