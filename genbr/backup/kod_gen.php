<?php  
// Generowanie graficznego barcodu
// Script by Przemys³aw Cios
global $cod39;
global $e90a;

 include "LoadPNG.php";


// Create the image
$im = imagecreatetruecolor(400, 30);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 399, 29, $white);


$font = '/barcode/genbr/font/arial.ttf';



 
  $id=$_GET['id'];
  
  
 
  $mn = 12.82;
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
  ImageSetThickness($nowy_png, 1);


  // Czêœæ górna
  ImageRectangle($nowy_png, 0*$mn, 0*$mn, 104*$mn, 8*$mn, $kolor['12']);
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
 
  //Opisy pól
 
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

$id 					= mysql_result($wynik, $a, "id");
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$qty_box 				= mysql_result($wynik, $a, "qty_box");
$data 	 				= mysql_result($wynik, $a, "data");
$partia 				= mysql_result($wynik, $a, "partia");
$inne	 				= mysql_result($wynik, $a, "inne");

$sales="Johnson Controls";
$numer="00001001O";
$numer_o=str_replace("O", "", $numer);
$pusta=" ";
$datao= str_replace("-", "", $data);


$data_akt=" ";
$cod39="";
$cod39="http://pluton/barcode/code39.php?kod=$datao$shinchang_part_no$pusta$numer";
$part_no_o=str_replace("-", "", $part_no);
$e90a="";
$e90a="http://pluton/barcode/code39.php?kod=E90A $part_no_o$pusta$pusta$pusta$pusta$pusta$numer_o";
$test="123456789012345678912345";




 imagettftext($nowy_png, 4, 2, 9.8*$mn, 2.5*$mn, $kolor['12'], $font, "$sales");

 imagestring($nowy_png, 4, 200, 2.5*$mn,"$sales", $kolor['12']);


  
  ImageString($nowy_png, 3, 3.8*$mn, 9.5*$mn, "Vehicle", $kolor['12']);
  ImageString($nowy_png, 3, 110, 9.5*$mn, $pojazd, $kolor['12']);
  ImageString($nowy_png, 3, 295, 45, "Product Date", $kolor['12']);
  ImageString($nowy_png, 3, 400, 45, $datao, $kolor['12']);
  ImageString($nowy_png, 3, 295, 75, "Part No(SCPL)", $kolor['12']);
  ImageString($nowy_png, 3, 400, 75, $shinchang_part_no, $kolor['12']);
  ImageString($nowy_png, 3, 3.8*$mn, 75, "Part No.", $kolor['12']);
  ImageString($nowy_png, 3, 110, 75, $part_no , $kolor['12']);
  ImageString($nowy_png, 3, 3.8*$mn, 105, "Part Name", $kolor['12']);
  ImageString($nowy_png, 3, 110, 105, $part_name, $kolor['12']);
  
  ImageString($nowy_png, 3, 3.8*$mn, 200, "Quantity", $kolor['12']);
  ImageString($nowy_png, 3, 110, 200, "$qty_box$pusta EA", $kolor['12']);
  ImageString($nowy_png, 3, 3.8*$mn, 230, "LOT No.", $kolor['12']);
  ImageString($nowy_png, 3, 270, 215, "Inspection", $kolor['12']);
  ImageString($nowy_png, 3, 150, 260, "SHINCHANG POLAND Sp. z o.o.", $kolor['12']);
  ImageString($nowy_png, 1, 180, 315, $cod39, $kolor['12']);
  ImageString($nowy_png, 1, 100, 180, $e90a, $kolor['12']);
  
// kod kreskowy ------------------------------------------------------------------------
 
  			
   //$cod39:string;
 
    ImageCopy($nowy_png, LoadPNG($cod39), 250, 770, 0, 0, 780, 83);
	
   	 
 ImageCopy($nowy_png, LoadPNG($e90a), 100, 350, 0, 0, 780, 83);
 ImageCopy($nowy_png, LoadPNG($e90a), 100, 395, 0, 0, 780, 83);
	
 
 
 

  

  
  ImagePNG($nowy_png);
  ImageDestroy($nowy_png); 


?>
