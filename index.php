<!-- 
* @author Luis Cassih
* @Version: 0.7.10
*-->
<!DOCTYPE html>
<html>
<head>
<script src="scripts/jquery-1.4.2.min.js"></script>
<script src="scripts/fyescripts.js"></script>
<link rel="stylesheet" type="text/css" href="fye.css" />
<title>E.E.S.T. N&deg; 1 Bme Mitre Pergamino </title>
</head>
<body class="indexbody">
<div id="header">
	<div id="topimg">
		Version 0.7.10 - Copyleft E.E.S.T. N&deg; 1 Bme Mitre Pergamino
	</div>
	
	<div id="userinfoUI">
		<div style="float:both; height:99px; margin-left:40px;">
			<div style="float:left;"><img src="images/logo.png" /></div>
			<div style="float:left; margin-top:30px;"><img src="images/name.png" /></div>
		</div>
		<div id="userinfo">
			<div style="float:left;"><?php include "userinfo.php";?></div>
		</div>
	</div>
	<div id="menutopcontent">
		<div id="menutopbg">
			<ul>
				<li id="contentlink" idname=""><div id='menutoplink'><a href=#>Noticias</a>&nbsp;</div></li>
				<?php $topmenu = new topmenu(); $topmenu->ShowMenu(); ?></ul>
		</div>
	</div>
</div>
<div id="footer">
	<div id="menuizq"><?php $menuizq = new menuizq(); $menuizq->ShowMenu(); ?></div>
	<div id="content">
		<?php include "getcontent.php"; ?>
	</div>
</div>
</body>
</html>
