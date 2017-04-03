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
<center> <IMG SRC='img/barcodeair.gif' WIDTH='682' HEIGHT='100' BORDER='0'> </center><br><br><hr>

<font size='4'><center><b> Drukowasnie Etykiet / Printing Label </b></center></font><hr>
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
session_start();

// Created by Przemyslaw Cios //

 $pojazd_p = $_POST["pojazd"];
    
session_start(); 


if (!isset($_SESSION['spojazd'])) { // jeli zmienna nie jest zarejestrowana
    $_SESSION['spojazd'] = $pojazd_p;      // przypisz jej poczštkowš wartoć
} else {                          // jeli jest zarejestrowana
    $_SESSION['spojazd']=$pojazd_p;        // przypisz wartosc klient 
}




$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

	



mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got ";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();



echo "<FORM ACTION='kody_pokaz_liniap.php' METHOD='POST'>

 <FIELDSET>
    <LEGEND> Typ Produktu    </LEGEND>
	<SELECT NAME='part_no' SIZE='1'>
    ";

	$a = 0;
	while ($a < $rekordow) 
{
$id 						= mysql_result($wynik, $a, "id");
$part_no				= mysql_result($wynik, $a, "part_no");
$part_name				= mysql_result($wynik, $a, "part_name");

 					

	 
  echo "
  <OPTION VALUE='$part_no'>$part_no $space</OPTION>"; 
 
	  
      
   	$a++;
}
 echo"
 
	
	</SELECT>
       
	  <INPUT TYPE='submit' VALUE='potwierdz wybor typu produktu'>
  </FIELDSET>
  </FORM>";
 ?>




</BODY>
</HTML>
