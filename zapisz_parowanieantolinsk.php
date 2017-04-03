
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$kodp=$_SESSION['sbarcodep'];
$kods=$_SESSION['sbarcodes'];
$part_nos=$_SESSION['spart_nos'];
$qty_boxs=$_SESSION['sqty_boxs'];
$part_nop=$_SESSION['spart_nop'];
$qty_boxp=$_SESSION['sqty_boxp'];
$kodzam=$_SESSION['s_kod_zamw'];

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';





	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_nos'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$part_name	 			= mysql_result($wynik5reglkjt, 0, "part_name");
   
   
											 				
																
																
																
																						$kwerenda_zap_max = "INSERT INTO prod_parowanieantolinsk(part_no,part_name,stan,login,powod,barcode,barcodes,no_deli)
                                                                 						VALUES ('$part_nos','$part_name','$qty_boxp','$login','parowanie','$kodp','$kods','$kodzam')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 					
	 echo include "par_wys_antolinsk.php"; 
							
							
?>

