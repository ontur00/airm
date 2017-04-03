<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################


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

<?php

function cli_beep()
 {
     echo "\x07";
 }
$kod 	= $_POST['kod']; 

if ($kod==="00"){ echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> PRODUKTU BOX  </b> -PRZYJECIE z PRODUKCJI</center></b><hr>";
																	echo $komunikat;}																
elseif ($kod==="01"){ echo "<font size='0'>"; echo include "zaw_wczytajp.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> PALETY  </b> INFO O ZAWARTOSCI</center></b><hr>";
																	echo $komunikat;}
elseif ($kod===".."){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> Z PUDELKA  </b> - MIGRACJA PUDELKA DO PALETY/LOKALIZACJI</center></b><hr>";
																	echo $komunikat;}
else {

$tekst_1="Ostatnie zdarzenie / Last Event:";




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


session_start();
$_SESSION['sshinchang_part_no']=$shinchang_part_no;
$_SESSION['sbarcode']=$kod;

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerendacg = "SELECT * FROM prod_st WHERE barcode='$kod'";
$wynikcg = mysql_query($kwerendacg);
$rekordowcg = mysql_numrows($wynikcg);
mysql_close();
$codelok				= mysql_result($wynikcg, 0, "lok");                


if ($dlug<1)
				{		echo "<font size='0'>"; echo include "zaw_wczytaj.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>
					<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
					WCZYTALES Nieprawidłowy kod lub BOX nie na magazynie GL , WCZYTAJ KOD JESZCZE RAZ !!! <BR>  ";
					echo "<font size='0'>$komunikat"; }
elseif ($codelok==="MG")
				{	 echo include "pokaz_lokw.php"; }
				
elseif ($codelok==="MP")
				{	 echo include "pokaz_lokw.php"; }
elseif ($codelok==="MW")
				{	 echo include "pokaz_lokw.php"; }
elseif ($codelok==="ZB")
				{	 echo include "pokaz_lokw.php"; }
elseif ($codelok==="WZ")
				{	 echo include "pokaz_lokwz.php"; }
				
else { 	echo "<font size='0'>"; echo include "zaw_wczytaj.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>
					<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
					WCZYTALES Nieprawidłowy kod lub BOX nie na magazynie GL , WCZYTAJ KOD JESZCZE RAZ !!! <BR>  ";
					echo "<font size='0'>$komunikat"; }
				

}

?>
</BODY>
</HTML>
