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
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
<!--
p				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: thin; }
th.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: right; empty-cells: show; border-style: none; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 0px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
td.menu			{  padding: 0px; border-style: none; font-size: 20px;}
td.sekcje		{  padding-right: 2px; padding-left: 2px; text-align: left; border-style: none; }
td.szare		{  text-align: center; background-color: #808080; color: black; width: 15px; }
td.naglowek_v	{  text-align: center; background-color: black; color: white; }
td.naglowek_h	{  text-align: center; background-color: black; color: white; }
td.roboczy		{  text-align: center; background-color: white; color: black; width: 15px; }
td.sobota		{  text-align: center; background-color: #E6FFFF; color: black; width: 15px; }
td.niedziela	{  text-align: center; background-color: #FFB0B0; color: black; width: 15px; }
td.swieto		{  text-align: center; background-color: red; color: black; width: 15px; }
td.rek_urlop	{  text-align: center; background-color: #CDFF9B; color: black; width: 15px; }
td.wolne		{  text-align: center; background-color: #FFFF00; color: black; width: 15px; }
td.firma		{  font-size: 16px; text-align: center; background-color: #E4EEF1; color: black; height: 26px; font-weight: bold;  }
.lewa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: left;  }
.prawa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right;  }

.tabele_glowne	{  border-color: black; border-width: 2px; border-style: none; border-spacing: 0px; padding: 0px; margin: auto; text-align: left; }
.obramuj		{  border-color: black; border-width: thin; border-style: dashed; font-weight: bold;  }

table.menu		{  font-family: Arial, Helvetica, sans-serif; border-style: none; border-spacing: 0px; padding: 0px; margin: auto;  }
div.pozycje		{  width: 300px; background-position: center; position:absolute; z-index:1; border-style: hidden;  }
legend			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;  }
input.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
textarea.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
input			{ text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
select			{ text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>





<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";

$kod 	= $_POST['kod'];

$dlug = strlen($kod);
$data_rok = substr($kod, 0,4);
$data_mies = substr($kod, 4,2);
$data_dzien = substr($kod, 6,2);
$data_exp="$data_rok-$data_mies-$data_dzien";
$dlug_kor=$dlug-18;

$shinchang_part_no = substr($kod, 8,$dlug_kor);
$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box_n		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);
$qty_box           = $qty_box_n;        
settype($qty_box, "integer");
settype($qty_box_il, "integer");

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM rej_prod_got WHERE barcode='$kod'";
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

$dlug_part_no = strlen($part_no);

$exp_file="<form method='get' action='kody_zapisz.php'>
           <input type='hidden' name='linia' value=$linia />
           <input type='hidden' name='pojazd' value=$pojazd />
		   <input type='hidden' name='shinchang_part_no' value=$shinchang_part_no />
           <input type='hidden' name='part_no' value=$part_no />
           <input type='hidden' name='part_name' value=$part_name />
           <input type='hidden' name='qty_box' value=$qty_box />
		   <input type='hidden' name='no_boxec' value=$qty_box_il />
           <input type='hidden' name='data_wyd' value=$data_exp />
		   </form>
		   ";

if ($dlug_part_no<3 or $dlug <25) {  $czas = date("G:i"); 
							echo  include "qc.php"; 
							$komunikat = "<center><B>$tekst_1 [$czas]</B><br><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              <br><BR> WRONG LOADED BARCODE OR LACK OF DATA IN THE DATABASE<BR> REGISTER OPERATION AGAIN.</center><hr>";
							echo $komunikat;
							 }
							else {
							
?>

</HEAD>

<BODY>
<?php							
echo " 
 

<div style='margin: 0px;'>
	<TABLE ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
	<TR>
	
	
	<TD  BGCOLOR='#ccffcc'><A HREF='ac.php?kod=0'>PONOWNE WCZYTYWANIE KODU KRESKOWEGO / RELOADING BARCODE<BR><FONT COLOR='4444FF'><B></A></FONT></TD>
		
	</TR>
	</TABLE>
</div>
<br><br>

<font size='4'> <center> WCZYTANY KOD:<b>   $kod   </b></center></font><br>
<FORM ACTION='ac_dodaj.php' METHOD='POST'>
<INPUT TYPE='hidden' NAME='id' VALUE='$id'>
<INPUT TYPE='hidden' NAME='kod' VALUE='$kod'>
<INPUT TYPE='hidden' NAME='no_box' VALUE='$qty_box_il'>
<TABLE class='menu' ALIGN='center' WIDTH='900' CELLSPACING='0' CELLPADDING='0' BORDER='0' >

	<TR>
	<TD> <font size='3'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='2'><B>$data_rok - $data_mies - $data_dzien  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='3'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='2'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='3'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='2'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='3'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='2'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='3'>LINIA PRODUKCYJNA / PRODUCTION LINE: </font>				 			</TD>
	<TD> <font size='2'><B>$linia      </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='3'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='2'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR><font size='2'>
	
	<TD><br>ilosc w pudełku / QTY BOX<br><br></TD>
	<TD colspan='2'><INPUT TYPE='text' NAME='qty_box' VALUE='$qty_box' SIZE='40' NUMER='20' MAXLENGTH='30'></TD></font>
    <br><br></TR>
	<TR>	
	<TD> <font size='3'>NR PUDEŁEKA Z PRODUKTAMI / NO BOXES PRODUCTS: </font>				     	</TD>	
	<TD> <font size='2'>					<B>$qty_box_il	 </font></B>      	</TD>	
	</TR><br><br>
	<TR> <td> </td>
	<TD> </TD></TR>
    <TR> <td></td>
	<TD ALIGN='right'><INPUT TYPE='submit' VALUE='...Zapamiętaj / Save...'></TD></TR>
	
	</TABLE>

     " ;
}
?>
</BODY>
</HTML>
