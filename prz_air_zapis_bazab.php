<?php



session_start();
$login=$_SESSION['luzytkownik'];


$stan_b=(int)$qty_box;

$powod="auto_prz_la";


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$stan=$stan_b+$stan_pop;


$kwerenda = "UPDATE prod_got SET stan='$stan' WHERE shinchang_part_no='$shinchang_part_no'";
	
	
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

$kwerenda = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                             VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

	echo  include "aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><FONT COLOR='#00aa00'>OK $part_no  $part_name Z PUDE£KA DODANE $stan_b SZT DO MAGAZYNU <BR>  
							               OK $part_no  $part_name BOX ADD $stan_b QUANTITY TO STORAGE</center><hr>";
							echo $komunikat;

?>
