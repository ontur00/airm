<?php


$tekst_1="Ostatnie zdarzenie / Last Event:";

      session_start();
      $kod_2=$_SESSION['sbarcode2'];
      $kod_1=$_SESSION['sbarcode1'];     
      $kod=$_SESSION['sbarcode'];

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


      $dlug_1 = strlen($kod_1);
      $data_rok_1 = substr($kod_1, 0,4);
      $data_mies_1 = substr($kod_1, 4,2);
      $data_dzien_1 = substr($kod_1, 6,2);
      $data_exp_1="$data_rok_1-$data_mies_1-$data_dzien_1";
      $dlug_kor_1=$dlug_1-18;

      $shinchang_part_no_1 = substr($kod, 8,$dlug_kor_1);



      $qty_box_st_1        = $dlug_1-9;
      $qty_box_end_1       = $dlug_1-4;
      $qty_box_rob_1       = substr($kod_1, $qty_box_st_1,$qty_box_end_1);
      $qty_box_1		   = substr($qty_box_rob_1 ,0,5);
      $qty_box_il_1		   = substr(str_replace("O", "", $qty_box_rob_1) ,5,5);

   	  
		 
	  $dlug_2 = strlen($kod_2);
      $data_rok_2 = substr($kod_2, 0,4);
      $data_mies_2 = substr($kod_2, 4,2);
      $data_dzien_2 = substr($kod_2, 6,2);
      $data_exp_2="$data_rok_2-$data_mies_2-$data_dzien_2";
      $dlug_kor_2=$dlug_2-18;

      $shinchang_part_no_2 = substr($kod_2, 8,$dlug_kor_2);



      $qty_box_st_2        = $dlug_2-9;
      $qty_box_end_2       = $dlug_2-4;
      $qty_box_rob_2       = substr($kod_2, $qty_box_st_2,$qty_box_end_2);
      $qty_box_2		   = substr($qty_box_rob_2 ,0,5);
      $qty_box_il_2		   = substr(str_replace("O", "", $qty_box_rob_2) ,5,5);
      

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

	 mysql_connect('localhost',$uzytkownik,$haslo);
	 mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
 	$kwerenda5reglkjh = "SELECT * FROM prod_st WHERE barcode='$kod'";
	$wynik5reglkjh = mysql_query($kwerenda5reglkjh);
 	$rekordow5reglkjh = mysql_numrows($wynik5reglkjh);
 	mysql_close();
 	$kod_regal	 			= mysql_result($wynik5reglkjh, 0, "lok_sc");




	 mysql_connect('localhost',$uzytkownik,$haslo);
	 mysql_query('SET CHARSET latin2');
 	@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
 	$kwerenda5reglkl = "SELECT * FROM prod_regal WHERE nr_reg='$kod_regal'";
	$wynik5reglkl = mysql_query($kwerenda5reglkl);
 	$rekordow5reglkl = mysql_numrows($wynik5reglkl);
 	mysql_close();
 	$ilosc_bazae1	 			= mysql_result($wynik5reglkl, 0, "ilosc");
 	$ilosc1=$ilosc_bazae1-1;
																	 
																	 
	$kwerenda_zap_max_stkkl = "UPDATE prod_regal SET ilosc='$ilosc1' WHERE nr_reg='$kod_regal'";
                                                                	
	mysql_connect('localhost',$uzytkownik,$haslo);
    mysql_query("SET NAMES 'latin2'");
    mysql_query("SET CHARACTER SET 'latin2_general_ci'");
    @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
    mysql_query($kwerenda_zap_max_stkkl);
    mysql_close();
																	 






mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo¿na znaleŸæ bazy danych!");
$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynikrrr = mysql_query($kwerendarrr);
$rekordowrrr = mysql_numrows($wynikrrr);
mysql_close();
               
$linia					= mysql_result($wynikrrr, $ar, "linia");
$id  					= mysql_result($wynikrrr, $ar, "id");
$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
$data 	 				= mysql_result($wynikrrr, $ar, "data");
$klient	 				= mysql_result($wynikrrr, $ar, "klient");
$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");
$pole_odkl	 			= mysql_result($wynikrrr, $ar, "pole_odkl");

$stan_wgot		 		= mysql_result($wynikrrr, $ar, "stan");
 
                                    
									
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $stan_b1=(int)$qty_box_1;
                                                                $stan_b2=(int)$qty_box_2;
                                                                $powod="REPAK";
                                                                $stan=$stan_pop-$stan_b;
                                                                $stan_wgotb=$stan_wgot-$stan_b;
																$stan_wgotb1=$stan_wgotb+$stan_b1;
																$stan_wgotb2=$stan_wgotb1+$stan_b2;

                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stan_wgotb','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                $kwerenda_zap_maxm1 = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgotb','$stan_wgotb1','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod_1')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm1);
                                                                 mysql_close();  
																$kwerenda_zap_maxm2 = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgotb1','$stan_wgotb2','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod_2')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm2);
                                                                 mysql_close();
                                                                 		$kwerenda_zap_maxm2p = "INSERT INTO prod_got_przep(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgotb1','$stan_wgotb2','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod_2')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm2p);
                                                                 mysql_close();
                                                                 
                                                                      $kwerenda_zap_maxm1p = "INSERT INTO prod_got_przep(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgotb','$stan_wgotb1','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod_1')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm1p);
                                                                 mysql_close();
                                                                 
                                                                    $kwerenda_zap_maxmp = "INSERT INTO prod_got_przep(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stan_wgotb','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxmp);
                                                                 mysql_close();
                                                                 
                                                                 
                                                                 	$lok="MR";$loksc="";
                                                                 	$kwerenda_zap_max_st = "UPDATE prod_st SET lok='$lok',login='$login',powod='$powod',barcode_wy_gl='$kod',lok_sc='$loksc' WHERE barcode='$kod'";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	
                                                                	mysql_close();
                                                                		$lok="MG";
                                                                 	$kwerenda_zap_max_st1 = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,shinchang_part_no)
                                                                 					VALUES ('$data_exp_1','$part_no','$part_name','$stan_b1','$stan_wgotb1','$klient','$lok','$login','$powod','$kod_1','$kod_1','$shinchang_part_no_1')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st1);
                                                                	mysql_close();	
																	
																	$kwerenda_zap_max_st2 = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,shinchang_part_no)
                                                                 					VALUES ('$data_exp_2','$part_no','$part_name','$stan_b2','$stan_wgotb2','$klient','$lok','$login','$powod','$kod_2','$kod_2','$shinchang_part_no_2')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st2);
                                                                	mysql_close();
                                                                	
 																	  
																	 
																	 
																	 
														
                                                                 
                                                                 echo include "aprcp_z_czytnikabbrep.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>Pude³ko  $part_no  PRZEPAKOWANE  <BR>  
							               						</center><hr>";
																	echo $komunikat;
						                                          


?>

