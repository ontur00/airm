<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Formularz aktualizacyjny</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<STYLE type="text/css">
a:link {color: rgb(255,0,0);
     background-color: transparent;
     font-weight: bold;
     font-style: normal;
     text-decoration: none}

a:visited {color: rgb(0,0,0);
     background-color: transparent;
     font-weight: normal;
     font-style: normal;
     text-decoration: none}

a:hover, a:active {color: rgb(0,255,0);
     background-color: transparent;
     font-weight: normal;
     font-style: normal;
     text-decoration: none}
</STYLE>
</HEAD>

<BODY>

<?php
// Skrypt wyœwietla formularz wraz z wype³nionymi polami osoby, której numer ID
// zosta³ przekazany temu skryptowi z zewn¹trz
$id = $_GET['id'];
$baza = 'barcode';
$uzytkownik = 'robak';
$haslo = 'robak1';
$stanz = 0;
mysql_connect('localhost',$uzytkownik,$haslo);
//mysql_query('SET NAMES latin2');
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$a = 0;
while ($a < $rekordow) {
$id 						= mysql_result($wynik, $a, "id");
$nr_etyk					= mysql_result($wynik, $a, "nr_etyk");
$pojazd 					= mysql_result($wynik, $a, "pojazd");
$part_no 					= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 			= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 					= mysql_result($wynik, $a, "part_name");
$qty_box 					= mysql_result($wynik, $a, "qty_box");
$data	 					= mysql_result($wynik, $a, "data");
$stan 						= mysql_result($wynik, $a, "stan");
$inne 						= mysql_result($wynik, $a, "inne");
$stanz 						= mysql_result($wynik, $a, "stanz");
echo "
<font size='4'><center><b> RECZNA ZMIANA STANU PRODUKÓW MAGAZYNU / MANUAL PRODUCED CHANGE IN STORAGE</b></center></font><hr>

<FORM ACTION='stan_zmien.php' METHOD='POST'>



<TABLE class='menu' ALIGN='center' WIDTH='900' CELLSPACING='0' CELLPADDING='0' BORDER='0' >

	<TR>
	<TD> <font size='3'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='4'><B>$data  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='3'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='4'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='3'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='4'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='3'>NAZWA PRODUKTU / PART NAME :   </font>				    			</TD>
	<TD> <font size='4'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='3'>NR NA PRODUKCIE / PRODUCT NO : </font>				 			</TD>
	<TD> <font size='4'><B>$nr_etyk     </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='3'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='4'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	
	<TD><br><font size='4'color='green'>OBECNY STAN MAGAZYNOWY / STOCK NOW<br><br></TD></font>
	<TD colspan='2'><font size='5'color='green'><B>$stan</B></TD></font>
    <br><br></TR>
	<TR>
	
	<TD><br><font size='4' color='red'>ZMIANA STANU MAGAZYNOWEGO O ILOŒÆ / STOCK CHANGE QUANTITY<br><br></TD>
	<TD colspan='2'><INPUT TYPE='text' NAME='stanz' VALUE='$stanz' SIZE='40' NUMER='20' MAXLENGTH='30'></TD></font>
    <br><br></TR>
	<TR>	
	<TD> <font size='3'>ILOSC BOX / QTY BOX: </font>				     	</TD>	
	<TD> <font size='4'>					<B>$qty_box	 </font></B>      	</TD>	
	</TR><br><br>
	<TR> <td> </td>
	<TD> </TD></TR>
    <TR> <td></td>
    <INPUT TYPE='hidden' NAME='id' VALUE='$id'>
    <INPUT TYPE='hidden' NAME='data' VALUE='$data'>
    <INPUT TYPE='hidden' NAME='shinchang_part_no' VALUE='$shinchang_part_no'>
    <INPUT TYPE='hidden' NAME='part_no' VALUE='$part_no'>
    <INPUT TYPE='hidden' NAME='part_name' VALUE='$part_name'>
    <INPUT TYPE='hidden' NAME='nr_etyk' VALUE='$nr_etyk'>
    <INPUT TYPE='hidden' NAME='pojazd' VALUE='$pojazd'>
    <INPUT TYPE='hidden' NAME='stan' VALUE='$stan'>
    <INPUT TYPE='hidden' NAME='qty_box' VALUE='$qty_box'>
	<TD ALIGN='right'><INPUT TYPE='submit' VALUE='...Zapamiêtaj / Save...'></TD></TR>
	
	</TABLE>
";


++$a;
}

?>


</BODY>
</HTML>
