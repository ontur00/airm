<?php  
// Generowanie graficznego barcodu
// Script by Przemys³aw Cios
session_start();  
       
$id_b			   = $_GET['sidb'];

  
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM wydruk_rej WHERE id='$id_b'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$qty_box 				= mysql_result($wynik, $a, "qty_box");
$no_box 				= mysql_result($wynik, $a, "no_box");
$partia 				= mysql_result($wynik, $a, "partia");
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data 	 				= mysql_result($wynik, $a, "data");
$inne	 				= mysql_result($wynik, $a, "inne");
$sales	 				= mysql_result($wynik, $a, "klient");

 
 include "LoadPNG_ea.php";
 include "LoadPNG_sc.php";

 
 
  
 
  $mn = 12.62;
  $nowy_png  	= ImageCreate(105*$mn, 84*$mn);
  $kolor['0']	= ImageColorAllocate($nowy_png, 255, 255, 255);  
  $kolor['1']	= ImageColorAllocate($nowy_png, 255,   0, 153);
  $kolor['2']	= ImageColorAllocate($nowy_png, 255,   0,   0);
  $kolor['3']	= ImageColorAllocate($nowy_png, 255, 153,   0);
  $kolor['4']	= ImageColorAllocate($nowy_png, 255, 204,   0);
  $kolor['5']	= ImageColorAllocate($nowy_png, 255, 255,   0);
  $kolor['6']	= ImageColorAllocate($nowy_png, 204, 255,   0);
  $kolor['7']	= ImageColorAllocate($nowy_png, 102, 255,   0);
  $kolor['8']	= ImageColorAllocate($nowy_png,   0, 255, 255);
  $kolor['9']	= ImageColorAllocate($nowy_png,   0, 204, 255);
  $kolor['10']	= ImageColorAllocate($nowy_png,   0, 153, 255);
  $kolor['11']	= ImageColorAllocate($nowy_png,  51,   0, 255);
  $kolor['12']	= ImageColorAllocate($nowy_png,   0,   0,   0);
  $kolor['13']	= ImageColorAllocate($nowy_png, 230, 230, 230);


  ImageFill($nowy_png, 10, 10, $kolor['0']);
  ImageSetThickness($nowy_png, 2);


  // Czêœæ górna
  ImageRectangle($nowy_png, 0*$mn, 1*$mn, 104*$mn, 8*$mn, $kolor['12']); 
  ImageRectangle($nowy_png, 0*$mn, 8*$mn, 20*$mn, 14*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 8*$mn, 60*$mn, 14*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 60*$mn, 8*$mn, 80*$mn, 14*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 80*$mn, 8*$mn, 104*$mn, 14*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 14*$mn, 20*$mn, 20*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 14*$mn, 60*$mn, 20*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 60*$mn, 14*$mn, 80*$mn, 20*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 80*$mn, 14*$mn, 104*$mn, 20*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 20*$mn, 20*$mn, 26*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 20*$mn, 104*$mn, 26*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 26*$mn, 104*$mn, 40*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 40*$mn, 20*$mn, 46*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 40*$mn, 50*$mn, 46*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 50*$mn, 40*$mn, 77*$mn, 52*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 77*$mn, 40*$mn, 104*$mn, 52*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 52*$mn, 20*$mn, 46*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 52*$mn, 50*$mn, 46*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 52*$mn, 104*$mn, 58*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 58*$mn, 104*$mn, 68*$mn, $kolor['12']);
  // Czêœæ œrodkowa
 
  
 // liczenie zerek
   
  
    
 	if($no_box<10) {$zero_no="00";}
    elseif($no_box<100) {$zero_no="0";} 
    elseif($no_box<1000) {$zero_no="";} 
    
	if($no_box<10) {$zero_no_ean="000";}
    elseif($no_box<100) {$zero_no_ean="00";} 
    elseif($no_box<1000) {$zero_no_ean="0";} 
    elseif($no_box<10000) {$zero_no_ean="";} 
    
	
	if($qty_box<10) {$zero_qty="0000";}
    elseif($qty_box<100) {$zero_qty="000";} 
    elseif($qty_box<1000) {$zero_qty="00";} 
    elseif($qty_box<10000) {$zero_qty="0";} 
    elseif($qty_box<100000) {$zero_qty="";} 
// koniec  
  
  

  
  
  
  
  //sciezko do exportu

// ec
$o="O";   
$numer_ean="$zero_qty$qty_box$zero_no_ean$no_box";
$numer_sc="$zero_qty$qty_box$zero_no$no_box$o";  
$sciezka="http://localhost/barcode/code39p.php?kod=";

$datao= str_replace("-", "", $data);
$datad= str_replace("-", "/", $data);
$cod39  ="";
$cod39  ="$datao$shinchang_part_no";
$cod39_n="$numer_sc";



	$nazwa_zbioru_dl39=strlen($cod39);
    if($nazwa_zbioru_dl39>18){$sp39="";}
    elseif($nazwa_zbioru_dl39>17){$sp39=".";}
    elseif($nazwa_zbioru_dl39>16){$sp39="..";}
    elseif($nazwa_zbioru_dl39>15){$sp39="...";}
    elseif($nazwa_zbioru_dl39>14){$sp39="....";}
    elseif($nazwa_zbioru_dl39>13){$sp39=".....";}
    elseif($nazwa_zbioru_dl39>12){$sp39="......";}
    $nazwa_zbioru_cala39="$sciezka$cod39$sp39$cod39_n";






//ean

$part_no_o=str_replace("-", "", $part_no);
$e90a="";
$e90a="$part_no_o";
$space=".";
$ea="E90A";
$cod30_n="$numer_ean";
	

    $sp301=".";
	$nazwa_zbioru_dl30=strlen($e90a);
    
    if($nazwa_zbioru_dl30>14){$sp30="";}
    elseif($nazwa_zbioru_dl30>13){$sp30=".";}
    elseif($nazwa_zbioru_dl30>12){$sp30="..";}
	elseif($nazwa_zbioru_dl30>11){$sp30="...";}
    elseif($nazwa_zbioru_dl30>10){$sp30="....";}
    elseif($nazwa_zbioru_dl30>9){$sp30=".....";}
    elseif($nazwa_zbioru_dl30>8){$sp30="......";}
    elseif($nazwa_zbioru_dl30>7){$sp30=".......";}
    elseif($nazwa_zbioru_dl30>6){$sp30="........";}
    elseif($nazwa_zbioru_dl30>5){$sp30=".........";}
    elseif($nazwa_zbioru_dl30>4){$sp30="..........";}
    elseif($nazwa_zbioru_dl30>3){$sp30="...........";}
  
    $nazwa_zbioru_cala30="$sciezka$ea$sp301$e90a$sp30$cod30_n";
     

//koniec



header('Content-type: image/png');

$font = 'arial.ttf';

imagettftext($nowy_png, 38, 0, 401, 71, $kolor['12'], $font, $sales);
imagettftext($nowy_png, 38, 0, 400, 70, $kolor['12'], $font, $sales);

imagettftext($nowy_png, 30, 0, 61, 156, $kolor['12'], $font, "Vehicle");
imagettftext($nowy_png, 30, 0, 60, 155, $kolor['12'], $font, "Vehicle");

imagettftext($nowy_png, 34, 0, 281, 156, $kolor['12'], $font, $pojazd);
imagettftext($nowy_png, 34, 0, 280, 155, $kolor['12'], $font, $pojazd);
 
imagettftext($nowy_png, 28, 0, 781, 156, $kolor['12'], $font, "Product Date");
imagettftext($nowy_png, 28, 0, 780, 155, $kolor['12'], $font, "Product Date");
 
imagettftext($nowy_png, 28, 0, 1081, 156, $kolor['12'], $font, $datad);
imagettftext($nowy_png, 28, 0, 1080, 155, $kolor['12'], $font, $datad);  

imagettftext($nowy_png, 30, 0, 61, 231, $kolor['12'], $font, "Part No.");
imagettftext($nowy_png, 30, 0, 60, 230, $kolor['12'], $font, "Part No.");

imagettftext($nowy_png, 34, 0, 281, 231, $kolor['12'], $font, $part_no);
imagettftext($nowy_png, 34, 0, 280, 230, $kolor['12'], $font, $part_no);

imagettftext($nowy_png, 26, 0, 781, 231, $kolor['12'], $font, "Part No(SCPL)");
imagettftext($nowy_png, 26, 0, 780, 230, $kolor['12'], $font, "Part No(SCPL)");

imagettftext($nowy_png, 28, 0, 1041, 231, $kolor['12'], $font, $shinchang_part_no);
imagettftext($nowy_png, 28, 0, 1040, 230, $kolor['12'], $font, $shinchang_part_no); 
  
imagettftext($nowy_png, 30, 0, 41, 306, $kolor['12'], $font, "Part Name");
imagettftext($nowy_png, 30, 0, 40, 305, $kolor['12'], $font, "Part Name");   
 
imagettftext($nowy_png, 30, 0, 281, 306, $kolor['12'], $font, $part_name);
imagettftext($nowy_png, 30, 0, 280, 305, $kolor['12'], $font, $part_name);  

imagettftext($nowy_png, 30, 0, 41, 561, $kolor['12'], $font, "Quantity");
imagettftext($nowy_png, 30, 0, 40, 560, $kolor['12'], $font, "Quantity");  

imagettftext($nowy_png, 30, 0, 321, 561, $kolor['12'], $font, "$qty_box$pusta EA");
imagettftext($nowy_png, 30, 0, 320, 560, $kolor['12'], $font, "$qty_box$pusta EA"); 

imagettftext($nowy_png, 30, 0, 41, 641, $kolor['12'], $font, "LOT No.");
imagettftext($nowy_png, 30, 0, 40, 640, $kolor['12'], $font, "LOT No."); 

imagettftext($nowy_png, 30, 0, 721, 601, $kolor['12'], $font, "Inspection");
imagettftext($nowy_png, 30, 0, 720, 600, $kolor['12'], $font, "Inspection"); 

imagettftext($nowy_png, 30, 0, 356, 721, $kolor['12'], $font, "SHINCHANG POLAND Sp. z o.o.");
imagettftext($nowy_png, 30, 0, 355, 720, $kolor['12'], $font, "SHINCHANG POLAND Sp. z o.o.");  


// kod kreskowy ------------------------------------------------------------------------
		
  $rozmiar_ea		= GetImageSize($nazwa_zbioru_cala30);
  $rozmiar_sc		= GetImageSize($nazwa_zbioru_cala39);	
  ImageCopy($nowy_png, LoadPNG_sc($nazwa_zbioru_cala39), 250, 770, 0, 0, $rozmiar_sc[0], $rozmiar_sc[1]); 	 
  ImageCopy($nowy_png, LoadPNG_ea($nazwa_zbioru_cala30), 100, 350, 0, 0,$rozmiar_ea[0], $rozmiar_ea[1]);
  ImageCopy($nowy_png, LoadPNG_ea($nazwa_zbioru_cala30), 100, 395, 0, 0,$rozmiar_ea[0], $rozmiar_ea[1]);
	
// -------------------------------------------------------------------------------------
 
 

  

  
  ImagePNG($nowy_png);
  ImageDestroy($nowy_png); 
$no_boxd="";
$no_box="";

?>
