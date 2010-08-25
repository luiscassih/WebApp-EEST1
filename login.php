<?php
 require "fyecore.php";
 $html = new html();
 $sql = new mysql();
 $link = $sql->connect();
 if (isset($_POST["user"]) && $_POST["user"] != "") {
 		if (isset($_POST["passwd"]) && $_POST["passwd"] != "") {
	 		$user = new users();
		 	if ($user->logIn($link, $_POST['user'],$_POST['passwd'])) {
				echo "1";
		 		return true;
		 	} else {
				echo "0";
		 		return false;
		 	}
	 	}
 }
 ?>
