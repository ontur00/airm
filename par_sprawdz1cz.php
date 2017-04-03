
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$klients=$_SESSION['sklient_par'];
$dluglogin = strlen($login);


$kod 	= $_POST['kod'];
if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }else{

																
																
       $dlug = strlen($kod);
      $data_rok = substr($kod, 4,2);
      $data_mies = substr($kod, 2,2);
      $data_dzien = substr($kod, 0,2);
      $data_exp="$data_rok-$data_mies-$data_dzien";
      $lot_no_baza=substr($kod, 0,8);
      $lot_no_z_k=substr($kod, 0,6);
	  $dlug_kor=$dlug-18;
      $znacek="-";
      $part_no1 = substr($kod, 14,5);
      $part_no2 = substr($kod, 19,19);
      $part_no="$part_no1$znacek$part_no2";
      $qty_box		   = substr($kod ,10,4);
	   settype($qty_box, "integer");
      $no_box  		   = substr($kod ,6,4);
	  settype($qty_box, "integer");

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjts = "SELECT * FROM prod_parowaniecz WHERE barcodes='$kod'";
	   $wynik5reglkjts = mysql_query($kwerenda5reglkjts);
 	$rekordow5reglkjts = mysql_numrows($wynik5reglkjts);
 	mysql_close();
 	$testp	 			= mysql_result($wynik5reglkjts, 0, "barcode");
    $dlug_testp = strlen($testp);
    
    


	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
 	$klient_pr	 			= mysql_result($wynik5reglkjt, 0, "klient");
     $dlug_qty_box_pr = strlen($qty_box_pr);
   


 
  $dlug_part_no = strlen($part_no);

  

if($dlug_testp >0){ echo "<font size='0'>"; echo include "par_wyscz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>SPRAWDZONA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	
  
elseif(($dlug_qty_box_pr>0) and (($klients===$klient_pr)or($klient_pr==='MOBIS'))){  
							session_start();
 						 $_SESSION['sbarcodes']=$kod;
 						 $_SESSION['spart_nos']=$part_no;
						 $_SESSION['sqty_boxs']=$qty_box;
							echo include "par_wys2cz.php"; 
							
						$komunikat = "<center><B><FONT COLOR='#00aa00'>etykieta sprzedazowa ok<BR>  
							               							</center><hr>";
						echo $komunikat;
						}	
elseif($dlug_testp >0){ echo "<font size='0'>"; echo include "par_wyscz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>SPRAWDZONA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; 
							 }	
 	
	  else{ echo "<font size='0'>"; echo include "par_wyscz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>TO NIE JEST ETYKIETA SPRZEDAZOWA LUB NIEPRAWIŁOWA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

	}						

?>
