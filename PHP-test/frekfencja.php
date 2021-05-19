<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location:login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frekfencja Ucznia</title>
    <link rel="shortcut icon" href="../IMG/logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/globals.css">
    <link rel="stylesheet" href="../CSS/menuBaner.css">
    <link rel="stylesheet" href="../CSS/mainCont.css">
    <link rel="stylesheet" href="../CSS/tableGlobal.css">
    <link rel="stylesheet" href="../CSS/sideMenu.css">
    <script src="https://kit.fontawesome.com/086b12d3c8.js" crossorigin="anonymous"></script>
</head>
<body>
        <navbar class="menuBaner">
            <div class="menuBaner__item">
                <img src="../IMG/logo.png">
                <p class="logo">E-Dziennik</p>
            </div>
            <div class="menuBaner__item">
                <i class="fas fa-user-graduate"></i>
                <p class="userName"><?php echo $_SESSION["username"]; ?></p>
                <p class="logout"><a href="logoutHandler.php">Wyloguj</a></p>
            </div>
        </navbar>
        <div class="sideMenu">
            <a class="sideMenu__item" href="podglad.php"><i class="fas fa-home"></i>Podgląd wyników ucznia</a>
            <a class="sideMenu__item" href="ocenyUcznia.php"><i class="fas fa-book-reader"></i>Oceny</a>
            <a class="sideMenu__item" href="sprawdziany.php"><i class="fas fa-clipboard"></i>Sprawdziany</a>
            <a class="sideMenu__item sideMenu__item--active" href="frekfencja.php"><i class="fas fa-user-clock"></i>Frekfencja</a>
            <a class="sideMenu__item" href="zachowanie.php"><i class="fas fa-user-check"></i>Zachowanie</a>
            <a class="sideMenu__item" href="ogloszenia.php"><i class="fas fa-envelope"></i>Ogłoszenia</a>
        </div>
        <div class="mainCont">
            <div class="mainCont__header">
                <h3 class="OpisCont">Frekfencja Ucznia</h3>
                <p class="dataInfo" title="Data Aktualizacji"><i class="far fa-calendar-alt"></i><?php echo $_SESSION["dataSystemu"]; ?></p>
            </div>
            <div class="mainCont__info">
                <table>
                    <tr>
                        <th class="noneLeft">Zajęcia</th>
                        <th>Data zajęć</th>
                        <th>Czas zajęć</th>
                        <th>Status</th>
                        <th>Komentarz</th>
                        <th>Treść usprawiedliwienia</th>
                        <th class="noneRight">Akcja</th>
                    </tr>
                    <?php
                        require_once "connect.php";
                        $sql="select zajecia.zajeciaNazwa,dataZajec,czasZajec,status,komentarz,tresc from frekfencja inner join zajecia on zajecia.zajecia_id=frekfencja.zajecia_id where user_id=$_SESSION[user_id]";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            while($row=$wynik->fetch_array()){
                                echo "
                                <tr>
                                    <td class='noneLeft'>$row[0]</td>
                                    <td>$row[1]</td>
                                    <td>$row[2]</td>
                                    <td>$row[3]</td>
                                    <td>$row[4]</td>
                                    <td>$row[5]</td>
                                    <td class='noneRight'><a href='#'>Usprawiedliwienie</a></td>
                                </tr>
                                ";
                            }
                        }
                        exit();
                        $polaczenie->close();
                    ?>
                    <!-- <tr>
                        <td class="noneLeft">Aplikacje</td>
                        <td>04.10.2021</td>
                        <td>10:45-11:30</td>
                        <td>Wnioskowanie o usprawiedliwienie</td>
                        <td></td>
                        <td>Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza</td>
                        <td class="noneRight"><a href="#">Usprawiedliwienie</a></td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
</body>
</html>