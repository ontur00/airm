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

if ($dlug>5) {  $czas = date("G:i"); 
                                $komunikat = "<center><B>$tekst_1 [$czas]</B><br>
								<FONT COLOR='#FF0000'>	Wprowadzono nieprawidłowy kod 
							              <br>
										  
										  ";
						
							include"rcp_z_czytnika.php";
						}
							else {

$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE nr_etyk='$kod'";
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


							
?>
<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 32: document.location.href='rcp_z_czytnika.php'; 
	 break;
     default: alert('Naciśnij SPACJE');
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
echo " 
 

<br><br>

<font size='4'> <center> WCZYTANY KOD:<b>   $kod   </b></center></font><br>

<TABLE class='menu' ALIGN='center' WIDTH='600' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
<TR>
	<TD> <font size='4'>KLIENT / SALES:		 </font>					</TD>
	<TD> <font size='5'><B>$klient  </font></B></TD>
	</TR>
	<TR>
	<TD> <font size='4'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='5'><B>$data  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='4'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='5'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='4'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='5'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='4'>NAZWA PRODUKTU / PART NAME:   </font>				    			</TD>
	<TD> <font size='5'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='4'>LINIA PRODUKCYJNA / PRODUCTION LINE: </font>				 			</TD>
	<TD> <font size='5'><B>$linia      </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='4'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='5'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	<TD> <font size='4'>ILOSC W PUDELKU / Quantity EA: </font>					</TD>
	<TD> <font size='5'><B>$qty_box </font></B>							</TD>
	</TR>
	<TR>	
	<TD> <font size='4'>Nr z etykietki prod: </font>				     	</TD>	
	<TD> <font size='5'>					<B>$kod	 </font></B>      	</TD>	
	</TR>
	</TABLE>

     " ;
}
?>
</BODY>
</HTML>
