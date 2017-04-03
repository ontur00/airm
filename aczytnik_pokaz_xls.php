<?php
header("Content-Transfer-Encoding: base64");
header("Content-Type: text/multipart");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Arkusz1.xls");
header("Pragma: private");
header("Expires: 0");
header("Cache-Control: private, must-revalidate");
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>baza produkty</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">

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

<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';



mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got $pole";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

echo "<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1150' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR>
 <TH>ID :</TH>
 <TH>np produktu / prod no :</TH>
 <TH>Pojazd / Wehicle</TH>
 <TH><Data produkcji  / Date prod.<</TH>
 <TH>Numer seryjny shinchang / Shinchang Part no</TH>
 <TH>Iloœæ box Qty box</TH>
 <TH>Nazwa produktu 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Part name	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/TH>
 <TH>Nr seryjny 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; part no 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TH>
 <TH>Stan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;stock</TH>

</TR>";

$a = 0;
while ($a < $rekordow){
$id 						= mysql_result($wynik, $a, "id");
$nr_etyk					= mysql_result($wynik, $a, "nr_etyk");
$pojazd 					= mysql_result($wynik, $a, "pojazd");
$part_no 					= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 			= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 					= mysql_result($wynik, $a, "part_name");
$qty_box 					= mysql_result($wynik, $a, "qty_box");
$data	 					= mysql_result($wynik, $a, "data");
$stan 						= mysql_result($wynik, $a, "stan");
$inne 						= mysql_result($wynik, $a, "inne");
if ($a%2 != 0) {$tlo='#fafafa';} else {$tlo='#f0f0f0';}

echo "<TR>
	
		<TD ALIGN='center' BGCOLOR=$tlo>$id</TD>	
		<TD ALIGN='center' BGCOLOR=$tlo>$nr_etyk</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$pojazd</TD>
	    <TD ALIGN='center' BGCOLOR=$tlo>$data</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$shinchang_part_no</TD>		
		<TD ALIGN='center' BGCOLOR=$tlo>$qty_box</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_name</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo><b><font size='5'> $stan</b></font></TD>
		
	
	  </TR>";

$a++;
}
echo "
<TR><TD COLSPAN='10' ALIGN='left'></TD></TR>
</TABLE>";
?>


</BODY>
</HTML>
