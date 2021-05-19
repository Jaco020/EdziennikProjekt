<?php
	session_start();
	$userlogin = $_POST['login'];
	$userpass = $_POST['pass'];
	if (($userlogin=="") || ($userpass=="")){
		header('Location: login.php?error=pusteDane');
		exit();
	}
	require_once "connect.php";

	$sql="SELECT user_id,username,dataSystemu FROM uzytkownik WHERE login='$userlogin' AND password='$userpass';";
	$wynik = $polaczenie->query($sql);
	if(mysqli_num_rows($wynik)>0 && $wynik){
		$daneBazy = $wynik->fetch_array(); //$daneBazy[0],=user_id$daneBazy[1] = username , $daneBazy[2] = data , 
		mysqli_close($polaczenie);
		header('Location: podglad.php');
		$_SESSION['zalogowany'] = true;
		$_SESSION['user_id'] = $daneBazy[0];
		$_SESSION['username']=$daneBazy[1];
		$_SESSION['dataSystemu']=$daneBazy[2];
		exit();
	}
	else{
		header('Location: login.php?error=zleDane');
		exit();
	}
	$polaczenie->close();
?>