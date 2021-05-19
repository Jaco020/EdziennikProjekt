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
    <title>Ogloszenia</title>
    <link rel="shortcut icon" href="../IMG/logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/globals.css">
    <link rel="stylesheet" href="../CSS/menuBaner.css">
    <link rel="stylesheet" href="../CSS/mainCont.css">
    <link rel="stylesheet" href="../CSS/sideMenu.css">
    <link rel="stylesheet" href="../CSS//ogloszenia.css">
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
                <p class="userName"><?php echo $_SESSION['username']; ?></p>
                <p class="logout"><a href="logoutHandler.php">Wyloguj</a></p>
            </div>
        </navbar>
        <div class="sideMenu">
            <a class="sideMenu__item" href="podglad.php"><i class="fas fa-home"></i>Podgląd wyników ucznia</a>
            <a class="sideMenu__item" href="ocenyUcznia.php"><i class="fas fa-book-reader"></i>Oceny</a>
            <a class="sideMenu__item" href="sprawdziany.php"><i class="fas fa-clipboard"></i>Sprawdziany</a>
            <a class="sideMenu__item" href="frekfencja.php"><i class="fas fa-user-clock"></i>Frekfencja</a>
            <a class="sideMenu__item" href="zachowanie.php"><i class="fas fa-user-check"></i>Zachowanie</a>
            <a class="sideMenu__item sideMenu__item--active" href="ogloszenia.php"><i class="fas fa-envelope"></i>Ogłoszenia</a>
        </div>
        <div class="mainCont">
            <div class="mainCont__header">
                <h3 class="OpisCont">Ogloszenia</h3>
                <p class="dataInfo" title="Data Aktualizacji"><i class="far fa-calendar-alt"></i><?php echo $_SESSION["dataSystemu"]; ?></p>
            </div>
            <div class="mainCont__info">
                <div class="ogloszeniaCont">
                    <?php
                        require_once "connect.php";
                        $sql="select tytul,tresc,dataOgloszenia from ogloszenia where user_id=$_SESSION[user_id] order by dataOgloszenia DESC";
                        $wynik = $polaczenie->query($sql);
                        if($wynik){
                            while($row=$wynik->fetch_array()){
                                echo "
                                <div class='ogloszeniaCont__item'>
                                    <p class='tytul'>$row[0]</p>
                                    <p class='tresc'>$row[1]</p>
                                    <p class='dataInfo'><i class='far fa-calendar-alt'></i>$row[2]</p>
                                </div>
                                ";
                            }
                        }
                        exit();
                        $polaczenie->close();
                    ?>
                    <!-- <div class="ogloszeniaCont__item">
                        <p class="tytul">OGŁOSZENIE</p>
                        <p class="tresc">„Szanowni Państwo, Gdyńskie Centrum Zdrowia zaprasza rodziców/ opiekunów prawnych do wypełnienia kwestionariusza wstępnej oceny kondycji zdrowotnej dziecka dostępnej pod adresem: https://zdrowie.gdynia.pl/ankieta-kzd/ . Odpowiadając na pytania z ankiety otrzymają Państwo krótkie porady i wskazówki dotyczące różnych obszarów rozwoju dziecka oraz informacje na temat oferty Gminy Miasta Gdyni w zakresie zdrowia skierowanej do dzieci. Ankieta jest anonimowa, a gromadzone dane statystyczne pozwolą ulepszyć i poszerzyć ofertę działań skierowanych do młodych Gdynian. Dodatkowo kwestionariusz ankiety jest także narzędziem rekrutacyjnym do kolejnej edycji programu polityki zdrowotnej pn. „Program polityki zdrowotnej w zakresie profilaktyki i leczenia nadwagi i otyłości w populacji młodzieży w Gminie Miasta Gdyni. Kontynuacja na lata 2020 – 2021.”, której rozpoczęcie planowane jest w listopadzie br. Więcej informacji na temat obecnej, kończącej się już edycji programu znajdą Państwo tutaj: https://gcz.gdynia.pl/programy-i-projekty/gdynski-zdrowy-uczen/program-polityki-zdrowotnej-w-zakresie-profilaktyki-i-leczenia-nadwagi-i-otylosci-w-populacji-mlodziezy-w-gminie-miasta-gdyni/ Zachęcamy do wypełnienia ankiety.”</p>
                        <p class="dataInfo"><i class="far fa-calendar-alt"></i>2021-05-06 08:53:22</p>
                    </div>
                    <div class="ogloszeniaCont__item">
                        <p class="tytul">KOMUNIKAT</p>
                        <p class="tresc">E-dziennik jest już do pobrania w aplikacji Gdynia.pl. Od dziś łatwiej będzie zarówno o zachowanie kontaktu z placówką, zgłoszenie nieobecności, jak i sprawdzenie ocen. Wszystkie funkcje e-dziennika z Konta Mieszkańca mogą od teraz być dostępne na Państwa smartfonach.</p>
                        <p class="dataInfo"><i class="far fa-calendar-alt"></i>2020-10-06 14:03:13</p>
                    </div>
                    <div class="ogloszeniaCont__item">
                        <p class="tytul">KOMUNIKAT</p>
                        <p class="tresc">Dzień dobry, Szanowni Rodzice Uczniowie w wieku 7 lat lub starsi jeżdżą za darmo w gdyńskich autobusach i trolejbusach, jeżeli mieszkają w Gdyni i posiadają poświadczający to dokument. Jeżeli uczeń używa legitymacji szkolnej, prosimy o sprawdzenie, czy jest tam wpisany gdyński adres zamieszkania! Jeśli nie ma informacji o adresie, potrzebny jest dodatkowy dokument! Może to być pisemne zaświadczenie ze szkoły lub Karta Mieszkańca. WAŻNA INFORMACJA: Jeżeli uczeń posiada Kartę Mieszkańca, należy pamiętać o przedłużeniu uprawnień do bezpłatnych przejazdów do 30 września w gdyńskim InfoBoksie (przy ul. Świętojańskiej 30 od poniedziałku do piątku w godz. 8.00-18.00). Aby to zrobić, potrzebna będzie aktualna legitymacja szkolna + zaświadczenie o adresie zamieszkania jeśli nie ma takiej adnotacji w legitymacji. Dzięki posiadaniu Karty Mieszkańca, legitymacja szkolna nie będzie już potrzebna w pojazdach ZKM. Szczegółowe informacje na temat bezpłatnych przejazdów dla gdyńskich dzieci i młodzieży znajdują się na stronie zkmgdynia.pl</p>
                        <p class="dataInfo"><i class="far fa-calendar-alt"></i>2020-09-09 13:45:28</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>