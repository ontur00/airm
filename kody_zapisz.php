<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>zapis rejestacji do bazy</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 32: document.location.href='rcp_z_czytnika.php?kod=0'; 
	 break;
     case 27: document.location.href='rcp_z_czytnika.php?kod=0';
     break;
     case 40: document.location.href='rcp_z_czytnika.php?kod=0';
     break
     default: document.location.href='rcp_z_czytnika.php?kod=0';
   }"
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>
</HEAD>

<BODY>
<?php
$nr_zlec_p				="test_program";
$linia_p				= $_GET['linia'];
$pojazd_p				= $_GET['pojazd'];
$shinchang_part_no_p	= $_GET['shinchang_part_no'];
$part_no_p				= $_GET['part_no'];
$part_name_p		    = $_GET['part_name'];
$qty_box_p		    	= $_GET['qty_box'];
$no_box_p 				= $_GET['no_box'];
$data_wyd_p		    	= $_GET['data_wyd'];
$barcode_p		    	= $_GET['barcode'];

session_start(); 
$user_p=$_SESSION['luzytkownik'];

if (isset($_SESSION['luzytkownik'])) {
	echo "<div align='right'><A HREF='wyloguj.php'>Wyloguj u¿ytkownika / logout user&nbsp;:&nbsp;<b> ".$_SESSION['luzytkownik']."</A></b></div>";}

 $baza			= 'barcode';
 $uzytkownik	= 'robak';
 $haslo			= 'robak1';

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
 
 $kwerenda = "SELECT * FROM rej_prod_got WHERE barcode='$barcode_p'";
 $wynik=mysql_query($kwerenda);
 $rekordow = mysql_numrows($wynik);
 mysql_close();
 $shinchang_part_no_baza 			= mysql_result($wynik, $a, "shinchang_part_no"); 
 $barcode_data_baza 				= mysql_result($wynik, $a, "data_z_kodu"); 
 $qty_box_baza 						= mysql_result($wynik, $a, "qty_box"); 
 $no_box_baza 						= mysql_result($wynik, $a, "no_box"); 
 $space								=	" ";
 $barcode_data_baza_o=str_replace("-", "", $barcode_data_baza); 
 $o									=	"O";
 $kod_baza_zl="$barcode_data_baza_o$shinchang_part_no_baza$space$qty_box_baza$no_box_baza$o";	 


	
 
 $dl_kod_baza_zl=strlen($kod_baza_zl);
 $dl_barcode_p=strlen($barcode_p);
                 
 if ($dl_kod_baza_zl==$dl_barcode_p) {  echo "	<center>
								 <TABLE class='menu' ALIGN='center' WIDTH='720' HEIGHT='380' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
								<TR>
								<TD> <font size='6'><FONT COLOR='#FF0000'><B>Ta operacja zosta³a juz zarejestrowana !!!  <br><br>This operation has already been registered !!!</font></font></B><br></TD>
								</TR>
								<TR>
								
								</TR>
								 </table>
								 </center>";
 								 	 }
							else {
							     mysql_connect('localhost',$uzytkownik,$haslo);
                                 mysql_query('SET CHARSET latin2');
                                 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                 $kwerenda = "INSERT INTO rej_prod_got(linia,pojazd,shinchang_part_no,part_no,part_name,qty_box,no_box,nr_zlec,uzytkownik_id,data_z_kodu,barcode)
                             				       VALUES('$linia_p','$pojazd_p','$shinchang_part_no_p','$part_no_p','$part_name_p','$qty_box_p','$no_box_p','$nr_zlec_p','$user_p','$data_wyd_p','$barcode_p')";
                                 $wynik=mysql_query($kwerenda);
                                 $rekordow = mysql_numrows($wynik);
								 mysql_close();
								 
								  echo "
								 <center>
								 <TABLE class='menu' ALIGN='center' WIDTH='720' HEIGHT='380' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
								<TR>
								<TD> <font size='6'><FONT COLOR='#00CC00'><B>Operacja zarejestrowana pomyslnie !!!  <br><br>The operation successfully registered !!!</font></font></B><br></TD>
								</TR>
								<TR>
								
								</TR>
								 </table>
								 </center>";
								}

?>
</BODY>
</HTML>
