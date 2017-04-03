<?php
$id_operacji	= $_GET['id_operacji'];
$wybor			= $_GET['wybor'];

$baza		= 'hartownia';
$uzytkownik	= 'mysql';
$haslo		= 'mysql9';

$tab_klawisze = array(48 => 0, 49 => 1, 50 => 2, 51 => 3, 52 => 4);
$lokalizacja = $tab_klawisze[$wybor];

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");

$wynik = mysql_query("UPDATE t04_operacje SET lokalizacja = '$lokalizacja' WHERE id_operacji = '$id_operacji'");

if ($wynik)
{
	mysql_query("UPDATE t01_przewodniki SET lokalizacja = '$lokalizacja' WHERE id_przewodnika = (SELECT id_przewodnika FROM t04_operacje WHERE id_operacji = '$id_operacji')");
}




mysql_close();

header("Location: rcp_z_czytnika.php?kod=1");
?>
