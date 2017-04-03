<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>wybor produktu do generowania kodu</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
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
td.roboczy		{  text-align: center; color: black; width: 15px; }
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
</head>
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
<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1000' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR BGCOLOR='#F4F4F4'>
 <TH VALIGN='middle'><H6>&nbsp;</H6></TH>
  <TH>ID :</TH>
 <TH>Linie / linia :</TH>
 <TH>Pojazd / Wehicle</TH>
 <TH>Nr seryjny / part no</TH>
 <TH>Numer seryjny shinchang / Shinchang Part no</TH>
 <TH>Nazwa produktu / Part name</TH>
 <TH>Iloć w pudełku / Qty box</TH>
 <TH>Data_produkcji_1_partii / Date of first production</TH>
 <TH>ilosc sztuk</TH>
</TR>

<?php
// Created by Przemyslaw Cios //

$pojazd1=$_POST["pojazd1"];


if ($pojazd1 ="") {  include "kody_pokaz.php";} else {
						


$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
 $kwerenda1 = "SELECT * FROM prod_got ORDER BY pojazd";
 $wynik1 = mysql_query($kwerenda1);
 $rekordow1 = mysql_numrows($wynik1);
// mysql_close();
echo "<FORM ACTION='kody_pokaz1.php' METHOD='post'>

 <FIELDSET>
    <LEGEND> projekt-pojazd / Project-wehicycle    </LEGEND>
	<SELECT NAME='pojazd' SIZE='1'>
	
    ";

	$a = 0;
	while ($a < $rekordow1) 
{
$id_k							= mysql_result($wynik1, $a, "id");
$pojazd_rob                     = $pojazd1;
$pojazd1 						= mysql_result($wynik1, $a, "pojazd");


if ($pojazd_rob<>$pojazd1)
	 
						{echo "<OPTION VALUE='$pojazd1'>$pojazd1 </OPTION>";}  
 
	  
     
   	$a++;
	}
 
 echo"
 
	
	</SELECT>
       
	  <INPUT TYPE='submit' VALUE='.......potwierdz wybor projektu-pojazdu.........'> $space  <font color='FF1212'>Proszę najpierw wybrać  projekt-pojazd !!!</font>
  </FIELDSET>
  </FORM>";


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


echo "<FORM ACTION='kody_pokaz.php' METHOD='post'>

 <FIELDSET>
    <LEGEND> Typ Produktu    </LEGEND>
	<SELECT NAME='linia' SIZE='1'>
	
    ";

	$a = 0;
	while ($a < $rekordow) 
{
$id 						= mysql_result($wynik, $a, "id");
$part_name 					= mysql_result($wynik, $a, "part_name");

 					

	 
  echo "<OPTION VALUE='$part_name '>$part_name  $space</OPTION>";  
 
	  
      
   	$a++;
	}
 echo"
 
	
	</SELECT>
       
	  <INPUT TYPE='submit' VALUE='potwierdz wybor typu produktu'>
  </FIELDSET>
  </FORM>";
 }
 ?>




</BODY>
</HTML>
