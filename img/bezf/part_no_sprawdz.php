
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$kodzam=$_SESSION['s_kod_zamw'];
$dluglogin = strlen($login);


$kod 	= $_POST['kod'];
if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else {																	
																
      $dlug = strlen($kod);
      $data_rok = substr($kod, 0,4);
      $data_mies = substr($kod, 4,2);
      $data_dzien = substr($kod, 6,2);
      $data_exp="$data_rok-$data_mies-$data_dzien";
      $lot_no_baza=substr($kod, 0,8);
      $lot_no_z_k=substr($kod, 0,8);
	  $dlug_kor=$dlug-18;

      $shinchang_part_no = substr($kod, 8,$dlug_kor);



      $qty_box_st        = $dlug-9;
      $qty_box_end       = $dlug-4;
      $qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
      $qty_box		     = substr($qty_box_rob ,0,5);
      $qty_box_il		 = substr(str_replace("O", "", $qty_box_rob) ,5,5);
      
      if($dlug<27){$qty_box		   = substr($kod ,10,4);}
		settype($qty_box, "integer");

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';





	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
     $dlug_qty_box_pr = strlen($qty_box_pr);
   

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjtd = "SELECT * FROM prod_got_wys WHERE barcode='$kod' and pojazd='$kodzam'";
	   $wynik5reglkjtd = mysql_query($kwerenda5reglkjtd);
 	$rekordow5reglkjtd = mysql_numrows($wynik5reglkjtd);
 	mysql_close();
 	$scpr_pr	 			= mysql_result($wynik5reglkjtd, 0, "shinchang_part_no");
 	
     $dlug_scpr_pr = strlen($scpr_pr);

mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjtds = "SELECT * FROM zamowienia WHERE  nr_zam='$kodzam'";
	   $wynik5reglkjtds = mysql_query($kwerenda5reglkjtds);
 	$rekordow5reglkjtds = mysql_numrows($wynik5reglkjtds);
 	mysql_close();
 	$klientwm1	 			= mysql_result($wynik5reglkjtds, 0, "klient");
    $dlug_klientwm1 = strlen($klientwm1);
	$lok_br='';
										
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkj = "SELECT * FROM prod_st WHERE barcode='$kod'";
	   $wynik5reglkj = mysql_query($kwerenda5reglkj);
 	$rekordow5reglkj = mysql_numrows($wynik5reglkj);
 	mysql_close();
 	$lok_pal_na_reg	 			= mysql_result($wynik5reglkj, 0, "lok_sc");
	$lok_pal_b					= mysql_result($wynik5reglkj, 0, "lok_pal");
	$nr_wys_br					= mysql_result($wynik5reglkj, 0, "nr_wys");
	$lok_br					    = mysql_result($wynik5reglkj, 0, "lok");
	$part_name_br					    = mysql_result($wynik5reglkj, 0, "part_name");
    $dlugpart_name_br = strlen($part_name_br);
    /*
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    $kwerenda1d3fi = "SELECT * FROM prod_fifo WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no' and  nr_zlec='$kodzam' and status='P' ORDER BY lot_no LIMIT 1";
	$wynik1d3fi = mysql_query($kwerenda1d3fi);
	$rekordow1d3fi = mysql_numrows($wynik1d3fi);
	mysql_close();
	$prtu					= mysql_result($wynik1d3fi, 0, "part_no");
	$dlugprtu = strlen($prtu);	
	*/
	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    $kwerenda1d3fi = "SELECT * FROM prod_fifo WHERE  part_no='$shinchang_part_no' and  nr_zlec='$kodzam' and status='P' ORDER BY lot_no LIMIT 1";
	$wynik1d3fi = mysql_query($kwerenda1d3fi);
	$rekordow1d3fi = mysql_numrows($wynik1d3fi);
	mysql_close();
	$prtu					= mysql_result($wynik1d3fi, 0, "part_no");
	$P_lot_no					= mysql_result($wynik1d3fi, 0, "lot_no");
	$dlugprtu = strlen($prtu);	
																
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM zamowienia_zaw WHERE nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $id_zaw	 			= mysql_result($wynik5, 0, "id");
 $nr_zam	 			= mysql_result($wynik5, 0, "nr_zam");
 $klient	 			= mysql_result($wynik5, 0, "klient");
 $part_no	 			= mysql_result($wynik5, 0, "part_no");
 $part_name 			= mysql_result($wynik5, 0, "part_name");
 $qty_przyg	 			= mysql_result($wynik5, 0, "qty_box");
 $qty_zam	 			= mysql_result($wynik5, 0, "qty_zam");
 $lot_no	 			= mysql_result($wynik5, 0, "data");						

  mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerendalv = "SELECT * FROM prod_kody WHERE code='$kodzam'";
 $wyniklv = mysql_query($kwerendalv);
 $rekordowlv = mysql_numrows($wyniklv);
 mysql_close();
 $nr_code	 			= mysql_result($wyniklv, 0, "code");						
 $nr_opis	 			= mysql_result($wyniklv, 0, "opis");
 $dl_nr_code= strlen($nr_code); 
 
 if($dl_nr_code>1){$qty_przyg=$qty_box;$qty_zam=$qty_box+$qty_box;$qty_box_pr=$qty_box;}
  session_start();
  $_SESSION['sbarcodew']=$kod;
  $dlug_part_no = strlen($part_no);
  $qty_boxmin=$qty_box_pr-1;
  $qty_przygr=$qty_przyg+$qty_box;
  $qty_zammin=$qty_zam+$qty_boxmin;
  $qty_box1=$qty_box+12;
  $qty_box_pr1=$qty_box_pr+18;
 if(($nr_wys_br===$kodzam)and($lok_br==='MW')){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO OBECNEJ WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif(($nr_zam!==$kodzam)and($dl_nr_code<1)and($dlug>26)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO OBECNEJ WYSYLKI NR $kodzam $nr_zam<BR></FONT><FONT COLOR='#0000FF'> ZESKANUJ PRAWIDLOWY BOX TEN JEST DO INNEJ WYSYLKI. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($dlug_scpr_pr>1){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO OBECNEJ WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($qty_box<1){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BLAD ODCZYTU BARCODE w ILOSCI <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
  elseif($lok_br==='ZB'){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZABLOKOWANY, W STREFIE PRODUKTOW ZABLOKOWANYCH NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($lok_br==='MW'){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO INNEJ WYSYLKI NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($lok_br==='WZ'){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST NA WYSYLKA ZAMKNIETA NR $nr_wys_br<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($lok_br==='MP'){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST NA PRZYJECIU Z PRODUKCJI<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
 elseif($lok_br==='PR'){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST WYDANY NA REWORK<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
    					 echo "<font size='0'>$komunikat";}

    					 
 elseif($lok_br===''){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX nie jest zarejestrowany w systemie lub bledny kod kreskowy<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
    					 echo "<font size='0'>$komunikat";} 
elseif(($qty_przygr>$qty_zammin) and ($dlug_part_no>1)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ZA DUZA ILOSC $PART_NO BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	 				 
elseif(($qty_box>$qty_box_pr1) and ($dlug_part_no>1)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ZA DUZA ILOSC NA ETYKIECIE $PART_NO BOX <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif(($dlugpart_name_br<1) and ($dlug>26)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BLAD ETYKIETY ZESKANUJ JESZCZE RAZ <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
elseif($dlug_scpr_pr>1){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WYSTEPUJE W WYSYLCE ETYKIETY ZESKANUJ JESZCZE RAZ <BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
														
elseif(($dl_nr_code<1) and($dlug>26)and ($dlug_klientwm1>2)){  
						 
					//if($P_lot_no!==$lot_no_baza){ echo "<font size='0'>"; //echo include "podaj_part_no_wys.php"; 
				//	$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>LOT_NO NIEZGODNY Z FIFO LISTY WYSYLKI<BR></FONT><FONT COLOR='#0000FF'> WSZYTAJ BOX Z PRAWIDLOWYM LOT NO !! 
				//			              ";
    					 //echo "<font size='0'>$komunikat";	 
						 
						 
						 //}else{
						 
						 
						 
						 
						 
						 
 
 
 
																session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MW";
																$powod="AUTO-WYS";
																	 				
																
																
																
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','','$magazyn1','$login','$powod','$kod')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_wys(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$kodzam','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','$lok_pal_na_reg','$magazyn1','$login','$powod','$kod','$lok_pal_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_pal='$zero',nr_wys='$kodzam' WHERE barcode='$kod'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlop);
                                                                						mysql_close();
                                                                						
                                                                							$kwerenda_zap_max_stloplfifo = "UPDATE prod_fifo SET status='Z' WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no'  and nr_zlec='$kodzam' and status='P'  LIMIT 1";
																							mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							mysql_query("SET NAMES 'latin2'");
                                                                							mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   							@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							mysql_query($kwerenda_zap_max_stloplfifo);
                                                                							mysql_close();
                                                                						
																						 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5h = "SELECT * FROM zamowienia_zaw WHERE  nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
 																						$wynik5h = mysql_query($kwerenda5h);
 																						$rekordow5h = mysql_numrows($wynik5h);
 																						mysql_close();
 																						$id_zaw		 			= mysql_result($wynik5h, 0, "id");
																						$qty_przyg	 			= mysql_result($wynik5h, 0, "qty_box");
 																						$qty_przygr=$qty_przyg+$qty_box;
 																						
																						 $kwerenda_zap_max_stlopk = "UPDATE zamowienia_zaw SET qty_box='$qty_przygr' WHERE id='$id_zaw'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopk);
                                                                						mysql_close();
                                                                 						
																                       				 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hh = "SELECT * FROM zamowienia WHERE  nr_zam='$kodzam'";
 																						$wynik5hh = mysql_query($kwerenda5hh);
 																						$rekordow5h = mysql_numrows($wynik5hh);
 																						mysql_close();
 																						$id_zam	 			= mysql_result($wynik5hh, 0, "id");
																						$nobox_tt	 			= mysql_result($wynik5hh, 0, "no_box");
 																						$nobox_tte=$nobox_tt+1;
 																						
																						 $kwerenda_zap_max_stlopkh = "UPDATE zamowienia SET no_box='$nobox_tte', status='P' WHERE id='$id_zam'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopkh);
                                                                						mysql_close();
																	
																 
																    
																
																	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$lok_pal_na_reg'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, 0, "ilosc");
 																	$ilosc1=$ilosc_bazae1-1;
																	 
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$lok_pal_na_reg'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
                                                                	   				    mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hhqw = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
 																						$wynik5hhqw = mysql_query($kwerenda5hhqw);
 																						$rekordow5hqw = mysql_numrows($wynik5hhqw);
 																						mysql_close();
 																						$id_prod	 			= mysql_result($wynik5hhqw, 0, "id");
																						$stan_rob	 			= mysql_result($wynik5hhqw, 0, "stan");
                                                                						$stan_wys_rob			= mysql_result($wynik5hhqw, 0, "stan_wys");
                                                                						$stan_robr=$stan_rob-$qty_box;
                                                                						$stan_wys_robr=$stan_wys_rob+$qty_box;
                                                                						
                                                                							 $kwerenda_zap_max_stkkhqw = "UPDATE prod_got SET stan='$stan_robr',stan_wys='$stan_wys_robr' WHERE id='$id_prod'";
                                                                							 mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							 mysql_query("SET NAMES 'latin2'");
                                                                							 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                							 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							 mysql_query($kwerenda_zap_max_stkkhqw);
                                                                							 mysql_close();
 									  						
 
 echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
						
						$komunikat = "<center><B><FONT COLOR='#00aa00'>BOX zarejestrowany na wysylke nr $kodzam <BR>  
							               							</center><hr>";
																	echo $komunikat;
      
      }
      
elseif($dlug_qty_box_pr<1){ echo include "parowanie_klient_kod.php"; }	
elseif(($dlug_part_no<1)and($dl_nr_code<1)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
elseif(($lok_br==='MG')and($dl_nr_code<1)) {  
 
 
 
 
																session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="MW";
																$powod="AUTO-WYS";
																	 				
																
																
																
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','','$magazyn1','$login','$powod','$kod')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_wys(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$kodzam','$shinchang_part_no','$part_no','$part_name','$qty_box','$qty_box','$klient','$lok_pal_na_reg','$magazyn1','$login','$powod','$kod','$lok_pal_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_pal='$zero',nr_wys='$kodzam' WHERE barcode='$kod'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlop);
                                                                						mysql_close();
                                                                						
                                                                							$kwerenda_zap_max_stloplfifo = "UPDATE prod_fifo SET status='Z' WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no'  and nr_zlec='$kodzam' and status='P'  LIMIT 1";
																							mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							mysql_query("SET NAMES 'latin2'");
                                                                							mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   							@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							mysql_query($kwerenda_zap_max_stloplfifo);
                                                                							mysql_close();
                                                                						
																						 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5h = "SELECT * FROM zamowienia_zaw WHERE  nr_zam='$kodzam' and shinchang_part_no='$shinchang_part_no'";
 																						$wynik5h = mysql_query($kwerenda5h);
 																						$rekordow5h = mysql_numrows($wynik5h);
 																						mysql_close();
 																						$id_zaw		 			= mysql_result($wynik5h, 0, "id");
																						$qty_przyg	 			= mysql_result($wynik5h, 0, "qty_box");
 																						$qty_przygr=$qty_przyg+$qty_box;
 																						
																						 $kwerenda_zap_max_stlopk = "UPDATE zamowienia_zaw SET qty_box='$qty_przygr' WHERE id='$id_zaw'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopk);
                                                                						mysql_close();
                                                                 						
																                       				 mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hh = "SELECT * FROM zamowienia WHERE  nr_zam='$kodzam'";
 																						$wynik5hh = mysql_query($kwerenda5hh);
 																						$rekordow5h = mysql_numrows($wynik5hh);
 																						mysql_close();
 																						$id_zam	 			= mysql_result($wynik5hh, 0, "id");
																						$nobox_tt	 			= mysql_result($wynik5hh, 0, "no_box");
 																						$nobox_tte=$nobox_tt+1;
 																						
																						 $kwerenda_zap_max_stlopkh = "UPDATE zamowienia SET no_box='$nobox_tte', status='P' WHERE id='$id_zam'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlopkh);
                                                                						mysql_close();
																	
																 
																    
																
																	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$lok_pal_na_reg'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, 0, "ilosc");
 																	$ilosc1=$ilosc_bazae1-1;
																	 
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$lok_pal_na_reg'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();
                                                                	   				    mysql_connect('localhost',$uzytkownik,$haslo);
 																						 mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5hhqw = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
 																						$wynik5hhqw = mysql_query($kwerenda5hhqw);
 																						$rekordow5hqw = mysql_numrows($wynik5hhqw);
 																						mysql_close();
 																						$id_prod	 			= mysql_result($wynik5hhqw, 0, "id");
																						$stan_rob	 			= mysql_result($wynik5hhqw, 0, "stan");
                                                                						$stan_wys_rob			= mysql_result($wynik5hhqw, 0, "stan_wys");
                                                                						$stan_robr=$stan_rob-$qty_box;
                                                                						$stan_wys_robr=$stan_wys_rob+$qty_box;
                                                                						
                                                                							 $kwerenda_zap_max_stkkhqw = "UPDATE prod_got SET stan='$stan_robr',stan_wys='$stan_wys_robr' WHERE id='$id_prod'";
                                                                							 mysql_connect('localhost',$uzytkownik,$haslo);
                                                                							 mysql_query("SET NAMES 'latin2'");
                                                                							 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                							 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                							 mysql_query($kwerenda_zap_max_stkkhqw);
                                                                							 mysql_close();
 									  						
 
 echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
						
						$komunikat = "<center><B><FONT COLOR='#00aa00'>BOX zarejestrowany na wysylke nr $kodzam <BR>  
							               							</center><hr>";
																	echo $komunikat;
      }
      
      
      
      
      
 elseif(($lok_br==='MG')and($dl_nr_code>1)) {       
      
      
      
      
      
      															session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $magazyn1="ZB";
																$powod="M_BOX_ZB";
																
																mysql_connect('localhost',$uzytkownik,$haslo);
																mysql_query('SET CHARSET latin2');
																@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																$kwerenda = "SELECT * FROM prod_st WHERE barcode='$kod'";
																$wynik = mysql_query($kwerenda);
																$rekordow = mysql_numrows($wynik);
																mysql_close();
																$lot_no_b				= mysql_result($wynik, 0, "lot_no");		
																$part_no_b  			= mysql_result($wynik, 0, "part_no");
																$part_name_b			= mysql_result($wynik, 0, "part_name");	
																$qty_box_b				= mysql_result($wynik, 0, "qty_box");
	    														$klient_b				= mysql_result($wynik, 0, "klient");
																$lok_b					= mysql_result($wynik, 0, "lok");
																$barcode_b				= mysql_result($wynik, 0, "barcode");
																$lok_sc_b				= mysql_result($wynik, 0, "lok_sc");
																$lok_pal_b				= mysql_result($wynik, 0, "lok_pal");
																$shinchang_part_no_b 	= mysql_result($wynik, 0, "shinchang_part_no");
																
																						mysql_connect('localhost',$uzytkownik,$haslo);
																						mysql_query('SET CHARSET latin2');
																						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
																						$kwerendawgot = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no_b'";
																						$wynikwgot = mysql_query($kwerendawgot);
																						$rekordowwgot = mysql_numrows($wynikwgot);
																						mysql_close();			 
																						$stan_glw	 			= mysql_result($wynikwgot, 0, "stan");
																						$stan_blok	 			= mysql_result($wynikwgot, 0, "stan_blok");
 																						$stan_glw_rob=$stan_glw-$qty_box_b;
 																						$stan_blok_rob=$stan_blok+$qty_box_b;
 																						
																						$kwerenda_zap_max = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 						VALUES ('$kodzam','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_glw','$stan_glw_rob','$klient_b','$p','$lok_b','$login','$powod','$barcode_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zap_max);
                                                                 						mysql_close();
                                                                 						$kwerenda_zapw_max2 = "INSERT INTO prod_got_zb(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode,lok_pal)
                                                                 						VALUES ('$kodzam','$shinchang_part_no_b','$part_no_b','$part_name_b','$stan_blok','$stan_blok_rob','$klient_b','$lok_sc_b','$lok_b','$login','$powod','$barcode_b','$lok_pal_b')";
                                                                  						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 						mysql_query("SET NAMES 'latin2'");
                                                                 						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 						mysql_query($kwerenda_zapw_max2);
                                                                 						mysql_close();
                                                                 						$kwerenda_zap_max_stlop = "UPDATE prod_st SET lok='$magazyn1',login='$login',powod='$powod',lok_sc='$zero',lok_pal='$zero',nr_wys='$kodzam' WHERE barcode='$barcode_b'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stlop);
                                                                						mysql_close();
                                                                							$kwerenda_max = "UPDATE prod_got SET stan='$stan_glw_rob',stan_blok='$stan_blok_rob' WHERE shinchang_part_no='$shinchang_part_no_b'";	
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_max);
                                                                						mysql_close();
                                                                 						$lok_pal_na_reg=$lok_pal_b;
                                                 
																	 					mysql_connect('localhost',$uzytkownik,$haslo);
																	 					mysql_query('SET CHARSET latin2');
 																						@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																						$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$lok_sc_b'";
									 													$wynik5reglk = mysql_query($kwerenda5reglk);
 																						$rekordow5reglk = mysql_numrows($wynik5reglk);
 																						mysql_close();
 																						$ilosc_bazae1	 			= mysql_result($wynik5reglk, 0, "ilosc");
 																						$ilosc1=$ilosc_bazae1-1;
																	 
																						 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$lok_sc_b'";
                                                                						mysql_connect('localhost',$uzytkownik,$haslo);
                                                                						mysql_query("SET NAMES 'latin2'");
                                                                						mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                						@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                						mysql_query($kwerenda_zap_max_stkk);
                                                                						mysql_close();
  						echo "<font size='0'>"; echo include "wyczyt_wys.php"; 
						
						$komunikat = "<center><B><FONT COLOR='#00aa00'>BOX zablokowany w strefie $nr_opis <BR>  
							               							</center><hr>";
																
  
      
      
   
	  							echo "<font size='0'>$komunikat"; }	

 	
	  else{ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX NIE JEST ZAREJESTROWANY W SYSTEMIE !!! <BR></FONT><FONT COLOR='#0000FF'> PRZYJMIJ BOX DO SYSTEMU !!! 
							              ";
							echo "<font size='0'>$komunikat"; }	

}							
							


