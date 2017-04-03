<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################


function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);								// Zwraca TRUE jeli $d (czyli data) jest wypełniona
  return $flaga;
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";


$kodpal2 	= $_POST['kodpal'];
$zero="";
$p="BD";								


session_start();
$nr_zam_wys=$_SESSION['szam'];
$kodbox=$_SESSION['skodbox'];  							
																


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_st WHERE barcode='$kodbox'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $lok_ba 				= mysql_result($wynik5, 0, "lok");						
 $kodpal				= mysql_result($wynik5, 0, "lok_sc");
 $barcodeb				= mysql_result($wynik5, 0, "barcode");

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda5reglk = "SELECT * FROM prod_regal WHERE typ='PL' and nr_reg='$kodpal2'";
$wynik5reglk = mysql_query($kwerenda5reglk);
$rekordow5reglk = mysql_numrows($wynik5reglk);
mysql_close();
$kodpal_baza	 			= mysql_result($wynik5reglk, 0, "nr_reg");
$max_il_ba					= mysql_result($wynik5reglk, 0, "max_il");
$ilosc_ba					= mysql_result($wynik5reglk, 0, "ilosc");
$ilosc_bar=$ilosc_ba+1;

if ($kodpal_baza!==$kodpal2) {  echo "<font size='0'>"; echo include "wczyt_wys_man_pal_box.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY BOX<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

  elseif ($lok_ba==="MW"){ echo "<font size='0'>"; echo include "wczyt_wys_man_pal_box.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKA BOX JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($ilosc_bar>$max_il_ba){ echo "<font size='0'>"; echo include "wczyt_wys_man_pal_box.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NA TEJ PALECIE NIE ZMIESCI SIE JUZ PUDELKO BOX<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							
  elseif ($lok_ba==="MG"){ 
  																 session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MW";
																$powod="M_PAL-WYS";
																
																mysql_connect('localhost',$uzytkownik,$haslo);
																mysql_query('SET CHARSET latin2');
																@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																$kwerenda = "SELECT * FROM prod_st WHERE barcode='$kodbox'";
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
																						$stan_wys	 			= mysql_result($wynikwgot, 0, "stan_wys");
 																						$stan_glw_rob=$stan_glw-$qty_box_b;
 																						$stan_wys_rob=$stan_wys+$qty_box_b;
 																						
 																					                                                          						
																						 
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('$p','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_wys','$stan_wys_rob','$klient_b','$p','$lok_b','$login','$powod','$barcode_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_wys(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$nr_zam_wys','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_glw','$stan_glw_rob','$klient_b','$kodpal2','$lok_b','$login','$powod','$barcode_b','')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_sc='$kodpal2',lok_pal='$zero' WHERE barcode='$barcode_b'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlop);
                                                                						mysql_close();
                                                                							$kwerenda_max = "UPDATE prod_got SET stan='$stan_glw_rob',stan_wys='$stan_wys_rob' WHERE shinchang_part_no='$shinchang_part_no_b'";	
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_max);
                                                                						mysql_close();
                                                                 						$lok_pal_na_reg=$lok_sc_b;
                                                                 						
																  
																    
																
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
 																	$kwerenda5reglk2 = "SELECT * FROM prod_regal WHERE nr_reg='$kodpal2'";
									 								$wynik5reglk2 = mysql_query($kwerenda5reglk2);
 																	$rekordow5reglk2 = mysql_numrows($wynik5reglk2);
 																	mysql_close();
 																	$ilosc_bazae11	 			= mysql_result($wynik5reglk2, 0, "ilosc");
 																	$ilosc11=$ilosc_bazae11+1;
																	 
																	 $kwerenda_zap_max_stkk2 = "UPDATE prod_regal SET ilosc='$ilosc11' WHERE nr_reg='$kodpal2'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk2);
                                                                	mysql_close();
                                                                	
 									  							echo "<font size='0'>"; echo include "wczyt_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00aa00'>OK PODAJ BOX DODANY DO WYSYLKI<BR> PODAJ NR WYSYLKI  
							              ";
							echo "<font size='0'>$komunikat"; }							
							
  else{    echo "<font size='0'>"; echo include "wczyt_wys_man_pal.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PALETA NIE JEST ZAREJESTROWANA W SYSTEMIE <BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							
							


