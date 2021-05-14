<?php
	session_start();
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))){
		header('Location: login.php');
		exit();
	}
	require_once "connect.php";
	
	if (!$polaczenie) die("Błąd połączenia: ".$polaczenie->connect_error);
	else{
			$sql = "SELECT username FROM dane_klienta;";
			if ($result = mysqli_query($polaczenie, $sql)){
			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['username'] = $wiersz['username'];
			}
        }
        mysqli_close($polaczenie);
				
	else if{	
		$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
		header('Location: login.php');
		}
			
	$polaczenie->close();
	
?>