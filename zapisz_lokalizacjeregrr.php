<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-05-2011 ############################################


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

session_start();
$kod=$_SESSION['sbarcode'];
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);
$lok_szcz=$_SESSION['slokszcz']; 
$lok_pal=$_SESSION['slokpal']; 
$kod_regal 	= $_POST['kod_regal'];
$dlug = strlen($kod);
$zn=$_SESSION['sz'];
 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
elseif($dlug<1){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrr.php"; 
					$komunikat = "<center><B><FONT COLOR='#aa0000'><font size='1'> BLAD ZMIENNEJ PRZEGLADARKA Wczytaj Kod<B> Z PUDELKA  </b> - MIGRACJA PUDELKA DO PALETY/LOKALIZACJI</center></b><hr>";
																	echo $komunikat;}
else{



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
 




                                   mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5reg = "SELECT * FROM prod_regal WHERE (typ='PL' or typ='B' OR typ='M') and nr_reg='$kod_regal'";
									 $wynik5reg = mysql_query($kwerenda5reg);
 									$rekordow5reg = mysql_numrows($wynik5reg);
 									mysql_close();
 									$nr_reg_bazae1	 			= mysql_result($wynik5reg, $hhk, "nr_reg");	
									$ilosc_reg_bazae1	 			= mysql_result($wynik5reg, $hhk, "ilosc");	
									$ilosc_reg_maxbazae1	 			= mysql_result($wynik5reg, $hhk, "max_il");
									$ilosc_reg_maxbazae11=$ilosc_reg_bazae1+1;



if ($nr_reg_bazae1!==$kod_regal) {  echo "<font size='0'>"; echo include "zatw_lokrr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY REGALU PALETOWEGO<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

						
							else {
									
		                                                      session_start();
                                                               
                                                                $magazyn1="MG";
																$powod="M_prz_rew";
                                                                    
																	 mysql_connect('localhost',$uzytkownik,$haslo);
 																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	 $kwerenda5 = "SELECT * FROM prod_st WHERE lok_sc='$kod_regal'";
 																	 $wynik5 = mysql_query($kwerenda5);
 																	 $rekordow5 = mysql_numrows($wynik5);
 																	mysql_close();
 																	$lok_szczn	 		    = mysql_result($wynik5, $t, "lok_sc");
 																	$lok_paln	 		    = mysql_result($wynik5, $t, "lok_pal");
																	if($zn==='Z'){
																	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,barcode_we_gl,shinchang_part_no)
                                                                 					VALUES ('$data_exp','$part_no','$part_name','$qty_box','$stan_wgot','$klient','MG','$login','$powod','$kod','$kod','$kod','$shinchang_part_no')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();$zn='';$_SESSION['sz']=$zn;}
                                                                	else{
																	$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='MG',lok_sc='$kod_regal',lok_pal='$lok_paln',login='$login',powod='$powod' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stlop);
                                                                	mysql_close();}
                                                                	
																$stanwbotqty=$stan_wgot+$qty_box;
 												               $kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stanwbotqty','$klient','$nr_etyk','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_max);
                                                                 mysql_close();
                                                                $kwerenda_zap_max = "INSERT INTO prod_got_rework(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stanwbotqty','$klient','$kod_regal','MG','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_max);
                                                                 mysql_close();
                                                                 
                                                                 mysql_connect('localhost',$uzytkownik,$haslo);
																 mysql_query('SET CHARSET latin2');
																 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
																 $kwerendastan = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
																 $wynikstan = mysql_query($kwerendastan);
																 $rekordowstan = mysql_numrows($wynikstan);
																 mysql_close();
																 $id  					= mysql_result($wynikstan, $a, "id");                 
																 $stan					= mysql_result($wynikstan, $a, "stan");
                                                                 $standobaza=$stan+$qty_box;
																 
																    $kwerenda_zap_max_stlopst = "UPDATE prod_got SET stan='$standobaza' WHERE id='$id'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stlopst);
                                                                	mysql_close();
																                                                                  
                                                                 
                                                                 echo include "aprcp_z_czytnikabbrr.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>PUDELKO BOX  $part_no  przeniesione z $lok_szcz  DO $kod_regal <BR>  
							               						 </center><hr>";
																	echo $komunikat;
						                                          }

}
?>
</BODY>
</HTML>
