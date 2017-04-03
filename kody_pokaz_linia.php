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
<center> <IMG SRC='img/barcodeair.gif' WIDTH='682' HEIGHT='100' BORDER='0'> </center><hr>

<font size='4'><center><b> Historia przyjêæ - wydañ / History Stockroom in-out </b></center></font><hr>

<?php
// Created by Przemyslaw Cios //




$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 
$part_no_z = $_POST["part_no"];




mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$tekst_n = "SELECT * FROM prod_got_mag WHERE part_no=";
$kwerenda1 = "$tekst_n'$part_no_z'";
$wynik1 = mysql_query($kwerenda1);
$rekordow1 = mysql_numrows($wynik1);
mysql_close();
$part_name 					= mysql_result($wynik1, $a, "part_name");

echo "<FIELDSET>
  <LEGEND><center>Nazwa wybranego projektu-pojazdu:$space  <font size='4'> $part_name </font>
   $space Nr produktu $space  <font size='4'> $part_no_z </center><HR> </font> </LEGEND>
  
  </fieldset>


<TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='1100' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
<TR BGCOLOR='#F4F4F4'>
 <TH VALIGN='middle'><H6>Kod Bledu</H6></TH>
 <TH VALIGN='middle'><H6>.............Login...........</H6></TH>
 <TH>Data Operacji / date:</TH>
 <TH>Klient / Buyer</TH>
 <TH>Pojazd /Wehicycle</TH>
 <TH>Numer_seryjny /Part no</TH>
 <TH>Nazwa_produktu / Part_name</TH>
 <TH>nr_etyk / ALC code</TH>
  <TH>Ilosc   </TH>
 <TH>Ilosc po zmianie </TH>
 <TH>Zmiana o </TH>
</TR>";

$a = 0;
while ($a < $rekordow1){
$id 						= mysql_result($wynik1, $a, "id");
$klient						= mysql_result($wynik1, $a, "klient");
$powod						= mysql_result($wynik1, $a, "powod");
$login						= mysql_result($wynik1, $a, "login");
$pojazd 					= mysql_result($wynik1, $a, "pojazd");
$part_no 					= mysql_result($wynik1, $a, "part_no");

$part_name 					= mysql_result($wynik1, $a, "part_name");
$nr_etyk 					= mysql_result($wynik1, $a, "nr_etyk");
$data	 					= mysql_result($wynik1, $a, "data");
$stan_pop					= mysql_result($wynik1, $a, "stan_pop");
$stan						= mysql_result($wynik1, $a, "stan");

if ($a%2 != 0) {$tlo='#f0f0f0';} else {$tlo='#c0c0c0';}
$qty_box=$stan-$stan_pop;
echo "

<TR><FORM ACTION='kod_g.php' METHOD='POST'>
	<TD ALIGN='center' BGCOLOR=$tlo>$powod</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$login</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$data</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$klient</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$pojazd</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_no</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$part_name</TD>
		<TD ALIGN='center' BGCOLOR=$tlo>$nr_etyk</TD>
	
		<TD ALIGN='center' BGCOLOR=$tlo>$stan_pop</TD>
			<TD ALIGN='center' BGCOLOR=$tlo>$stan</TD>
			<TD ALIGN='center' BGCOLOR=$tlo>$qty_box</TD>
	  </form></TR>";
    
$a++;
}

?>


</BODY>
</HTML>
