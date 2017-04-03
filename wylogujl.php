<?php
session_start();
unset($_SESSION['luzytkownik']);
unset($_SESSION['lhaslo']);
unset($_SESSION['lprawa']);
session_destroy();
header("Location: indexz.php");
?>
