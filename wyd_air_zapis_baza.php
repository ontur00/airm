<?PHP



session_start();
$login=$_SESSION['luzytkownik'];


$stan_b=(int)$qty_box;

$powod="auto_wyd";


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynikj = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynikj);
mysql_close();
$nr_etyk					= mysql_result($wynikj, $j, "nr_etyk");
$klient 					= mysql_result($wynikj, $j, "klient");
$pole_odkl 					= mysql_result($wynikj, $j, "pole_odkl");
$stan_pop					= mysql_result($wynikj, $j, "stan");
$part_no					= mysql_result($wynikj, $j, "part_no");
$part_name					= mysql_result($wynikj, $j, "part_name");
$pojazd						= mysql_result($wynikj, $j, "pojazd");


$stan=$stan_pop-$stan_b;

echo"$stan";
$kwerenda = "UPDATE prod_got SET stan='$stan' WHERE shinchang_part_no='$shinchang_part_no'";
	
	
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

$kwerenda = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod)
                             VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$nr_etyk','$pole_odkl','$login','$powod')";

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

?>
