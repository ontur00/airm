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


$kod_2 	= $_POST['kod_2'];
																
																


      session_start();
      $login=$_SESSION['luzytkownik'];
	  $dluglogin = strlen($login);
      $_SESSION['sbarcode2']=$kod_2;
      $kod_1=$_SESSION['sbarcode1'];     
      $kod=$_SESSION['sbarcode'];
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


      $dlug_1 = strlen($kod_1);
      $data_rok_1 = substr($kod_1, 0,4);
      $data_mies_1 = substr($kod_1, 4,2);
      $data_dzien_1 = substr($kod_1, 6,2);
      $data_exp_1="$data_rok_1-$data_mies_1-$data_dzien_1";
      $dlug_kor_1=$dlug_1-18;

      $shinchang_part_no_1 = substr($kod, 8,$dlug_kor_1);



      $qty_box_st_1        = $dlug_1-9;
      $qty_box_end_1       = $dlug_1-4;
      $qty_box_rob_1       = substr($kod_1, $qty_box_st_1,$qty_box_end_1);
      $qty_box_1		   = substr($qty_box_rob_1 ,0,5);
      $qty_box_il_1		   = substr(str_replace("O", "", $qty_box_rob_1) ,5,5);

   	  
		 
	  $dlug_2 = strlen($kod_2);
      $data_rok_2 = substr($kod_2, 0,4);
      $data_mies_2 = substr($kod_2, 4,2);
      $data_dzien_2 = substr($kod_2, 6,2);
      $data_exp_2="$data_rok_2-$data_mies_2-$data_dzien_2";
      $dlug_kor_2=$dlug_2-18;

      $shinchang_part_no_2 = substr($kod_2, 8,$dlug_kor_2);



      $qty_box_st_2        = $dlug_2-9;
      $qty_box_end_2       = $dlug_2-4;
      $qty_box_rob_2       = substr($kod_2, $qty_box_st_2,$qty_box_end_2);
      $qty_box_2		   = substr($qty_box_rob_2 ,0,5);
      $qty_box_il_2		   = substr(str_replace("O", "", $qty_box_rob_2) ,5,5);
      
      
      $baza 		= 'barcod';
      $uzytkownik = 'robak';
      $haslo 		= 'robak1';

$qty_box_tot=$qty_box_1+$qty_box_2;



     mysql_connect('localhost',$uzytkownik,$haslo);
     mysql_query('SET CHARSET latin2');
     @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
     $kwerenda5v = "SELECT * FROM prod_st WHERE barcode='$kod_2'";
     $wynik5v = mysql_query($kwerenda5v);
     $rekordow5v = mysql_numrows($wynik5v);
     mysql_close();
     $barcod	 			= mysql_result($wynik5v, $t, "barcode");	
     $lok_baza	 			= mysql_result($wynik5v, $t, "lok");						
     $lot_no_baza	 		= mysql_result($wynik5v, $t, "lot_no");
 
 		if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
									$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             						";
									echo "<font size='0'>$komunikat"; 
		 }
 	 elseif($shinchang_part_no_2!==$shinchang_part_no){ echo "<font size='0'>"; echo include "zatw_lokrep2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ETYKIETY ROZNE! ZNAJDZ ODPOWIEDNIA ETYKIETE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; 
						  }
      elseif($lok_baza==="MG"){ echo "<font size='0'>"; echo include "zatw_lokrep2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ NA REGALE /PAPECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; 
						  }
      elseif ($lok_baza==="MW"){ echo "<font size='0'>"; echo include "zatw_lokrep2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							 echo "<font size='0'>$komunikat";
						   }
      elseif ($lok_baza==="MP"){ echo include "zatw_lokrep2.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>PUDELKO NIE JEST ZAREJESTROWANE NA REGALE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							";
							 echo $komunikat;}
	  elseif(($qty_box<$qty_box_tot)or($qty_box>$qty_box_tot)){ echo "<font size='0'>"; echo include "zatw_lokrep2.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ZA DUZA LUB ZA MALA ILOSC PRODUKTOW W TYM PUDELKU! ZNAJDZ ODPOWIEDNIA ETYKIETE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; 
						  }

        else {  echo "<font size='0'>"; echo include "zapisz_lokalizacjeregrep.php"; 
							
						 }

