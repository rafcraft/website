<?php
	$dbhost = 'localhost'; //adres do bazy danych
	$dbuser = 'root'; //uprawnienie do bazy danych 
	$dbpass = ''; //hasło do bazy danych 
	$baza = 'moja_strona'; // nazwa bazy
	$login = 'admin'; //login do logowania sie w panelu CMS
	$passwordLog = 'admin'; //haslo do logowania sie w panelu CMS
	
	/************************************************/
	/*		Skrypt połączenia się z bazą danych		*/
	/*		zwrócenie błędu podłączenia do bazy		*/
	/************************************************/
	
	$con = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);
	if($con->connect_error){
		die("Połączenie nieudane: " . $con->connect_error);
	}	
?>