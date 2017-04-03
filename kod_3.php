
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
<body>

<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 
session_start(); 
$id=$_SESSION['sid']; 				

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$qty_box	 			= mysql_result($wynik, $a, "qty_box");              
$partia					= mysql_result($wynik, $a, "partia");
$klient 				= mysql_result($wynik, $a, "klient");
$inne	 				= mysql_result($wynik, $a, "inne");
$data=date("Y-m-d");



$qty_box_il=ceil($partia/$qty_box);  


echo"<div style='margin: 0px;'>
	<TABLE class='menu' ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
	

	<TR>
	<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'><CENTER><A HREF='index.php'>MENU</A></CENTER></TD>
		<TD class='menu' BGCOLOR='#ccffcc'><CENTER><A HREF='kody_pokaz_linia1.php'>Powrót do listy towarów /Back to the list of goods</A></CENTER></TD>
		
	</TR>
	</TABLE>
</div>
<FORM ACTION='kod_3_p.php' target='_blank' METHOD='POST'>
<center><IMG SRC='kod_gen3p.php' WIDTH='320' HEIGHT='200' BORDER='0'></center>
<TABLE class='menu' ALIGN='center' WIDTH='700' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
<TR>
	<TD> <font size='2'>KLIENT / BUYER:		 </font>					</TD>
	<TD> <font size='4'><B>$klient  </font></B></TD>
	</TR>
	<TR>
	<TD> <font size='2'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='4'><B>$data  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='2'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='4'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='2'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='4'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='2'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='4'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='2'>LINIA PRODUKCYJNA / PRODUCTION LINE: </font>				 			</TD>
	<TD> <font size='4'><B>$linia      </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='2'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='4'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	<TD> <font size='2'>ILOSC W PUDELKU / QUATITY EA: </font>					</TD>
	<TD> <font size='4'><B>$qty_box </font></B>							</TD>
	</TR>
	<TR>	
	<TD> <font size='2'>ILOSC PUDE£EK Z PRODUKTAMI / NO BOXES PRODUCTS: </font>				     	</TD>	
	<TD> <font size='4'>					<B>$qty_box_il	 </font></B>      	</TD>	
	</TR>
		<TR>	
	<TD> <font size='2'>ILOSC WYPRODUKOWANA NA ZLECENIE / QUANTITY PRODUCED ON CONTRACT  </font>				     	</TD>	
	<TD> <font size='4'>					<B>$partia	 </font></B>      	</TD>	
	</TR>
	<TR>
	<TD> <font size='2'><CENTER>
	<INPUT TYPE='hidden' NAME='partia' VALUE='$partia'>	
	<INPUT TYPE='hidden' NAME='qty_box' VALUE='$qty_box'>	
	<INPUT TYPE='hidden' NAME='qty_box_il' VALUE='$qty_box_il'>	
	<INPUT TYPE='submit' VALUE='DRUKUJ ETYKIETY / PRINT BARCODE'>
	</CENTER></font>
	</TD>
	</TABLE>
	</FORM>
";
?>
</body>
</head>
