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
$kwerenda5reglk = "SELECT * FROM prod_regal WHERE typ='PL' and nr_reg='$kodpal'";
$wynik5reglk = mysql_query($kwerenda5reglk);
$rekordow5reglk = mysql_numrows($wynik5reglk);
mysql_close();
$kodpal_baza	 			= mysql_result($wynik5reglk, $hmnb, "nr_reg");
$dllok_baza=strlen($lok_baza);

		

 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
elseif ($kodpal_baza!==$kodpal) {  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrpz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY PALETY<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($dllok_baza>1){
									
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
																$powod="M_PAL-BEZ";
                                                                    $kwerenda_zap_max_stlop = "UPDATE prod_st SET lok_pal='',login='$login',powod='$powod' WHERE lok_sc='$kodpal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stlop);
                                                                	mysql_close();
																
													
 										
 																	$ilosc1=0;
																	 
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET max_il='44', ilosc='$ilosc1' WHERE nr_reg='$kodpal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
 																	
														         $kwerenda_zap_maxstkk = "INSERT INTO prod_got_pal(pal_no,m_pop,m,login,powod,n_lok)
                                                                 VALUES ('$kodpal','$lok_baza','','$login','$powod','')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxstkk);
                                                                 mysql_close();
                                                                 
                                                                                                                                 	
                                                                 echo include "aprcp_z_czytnikabbr.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>PALETA  $kodpal  USUNIETA Z $kod_regal <BR>  
							               							OK PALETE  $kodpal  deleto $kod_regal </center><hr>";
																	echo $komunikat;
						                                          }
  else{ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrpz.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PALETA NIE JEST ZEREJESTROWANA<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
 


