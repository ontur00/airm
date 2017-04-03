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

																
if ($kod==="01"){ echo "<font size='0'>"; echo include "zaw_wczytaj.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> BOX  </b> INFO O ZAWARTOSCI</center></b><hr>";
																	echo $komunikat;}
elseif ($kod===".."){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> Z PUDELKA  </b> - MIGRACJA PUDELKA DO PALETY/LOKALIZACJI</center></b><hr>";
																	echo $komunikat;}
else {


$tekst_1="Ostatnie zdarzenie / Last Event:";








$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerendacg = "SELECT * FROM prod_st WHERE lok_sc='$kod' and lok='MG' or lok='MP'";
$wynikcg = mysql_query($kwerendacg);
$rekordowcg = mysql_numrows($wynikcg);
mysql_close();
$codelok				= mysql_result($wynikcg, 0, "lok");  
$barcode				= mysql_result($wynikcg, 0, "barcode");              
$shinchang_part_no		= mysql_result($wynikcg, 0, "shinchang_part_no"); 

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerendacgv = "SELECT * FROM prod_got_wys WHERE no_pal='$kod'";
$wynikcgv = mysql_query($kwerendacgv);
$rekordowcgv = mysql_numrows($wynikcgv);
mysql_close();
$kkkk				= mysql_result($wynikcgv, 0, "barcode");  
$dlugkkkk = strlen($kkkk);


session_start();
$_SESSION['sshinchang_part_no']=$shinchang_part_no;
$_SESSION['sbarcode']=$barcode;
$_SESSION['snrpal']=$kod;



if ($dlugkkkk>1)
				{	 echo include "pokaz_lokwpp.php"; }	

elseif ($codelok==="MG")
				{	 echo include "pokaz_lokwp.php"; }
				
elseif ($codelok==="MP")
				{	 echo include "pokaz_lokwp.php"; }
			
				
				
else { 	echo "<font size='0'>"; echo include "zaw_wczytajp.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>
					<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
					WCZYTALES Nieprawidłowy kod lub BOX nie na magazynie GL , WCZYTAJ KOD JESZCZE RAZ !!! <BR>  ";
					echo "<font size='0'>$komunikat"; }
				

}

?>
</BODY>
</HTML>
