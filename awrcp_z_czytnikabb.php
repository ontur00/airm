<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Rejestracja produktów gotowych</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<script language="JavaScript">
  <!--
  function odswiez() {
  
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',1200);
  // -->
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


<center><b><font size='1'> WYDANIE PRODUKTOW PO NR BOX</b></center></font><hr>
 
<FORM ACTION="awrcp_wprowadzanie_kodubb.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<TR>
	<TD ALIGN="center" VALIGN="middle" HEIGHT="5"><font size='1'>Wczytaj kod <b>z ETYKIETY PUDELKA </b></TD>
</TR>
<TR>

	<TD  ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kod" ID="kod" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>

</TR>

</TABLE>
</FORM>
<font size='1'>
</BODY>
</HTML>
