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
    <title>Podgląd Ucznia</title>
    <link rel="shortcut icon" href="../IMG/logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/globals.css">
    <link rel="stylesheet" href="../CSS/mainCont.css">
    <link rel="stylesheet" href="../CSS/menuBaner.css">
    <link rel="stylesheet" href="../CSS/sideMenu.css">
    <link rel="stylesheet" href="../CSS//podglad.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
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
            <a class="sideMenu__item sideMenu__item--active" href="podglad.php"><i class="fas fa-home"></i>Podgląd wyników ucznia</a>
            <a class="sideMenu__item" href="./ocenyUcznia.php"><i class="fas fa-book-reader"></i>Oceny</a>
            <a class="sideMenu__item" href="./sprawdziany.php"><i class="fas fa-clipboard"></i>Sprawdziany</a>
            <a class="sideMenu__item" href="./frekfencja.php"><i class="fas fa-user-clock"></i>Frekfencja</a>
            <a class="sideMenu__item " href="./zachowanie.php"><i class="fas fa-user-check"></i>Zachowanie</a>
            <a class="sideMenu__item" href="./ogloszenia.php"><i class="fas fa-envelope"></i>Ogłoszenia</a>
        </div>
    <div class="mainCont">
        <div class="mainCont__header">
            <h3 class="OpisCont">Informacje o wynikach w nauce</h3>
            <p class="dataInfo" title="Data Aktualizacji"><i class="far fa-calendar-alt"></i><?php echo $_SESSION["dataSystemu"]; ?></p>
        </div>
        <div class="mainCont__info">
            <div class="infoRow">
                <div class="infoRow__item">
                    <h3>Podstawowe informacje</h3>
                    <table>
                        <tr>
                            <td>Czy są nieobecności nieusprawiedliwione</td>
                            <td class="warning"><?php 
                        require_once "connect.php";
                        $sql="select count(status) from frekfencja WHERE frekfencja.status='Nieusprawiedliwione' AND user_id=$_SESSION[user_id]";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            $dane = $wynik->fetch_array();
                            if($dane[0]=='1'){echo "Tak";}
                            else{echo "Nie";}
                        };
                        ?></td>
                            <td><a href="../PHP-test/frekfencja.php">Nieobecności ucznia</a></td>
                        </tr>
                        <tr>
                            <td>Data ostatniego spóźnienia</td>
                            <td class="green"><?php 
                        require_once "connect.php";
                        $sql="select count(status) from frekfencja WHERE frekfencja.status='spoznienie' AND user_id=$_SESSION[user_id]";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            $dane = $wynik->fetch_array();
                            if($dane[0]=='1'){echo "Tak";}
                            else{echo "Brak";}
                        };
                        ?></td>
                            <td><a href="../PHP-test/frekfencja.php">Spóźnienia ucznia</a></td>
                        </tr>
                        <tr>
                            <td>Czy są zaplanowane Prace?</td>
                            <td class="green"><?php 
                        require_once "connect.php";
                        $sql="select count(rodzaj) from sprawdziany WHERE user_id=$_SESSION[user_id]";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            $dane = $wynik->fetch_array();
                            if($dane[0]>='1'){echo "Tak";}
                            else{echo "Brak";}
                        };
                        ?></td>
                            <td><a href="../PHP-test/sprawdziany.php">Zaplanowane Pracy</a></td>
                        </tr>
                    </table>
                </div>
                <div  class="infoRow__item" style="margin-left: 50px;">
                    <h3>Nieobecności Ucznia</h3>
                    <canvas id="wykresFrekfencja"></canvas>
                </div>
            </div>
            <div class="infoRow">
                <div class="infoRow__item">
                    <h3>Najnowsze oceny</h3>
                    <table>
                        <tr>
                            <th>Przedmiot</th>
                            <th>Ocena</th>
                            <th>Waga</th>
                            <th>Data</th>
                            <th>Liczona</th>
                        </tr>
                        <tr>
                            <td>Informatyka</td>
                            <td>5</td>
                            <td>1</td>
                            <td>28/04/21 10:21:06</td>
                            <td>Tak</td>
                        </tr>
                        <tr>
                            <td>Język niemiecki</td>
                            <td>6</td>
                            <td>1</td>
                            <td>27/04/21 12:43:45</td>
                            <td>Tak</td>
                        </tr>
                        <tr>
                            <td>Historia i społeczeństwo</td>
                            <td>5</td>
                            <td>2</td>
                            <td>23/04/21 14:02:09</td>
                            <td>Tak</td>
                        </tr>
                        <tr>
                            <td>Aplikacje internetowe</td>
                            <td>5</td>
                            <td>1</td>
                            <td>20/04/21 11:22:45</td>
                            <td>Tak</td>
                        </tr>
                        <tr>
                            <td>Język polski</td>
                            <td>6</td>
                            <td>3</td>
                            <td>19/04/21 11:22:45</td>
                            <td>Tak</td>
                        </tr>
                    </table>
                </div>
                <div class="infoRow__item" style="margin-left: 50px;">
                    <h3>Najnowsze Ogłoszenie</h3>
                    <div class="ogloszenie">
                        <?php 
                        require_once "connect.php";
                        $sql="select tytul,tresc from ogloszenia WHERE user_id=$_SESSION[user_id] ORDER BY dataOgloszenia DESC LIMIT 1";
                        $wynik = $polaczenie->query($sql);
                        if($wynik || mysqli_num_rows($wynik)!=0){
                            $dane = $wynik->fetch_array();
                            echo "<p class='tytul'>$dane[0]</p>
                            <p class='tresc'>$dane[1]</p>";
                        }
                        else{
                            echo "<p class='tytul'>Brak Ogloszen</p>";
                        };
                        ?>
                        <!-- <p class="tytul">Komunikat</p>
                        <p class="tresc">Dzień dobry, Szanowni Rodzice Uczniowie w wieku 7 lat lub starsi jeżdżą za darmo w gdyńskich autobusach i trolejbusach, jeżeli mieszkają w Gdyni i posiadają poświadczający to dokument. Jeżeli uczeń używa legitymacji szkolnej, prosimy o sprawdzenie, czy jest tam wpisany gdyński adres zamieszkania! Jeśli nie ma informacji o adresie, potrzebny jest dodatkowy dokument! Może to być pisemne zaświadczenie ze szkoły lub Karta Mieszkańca. WAŻNA INFORMACJA: Jeżeli uczeń posiada Kartę Mieszkańca, należy pamiętać o przedłużeniu uprawnień do bezpłatnych przejazdów do 30 września w gdyńskim InfoBoksie (przy ul. Świętojańskiej 30 od poniedziałku do piątku w godz. 8.00-18.00). Aby to zrobić, potrzebna będzie aktualna legitymacja szkolna + zaświadczenie o adresie zamieszkania jeśli nie ma takiej adnotacji w legitymacji. Dzięki posiadaniu Karty Mieszkańca, legitymacja szkolna nie będzie już potrzebna w pojazdach ZKM. Szczegółowe informacje na temat bezpłatnych przejazdów dla gdyńskich dzieci i młodzieży znajdują się na stronie zkmgdynia.pl</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../JavaScript/wykres.js"></script>
    <script>
        var text = document.querySelector(".tresc"); // tresci ogloszenia
        if(text.innerHTML.length >= 435){ // innerHTML = tekst
            let textCut = text.innerHTML.substring(0,435); // redukcja tekstu
            const lastSpace = textCut.lastIndexOf(" "); //indeks ostatniej spacji - aby nie urywac polowy wyrazu
            text.innerHTML = textCut.substring(0,lastSpace); // utnij zadlugie ogloszenie
            text.innerHTML+= "...";
            document.querySelector(".ogloszenie").innerHTML+="<a href='ogloszenia.html'>Czytaj Wiecej</a>";
        }
    </script>   
</body>
</html>