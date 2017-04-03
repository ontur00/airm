
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
      $lot_no_z_k=substr($kod, 0,8);
	  $dlug_kor=$dlug-18;

      $part_no = substr($kod, 14,11);



      $qty_box_st        = $dlug-9;
      $qty_box_end       = $dlug-4;
      $qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
      $qty_box		     = substr($qty_box_rob ,0,5);
      $qty_box_il		 = substr(str_replace("O", "", $qty_box_rob) ,5,5);
		settype($qty_box, "integer");

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';





	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 	$kwerenda5reglkjt = "SELECT * FROM prod_got WHERE part_no='$part_no' and io='P'";
	   $wynik5reglkjt = mysql_query($kwerenda5reglkjt);
 	$rekordow5reglkjt = mysql_numrows($wynik5reglkjt);
 	mysql_close();
 	$qty_box_pr	 			= mysql_result($wynik5reglkjt, 0, "qty_box");
 	$kod_alc_n	 			= mysql_result($wynik5reglkjt, 0, "nr_etyk");
     $dlug_qty_box_pr = strlen($qty_box_pr);
     $dlug_kod_alc_n = strlen($kod_alc_n);
 session_start();
  $_SESSION['skod_alc_n']=$kod_alc_n;
  $_SESSION['sbarcode']=$kod;
  $_SESSION['spart_no']=$part_no;
  
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

	mysql_connect('localhost',$uzytkownik,$haslo);
	mysql_query('SET CHARSET latin2');
	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    $kwerenda1d3fi = "SELECT * FROM prod_fifo WHERE lot_no='$lot_no_z_k' and part_no='$part_no' and ilosc='$qty_box' and  nr_zlec='$kodzam' and status='P' and lokal='$lok_pal_na_reg' LIMIT 1";
	$wynik1d3fi = mysql_query($kwerenda1d3fi);
	$rekordow1d3fi = mysql_numrows($wynik1d3fi);
	mysql_close();
	$prtu					= mysql_result($wynik1d3fi, 0, "part_no");
	$dlugprtu = strlen($prtu);	
																
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM zamowienia_zaw WHERE nr_zam='$kodzam' and part_no='$part_no'";
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
  
 if(($nr_wys_br===$kodzam)and($lok_br==='MW')){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>BOX JEST JUZ ZAREJESTOWANY DO OBECNEJ WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
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
    					 

	/*
elseif($dl_nr_code<1){   if($dlugprtu<1){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
					$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>LOT_NO NIEZGODNY Z FIFO LISTY WYSYLKI<BR></FONT><FONT COLOR='#0000FF'> WSZYTAJ BOX Z PRAWIDLOWYM LOT NO !! 
							              ";
    					 echo "<font size='0'>$komunikat";}else{
						 
						 
						 
						 
						 
						 
 
 
 
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
                                                                						
                                                                							$kwerenda_zap_max_stloplfifo = "UPDATE prod_fifo SET status='Z' WHERE lot_no='$lot_no_z_k' and part_no='$shinchang_part_no' and ilosc='$qty_box' and  nr_zlec='$kodzam' and status='P' and lokal='$lok_pal_na_reg' LIMIT 1";
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
      
      }}*/
      
elseif($dlug_qty_box_pr<1){ echo "<font size='0'>";  echo include "podaj_part_no_wys.php";$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	
elseif(($dlug_part_no<1)and($dl_nr_code<1)){ echo "<font size='0'>"; echo include "podaj_part_no_wys.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>NIEPRAWIDLOWY BOX DO WYSYLKI NR $kodzam<BR></FONT><FONT COLOR='#0000FF'> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }	

    
      
      

 	
	  else{ if($dlug_kod_alc_n<3){echo "<font size='0'>"; echo include "parowanie_klient_kod_2wpr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>WCZYTAJ BARCODE Z DRUGIEJ ETYKIETY  <BR></FONT><FONT COLOR='#0000FF'>  ETYKIETA KLIENTA !!! 
							              ";
							echo "<font size='0'>$komunikat";
		    }else{echo "<font size='0'>"; echo include "parowanie_klient_kod_alcwpr.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#00FF00'>WCZYTAJ KOD ALC Z PRODUKTU  <BR></FONT><FONT COLOR='#0000FF'>  !!! 
							              ";} }	

}							
							


