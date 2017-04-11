
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
//ini_set( 'display_errors', 'On' ); 
//error_reporting( E_ALL );
function ZwrocKlienta($nr_zamowienia, $db, $db_login, $db_haslo)
{
	mysql_connect('localhost', $db_login, $db_haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($db) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda = "SELECT * FROM zamowienia WHERE nr_zam='" . $nr_zamowienia . "' ";
	$wynik = mysql_query($kwerenda);
	$klient = mysql_result($wynik, 0, "klient");
	mysql_close();
	
	return $klient;
}

function ZwrocAlc($part_no, $db, $db_login, $db_haslo)
{
	mysql_connect('localhost', $db_login, $db_haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($db) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda = "SELECT * FROM prod_got WHERE shinchang_part_no='" . $part_no . "' ";
	$wynik = mysql_query($kwerenda);
	$alc_z_bazy = mysql_result($wynik, 0, "nr_etyk");
	mysql_close();
	
	return $alc_z_bazy;
}

function UsunSpacje($tekst)
{
	$zwrot = str_replace(" ", "", $tekst);
	return $zwrot;
}

function WyszukajMyslnik($kodALC)
{
	 $terminator = strpos($kodALC, "-"); 
	 echo "WyszukajMyslnik=".$terminator;
	 return $terminator;
}

function ZapiszLog($part_no, $stan, $login, $powod, $nr_etyk, $barcodes, $nr_zam, $klient, $db, $db_login, $db_haslo)
{
	mysql_connect('localhost', $db_login, $db_haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($db) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda = "
	INSERT INTO prod_par_wys_alc (part_no, stan, login, powod, nr_etyk, barcodes, nr_zam, klient)
	VALUES ('" . $part_no . "', '" . $stan . "', '" . $login . "', '" . $powod . "',
	'" . $nr_etyk . "', '" . $barcodes . "', '" . $nr_zam . "', '" . $klient . "');
	";
	$wynik = mysql_query($kwerenda);
	mysql_close();
	
	if ($wynik == false)
	{
		echo "
		<center><B><font size='1'><FONT COLOR='#FF0000'>LOG - blad zapisu!<BR></FONT></center>
		";
		
		return false;
	}
	else
	{
		return true;
	}
}

//===================================================================================


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$kodzam=$_SESSION['s_kod_zamw'];
$dluglogin = strlen($login);
$nazwa_klienta = ZwrocKlienta($kodzam, $baza, $uzytkownik, $haslo);


$kod 	    = $_POST['kod'];
$formalc 	= $_POST['formalc'];
$licznik 	= $_POST['licznik'];

$part_no = substr($kod, 14,14);

$formalc = UsunSpacje($formalc);


/*
$komunikat = "<center><B><FONT COLOR='#00aa00'>Klient : " . $nazwa_klienta . " <BR>  
</center><hr>";
echo $komunikat;
*/

//echo "<br></br>>>TEM  TUTAJ1";
if($dluglogin<2)
{ 
	//echo "<br></br>>>TEM  TUTAJ2";
	echo "<font size='0'>"; 
	echo include "wyloguj.php"; 
	$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
    ";
	echo "<font size='0'>$komunikat"; 
}
else 
{																	
	//echo "<br></br>>>TEM  TUTAJ3";																
	$dlug = strlen($kod);
	$data_rok = substr($kod, 0,4);
	$data_mies = substr($kod, 4,2);
	$data_dzien = substr($kod, 6,2);
	$data_exp="$data_rok-$data_mies-$data_dzien";
	$lot_no_baza=substr($kod, 0,8);
	$lot_no_z_k=substr($kod, 0,8);
	$dlug_kor=$dlug-18;

	$shinchang_part_no = substr($kod, 8,$dlug_kor);



	$qty_box_st        = $dlug-9;
	$qty_box_end       = $dlug-4;
	$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
	$qty_box		     = substr($qty_box_rob ,0,5);
	$qty_box_il		 = substr(str_replace("O", "", $qty_box_rob) ,5,5);
      
    if($dlug<27)
	{
		//echo "<br></br>>>TEM  TUTAJ4";
		$qty_box		   = substr($kod ,10,4);
	}
	//echo "<br></br>>>TEM  TUTAJ5";
	settype($qty_box, "integer");

	





	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
	$wynik5reglkjt = mysql_query($kwerenda5reglkjt);
	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
	mysql_close();
	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
	$dlug_qty_box_pr = strlen($qty_box_pr);
   

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda5reglkjtd = "SELECT * FROM prod_got_wys WHERE barcode='$kod' and pojazd='$kodzam'";
	$wynik5reglkjtd = mysql_query($kwerenda5reglkjtd);
	$rekordow5reglkjtd = mysql_numrows($wynik5reglkjtd);
	mysql_close();
	$scpr_pr	 			= mysql_result($wynik5reglkjtd, 0, "shinchang_part_no");
 	
    $dlug_scpr_pr = strlen($scpr_pr);

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda5reglkjtds = "SELECT * FROM zamowienia WHERE  nr_zam='$kodzam'";
	$wynik5reglkjtds = mysql_query($kwerenda5reglkjtds);
	$rekordow5reglkjtds = mysql_numrows($wynik5reglkjtds);
	mysql_close();
	$klientwm1	 			= mysql_result($wynik5reglkjtds, 0, "klient");
	$dlug_klientwm1 = strlen($klientwm1);
	$lok_br='';
										
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda5reglkj = "SELECT * FROM prod_st WHERE barcode='$kod'";
	$wynik5reglkj = mysql_query($kwerenda5reglkj);
	$rekordow5reglkj = mysql_numrows($wynik5reglkj);
	mysql_close();
	$lok_pal_na_reg	 			= mysql_result($wynik5reglkj, 0, "lok_sc");
	$lok_pal_b					= mysql_result($wynik5reglkj, 0, "lok_pal");
	$nr_wys_br					= mysql_result($wynik5reglkj, 0, "nr_wys");
	$lok_br					    = mysql_result($wynik5reglkj, 0, "lok");
	$part_name_br					    = mysql_result($wynik5reglkj, 0, "part_name");
	$dlugpart_name_br = strlen($part_name_br);
    /*
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    $kwerenda1d3fi = "SELECT * FROM prod_fifo WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no' and  nr_zlec='$kodzam' and status='P' ORDER BY lot_no LIMIT 1";
	$wynik1d3fi = mysql_query($kwerenda1d3fi);
	$rekordow1d3fi = mysql_numrows($wynik1d3fi);
	mysql_close();
	$prtu					= mysql_result($wynik1d3fi, 0, "part_no");
	$dlugprtu = strlen($prtu);	
	*/
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    $kwerenda1d3fi = "SELECT * FROM prod_fifo WHERE  part_no='$shinchang_part_no' and  nr_zlec='$kodzam' and status='P' ORDER BY lot_no LIMIT 1";
	$wynik1d3fi = mysql_query($kwerenda1d3fi);
	$rekordow1d3fi = mysql_numrows($wynik1d3fi);
	mysql_close();
	$prtu					= mysql_result($wynik1d3fi, 0, "part_no");
	$P_lot_no					= mysql_result($wynik1d3fi, 0, "lot_no");
	$dlugprtu = strlen($prtu);	
																
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerenda5 = "SELECT * FROM zamowienia_zaw WHERE nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
	$wynik5 = mysql_query($kwerenda5);
	$rekordow5 = mysql_numrows($wynik5);
	mysql_close();
	$id_zaw	 			= mysql_result($wynik5, 0, "id");
	$nr_zam	 			= mysql_result($wynik5, 0, "nr_zam");
	$klient	 			= mysql_result($wynik5, 0, "klient");
	$part_no	 			= mysql_result($wynik5, 0, "part_no");
	$part_name 			= mysql_result($wynik5, 0, "part_name");
	$qty_przyg	 			= mysql_result($wynik5, 0, "qty_box");
	$qty_zam	 			= mysql_result($wynik5, 0, "qty_zam");
	$lot_no	 			= mysql_result($wynik5, 0, "data");						

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
	$kwerendalv = "SELECT * FROM prod_kody WHERE code='$kodzam'";
	$wyniklv = mysql_query($kwerendalv);
	$rekordowlv = mysql_numrows($wyniklv);
	mysql_close();
	$nr_code	 			= mysql_result($wyniklv, 0, "code");						
	$nr_opis	 			= mysql_result($wyniklv, 0, "opis");
	$dl_nr_code= strlen($nr_code); 
 
 	//echo "<br></br>>>TEM  TUTAJ6";
	if($dl_nr_code>1)
	{
		//echo "<br></br>>>TEM  TUTAJ7";
		$qty_przyg=$qty_box;
		$qty_zam=$qty_box+$qty_box;
		$qty_box_pr=$qty_box;
	}
	
	//echo "<br></br>>>TEM  TUTAJ8";
	session_start();
	$_SESSION['sbarcodew']=$kod;
	$dlug_part_no = strlen($part_no);
	$qty_boxmin=$qty_box_pr-1;
	$qty_przygr=$qty_przyg+$qty_box;
	$qty_zammin=$qty_zam+$qty_boxmin;
	$qty_box1=$qty_box+12;
	$qty_box_pr1=$qty_box_pr+18;
	
	if(($nr_wys_br===$kodzam)and($lok_br==='MW'))
	{ 
		//echo "<br></br>>>TEM  TUTAJ9";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO OBECNEJ WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif(($nr_zam!==$kodzam)and($dl_nr_code<1)and($dlug>26))
	{ 
		//echo "<br></br>>>TEM  TUTAJ10";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO OBECNEJ WYSYLKI NR $kodzam $nr_zam<BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ PRAWIDLOWY BOX TEN JEST DO INNEJ WYSYLKI. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($dlug_scpr_pr>1)
	{ 
		//echo "<br></br>>>TEM  TUTAJ11";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO OBECNEJ WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($qty_box<1)
	{ 
		//echo "<br></br>>>TEM  TUTAJ12";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BLAD ODCZYTU BARCODE w ILOSCI <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($lok_br==='ZB')
	{ 
		//echo "<br></br>>>TEM  TUTAJ13";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZABLOKOWANY, W STREFIE PRODUKTOW ZABLOKOWANYCH NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($lok_br==='MW')
	{ 
		//echo "<br></br>>>TEM  TUTAJ14";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO INNEJ WYSYLKI NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($lok_br==='WZ')
	{ 
		//echo "<br></br>>>TEM  TUTAJ15";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST NA WYSYLKA ZAMKNIETA NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($lok_br==='MP')
	{ 
		//echo "<br></br>>>TEM  TUTAJ16";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST NA PRZYJECIU Z PRODUKCJI<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($lok_br==='PR')
	{ 
		//echo "<br></br>>>TEM  TUTAJ17";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST WYDANY NA REWORK<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat";
	}
	elseif($lok_br==='')
	{ 
		//echo "<br></br>>>TEM  TUTAJ18";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX nie jest zarejestrowany w systemie lub bledny kod kreskowy<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat";
	} 
	elseif(($qty_przygr>$qty_zammin) and ($dlug_part_no>1))
	{ 
		//echo "<br></br>>>TEM  TUTAJ19";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ZA DUZA ILOSC $PART_NO BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	 				 
	elseif(($qty_box>$qty_box_pr1) and ($dlug_part_no>1))
	{ 
		//echo "<br></br>>>TEM  TUTAJ20";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ZA DUZA ILOSC NA ETYKIECIE $PART_NO BOX <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}
	elseif(($dlugpart_name_br<1) and ($dlug>26))
	{ 
		//echo "<br></br>>>TEM  TUTAJ21";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BLAD ETYKIETY ZESKANUJ JESZCZE RAZ <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif($dlug_scpr_pr>1)
	{ 
		//echo "<br></br>>>TEM  TUTAJ22";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WYSTEPUJE W WYSYLCE ETYKIETY ZESKANUJ JESZCZE RAZ <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif(($dl_nr_code<1) and($dlug>26)and ($dlug_klientwm1>2))
	{  
		//echo "<br></br>>>TEM  TUTAJ23";
						 
		if($P_lot_no!==$lot_no_baza)
		{ 
			//echo "<br></br>>>TEM  TUTAJ24";
			echo "<font size='0'>"; 
			echo include "podaj_part_no_wys.php"; 
			$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>LOT_NO NIEZGODNY Z FIFO LISTY WYSYLKI<BR></FONT><FONT COLOR='#0000FF'> WSZYTAJ BOX Z PRAWIDLOWYM LOT NO !! 
			";
			echo "<font size='0'>$komunikat";	 
		}
		else
		{
			//echo "<br></br>>>TEM  TUTAJ25";
			$alc_baza = ZwrocAlc( substr($kod , 8, 11) , $baza, $uzytkownik, $haslo);
			$alc_baza = UsunSpacje($alc_baza);
			//echo "<br></br>>>TEM  alc_baza= $alc_baza  formalc= $formalc";
			
			if ( ( !isset($formalc) || strlen($formalc) == 0 ) && strlen($alc_baza) > 0 && $alc_baza !== "0" )
			{
				//echo "<br></br>>>TEM  TUTAJ26";
				echo include "produkt_gotowy_alc_TEST.php"; 
				$komunikat = "<center><B><FONT COLOR='#00aa00'>WCZYTAJ KOD ALC <BR>  
				</center><hr>";
				echo $komunikat;
			}
			else
			{
				//echo "<br></br>>>TEM  TUTAJ27";
				if( strlen($formalc) > 20 )
				{
					//echo "<br></br>>>TEM  TUTAJ28";	
					$formalc = substr( $formalc , 0, 12 );
				}
				elseif( strlen($formalc) > strlen($alc_baza) )
				{
					echo "<br></br>>>TEM  TUTAJ29";
					if(WyszukajMyslnik($formalc)!=0 and $klient =='HANIL SK' ){
						//echo "<br></br>>>TEM TEM HANIL SKLL";
						
						$dlugosc_uciecie = strlen($formalc) - strlen($alc_baza);
						//echo "<br></br> hanil sk dlugoscUciecia=$dlugosc_uciecie alc=".$formalc." alc_baza=".$alc_baza." klient=$klient";
						//$dlugosc_uciecie = WyszukajMyslnik($formalc);
						$formalc = substr( $formalc , $dlugosc_uciecie, strlen($alc_baza ));
						//echo "<br></br> hanil sk dlugoscUciecia=$dlugosc_uciecie alc=".$formalc." alc_baza=".$alc_baza." klient=$klient";
					}
										
					if(WyszukajMyslnik($formalc)!=0 and $klient !='HANIL PL' and $klient !='HANIL SK'){
						//echo "<br></br>>>TEM TEM NIE HANIL SK i nie PL LL";
						//$dlugosc_uciecie = strlen($formalc) - strlen($alc_baza);
						$dlugosc_uciecie = WyszukajMyslnik($formalc);
						$formalc = substr( $formalc , 0, $dlugosc_uciecie );
						//echo "<br></br> dlugoscUciecia=$dlugosc_uciecie alc=".$formalc." alc_baza=".$alc_baza." klient=$klient";
					}
					if(WyszukajMyslnik($formalc)!=0 and ($klient =='HANIL PL' or $klient == 'HANIL SK') )
					{
						//echo "<br></br>>>TEM TEM HANIL PLLL";
						$dlugosc_uciecie = strlen($formalc) - strlen($alc_baza);
						//$dlugosc_uciecie = WyszukajMyslnik($formalc);
						$formalc = substr( $formalc , $dlugosc_uciecie, strlen($alc_baza ));
						//echo "<br></br> hanil pl dlugoscUciecia=$dlugosc_uciecie alc=".$formalc." alc_baza=".$alc_baza." klient=$klient";
					}
					

				}
				
				
				/*
				echo "
				<br>
				PART NO: " . substr($kod , 8, 11) . "
				<br>
				";
				*/
				
				settype($alc_baza, "string");
				settype($formalc, "string");
				
				/*
				echo "
				<br>
				ALC CZYTNIK: '" . $formalc . "'
				<br>
				ALC BAZA: '" . $alc_baza . "'
				<br>
				";
				*/
				//echo "<br></br>>>TEM  TUTAJ30";
				if( strlen($alc_baza) == 0 || $alc_baza == "0" )
				{
					//echo "<br></br>>>TEM  TUTAJ31";
					//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
					
					require "incl/wys_zapis_a.php";
					
					ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
					$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
					
					//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
				}
				elseif($alc_baza == $formalc)
				{
					//echo "<br></br>>>TEM  TUTAJ32";
					if ( !isset($licznik) || $licznik == NULL || $licznik <= 0 )
					{
						$licznik = 1;
					}
					
					if ( $licznik <= ($qty_box - 1) && ( $nazwa_klienta == "KMS" || $nazwa_klienta == "HMMC" || $nazwa_klienta == "KOMOS" ) )
					{
						//echo "<br></br>>>TEM  TUTAJ33";
						$licznik++;
						echo include "produkt_gotowy_alc_TEST.php"; //inkrementowany $licznik przekazywany do formularza!
						$komunikat = "<center><B><FONT COLOR='#00aa00'>KOD ALC ( " . ( $licznik - 1 ) . " z " . $qty_box . " ) OK<BR>WCZYTAJ NASTEPNY KOD!<BR>					
						</center><hr>
						";
						echo $komunikat;
					}
					else
					{
						//echo "<br></br>>>TEM  TUTAJ34";
						//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
						
						require "incl/wys_zapis_a.php";
						
						ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
						$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
						
						//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
					}
					//echo "<br></br>>>TEM  TUTAJ35";
				}
				else
				{
					//echo "<br></br>>>TEM  TUTAJ36";
					echo include "produkt_gotowy_alc_TEST.php"; 
					$komunikat = "<center><B><FONT COLOR='#FF0000'>KOD ALC NIEZGODNY !<BR>WCZYTAJ KOD ALC<BR>  
					</center><hr>";
					echo $komunikat;
				}
				
				//echo "<br></br>>>TEM  TUTAJ37";
			}
			
			
			
			
			
			
			
			
			
			
			
			
		}
	}
	elseif($dlug_qty_box_pr<1)
	{ 
		//echo "<br></br>>>TEM  TUTAJ38";
		echo include "parowanie_klient_kod.php"; 
	}	
	elseif(($dlug_part_no<1)and($dl_nr_code<1))
	{ 
		//echo "<br></br>>>TEM  TUTAJ39";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	elseif(($lok_br==='MG')and($dl_nr_code<1)) 
	{  
		//echo "<br></br>>>TEM  TUTAJ40";
		$alc_baza = ZwrocAlc( substr($kod , 8, 11) , $baza, $uzytkownik, $haslo);
		$alc_baza = UsunSpacje($alc_baza);
		
		if ( ( !isset($formalc) || strlen($formalc) == 0 ) && strlen($alc_baza) > 0 && $alc_baza !== "0" )
		{
			//echo "<br></br>>>TEM  TUTAJ41";
			echo include "produkt_gotowy_alc_TEST.php"; 
			$komunikat = "<center><B><FONT COLOR='#00aa00'>WCZYTAJ KOD ALC <BR>  
			</center><hr>";
			echo $komunikat;
		}
		else
		{
			//echo "<br></br>>>TEM  TUTAJ42";
			if( strlen($formalc) > strlen($alc_baza) )
			{
				$dlugosc_uciecie = strlen($formalc) - strlen($alc_baza);
				$formalc = substr( $formalc , $dlugosc_uciecie, strlen($alc_baza) );
			}
			
			
			
			/*
			echo "
			<br>
			PART NO: " . substr($kod , 8, 11) . "
			<br>
			";
			*/
			
			settype($alc_baza, "string");
			settype($formalc, "string");
			
			/*
			echo "
			<br>
			ALC CZYTNIK: '" . $formalc . "'
			<br>
			ALC BAZA: '" . $alc_baza . "'
			<br>
			";
			*/
			//echo "<br></br>>>TEM  TUTAJ43";
			if( strlen($alc_baza) == 0 || $alc_baza == "0" )
			{
				//echo "<br></br>>>TEM  TUTAJ44";
				//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
				
				require "incl/wys_zapis_a.php";
				
				ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
				$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
				
				//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			}
			elseif($alc_baza == $formalc)
			{
				//echo "<br></br>>>TEM  TUTAJ45";
				if ( !isset($licznik) || $licznik == NULL || $licznik <= 0 )
				{
					$licznik = 1;
				}
				
				if ( $licznik <= ($qty_box - 1) && ( $nazwa_klienta == "KMS" || $nazwa_klienta == "HMMC" || $nazwa_klienta == "KOMOS" ) )
				{
					//echo "<br></br>>>TEM  TUTAJ46";
					$licznik++;
					echo include "produkt_gotowy_alc_TEST.php"; //inkrementowany $licznik przekazywany do formularza!
					$komunikat = "<center><B><FONT COLOR='#00aa00'>KOD ALC ( " . ( $licznik - 1 ) . " z " . $qty_box . " ) OK<BR>WCZYTAJ NASTEPNY KOD!<BR>					
					</center><hr>
					";
					echo $komunikat;
				}
				else
				{
					//echo "<br></br>>>TEM  TUTAJ47";
					//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
					
					require "incl/wys_zapis_a.php";
					
					ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
					$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
					
					//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
				}
				//echo "<br></br>>>TEM  TUTAJ48";
			}
			else
			{
				//echo "<br></br>>>TEM  TUTAJ49";
				echo include "produkt_gotowy_alc_TEST.php"; 
				$komunikat = "<center><B><FONT COLOR='#FF0000'>KOD ALC NIEZGODNY !<BR>WCZYTAJ KOD ALC<BR>  
				</center><hr>";
				echo $komunikat;
			}
		
		}
		
	}
	elseif(($lok_br==='MG')and($dl_nr_code>1)) 
	{       
		//echo "<br></br>>>TEM  TUTAJ50";
		$alc_baza = ZwrocAlc( substr($kod , 8, 11) , $baza, $uzytkownik, $haslo);
		$alc_baza = UsunSpacje($alc_baza);
		
		if ( ( !isset($formalc) || strlen($formalc) == 0 ) && strlen($alc_baza) > 0 && $alc_baza !== "0" )
		{
			//echo "<br></br>>>TEM  TUTAJ51";
			echo include "produkt_gotowy_alc_TEST.php"; 
			$komunikat = "<center><B><FONT COLOR='#00aa00'>WCZYTAJ KOD ALC <BR>  
			</center><hr>";
			echo $komunikat;
		}
		else
		{
			//echo "<br></br>>>TEM  TUTAJ52";
			if( strlen($formalc) > strlen($alc_baza) )
			{
				//echo "<br></br>>>TEM  TUTAJ53";
				$dlugosc_uciecie = strlen($formalc) - strlen($alc_baza);
				$formalc = substr( $formalc , $dlugosc_uciecie, strlen($alc_baza) );
			}
			
			
			
			/*
			echo "
			<br>
			PART NO: " . substr($kod , 8, 11) . "
			<br>
			";
			*/
			
			settype($alc_baza, "string");
			settype($formalc, "string");
			
			/*
			echo "
			<br>
			ALC CZYTNIK: '" . $formalc . "'
			<br>
			ALC BAZA: '" . $alc_baza . "'
			<br>
			";
			*/
			
			if( strlen($alc_baza) == 0 || $alc_baza == "0" )
			{
				//echo "<br></br>>>TEM  TUTAJ54";
				//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
				
				require "incl/wys_zapis_b.php";
				
				ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
				$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
				
				//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
			}
			elseif($alc_baza == $formalc)
			{
				//echo "<br></br>>>TEM  TUTAJ55";
				if ( !isset($licznik) || $licznik == NULL || $licznik <= 0 )
				{
					//echo "<br></br>>>TEM  TUTAJ56";
					$licznik = 1;
				}
				
				if ( $licznik <= ($qty_box - 1) && ( $nazwa_klienta == "KMS" || $nazwa_klienta == "HMMC" || $nazwa_klienta == "KOMOS" ) )
				{
					//echo "<br></br>>>TEM  TUTAJ57";
					$licznik++;
					echo include "produkt_gotowy_alc_TEST.php"; //inkrementowany $licznik przekazywany do formularza!
					$komunikat = "<center><B><FONT COLOR='#00aa00'>KOD ALC ( " . ( $licznik - 1 ) . " z " . $qty_box . " ) OK<BR>WCZYTAJ NASTEPNY KOD!<BR>					
					</center><hr>
					";
					echo $komunikat;
				}
				else
				{
					//echo "<br></br>>>TEM  TUTAJ58";
					//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
				
					require "incl/wys_zapis_b.php";
					
					ZapiszLog( substr($kod , 8, 11) , $qty_box, $login, "PAROWANIE ALC", 
					$formalc, $kod, $kodzam, $nazwa_klienta, $baza, $uzytkownik, $haslo);
					
					//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
				}
				
				
				
			}
			else
			{
				//echo "<br></br>>>TEM  TUTAJ59";
				echo include "produkt_gotowy_alc_TEST.php"; 
				$komunikat = "<center><B><FONT COLOR='#FF0000'>KOD ALC NIEZGODNY !<BR>WCZYTAJ KOD ALC<BR>  
				</center><hr>";
				echo $komunikat;
			}
  
		}	
			

	}							
	else
	{ 
		//echo "<br></br>>>TEM  TUTAJ60";
		echo "<font size='0'>"; 
		echo include "podaj_part_no_wys.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX NIE JEST ZAREJESTROWANY W SYSTEMIE !!! <BR></FONT><FONT COLOR='#0000FF'> PRZYJMIJ BOX DO SYSTEMU !!! 
		";
		echo "<font size='0'>$komunikat"; 
	}						
}
?>
