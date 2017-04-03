<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">

</style>

<script>
//script by Przemyslaw Cios 21:11:2010

function fullwin(targeturl){
window.open(targeturl,"","fullscreen,scrollbars")
}
//-->
</script>


<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kod"].value='';
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',3999);
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
  
        	<TD ALIGN='left'>Nie masz uprawnień do obsługi systemu QualityLinia.<br>
	     	Aby powtórnie się zalogować naciśnij <A HREF='wylogujl.php'>TUTAJ</A><br>
  	        <hr>
			You do not have permission to operate the system QualityLinia.<br>
			To re-log in press <A HREF='wylogujl.php'>HERE</A></TD>
			<TD WIDTH='70'></TD>
        </TR> ";
	}
  }
  else {}
 ?> 
  <br><BR><BR><BR><BR><BR><BR><BR>
 <FORM ACTION="fullwin('logowanie1.php')" METHOD="POST" name="formularz">
<TABLE BORDER='0' ALIGN='center' CELLPADDING='0' BGCOLOR='#ccccff'>
  <TR>
  	<TD COLSPAN='3' ALIGN='center' HEIGHT='70' VALIGN='center'><B>Proszę się zalogować do systemu QualityLinia:
	 <BR> Please log in to the system  QualityLinia:</B></TD>
  </TR>
  <TR>
  	<TD ALIGN='right' WIDTH='100'>Login:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  	<TD ALIGN="center"><INPUT TYPE="text" NAME="luzytkownik" ID="kod" SIZE="19" MAXLENGTH="50" 
	  onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
  	<TD WIDTH='70'></TD>
  </TR>
  <TR>
  	
  	<TD></TD>
 </TR>
 	<TR>
 	<TD COLSPAN='2' ALIGN='right' HEIGHT='40' VALIGN='bottom'><INPUT TYPE='submit' NAME='submit' VALUE='Zaloguj&nbsp;/&nbsp;log in'></TD>
 	<TD></TD>
 </TR>
 </TABLE></FORM>
 
 </BODY>
</HTML>
