<?PHP

$kod						= $_GET['kod'];
$id 						= $_GET['id'];
$nr_etyk					= $_GET['nr_etyk'];
$pojazd 					= $_GET['pojazd'];
$part_no 					= $_GET['part_no'];
$shinchang_part_no 			= $_GET['shinchang_part_no'];
$part_name 					= $_GET['part_name'];
$qty_box 					= $_GET['qty_box'];
$data	 					= $_GET['data'];
$stan 						= $_GET['stan'];
$stanz 						= $_GET['stanz'];
session_start();
$login=$_SESSION['luzytkownik'];



$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();
$nr_etyk					= mysql_result($wynik, $a, "nr_etyk");
$klient 					= mysql_result($wynik, $a, "klient");
$pole_odkl 					= mysql_result($wynik, $a, "pole_odkl");
$stan_pop					= mysql_result($wynik, $a, "stan");

$stanf=$stanz+$stan_pop;


$kwerenda = "UPDATE prod_got SET stan='$stanf' WHERE id='$id'";
	
	
mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();

$kwerenda = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod)
                             VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stanf','$klient','$nr_etyk','$pole_odkl','$login','$kod')";

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
mysql_query($kwerenda);
mysql_close();


header("Location: aczytnik_pokaz.php");
?>
