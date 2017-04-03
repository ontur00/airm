<?php

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################

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
-->

-->
</style>
<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kod"].value='';
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',1999);
  // -->
</script>

</HEAD>
<BODY>


<?php
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';
$o="O";

$kod        = $_POST['kod'];
$id 	    = $_POST['id'];

session_start();
$_SESSION['sqid']=$id;

$qty_box 	= $_POST['qty_box'];
$no_box     = $_POST['no_box'];

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM rej_prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();
$qty_pierw				= mysql_result($wynik, $a, "qty_box");                
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data1 	 				= mysql_result($wynik, $a, "data_z_kodu");
$data=str_replace("-", "", $data1);
$dlug = strlen($kod);

$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box_r		   = substr($qty_box_rob ,0,5);

if($qty_box<10) {$zero_qty="0000";}
    elseif($qty_box<100) {$zero_qty="000";} 
    elseif($qty_box<1000) {$zero_qty="00";} 
    elseif($qty_box<10000) {$zero_qty="0";} 
    elseif($qty_box<100000) {$zero_qty="";} 

settype($qty_box,"string");

$qty_box_kod_r="$zero_qty$qty_box";

	if($no_box<10) {$zero_no="00";}
    elseif($no_box<100) {$zero_no="0";} 
    elseif($no_box<1000) {$zero_no="";} 
$no_box_f="$zero_no$no_box";

$qty_box_kod="$qty_box_kod_r$no_box_f";

$cod39="$data$shinchang_part_no";

$nazwa_zbioru_dl39=strlen($cod39);
    if($nazwa_zbioru_dl39>18){$sp39="";}
    elseif($nazwa_zbioru_dl39>17){$sp39=" ";}
    elseif($nazwa_zbioru_dl39>16){$sp39="  ";}
    elseif($nazwa_zbioru_dl39>15){$sp39="   ";}
    elseif($nazwa_zbioru_dl39>14){$sp39="    ";}
    elseif($nazwa_zbioru_dl39>13){$sp39="     ";}
    elseif($nazwa_zbioru_dl39>12){$sp39="      ";}
   
    $kod_zlorz="$cod39$sp39$qty_box_kod$o";
    
session_start();   
$login=$_SESSION['luzytkownik'];

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");


$kwerenda = "UPDATE rej_prod_got SET qty_box='$qty_box',barcode='$kod_zlorz',uzytkownik_id='$login',ilosc_pierwotna='$qty_pierw' WHERE id='$id'";

mysql_query($kwerenda);
mysql_close();



echo"
<br>
<center> <IMG SRC='/img/barcode_read.gif' WIDTH='882' HEIGHT='170' BORDER='0'> </center><br><br><hr>

$blad

";
?>
 
<FORM ACTION="ac_g.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<TR>
	<TD COLSPAN="4" ALIGN="center" VALIGN="middle" HEIGHT="100">Wczytaj powód zmniejszenia liczby sztuk produktow </b>    </TD>
</TR>

<TR>
	<TD WIDTH="100"></TD>
	<TD COLSPAN="2" ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kod" ID="kod" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
	<TD WIDTH="100"></TD>
</TR>
<TR>
	<TD COLSPAN="4" ALIGN="center" VALIGN="middle" HEIGHT="100">Load a reason to reduce the number of items</b></TD>
</TR>
</TABLE>
</FORM>
<hr>

</BODY>
</HTML>
