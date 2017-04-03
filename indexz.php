<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">

</style>
<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kod"].value='';
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',6999);
  // -->
</script>

</HEAD>
<BODY>
<?php
include wyloguj.php;

$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
$sp="&nbsp;&nbsp";
$spp="&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp";
$sppp="&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp";

  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
include rcp_z_czytnika.php;
	}
	else {
	
	echo "
	<br><BR><BR><BR><BR><BR><BR><BR>
		<TABLE BORDER='0' ALIGN='center' CELLPADDING='0' BGCOLOR='#ffbbbb'>
		<TR>
  
        	<TD ALIGN='left'>Nie masz uprawnień do obsługi systemu AIR.<br>
	     	Aby powtórnie się zalogować naciśnij <A HREF='wylogujl.php'>TUTAJ</A><br>
  	        <hr>
			You do not have permission to operate the system AIR.<br>
			To re-log in press <A HREF='wylogujl.php'>HERE</A></TD>
			<TD WIDTH='70'></TD>
        </TR> ";
	}
  }
  else {}
 ?> 
  <br><BR>
 <FORM ACTION="logowaniel.php" METHOD="POST" name="formularz">
<TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ccccff'>
  <TR>
  	<TD COLSPAN='3' ALIGN='center' HEIGHT='20' VALIGN='center'><B>AIR SYSTEM:</B></TD>
  </TR>
  <TR>
  	
  		<TD WIDTH='20'><FONT COLOR='#ccccff'>.</font></TD>
 </TR>
  <TR>
  	<TD ALIGN='right' WIDTH='30'> Login:</TD>
  	<TD ALIGN="center"> <INPUT TYPE="text" NAME="luzytkownik" ID="kod" SIZE="19" MAXLENGTH="30" 
	  onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
  	<TD WIDTH='20'></TD>
  </TR>
 
   <TR>
  	
  		<TD WIDTH='20'><FONT COLOR='#ccccff'>.</font></TD>
 </TR>
  <TR>
  	
  		<TD WIDTH='20'><FONT COLOR='#ccccff'>.</font></TD>
 </TR>
 
 	<TR>
 	<TD COLSPAN='2' ALIGN='center' HEIGHT='5' VALIGN='bottom'>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE='submit' NAME='submit' VALUE='Zaloguj&nbsp;/&nbsp;log in'></TD>
 	
 </TR>
 <TR>
  	
  		<TD WIDTH='20'><FONT COLOR='#ccccff'>.</font></TD>
 </TR>
 
 </TABLE></FORM>
 
 </BODY>
</HTML>
