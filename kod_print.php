<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Untitled</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ 2004">
</HEAD>

<BODY>
<?php
  $id=$_GET['id'];
global $id;
echo"
<FORM ACTION='kod_gen.php' METHOD='post' name='id'>
<INPUT TYPE='hidden' NAME='id' VALUE='$id'>
</form>
<IMG SRC='kod_gen.php?id=$id'><br>
<IMG SRC='kod_gen.php?id=$id'>
";
?>
</BODY>
</HTML>
