
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$part_nos=$_SESSION['spart_nos'];
$qty_boxs=$_SESSION['sqty_boxs'];
$kod_sprzed1=$_SESSION['sbarcodes'];
$dluglogin = strlen($login);


$kod 	    = $_POST['kod'];
$par_alc 	= $_POST['par_alc_form'];
$licznik 	= $_POST['licznik'];

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';



if($dluglogin<2)
{ 
	echo "<font size='0'>"; 
	echo include "wyloguj.php"; 
	$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
    ";
	echo "<font size='0'>$komunikat"; 
}
else 
{																	
	    						     
	if($kod_sprzed1===$kod)
	{ 
		//VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
		
		
		
		if ( !isset( $par_alc ) || strlen($par_alc) == 0 )
		{
			if ( !isset($_SESSION['skomunikat_etyk2']) )
			{
				$komunikat = "<center><B><FONT COLOR='#00aa00'>etykieta SPRZEDAZOWA DRUGA!(2) OK $qty_box<BR>  
				</center><hr>";
				echo $komunikat;
				
				$_SESSION['skomunikat_etyk2'] = "OK";
			}
			
			echo include "par_wys_hmmc_alc_TEST.php"; 
			
		}
		else
		{
			
			
			mysql_connect('localhost',$uzytkownik,$haslo);
			mysql_query('SET CHARSET latin2');
			@mysql_select_db($baza) or die("Nie można znaleźć bazy danych!");
			$kwerenda = "SELECT * FROM prod_got WHERE part_no='$part_nos' ";
			$wynik = mysql_query($kwerenda);
			$rekordow = mysql_numrows($wynik);
			mysql_close();
			
			$alc_z_bazy = mysql_result($wynik, 0, "nr_etyk");	
			
			if( strlen($par_alc) > 11 )
			{
				$dlugosc_uciecie = strlen($par_alc) - 11;
				$par_alc = substr($par_alc , $dlugosc_uciecie , 11);  //<- sprawdzic czy ($dlugosc_uciecie - 1)   !
			}
			
			settype($alc_z_bazy, "string");
			settype($par_alc, "string");
			
			if ($alc_z_bazy == $par_alc)
			{
				if ( !isset($licznik) || $licznik == NULL || $licznik <= 0 )
				{
					$licznik = 1;
				}
				
				if ( $licznik <= ($qty_boxs - 1) )
				{
					$licznik++;
					echo include "par_wys_hmmc_alc_TEST.php"; //inkrementowany $licznik przekazywany do formularza!
					$komunikat = "<center><B><FONT COLOR='#00aa00'>KOD ALC ( " . ( $licznik - 1 ) . " z " . $qty_boxs . " ) OK<BR>WCZYTAJ NASTEPNY KOD!<BR>					
					</center><hr>
					";
					echo $komunikat;
				}
				else
				{
					echo include "zapisz_parowaniehmmc.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'>WSZYSTKIE KODY ALC OK!<BR>  
					</center><hr>
					";
					echo $komunikat;
					
					if ( isset($_SESSION['skomunikat_etyk2']) )
					{
						unset($_SESSION['skomunikat_etyk2']);
					}
				}
				
				
				
				
			}
			else
			{
				$komunikat = "<center><B><FONT COLOR='#FF0000'>NIEPRAWIDLOWY KOD ALC<BR>  
				</center><hr>
				";
				echo $komunikat;
				
				echo include "par_wys_hmmc_alc_TEST.php"; 
			}
			
		}
		
		
		
		
		//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	}
	/*
	elseif($qty_box!=$qty_boxs)
	{ 
		echo "<font size='0'>"; echo include "par_wys2.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWA ILOSC NA ETYKIECIE !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
		";
		echo "<font size='0'>$komunikat"; 
	}	
	*/	
	else
	{ 
		echo "<font size='0'>"; 
		echo include "par_wys3_hmmc.php"; 
		$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>DRUGA!(2) SPRZEDAZOWA NIEZGODNA LUB NIEPRAWIDLOWA ETYKIETA !!! <BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ JESZCZE RAZ !!! 
		";
		echo "<font size='0'>$komunikat"; 
	}	

}							
							

?>
