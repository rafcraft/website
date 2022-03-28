<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Language" content="pl" />
	<meta http-equiv="Content-type" content="text/html" charset="UTF-8" name="autor" content="Paweł Mikolik"/>
	<link rel="stylesheet" href="css/arkusz.css">
	<script src="js/skrypty.js" type="text/javascript" ></script>
	<script src="https://kit.fontawesome.com/3fe16e504a.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<title>Historia lotów kosmicznych</title>
<?php
	include 'showpage.php';
	include 'cfg.php';
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		if($_GET['idp'] == 'glowna')$strona = '1';
		if($_GET['idp'] == 'usa')$strona = '2';
		if($_GET['idp'] == 'zsrr')$strona = '3';
		if($_GET['idp'] == 'chiny')$strona = '4';
		if($_GET['idp'] == 'kontakt')$strona = '5';
		if($_GET['idp'] == 'filmy')$strona = '6';
		
		$strona = PokazPodStrone($strona);
?>
</head>
<body>
	<div id="lepki" onscroll="scroll()">
		<div class="nav" id="nav" href="javascript:void(0);">
			<a href="index.php?idp=glowna" title="strona główna" class="active">Strona główna</a>
			<a href="index.php?idp=usa" title="USA">USA</a>
			<a href="index.php?idp=zsrr" title="ZSRR">ZSRR</a>
			<a href="index.php?idp=chiny" title="Chiny">Chiny</a>
			<a href="contact.php?idp=kontakt" title="Kontakt">Kontakt</a>
			<a href="index.php?idp=filmy" title="filmy">filmy</a>
			<a href="koszyk.php?idp=koszyk" title="koszyk">koszyk</a>
			<a href="javascript:void(0);" class="icon" onclick="funkcja()">
			<i class="fa fa-bars"></i></a>
		</div>
	</div>
	<section>
		<div class="rakieta">
			<i class="fa fa-rocket" aria-hidden="true"></i>
		</div>
	</section>
	<div class="kontent">
		<?php
			if($strona == '[nie_znaleziono_strony]')
				echo '<div style="text-align: center;"><b> STRONA NIE ZNALEZIONA </b></div><br>';
			else echo $strona;
		?>
	</div>
</body>
</html>