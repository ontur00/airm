
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
     
      
if($kod===$koda){ echo "<font size='0'>"; echo include "parowanie_klient_kod2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>KOD ZGODNY  <BR></FONT><FONT COLOR='#0000FF'>  ETYKIETA KLIENTA !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	
 	
	  else{ echo "<font size='0'>"; echo include "parowanie_klient_kod_2wpr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>  NIEPRAWIDLOWY KOD 2 ETYKIETY<BR></FONT><FONT COLOR='#0000FF'> WCZYTAJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

}							
							


