<style>
table
{
	margin-left: 41%;
}

table > tr, td, th
{
	margin-left: 5px;
	font-size: 19px;
	width: 80px;
}

.tekst
{
	text-align: center;
	font-size:25px;
}

.tabelalistastron
{
	margin-left: 39%;
	border: 1px solid black;
	width:400px;
}

.tabelalistastron2
{
	border: 1px solid black;
	margin-left:43%;
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

	session_start();
	include "../cfg.php";

@$id = $_GET['id'];
@$tmp = $_REQUEST['tmp']; //zmienna pomocnicza
@$matka = $_POST['matka'];
@$nazwa = $_POST['nazwa'];

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) 
	{
		echo '<a href="wylogowanie.php">&lt;&lt; Wyloguj</a><br/><br/>';
		echo '<a style="text-align:center;" href="../admin/admin.php">Przejście do strony zarządzania panelem</a><br/>';
		echo '<a style="text-align:center;" href="../admin/produkty.php">Przejście do strony zarządzania produktami</a>';
		echo '<br/><br/>';
		echo '<br/><br/>';
		echo '<hr></hr>';
		echo '<p class="tekst" style="text-align:center;">Zarządzanie kategoriami</p>';
		echo PokazKategorie();
		echo '<br/><br/>';
		echo '<hr></hr>';
		echo DodajKategorie();
		if(isset($tmp) && $tmp == "edit2") // pentla sprawdza czy zmienna tmp jest taka sama jak "edit" jezeli tak to wywołuje funkcję EdytujPodstrone
		{
			echo '<hr></hr>';
			echo '<p class="tekst">Edytowanie kategorii</p>';
			echo Edytujkategorie($tmp);
		}
	}

	//funkcja sprawdza jeżeli sesja logowania nie jest "zalogowany" to wyświetla sie formularz
	if ((!isset($_SESSION['zalogowany']))) 
	{
		echo '<a href="../admin/admin.php">&lt;&lt; Wróć</a>';
		echo FormularzLogowania();
		
	}
	
	
	
/*********************************************/
/*		Funkcje do zarządzania kategoriami	 */
/*********************************************/

/*********************************************/

/*********************************************/
/*		Funkcja do wyświetlania kategorii	 */
/*********************************************/

function PokazKategorie()
{
	include '../cfg.php';
	
	$wyn = mysqli_query($con, "SELECT * FROM `kategorie`");
	echo '
		<table class="tabelalistastron">
		<tr>
			<th>ID</th>
			<th>Matka</th>
			<th>Nazwa</th>
			<th>Edycja</th>
		</tr>';
		
		//pętla przechodzi po całej bazie i wyświetla wszystko po kolei
		while($r = mysqli_fetch_array($wyn))
		{
			echo "
			<table class='tabelalistastron'>
			<tr><th>".$r["id"]."</th>
			<th>".$r["matka"]."</th>
			<th>".$r["nazwa"]."</th>
			<th><a href='categories.php?id={$r['id']}&amp;tmp=del2'>Usuń</a>
			<br/><a href='categories.php?id={$r['id']}&amp;tmp=edit2'>Edytuj</a></th>
			</tr>
			</table>";
		}
}
	
/*********************************************/
/*		 Funkcja do dodawania kategorii		 */
/*********************************************/
	
function DodajKategorie()
{
	include '../cfg.php';
	
	$wyn = mysqli_query($con, "SELECT MAX(id) FROM `kategorie`"); //Zapytanie przechowywane w zmiennej
	$mfa = mysqli_fetch_array($wyn);
	$wyn2 = mysqli_query($con, "SELECT `id` FROM `kategorie` WHERE matka=0"); //Zapytanie przechowywane w zmiennej
	
	$addnew = "<option value='0'></option>"; //Dodanie nowej kategorii
	
	while($r = mysqli_fetch_array($wyn2, MYSQLI_ASSOC))
	{
		$addnew .= '<option value="'.$r['id'].'">'.$r['id'].'</option>';
	}
	echo '<p class="tekst">Dodawanie kategorii</p>';
	echo ' 
	<form action="categories.php" method="POST">
	<table>
		<input type="hidden" name="tmp" value="new2">
		<tr class="separate">
			<td>Matka:</td>
			<td><select name="matka" required>'.$addnew.'</select></td>
		</tr>
		<tr class="separate">
			<td>Nazwa:</td>
			<td><input name="nazwa" required></td>
		</tr>
		<tr class="separate">
			<td colspan="2"><input class="przyciski" type="submit" name="Submit" value="Dodaj"></td>
		</tr>
	</table>
	</form>';
}



function addkategorie($matka, $nazwa)
{
	include '../cfg.php';
	
	//Pętla sprawdzenie czy pola nie są puste jeżeli są puste to zwróci informacje "Nie dodano strony"
	if(($matka!="") && ($nazwa!=""))
	{		
		mysqli_query($con, "INSERT INTO `kategorie` VALUES ('', '$matka', '$nazwa')"); //Dodanie do bazy nowego rekordu
		echo 'Kategoria została dodana';
	}
	else
	{
		echo "Nie dodano nowej kategorii";
	}
	header("Location: categories.php");
	exit();
}



function Usunkategorie($id, $tmp)
{
	include '../cfg.php';
	$id_clear = htmlspecialchars($id);
	
	// Pętla sprawdza czy tmp jest takie samo jak "del" jezeli tak to jest usuwany konkretny rekord z bazy
	if($tmp == "del2")
	{
		mysqli_query($con, "DELETE FROM `kategorie` WHERE id=$id_clear LIMIT 1");
		mysqli_query($con, "ALTER TABLE `kategorie` AUTO_INCREMENT=1");
		header("Location: categories.php");
		exit();
	}
}



function Edytujkategorie($tmp)
{
	include '../cfg.php';
	$id = $_GET['id'];
	$id_clear = htmlspecialchars($id);
	
	//Pętla sprawdza czy tmp jest takie samo jak "edit" jezeli tak to przechodzi do zapytania które wyciąga informacje z bazy
	if($tmp == "edit2")
	{
		$wyn = mysqli_query($con, "SELECT * FROM `kategorie` WHERE id = $id_clear LIMIT 1");
		$wyn2 = mysqli_query($con, "SELECT MAX(id) FROM `kategorie`");
		$mfa = mysqli_fetch_array($wyn2);
		if(mysqli_num_rows($wyn)>0)
		{
			$r = mysqli_fetch_assoc($wyn);
			echo ' 
			<form action="categories.php" method="POST">
			<table class="tabelalistastron2">
				<input type="hidden" name="tmp" value="Editkt">
				<input type="hidden" name="id" value="'.$id_clear.'">
				<tr class="separate">
					<td>Matka</td>
				</tr>
				<tr class="separate">
					<td><input type="number" name="matka" min="0" max="'.$mfa[0].'" value="'.$r['matka'].'" required></td>
				</tr>
				<tr class="separate">
					<td>Nazwa</td>
				</tr>
				<tr class="separate">
					<td><input type="text" name="nazwa" value="'.$r['nazwa'].'" required></td>
				</tr>
				<tr class="separate">
					<td colspan="2"><input class="przyciski" type="submit" value="Edytuj"></td>
				</tr>
			</table>
			</form>';
		} 
	}
}

function editkategorie($matka, $name)
{
	include "../cfg.php";
	$id = $_POST['id'];
	$id_clear = htmlspecialchars($id);
	
	mysqli_query($con, "UPDATE `kategorie` SET matka='$matka', nazwa='$nazwa' WHERE id='$id_clear' LIMIT 1");
	header("Location:categories.php");
	exit();

}

	
	/*************************************************/
	/* Funkcje pomocnicze do zarządzania kategoriami */
	/*************************************************/

	
	if(isset($tmp) && $tmp == "Editkt")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "EditPg" jezeli tak to wywołuje funkcję editPage
	{
		editkategorie($matka, $nazwa);
	}
	
	if(isset($tmp) && $tmp == "new2")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "new" jeżeli tak to wywołuje funkcje addPage
	{
		addkategorie($matka, $nazwa);
	}
	
	if(isset($tmp) && $tmp == "del2")	//Pętla sprawdza czy zmienna tmp jest taka sama jak "del2" jeżeli tak to wywołuje funkcje Usunkategorie
	{
		Usunkategorie($id, "del2");
	}

	if(isset($_SESSION['error']))	echo $_SESSION['error'];
	
	ob_end_flush();
	mysqli_close($con);
?>