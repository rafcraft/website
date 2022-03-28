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
<style>
table
{
	margin-left: 43%;
}

table > tr, td, th
{
	margin-left: 5px;
	font-size: 19px;
	width: 80px;
}

p
{
	text-align: center;
}

.przyciski
{
	border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    font-size: 15px;
    height: 50px;
    width: 120px;
    margin-top: 20px;
    margin-left: -80px;

}

.contact
{
	text-align: center;
	margin: auto;
	font-weight: bold;
	margin-left: 45%;
	margin-right: auto;
}

.tekst
{
	text-align: center;
	font-size: 25px;
	margin-left: 200px;
}
</style>
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
			<!-- index.php?idp=kontakt zmienić na kontakt.php !-->
			<a href="index.php?idp=filmy" title="filmy">filmy</a>
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
	include 'cfg.php';
	
@$tmp = $_REQUEST['tmp'];
	
	if (isset($tmp) && $tmp=="Submit_x1")
	{
		echo PrzypomnijHaslo();
	}
	else
	{
		echo WyslijMailKontakt();
		echo formularzprzypomnijhaslo();
	}

function PokazKontakt()
{
	echo '<p class="tekst">Kontakt</p>';
	echo '<form method="POST">
		<table class="contact">
		<tr>
			<td><p>Podaj adres e-mail<p></td>
		</tr>
		<tr>
			<td><input type="email" name="e_mail" style="width:250px;" required/></td>
		</tr>
		<tr>
			<td><p>Podaj tutuł Wiadomości<p></td>
		</tr>
			<td><input type="text" name="title" style="width:250px;" required /><td>
		</tr>		
		<tr>
			<td><p>Podaj treść swojej wiadomości<p></td>
		</tr>
		<tr>
			<td><textarea style="width:250px; height: 150px;" type="text" name="message"></textarea></td>
		</tr>
			<td colspan="2"><input style="margin-left: 3%;" class="przyciski" type="submit" name="Submit" value="Wyślij"></td>
		</tr>
		</table>
		</form>';
}

function WyslijMailKontakt() // wyślij mail za pomocą formularza Kontakt na e-mail właściela strony
{ //Przy wyslaniu systepuje spore opóźnienie
	if(empty($_POST['title']) || empty($_POST['message']) || empty($_POST['e_mail']))
	{
		echo PokazKontakt();
	}
	else
	{
		$mail['subject'] = $_POST['title'];
		$mail['sender'] = $_POST['e_mail'];
		$mail['body'] = "Wiadomość od: ".$mail['sender']."\n".$_POST['message'].""; // Dodaj w treść maila od kogo przyszła wiadomość
		$mail['reciptient'] = "email1@localhost";
		
		$header  = "From: Formularz kontaktowy <".$mail['sender'].">\n";
		$header .= "MIME-Version: 1.0\nContent-Type: text/plain; 	charset=utf-8\nContent-Transfer-Encoding";
		$header .= "X-Sender: <".$mail['sender'].">\n";
		$header .= "X=Mailer: PRapWW mail 1.2\n";
		$header .= "X-Priority: 3\n";
		$header .= "Return-Path: <".$mail['sender']. ">\n";
		
		if (filter_var(($mail['sender']), FILTER_VALIDATE_EMAIL)) //Sprawdza czy mail został wpisany poprawnie
		{
			mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
			echo PokazKontakt();
			echo '<p class="tekst" style="color: green;">Wiadomość wysłana<p>';
		} 
		else 
		{
			echo PokazKontakt();
			echo '<p style="text-align: center; color: red; font-size: 20px;">Adres e-mail: '.$mail['sender'].' jest nieprawidłowy<p>';
		}
	}
}

function formularzprzypomnijhaslo()
{
	$wynik =  "<form method='POST'>
		<table class='contact'>
		<input type='hidden' name='tmp' value='Submit_x1'>
		<tr>
			<td><p>Podaj adres e-mail<p></td>
		</tr>
		<tr>
			<td><input type='email' name='xe_mail' style='width:250px;' required/></td>
		</tr>	
		<tr>
			<td colspan='2'><input type='submit' name='X1_Submit' value='Wyślij' class='przyciski' style='margin-left: 3%;'></td>
		</tr>
		</table>
		</form>";
	return $wynik;
}

function PrzypomnijHaslo()
{
	include "cfg.php";
	global $passwordLog;

	if(empty($_POST['xe_mail'])) // Wyświetl pusty formularz PrzypomnijHaslo
	{
		echo formularzprzypomnijhaslo();
	}
	else
	{
		$mail['subject'] = 'Przypomnienie hasła';
		$mail['body'] ="Twoje hasło to : '$passwordLog'";
		$mail['sender'] = 'email1@localhost';
		$mail['reciptient'] = $_POST['xe_mail'];
		
		$header  = "From: Formularz kontaktowy <".$mail['sender'].">\n";
		$header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding";
		$header .= "X-Sender: <".$mail['sender'].">\n";
		$header .= "X=Mailer: PRapWW mail 1.2\n";
		$header .= "X-Priority: 3\n";
		$header .= "Return-Path: <".$mail['sender']. ">\n";
		
		if (filter_var(($mail['reciptient']), FILTER_VALIDATE_EMAIL)) // Sprawdź czy mail został wpisany poprawnie
		{
			mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
			echo formularzprzypomnijhaslo();
			echo '<p class="mess">Hasło zostało wysłane na twój e-mail<p>';
		}
		else
		{
			echo formularzprzypomnijhaslo();
			echo '<p class="error">Adres e-mail: '.$mail['reciptient'].' jest nieprawidłowy<p>';
		}
	}
}
?>
</div>
	<div class="stopka">
		<?php
			$nr_indeksu = '158946';
			$nrGrupy = '4';
			
			echo 'Autor: Paweł Mikolik '.$nr_indeksu.' Grupa '.$nrGrupy.''; 
		?>
	</div>
</body>
</html>