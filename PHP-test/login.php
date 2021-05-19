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
            <input type="text" name="login" class="logInput" id="loginInput" placeholder="Login">
            <input type="password" name="pass" class="logInput" id="passInput" placeholder="Hasło">
            <button class="btn">Zaloguj</button>
        </form>
    </div>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "pusteDane"){
                echo "<p class='error' style='color:red;text-align:center;font-size:2.5rem'>Nie uzupełniono wszystkich danych</p>";
            }
            else if ($_GET["error"] == "zleDane"){
                echo "<p class='error' style='color:red;text-align:center;font-size:2.5rem>Login lub hasło jest nieprawidłowe</p>";
            }
        };
    ?>
    <footer>
        System E-dziennik. Projekt stworzyli Bartosz Rożyk i Jakub Selonke 
    </footer>
</body>
</html>