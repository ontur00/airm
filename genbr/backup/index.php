<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<link rel="stylesheet" type="text/css" href="default.css" />
<link rel="stylesheet" type="text/css" href="image.css" />
</HEAD>

<BODY>
<?php
  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
	echo "<div align='right'><A HREF='wyloguj.php'>Wyloguj użytkownika / logout user&nbsp;:&nbsp;<b> ".$_SESSION['luzytkownik']."</A></b></div>";
	echo "	
	<br><br><br><br>
 <div id='main'>
  <div id='lcol'>
   <div id='menu'>
	<ul>
	<TABLE ALIGN='center'>
	<TR>
		<TH COLSPAN='10'><IMG SRC='/img/barcode.gif' WIDTH='882' HEIGHT='170' BORDER='0'></TH>

<td><br><br></td>
	</TR>
	<TR>
			<TD><br></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center'><A HREF='rcp_z_czytnika.php' TARGET='_self'><B>Czytanie kodów linia /Reading the code line</B></A></TD>
			<TD></TD>
		</TR>
		<TR>
			<TD><br></TD>
			<TD BGCOLOR='#eeFFff' ALIGN='center'><A HREF='kody_pokaz.php' TARGET='_self'><B>Drukowanie kodów linia / Printing the code line</B></A></TD>
			<TD></TD>
		</TR>
		<TR>
			<TD><br></TD>
			<TD BGCOLOR='#ccFFcc' ALIGN='center'><A HREF='czytnik_pokaz.php' TARGET='_self'><B>Przegladanie bazy / Reading data base</B></A></TD>
			<TD></TD>
		</TR>
		<TR>
			<TD><br></TD>
			<TD BGCOLOR='#CCFFFF' ALIGN='center'><A HREF='import.php' TARGET='_self'><B>Moduł Import / Import Module</B></A></TD>
			<TD></TD>
		</TR>
			<TR>
			<TD><br></TD>
			<TD BGCOLOR='#eeFFff' ALIGN='center'><A HREF='raport.php' TARGET='_self'><B>Moduł Raporty / Raports Module</B></A></TD>
			<TD></TD>
		</TR>
		
	
	<TR>
		
		
		<TD></TD>
	</TR>
	</TABLE>
	</ul>
  </div>
 </div>
</div>";
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
  	<TD COLSPAN='3' ALIGN='center' HEIGHT='70' VALIGN='center'><B>Proszę się zalogować do systemu BARCODE:
	 <BR> Please log in to the system  BARCODE:</B></TD>
  </TR>
  <TR>
  	<TD ALIGN='right' WIDTH='100'>Login:&nbsp;</TD>
  	<TD ALIGN='left'><INPUT TYPE='text' NAME='luzytkownik' SIZE='20'></TD>
  	<TD WIDTH='70'></TD>
  </TR>
  <TR>
  	<TD ALIGN='right'>Hasło/passwort:&nbsp;</TD>
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
