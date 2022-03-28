<?php 

session_start();

$action = $_GET['action'];
if($action == 'dodaj_produkt')
{
	$id = $_GET['id'];
	$tytul = $_GET['tytul'];
	$ilosc = $_GET['ilosc'];
	$cena = $_GET['cena_netto'];

	$product_arr = array(
		'id'=>$id,
		'tytul'=>$tytul,
		'ilosc'=>$ilosc,
		'cena_netto'=>$cena_netto,
	);

	if(!empty($_SESSION['koszykProduktow']))
	{
		$product_ids = array_column($_SESSION['koszykProduktow'], 'id');
		if(in_array($id, $product_ids))
		{
			foreach($_SESSION['koszykProduktow'] as $key => $val)
			{
				if($_SESSION['koszykProduktow'][$key]['id'] == $id)
				{
					$_SESSION['koszykProduktow'][$key]['ilosc'] = $_SESSION['koszykProduktow'][$key]['ilosc'] + $ilosc;
				}
			}
		}
		else
		{
			$_SESSION['koszykProduktow'][] = $product_arr;
		}
	}
	else
	{
		$_SESSION['koszykProduktow'][] = $product_arr;
	}
	header("location:koszyk.php");

}
if($action == 'usun_produkt')
{
	$index = $_GET['index'];
	if(isset($_SESSION['koszykProduktow']))
	{
		unset($_SESSION['koszykProduktow'][$index]);
		header("location:koszyk.php");
	}
}
?>