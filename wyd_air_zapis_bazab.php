<?php


session_start();
$login=$_SESSION['luzytkownik'];


$stan_b=(int)$qty_box;

$powod="auto_wyd_la";


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$stan=$stan_pop-$stan_b;


$kwerenda = "UPDATE prod_got SET stan='$stan' WHERE shinchang_part_no='$shinchang_part_no'";
	
	
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

$kwerenda = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcodew)
                             VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

	echo  include "awrcp_z_czytnikabb.php"; 
						$komunikat = "<center><B><FONT COLOR='#00aa00'>OK $part_no  $part_name Z PUDE£KA WYDANE $stan_b SZT Z MAGAZYNU <BR>  
							               OK $part_no  $part_name BOX ISSUED $stan_b QUANTITY FROM STORAGE</center><hr>";
							echo $komunikat;

?>
