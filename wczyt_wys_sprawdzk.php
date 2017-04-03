
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";


$kodzam 	= $_POST['kodwys'];

  
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM zamowienia WHERE nr_zam='$kodzam' and status='O'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $nr_zam	 			= mysql_result($wynik5, 0, "nr_zam");						

 $dl_na_zamb= strlen($nr_zam); 
  $dl_na_zam= strlen($kodzam); 
 
 if(($dl_na_zam<8)or($dl_na_zamb<8)){ echo "<font size='0'>"; echo include "wyczyt_wysk.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY NR WYSYLKI LUB WYSYLKA ZAMKNIETA<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }					

 else { 

  																 session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="WZ";
																$powod="M_ZAM-WYS";
																
																mysql_connect('localhost',$uzytkownik,$haslo);
																mysql_query('SET CHARSET latin2');
																@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																$kwerenda = "SELECT * FROM prod_got_wys WHERE pojazd='$kodzam'";
																$wynik = mysql_query($kwerenda);
																$rekordow = mysql_numrows($wynik);
																mysql_close();
																$a = 0;
																while ($a < $rekordow) 
																{
																$pojazd_b				= mysql_result($wynik, $a, "pojazd");		
																$part_no_b  			= mysql_result($wynik, $a, "part_no");
																$part_name_b			= mysql_result($wynik, $a, "part_name");	
																	
	    														$klient_b				= mysql_result($wynik, $a, "klient");
																$lok_b					= mysql_result($wynik, $a, "pole_odkl");
																$barcode_b				= mysql_result($wynik, $a, "barcode");
																$lok_sc_b				= mysql_result($wynik, $a, "nr_lok");
																$lok_pal_b				= mysql_result($wynik, $a, "lok_pal");
																$shinchang_part_no_b 	= mysql_result($wynik, $a, "shinchang_part_no");
															
																		mysql_connect('localhost',$uzytkownik,$haslo);
																		mysql_query('SET CHARSET latin2');
																		@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																		$kwerendaspr = "SELECT * FROM prod_got_wysz WHERE barcode='$barcode_b'";
																		$wynikspr = mysql_query($kwerendaspr);
																		$rekordowspr = mysql_numrows($wynikspr);
																		mysql_close();
																		$part_no_bazaa				= mysql_result($wynikspr, 0, "part_no");
																	    $dlugpart_no_bazaa = strlen($part_no_bazaa);
																	    
																         if($dlugpart_no_bazaa<1){
																 		
																									$kod 	= $barcode_b;																
																									$dlug = strlen($kod);
																									$data_rok = substr($kod, 0,4);
																									$data_mies = substr($kod, 4,2);
																									$data_dzien = substr($kod, 6,2);
																									$data_exp="$data_rok-$data_mies-$data_dzien";
																									$dlug_kor=$dlug-18;
																									$shinchang_part_no = substr($kod, 8,$dlug_kor);
																									$qty_box_st        = $dlug-9;
																									$qty_box_end       = $dlug-4;
																									$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
																									$qty_box_b		   = substr($qty_box_rob ,0,5);

			
																									mysql_connect('localhost',$uzytkownik,$haslo);
																									mysql_query('SET CHARSET latin2');
																									@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																									$kwerendawgot = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no_b'";
																									$wynikwgot = mysql_query($kwerendawgot);
																									$rekordowwgot = mysql_numrows($wynikwgot);
																									mysql_close();			 
																					
																									$stan_wys	 			= mysql_result($wynikwgot, 0, "stan_wys");
 																									$stan_wys_rob=$stan_wys-$qty_box_b;

                                                                 									$kwerenda_zapw_max2 = "INSERT INTO prod_got_wysz(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 									VALUES ('$kodzam','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_wys','$stan_wys_rob','$klient_b','$lok_sc_b','$lok_b','$login','$powod','$barcode_b','$lok_pal_b')";
                                                                  									mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 									mysql_query("SET NAMES 'latin2'");
                                                                 									mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                									@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 									mysql_query($kwerenda_zapw_max2);
                                                                 									mysql_close();
                                                                 						
																									 $kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_pal='$zero' WHERE barcode='$barcode_b'";
                                                                									mysql_connect('localhost',$uzytkownik,$haslo);
                                                                									mysql_query("SET NAMES 'latin2'");
                                                                									mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   									@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                									mysql_query($kwerenda_zap_max_stlop);
                                                                									mysql_close();
                                                                									$kwerenda_max = "UPDATE prod_got SET stan_wys='$stan_wys_rob' WHERE shinchang_part_no='$shinchang_part_no_b'";	
                                                                									mysql_connect('localhost',$uzytkownik,$haslo);
                                                                									mysql_query("SET NAMES 'latin2'");
                                                                									mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                									@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                									mysql_query($kwerenda_max);
                                                                									mysql_close();
                                                                 									$lok_pal_na_reg=$lok_pal_b;
                                                                 						
                                                                 						
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
                                                                									
                                                                 						
																      								echo"referencja $part_no_b nazwa $part_name_b w ilosci $qty_box_b wysłana $a <br>"; 
																									}
																									else{ echo"DUPLIKACJA referencja $part_no_b nazwa $part_name_b w ilosci $qty_box_b wysłana $a <br>"; }               
																									$a++;	
																   }
																    
																 mysql_connect('localhost',$uzytkownik,$haslo);
																 mysql_query('SET CHARSET latin2');
 																@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																$kwerenda5 = "UPDATE zamowienia SET status='Z' WHERE nr_zam='$kodzam'";
 																$wynik5 = mysql_query($kwerenda5);
 																$rekordow5 = mysql_numrows($wynik5);
 																mysql_close();
                                                                 						
														
                                                                	
 									  							echo "<font size='0'>"; echo include "wyczyt_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00aa00'>OK WYSYLKA NR $kodzam  ZAMKNIETA - WYSLANA DO KLIENTA<BR>  
							              ";
							echo "<font size='0'>$komunikat"; }	




