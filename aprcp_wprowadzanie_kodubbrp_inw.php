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


$kodpal 	= $_POST['kodpal'];

								


session_start();
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);

$_SESSION['skodpal']=$kodpal;
$kod_regal=$_SESSION['s_kod_regal'];																	
 $dlugpost = strlen($kodpal);																
$dlkod_regal = strlen($kod_regal)

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_st WHERE lok_sc='$kodpal'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $lok_baza	 			= mysql_result($wynik5, $t, "lok_pal");	
 $lok_ba 				= mysql_result($wynik5, $t, "lok");						
session_start();
$_SESSION['slokpal']=$lok_ba;

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda5reglk = "SELECT * FROM prod_regal WHERE typ='P' and nr_reg='$kodpal'";
$wynik5reglk = mysql_query($kwerenda5reglk);
$rekordow5reglk = mysql_numrows($wynik5reglk);
mysql_close();
$kodpal_baza	 				= mysql_result($wynik5reglk, $hmnb, "nr_reg");
$max_ilosc_regalb	 			= mysql_result($wynik5reglk, $hhk, "max_il");	
$ilosc_regalb	 				= mysql_result($wynik5reglk, $hhk, "ilosc");	
$ilosc_regalbrob=$ilosc_regalb+1;
	   	   							


$dllok_baza=strlen($lok_baza);

		
 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

elseif (($kodpal_baza!==$kodpal)or($dlugpost<7)) {  echo "<font size='0'>"; echo include "lok_reg_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD MIEJSCA PALETOWEGO<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($dlkod_regal<6)
									{ echo "<font size='0'>"; echo include "wcz_lokr_inw.php"; 
											$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTAJ JESZCZE RAZ KOD PALETY <BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
									  echo "<font size='0'>$komunikat dane z bazy $ilosc_regalbrob>$max_ilosc_regalb"; 
						  			}  

elseif($ilosc_regalbrob>$max_ilosc_regalb)
									{ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php"; 
											$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NA REGALE  NIE ZMIESCI SIE JUZ ZADNA PALETA<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
									  echo "<font size='0'>$komunikat dane z bazy $ilosc_regalbrob>$max_ilosc_regalb"; 
						  			}  
  else{ 
                                    
																			  session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MG";
																$powod="I_PAL-REG";
                                                                    $kwerenda_zap_max_stlop = "UPDATE prod_st SET lok_pal='$kodpal',login='$login',powod='$powod' WHERE lok_sc='$kod_regal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stlop);
                                                                	mysql_close();
																
																	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$kod_regal'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, $hmnb, "ilosc");
 																	$ilosc1=$ilosc_bazae1+1;
																	 
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$kod_regal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
 																	
														         $kwerenda_zap_maxstkk = "INSERT INTO prod_got_pal(pal_no,m_pop,m,login,powod,n_lok)
                                                                 VALUES ('$kod_pal','$lok_w_baza','$magazyn1','$login','$powod','$kod_regal')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxstkk);
                                                                 mysql_close();
                                                             
                                                                 echo include "wcz_lokr_inw.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>PALETA  $kodpal  DODANA  DO $kod_regal <BR>  
							               							OK PALETE  $kod_pal  add to $kod_regal </center><hr>";
																	echo $komunikat;
																    session_start();
																	$_SESSION['s_kod_regal']="";
						                                          }
                                                                 
							
							


