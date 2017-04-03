<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################
  $kod	= $_POST['kod'];

function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);								// Zwraca TRUE jeli $d (czyli data) jest wypełniona
  return $flaga;
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
<!--
p				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: thin; }
th.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: right; empty-cells: show; border-style: none; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 0px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
td.menu			{  padding: 0px; border-style: none; font-size: 20px;}
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





<?php

 $part_no = $_POST["part_no"];
$tekst_1="Ostatnie zdarzenie / Last Event:";


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE part_no='$part_no'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$id  					= mysql_result($wynik, $a, "id");                 
$klient					= mysql_result($wynik, $a, "klient");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data 	 				= mysql_result($wynik, $a, "data");
$inne	 				= mysql_result($wynik, $a, "inne");
$qty_box	 			= mysql_result($wynik, $a, "qty_box");

							
?>

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

<font size='4'><center><b> Drukowasnie Etykiet / Printing Label </b></center></font><hr>

<?php							
echo " 
 

<FORM ACTION='air_print.php' METHOD='POST'>
<INPUT TYPE='hidden' NAME='id' VALUE='$id'>
<INPUT TYPE='hidden' NAME='no_box' VALUE='$qty_box_il'>
<TABLE class='menu' ALIGN='center' WIDTH='900' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
<TR>
	<TD> <font size='3'>Klient / Buyer:		 </font>					</TD>
	<TD> <font size='2'><B>$klient </font></B></TD>
	</TR>
	<TR>
	<TD> <font size='3'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='2'><B>$data </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='3'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='2'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='3'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='2'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='3'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='2'><B>$part_name  </font></B>     					</TD>
	</TR>

	<TR>
	<TD> <font size='3'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='2'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR><font size='2'>
	
	<TD><br>ilosc w pudełku / QTY BOX<br><br></TD>
	<TD colspan='2'><INPUT TYPE='text' NAME='qty_box' VALUE='$qty_box' SIZE='40' NUMER='20' MAXLENGTH='30'></TD></font>
    <br><br></TR>
	<TR>	
	<TD> <font size='3'>NR PUDEŁEKA Z PRODUKTAMI / NO BOXES PRODUCTS: </font>				     	</TD>	
	<TD> <font size='2'>					<B>$qty_box_il	 </font></B>      	</TD>	
	</TR><br><br>
	<TR> <td> </td>
	<TD> </TD></TR>
    <TR> <td></td>
	<TD ALIGN='right'><INPUT TYPE='submit' VALUE='...Drukuj Etykiete / Print Label...'></TD></TR>
	
	</TABLE>

     " ;

?>
</BODY>
</HTML>
