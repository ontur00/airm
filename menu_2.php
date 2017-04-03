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
     case 49: document.location.href='par_wys_antolinsk.php'; 
	 break;
     case 50: document.location.href='par_palet_antolinsk.php'; 
	 break;
     case 51: document.location.href='przy_pal_antolinsk.php'; 
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
<div style='margin: 0px;'>
	<TABLE class='menu' ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0'>
	<TR>
	
	<form>
<input type=button value="Close Window" onClick="javascript:window.close();">
</form> </TD>
		
	</TR>
	</TABLE>
  </div>
<?php


  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
	echo "
	<div align='left'><font size='2'>Wysyłka nr :<b>$kodzam </b><br> Klient: <b><font color='#2222dd'> $klient_zam</b></font></div><BR>";

	?><TABLE ALIGN='left' WIDTH='200' HEIGHT='120' BORDER='0' CELLSPACING='0' CELLPADDING='0' >
	        <TR>
	        <TD BGCOLOR='#ccFFaa' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('par_wys_antolinsk.php')" value="1 .Parowanie etykiet ..........." >
            
            </form>
			</TD>
			</tr>
	    <TR>
		
			<TD BGCOLOR='#ccFFFF' ALIGN='center' ><form>     
            <input type="button" onClick="fullwin('par_palet_antolinsk.php')" value="2. Parowanie palet ..............">
            </form>
			</TD>
			</TR>
	<TR>
	        <TD BGCOLOR='#ccFFFF' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('przy_pal_antolinsk.php')" value="3. Przypisanie box do paleta">
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
