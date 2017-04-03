

<?php 
// script by Przemys³aw Cios
$znacznik="qc";

session_start();
$id=$_SESSION['sqid'];

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$linia					=  $_GET['linia'];
$pojazd					=  $_GET['pojazd'];
$part_no 				=  $_GET['part_no'];
$shinchang_part_no 		=  $_GET['shinchang_part_no'];
$part_name 				=  $_GET['part_name'];
$data1 	 				=  $_GET['data1'];
$barcode 	 			=  $_GET['barcode'];
$ilosc_pierwotna		=  $_GET['ilosc_pierwotna'];
$qty_box 	 			=  $_GET['qty_box'];
$no_box         		=  $_GET['no_box'];
$nr_zlec     			=  $_GET['nr_zlec'];
$klient 				=  $_GET['klient'];
$kod 				    =  $_GET['kod'];









                  mysql_connect('localhost',$uzytkownik,$haslo);
                  mysql_query('SET CHARSET latin2');
                  @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
                  $kwerenda = "UPDATE rej_prod_got SET kod_bledu='$kodb',znacznik='$znacznik',ilosc_pierwotna='$ilosc_pierwotna' WHERE id='$id'";
                  mysql_query($kwerenda);
                  mysql_close();

                  mysql_connect('localhost',$uzytkownik,$haslo);
                  mysql_query('SET CHARSET latin2');
                  @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
                  $kwerenda1 = "INSERT INTO qc_rej_brakow_prod SET (linie,pojazd,part_no,shinchang_part_no,part_name,data_z_kodu,barcode,qty_box,kod_bledu,no_box,nr_zlec,klient,uzytkownik)
         	      VALUES ('$linia','$pojazd','$part_no','$shinchang_part_no','$part_name','$data1','$barcode','$roznica','$kodb','$no_box','$nr_zlec','$klient','$uzytkownik')";
                  mysql_query($kwerenda1);
                  mysql_close();
                  
                  mysql_connect('localhost',$uzytkownik,$haslo);
                  mysql_query('SET CHARSET latin2');
                  @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
                  $kwerenda1 = "INSERT INTO wydruk_rej SET (linia,pojazd,shinchang_part_no,part_no,part_name,qty_box,no_box,partia,nr_zlec,uzytkownik,data,klient)
         	      VALUES ('$linia','$pojazd','$shinchang_part_no','$part_no','$part_name','$roznica','$data1','$kodb','$no_box''$no_box','000',$nr_zlec','$uzytkownik','$data1','$klient')";
                  mysql_query($kwerenda1);
                  mysql_close();
                  
                  mysql_connect('localhost',$uzytkownik,$haslo);
                  mysql_query('SET CHARSET latin2');
                  @mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
                  $kwerenda1 = "SELECT * FROM wydruk_rej WHERE shinchang_part_no='$shinchang_part_no'";
                  $wynik = mysql_query($kwerenda1);
                  $rekordow = mysql_numrows($wynik);
                  mysql_close();
                  $idst	= mysql_result($wynik, $a, "id");
 
 
 echo" 
  <center>
								 <TABLE class='menu' ALIGN='center' WIDTH='720' HEIGHT='380' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
								<TR>
								<TD> <font size='6'><FONT COLOR='#00CC00'><B>Operacja zarejestrowana pomyslnie !!!  <br><br>The operation successfully registered !!!</font></font></B><br></TD>
								</TR>
								<TR>
								
								
								
								
								
								
								
								
								
								
								</TR>
								 </table>
								 
								 
								 
<div style='margin: 0px;'>
	<TABLE ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
	<TR>
	<TD BGCOLOR='#ff9999'>
	<A HREF='druk_etykiet_ac.php?idst=$idst' TARGET='blank'>
	<B>ROZPOCZECIE WYDRUKU ETYKIETY /  BEGINS BARCODE PRINTING<BR><FONT COLOR='#4444FF'>
	 </B></A></FONT>
	</TD>
	
	<TD  BGCOLOR='#ccffcc'><A HREF='ac.php'><B>PONOWNE KOREKTA KODU KRESKOWEGO / RELOADING BARCODE<BR><FONT COLOR='4444FF'></B> </A></FONT></TD>
		
	</TR>
	</TABLE>
</div>


								 </center>
								  

 ";
								 
								 
								
                  
?>
