<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################
  $kod	= $_POST['kod'];

function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);								// Zwraca TRUE jeli $d (czyli data) jest wypełniona
  return $flaga;
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">






<?php
$tekst_1="<font size='1'>Ostatnie zdarzenie:";
$kodp 	= $_POST['kodp'];
session_start();
$_SESSION['skod_prod'] = $kodp;  
$dlugio = strlen($kodp);

if ($dlugio>5or$dlugio<2) {  $czas = date("G:i"); 
                                $komunikat = "<center><B>$tekst_1 [$czas]</B><br>
								<FONT COLOR='#FF0000'><font size='1'>	Wprowadzono nieprawidłowy kod 
							              <br>
										  
										  ";
						
							include"aprcp_z_czytnika.php";
						}
							else {
							echo"<font size='1'><center><b> PRZYJECIE PRODUKTOW NA MAGAZYN </b></center></font><hr>";
                            include"lacznik.php";
                            
                            include"prz_por_bar.php";
                                 }
?>
</BODY>
</HTML>
