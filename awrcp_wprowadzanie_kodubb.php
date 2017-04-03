<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################
  $kod	= $_POST['kod'];

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

$kod 	= $_POST['kod'];

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

$baza 		= 'barcode';
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
$stan_pop	 			= mysql_result($wynik, $a, "stan");

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_got_mag WHERE barcodew='$kod'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $barcod	 			= mysql_result($wynik5, $t, "barcodew");							


$dlug_part_no = strlen($part_no);



if ($dlug_part_no<3 or $dlug <25) {  
							echo "<font size='0'>"; echo include "awrcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat";
							 }
							else {
							
                                 
									if ($barcod<>$kod) 
						               {

       
	  



						
?>

</HEAD>

<BODY>
<?php							
echo include "wyd_air_zapis_bazab.php";
     
     
}	else

{	echo  include "awrcp_z_czytnikabb.php";
						        	 $komunikat = "<center><B>
								     <FONT COLOR='#FF0000'><font size='1'>ETYKIETA ZOSTAŁA JUŻ WCZYTANA - TOWAR ZOSTAŁ JUŻ WCZESNIEJ PRZYJETY ! powtórz operacje, brak skutku magazynowego
							          
																				  ";
						              	echo $komunikat; 
						               
}}


?>
</BODY>
</HTML>
