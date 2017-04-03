
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$part_nos=$_SESSION['spart_nos'];
$qty_boxs=$_SESSION['sqty_boxs'];
$dluglogin = strlen($login);
$kodzam=$_SESSION['s_kod_zamw'];

$kod2 	= $_POST['kod2'];
if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else {																	
	  $dlug = strlen($kod2);
      $data_rok = substr($kod2, 0,4);
      $data_mies = substr($kod2, 4,2);
      $data_dzien = substr($kod2, 6,2);
      $data_exp="$data_rok-$data_mies-$data_dzien";
      $lot_no_baza=substr($kod2, 0,8);
      $lot_no_z_k=substr($kod2, 0,8);
	  $dlug_kor=$dlug-18;

      $shinchang_part_no = substr($kod2, 8,$dlug_kor);



      $qty_box_st        = $dlug-9;
      $qty_box_end       = $dlug-4;
      $qty_box_rob       = substr($kod2, $qty_box_st,$qty_box_end);
      $qty_box		     = substr($qty_box_rob ,0,5);
      $qty_box_il		 = substr(str_replace("O", "", $qty_box_rob) ,5,5);
      
     		settype($qty_box, "integer");
		    settype($qty_boxs, "integer");


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';




	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjts = "SELECT * FROM prod_parowanieantolincz WHERE barcode='$kod2' and no_deli='$kodzam'";
	$wynik5reglkjts = mysql_query($kwerenda5reglkjts);
 	$rekordow5reglkjts = mysql_numrows($wynik5reglkjts);
 	mysql_close();
 	$testp	 			= mysql_result($wynik5reglkjts, 0, "part_name");
    $dlug_testp = strlen($testp);
    
    
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwer1 = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
	$wyn1 = mysql_query($kwer1);
 	$rek1 = mysql_numrows($wyn1);
 	mysql_close();
 	$part_nox	 			= mysql_result($wyn1, 0, "part_no");
 	$qty_box_pr	 			= mysql_result($wyn1, 0, "qty_box");
    $dlug_qty_box_pr = strlen($qty_box_pr);
    
    mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjtd = "SELECT * FROM prod_got_wys WHERE barcode='$kod2'";
	$wynik5reglkjtd = mysql_query($kwerenda5reglkjtd);
 	$rekordow5reglkjtd = mysql_numrows($wynik5reglkjtd);
 	mysql_close();
 	$part_no_barcod	 			= mysql_result($wynik5reglkjtd, 0, "part_no");
     $dlug_part_no_barcod = strlen($part_no_barcod);
 
   

if($dlug_testp>0){ echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>SPRAWDZONA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }			
elseif($dlug_qty_box_pr<1){ echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWILOWA LUB SPRZEDAZOWA ETYKIETA <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($dlug_part_no_barcod<1){ echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ETYKIETA NIEZAREJESTROWANA DO WYSYLKI !!!<BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }							
elseif($part_nox!==$part_nos) { echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEZGODNE REFERENCJE W ETYKIETACH !!!   !!!<BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($qty_box!==$qty_boxs) { echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEZGODNE ILOSC W ETYKIETACH !!!   !!!<BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }

 elseif(($part_nox===$part_nos) and ($qty_box===$qty_boxs)){  session_start();
 						 						$_SESSION['sbarcodep']=$kod2;
 						 						$_SESSION['spart_nop']=$part_nox;
						 						$_SESSION['sqty_boxp']=$qty_box;
												echo include "zapisz_parowanieantolincz.php"; 
							
												$komunikat = "<center><B><FONT COLOR='#00aa00'>etykieta PRODUKCYJNA  ok $qty_box<BR>  
							               							</center><hr>";
												echo $komunikat;
												}
	/*
 elseif($qty_box!=$qty_boxs){ echo "<font size='0'>"; echo include "par_wys2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWA ILOSC NA ETYKIECIE !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	*/	
	  else{ echo "<font size='0'>"; echo include "par_wys2_antolincz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>

TO NIE JEST ETYKIETA PRODUKCYJNA LUB NIEPRAWIDLOWA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

}							
							

?>
