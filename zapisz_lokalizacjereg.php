
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";

session_start();
$kod=$_SESSION['sbarcode'];
$nr_reg_bazae2=$_SESSION['snrreg'];
$lok_pal_bazae1=$_SESSION['snrregpal'];
$kodl 	= $_POST['kodl'];
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);


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
$qty_box		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$id  					= mysql_result($wynik, $a, "id");                 
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data 	 				= mysql_result($wynik, $a, "data");
$klient	 				= mysql_result($wynik, $a, "klient");
$nr_etyk	 			= mysql_result($wynik, $a, "nr_etyk");
$pole_odkl	 			= mysql_result($wynik, $a, "pole_odkl");
$stan_pop	 			= mysql_result($wynik, $a, "stan_prod");
$stan_wgot		 		= mysql_result($wynik, $a, "stan");
 
$dlugkod1 = strlen($kodl);

if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
elseif ($nr_reg_bazae2!== $kodl) {  echo "<font size='0'>"; echo include "zatw_lok.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB ETYKIETY ROZNE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							        ";
							echo "<font size='0'>$komunikat"; }
							else {
									
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="A_prz_reg";
                                                                $stan=$stan_pop-$stan_b;
                                                                 $stan_wgotb=$stan_wgot+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET stan='$stan_wgotb',stan_prod='$stan' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stan_wgotb','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                 	$kwerenda_zap_max_st = "UPDATE prod_st SET lok='$lok',login='$login',powod='$powod',barcode_we_gl='$kod',lok_sc='$kodl',lok_pal='$lok_pal_bazae1' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                  	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$kodl'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, $hmnb, "ilosc");
 																	$ilosc1=$ilosc_bazae1+1;
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$kodl'";
                                                                	
																	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
 																	
														
                                                                 
                                                                 echo include "aprcp_z_czytnikabb.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>Pudełko  $part_no  PUDEŁKA DODANE  DO $kodl <BR>  
							               							OK $part_no  $part_name BOX ADD $stan_b QUANTITY TO STORAGE</center><hr>";
																	echo $komunikat;
						                                          }


?>
</BODY>
</HTML>
