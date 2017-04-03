<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Rejestracja produktów gotowych</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
<!--
p				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
th.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: right; empty-cells: show; border-style: none; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; border-style: solid; border-width: 1px; }
td.menu			{  padding: 0px; border-style: none; font-size: 14px;}
td.pozycje		{  padding-right: 2px; padding-left: 2px; text-align: left; border-style: none; }
td.szare		{  text-align: center; background-color: #808080; color: black; width: 15; }
td.naglowek_v	{  text-align: center; background-color: black; color: white; width: 15; }
td.naglowek_h	{  text-align: center; background-color: black; color: white; }
td.roboczy		{  text-align: center; background-color: white; color: black; width: 15; }
td.sobota		{  text-align: center; background-color: #E6FFFF; color: black; width: 15; }
td.niedziela	{  text-align: center; background-color: #FFB0B0; color: black; width: 15; }
td.swieto		{  text-align: center; background-color: red; color: black; width: 15; }
td.rek_urlop	{  text-align: center; background-color: #CDFF9B; color: black; width: 15; }
td.wolne		{  text-align: center; background-color: #FFFF00; color: black; width: 15; }
td.firma		{  font-size: 16px; text-align: center; background-color: #E4EEF1; color: black; height: 26; font-weight: bold;  }
.lewa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: left;  }
.prawa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right;  }

.tabele_glowne	{  border-color: black; border-width: 2px; border-style: solid; border-spacing: 0px; padding: 0px; margin: auto; text-align: left; }
.obramuj		{  border-color: black; border-width: thin; border-style: dashed; font-weight: bold;  }

table.menu		{  font-family: Arial, Helvetica, sans-serif; border-style: none; border-spacing: 0px; padding: 0px; margin: auto;  }
div				{  background-position: center;  z-index:1; border-style: none; text-align: center; }
legend			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;  }
input.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
textarea.szczegoly	{  font-size: 12px; text-align: left; background-color: #E4EEF1; color: red; border-style: none; }
input			{ text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
select			{ text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kod"].value='';
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',1999);
  // -->
</script>

</HEAD>

<BODY>


<FORM ACTION="prz_por_sprawdzanie.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<TR>
	<TD COLSPAN="2" ALIGN="center" VALIGN="middle" HEIGHT="30">Wczytaj kod z etykiety sprzedazowej <b></b>. <br><br> Load <b> code from sales barcode </b>    </TD>
</TR>
<TR>

	<TD COLSPAN="2" ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kod" ID="kod" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>

</TR>
<TR>
	<TD COLSPAN="2" ALIGN="center" VALIGN="middle" HEIGHT="30">.................... SPRAWDZENIE ZGODNOSCI ETYKIET ..................</b></TD>
</TR>
</TABLE>
</FORM>
<hr>
<?php
echo"$komunikat";
?>
</BODY>
</HTML>
