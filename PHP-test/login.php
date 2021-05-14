<?php
	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: podglad.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie do Systemu</title>
    <link rel="shortcut icon" href="../IMG/logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/globals.css">
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <div class="loginCont">
        <div class="loginCont__logo">
            <img src="../IMG/logo.png">
            <p class="logo">E-Dziennik</p>
        </div>
        <h4>Zaloguj się do systemu</h4>
        <form class="loginCont__form" action="LoginHandler.php" method="post">
            <input type="text" class="logInput" id="loginInput" placeholder="Login">
            <input type="password" class="logInput" id="passInput" placeholder="Hasło">
            <button class="btn">Zaloguj</button>
            <?php
	            if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
            ?>
        </form>
    </div>
    <footer>
        System E-dziennik. Projekt stworzyli Bartosz Rożyk i Jakub Selonke 
    </footer>
</body>
</html>