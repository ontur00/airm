
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

$kodzam 	= $_POST['kodwys'];
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
 $kwerendalv = "SELECT * FROM prod_kody WHERE code='$kodzam'";
 $wyniklv = mysql_query($kwerendalv);
 $rekordowlv = mysql_numrows($wyniklv);
 mysql_close();
 $nr_code	 			= mysql_result($wyniklv, 0, "code");
 $nr_opis	 			= mysql_result($wyniklv, 0, "code");						

 $dl_nr_code= strlen($nr_code); 


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerendal = "SELECT * FROM zamowienia WHERE nr_zam='$kodzam' and status between 'O' and 'P'";
 $wynikl = mysql_query($kwerendal);
 $rekordowl = mysql_numrows($wynikl);
 mysql_close();
 $nr_zam	 			= mysql_result($wynikl, 0, "nr_zam");						

 $dl_na_zam= strlen($nr_zam); 

  
		
 if(($dl_na_zam<1)and( $dl_nr_code<1)){ echo "<font size='0'>"; echo include "wyczyt_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR WYSYLKI LUB WYSYLKA ZAMKNIETA<BR> </FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
 			

 elseif(($nr_zam===$kodzam)or($nr_code===$nr_code)) { 
        session_start();
        $_SESSION['szam']=$kodzam;
      echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><FONT COLOR='#00aa00'>czytanie barcode z box w/g listy wysylkowej $kodzam<BR>  
							               							</center><hr>";
																	echo $komunikat;
      }
else{ echo "<font size='0'>"; echo include "wyczyt_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR WYSYLKI LUB WYSYLKA ZAMKNIETA<BR> </FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

							
							
}

