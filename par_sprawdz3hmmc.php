
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
$kod_sprzed1=$_SESSION['sbarcodes'];
$dluglogin = strlen($login);


$kod 	= $_POST['kod'];


if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else {																	
	    						     
 if($kod_sprzed1===$kod){ 
												echo include "zapisz_parowaniehmmc.php"; 
							
												$komunikat = "<center><B><FONT COLOR='#00aa00'>etykieta SPRZEDAZOWA DRUGA!(2) OK $qty_box<BR>  
							               							</center><hr>";
												echo $komunikat;
												}
	/*
 elseif($qty_box!=$qty_boxs){ echo "<font size='0'>"; echo include "par_wys2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWA ILOSC NA ETYKIECIE !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	*/	
	  else{ echo "<font size='0'>"; echo include "par_wys3_hmmc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>DRUGA!(2) SPRZEDAZOWA NIEZGODNA LUB NIEPRAWIDLOWA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

}							
							

?>
