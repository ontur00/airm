<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">


<script>
//script by Przemyslaw Cios 21:11:2010

function fullwin(targeturl){
window.open(targeturl,"","fullscreen,scrollbars")
}
//-->
</script>

<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 49: document.location.href='/barcodem/index.php'; 
	 break;
     case 50: document.location.href='zaw_wczytaj.php'; 
	 break;
     case 51: document.location.href='aprcp_z_czytnikabbrep.php'; 
	 break;
     case 52: document.location.href='aprcp_z_czytnikabbr.php'; 
	 break;
	 case 53: document.location.href='wyczyt_wys.php'; 
	 break;
     case 54: document.location.href='par_nwys.php'; 
	 break;
	 case 55: document.location.href='wcz_lokr_inw.php'; 
	 break;

   }"
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>
</HEAD>

<BODY>
<?php


  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
	echo "<div align='left'><A HREF='wyloguj.php'><font size='2'>Wyloguj użytkownika / logout user&nbsp;:&nbsp;<b> ".$_SESSION['luzytkownik']."</A></b></div></font><BR>";

	?><TABLE ALIGN='left' WIDTH='200' HEIGHT='120' BORDER='0' CELLSPACING='0' CELLPADDING='0' >
	        <TR>
	        <TD BGCOLOR='#ccFFaa' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('/barcodem/index.php')" value="1 .Przyjecie Prod/Zablok" >
            <input type="button" onClick="fullwin('zaw_wczytaj.php')" value="2. ifo -BOX na Lokalizacji">
            </form>
			</TD>
			</tr>
	    <TR>
		
			<TD BGCOLOR='#ccFFFF' ALIGN='center' ><form>
            
            
            <input type="button" onClick="fullwin('aprcp_z_czytnikabbrep.php')" value="3. REPACK...................">
      
            <input type="button" onClick="fullwin('aprcp_z_czytnikabbr.php')" value="4. Przyj Regaly/Palety....">
            </form>
			</TD>
			</TR>
	<TR>
	        <TD BGCOLOR='#ccFFFF' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('wyczyt_wys.php')" value="5. Wydanie Wysylka......">
            <input type="button" onClick="fullwin('par_nwys.php')" value="6. Parowanie wysylka.....">
            <input type="button" onClick="fullwin('wcz_lokr_inw.php')" value="7. INWENTURA REGAL.">
            </form>
			</TD>
			</tr>
					
	</TABLE>

	<?php
	}
	else {
	
	echo "
	<br><BR><BR><BR><BR><BR><BR><BR>
		<TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ffbbbb'>
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
  <TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ccccff'>
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
