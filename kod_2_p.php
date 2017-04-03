<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Wydruk etykiet / Print Barcode</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
</HEAD>

<BODY>
<?php
session_start();
$id				   = $_SESSION['sid'];
$numer_zlec		   = $_SESSION['snumer_zlec'];
$uzytkownik_login  = $_SESSION['luzytkownik'];

  
$qty_box_max_baza=0;
$pocz=1;
$idb=1;
$qty_box_max	   = $_POST['qty_box_il']; 								
$partia			   = $_POST['partia'];

// na rzie jak robie to wywalic
$numer_zlec="test";
//
//


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$qty_box 				= mysql_result($wynik, $a, "qty_box");
$data 	 				= mysql_result($wynik, $a, "data");
$inne	 				= mysql_result($wynik, $a, "inne");
$klient_linia	 		= mysql_result($wynik, $a, "klient");


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM wydruk_rej WHERE ((shinchang_part_no='$shinchang_part_no')AND(data='$data')AND(klient='$klient_linia')) ";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);

mysql_close();;
$a = 0;
while ($a < $rekordow){
$idb	                    = mysql_result($wynik, $a, "id");
$qty_box_max_baza		    = mysql_result($wynik, $a, "no_box");
$a++;
}  

$qty_box_min=floor($partia/$qty_box);
$qty_box_ile=$qty_box;
$ilosc=$qty_box_min*$qty_box;
$ilosc_ost=$partia-$ilosc;


$qty_box_max_r=$qty_box_max+$qty_box_max_baza;
$qty_box_max_r1=$qty_box_max_r;
$pocz=$qty_box_max_baza;
if ($pocz>1){$pocz=$qty_box_max_baza+1;} else {$pocz=1;}

$pocz1=$pocz;

if ($idb<2)
  {mysql_connect('localhost',$uzytkownik,$haslo);
   mysql_query('SET CHARSET latin2');
   @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
   $kwerenda = "SELECT * FROM wydruk_rej";
   $wynik = mysql_query($kwerenda);
   $rekordow = mysql_numrows($wynik);
   mysql_close();;
   $a = 0;
   while ($a < $rekordow){
   $idb	                    = mysql_result($wynik, $a, "id");
   $a++;
          } 
         $id_b=$idb+1; } else 
  {
   
    mysql_connect('localhost',$uzytkownik,$haslo);
    mysql_query('SET CHARSET latin2');
    @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
    $kwerenda = "SELECT * FROM wydruk_rej WHERE ((data='$data')AND(klient='$klient_linia')) ";
    $wynik = mysql_query($kwerenda);
    $rekordow = mysql_numrows($wynik);
    mysql_close();;
    $a = 0;
     while ($a < $rekordow){
      $idb	                    = mysql_result($wynik, $a, "id");
      $qty_box_max_baza		    = mysql_result($wynik, $a, "no_box");
      $a++;
     }
   $id_b=$idb+1; 
  }
WHILE ($qty_box_max_r>=$pocz) 
{  
    if ($qty_box_max_r1<=$pocz1){$qty_box_ile=$ilosc_ost;}

    mysql_connect('localhost',$uzytkownik,$haslo);
    mysql_query('SET CHARSET latin2');
    @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!"); 
    $kwerenda = "INSERT INTO wydruk_rej(linia,pojazd,shinchang_part_no,part_no,part_name,qty_box,no_box,partia,nr_zlec,uzytkownik,data,klient)
            VALUES ('$linia','$pojazd','$shinchang_part_no','$part_no','$part_name','$qty_box_ile','$pocz','$partia','$numer_zlec','$uzytkownik_login','$data','$klient_linia')";
    $wynik = mysql_query($kwerenda);
    $rekordow = mysql_numrows($wynik);
    mysql_close();
     
   
 echo"
 <IMG SRC='kod_gen2.php?sidb=$id_b' WIDTH='500' HEIGHT='402' BORDER='0'>
 <br>
 <IMG SRC='kod_gen2.php?sidb=$id_b' WIDTH='500' HEIGHT='402' BORDER='0'>
 <br>
 ";
 $pocz=$pocz+1;
 $pocz1=$pocz;
 $id_b++;
 }
?>
</BODY>
</HTML>
