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
$tekst_1="Ostatnie zdarzenie / Last Event:";

 session_start();
 $kod_prod=$_SESSION['skod_prod'];  


$kod 	= $_POST['kod'];

$dlug = strlen($kod);
$data_rok = substr($kod, 0,4);
$data_mies = substr($kod, 4,2);
$data_dzien = substr($kod, 6,2);
$data_exp="$data_rok-$data_mies-$data_dzien";
$dlug_kor=$dlug-18;

$shinchang_part_no = substr($kod, 8,$dlug_kor);
$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);


if ($dlug <27) {  $czas = date("G:i"); 
                                $komunikat = "<center><B>$tekst_1 [$czas]</B><br>
								<FONT COLOR='#FF0000'>	Wprowadzono nieprawidłowy kod 
							              <br>
										  
										  ";
						    include"lacznik.php";
                            include"prz_por_bar.php";
						}
							else {
                            
                                


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


$shinchang_part_no_por_sales = mysql_result($wynik, $a, "shinchang_part_no");


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE nr_etyk='$kod_prod'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


$shinchang_part_no_por_prod = mysql_result($wynik, $b, "shinchang_part_no");



?>
<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 32: document.location.href='aprcp_z_czytnika.php'; 
	 break;
     default: alert('Naciśnij SPACJE');
   }"
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>
</HEAD>
<?php

		   

if ($shinchang_part_no_por_prod<>$shinchang_part_no_por_sales) {  $czas = date("G:i"); 
                                $komunikat = "<center><B>$tekst_1 [$czas]</B><br><br><br><br><br><br><br><br>
								<FONT COLOR='#FF0000'>	POROWNANIE NIEZGODNE (ETYKIETA SPRZEDAZY NIE ODPOWIADA ETYKIECIE Z PRODUKTU) 
							              <br><BR> <font size='150'>NIEZGODNA - powtórz operacje, brak skutku magazynowego </font> <hr>
										  <br><br><br>
										  
										  COMPARING THE CONTRARY (LABEL IS NOT LIABLE FOR SALE THE PRODUCT LABEL)
										   <br><BR> <font size='150'>INCOMPATIBLE - Repeat the operations, the lack of effect of storage
											</font> </center><hr>
										  ";
							echo $komunikat; 
							
						}
							else {

								$komunikat = "<center><B>$tekst_1 [$czas]</B><br><br><br><br><br><br><br><br>
								<FONT COLOR='#00FF00'>	POROWNANIE ZGODNE (ETYKIETA SPRZEDAZY ODPOWIADA ETYKIECIE Z PRODUKTU) 
							              <br><BR> <font size='150'>OK ZGODNA dodano $qty_box sztuk produktu</font> <hr>
										  <FONT COLOR='#00FF00'>	COMPARISON OF COMPLIANCE (LABEL LIABLE FOR SALE THE PRODUCT LABEL) 
							              <br><BR> <font size='150'>OK POSITIVE add $qty_box quantity of product </font> </center><hr>
										  ";
							echo $komunikat;
							  include"prz_air_zapis_baza.php";    
							
} }
 

?>
</BODY>
</HTML>
