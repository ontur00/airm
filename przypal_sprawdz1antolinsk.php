
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$kodzam=$_SESSION['s_kod_zamw'];
$klient=$_SESSION['sklient_par'];
$dluglogin = strlen($login);


$kod 	= $_POST['kod'];


if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }else{


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

    mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjts = "SELECT * FROM prod_st WHERE lok_sc='$kod' and lok like 'MG'";
	   $wynik5reglkjts = mysql_query($kwerenda5reglkjts);
 	$rekordow5reglkjts = mysql_numrows($wynik5reglkjts);
 	mysql_close();
 	$testp	 			= mysql_result($wynik5reglkjts, 0, "barcode");
    $dlug_testp = strlen($testp);

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got_wys WHERE no_pal='$kod'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$pojazd	 			= mysql_result($wynik5reglkjt, 0, "pojazd");
    $dlug_pojazd = strlen($pojazd); 
    
    
    
mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjtskms = "SELECT * FROM prod_regal WHERE nr_reg='$kod' and typ='PL'";
	   $wynik5reglkjtskms = mysql_query($kwerenda5reglkjtskms);
 	$rekordow5reglkjtskms = mysql_numrows($wynik5reglkjtskms);
 	mysql_close();
 	$id_regal		 			= mysql_result($wynik5reglkjtskms, 0, "id");


  //echo"$kodo";

if($dlug_testp >1){ echo "<font size='0'>"; echo include "przy_pal_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>DO PALETY SA PRZYPISANE BOXY NA MAGAZYNIE GLOWYM !!! <BR></FONT><FONT COLOR='#0000FF'>  WYDRUKUJ NOWY NR PALETY!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
		 	 
elseif( $dlug_pojazd>1 and $pojazd!==$kodzam){ echo "<font size='0'>"; echo include "przy_pal_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PALETA PRZPYPISANA DO $pojazd <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ INNA PALETE !!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
 elseif( $id_regal>1 ){ echo "<font size='0'>"; session_start();
												$_SESSION['s_nr_palety_antolinsk']=$kod;
 							echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#0000FF'>ZESKANUJ KOD Z ETYKIETY BOX <BR></FONT>
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	 

 	
	  else{ echo "<font size='0'>"; echo include "przy_pal_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR PALETY  !!!  <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ  !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
