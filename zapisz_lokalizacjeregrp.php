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
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);
$kod_pal =$_SESSION['skodpal'];

$lok_w_baza=$_SESSION['slokpal'];
$kod_regal 	= $_POST['kod_regal'];


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

                                   mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5reg = "SELECT * FROM prod_regal WHERE typ='P' and nr_reg='$kod_regal'";
									 $wynik5reg = mysql_query($kwerenda5reg);
 									$rekordow5reg = mysql_numrows($wynik5reg);
 									mysql_close();
 									$nr_reg_bazae1	 			= mysql_result($wynik5reg, 0, "nr_reg");	
									$ilosc_reg_bazae1	 			= mysql_result($wynik5reg, 0, "ilosc");	
									$ilosc_reg_maxbazae1	 			= mysql_result($wynik5reg, 0, "max_il");
									$ilosc_reg_maxbazae11=$ilosc_reg_bazae1+1;
									
									
									           						mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglkh = "SELECT * FROM prod_regal WHERE nr_reg='$kod_pal'";
									 								$wynik5reglkh = mysql_query($kwerenda5reglkh);
 																	$rekordow5reglkh = mysql_numrows($wynik5reglkh);
 																	mysql_close();
 																	$ilosc_paletanareg	 			= mysql_result($wynik5reglkh, 0, "il_pal");
 																	$iloss_na_paletar	 			= mysql_result($wynik5reglkh, 0, "ilosc");


if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

elseif ($nr_reg_bazae1!==$kod_regal) {  echo "<font size='0'>"; echo include "zatw_lokrp.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY REGALU PALETOWEGO<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

elseif ($ilosc_reg_maxbazae11>$ilosc_reg_maxbazae1) {  echo "<font size='0'>"; echo include "zatw_lokrp.php"; 
	    $komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
		NA TYM REGAKLE NIE ZMIESCI SIE JUZ ZADNA PALETA <BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
		echo "<font size='0'>$komunikat"; }
						
							else {
									
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MG";
																$powod="M_PAL-REG";
                                                                    $kwerenda_zap_max_stlop = "UPDATE prod_st SET lok_pal='$kod_regal',login='$login',powod='$powod' WHERE lok_sc='$kod_pal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stlop);
                                                                	mysql_close();
																
																
 																	$ilosc1=1;
																	 
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
                                                                 
                                                     
                                                                 
                                                                  $kwerenda_zap_max_stkkg = "UPDATE prod_regal SET max_il='$ilosc_paletanareg' WHERE nr_reg='$kod_pal'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkkg);
                                                                	mysql_close();
                                                                	
                                                                 echo include "aprcp_z_czytnikabbrp.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>PALETA  $kod_pal  DODANA  DO $kod_regal <BR>  
							               							OK PALETE  $kod_pal  add to $kod_regal </center><hr>";
																	echo $komunikat;
						                                          }


?>
</BODY>
</HTML>
