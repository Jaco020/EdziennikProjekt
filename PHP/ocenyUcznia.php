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
                        $sql="select oceny_id,zajecia.zajeciaNazwa,ocenyPrzewidywane1,ocenyOkresowe,ocenyPrzewidywane2,ocenyKoncowe from oceny_all inner JOIN zajecia on zajecia.zajecia_id=oceny_all.zajecia_id where user_id=$_SESSION[user_id] order by zajecia.zajeciaNazwa ASC";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            while($row=$wynik->fetch_array()){
                                $sql2="SELECT GROUP_CONCAT(ocenaNr) from oceny_szczegoly where oceny_id=$row[0] AND Semestr=1";
                                $wynik2=$polaczenie->query($sql2);
                                $oceny=$wynik2->fetch_array();
                                $sql3="SELECT GROUP_CONCAT(ocenaNr) from oceny_szczegoly where oceny_id=$row[0] AND Semestr=2 ORDER BY 'dataOceny' desc ;";
                                $wynik3=$polaczenie->query($sql3);
                                $oceny2=$wynik3->fetch_array();
                                echo "
                                <tr class='noneBottom'>
                                    <td class='SubjectName noneLeft'><a href='#'>$row[1]</a> </td>
                                    <td>$oceny[0]</td>
                                    <td>$row[2]</td>
                                    <td>$row[3]</td>
                                    <td>$oceny2[0]</td>
                                    <td>$row[4]</td>
                                    <td class='noneRight'>$row[5]</td>
                                </tr>
                                ";
                            }
                        }
                        exit();
                        $polaczenie->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>