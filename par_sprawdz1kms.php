
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
 	$kwerenda5reglkjtskms = "SELECT * FROM prod_imp_kms WHERE barcodep='$kod' and nr_zams='$kodzam'";
	   $wynik5reglkjtskms = mysql_query($kwerenda5reglkjtskms);
 	$rekordow5reglkjtskms = mysql_numrows($wynik5reglkjtskms);
 	mysql_close();
 	$barcode_b		 			= mysql_result($wynik5reglkjtskms, 0, "barcodep");
    $part_no_b		 			= mysql_result($wynik5reglkjtskms, 0, "part_nop");
    $qty_box_b		 			= mysql_result($wynik5reglkjtskms, 0, "qty_boxp");
    $nr_zam_b		 			= mysql_result($wynik5reglkjtskms, 0, "nr_zams");
	$dlug_testpp = strlen($part_no_b);

mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjts = "SELECT * FROM prod_parowaniekms WHERE barcodes='$kod'";
	   $wynik5reglkjts = mysql_query($kwerenda5reglkjts);
 	$rekordow5reglkjts = mysql_numrows($wynik5reglkjts);
 	mysql_close();
 	$testp	 			= mysql_result($wynik5reglkjts, 0, "barcode");
    $dlug_testp = strlen($testp);
    
    


	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no_b'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
     $dlug_qty_box_pr = strlen($qty_box_pr);
   


 
  $dlug_part_no = strlen($part_no);

  

if($dlug_testp >0){ echo "<font size='0'>"; echo include "par_wys_kms.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>SPRAWDZONA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }
	 							 	 
elseif($dlug_testpp>0 ){  session_start();
 						 $_SESSION['sbarcodes']=$kod;
 						 $_SESSION['spart_nos']=$part_no_b;
						 $_SESSION['sqty_boxs']=$qty_box_b;
							echo include "par_wys2_kms.php"; 
							
						$komunikat = "<center><B><FONT COLOR='#00aa00'>etykieta sprzedazowa ok $qty_box<BR>  
							               							</center><hr>";
						echo $komunikat;
						}	
elseif($dlug_testp >0){ echo "<font size='0'>"; echo include "par_wys_kms.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>SPRAWDZONA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	
 	
	  else{ echo "<font size='0'>"; echo include "par_wys_kms.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWA ETYKIETA LUB TO NIE JEST ETYKIETA SPRZEDAZOWA !!!  <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
