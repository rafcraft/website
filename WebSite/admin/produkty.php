<style>

table > tr, td, th
{
	font-size: 19px;
	width: 120px;
	overflow:hidden;
	border: solid 1px black;
	text-align:center;
}

.tabelalistastron
{
	margin-left:3%;
	width:auto;
}

.tekst
{
	text-align: center;
	font-size:25px;
}

.tabelalistastron2
{
	border: 1px solid black;
	margin-left:40%;
}

a
{
	text-decoration: none;
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
    margin-left: 50px;
}

.separate
{
	margin-top: 20px;
}
</style>
<?php

	ob_start();
	session_start();
	include "../cfg.php";

$data=date("Y-m-d H:i:s");
@$tmp = $_REQUEST['tmp']; //zmienna pomocnicza
@$id = $_GET['id'];
@$tytul = $_POST['tytul'];
@$opis = $_POST['opis'];
@$data_utworzenia = $_POST['data_utworzenia'];
@$data_modyfikacji = $_POST['data_modyfikacji'];
@$data_wygasniecia = $_POST['data_wygasniecia'];
@$cena_netto = $_POST['cena_netto'];
@$podatek_vat = $_POST['podatek_vat'];
@$ilosc_dostepnych = $_POST['ilosc_dostepnych'];
@$status_dostepnosc = $_POST['status_dostepnosc'];
@$kategoria = $_POST['kategoria'];
@$gabaryt_produktu = $_POST['gabaryt_produktu'];
@$zdjecie = $_POST['zdjecie'];

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) 
	{
		echo '<a href="wylogowanie.php">&lt;&lt; Wyloguj</a><br/><br/>';
		echo '<a style="text-align:center;" href="../admin/admin.php">Przejście do strony zarządzania panelem</a></br>';
		echo '<a style="text-align:center;" href="../admin/categories.php">Przejście do strony zarządzania kategoriami</a>';
		echo '<br/><br/>';
		echo '<hr></hr>';
		echo '<p class="tekst" style="text-align:center;">Zarządzanie produktami</p>';
		echo listaProduktow();
		echo '<br/><br/>';
		echo '<hr></hr>';
		echo Dodajprodukt();

		//Warunek sprawdza czy jest wciśnięta edycja jeżeli tak to pętla sprawdza czy zmienna tmp jest taka sama jak "edit" jezeli tak to wywołuje funkcję EdytujPodstrone
		if(isset($tmp) && $tmp == "edit")
		{
			echo '<hr></hr>';
			echo '<p class="tekst">Edytowanie produktów</p>';
			echo Edytujprodukt($tmp);
		}
	}

	//funkcja sprawdza jeżeli sesja logowania nie jest "zalogowany" to wyświetla sie formularz
	if ((!isset($_SESSION['zalogowany']))) 
	{
		echo '<a href="../admin/admin.php">&lt;&lt; Wróć</a>';
		echo FormularzLogowania();
		
	}
	
	
	
/*********************************************/
/*		Funkcje do zarządzania produktami	 */
/*********************************************/

/*********************************************/

/*********************************************/
/*		Funkcja do wyświetlania produktów	 */
/*********************************************/

function listaProduktow()
{
	include '../cfg.php';
	
	$wyn = mysqli_query($con, "SELECT * FROM `produkty`");
	echo '
		<table class="tabelalistastron">
		<tr>
			<th>ID</th>
			<th>Tytul</th>
			<th>Opis</th>
			<th>Data utworzenia</th>
			<th>Data modyfikacji</th>
			<th>Data wygasniecia</th>
			<th>Cena_netto</th>
			<th>Vat</th>
			<th>Dostepnych</th>
			<th>Dostepność</th>
			<th>kategoria</th>
			<th>Gabaryt</th>
			<th style="width:172px;">Zdjęcie</th>
			<th style="width:120px;">Edycja</th>
		</tr>';
		
		//pętla przechodzi po całej bazie i wyświetla wszystko po kolei
		while($r = mysqli_fetch_array($wyn))
		{
			echo "
			<table class='tabelalistastron'>
			<tr>
			<th style='width:120px;'>".$r["id"]."</th>
			<th style='width:120px;'>".$r["tytul"]."</th>
			<th style='width:120px;'>".$r["opis"]."</th>
			<th style='width:120px;'>".$r["data_utworzenia"]."</th>
			<th style='width:120px;'>".$r["data_modyfikacji"]."</th>
			<th style='width:120px;'>".$r["data_wygasniecia"]."</th>
			<th style='width:120px;'>".$r["cena_netto"]."</th>
			<th style='width:120px;'>".$r["podatek_vat"]."</th>
			<th style='width:120px;'>".$r["ilosc_dostepnych"]."</th>
			<th style='width:120px;'>".$r["status_dostepnosc"]."</th>
			<th style='width:120px;'>".$r["kategoria"]."</th>
			<th style='width:120px;'>".$r["gabaryt_produktu"]."</th>
			<th style='width:120px;'>".$r["zdjecie"]."</th>
			<th style='width:120px;'>
			<a href='produkty.php?id={$r['id']}&amp;tmp=del'>Usuń</a>
			<br/>
			<a href='produkty.php?id={$r['id']}&amp;tmp=edit'>Edytuj</a></th>
			</tr>
			</table>";
		}
}
	
/*********************************************/
/*		 Funkcja do dodawania produktów		 */
/*********************************************/
	
function Dodajprodukt()
{
	include '../cfg.php';
	
	$wyn = mysqli_query($con, "SELECT id, nazwa, matka FROM `kategorie` WHERE matka=0"); //Zapytanie przechowywane w zmiennej które wypisuje zawartość tabeli
	$kt = "";
	
	while($r = mysqli_fetch_array($wyn))
	{
		$kt .= '<optgroup label="'.$r['nazwa'].'">';
		$wyn2 = mysqli_query($con, "SELECT * FROM `kategorie` WHERE matka=".$r['id']."");
		while($r2 = mysqli_fetch_array($wyn2, MYSQLI_ASSOC))
		{
			$kt .= '<option value="'.$r2['id'].'">'.$r2['nazwa'].'</option>';
		}
		$kt .= '</optgroup>';
	}
	$today = date('Y-m-d\TH:i');
	
	echo '<p class="tekst">Dodawanie produktu</p>';
	echo ' 
	<form action="produkty.php" method="POST">
	<table class="tabelalistastron2">
		<input type="hidden" name="tmp" value="new">
		<tr class="separate">
			<td>Kategoria</td>
			<td><select name="kategoria" required>'.$kt.'</select></td>
		</tr>
		<tr class="separate">
			<td>Tytuł</td>
			<td><input name="tytul" required></td>
		</tr>
		<tr class="separate">
			<td>Opis</td>
			<td><textarea name="opis" required></textarea></td>
		</tr>
		<tr>
			<td> Data wygaśnięcia </td> 
			<td> <input type="datetime-local" step="1" min="'.$today.'" name="data_wygasniecia" required></td>
		</tr>
		<tr>
			<td> Cenna netto zł </td> 
			<td> <input type="number" step="0.01" name="cena_netto" required></td>
		</tr>
		<tr>
			<td> VAT: </td> 
			<td><select name="podatek_vat" required>
				<option value="0%">0%</option>
				<option value="8%">8%</option>
				<option value="23%">23%</option></select>
			</td>
		</tr>
		<tr>
			<td> Ilość dostępnych </td> 
			<td> <input type="number" min="0" name="ilosc_dostepnych" required></td>
		</tr>
		<tr>
			<td> Dostępny: </td> 
			<td> <input type="checkbox" name="status_dostepnosc"></td>
		</tr>
		<tr>
			<td> Gabaryt </td> 
			<td> <input type="number" step="0.1" name="gabaryt_produktu" required></td>
		</tr>
		<tr>
			<td> Zdjęcie </td> 
			<td> <input type="text" name="zdjecie"></td>
		</tr>
		<tr class="separate">
			<td colspan="2"><input class="przyciski" type="submit" name="Submit" value="Dodaj"></td>
		</tr>
	</table>
	</form>';
}

function addprodukt($tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych, $status_dostepnosc, $kategoria, $gabaryt_produktu, $zdjecie, $data)
{
	include '../cfg.php';
	
	//Pętla sprawdzenie czy pola nie są puste jeżeli są puste to zwróci informacje "Nie dodano strony"
	if(($tytul!="") && ($opis!="") && ($data_wygasniecia!="") && ($cena_netto!="") && ($podatek_vat!="") && ($ilosc_dostepnych!="") && ($status_dostepnosc!="") && ($kategoria!="") && ($gabaryt_produktu!="") && ($data!=""))
	{		
		mysqli_query($con, "INSERT INTO `produkty` VALUES ('', '$tytul', '$data', '$data', '$opis', '$data_wygasniecia', '$cena_netto', '$podatek_vat', '$ilosc_dostepnych', '$status_dostepnosc', '$kategoria', '$gabaryt_produktu', '$zdjecie')"); //Dodanie do bazy nowego rekordu
		echo 'Produkt został dodany';
	}
	else
	{
		echo "Nie dodano nowego produktu";
	}
	header("Location: produkty.php");
	exit();
}

function Usunprodukt($id, $tmp)
{
	include '../cfg.php';
	$id_clear = htmlspecialchars($id);
	
	// Pętla sprawdza czy tmp jest takie samo jak "del" jezeli tak to jest usuwany konkretny rekord z bazy i auto numeracja jest jest resetowana do ostatniego najwyższego id to pozwala na pozbycie kontynuacji zliczania gdzie np. rekord ma numer id=6 usuwamy go a auto numeracja wstawia nam id=7 więc dzięki zapytaniu "ALTER TABLE `produkty` AUTO_INCREMENT=1" resetuje nam numeracje gdzie juz jak usuniemy rekord gdzie id=6 i dodamy to auto numeracja zacznie od 6 a nie 7  
	if($tmp == "del")
	{
		mysqli_query($con, "DELETE FROM `produkty` WHERE id=$id_clear LIMIT 1");
		mysqli_query($con, "ALTER TABLE `produkty` AUTO_INCREMENT=1");
		header("Location: produkty.php");
		exit();
	}
}

function Edytujprodukt($tmp)
{
	include '../cfg.php';
	$id = $_GET['id'];
	$id_clear = htmlspecialchars($id);
	
	//Pętla sprawdza czy tmp jest takie samo jak "edit" jezeli tak to przechodzi do zapytania które wyciąga informacje z bazy
	if($tmp == "edit")
	{
		$wyn = mysqli_query($con, "SELECT * FROM `produkty` WHERE id = $id_clear LIMIT 1");
		$r = mysqli_fetch_assoc($wyn);
		
		$wyn2 = mysqli_query($con, "SELECT status_dostepnosc FROM `produkty`");
		$mfa = mysqli_fetch_array($wyn2);
		
		$wyn3 = mysqli_query($con, "SELECT id, nazwa, matka FROM `kategorie` WHERE matka=0");
		$kt = "";
		
		while($r2 = mysqli_fetch_array($wyn3))
		{
			$kt .= '<optgroup label="'.$r2['nazwa'].'">';
			$wyn4 = mysqli_query($con, "SELECT * FROM `kategorie` WHERE matka=".$r2['id']."");
			
			while($r3 = mysqli_fetch_array($wyn4))
			{
				$bierzaca_kat =($r['kategoria'] == $r3['id'] ? "selected" : "");
				$kt .= '<option value="'.$r3['id'].'" '.$bierzaca_kat.'>'.$r3['nazwa'].'</option>';
			}
			$kt .= '</optgroup>';
		}
		
		if(mysqli_num_rows($wyn)>0)
		{
			
			$c = ($r['status_dostepnosc'] == 1 ? 'checked' : '');
			$today = date('Y-m-d\TH:i');
			
			echo ' 
			<form action="produkty.php" method="POST">
			<table class="tabelalistastron2">
			<input type="hidden" name="tmp" value="Editprodukt">
			<input type="hidden" name="id" value="'.$id_clear.'">
			<tr class="separate">
				<td>Kategoria</td>
				<td><select name="kategoria" required>'.$kt.'</select></td>
			</tr>
			<tr class="separate">
				<td>Tytuł</td>
				<td><input name="tytul" value="'.$r['tytul'].'" required></td>
			</tr>
			<tr class="separate">
				<td>Opis</td>
				<td><textarea name="opis" required>'.$r['opis'].'</textarea></td>
			</tr>
			<tr>
				<td> Data wygaśnięcia </td> 
				<td> <input type="datetime-local" step="1" min="'.$today.'" name="data_wygasniecia" required>obecna data:'.$r['data_wygasniecia'].'</input></td>
			</tr>
			<tr>
				<td> Cenna netto zł </td> 
				<td> <input type="number" step="0.01" name="cena_netto"  value='.$r['cena_netto'].' required></td>
			</tr>
			<tr>
				<td> VAT: </td> 
				<td><select name="podatek_vat" required>
				<option value="0%">0%</option>
				<option value="8%">8%</option>
				<option value="23%">23%</option>
				</select></td>
			</tr>
			<tr>
				<td> Ilość dostępnych </td> 
				<td> <input type="number" min="0" name="ilosc_dostepnych"  value='.$r['ilosc_dostepnych'].' required></td>
			</tr>
			<tr>
				<td> Dostępny: </td> 
				<td> <input type="checkbox" value="1" '.$c.' name="status_dostepnosc"></td>
			</tr>
			<tr>
				<td> Gabaryt </td> 
				<td> <input type="number" step="0.1" value="'.$r['gabaryt_produktu'].'" name="gabaryt_produktu" required></td>
			</tr>
			<tr>
				<td> Zdjęcie </td> 
				<td> <input type="text" value="'.$r['zdjecie'].'" name="zdjecie"></td>
			</tr>
			<tr class="separate">
				<td colspan="2"><input class="przyciski" type="submit" name="Submit" value="Dodaj"></td>
			</tr>
			</table>
			</form>';
		} 
	}
}

function editprodukty($tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych, $status_dostepnosc, $kategoria, $gabaryt_produktu, $zdjecie, $data)
{
	include "../cfg.php";
	$id = $_POST['id'];
	$id_clear = htmlspecialchars($id);
	
	mysqli_query($con, "UPDATE `produkty` SET tytul='$tytul', opis='$opis', data_modyfikacji='$data', data_wygasniecia='$data_wygasniecia', cena_netto='$cena_netto', podatek_vat='$podatek_vat', ilosc_dostepnych='$ilosc_dostepnych', status_dostepnosc='$status_dostepnosc', kategoria='$kategoria', gabaryt_produktu='$gabaryt_produktu', zdjecie='$zdjecie' WHERE id='$id_clear' LIMIT 1");
	header("Location:produkty.php");
	exit();

}

	/*************************************************/
	/* 			warunki pomocnicze do produktów		 */
	/*************************************************/
	
	if(isset($tmp) && $tmp == "Editprodukt")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "Editprodukt" jezeli tak to wywołuje funkcję editprodukty
	{
		editprodukty($tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych, $status_dostepnosc, $kategoria, $gabaryt_produktu, $zdjecie, $data);
	}
	
	if(isset($tmp) && $tmp == "new")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "new" jeżeli tak to wywołuje funkcje addprodukt
	{
		addprodukt($tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych, $status_dostepnosc, $kategoria, $gabaryt_produktu, $zdjecie, $data);
	}
	
	if(isset($tmp) && $tmp == "del")	//Pętla sprawdza czy zmienna tmp jest taka sama jak "del" jeżeli tak to wywołuje funkcje Usunprodukt
	{
		Usunprodukt($id, "del");
	}

	if(isset($_SESSION['error']))	echo $_SESSION['error'];
	
	ob_end_flush();
	mysqli_close($con);
?>