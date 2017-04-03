<?php  
// Generowanie graficznego barcodu
// Script by Przemys³aw Cios
session_start();  
       


$qty_box 				=$_GET['qty_box'];
$no_box 				=$_GET['no_box'];
$linia					=$_GET['linia'];
$pojazd					=$_GET['pojazd'];
$part_no 				=$_GET['part_no'];
$shinchang_part_no 		=$_GET['shinchang_part_no'];
$part_name 				=$_GET['part_name'];
$data 	 				=$_GET['data'];
$inne	 				=$_GET['inne'];
$sales	 				=$_GET['klient'];
  


 
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
  ImageRectangle($nowy_png, 0*$mn, 8*$mn, 20*$mn, 15*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 8*$mn, 80*$mn, 15*$mn, $kolor['12']);

  ImageRectangle($nowy_png, 80*$mn, 8*$mn, 104*$mn, 15*$mn, $kolor['12']);

  ImageRectangle($nowy_png, 0*$mn, 15*$mn, 20*$mn, 22*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 15*$mn, 104*$mn, 22*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 22*$mn, 104*$mn, 47*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 0*$mn, 47*$mn, 20*$mn, 56*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 20*$mn, 47*$mn, 50*$mn, 56*$mn, $kolor['12']);
  
  ImageRectangle($nowy_png, 50*$mn, 47*$mn, 77*$mn, 56*$mn, $kolor['12']);
  ImageRectangle($nowy_png, 77*$mn, 47*$mn, 104*$mn, 56*$mn, $kolor['12']);

  ImageRectangle($nowy_png, 0*$mn, 56*$mn, 104*$mn, 68*$mn, $kolor['12']);
  // Czêœæ œrodkowa
 
  
// rozbijanie daty

$rok_2cyfry=substr($data,-8,2);
$mies_2cyfry=substr($data, -5,2);
$dzien_2cyfry=substr($data,-2);

//skladanie daty

$data_skladana="$dzien_2cyfry$mies_2cyfry$rok_2cyfry";
$data_skladana_lamana="$dzien_2cyfry$mies_2cyfry$rok_2cyfry";
 
 
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
 
  
	if($qty_box<10) {$zero_qty_box_mobis="000";}
    elseif($qty_box<100) {$zero_qty_box_mobis="00";} 
    elseif($qty_box<1000) {$zero_qty_box_mobis="0";} 
    elseif($qty_box<10000) {$zero_qty_box_mobis="";}  
// koniec 
    
$part_no_o=str_replace("-", "", $part_no);
$kod_mobis="$data_skladana$zero_no$no_box$zero_qty_box_mobis$qty_box$part_no_o";  
  
  
  
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


$e90a="";
$e90a="$part_no_o";
$space=".";
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
  
    
    $nazwa_zbioru_cala30="$sciezka$kod_mobis";
     

//koniec



header('Content-type: image/png');

$font = 'arial.ttf';

imagettftext($nowy_png, 38, 0, 401, 71, $kolor['12'], $font, $sales);
imagettftext($nowy_png, 38, 0, 400, 70, $kolor['12'], $font, $sales);

imagettftext($nowy_png, 30, 0, 61, 159, $kolor['12'], $font, "Part No.");
imagettftext($nowy_png, 30, 0, 60, 158, $kolor['12'], $font, "Part No.");

imagettftext($nowy_png, 34, 0, 281, 159, $kolor['12'], $font, $part_no);
imagettftext($nowy_png, 34, 0, 280, 158, $kolor['12'], $font, $part_no);
 

 
imagettftext($nowy_png, 28, 0, 1081, 159, $kolor['12'], $font, "$qty_box EA ");
imagettftext($nowy_png, 28, 0, 1080, 158, $kolor['12'], $font, "$qty_box EA ");  

  
imagettftext($nowy_png, 30, 0, 41, 248, $kolor['12'], $font, "Part Name");
imagettftext($nowy_png, 30, 0, 40, 247, $kolor['12'], $font, "Part Name");   
 
imagettftext($nowy_png, 30, 0, 281, 248, $kolor['12'], $font, $part_name);
imagettftext($nowy_png, 30, 0, 280, 247, $kolor['12'], $font, $part_name);  

imagettftext($nowy_png, 30, 0, 41, 661, $kolor['12'], $font, "Supplier");
imagettftext($nowy_png, 30, 0, 40, 660, $kolor['12'], $font, "Supplier");  

imagettftext($nowy_png, 28, 0, 261, 641, $kolor['12'], $font, "(E9QA) SHINCHANG");
imagettftext($nowy_png, 28, 0, 260, 640, $kolor['12'], $font, "(E9QA) SHINCHANG"); 

imagettftext($nowy_png, 28, 0, 261, 681, $kolor['12'], $font, "POLAND Sp.z o.o.");
imagettftext($nowy_png, 28, 0, 260, 680, $kolor['12'], $font, "POLAND Sp.z o.o."); 

imagettftext($nowy_png, 30, 0, 701, 661, $kolor['12'], $font, "Delivery Date");
imagettftext($nowy_png, 30, 0, 700, 660, $kolor['12'], $font, "Delivery Date"); 

imagettftext($nowy_png, 30, 0, 1051, 661, $kolor['12'], $font, $datad);
imagettftext($nowy_png, 30, 0, 1050, 660, $kolor['12'], $font, $datad); 




// kod kreskowy ------------------------------------------------------------------------
		
  $rozmiar_ea		= GetImageSize($nazwa_zbioru_cala30);
  $rozmiar_sc		= GetImageSize($nazwa_zbioru_cala39);	
  ImageCopy($nowy_png, LoadPNG_sc($nazwa_zbioru_cala39), 250, 735, 0, 0, $rozmiar_sc[0], $rozmiar_sc[1]); 
  ImageCopy($nowy_png, LoadPNG_sc($nazwa_zbioru_cala39), 250, 750, 0, 0, $rozmiar_sc[0], $rozmiar_sc[1]); 
  
  ImageCopy($nowy_png, LoadPNG_ea($nazwa_zbioru_cala30), 100, 330, 0, 0,$rozmiar_ea[0], $rozmiar_ea[1]);	 
  ImageCopy($nowy_png, LoadPNG_ea($nazwa_zbioru_cala30), 100, 385, 0, 0,$rozmiar_ea[0], $rozmiar_ea[1]);
  ImageCopy($nowy_png, LoadPNG_ea($nazwa_zbioru_cala30), 100, 445, 0, 0,$rozmiar_ea[0], $rozmiar_ea[1]);
	
// -------------------------------------------------------------------------------------
 
 

  

  
  ImagePNG($nowy_png);
  ImageDestroy($nowy_png); 
$no_boxd="";
$no_box="";

?>
