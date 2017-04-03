
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
$kod_palety=$_SESSION['s_nr_palety_antolinsk'];

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
 	$kwerenda5reglkjts = "SELECT * FROM prod_st WHERE barcode='$kod' ";
	   $wynik5reglkjts = mysql_query($kwerenda5reglkjts);
 	$rekordow5reglkjts = mysql_numrows($wynik5reglkjts);
 	mysql_close();
 	$lok_baza	 			= mysql_result($wynik5reglkjts, 0, "lok");
 	$st_nr_wys	 			= mysql_result($wynik5reglkjts, 0, "nr_wys");
    

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got_wys WHERE barcode='$kod' ";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$pojazd	 			= mysql_result($wynik5reglkjt, 0, "pojazd");
 	$no_pal_wys	 		= mysql_result($wynik5reglkjt, 0, "no_pal");
 	$dlug_no_pal_wys = strlen($no_pal_wys);
    $dlug_pojazd = strlen($pojazd); 
    
    
    


  //echo"$kodo";
  
if($kod_palety===$kod){ echo "<font size='0'>"; echo include "przy_pal_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>PODAJ KOD PALETY !!! <BR></FONT> ";
							echo "<font size='0'>$komunikat"; 
							 }

elseif($lok_baza==='MG'){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST NA MAGAZYNIE GLOWYM !!! <BR></FONT><FONT COLOR='#0000FF'>  ZESKANUJ JESZCZE RAZ!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($lok_baza==='MP'){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST DOPIERO PRZYJETY Z PRODUKCJI !!! <BR></FONT><FONT COLOR='#0000FF'>  ZESKANUJ JESZCZE RAZ!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							}
elseif($lok_baza==='MW' and $st_nr_wys!==$kodzam){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX PRZYPISANY DO INNEJ WYSYŁKI W PRZYGOTOWANIU !!! <BR></FONT><FONT COLOR='#0000FF'>NR WYSYLKI: 	$st_nr_wys  ZZESKANUJ JESZCZE RAZ!!!  
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($lok_baza==='MW'){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX PRZYPISANY DO WYSYŁKI W PRZYGOTOWANIU !!! <BR></FONT><FONT COLOR='#0000FF'>  ZAMKNIJ WYSYLKE!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($lok_baza==='WZ' and $st_nr_wys!==$kodzam){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX PRZYPISANY DO INNEJ WYSYŁKI ZAMKNIETEJ !!! <BR></FONT><FONT COLOR='#0000FF'>NR WYSYLKI: 	$st_nr_wys  ZZESKANUJ JESZCZE RAZ!!!  
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($dlug_pojazd>1 and $pojazd!==$kodzam){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX PRZYPISANY DO INNEJ WYSYŁKI ZAMKNIETEJ !!! <BR></FONT><FONT COLOR='#0000FF'>NR WYSYLKI: 	$st_nr_wys  ZZESKANUJ JESZCZE RAZ!!!  
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	
elseif( $dlug_no_pal_wys>1 and $no_pal_wys===$kod_palety){ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ PRZYPISANY DO TEJ WYSYŁKI !!! <BR></FONT><FONT COLOR='#0000FF'>NR WYSYLKI: 	$st_nr_wys  ZZESKANUJ JESZCZE RAZ!!!  
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	
							 	 	 	 	 

 elseif($lok_baza==='WZ' and $dlug_pojazd>1 and $st_nr_wys===$kodzam and $pojazd===$kodzam){ echo "<font size='0'>"; 
							
																						$kwerenda_zap_max = "UPDATE prod_got_wys SET no_pal='$kod_palety', login2='$login' WHERE barcode='$kod' ";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
											
 							echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>BOX PRZYPISANY DO PALETY NR $kod_palety <BR></FONT>
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	 

 	
	  else{ echo "<font size='0'>"; echo include "przy_reg_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO PRZYPISANIA  !!!  <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ  !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
