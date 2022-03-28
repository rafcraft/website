<?php
	
	session_start();

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

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Language" content="pl" />
	<meta http-equiv="Content-type" content="text/html" charset="UTF-8" name="autor" content="Paweł Mikolik"/>
	<link rel="stylesheet" href="css/arkusz.css">
	<link rel="stylesheet" href="css/arkuszKoszyk.css">
	<script src="js/skrypty.js" type="text/javascript" ></script>
	<script src="https://kit.fontawesome.com/3fe16e504a.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<title>Historia lotów kosmicznych</title>
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
			<a href="Shopping_Cart.php?idp=koszyk" title="koszyk">koszyk</a>
			<a href="javascript:void(0);" class="icon" onclick="funkcja()">
			<i class="fa fa-bars"></i></a>
		</div>
	</div>
	<section>
		<div class="rakieta">
			<i class="fa fa-rocket" aria-hidden="true"></i>
		</div>
	</section>
	<div id="koszyk">
	<?php
	$r = mysqli_query($con, "SELECT * FROM `produkty`");
	while($row = mysqli_fetch_assoc($r))
	{?>
	<div id="blokmain">
		<div>
		<img class="obrazek" src="<?=$row['zdjecie']?>">
		</div>
		<div class="blokszczegoly">
			<h4><?=$row['tytul']?></h4>
			<p id="paragraf">Opis:</p>
			<p><?=$row['opis']?></p>
			<p style="margin-left:110px;">Data wygaśnięcia produktu:<br/><?=$row['data_wygasniecia']?></p>
			<b><p class="cena"><?=$row['cena_netto']?> zł</p></b>
			<input type="submit" name="dodaj" class="addCar" value="Dodaj do koszyk" href="Shopping_Cart.php?action=dodaj_produkt&id=<?=$row['id']?>&tytul=<?=$row['tytul']?>&ilosc=1&cena=<?=$row['cena_netto']?>"></input>
		</div>
	</div>
	<?php }	?>
		<div id="Shopping_Cart">
			<h5>Koszyk</h5>
			<?php 
          $sum=0;
          if(isset($_SESSION['koszykProduktow'])) { ?>
			<table id="tabela">
			<form method="POST" action="Shopping_Cart.php">
              <thead>
                 <th>Produkty</th>
                 <th>Ilość</th>
                 <th>Cena</th>
                 <th>Opcje</th>
              </thead>
              <tbody>
                <?php
                $index =0;
                $i=1;
                foreach($_SESSION['koszykProduktow'] as $key => $val) { 
					$vat = $val['podatek_vat'];			
					$total = $val['ilosc'] * ($val['cena_netto'] * ($vat / 100 ));
					$sum = $sum + $total;
                ?>            
                <tr>
                   <td><?=$i++?></td> 
                   <td><?=$val['tytul']?></td> 
                   <td><?=$val['ilosc']?></td>  
                   <td><?=$total?></td> 
                   <td><a href="Shopping_Cart.php?action=usun_produkt&index=<?=$key?>">Usuń</a></td>
                </tr>
              <?php $index++; } ?>
              <tr>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><?=$sum?></td>
                <td></td>
              </tr>
              </tbody>
			</form>
			</table>
        <?php } ?>
		</div>	
	</div>
</body>
</html>