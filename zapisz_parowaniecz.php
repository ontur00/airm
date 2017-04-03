
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$nr_wys=$_SESSION['s_kod_zamw'];
$login=$_SESSION['luzytkownik'];
$kodp=$_SESSION['sbarcodep'];
$kodp2=$_SESSION['sbarcodep2'];
$kods=$_SESSION['sbarcodes'];
$part_nos=$_SESSION['spart_nos'];
$qty_boxs=$_SESSION['sqty_boxs'];
$part_nop=$_SESSION['spart_nop'];
$qty_boxp=$_SESSION['sqty_boxp'];
$dlug_kodp2 = strlen($kodp2);
$kodzam=$_SESSION['s_kod_zamw'];
$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';





	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$part_name	 					= mysql_result($wynik5reglkjt, 0, "part_name");
 	$shinchang_part_no	 			= mysql_result($wynik5reglkjt, 0, "shinchang_part_no");
    $klient				 			= mysql_result($wynik5reglkjt, 0, "klient");
   
											 				
																
																
																
																						$kwerenda_zap_max = "INSERT INTO prod_parowaniecz(part_no,part_name,stan,login,powod,barcode,barcodes,barcode2,no_deli)
                                                                 						VALUES ('$part_no','$part_name','$qty_boxp','$login','parowanie','$kodp','$kods','$kodp2','$kodzam')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						
                                                                 						if($dlug_kodp2>2){
                                                                 						$kwerenda_zap_maxt = "INSERT INTO prod_got_wys(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('$nr_wys','$shinchang_part_no','$part_no','$part_name','$qty_boxp','$qty_boxp','$klient','z','z','$login','parowanie','$kodp2')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_maxt);
                                                                 						mysql_close();
                                                                 						mysql_connect('localhost',$uzytkownik,$haslo);
																						mysql_query('SET CHARSET latin2');
 																						
																						 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5reglkjtw = "SELECT * FROM zamowienia_zaw WHERE nr_zam = '$nr_wys' and part_no='$part_no'";
	   																					$wynik5reglkjtw = mysql_query($kwerenda5reglkjtw);
 																						$rekordow5reglkjtw = mysql_numrows($wynik5reglkjtw);
 																						mysql_close();
 																						$qty_box_we	 					= mysql_result($wynik5reglkjtw, 0, "qty_box");
                                                                 						$qty_box_we_all=$qty_box_we+$qty_boxp;
                                                                 						
																						 $kwerenda_zap_maxtw = "UPDATE zamowienia_zaw SET qty_box='$qty_box_we_all' WHERE nr_zam = '$nr_wys' and part_no='$part_no'";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_maxtw);
                                                                 						mysql_close();
                                                                 						
                                                                 						
                                                                 						
                                                                 						}$kodp2='';
																						 session_start();
																						 $_SESSION['sbarcodep2']=$kodp2;
                                                                 					
	 echo include "par_wyscz.php"; 
							
							
?>

