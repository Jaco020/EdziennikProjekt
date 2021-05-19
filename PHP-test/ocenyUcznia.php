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
    <title>Oceny Ucznia</title>
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
            <a class="sideMenu__item sideMenu__item--active" href="ocenyUcznia.php"><i class="fas fa-book-reader"></i>Oceny</a>
            <a class="sideMenu__item" href="sprawdziany.php"><i class="fas fa-clipboard"></i>Sprawdziany</a>
            <a class="sideMenu__item" href="frekfencja.php"><i class="fas fa-user-clock"></i>Frekfencja</a>
            <a class="sideMenu__item" href="zachowanie.php"><i class="fas fa-user-check"></i>Zachowanie</a>
            <a class="sideMenu__item" href="ogloszenia.php"><i class="fas fa-envelope"></i>Ogłoszenia</a>
        </div>
        <div class="mainCont">
            <div class="mainCont__header">
                <h3 class="OpisCont">Oceny Ucznia</h3>
                <p class="dataInfo" title="Data Aktualizacji"><i class="far fa-calendar-alt"></i><?php echo $_SESSION["dataSystemu"]; ?></p>
            </div>
            <div class="mainCont__info">
                <table>
                    <tr>
                        <th class="longCell noneLeft">Zajęcia</th>
                        <th class="longCell">Oceny Cząstkowe </br>Semestr 1</th>
                        <th class="shortCell">Oceny Przewidywane </br> Semestr 1</th>
                        <th class="shortCell">Oceny Okresowe</td>
                        <th class="longCell">Oceny Cząstkowe</br> Semestr 2</th>
                        <th class="shortCell">Oceny Przewidywane </br> Semestr 2</th>
                        <th class="shortCell noneRight">Oceny Końcowe</th>
                    </tr>
                    <?php
                        require_once "connect.php";
                        $sql="select zajecia.zajeciaNazwa, ocenySemestr1,ocenyPrzewidywane1,ocenyOkresowe,ocenySemestr2,ocenyPrzewidywane2,ocenyKoncowe from oceny inner JOIN zajecia on zajecia.zajecia_id=oceny.zajecia_id where user_id=$_SESSION[user_id]";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            while($row=$wynik->fetch_array()){
                                echo "
                                <tr>
                                    <td class='SubjectName noneLeft'><a href='#'>$row[0]</a> </td>
                                    <td>$row[1]</td>
                                    <td>$row[2]</td>
                                    <td>$row[3]</td>
                                    <td>$row[4]</td>
                                    <td>$row[5]</td>
                                    <td class='noneRight'>$row[6]</td>
                                </tr>
                                ";
                            }
                        }
                        exit();
                        $polaczenie->close();
                    ?>
                    <!-- <tr>
                        <td class="SubjectName noneLeft"><a href="#">Aplikacje internetowe</a> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="noneRight"></td>
                    </tr>
                    <tr> -->
                </table>
            </div>
        </div>
    </div>
</body>
</html>