<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<link rel="stylesheet" type="text/css" href="default.css" />
<script>
//script by Przemyslaw Cios 21:11:2010

function fullwin(targeturl){
window.open(targeturl,"","fullscreen,scrollbars")
}
//-->
</script>


</HEAD>

<BODY>
<?php
$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
$sp="&nbsp;&nbsp";
$spp="&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp";
$sppp="&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp";

  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
	echo "<div align='right'><A HREF='wyloguj.php'>Wyloguj użytkownika / logout user&nbsp;:&nbsp;<b> ".$_SESSION['luzytkownik']."</A></b></div>";
	echo "	
	<br><br>
	<center><IMG SRC='/img/barcode.gif' WIDTH='682' HEIGHT='120' BORDER='0'></center>
    <br><br>
	";
	?><TABLE ALIGN='center' WIDTH='682' HEIGHT='120' BORDER='0' CELLSPACING='0' CELLPADDING='0' >
		<TR>
			<TD><br><br></TD><th>
		<TR>
			<TD><br><br></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center' ><form>
<input type="button" onClick="fullwin('rcp_z_czytnika.php')" value="Czytanie kodów z produtu / Reading the product code  ">
</form></TD>
			
		</TR>
		
		<TR>
			<TD><br></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center' ><form>
<input type="button" onClick="fullwin('rcp_z_czytnikab.php')" value="Czytanie kodów z etykiety pudełka / Reading the  Box BarCode  ">
</form></TD>
			
		</TR>
		
		<TR>
			<TD></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center'>
			<form>
<input type="button" onClick="fullwin('por_prod.php')" value="Porownanie etykiet / Compare Barcode ">
</form>
			
			
		</TD>
			<TD></TD>
		</TR>
			<TR>
			<TD></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center'>
			<form>
<input type="button" onClick="fullwin('aczytnik_pokaz.php')" value="Stany Magazyny Sprzedaz / Stockroom ">
</form>
			
			
		</TD>
			<TD></TD>
		</TR>
	
			<TR>
			<TD></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center'>
			<form>
<input type="button" onClick="fullwin('air_blady_drukuj.php')" value="KODY BLEDOW DRUKUJ  / ERROR CODE PRINT ">
</form>
			
			
		</TD>
	</TABLE>
	";
	<?php
	}
	else {
	
	echo "
	<br><BR><BR><BR><BR><BR><BR><BR>
		<TABLE BORDER='0' ALIGN='center' CELLPADDING='0' BGCOLOR='#ffbbbb'>
		<TR>
  
        	<TD ALIGN='left'>Nie masz uprawnień do obsługi systemu Barcode.<br>
	     	Aby powtórnie się zalogować naciśnij <A HREF='wyloguj.php'>TUTAJ</A><br>
  	        <hr>
			You do not have permission to operate the system Barcode.<br>
			To re-log in press <A HREF='wyloguj.php'>HERE</A></TD>
			<TD WIDTH='70'></TD>
        </TR> ";
	}
  }
  else {
  echo "<FORM ACTION='logowanie.php' METHOD='POST'>
  
  
  <br><BR><BR><BR><BR><BR><BR><BR>
  <TABLE BORDER='0' ALIGN='center' CELLPADDING='0' BGCOLOR='#ccccff'>
  <TR>
  	<TD COLSPAN='3' ALIGN='center' HEIGHT='70' VALIGN='center'><B>Proszę się zalogować do systemu air:
	 <BR> Please log in to the system  air:</B></TD>
  </TR>
  <TR>
  	<TD ALIGN='right' WIDTH='100'>Login:&nbsp;</TD>
  	<TD ALIGN='left'><INPUT TYPE='text' NAME='luzytkownik' SIZE='20'></TD>
  	<TD WIDTH='70'></TD>
  </TR>
  <TR>
  	<TD ALIGN='right'>Hasło/password:&nbsp;</TD>
  	<TD ALIGN='left'><INPUT TYPE='password' NAME='lhaslo' SIZE='20'></TD>
  	<TD></TD>
 </TR>
 	<TR>
 	<TD COLSPAN='2' ALIGN='right' HEIGHT='40' VALIGN='bottom'><INPUT TYPE='submit' NAME='submit' VALUE='Zaloguj&nbsp;/&nbsp;log in'></TD>
 	<TD></TD>
 </TR>
 </TABLE></FORM>";
 }
?>

</BODY>
</HTML>
