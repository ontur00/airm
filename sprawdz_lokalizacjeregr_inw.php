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

      $baza 		= 'barcod';
      $uzytkownik = 'robak';
      $haslo 		= 'robak1';



$kod_regal 	= $_POST['kod_regal'];

session_start();
$_SESSION['s_kod_regal']=$kod_regal;
 
                                     mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5reg = "SELECT * FROM prod_regal WHERE  (typ='B' or typ='PL' or typ='M') and nr_reg='$kod_regal'";
									 $wynik5reg = mysql_query($kwerenda5reg);
 									$rekordow5reg = mysql_numrows($wynik5reg);
 									mysql_close();
 									$nr_reg_bazae1	 			= mysql_result($wynik5reg, $hhk, "nr_reg");	
		

 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
elseif ($nr_reg_bazae1!==$kod_regal) {  echo "<font size='0'>"; echo include "wcz_lokr_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY REGALU / PALETY<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							else {
									
		                                                    
                                                                 
                                                                 echo include "aprcp_z_czytnikabbr_inw.php";
                                                                 /*mysql_connect('localhost',$uzytkownik,$haslo);
									 							mysql_query('SET CHARSET latin2');
 																@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																$kwerenda5regg = "UPDATE prod_st SET lok='GI',lok_sc='',lok_pal='', inw='' WHERE  lok_sc='$kod_regal' and lok='MG'";
									 							$wynik5regg = mysql_query($kwerenda5regg);
 																$rekordow5regg = mysql_numrows($wynik5regg);
 																mysql_close();*/
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>Kod regalu/palety $kod_regal wczytany OK PODAJ KOD PUDELKA BOX <BR>  
							               							OK $part_no  $part_name BOX ADD $stan_b QUANTITY TO STORAGE</center><hr>";
																	echo $komunikat;
						                                          }


?>
</BODY>
</HTML>
