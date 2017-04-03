<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################

function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);								// Zwraca TRUE jeli $d (czyli data) jest wypełniona
  return $flaga;
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);
$kod_regal=$_SESSION['s_kod_regal'];

$kod 	= $_POST['kod'];
$_POST['kod_pal']=$kod;																
																


      session_start();
      $_SESSION['sbarcode']=$kod;
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
      
$datazz=date("Y-m-d");
$datazy=date("Y");
$datazm=date("n");
$datazd=date("d");

      $baza 		= 'barcod';
      $uzytkownik = 'robak';
      $haslo 		= 'robak1';

                                     mysql_connect('localhost',$uzytkownik,$haslo);
									 mysql_query('SET CHARSET latin2');
 									@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 									$kwerenda5reg = "SELECT * FROM prod_regal WHERE nr_reg='$kod' and typ='P'";
									 $wynik5reg = mysql_query($kwerenda5reg);
 									$rekordow5reg = mysql_numrows($wynik5reg);
 									mysql_close();
 									$typ_regalb	 					= mysql_result($wynik5reg, $hhk, "typ");
									$max_ilosc_regalb	 			= mysql_result($wynik5reg, $hhk, "max_il");	
									$ilosc_regalb	 				= mysql_result($wynik5reg, $hhk, "ilosc");
									$nr_regal_baza	 				= mysql_result($wynik5reg, $hhk, "nr_reg");	
									$ilosc_regalbrob=$ilosc_regalb+1;
									
									
     mysql_connect('localhost',$uzytkownik,$haslo);
     mysql_query('SET CHARSET latin2');
     @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
     $kwerenda5v = "SELECT * FROM prod_st WHERE barcode='$kod'";
     $wynik5v = mysql_query($kwerenda5v);
     $rekordow5v = mysql_numrows($wynik5v);
     mysql_close();
     $barcod	 			= mysql_result($wynik5v, $t, "barcode");	
     $lok_baza	 			= mysql_result($wynik5v, $t, "lok");						
     $lot_no_baza	 		= mysql_result($wynik5v, $t, "lot_no");
     $inw_baza	 			= mysql_result($wynik5v, $t, "inw");
 
 	  mysql_connect('localhost',$uzytkownik,$haslo);
     mysql_query('SET CHARSET latin2');
     @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
     $kwerenda5vp = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
     $wynik5vp = mysql_query($kwerenda5vp);
     $rekordow5vp = mysql_numrows($wynik5vp);
     mysql_close();
     $part_namerr	 			= mysql_result($wynik5vp, 0, "part_name");
     $qty_boxbaza	 			= mysql_result($wynik5vp, 0, "qty_box");
     $dlugpart_namerr = strlen($part_namerr);
     $qty_boxbaza1=$qty_boxbaza+38;

 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }
       elseif($kod===$kod_regal){ echo include "wcz_lokr_inw.php";
                               $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK NOWA LOKALIZACJA INWENTURA<b> </b> PODAJ KOD LOKALIZACJI - </center><hr>
					                        ";
						      echo $komunikat;
		                          
							}
	  elseif($kod===$nr_regal_baza){ 
	  
   																mysql_connect('localhost',$uzytkownik,$haslo);
									 							mysql_query('SET CHARSET latin2');
 																@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																$kwerenda5regg = "UPDATE prod_st SET lok_pal='$nr_regal_baza' WHERE  lok_sc='$kod_regal' and lok='MG'";
									 							$wynik5regg = mysql_query($kwerenda5regg);
 																$rekordow5regg = mysql_numrows($wynik5regg);
 																mysql_close();
	  							echo include "wcz_lokr_inw.php";
                               $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK PALETA ZEREJESTROWANA NA LOKALIZACJI PALETOWEJ<b> </b>  </center><hr>
					                        ";
						      echo $komunikat;
		                          
							}
							
if($data_rok<2005){  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php";
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_rok>$datazy){  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php";
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_mies>12){  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php";
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_dzien>31){  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php";
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
	 
	  	    elseif($qty_box>$qty_boxbaza1){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>ILOSC NA ETYKIECIE BOX WIEKSZA OA DOPUSZCZALNEJ<BR> SPRAWDZ ETYKIETE 
							              ";
							echo "<font size='0'>$komunikat"; 
						    }			
       elseif($inw_baza==="INW"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO JEST ZAREJESTROWANE INWENTURA NA REGALE /PALECIE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; 
						  }
      elseif ($lok_baza==="MW"){ 
	  
	  										mysql_connect('localhost',$uzytkownik,$haslo);
										mysql_query('SET CHARSET latin2');
										@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
										$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
										$wynikrrr = mysql_query($kwerendarrr);
										$rekordowrrr = mysql_numrows($wynikrrr);
										mysql_close();

										$id  					= mysql_result($wynikrrr, $ar, "id");                 
										$linia					= mysql_result($wynikrrr, $ar, "linia");
										$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
										$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
										$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
										$data 	 				= mysql_result($wynikrrr, $ar, "data");
										$klient	 				= mysql_result($wynikrrr, $ar, "klient");
										$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");
										$pole_odkl	 			= mysql_result($wynikrrr, $ar, "pole_odkl");
										$stan_pop	 			= mysql_result($wynikrrr, $ar, "stan_prod");
										$stan_inw		 		= mysql_result($wynikrrr, $ar, "st_inw");
	  
	  															session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="I_prz_reg";
       
                                                                 $stan_inwr=$stan_inw+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET st_inw='$stan_inwr' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_inw(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_inw','$stan_inwr','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                 	$kwerenda_zap_max_st = "UPDATE prod_st SET lok='$lok',login='$login',powod='$powod',barcode_we_gl='$kod',lok_sc='$kod_regal',shinchang_part_no='$shinchang_part_no',inw='INW' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                     
																
	  						include "aprcp_z_czytnikabbr_inw.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK PUDELKO ZAREJ NA LOK/PAL</b> PODAJ KOD PUDELKA - </center><hr>
							";
							 echo $komunikat;
						   }
	
      
	  elseif (($lok_baza==="MP") or($lok_baza==="WZ")or($lok_baza==="MG")or($lok_baza==="PR")or($lok_baza==="ZB")){ 
	  
										mysql_connect('localhost',$uzytkownik,$haslo);
										mysql_query('SET CHARSET latin2');
										@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
										$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
										$wynikrrr = mysql_query($kwerendarrr);
										$rekordowrrr = mysql_numrows($wynikrrr);
										mysql_close();

										$id  					= mysql_result($wynikrrr, $ar, "id");                 
										$linia					= mysql_result($wynikrrr, $ar, "linia");
										$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
										$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
										$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
										$data 	 				= mysql_result($wynikrrr, $ar, "data");
										$klient	 				= mysql_result($wynikrrr, $ar, "klient");
										$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");
										$pole_odkl	 			= mysql_result($wynikrrr, $ar, "pole_odkl");
										$stan_pop	 			= mysql_result($wynikrrr, $ar, "stan_prod");
										$stan_inw		 		= mysql_result($wynikrrr, $ar, "st_inw");
	  
	  															session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="I_prz_reg";
       
                                                                 $stan_inwr=$stan_inw+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET st_inw='$stan_inwr' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_inw(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_inw','$stan_inwr','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                 	$kwerenda_zap_max_st = "UPDATE prod_st SET lok='$lok',login='$login',powod='$powod',barcode_we_gl='$kod',lok_sc='$kod_regal',shinchang_part_no='$shinchang_part_no',inw='INW' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                  	

	  						include "aprcp_z_czytnikabbr_inw.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK PUDELKO ZAREJ NA LOK/PAL</b> PODAJ KOD PUDELKA - </center><hr>
							";
							 echo $komunikat;
							 }

	  	 elseif ($lok_baza==="MG"){ echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>PUDELKO ZOSTALO JUZ WYSLANE DO KLIENTA- NIE POWINNO ISTNIEC NA MAGAZYNIE <BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							 echo "<font size='0'>$komunikat";
						   }
		
		 elseif ($lok_baza==="GI"){ 
	  
	  
	  
										mysql_connect('localhost',$uzytkownik,$haslo);
										mysql_query('SET CHARSET latin2');
										@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
										$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
										$wynikrrr = mysql_query($kwerendarrr);
										$rekordowrrr = mysql_numrows($wynikrrr);
										mysql_close();

										$id  					= mysql_result($wynikrrr, $ar, "id");                 
										$linia					= mysql_result($wynikrrr, $ar, "linia");
										$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
										$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
										$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
										$data 	 				= mysql_result($wynikrrr, $ar, "data");
										$klient	 				= mysql_result($wynikrrr, $ar, "klient");
										$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");
										$pole_odkl	 			= mysql_result($wynikrrr, $ar, "pole_odkl");
										$stan_pop	 			= mysql_result($wynikrrr, $ar, "stan_prod");
										$stan_inw		 		= mysql_result($wynikrrr, $ar, "st_inw");
	  
	  															session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="I_prz_reg";
       
                                                                 $stan_inwr=$stan_inw+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET st_inw='$stan_inwr' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_inw(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_inw','$stan_inwr','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                 	$kwerenda_zap_max_st = "UPDATE prod_st SET lok='$lok',login='$login',powod='$powod',barcode_we_gl='$kod',lok_sc='$kod_regal',shinchang_part_no='$shinchang_part_no',inw='INW' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                  	 

	  						include "aprcp_z_czytnikabbr_inw.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK PUDELKO ZAREJ NA LOK/PAL</b> PODAJ KOD PUDELKA - </center><hr>
							";
							 echo $komunikat;
							 }

    
		elseif($dlugpart_namerr>1){
										mysql_connect('localhost',$uzytkownik,$haslo);
										mysql_query('SET CHARSET latin2');
										@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
										$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
										$wynikrrr = mysql_query($kwerendarrr);
										$rekordowrrr = mysql_numrows($wynikrrr);
										mysql_close();

										$id  					= mysql_result($wynikrrr, $ar, "id");                 
										$linia					= mysql_result($wynikrrr, $ar, "linia");
										$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
										$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
										$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
										$data 	 				= mysql_result($wynikrrr, $ar, "data");
										$klient	 				= mysql_result($wynikrrr, $ar, "klient");
										$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");
										$pole_odkl	 			= mysql_result($wynikrrr, $ar, "pole_odkl");
										$stan_pop	 			= mysql_result($wynikrrr, $ar, "stan_prod");
										$stan_inw		 		= mysql_result($wynikrrr, $ar, "st_inw");
	  
	  															session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="I_prz_reg";
       
                                                                 $stan_inwr=$stan_inw+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET st_inw='$stan_inwr' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_inw(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_inw','$stan_inwr','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                   	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,lok_sc,shinchang_part_no,inw)
                                                                 					VALUES ('$data_exp','$part_no','$part_name','$qty_box','$stan_inw','$klient','$lok','$login','$powod','$kod','$kod','$kod_regal','$shinchang_part_no','INW')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                  	 mysql_connect('localhost',$uzytkownik,$haslo);
																	 mysql_query('SET CHARSET latin2');
 																	@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 																	$kwerenda5reglk = "SELECT * FROM prod_regal WHERE nr_reg='$kod_regal'";
									 								$wynik5reglk = mysql_query($kwerenda5reglk);
 																	$rekordow5reglk = mysql_numrows($wynik5reglk);
 																	mysql_close();
 																	$ilosc_bazae1	 			= mysql_result($wynik5reglk, $hmnb, "ilosc");
 																	$ilosc1=$ilosc_bazae1+1;
																	 $kwerenda_zap_max_stkk = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$kod_regal'";
                                                                	
																	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_stkk);
                                                                	mysql_close();

	  						include "aprcp_z_czytnikabbr_inw.php";
                            $komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'>OK PUDELKO ZAREJ NA LOK/PAL</b> PODAJ KOD PUDELKA - </center><hr>
							";
							 echo $komunikat;
							 }
		
		else {  echo "<font size='0'>"; echo include "aprcp_z_czytnikabbr_inw.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

