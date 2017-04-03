
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
 	$kwerenda5reglkjt = "SELECT * FROM prod_got_wys WHERE no_pal='$kod'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$pojazd	 			= mysql_result($wynik5reglkjt, 0, "pojazd");
    $dlug_pojazd = strlen($pojazd); 
    


  //echo"$kodo";

if($dlug_pojazd <1){ echo "<font size='0'>"; echo include "par_palet_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidlowa  paleta <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
elseif($dlug_pojazd >1 and $pojazd!==$kodzam){ echo "<font size='0'>"; echo include "par_palet_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Paleta jest przypisana do innej wysylki nr $pojazd <BR></FONT><FONT COLOR='#0000FF'> zeskanuj jeszcze raz!!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
		 	 

 elseif($dlug_pojazd >1 and $pojazd===$kodzam){ echo "<font size='0'>"; session_start();
												$_SESSION['s_nr_ppalety_antolinsk']=$kod;
 							echo include "par_palet_a_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>ETYKIETA PALETY DDPL ZESKANOWANA POPRAWNIE <BR></FONT>
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	 

 	
	  else{ echo "<font size='0'>"; echo include "par_palet_antolinsk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR PALETY  !!!  <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ  !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
