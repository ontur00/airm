
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php

session_start();
$login=$_SESSION['luzytkownik'];
$kodzam=$_SESSION['s_kod_zamw'];
$dluglogin = strlen($login);



if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else {																	
	  $kod=$_SESSION['sbarcode'];
      $part_no=$_SESSION['spart_no'];															
      $dlug = strlen($kod);
      $data_rok = substr($kod, 0,4);
      $data_mies = substr($kod, 4,2);
      $data_dzien = substr($kod, 6,2);
      $data_exp="$data_rok-$data_mies-$data_dzien";
      $lot_no_z_k=substr($kod, 0,8);
	  $dlug_kor=$dlug-18;

      $part_no = substr($kod, 14,11);



      $qty_box_st        = $dlug-9;
      $qty_box_end       = $dlug-4;
      $qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
      $qty_box		     = substr($kod ,10,4);
      $qty_box_il		 = substr(str_replace("O", "", $qty_box_rob) ,5,5);
		settype($qty_box, "integer");

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

    mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no' and io='P'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
 	$kod_alc_n	 			= mysql_result($wynik5reglkjt, 0, "nr_etyk");
 	$shinchang_part_no	 	= mysql_result($wynik5reglkjt, 0, "shinchang_part_no");



 

	$lok_br='';
										
	
																
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM zamowienia_zaw WHERE nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $id_zaw	 			= mysql_result($wynik5, 0, "id");
 $nr_zam	 			= mysql_result($wynik5, 0, "nr_zam");
 $klient	 			= mysql_result($wynik5, 0, "klient");
 $part_no	 			= mysql_result($wynik5, 0, "part_no");
 $part_name 			= mysql_result($wynik5, 0, "part_name");
 $qty_przyg	 			= mysql_result($wynik5, 0, "qty_box");
 $qty_zam	 			= mysql_result($wynik5, 0, "qty_zam");
 $lot_no	 			= mysql_result($wynik5, 0, "data");						

  mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerendalv = "SELECT * FROM prod_kody WHERE code='$kodzam'";
 $wyniklv = mysql_query($kwerendalv);
 $rekordowlv = mysql_numrows($wyniklv);
 mysql_close();
 $nr_code	 			= mysql_result($wyniklv, 0, "code");						
 $nr_opis	 			= mysql_result($wyniklv, 0, "opis");
 $dl_nr_code= strlen($nr_code); 
 
 
 
 
 
																session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MW";
																$powod="AUTO-WYS";
																$lok="MW";	 				
																
																
																
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','','$magazyn1','$login','$powod','$kod')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_wys(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$kodzam','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','$lok_pal_na_reg','$magazyn1','$login','$powod','$kod','$lok_pal_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						
                                                                 						
                                                                 						
                                                                 	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,shinchang_part_no,nr_wys)
                                                                 	VALUES ('$data_exp','$part_no','$part_name','$qty_box','$stan','$klient','$lok','$login','$powod','$kod','$kod','$shinchang_part_no','$kodzam')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                						
                                                                						
                                                                						
                                                                							$kwerenda_zap_max_stloplfifo = "UPDATE prod_fifo SET status='Z' WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no' and ilosc='$qty_box' and  nr_zlec='$kodzam' and status='P' and lokal='$lok_pal_na_reg' LIMIT 1";
																							mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							mysql_query("SET NAMES 'latin2'");
                                                                							mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   							@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							mysql_query($kwerenda_zap_max_stloplfifo);
                                                                							mysql_close();
                                                                						
																						 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5h = "SELECT * FROM zamowienia_zaw WHERE  nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
 																						$wynik5h = mysql_query($kwerenda5h);
 																						$rekordow5h = mysql_numrows($wynik5h);
 																						mysql_close();
 																						$id_zaw		 			= mysql_result($wynik5h, 0, "id");
																						$qty_przyg	 			= mysql_result($wynik5h, 0, "qty_box");
 																						$qty_przygr=$qty_przyg+$qty_box;
 																						
																						 $kwerenda_zap_max_stlopk = "UPDATE zamowienia_zaw SET qty_box='$qty_przygr' WHERE id='$id_zaw'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopk);
                                                                						mysql_close();
                                                                 						
																                       				 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hh = "SELECT * FROM zamowienia WHERE  nr_zam='$kodzam'";
 																						$wynik5hh = mysql_query($kwerenda5hh);
 																						$rekordow5h = mysql_numrows($wynik5hh);
 																						mysql_close();
 																						$id_zam	 			= mysql_result($wynik5hh, 0, "id");
																						$nobox_tt	 			= mysql_result($wynik5hh, 0, "no_box");
 																						$nobox_tte=$nobox_tt+1;
 																						
																						 $kwerenda_zap_max_stlopkh = "UPDATE zamowienia SET no_box='$nobox_tte', status='P' WHERE id='$id_zam'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopkh);
                                                                						mysql_close();
																	
																 
																    
																
																	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$lok_pal_na_reg'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, 0, "ilosc");
 																	$ilosc1=$ilosc_bazae1-1;
																	 
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$lok_pal_na_reg'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
                                                                	   				    mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hhqw = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
 																						$wynik5hhqw = mysql_query($kwerenda5hhqw);
 																						$rekordow5hqw = mysql_numrows($wynik5hhqw);
 																						mysql_close();
 																						$id_prod	 			= mysql_result($wynik5hhqw, 0, "id");
																						$stan_rob	 			= mysql_result($wynik5hhqw, 0, "stan");
                                                                						$stan_wys_rob			= mysql_result($wynik5hhqw, 0, "stan_wys");
                                                                						
                                                                						$stan_wys_robr=$stan_wys_rob+$qty_box;
                                                                						
                                                                							 $kwerenda_zap_max_stkkhqw = "UPDATE prod_got SET stan_wys='$stan_wys_robr' WHERE id='$id_prod'";
                                                                							 mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							 mysql_query("SET NAMES 'latin2'");
                                                                							 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                							 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							 mysql_query($kwerenda_zap_max_stkkhqw);
                                                                							 mysql_close();
 									  						

 echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
						
						$komunikat = "<center><B><FONT COLOR='#00aa00'>BOX zarejestrowany na wysylke nr $kodzam <BR>  
							               							</center><hr>";
																	echo $komunikat;
      }
      
      

							


