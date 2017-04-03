
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$kodzam=$_SESSION['s_kod_zamw'];
$dluglogin = strlen($login);


$koda 	= $_POST['kod'];
if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else {																	
																
      
       session_start();
  
  $kod=$_SESSION['sbarcode'];
  $part_no=$_SESSION['spart_no'];
     mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no' and io='P'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$kod_alc_n1			= mysql_result($wynik5reglkjt, 0, "nr_etyk"); 
 	$kod_alc_n = substr($kod_alc_n1, 0,4);
 	$kodaa = substr($koda, 0,4);
      
if($kodaa===$kod_alc_n){ echo "<font size='0'>"; echo include "parowanie_klient_kod_2wpr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>WCZYTAJ BARCODE Z DRUGIEJ ETYKIETY  <BR></FONT><FONT COLOR='#0000FF'>  ETYKIETA KLIENTA !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	
 	
	  else{ echo "<font size='0'>"; echo include "parowanie_klient_kod_alcwpr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>  NIEPRAWIDLOWY KOD ALC <BR></FONT><FONT COLOR='#0000FF'> WCZYTAJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

}							
							


