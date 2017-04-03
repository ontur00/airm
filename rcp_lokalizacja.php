<?php
session_start();
$id_operacji	= $_GET['id_operacji'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Wybór lokalizacji</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<style type="text/css">
<!--
p				{  font-family: Arial, Helvetica, sans-serif; font-size: 12px;  }
th				{  font-family: Arial, Helvetica, sans-serif; font-size: 14px; padding-right: 2px; padding-left: 2px;  }
tr.black		{  background-color: black; color: white; }

td				{  font-family: Arial, Helvetica, sans-serif; font-size: 14px; padding-right: 2px; padding-left: 2px; text-align: center; empty-cells: show; }
.lewa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: left;  }
.prawa			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: right;  }
td.zaznacz		{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: center; background-color: red; color: black;  }
td.odznacz		{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-right: 2px; padding-left: 2px; text-align: center; background-color: black; color: red;  }

.tabele_glowne	{  border-color: black; border-width: 2px; border-style: solid; border-spacing: 1px; padding: 0px; margin: auto;  }
.obramuj		{  border-color: black; border-width: thin; border-style: dashed; }

div.pozycje		{  width: 300px; background-position: center; position: absolute; z-index:1; border-style: hidden; }
legend			{  font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;  }

input.data		{ text-align: center; font-size: 12px; color: green; }
select			{ text-align: left; font-size: 12px; color: green; width: 130px; }
textarea.data	{ text-align: justify; font-size: 12px; color: green; }

-->
</style>

<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key)
   {
   		case 48: document.location.href='rcp_pole_odkladcze.php?id_operacji=$id_operacji&wybor=48'; break;
   		case 49: document.location.href='rcp_pole_odkladcze.php?id_operacji=$id_operacji&wybor=49'; break;
   		case 50: document.location.href='rcp_pole_odkladcze.php?id_operacji=$id_operacji&wybor=50'; break;
   		case 51: document.location.href='rcp_pole_odkladcze.php?id_operacji=$id_operacji&wybor=51'; break;
		case 52: document.location.href='rcp_pole_odkladcze.php?id_operacji=$id_operacji&wybor=52'; break;
		default: alert('Naciśnij ENTER, a następnie\\njedną z cyfr od 0 do 4 aby wybrać pole odkładcze.');
   }";
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>

</HEAD>

<BODY>
<TABLE WIDTH="300" HEIGHT="200" BORDER="0" ALIGN="center">
<TR BGCOLOR='#C0C0C0'>
	<TH colspan='2'>Proszę nacisnąć cyfrę oznaczającą numer pola odkładczego.<br>Jeżeli nie znasz numeru naciśnij zero.</TH>
</TR>
<TR BGCOLOR="#FFCC99">
	<TD>0</TD>
	<TD>Pole odkładcze nieznane</TD>
</TR>
<TR BGCOLOR="#CCFFFF">
	<TD>1</TD>
	<TD>Pierwsze pole odkładcze</TD>
</TR>
<TR BGCOLOR="#CCFFFF">
	<TD>2</TD>
	<TD>Drugie pole odkładcze</TD>
</TR>
<TR BGCOLOR="#CCFFFF">
	<TD>3</TD>
	<TD>Trzecie pole odkładcze</TD>
</TR>
<TR BGCOLOR="#CCFFFF">
	<TD>4</TD>
	<TD>Czwarte pole odkładcze</TD>
</TR>
</TABLE>


</BODY>
</HTML>
