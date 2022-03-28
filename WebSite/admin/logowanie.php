<style>
.komunikat
{
	font-size:20px;
	color: orange;
}
</style>
<?php
	session_start();

	if ((!isset($_POST['login_email'])) || (!isset($_POST['login_pass'])))
	{
		header('Location: admin.php');
		exit();
	}

	include '../cfg.php';

		$log = $_POST['login_email'];
		$password = $_POST['login_pass'];
		
		if (($log == $login) && ($password == $passwordLog))
		{
			$_SESSION["zalogowany"] = true;
			unset($_SESSION['error']);
			header('Location: admin.php');
		}
		else
		{
			$_SESSION['error'] = '<p class="komunikat">Nieprawodłowo podane dane logowania</p>';
			header('Location: admin.php');
		}
	mysqli_close($con);
?>