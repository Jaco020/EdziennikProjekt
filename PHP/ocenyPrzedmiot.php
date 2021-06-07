<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location:login.php');
		exit();
	}
    if (!isset($_GET["przedmiot"])) {
        header('Location:ocenyUcznia.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceny</title>
    <link rel="shortcut icon" href="../IMG/logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/globals.css">
    <link rel="stylesheet" href="../CSS/menuBaner.css">
    <link rel="stylesheet" href="../CSS/mainCont.css">
    <link rel="stylesheet" href="../CSS/tableGlobal.css">
    <link rel="stylesheet" href="../CSS/sideMenu.css">

    <script src="https://kit.fontawesome.com/086b12d3c8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JavaScript/sort.js"></script>
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
            <a class="sideMenu__item sideMenu__item--active" href="ocenyUcznia.php"><i class="fas fa-book-reader"></i>Oceny</a>
            <a class="sideMenu__item" href="sprawdziany.php"><i class="fas fa-clipboard"></i>Sprawdziany</a>
            <a class="sideMenu__item" href="frekfencja.php"><i class="fas fa-user-clock"></i>Frekfencja</a>
            <a class="sideMenu__item" href="zachowanie.php"><i class="fas fa-user-check"></i>Zachowanie</a>
            <a class="sideMenu__item" href="ogloszenia.php"><i class="fas fa-envelope"></i>Ogłoszenia</a>
        </div>
        <div class="mainCont">
            <div class="mainCont__header">
                <h3 class="OpisCont">Oceny z przedmiotu</h3>
                <p class="dataInfo" title="Data Aktualizacji"><i class="far fa-calendar-alt"></i><?php echo $_SESSION["dataSystemu"]; ?></p>
            </div>
            <div class="mainCont__info">
                <table>
                    <tr>
                        <th class="longCell noneLeft">Zajęcia</th>
                        <th class="shortCell">Ocena</th>
                        <th class="shortCell">Waga</th>
                        <th class="lognCell sort_th">Data wystawienia <i class="fas fa-sort"></i></th>
                        <th>Czy liczona do średniej</th>
                        <th>Semestr</th>
                    </tr>
                    <tbody>
                    <?php
                        require_once "connect.php";
                        $przedmiot = htmlspecialchars($_GET['przedmiot']);
                        $sql="select zajecia.zajeciaNazwa,oceny_szczegoly.ocenaNr,oceny_szczegoly.waga,oceny_szczegoly.dataOceny,oceny_szczegoly.Liczona,oceny_szczegoly.Semestr from oceny_all inner JOIN zajecia on zajecia.zajecia_id=oceny_all.zajecia_id INNER JOIN oceny_szczegoly on oceny_szczegoly.oceny_id=oceny_all.oceny_id where user_id=$_SESSION[user_id] AND zajecia.zajeciaNazwa='$przedmiot' order by oceny_szczegoly.dataOceny DESC";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            while($row=$wynik->fetch_array()){
                            echo "
                            <tr class='noneBottom'>
                                <td class='noneLeft'>$row[0] </td>
                                <td>$row[1]</td>
                                <td>$row[2]</td>
                                <td>$row[3]</td>
                                <td>$row[4]</td>
                                <td class='noneRight'>$row[5]</td>
                            </tr>
                            ";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>