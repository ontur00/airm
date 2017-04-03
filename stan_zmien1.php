<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Formularz aktualizacyjny</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
<META http-equiv="Content-Type" content="text/html; charset=ISO-1250
">
<STYLE type="text/css">
a:link {color: rgb(255,0,0);
     background-color: transparent;
     font-weight: bold;
     font-style: normal;
     text-decoration: none}

a:visited {color: rgb(0,0,0);
     background-color: transparent;
     font-weight: normal;
     font-style: normal;
     text-decoration: none}

a:hover, a:active {color: rgb(0,255,0);
     background-color: transparent;
     font-weight: normal;
     font-style: normal;
     text-decoration: none}
</STYLE>

</style>
<script language="JavaScript">
  <!--
  function odswiez() {
   document.forms['formularz'].elements["kod"].value='';
   document.forms['formularz'].elements["kod"].focus();
  } 
  setInterval('odswiez()',1999);
  // -->
</script>
</HEAD>

<BODY>


<?php

$id 						= $_GET['id'];
$nr_etyk					= $_GET['nr_etyk'];
$pojazd 					= $_GET['pojazd'];
$part_no 					= $_GET['part_no'];
$shinchang_part_no 			= $_GET['shinchang_part_no'];
$part_name 					= $_GET['part_name'];
$qty_box 					= $_GET['qty_box'];
$data	 					= $_GET['data'];
$stan 						= $_GET['stan'];
$stanz						= $_GET['stanz'];


echo "
<font size='4'><center><b> RECZNA ZMIANA STANU PRODUKÓW MAGAZYNU / MANUAL PRODUCED CHANGE IN STORAGE</b></center></font><hr>
<TABLE class='menu' ALIGN='center' WIDTH='900' CELLSPACING='0' CELLPADDING='0' BORDER='0' >

		<TR>
	<TD> <font size='3'>DATA WYDANIA / DATE OF ISSUE:		 </font>					</TD>
	<TD> <font size='4'><B>$data  </font></B></TD>
	</TR>
	<TR>	
	<TD> <font size='3'>NR PRODUKTU SHINCHANG / SHINCHANG PART NO: </font>				     	</TD>	
	<TD> <font size='4'>		<B>$shinchang_part_no </font></B>      	</TD>	
	</TR>

	<TR>
	<TD> <font size='3'>NR PRODUKTU / PART NO:     </font>         		            	</TD>
	<TD> <font size='4'><B>$part_no  </font></B>         			        </TD>
	</TR>
	<TR>
	<TD> <font size='3'>NAZWA PRODUKTU / PART NAME :   </font>				    			</TD>
	<TD> <font size='4'><B>$part_name  </font></B>     					</TD>
	</TR>
	<TR>
	<TD> <font size='3'>NR NA PRODUKCIE / PRODUCT NO : </font>				 			</TD>
	<TD> <font size='4'><B>$nr_etyk     </font></B> 						</TD>
	</TR>
	<TR>
	<TD> <font size='3'>POJAZD / VEHICLE: 	 </font>          						</TD>
	<TD> <font size='4'><B>$pojazd  </font></B>           					</TD>
	</TR>
	<TR>
	
	<TD><br><font size='4'color='green'>OBECNY STAN MAGAZYNOWY / STOCK NOW<br><br></TD></font>
	<TD colspan='2'><font size='5'color='green'><B>$stan</B></TD></font>
    <br><br></TR>
	<TR>
	
	<TD><br><font size='4' color='red'>ZMIANA STANU MAGAZYNOWEGO O ILOSÆ / STOCK CHANGE QUANTITY<br><br></TD>
	<TD colspan='2'><font size='4' color='red'>$stanz </TD></font>
    <br><br></TR>
	<TR>	
	<TD> <font size='3'>ILOSC BOX / QTY BOX: </font>				     	</TD>	
	<TD> <font size='4'>					<B>$qty_box	 </font></B>      	</TD>	

	
	</TR>
	
	</TABLE>
	
	$blad
"; 

?>
 
 
<FORM ACTION="stan_zmien_p.php" METHOD="POST" name="formularz">
<TABLE BORDER="0" ALIGN="center" BGCOLOR="#CCFFFF" CELLSPACING="0" CELLPADDING="0">
<?php
 echo"<INPUT TYPE='hidden' NAME='id' VALUE='$id'>
    <INPUT TYPE='hidden' NAME='data' VALUE='$data'>
    <INPUT TYPE='hidden' NAME='shinchang_part_no' VALUE='$shinchang_part_no'>
    <INPUT TYPE='hidden' NAME='part_no' VALUE='$part_no'>
    <INPUT TYPE='hidden' NAME='part_name' VALUE='$part_name'>
    <INPUT TYPE='hidden' NAME='nr_etyk' VALUE='$nr_etyk'>
    <INPUT TYPE='hidden' NAME='pojazd' VALUE='$pojazd'>
    <INPUT TYPE='hidden' NAME='stanz' VALUE='$stanz'>
    <INPUT TYPE='hidden' NAME='stan' VALUE='$stan'>
    <INPUT TYPE='hidden' NAME='qty_box' VALUE='$qty_box'>
";?>
<TR>
	<TD COLSPAN="4" ALIGN="center" VALIGN="middle" HEIGHT="50">Wczytaj powód zmiany liczby sztuk produktow </b>    </TD>
</TR>

<TR>
	<TD WIDTH="100"></TD>
	<TD COLSPAN="2" ALIGN="center" VALIGN="middle"><INPUT TYPE="text" NAME="kod" ID="kod" SIZE="30" MAXLENGTH="50" onFocus="this.style.backgroundColor='#00FF00'" onBlur="this.style.backgroundColor='#FF0000'"></TD>
	<TD WIDTH="100"></TD>
</TR>
<TR>
	<TD COLSPAN="4" ALIGN="center" VALIGN="middle" HEIGHT="50">Load a reason to change the number of items</b></TD>
</TR>
</TABLE>
</FORM>
<hr>

</BODY>
</HTML>
