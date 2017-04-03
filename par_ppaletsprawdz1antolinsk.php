
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
$paletaddpl=$_SESSION['s_nr_ppalety_antolinsk'];

$ko 	= $_POST['kod'];
$kod=str_replace("M", "", $ko);

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
 	$kwerenda5reglkjt = "SELECT * FROM prod_got_antolinskp WHERE label='$kod'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$no_deli	 			= mysql_result($wynik5reglkjt, 0, "no_deli");
 	$paletaddplbaza	    	= mysql_result($wynik5reglkjt, 0, "nr_lok");
 	$paletaprzypisana    	= mysql_result($wynik5reglkjt, 0, "barcode");
 	 $dlug_paletaprzypisana = strlen($paletaprzypisana);
    $dlug_no_deli = strlen($no_deli); 
    


  //echo"$kodo";
  
if($paletaddpl===$kod){ echo "<font size='0'>"; echo include "par_palet_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>PODAJ KOD PALETY DDPL!!! <BR></FONT> ";
							echo "<font size='0'>$komunikat"; 
							 }

elseif($dlug_no_deli <1){ echo "<font size='0'>"; echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidlowa  etykieta antolin sk <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($dlug_no_deli >1 and $no_deli!==$kodzam){ echo "<font size='0'>"; echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>etykieta antolin sk jest przypisana do innej wysylki nr 	$no_deli <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($dlug_paletaprzypisana>1 and $paletaprzypisana===$paletaddpl){ echo "<font size='0'>"; echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ETYKIETA ANTOLIN SK JEST JUZ ZAREJESTROWANA DO PALETY DDPL <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($dlug_paletaprzypisana>1 and $paletaprzypisana!==$paletaddpl){ echo "<font size='0'>"; echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ETYKIETA ANTOLIN SK JEST ZAREJESTROWANA DO INNEJ PALETY DDPL $paletaprzypisana <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }		 	 

 elseif($paletaddplbaza===$paletaddpl and $no_deli===$kodzam){ echo "<font size='0'>"; session_start();
 
 																						$kwerenda_zap_max = "UPDATE prod_got_antolinskp SET barcode='$paletaddpl', login2='$login' WHERE label='$kod' ";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
											
 							echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>ETYKIETA PALETY ANTOLIN SK ZESKANOWANA POPRAWNIE <BR></FONT>
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	 

 	
	  else{ echo "<font size='0'>"; echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR PALETY  !!!  <BR>$paletaddplbaza===$paletaddpl and $no_deli===$kodzam</FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ  !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
