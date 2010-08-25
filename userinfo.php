<?php
require "fyecore.php";
if (isset($_COOKIE["user"]) && $_COOKIE["user"] != ""){
	if(isset($_COOKIE["passwdhash"]) && $_COOKIE["passwdhash"] != "") {
		$_SESSION["user"] = $_COOKIE["user"];
		$_SESSION["passwdhash"] = $_COOKIE["passwdhash"];
		$sql = new mysql();
		$link = $sql->connect();
		$user = new users();
		if ($user->logIn($link, $_SESSION['user'],$_SESSION['passwdhash'])) {
			echo "Welcome " . $_SESSION["user"] . "<br>
			Mensajes nuevos: <span style='color:red'> &lt;";
			if ($user->getNewMessages($link, $_SESSION["user"]) != NULL) echo $user->getNewMessages($link,$_SESSION["user"]) . " News";
					else echo "0 News";
			echo "&gt;</span>
			<br><a id='logoutlink' href='logout.php'>[Logout]</a>";
		}
	}
} else {
		/**
		 * Show user login form
		 */
		$html = new html();
		$html->Showloginform();
}
