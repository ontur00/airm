<?php

 // script by Przemys³aw Cios 17:12:2010 r

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];
$pojazd_p = $_POST["pojazd"];


														  // mysql_connect('localhost',$uzytkownik,$haslo);
                                                          // mysql_query('SET CHARSET latin2');
                                                          // @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!"); 
                                                         // $kwerenda = "INSERT INTO wydruk_rej(linia,   pojazd,   shinchang_part_no,     part_no,   part_name,   qty_box,     no_box,   partia,   nr_zlec,     uzytkownik,        data,     klient)
                                                          //              VALUES               ('$linia','$pojazd','$shinchang_part_no','$part_no','$part_name','$qty_box_ile','$pocz','$partia','$numer_zlec','$uzytkownik_login','$data','$klient_linia')";
                                                           //$wynik = mysql_query($kwerenda);
                                                          // $rekordow = mysql_numrows($wynik);
                                                         //  mysql_close();
     												
													
															   
                                                             echo  "
                                                                        <IMG SRC='kod_gen3.php?linia=$linia&pojazd=$pojazd&shinchang_part_no=$shinchang_part_no&part_no=$part_no&part_name=$part_name&qty_box=$qty_box_ile&no_box=$pocz&data=$data&klient=$klient_linia&inne=$inne' WIDTH='500' HEIGHT='402' BORDER='0'>
         													<br>    ";
 															 echo  "	<IMG SRC='kod_gen3.php?linia=$linia&pojazd=$pojazd&shinchang_part_no=$shinchang_part_no&part_no=$part_no&part_name=$part_name&qty_box=$qty_box_ile&no_box=$pocz&data=$data&klient=$klient_linia&inne=$inne' WIDTH='500' HEIGHT='402' BORDER='0'>
 															<br>
																 ";
																 
?>
