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
 
session_start();
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);
$kod 	= $_POST['kod'];


 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
elseif ($kod==="0"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrpz.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> P A L E T Y  </b> aby zdjac z Regalu</center></b><hr>";
																	echo $komunikat;}
elseif ($kod==="."){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrp.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> P A L E T Y  </b> aby miecić na Regale</center></b><hr>";
																	echo $komunikat;}
elseif ($kod===".."){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbrm.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> Wczytaj Kod<B> Z PUDELKA  </b> - MIGRACJA PUDELKA DO PALETY/LOKALIZACJI</center></b><hr>";
																	echo $komunikat;}
																	
else {																	
																


      session_start();
      $_SESSION['sbarcode']=$kod;
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
     $kwerenda5v = "SELECT * FROM prod_st WHERE barcode='$kod'";
     $wynik5v = mysql_query($kwerenda5v);
     $rekordow5v = mysql_numrows($wynik5v);
     mysql_close();
     $barcod	 			= mysql_result($wynik5v, $t, "barcode");	
     $lok_baza	 			= mysql_result($wynik5v, $t, "lok");						
     $lot_no_baza	 		= mysql_result($wynik5v, $t, "lot_no");
 
 
      if($lok_baza==="MG"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ NA REGALE /PAPECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; 
						  }
      elseif ($lok_baza==="MW"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							 echo "<font size='0'>$komunikat";
						   }
      elseif ($lok_baza==="MP"){ echo include "zatw_lokr.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>Zarejestruj pudelko<b> $part_no</b> na lokalizacji </center><hr>
							";
							 echo $komunikat;}

        else {  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
}
