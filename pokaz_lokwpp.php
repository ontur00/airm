<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>baza produkty</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">


</HEAD>

<BODY>
<?php
// Created by Przemyslaw Cios //

$stanlok=0;


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

session_start();
$shinchang_part_no=$_SESSION['sshinchang_part_no'];
$kod=$_SESSION['sbarcode'];
$nrpalety=$_SESSION['snrpal'];

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$lokzap2="lok='MG'";
$part_noza2="part_no='$part_no_z'";
$kwerenda12 = "SELECT * FROM prod_got WHERE shinchang_part_no=$shinchang_part_no";
$wynik12 = mysql_query($kwerenda12);
$rekordow12 = mysql_numrows($wynik12);
mysql_close();
$stan_gl						= mysql_result($wynik12, $t, "stan");
$part_namet						= mysql_result($wynik12, $t, "part_name");


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
$lokzap="lok='MG'";
$part_noza="part_no='$part_no_z'";
$kwerenda1 = "SELECT * FROM prod_got_wys WHERE  no_pal='$nrpalety'";
$wynik1 = mysql_query($kwerenda1);
$rekordow1 = mysql_numrows($wynik1);
mysql_close();


echo "
<font size='4'><center><b> WYSYLKA:</B> Referencje na PALECIE ANTOLIN SK</b></center></font><hr>

<TABLE BORDERCOLOR='#000000' CELLSPACING='0' WIDTH='240' BORDER='0' ALIGN='center'>
 <TH><font size='1'>part_no:</font></TH>
 <TH><font size='1'>ilosc</font></TH>
  <TH><font size='1'>nr Palety </font></TH>
  
<TH><font size='1'>nr box </font></TH>
</TR>";

$a = 0;
while ($a < $rekordow1){
$id 						= mysql_result($wynik1, $a, "id");
$lot_no						= mysql_result($wynik1, $a, "Lot_no");
$powod						= mysql_result($wynik1, $a, "powod");
$login						= mysql_result($wynik1, $a, "login");
$lok	 					= mysql_result($wynik1, $a, "lok");
$part_no 					= mysql_result($wynik1, $a, "part_no");
$part_name 					= mysql_result($wynik1, $a, "part_name");
$data	 					= mysql_result($wynik1, $a, "data");
$stan_pop					= mysql_result($wynik1, $a, "stan_pop");
$loksz						= mysql_result($wynik1, $a, "no_pal");
$lok_pal					= mysql_result($wynik1, $a, "lok_pal");
$barcodew					= mysql_result($wynik1, $a, "barcode");

if ($a%2 != 0) {$tlo='#f0f0f0';} else {$tlo='#c0c0c0';}
$qty_box=$stan-$stan_pop;

$dlug = strlen($barcodew);



$qty_box = substr($barcodew, 18,6);
$dl_box = strlen($qty_box);

if ($dl_box>0){$il_box=$il_box+1;}
$no_box = substr($barcodew, 25,5);

settype($qty_box, "integer");
settype($no_box, "integer");

echo "




<TR>

		<TD ALIGN='center' BGCOLOR=$tlo><font size='1'>$part_no</font></TD>

		<TD ALIGN='center' BGCOLOR=$tlo><font size='1'>$qty_box</font></TD>

	
		<TD ALIGN='center' BGCOLOR=$tlo><font size='1'>$loksz</font></TD>
			
<TD ALIGN='center' BGCOLOR=$tlo><font size='1'>$no_box</font></TD>

	  </TR>";
$stanlok=$stanlok+$qty_box;   
$a++;
}

echo"</TABLE><BR>

<HR>
<font size='1'><center>STAN NA PALECIE: <B>$stanlok </b> <br> ILOSC BOX: <B>$il_box</b> </font>
<HR>

<HR></center>
";
?>
<FORM ACTION="zaw_wczytajp.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">

<TR>
	<TD WIDTH="100"></TD>
	<TD COLSPAN="2" ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kod" ID="kod" SIZE="1" MAXLENGTH="1" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
	<TD WIDTH="100"></TD>
</TR>

</TABLE>
</FORM>

</BODY>
</HTML>
