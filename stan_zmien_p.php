<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">



</HEAD>
<BODY>


<?php
$blad						= $_GET['blad'];
$id 						= $_POST['id'];
$kod 						= $_POST['kod'];
$nr_etyk					= $_POST['nr_etyk'];
$pojazd 					= $_POST['pojazd'];
$part_no 					= $_POST['part_no'];
$shinchang_part_no 			= $_POST['shinchang_part_no'];
$part_name 					= $_POST['part_name'];
$qty_box 					= $_POST['qty_box'];
$data	 					= $_POST['data'];
$stan 						= $_POST['stan'];
$stanz 						= $_POST['stanz'];
$pusty="";

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM air_powod WHERE kod='$kod'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$kodb = mysql_result($wynik, $a, "kod");  
$powod = mysql_result($wynik, $a, "powod"); 

if (ord($kod) == "0D") { 
$blad=" <hr><font size=5><center> Wprowadz Własciwy Kod / Enter the appropriate code<br><FONT COLOR='#FF0000'>To nie jest kod bledu / This is not an error code<hr> </font></font></center>"; 
	echo include "stan_zmien.php";                    }

				 else
if ($kodb<>$kod) { 
$blad=" <hr><font size=5><center> Wprowadz Własciwy Kod / Enter the appropriate code<br><FONT COLOR='#FF0000'>To nie jest kod bledu / This is not an error code<hr> </font></font></center>"; 
	echo include "stan_zmien.php";                    }

				 else  {
				 
				?> 
				 
<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 55: document.location.href='stan_zmien1.php?id=$id&nr_etyk=$nr_etyk&pojazd=$pojazd&part_no=$part_no&shinchang_part_no=$shinchang_part_no&part_name=$part_name&qty_box=$qty_box&data=$data&stan=$stan&kod=$kod&stanz=$stanz'; 
	 break;
     case 57: document.location.href='air_zapis_baza.php?id=$id&nr_etyk=$nr_etyk&pojazd=$pojazd&part_no=$part_no&shinchang_part_no=$shinchang_part_no&part_name=$part_name&qty_box=$qty_box&data=$data&stan=$stan&kod=$kod&stanz=$stanz';
     break;
     default: alert('Naciśnij ENTER, a następnie / Press ENTER, and then:\\n9 - jeśli operacja zakończona lub / or if the operation completed \\n7 - aby wczytać ponownie kod kreskowy / to read the bar code again');
   }"
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>
				 
<?php	
echo"
<div style='margin: 0px;'>
	<TABLE ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
	<TR>
	<TD BGCOLOR='#ff9999'>
	<A HREF='air_zapis_baza.php?linia=$linia&pojazd=$pojazd&part_no=$part_no&shinchang_part_no=$shinchang_part_no&part_name=$part_name&data1=$data1&barcode=$barcode&ilosc_pierwotna=$ilosc_pierwotna&qty_box=$qty_box&no_box=$no_box&nr_zlec=$nr_zlec&klient=$klient&kod=$kod&stanz=$stanz'>
	ROZPOCZECIE REJESTRACJI / REGISTRATION BEGINS<BR><FONT COLOR='#4444FF'>
	<B>NACISNIJ / PRESS  9 </B></A></FONT>
	</TD>
	
	<TD  BGCOLOR='#ccffcc'><A HREF='stan_zmien.php'>PONOWNE WCZYTYWANIE KODU KRESKOWEGO / RELOADING BARCODE<BR><FONT COLOR='4444FF'><B>NACISNIJ / PRESS 7</B> </A></FONT></TD>
		
	</TR>
	</TABLE>
</div>
";


			 
				 echo "<br><br><font size='6'><center>  Wczytano kod:<br><br> $powod <br> Kod Bledu: $kodb <br><br><br></font>";
				 //<input type="button" onClick="fullwin('air_zapis_baza.php')" value="zatwierdzenie zmian / Apply Changes  ">
			
                  } 
				  
?>
</BODY>
</HTML>
