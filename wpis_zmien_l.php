<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Untitled</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
</HEAD>

<BODY>

<?php

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$id 			   = $_POST['id']; 					
$linia		       = $_POST['linia']; 					
$pojazd			   = $_POST['pojazd']; 				
$part_no		   = $_POST['part_no']; 			
$shinchang_part_no = $_POST['shinchang_part_no']; 		
$part_name		   = $_POST['part_name']; 			
$qty_box 		   = $_POST['qty_box']; 				
$data			   = $_POST['data'];				
$partia			   = $_POST['partia']; 					
 					

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query("SET NAMES 'latin2'");
mysql_query("SET CHARACTER SET 'latin2_general_ci'");
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
echo "  id=$id 
        <br>
		 qty_box=$qty_box 
        <br>
		partia=$partia
        <br>
     ";

//include "kody_pokaz_linia.php";
?>

</BODY>
</HTML>
