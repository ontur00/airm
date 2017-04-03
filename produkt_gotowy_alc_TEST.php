<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Rejestracja produktów gotowych</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<script language="JavaScript">
  <!--
  function odswiez() {

   document.forms['formularz'].elements["formalc"].focus();
  } 
  setInterval('odswiez()',1200);
  // -->
</script>
<?php
session_start();

$kodzam=$_SESSION['s_kod_zamw'];
?>
</HEAD>

<BODY>
<div style='margin: 0px;'>
	<TABLE class='menu' ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0'>
	<TR>
	
	<form>
<input type=button value="Close Window" onClick="javascript:window.close();">
</form> </TD>
		
	</TR>
	</TABLE>
  </div>


<center><b><font size='1'> PRZYGOTOWANIE WYSYLKI DO KLIENTA - Skanowanie KOD ALC  KLIENTA</b></center></font><hr>
 
<FORM ACTION="part_no_sprawdz.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<TR>
<?php
echo"	<TD ALIGN='center' VALIGN='middle' HEIGHT='5'><font size='1'>WCZYTAJ KOD ALC<b>do WYSYLKI  $kodzam</b></TD>";
?>
</TR>
<TR>

	<TD  ALIGN="center" VALIGN="middle">
	<INPUT TYPE="text" NAME="formalc" ID="formalc" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'">
	<?php
		echo "
		<input type=\"hidden\" name=\"kod\" value=\"" . $kod . "\">
		<input type=\"hidden\" name=\"licznik\" value=\"" . $licznik . "\">
		";
	?>
	</TD>
</TR>

</TABLE>
</FORM>
<font size='1'>
</BODY>
</HTML>
