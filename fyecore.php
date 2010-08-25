<?php
/**
 * 
 * @author Luis Cassih
 * @version	0.7.10
 * @name	Nucleo de la aplicacion web E.E.S.T. Nº 1 "Bme Mitre"
 *
 */
class mysql {
		/**
		 * MySQL Host Configure
		 * EDITAR BAJO RESPONSABILIDAD
		 */
		private $host = "localhost";
		private $username = "root";
		private $passwd = "";
		private $databaseName = "eest";

		public function connect() {
			@$connectionString = mysql_connect($this->host,$this->username,$this->passwd) or die ("Error en la conexion a la bases de datos.");
			mysql_select_db($this->databaseName,$connectionString)or die ("Error en la seleccion de la bases de datos.");
			return $connectionString;
		}

		public function close($connectionString) {
			mysql_close($connectionString);
		}

		public function install($connecctionString) {
			/*
			create table users (
				ID INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
				username VARCHAR(50) NOT NULL,
				passwd VARCHAR(50) NOT NULL,
				newmsg INT(11)
			);

			// BEGIN menu_type: 0(Link) 1(Content) 2(Application) 3(categorie)

			create table topmenu (
				id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
				peso int(2) NOT NULL,
				name varchar(50) NOT NULL,
				menu_type TINYINT(1) NOT NULL,
				content TEXT,
				link varchar(50),
				applicationsource varchar(50)
			);
			

			create table menuizq (
				id_cat int(11) NOT NULL,
				id_menu int(11) AUTO_INCREMENT UNIQUE,
				peso int(2) NOT NULL,
				name varchar(50) NOT NULL,
				menu_type TINYINT(1) NOT NULL,
				content TEXT,
				link varchar(50),
				applicationsource varchar(50)
			);

			// End menu_type
			create table news (
				id int(11) NOT NULL AUTO_INCREMENT UNIQUE,
				title varchar(255),
				content TEXT,
				fecha datetime
			)
			 */
		}
}

class users {
	/**
	 * 
	 * @param $link	mySQL connection link
	 * @return $row user assoc array
	 */
	public function getUsers($link) {
		$query = "SELECT users.id,users.username FROM users;";
		$result = mysql_query($query, $link);
		while ($row[] = mysql_fetch_assoc($result));
		array_pop($row);
		return $row;
	}
	/**
	 * 
	 * @param $link	mySQL connection link
	 * @param $username
	 * @param $passwd
	 * @return 0 if the user register is sucessfully
	 */
	public function addUser($link,$username,$passwd) {
		$query = "INSERT INTO users VALUES (NULL,'$username','$passwd');";
		if (!mysql_query($query,$link)) {
			return 0;
		} else return 1;
	}

	public function deleteUser($link, $id) {
		$query = "DELETE FROM users WHERE users.id = '$id';";
		if (!mysql_query($query,$link)){
			return 0;
		} else return 1;
	}
	
	public function logIn($link,$username,$passwd) {
		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);
		$passwd = stripslashes($passwd);
		$passwd = mysql_real_escape_string($passwd);
		$query = "SELECT users.username,users.passwd FROM users WHERE users.username = '$username' AND users.passwd = '$passwd';";
		$result = mysql_query($query,$link);
		$check = mysql_num_rows($result);
		$expirecookie = time() + (30 * 24 * 60 * 60);
		if ($check == 1) {
			$query = "SELECT users.username, users.passwd FROM users WHERE users.username= '$username'";
			$result = mysql_query($query,$link);
			$data = mysql_fetch_assoc($result);
			$_SESSION["user"] = $data["username"];
			$_SESSION["passwdhash"] = $data["passwd"];
			setcookie("user", $data["username"], $expirecookie);
			setcookie("passwdhash", $data["passwd"], $expirecookie);
			return true;
		} else return false;
	}
	
	public function getNewMessages($link, $name) {
		$query = "SELECT users.newmsg FROM users WHERE users.username ='" . $name . "';";
		$result = mysql_query($query, $link);
		$row = mysql_fetch_assoc($result);
		return $row['newmsg'];
	}	
}

class topmenu {
	public function ShowMenu() {
		$mysql = new mysql();
		$link = $mysql->connect();
		$query = "SELECT topmenu.id, topmenu.applicationsource, topmenu.menu_type, topmenu.link, topmenu.name FROM topmenu ORDER BY topmenu.peso ASC;";
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			switch($row['menu_type']) {
				case 0: echo "<li><div id='menutoplink'><a href='" . $row['link'] . "'>" . $row['name'] . "</a>&nbsp;</div></li>";
					break;
				case 1: echo "<li id='contentlink' idname='" . $row['id'] ."'><div id='menutoplink'><a href=#>" . $row['name'] . "</a>&nbsp;</div></li>";
					break;
				case 2: echo "<li id='applicationlink' applicationsource='" . $row['applicationsource'] . "'><div id='menutoplink'><a href=#>" . $row['name'] . "</a>&nbsp;</div></li>";
					break;
			}
		}
	}
}

class menuizq {
	public function ShowMenu() {
		$mysql = new mysql();
		$link = $mysql->connect();
		$query_cat = "SELECT menuizq.id_cat, menuizq.menu_type, menuizq.name FROM menuizq WHERE menuizq.menu_type = 3 ORDER BY menuizq.peso ASC;";
		$result_cat = mysql_query($query_cat);
		while ($row_cat = mysql_fetch_assoc($result_cat)) {
			echo "<div id='menu_cat'><div id='menu_item'>" . $row_cat['name'] . "</div></div><div id='menu_izq'><ul>";
			$query_menu = "SELECT * FROM menuizq WHERE menuizq.id_cat = '" . $row_cat['id_cat'] . "' AND menuizq.menu_type <> '3' ORDER BY menuizq.peso ASC;";
			$result_menu = mysql_query($query_menu);
			while ($row_menu = mysql_fetch_assoc($result_menu)) {
				switch($row_menu['menu_type']) {
				case 0: echo "<li onclick=\"document.location='" . $row_menu['link'] . "';\">" . $row_menu['name'] . "</li>";
					break;
				case 1: echo "<li id='menuizqlink' id_izq='" . $row_menu['id_menu'] ."' id='contentlink'>" . $row_menu['name'] ."</li>";
					break;
				case 2: echo "<li id='applicationlink' applicationsource='" . $row_menu['applicationsource'] . "'>" . $row_menu['name'] . "</li>";
					break;
				}
			}
			echo "</ul></div>";
		}
	}
}

class news {
	public function ShowNews(){
		$mysql = new mysql();
		$link = $mysql->connect();
		$query = "SELECT * FROM news ORDER BY news.fecha DESC;";
		$result = mysql_query($query);
		$i = 0;
		$MAX_NEWS_PREVIEW = 10;
		if (mysql_num_rows($result) != 0) {
			while(($row = mysql_fetch_assoc($result)) && ($i++ < $MAX_NEWS_PREVIEW)) {
				echo "<div id='news'>
					<div id='newtitle'> <h1>&nbsp;&nbsp;<a id='newslink' idname='" 
					. $row['id'] . "' href='news.php?idname=" 
					. $row['id'] .
					"'>"
					. $row['title'] .
					"</a></h1></div>
					<div id='newscontent'>"
					. $row['content'] .
					"</div>
					<div id='newsdate'>" . $row['fecha'] . "</div>
					</div>";
			}
		} else echo "<center>No existe ninguna noticia aun.</center>";
	}
	public function getNews($idname) {
		$mysql = new mysql();
		$link = $mysql->connect();
		$query = "SELECT * FROM news WHERE news.id='" . $idname ."';";
		$result = mysql_query($query);
		if (mysql_num_rows($result) != 0) {
			$row = mysql_fetch_assoc($result);
			echo "<div id='news'>
				<div id='newtitle'><h1><center>"
				. $row['title'] .
				"</center></h1></div>";
			echo "<div id='newscontent'>"
				. $row['content'] .
				"</div>
				<div id='newsdate'>"
				. $row['fecha'] . "</div>
				</div>";
		} else {
			echo "<center>No existe ninguna noticia con ese ID, posiblemente ha sido eliminada.</center>";
		}
	}
}

class html {
	public function Showloginform() {
		echo "	Rellena los siguientes campos
			<form id=\"login\" method=\"POST\" action=\"login.php\">
			<p>Usuario: <input type=\"text\" name=\"user\" id=\"user\" size=\"15\" /></p>
			<p>Contrase&ntilde;a: <input type=\"password\" name=\"passwd\" id=\"passwd\" size=\"15\" /></p>
			<p><input type=\"submit\" style=\"visibility:hidden;\" name=\"enviar\" id=\"enviar\" value=\"LogIn\" /></p>
			</form>
		";
	}
	public function Errormsg($e) {
		echo "<html>
		<head>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"fye.css\" />
		</head>
		<body class=\"indexbody\">
		<div id=\"contentbody\">
			<div id=\"topimg\">
				Version 0.7.10 Copyleft Luis cassih
			</div>
		<div align=\"center\" style=\"margin-left:40%;\" ><center>
			<br>
			<div style=\"float:left;\"> <img src=\"images/errorcontentizq.png\" /></div>
			<div style=\"float:left;\" id=\"errorcontent\"><p style=\"margin-top:30%\">$e</p></div>
			<div style=\"float:left;\"><img src=\"images/errorcontentder.png\" /></div>
			</div>
		</div>
		</body>
		</html>";
		}
}
?>
