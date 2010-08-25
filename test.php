<!-- 
* @author Luis Cassih
* @Version: 0.7.10
*-->
<!DOCTYPE html>
<html>
<head>
<script src="scripts/jquery-1.4.2.min.js"></script>
<script src="scripts/fyescripts.js"></script>
<link rel="stylesheet" type="text/css" href="fye.css"></link>
</head>
<body class="indexbody">
<div id="header">
	<div id="topimg">
		Version 0.7.10 - Copyleft E.E.S.T. N&deg; 1 Bme Mitre Pergamino
	</div>
	
	<div id="userinfoUI">
		<div style="float:both; height:99px; margin-left:40px;">
			<div style="float:left;"><img src="images/logo.png"></img></div>
			<div style="float:left; margin-top:30px;"><img src="images/name.png"></img></div>
		</div>
		<div id="userinfo">
			<div style="float:left;"><?php include "userinfo.php";?></div>
		</div>
	</div>
	<div id="menutopcontent">
		<div> <img src="images/minimenuizq.png" /></div>
		<div id="menutopbg">
			<ul>
				<li><a href=# id="contentlink" idname="">Noticias</a>&nbsp;</li>
				<?php $topmenu = new topmenu(); $topmenu->ShowMenu(); ?></ul>
		</div>
		<div> <img src="images/minimenuder.png" /></div>
	</div>
</div>
<div id="footer">
	<div id="menuizq">Iz</div>
	<div id="content">
		<?php include "getcontent.php"; ?>
	</div>
</div>
</body>
</html>
