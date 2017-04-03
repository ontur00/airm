

<?php
// Created by Przemyslaw Cios //
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 
session_start(); 
$id=$_SESSION['sid']; 				

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();


$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$qty_box	 			= mysql_result($wynik, $a, "qty_box");              
$partia					= mysql_result($wynik, $a, "partia");
$klient 				= mysql_result($wynik, $a, "klient");
$inne	 				= mysql_result($wynik, $a, "inne");
$data=date("Y-m-d");



$qty_box_il=ceil($partia/$qty_box);  


echo"

	<TR>
	<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'><CENTER><A HREF='index.php'>MENU</A></CENTER></TD>
		<TD class='menu' BGCOLOR='#ccffcc'><CENTER><A HREF='kody_pokaz_linia1.php'>Powrót do listy towarów /Back to the list of goods</A></CENTER></TD>
		<TD class='menu' BGCOLOR='#ddddff' WIDTH='30%'><CENTER><A HREF='kod_g_p.php' target='_blank'>Drukowanie Etykiet /Printing barcode</A></CENTER></TD>
	</TR>
	</TABLE>
</div>
<FORM ACTION='kod_2_p.php' target='_blank' METHOD='POST'>
<center><IMG SRC='kod_gen2p.php' WIDTH='320' HEIGHT='200' BORDER='0'></center>
<TABLE class='menu' ALIGN='center' WIDTH='700' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
<TR>
	<TD> <font size='2'>KLIENT / BUYER:		 </font>					</TD>
	<TD> <font size='4'><B>$klient  </font></B></TD>
	</TR>
	<TR>
	<TD> <font size='2'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='4'><B>$data  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='2'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='4'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='2'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='4'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='2'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='4'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='2'>LINIA PRODUKCYJNA / PRODUCTION LINE: </font>				 			</TD>
	<TD> <font size='4'><B>$linia      </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='2'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='4'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	<TD> <font size='2'>ILOSC W PUDELKU / QUATITY EA: </font>					</TD>
	<TD> <font size='4'><B>$qty_box </font></B>							</TD>
	</TR>
	<TR>	
	<TD> <font size='2'>ILOSC PUDE£EK Z PRODUKTAMI / NO BOXES PRODUCTS: </font>				     	</TD>	
	<TD> <font size='4'>					<B>$qty_box_il	 </font></B>      	</TD>	
	</TR>
		<TR>	
	<TD> <font size='2'>ILOSC WYPRODUKOWANA NA ZLECENIE / QUANTITY PRODUCED ON CONTRACT  </font>				     	</TD>	
	<TD> <font size='4'>					<B>$partia	 </font></B>      	</TD>	
	</TR>
	<TR>
	<TD> <font size='2'><CENTER>
	<INPUT TYPE='hidden' NAME='partia' VALUE='$partia'>	
	<INPUT TYPE='hidden' NAME='qty_box' VALUE='$qty_box'>	
	<INPUT TYPE='hidden' NAME='qty_box_il' VALUE='$qty_box_il'>	
	<INPUT TYPE='submit' VALUE='DRUKUJ ETYKIETY / PRINT BARCODE'>
	</CENTER></font>
	</TD>
	</TABLE>
	</FORM>
";
?>

