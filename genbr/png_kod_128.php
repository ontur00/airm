<?php  
// 
// Script by Przemys³aw Cios beta version 1.0
// 

  $ciag1	= $_GET['kod'];
  $l = strlen($ciag1);											// D³ugoœæ ci¹gu znaków (od tego zale¿y szerokoœæ obrazka)
  $x = 15;														// Przesuniêcie kodu w poziomie na margines
  $y = 1;														// Przesuniêcie kodu w pionie na margines
  $h			= (11*$l)+$x*2;									// Rozmiar poziomy kodu
  $v			= 30;											// Rozmiar pionowy kodu
  $nowy_png  	= ImageCreate($h, $v);
  $kolor['0']	= ImageColorAllocate($nowy_png, 255, 255, 255); // Bia³y 
  $kolor['1']	= ImageColorAllocate($nowy_png,   0,   0,   0); // Czarny
  $kolor['3']	= ImageColorAllocate($nowy_png, 255,   0,   0); // Czerwony
  ImageFill($nowy_png, 5, 5, $kolor['0']);
//  ImageRectangle($nowy_png, 0, 0, $h-1, $v-1, $kolor['1']);
  ImageString($nowy_png, 1, $x+15, $v-8, $ciag1 , $kolor['1']);	// Wyœwietl ci¹g znaków pod kreskami
  $sk			= 0;											// Suma kontrolna
  $waga			= 0;											// Ostatnio zwrócona przez funkcjê JakiKod waga
  
// Tablica kodów 128: Suma kontrolna, ASCII A, ASCII B, ASCII C, gruboœæ kresek Bia³a Czarna itd...
$tabl = array(
 array(0 ,	' '			,	 32,	' '       , '00'      , '212222'),
 array(1 ,	'!'			,	 33,	'!'       , '01'      , '222122'),
 array(2 ,	'"'			,	 34,	'"'       , '02'      , '222221'),
 array(3 ,	'#'			,	 35,	'#'       , '03'      , '121223'),
 array(4 ,	'$'			,	 36,	'$'       , '04'      , '121322'),
 array(5 ,	'%'			,	 37,	'%'       , '05'      , '131222'),
 array(6 ,	'&'			,	 38,	'&'       , '06'      , '122213'),
 array(7 ,	'\''		,	 39,	'\''      , '07'      , '122312'),
 array(8 ,	'('			,	 40,	'('       , '08'      , '132212'),
 array(9 ,	')'			,	 41,	')'       , '09'      , '221213'),
 array(10,	'*'			,	 42,	'*'       , '10'      , '221312'),
 array(11,	'+'			,	 43,	'+'       , '11'      , '231212'),
 array(12,	','			,	 44,	','       , '12'      , '112232'),
 array(13,	'-'			,	 45,	'-'       , '13'      , '122132'),
 array(14,	'.'			,	 46,	'.'       , '14'      , '122231'),
 array(15,	'/'			,	 47,	'/'       , '15'      , '113222'),
 array(16,	'0'			,	 48,	'0'       , '16'      , '123122'),
 array(17,	'1'			,	 49,	'1'       , '17'      , '123221'),
 array(18,	'2'			,	 50,	'2'       , '18'      , '223211'),
 array(19,	'3'			,	 51,	'3'       , '19'      , '221132'),
 array(20,	'4'			,	 52,	'4'       , '20'      , '221231'),
 array(21,	'5'			,	 53,	'5'       , '21'      , '213212'),
 array(22,	'6'			,	 54,	'6'       , '22'      , '223112'),
 array(23,	'7'			,	 55,	'7'       , '23'      , '312131'),
 array(24,	'8'			,	 56,	'8'       , '24'      , '311222'),
 array(25,	'9'			,	 57,	'9'       , '25'      , '321122'),
 array(26,	':'			,	 58,	':'       , '26'      , '321221'),
 array(27,	';'			,	 59,	';'       , '27'      , '312212'),
 array(28,	'<'			,	 60,	'<'       , '28'      , '322112'),
 array(29,	'='			,	 61,	'='       , '29'      , '322211'),
 array(30,	'>'			,	 62,	'>'       , '30'      , '212123'),
 array(31,	'?'			,	 63,	'?'       , '31'      , '212321'),
 array(32,	'@'			,	 64,	'@'       , '32'      , '232121'),
 array(33,	'A'			,	 65,	'A'       , '33'      , '111323'),
 array(34,	'B'			,	 66,	'B'       , '34'      , '131123'),
 array(35,	'C'			,	 67,	'C'       , '35'      , '131321'),
 array(36,	'D'			,	 68,	'D'       , '36'      , '112313'),
 array(37,	'E'			,	 69,	'E'       , '37'      , '132113'),
 array(38,	'F'			,	 70,	'F'       , '38'      , '132311'),
 array(39,	'G'			,	 71,	'G'       , '39'      , '211313'),
 array(40,	'H'			,	 72,	'H'       , '40'      , '231113'),
 array(41,	'I'			,	 73,	'I'       , '41'      , '231311'),
 array(42,	'J'			,	 74,	'J'       , '42'      , '112133'),
 array(43,	'K'			,	 75,	'K'       , '43'      , '112331'),
 array(44,	'L'			,	 76,	'L'       , '44'      , '132131'),
 array(45,	'M'			,	 77,	'M'       , '45'      , '113123'),
 array(46,	'N'			,	 78,	'N'       , '46'      , '113321'),
 array(47,	'O'			,	 79,	'O'       , '47'      , '133121'),
 array(48,	'P'			,	 80,	'P'       , '48'      , '313121'),
 array(49,	'Q'			,	 81,	'Q'       , '49'      , '211331'),
 array(50,	'R'			,	 82,	'R'       , '50'      , '231131'),
 array(51,	'S'			,	 83,	'S'       , '51'      , '213113'),
 array(52,	'T'			,	 84,	'T'       , '52'      , '213311'),
 array(53,	'U'			,	 85,	'U'       , '53'      , '213131'),
 array(54,	'V'			,	 86,	'V'       , '54'      , '311123'),
 array(55,	'W'			,	 87,	'W'       , '55'      , '311321'),
 array(56,	'X'			,	 88,	'X'       , '56'      , '331121'),
 array(57,	'Y'			,	 89,	'Y'       , '57'      , '312113'),
 array(58,	'Z'			,	 90,	'Z'       , '58'      , '312311'),
 array(59,	'['			,	 91,	'['       , '59'      , '332111'),
 array(60,	'\\'		,	 92,	'\\'      , '60'      , '314111'),
 array(61,	']'			,	 93,	']'       , '61'      , '221411'),
 array(62,	'^'			,	 94,	'^'       , '62'      , '431111'),
 array(63,	'_'			,	 95,	'_'       , '63'      , '111224'),
 array(64,	'NUL'		,	 00,	'`'       , '64'      , '111422'),
 array(65,	'SOH'		,	 01,	'a'       , '65'      , '121124'),
 array(66,	'STX'		,	 02,	'b'       , '66'      , '121421'),
 array(67,	'ETX'		,	 03,	'c'       , '67'      , '141122'),
 array(68,	'EOT'		,	 04,	'd'       , '68'      , '141221'),
 array(69,	'ENQ'		,	 05,	'e'       , '69'      , '112214'),
 array(70,	'ACK'		,	 06,	'f'       , '70'      , '112412'),
 array(71,	'BEL'		,	 07,	'g'       , '71'      , '122114'),
 array(72,	'BS'		,	 08,	'h'       , '72'      , '122411'),
 array(73,	'HT'		,	 09,	'i'       , '73'      , '142112'),
 array(74,	'LF'		,	 10,	'j'       , '74'      , '142211'),
 array(75,	'VT'		,	 11,	'k'       , '75'      , '241211'),
 array(76,	'FF'		,	 12,	'I'       , '76'      , '221114'),
 array(77,	'CR'		,	 13,	'm'       , '77'      , '413111'),
 array(78,	'SO'		,	 14,	'n'       , '78'      , '241112'),
 array(79,	'SI'		,	 15,	'o'       , '79'      , '134111'),
 array(80,	'DLE'		,	 16,	'p'       , '80'      , '111242'),
 array(81,	'DC1'		,	 17,	'q'       , '81'      , '121142'),
 array(82,	'DC2'		,	 18,	'r'       , '82'      , '121241'),
 array(83,	'DC3'		,	 19,	's'       , '83'      , '114212'),
 array(84,	'DC4'		,	 20,	't'       , '84'      , '124112'),
 array(85,	'NAK'		,	 21,	'u'       , '85'      , '124211'),
 array(86,	'SYN'		,	 22,	'v'       , '86'      , '411212'),
 array(87,	'ETB'		,	 23,	'w'       , '87'      , '421112'),
 array(88,	'CAN'		,	 24,	'x'       , '88'      , '421211'),
 array(89,	'EM'		,	 25,	'y'       , '89'      , '212141'),
 array(90,	'SUB'		,	 26,	'z'       , '90'      , '214121'),
 array(91,	'ESC'		,	 27,	'{'       , '91'      , '412121'),
 array(92,	'FS'		,	 28,	'|'       , '92'      , '111143'),
 array(93,	'GS'		,	 29,	'}'       , '93'      , '111341'),
 array(94,	'RS'		,	 30,	'~'       , '94'      , '131141'),
 array(95,	'US'		,	 31,	'DEL'     , '95'      , '114113'),
 array(96,	'FNC 3'		,	245,	'FNC 3'   , '96'      , '114311'),
 array(97,	'FNC 2'		,	246,	'FNC 2'   , '97'      , '411113'),
 array(98,	'SHIFT'		,	247,	'SHIFT'   , '98'      , '411311'),
 array(99,	'CODE C'	,	248,	'CODE C'  , '99'      , '113141'),
 array(100,	'CODE B'	,	249,	'FNC 4'   , 'CODE B'  , '114131'),
 array(101,	'FNC 4'		,	250,	'CODE A'  , 'CODE A'  , '311141'),
 array(102,	'FNC 1'		,	251,	'FNC 1'   , 'FNC 1'   , '411131'),
 array(103,	'Start A'	,	252,	'Start A' , 'Start A' , '211412'),
 array(104,	'Start B'	,	253,	'Start B' , 'Start B' , '211214'),
 array(105,	'Start C'	,	254,	'Start C' , 'Start C' , '211232'),
 array(106,	'Stop'		,	255,	'Stop'    , 'Stop'    , '2331112'));


function JakiKod($zestaw, $kod) {
  global $tabl, $waga;				//Uzyskujemy dostêp do tablicy TABL, która bêdzie widoczna przez funkcjê globalnie
  $f=false; $a=0;

  do {
     switch ($zestaw) {
     case 'a':
			if ($kod==$tabl[$a]['1']) {$f=true;$wynik=$tabl[$a]['5'];}
			break;
     case 'b':
			if ($kod==$tabl[$a]['3']) {$f=true;$wynik=$tabl[$a]['5'];}
	 		break;
     case 'c':
     		if ($kod==$tabl[$a]['4']) {$f=true;$wynik=$tabl[$a]['5'];}
			break;
     default:
     		if ($kod==$tabl[$a]['0']) {$f=true;$wynik=$tabl[$a]['5'];}
     }
  $a++;
  }
  while ($f==false and $a<=106);
 
 if ($f==true) {$waga=$tabl[$a-1][0];}		// Je¿eli znaleziono kod to ustawiamy w zmiennej jego wagê
 return $wynik;
}


function RysujKreski($k) {
// Rysujemy pionowe kreski czyli kreskowo znak o podanym kodzie np. 421112
	global $x, $y, $h, $v, $nowy_png, $kolor;
  	$l = strlen($k);
	ImageSetThickness($nowy_png, 1);
  	for ($a=0; $a<$l; $a++) {
  		if (($a%2) == 0) {
			ImageFilledRectangle($nowy_png, $x, $y, $x+$k[$a]-1, $v-9, $kolor['1']);
  		}
  		else {
			ImageFilledRectangle($nowy_png, $x, $y, $x+$k[$a]-1, $v-9, $kolor['0']);
  		}
		$x= $x + $k[$a];
  	}
}

function IleCyfr($s) {
// Podajemy ci¹g znaków, a funkcja mówi, ile wystêpuje kolejno cyfr
  $licznik	= 0;
  $pos		= 0;			//Który znak z ci¹gu znaków badamy
  $f		= false;		//Czy wyskoczyæ póŸniej z pêtli bo nagle mamy koniec cyfr
  $l		= strlen($s);	//D³ugoœæ ci¹gu znaków
	
  while ($f==false or $pos<$l) {
	  $k = ord($s[$pos]);
	  if ($k>47 and $k<58) { //Czyli jeœli znak jest cyfr¹
	    $licznik++;
	    $pos++;
	  }
	  else {
	    $f = true;
	  }
  }
return $licznik;	
}

  $zestaw		= '';
  $pos			= 0;
  $mnoznik		= 1;									// Mno¿nik dla wag: 1, potem bêdzie 2, 3, 4...


  // Lecimy znak po znaku
  $b = IleCyfr(substr($ciag1,$pos));

//  ImageString($nowy_png, 1, $x+95, $v-8, $b , $kolor['1']);  - poka¿ ile mamy cyfr

  if ($b>=4) {
    $zestaw = 'C';
    RysujKreski('211232');								// Rysujemy START C
    $sk+=(105*$mnoznik);								// Suma kontrolna = 105
    if ($sk!=105) {$mnoznik++;}							// Zwiêkszemy mno¿nik +1 jeœli START C nie jest pierwszym symbolem w kodzie

    if (($b%2)!=0) {									// Je¿eli nieparzysta iloœæ cyfr
      $b--;  											// to zmniejszamy do iloœci parzystej
	  $c = 1;											// i odnotowujemy sobie pozosta³¹ pojedyñcz¹ cyfrê
    }
    else {
      $c = 0;
    }

    for ($a=1; $a<$b; $a+=2) {
      RysujKreski(JakiKod('c', substr($ciag1, $pos, 2)));
      $sk+=($waga*$mnoznik);
      $mnoznik++;
      $pos+=2;
    }

   if ($c==1) {
     RysujKreski(JakiKod('c', 'CODE A'));					// Rysujemy START A
     $sk+=($waga*$mnoznik);
     $mnoznik++;
     RysujKreski(JakiKod('a', substr($ciag1, $pos, 1)));	// Generujemy brakuj¹c¹ cyfrê w zestawie A
     $sk+=($waga*$mnoznik);
     $mnoznik++;
     $pos++;
   }
  }

  $c = $sk%103;
  //  ImageString($nowy_png, 1, 90, $v-8, $waga , $kolor['3']);
  RysujKreski(JakiKod('',$c));								// Rysujemy sumê kontroln¹
  RysujKreski('2331112');									// Rysujemy znak STOP

  header("Content-type: image/png");
  ImagePNG($nowy_png);
  ImageDestroy($nowy_png);
?>

