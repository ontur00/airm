


<?php
// script by Przemys³aw Cios 14:10:2010 r

session_start(); 
$id_r                   = $_POST['id'];
$_SESSION['sid']        = $id_r;  
$qty_box	 			= $_POST['qty_box'];              
$partia					= $_POST['partia']; 	


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id_r'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();
$etykieta				= mysql_result($wynik, $a, "etykieta");

$qty_box_il=ceil($partia/$qty_box);

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda1 = "UPDATE prod_got SET qty_box='$qty_box',partia='$partia' WHERE id='$id_r'";
$wynik = mysql_query($kwerenda1);
$rekordow = mysql_numrows($wynik);
mysql_close();





if ($etykieta<2) {  include "kod_1.php";} 
elseif ($etykieta<3) {  include "kod_2.php";} 
elseif ($etykieta<4)  {  include "kod_3.php";} 

?>


</BODY>
</HTML>
