<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Generowanie  kodu indentyfikacji dla oparatorow / Generate code for the operators to identify </TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">

p				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: thin; }
th.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: right; empty-cells: show; border-style: none; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
td.menu			{  padding: 0px; border-style: none; font-size: 14px;}
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

</style>

</HEAD>

<BODY>
<?php
$usr 		= $_GET['usr'];
$imie 		= $_GET['imie'];
$nazwisko 	= $_GET['nazwisko'];
$nr_kont 	= $_GET['nr_kont'];
$nr_kontr_baza="";
$dl_usr=strlen($usr);
$usr1       = str_replace("¹", "a", $usr);
$usr2       = str_replace("A", "A", $usr1);
$usr3		= str_replace("ê", "e", $usr2);
$usr4		= str_replace("Ê", "E", $usr3);
$usr5		= str_replace("³", "l", $usr4);
$usr6		= str_replace("£", "L", $usr5);
$usr7		= str_replace("æ", "c", $usr6);
$usr8		= str_replace("Æ", "C", $usr7);
$usr9		= str_replace("ó", "o", $usr8);
$usr10		= str_replace("Ó", "O", $usr9);
$usr11		= str_replace("œ", "s", $usr10);
$usr12		= str_replace("Œ", "S", $usr11);
$usr13		= str_replace("¿", "z", $usr12);
$usr14		= str_replace("¯", "Z", $usr13);
$usr15		= str_replace("Ÿ", "z", $usr14);
$usr16		= str_replace("", "Z", $usr15);
$usr17		= str_replace("ñ", "n", $usr16);
$usr18		= str_replace("Ñ", "N", $usr17);

 $baza			= 'shinchang';
 $uzytkownik	= 'robak';
 $haslo			= 'robak1';

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
 
 $kwerenda = "SELECT * FROM uzytkownicy WHERE nr_kontrolny='$nr_kont'";
 $wynik=mysql_query($kwerenda);
 $rekordow = mysql_numrows($wynik);
 mysql_close();
 $nr_kontr_baza 	= mysql_result($wynik, $a, "nr_kontrolny"); 
 $login_b 	        = mysql_result($wynik, $a, "login");
 $dl_login=strlen($login_b);
 
                 
 if ($dl_usr = $dl_login) {  echo "	<center>
								 <TABLE class='menu' ALIGN='center' WIDTH='320' HEIGHT='180' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
								<TR>
								<TD> <font size='3'><B>$imie $nazwisko  </font></B><br></TD>
								</TR>
								<TR>
								<TD> <IMG SRC='code39.php?kod=$usr18'WIDTH='200' HEIGHT='70'><br></TD>
								</TR>
								 </table>
								 </center>";
 								 	 }
							else {
							     mysql_connect('localhost',$uzytkownik,$haslo);
                                 mysql_query('SET CHARSET latin2');
                                 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                 $kwerenda = "INSERT INTO uzytkownicy(nr_kontrolny,login,haslo,prawa)
                             				VALUES ('$nr_kont','$usr18','','tbo')";
                                 $wynik=mysql_query($kwerenda);
                                 $rekordow = mysql_numrows($wynik);
								 mysql_close();
								 echo "
								 <center>
								 <TABLE class='menu' ALIGN='center' WIDTH='320' HEIGHT='180' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
								<TR>
								<TD> <font size='3'><B>$imie $nazwisko  </font></B><br></TD>
								</TR>
								<TR>
								<TD> <IMG SRC='code39.php?kod=$usr18'WIDTH='200' HEIGHT='70'><br></TD>
								</TR>
								 </table>
								 </center>";
								}
								
								
?>

</BODY>
</HTML>
