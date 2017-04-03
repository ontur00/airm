<?php


session_start();
$login=$_SESSION['luzytkownik'];
$magazyn1="MW";
$powod="AUTO-WYS";
																		
													
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
$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_pal='$zero',nr_wys='$kodzam' WHERE barcode='$kod'";
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda_zap_max_stlop);
mysql_close();
																			
$kwerenda_zap_max_stloplfifo = "UPDATE prod_fifo SET status='Z' WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no'  and nr_zlec='$kodzam' and status='P'  LIMIT 1";
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda_zap_max_stloplfifo);
mysql_close();
																			
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleźć bazy danych!");
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
@mysql_select_db($baza) or die("Nie można znaleźć bazy danych!");
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
@mysql_select_db($baza) or die("Nie można znaleźć bazy danych!");
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
@mysql_select_db($baza) or die("Nie można znaleźć bazy danych!");
$kwerenda5hhqw = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynik5hhqw = mysql_query($kwerenda5hhqw);
$rekordow5hqw = mysql_numrows($wynik5hhqw);
mysql_close();
$id_prod	 			= mysql_result($wynik5hhqw, 0, "id");
$stan_rob	 			= mysql_result($wynik5hhqw, 0, "stan");
$stan_wys_rob			= mysql_result($wynik5hhqw, 0, "stan_wys");
$stan_robr=$stan_rob-$qty_box;
$stan_wys_robr=$stan_wys_rob+$qty_box;
																			
$kwerenda_zap_max_stkkhqw = "UPDATE prod_got SET stan='$stan_robr',stan_wys='$stan_wys_robr' WHERE id='$id_prod'";
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda_zap_max_stkkhqw);
mysql_close();
												

echo "<font size='0'>"; 
echo include "podaj_part_no_wys.php"; 
			
$komunikat = "<center><B><FONT COLOR='#00aa00'>BOX zarejestrowany na wysylke nr $kodzam <BR>  
</center><hr>";
echo $komunikat;



?>