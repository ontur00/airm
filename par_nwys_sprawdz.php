
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

$kodzam 	= $_POST['kod'];
$_SESSION['s_kod_zamw']=$kodzam;

if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
		 else{ 
  
$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerendal = "SELECT * FROM zamowienia WHERE nr_zam='$kodzam' ";
 $wynikl = mysql_query($kwerendal);
 $rekordowl = mysql_numrows($wynikl);
 mysql_close();
 $nr_zam	 				= mysql_result($wynikl, 0, "nr_zam");						
 $klient_zam	 			= mysql_result($wynikl, 0, "klient");
 $status_zam	 			= mysql_result($wynikl, 0, "status");
 
 $dl_na_zam= strlen($nr_zam); 

  
		
 if($dl_na_zam<1){ echo "<font size='0'>"; echo include "par_nwys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR WYSYLKI LUB WYSYLKA ZAMKNIETA<BR> </FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
 			

 elseif($nr_zam===$kodzam) {if( $klient_zam==='KMS'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wys_kms.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;} 
							elseif( $klient_zam==='HMMC'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wys_hmmc.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;}
							elseif( $klient_zam==='KOMOS'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wys_komos.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;} 
							elseif( $klient_zam==='ANTOLIN SK' and $status_zam==='Z'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "menu_2.php"; 
													 }    										 
							elseif( $klient_zam==='ANTOLIN SK'and $status_zam!=='Z')
							{echo "<font size='0'>"; echo include "par_nwys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WYSYLKA NR <B>$kodzam $klient_zam</B> NIE JEST ZAMKNIETA !!!<BR> </FONT><FONT COLOR='#0000FF'> ZAMKNIJ WYSYŁKE W SYSTEMIE. 
							              ";
							echo "<font size='0'>$komunikat"; }
							elseif( $klient_zam==='ANTOLIN CZ'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wys_antolincz.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;}  
							elseif( $klient_zam==='MOBIS SK'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wys.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;}
  							elseif( $klient_zam==='MOBIS CZ'){session_start();
       												 $_SESSION['szam']=$kodzam;
       												 $_SESSION['sklient_par']=$klient_zam;
      												 echo "<font size='0'>"; echo include "par_wyscz.php"; 
													 $komunikat = "<center><B><FONT COLOR='#00aa00'>Czytanie etykiety $klient_zam wysylka $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;}
 							else{ echo "<font size='0'>"; echo include "par_nwys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WYSYLKA NR <B>$kodzam $klient_zam</B> NIE OBSLUGUJE FUNKCJI PAROWANIA !!!<BR> </FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

      }
else{ echo "<font size='0'>"; echo include "par_nwys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR WYSYLKI LUB WYSYLKA ZAMKNIETA<BR> </FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

							
							
}

