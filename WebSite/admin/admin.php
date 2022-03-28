<style>
.logowanie
{
	font-size: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.log4_t
{
	font-size: 22px;
	color: blue;
}

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

textarea
{
	height: 100px;
	width: 180px;
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

@$id = $_GET['id'];
@$pageTitle = $_POST['pageTitle'];
@$pageContent = $_POST['pageContent'];
@$status = $_POST['status'];
@$tmp = $_REQUEST['tmp']; //zmienna pomocnicza
@$matka = $_POST['matka'];
@$nazwa = $_POST['nazwa'];

//funkcja sprawdza czy sesja jest ustawiona na "zalogowany" jeżeli tak to wyświetli liste podstron i formularz dodawania podstrony 
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) 
	{
		echo '<a href="wylogowanie.php">&lt;&lt; Wyloguj</a><br/><br/>';
		echo '<a style="text-align:center;" href="../admin/categories.php">Przejście do strony zarządzania kategoriami</a><br/>';
		echo '<a style="text-align:center;" href="../admin/produkty.php">Przejście do strony zarządzania produktami</a>';
		echo ListaPodstron(); // wywołanie funkcji która wyświetla rekordy z bazy 
		echo '<br/><br/>';
		echo '<hr></hr>';
		echo DodajNowaPodstrone(); // wywołanie funkcji do dodawania podstrony
		
		if(isset($tmp) && $tmp == "edit") // pentla sprawdza czy zmienna tmp jest taka sama jak "edit" jezeli tak to wywołuje funkcję EdytujPodstrone
		{
			echo '<hr></hr>';
			echo '<p class="tekst">Edytowanie podstrony</p>';
			echo EdytujPodstrone($tmp);
		}
	}

//funkcja sprawdza jeżeli sesja logowania nie jest "zalogowany" to wyświetla sie formularz
	if ((!isset($_SESSION['zalogowany']))) 
	{
		echo '<a href="../admin/admin.php">&lt;&lt; Wróć</a>';
		echo FormularzLogowania();
		
	}
	
function FormularzLogowania()
{
	$wynik = 
	"
	<div class='logowanie'>
	<h1>Logowanie</h1>
		<div class='logowanie'>
			<form action='logowanie.php' method='post' name='LoginForm' enctype='multipart/form-data' action='".$_SERVER['REQUEST_URI']."'>
			<div class='logowanie'>
				<a class='log4_t'>email</a><input type='text' name='login_email' class='logowanie'/>
				<a class='log4_t'>haslo</a><input type='password' name='login_pass' class='logowanie'/>			
				&nbsp;<input style='margin-left: -220px;' type='submit' name='x1_submit' class='logowanie' value='Zaloguj'/>
				<input style='margin-right: -300px; margin-top: -35px; margin-left: -123px;' type='submit' name='x1_submit' class='logowanie' value='Rejestracja'/>
			</div>
			</form>
		</div>
	</div>";
	return $wynik;
}

/*********************************************/
/*		Wyświetlenie podstron z bazy		 */
/*********************************************/

function ListaPodstron()
{
	include "../cfg.php";
	
	$wyn = mysqli_query($con, "SELECT `id`, `page_title` FROM `page_list` WHERE 1");
	echo '
	<p class="tekst">Zarządzanie podstronami</p>
		<table class="tabelalistastron2">
		<tr><th>ID</th>
		<th>Tytul</th>
		<th>Edycja stron</th></tr>';
		
		//pętla przechodzi po całej bazie i wyświetla wszystko po kolei
		while($r = mysqli_fetch_array($wyn))
		{
			echo "
			<table class='tabelalistastron2'>
			<tr><th>".$r["id"]."</th>
			<th>".$r["page_title"]."</th>
			<th><a href='admin.php?id={$r['id']}&amp;tmp=del'>Usuń</a>
			<br/><a href='admin.php?id={$r['id']}&amp;tmp=edit'>Edytuj</a></th>
			</tr>
			</table>";
		}
}

/*********************************************************/
/*	funkcja wyświetlająca formularz podstronia do bazy	 */
/*********************************************************/	

function DodajNowaPodstrone()
{
	echo '<p class="tekst">Dodawanie podstrony</p>';
	echo ' 
	<form action="admin.php" method="POST">
	<table class="addPage">
		<input type="hidden" name="tmp" value="new">
		<tr class="separate">
			<td>Tytuł strony:</td>
			<td><input type="text" name="pageTitle"></td>
		</tr>
		<tr class="separate">
			<td>Zawartoś strony:</td>
			<td><textarea name="pageContent"></textarea></td>
		</tr>
		<tr class="separate">
			<td>Aktywna:</td>
			<td><input type="checkbox" name="status"></td>
		</tr>
		<tr class="separate">
			<td colspan="2"><input class="przyciski" type="submit" name="Submit" value="Dodaj"></td>
		</tr>
	</table>
	</form>';	
}

/*********************************************/
/*	funkcja dowawająca podstrony do bazy	 */
/*********************************************/	

function addPage($pageTitle, $pageContent, $status)
{
	include '../cfg.php';
	
	if(isset($status))
	{
		$status = 1;	
	}
	else
	{	
		$status = 0;
	}
	
	//Pętla sprawdzenie czy pola nie są puste jeżeli są puste to zwróci informacje "Nie dodano strony"
	if(($pageTitle!="") && ($pageContent!="") && ($status!=""))
	{		
		mysqli_query($con, "INSERT INTO `page_list` VALUES ('', '$pageTitle', '$pageContent', '$status')"); //Dodanie do bazy nowego rekordu
	}
	else
	{
		echo "Nie dodano strony";
	}
	header("Location: admin.php");
}

/*********************************************/
/*		funkcja usuwająca podstrony z bazy	 */
/*********************************************/	


// funkacja odpowiada za ususnięcie konkretnego rekordu
function UsunPodstrone($id, $tmp)
{
	include '../cfg.php';
	$id_clear = htmlspecialchars($id);
	
	// pentla sprawdza czy tmp jest takie samo jak "del" jezeli tak to jest usuwany konkretny rekord z bazy
	
	if($tmp == "del")
	{
		mysqli_query($con, "DELETE FROM `page_list` WHERE id=$id_clear LIMIT 1");
		mysqli_query($con, "ALTER TABLE `page_list` AUTO_INCREMENT=1");
	}
	header("Location: admin.php");
}

/*********************************************/
/*	funkcja wyświetlająca podstrony z bazy	 */
/*********************************************/	

function EdytujPodstrone($tmp)
{
	include '../cfg.php';
	$id=$_GET['id'];
	$id_clear=htmlspecialchars($id);
	
	// pentla sprawdza czy tmp jest takie samo jak "edit" jezeli tak to przechodzi do zapytania które wyciąga informacje z bazy
	
	if($tmp == "edit")
	{
		$wyn = mysqli_query($con, "SELECT * FROM `page_list` WHERE id=$id_clear LIMIT 1");
		if(mysqli_num_rows($wyn)>0)
		{
			$r2 = mysqli_fetch_assoc($wyn);
			echo ' 
			<form action="admin.php" method="POST">
			<table>
				<input type="hidden" name="tmp" value="EditPg">
				<input type="hidden" name="id" value="'.$id.'">
				<tr class="separate">
				<td>Tutaj możesz zmienić tytuł strony</td>
				</tr>
				<tr class="separate">
					<td><input type="text" name="pageTitle" value="'.$r2['page_title'].'"></td>
				</tr>
				<tr class="separate">
				<td>Tutaj możesz zmienić zawartość strony</td>
				</tr>
				<tr class="separate">
					<td><textarea name="pageContent">'.$r2['page_content'].'</textarea></td>
				</tr>
				<tr class="separate">
				<td>Tutaj możesz zdecydować czy strona ma być aktywna</td>
				</tr>
				<tr class="separate">
					<td><input type="checkbox" name="status" value="'.$r2['status'].'"></td>
				</tr>
				<tr class="separate">
					<td colspan="2"><input class="przyciski" type="submit" value="Edytuj"></td>
				</tr>
			</table>
			</form>';
		} 
	}
}

/*********************************************/
/*		funkcja edytująca podstrony w bazie	 */
/*********************************************/	

function editPage($pageTitle, $pageContent, $status)
{
	include "../cfg.php";
	$id = $_POST['id'];
	$id_clear = htmlspecialchars($id);
	
	if(isset($status)) // funkcja ustawia dla zmiennej status wartość 1 lub 0 w zalerzności od tego czy pole typu checkbox jest zaznaczone
	{
		$status = 1;	
	}
	else
	{	
		$status = 0;
	}
	
	mysqli_query($con, "UPDATE page_list SET page_title='$pageTitle', page_content='$pageContent', status='$status'  WHERE id='$id_clear' LIMIT 1");
	header("Location:admin.php");
	exit();

}

	/****************************************************/
	/*Warunki pomocnicze do wywoływania głównych funkcji*/
	/****************************************************/
	
	if(isset($tmp) && $tmp == "EditPg")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "EditPg" jezeli tak to wywołuje funkcję editPage
	{
		editPage($pageTitle, $pageContent, $status, $id);
	}
	
	if(isset($tmp) && $tmp == "new")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "new" jeżeli tak to wywołuje funkcje addPage
	{
		addPage($pageTitle, $pageContent, $status);
	}
	
	if(isset($tmp) && $tmp == "del")	//Pęntla sprawdza czy zmienna tmp jest taka sama jak "del" jeżeli tak to wywołuje funkcje UsunPodstrone
	{
		UsunPodstrone($id, "del");
	}
	
	mysqli_close($con);
?>
