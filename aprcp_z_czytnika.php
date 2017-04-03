<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Rejestracja produktów gotowych ze zmiana stanów Przyjęcie towaru</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">

</style>
<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kodp"].value='';
   document.forms['formularz'].elements["kodp"].focus();
  } 
  setInterval('odswiez()',4999);
  // -->
</script>

</HEAD>

<BODY>

	<TABLE class='menu' ALIGN='center' CELLSPACING='0' CELLPADDING='0' BORDER='0'>
	<TR><TD>
	
		<form>
<input type=button value="Close Window" onClick="javascript:window.close();">
</form></TD>
		
	</TR>
	</TABLE>
<?php
session_start();
$uzytkownik=$_SESSION['luzytkownik'];

echo" <font size='2'>Zalogowany Uzytkownik:<b> $uzytkownik  </b><BR><BR>";
?>
<b> PRZYJECIE PRODUKTOW </b></center></font><hr>


 
<FORM ACTION="prz_por_wprowadzanie_kodul.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<TR>
	<TD ALIGN="center" VALIGN="middle" HEIGHT="8"><font size='2'>Wczytaj kod z produktu  </TD>
</TR>
<TR>
	
	<TD ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kodp" ID="kodp" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
	
</TR>

</TABLE>
</FORM>
<?php
echo"$komunikat";
?>
</BODY>
</HTML>
