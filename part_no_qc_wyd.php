
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

$kodrew 	= $_POST['kodrew'];
$zero="";
$p="BD";																
																



$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_st WHERE barcode='$kodrew'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $lok_baza	 			= mysql_result($wynik5, $t, "lok");						
 $lok_szcz	 		    = mysql_result($wynik5, $t, "lok_sc");
 $lok_pal	 		    = mysql_result($wynik5, $t, "lok_pal"); 
 
 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
	echo "<font size='0'>$komunikat"; 
		 }
 elseif($lok_baza==="MP"){ echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO NIE JEST PRZYJETE NA REGAL /PAPECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="MW"){ echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="PR"){ echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ PRZEKAZANE DO REWORK<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="QC"){ echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ PRZEKAZANE DO QUALITY<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							
  elseif ($lok_baza==="ZB"){ echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ PRZEKAZANE DO STREFA ZABLOKOWANA<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="MG"){ 
   																session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="QC";
																$powod="M_BOX_QC";
																
																mysql_connect('localhost',$uzytkownik,$haslo);
																mysql_query('SET CHARSET latin2');
																@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																$kwerenda = "SELECT * FROM prod_st WHERE barcode='$kodrew'";
																$wynik = mysql_query($kwerenda);
																$rekordow = mysql_numrows($wynik);
																mysql_close();
																$lot_no_b				= mysql_result($wynik, 0, "lot_no");		
																$part_no_b  			= mysql_result($wynik, 0, "part_no");
																$part_name_b			= mysql_result($wynik, 0, "part_name");	
																$qty_box_b				= mysql_result($wynik, 0, "qty_box");
	    														$klient_b				= mysql_result($wynik, 0, "klient");
																$lok_b					= mysql_result($wynik, 0, "lok");
																$barcode_b				= mysql_result($wynik, 0, "barcode");
																$lok_sc_b				= mysql_result($wynik, 0, "lok_sc");
																$lok_pal_b				= mysql_result($wynik, 0, "lok_pal");
																$shinchang_part_no_b 	= mysql_result($wynik, 0, "shinchang_part_no");
																
																						mysql_connect('localhost',$uzytkownik,$haslo);
																						mysql_query('SET CHARSET latin2');
																						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																						$kwerendawgot = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no_b'";
																						$wynikwgot = mysql_query($kwerendawgot);
																						$rekordowwgot = mysql_numrows($wynikwgot);
																						mysql_close();			 
																						$stan_glw	 			= mysql_result($wynikwgot, 0, "stan");
																						$stan_blok	 			= mysql_result($wynikwgot, 0, "stan_blok");
 																						$stan_glw_rob=$stan_glw-$qty_box_b;
 																						$stan_blok_rob=$stan_blok+$qty_box_b;
 																						
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('$p','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_glw','$stan_glw_rob','$klient_b','$p','$lok_b','$login','$powod','$barcode_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_qc(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$p','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_blok','$stan_blok_rob','$klient_b','$lok_sc_b','$lok_b','$login','$powod','$barcode_b','$lok_pal_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_sc='$zero',lok_pal='$zero' WHERE barcode='$barcode_b'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlop);
                                                                						mysql_close();
                                                                							$kwerenda_max = "UPDATE prod_got SET stan='$stan_glw_rob',stan_blok='$stan_blok_rob' WHERE shinchang_part_no='$shinchang_part_no_b'";	
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
 																						$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$lok_sc_b'";
									 													$wynik5reglk = mysql_query($kwerenda5reglk);
 																						$rekordow5reglk = mysql_numrows($wynik5reglk);
 																						mysql_close();
 																						$ilosc_bazae1	 			= mysql_result($wynik5reglk, 0, "ilosc");
 																						$ilosc1=$ilosc_bazae1-1;
																	 
																						 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$lok_sc_b'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stkk);
                                                                						mysql_close();
  
  
  
  
  
  
  
                                    
					        echo include "wyczyt_wys.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>PUDELKO <b> $part_no WYSLANE Z MAGAZYNU DO QUALITY</b> <br>
							              </center><hr>";	
							echo $komunikat;}
													  						

 else {  echo "<font size='0'>"; echo include "czyt_part_qc.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

							
							


