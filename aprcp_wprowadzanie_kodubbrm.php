
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";

session_start();
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);
$kod 	= $_POST['kodm'];


 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
		 
elseif ($kod===".."){ echo "<font size='0'>"; echo include "aprcp_wprowadzanie_kodubbr.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> Z PUDELKA  </b> - MIGRACJA PUDELKA DO PALETY/LOKALIZACJI</center></b><hr>";
																	echo $komunikat;}		 
elseif ($kod==="."){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrp.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> P A L E T Y  </b> aby miecić na Regale</center></b><hr>";
																	echo $komunikat;}
elseif ($kod==="0"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrpz.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> P A L E T Y  </b> aby zdjac z Regalu</center></b><hr>";
																	echo $komunikat;}
else {																	
																



$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_st WHERE barcode='$kod'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $lok_baza	 			= mysql_result($wynik5, $t, "lok");						
 $lok_szcz	 		    = mysql_result($wynik5, $t, "lok_sc");
 $lok_pal	 		    = mysql_result($wynik5, $t, "lok_pal"); 
 
  session_start();
  $_SESSION['sbarcode']=$kod;
  $_SESSION['slokszcz']=$lok_szcz; 
  $_SESSION['slokpal']=$lok_pal;
 
 if($lok_baza==="MP"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO NIE JEST PRZYJETE NA REGAL /PAPECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="MW"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="MG"){ 
                                    
					        echo include "zatw_lokm.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>MIGRACJA-Zarejestruj pudelko<b> $part_no</b> na NOWEJ lokalizacji <br>
							              </center><hr>";	
							echo $komunikat;}
													  						

 else {  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

							
}							


