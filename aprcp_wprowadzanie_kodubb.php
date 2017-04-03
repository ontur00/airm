

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";


$kod 	= $_POST['kod'];
 session_start();
$_SESSION['sbarcode']=$kod;
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);


$dlug = strlen($kod);
$data_rok = substr($kod, 0,4);
$data_mies = substr($kod, 4,2);
$data_dzien = substr($kod, 6,2);
$data_exp="$data_rok-$data_mies-$data_dzien";
$dlug_kor=$dlug-18;

$shinchang_part_no = substr($kod, 8,$dlug_kor);



$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';
$lok_baza="";

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_st WHERE barcode='$kod'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $barcod	 			= mysql_result($wynik5, $t, "barcode");	
 $lok_baza	 			= mysql_result($wynik5, $t, "lok");						
 $lot_no_baza	 		= mysql_result($wynik5, $t, "lot_no");
 
if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }	              
 elseif($lok_baza==="MG"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST JUZ NA REGALE /PAPECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="MW"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST PRZYGOTOWANE DO WYSYLKI<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
  elseif ($lok_baza==="WZ"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO ZOSTALO WYSLANE DO KLIENTA LUB BLEDNY KOD<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							
  elseif ($lok_baza==="MP"){ 
                                     mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5lok = "SELECT * FROM prod_st WHERE shinchang_part_no='$shinchang_part_no' and lok='MG' ORDER BY lot_no DESC";
									 $wynik5lok = mysql_query($kwerenda5lok);
 									$rekordow5lok = mysql_numrows($wynik5lok);
 									mysql_close();
 									$part_no_bazae1	 			= mysql_result($wynik5lok, $g, "part_no");	
 									$lok_sc_bazae1	 			= mysql_result($wynik5lok, $g, "lok_sc");
									$lok_pal_bazae1	 			= mysql_result($wynik5lok, $g, "lok_pal");						
 									
									 
									 mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5reg = "SELECT * FROM prod_regal WHERE nr_reg='$lok_sc_bazae1'";
									 $wynik5reg = mysql_query($kwerenda5reg);
 									$rekordow5reg = mysql_numrows($wynik5reg);
 									mysql_close();
 									$max_il_bazae1	 			= mysql_result($wynik5reg, $h, "max_il");	
 									$ilosc_bazae1	 			= mysql_result($wynik5reg, $h, "ilosc");
									$il_pal_bazae1	 			= mysql_result($wynik5reg, $h, "il_pal");			
									$rilosc_bazae1=	$ilosc_bazae1+1;
									 $dlug_part_no_bazae1 = strlen($part_no_bazae1);
                                     if($dlug_part_no_bazae1<1){   		    mysql_connect('localhost',$uzytkownik,$haslo);
									 										mysql_query('SET CHARSET latin2');
 																			@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																			$kwerenda5reg2 = "SELECT * FROM prod_regal WHERE max_il>ilosc and typ='B' LIMIT 1";
									 										$wynik5reg2 = mysql_query($kwerenda5reg2);
 																			$rekordow5reg2 = mysql_numrows($wynik5reg2);
 																			mysql_close();
 																			$nr_reg_bazae2	 			= mysql_result($wynik5reg2, $i, "nr_reg");	
 																			$ilosc_bazae2	 			= mysql_result($wynik5reg2, $i, "ilosc");
																			$il_pal_bazae2	 			= mysql_result($wynik5reg2, $i, "il_pal");
																			 session_start();
																			$_SESSION['snrreg']=$nr_reg_bazae2;
																			$_SESSION['snrregpal']=$lok_pal_bazae1;
																			 echo include "zatw_lok.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>Zarejestruj pudelko<b> $part_no</b> na lokalizacje <br><b><font size='5'>$nr_reg_bazae2</center></b><hr>";
																	echo $komunikat;
																	}
									elseif ($rilosc_bazae1>$max_il_bazae1){
									 										mysql_connect('localhost',$uzytkownik,$haslo);
									 										mysql_query('SET CHARSET latin2');
 																			@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																			$kwerenda5reg2 = "SELECT * FROM prod_regal WHERE max_il>ilosc and typ='B' LIMIT 1";
									 										$wynik5reg2 = mysql_query($kwerenda5reg2);
 																			$rekordow5reg2 = mysql_numrows($wynik5reg2);
 																			mysql_close();
 																			$nr_reg_bazae2	 			= mysql_result($wynik5reg2, $i, "nr_reg");	
 																			$ilosc_bazae2	 			= mysql_result($wynik5reg2, $i, "ilosc");
																			$il_pal_bazae2	 			= mysql_result($wynik5reg2, $i, "il_pal");
																		    session_start();
																			$_SESSION['snrreg']=$nr_reg_bazae2;
																			$_SESSION['snrregpal']=$lok_pal_bazae1;	
																			 echo include "zatw_lok.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>Zarejestruj pudelko<b> $part_no</b> na lokalizacje <br><b><font size='5'>$nr_reg_bazae2 </font><font size='1'> NR REG PAL: <font size='5'>$lok_pal_bazae1</center></b><hr>";
																	echo $komunikat;}
																	          
															
											else{
																				
											
											echo $nr_reg_bazae2=$lok_sc_bazae1;
																session_start();
																$_SESSION['snrreg']=$nr_reg_bazae2;
																$_SESSION['snrregpal']=$lok_pal_bazae1;
																include "zatw_lok.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>Zarejestruj pudelko<b> $part_no</b> na lokalizacje <br><b><font size='5'>$nr_reg_bazae2</font><font size='1'> NR REG PAL: <font size='5'>$lok_pal_bazae1</center></b><hr>";
																	echo $komunikat;
												}
						               

																			
																			
																			
																			
																			
                                   
  }
  
  
  
  
  						

 else {  echo "<font size='0'>"; echo include "aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							
							


