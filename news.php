<?php
require_once "fyecore.php";
if (isset($_GET['idname'])){
		$news = new news();
		$news->getNews($_GET['idname']);
} else echo "Nada para mostrar ;)";
?>
