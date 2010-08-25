<?php
session_start();
require "fyecore.php";
$html = new html();
if ($_SESSION){
setcookie("user","",(time()-3600));
session_destroy();
header("refresh: 5; url=index.php");
$html->Errormsg("Te has deslogueado. 
<br>Seras redireccionado en 5 segundos.
<br><a href='index.php'>O click aqui</a>");
} else {
header("refresh: 5; url=index.php");
$html->Errormsg("<br><br>No se que haces en este sector...");
}
?>
