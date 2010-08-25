<?php
require_once "fyecore.php";
if (isset($_GET['idname']) && $_GET['idname']){
		$mysql = new mysql();
		$link = $mysql->connect();
		$query = "SELECT topmenu.content FROM topmenu WHERE topmenu.id='" . $_GET['idname'] ."';";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		echo $row['content'];
} else {
	if (isset($_GET['id_izq']) && $_GET['id_izq']){
		$mysql = new mysql();
		$link = $mysql->connect();
		$query = "SELECT menuizq.content FROM menuizq WHERE menuizq.id_menu='" . $_GET['id_izq'] ."';";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		echo $row['content'];
	} else {
		$news = new news;
		$news->ShowNews();
	}
}
?>
