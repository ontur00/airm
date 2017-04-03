<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Untitled</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<?php


$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE nr_etyk='$kodp'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$id  					= mysql_result($wynik, $a, "id");                 
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data 	 				= mysql_result($wynik, $a, "data");
$inne	 				= mysql_result($wynik, $a, "inne");
$qty_box	 			= mysql_result($wynik, $a, "qty_box");
$klient	 				= mysql_result($wynik, $a, "klient");

session_start();
$_SESSION['sidb']=$id;
							
?>


</HEAD>

<BODY>
<?php							
echo " 
 


<br><br>

<font size='4'> <center> WCZYTANY KOD Z PRODUKTU:<b>   $kodp   </b></center></font><br>

<TABLE class='menu' ALIGN='center' WIDTH='600' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
<TR>
	<TD> <font size='3'>KLIENT / SALES:		 </font>					</TD>
	<TD> <font size='4'><B>$klient  </font></B></TD>
	</TR>
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
	<TD> <font size='3'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='4'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='3'>LINIA PRODUKCYJNA / PRODUCTION LINE: </font>				 			</TD>
	<TD> <font size='4'><B>$linia      </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='3'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='4'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	<TD> <font size='3'>ILOSC W PUDELKU / Quantity EA: </font>					</TD>
	<TD> <font size='4'><B>$qty_box </font></B>							</TD>
	</TR>
	<TR>	
	<TD> <font size='3'>Nr z etykietki prod: </font>				     	</TD>	
	<TD> <font size='4'>					<B>$kodp	 </font></B>      	</TD>	
	</TR>
	</TABLE>

     " ;



?>

</BODY>
</HTML>
