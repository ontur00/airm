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


<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


$id = $_GET['id'];


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM lokalizacje WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();
$part_no 					= mysql_result($wynik, $a, "part_no");
$part_name 					= mysql_result($wynik, $a, "part_name");
$lokal 						= mysql_result($wynik, $a, "lokal");



echo "<br><br><br><br><br><br><br><br><br><br><TABLE BORDERCOLOR='#000000' CELLSPACING='2' WIDTH='650' BORDER='0' ALIGN='center'>
<TR><TD COLSPAN='10' ALIGN='center'></TD></TR>
";


echo "<TR>
	
			
		<TD><br>
		<font size='8'><b>LOKALIZACJA:</font><br><br><font size='8'> $lokal</font><br><br><br>
		<IMG SRC='code39.php?kod=$lokal' WIDTH='300' HEIGHT='140'>
		
		</b><br><br></TD>
		<TD></TR>
		<TR>
		<TD><br><font size='6'>
		
		Nazwa Produktu :<br> </font><font size='8'><b>$part_name
		</B></FONT>
		
		 <br><br></TD>

	
	  </TR>
	  <TR>
	
			
		<TD><br>
		<font size='6'>PART NO: <b>$part_no</b></font><br><br>
		<IMG SRC='code39.php?kod=$part_no' WIDTH='200' HEIGHT='50'>
		
		<br><br></TD>
		<TD></TR>
	  
	  
	  
	  
	  
	  ";



echo "
<TR><TD COLSPAN='10' ALIGN='left'></TD></TR>
</TABLE>";
?>


</BODY>
</HTML>
