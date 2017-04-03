<?php
// Dokonujemy wpisu w logu (dziennik zdarzeñ), np. kto siê zalogowa³/wylogowa³ i kiedy
function ZapisLog($kod_zdarzenia, $modul, $nr_kontrolny)
{
 $baza			= 'shinchang';
 $uzytkownik	= 'root';
 $haslo			= 'przemocp123';

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
 mysql_query("INSERT INTO t00_log (kod_zdarzenia, modul, nr_kontrolny) VALUES ('$kod_zdarzenia', '$modul', '$nr_kontrolny')");
 mysql_close();
}
?>
