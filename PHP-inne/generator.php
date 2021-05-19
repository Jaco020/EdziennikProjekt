<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genruj Baze</title>
    <link rel="stylesheet" href="../CSS/globals.css">
    <style>
        body{
            text-align: center;
        }
        .btn{
        background-color: #47a5f1;;
        border: none;
        outline: none;
        color:#edf1fa;;
        padding: 1rem 2rem;
        font-size: 3rem;
        border-radius: 5px;
        cursor: pointer;
        margin-top:200px;
        }
        p.raport{
            font-size: 2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <button class="btn" name = "submit">Generuj Baze</button>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $connect = new mysqli('localhost','root','');
            $connect -> set_charset("utf8");
            setlocale(LC_ALL,"polish");
            $sql = "DROP DATABASE IF EXISTS `edziennik2`;";
            
            $wynik = $connect->query($sql);
            $sql = "CREATE DATABASE `edziennik2`;";
            $wynik = $connect->query($sql);

            $connect->select_db("edziennik2");
                        // ==================== Tworzenie Tabel =================================================
            $sql = "
            create table uzytkownik(
                user_id int AUTO_INCREMENT,
                login varchar(50),
                password varchar(30),
                username varchar(50),
                dataSystemu DATETIME,
                primary key(user_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table zajecia(
                zajecia_id int AUTO_INCREMENT,
                zajeciaNazwa varchar(50),
                nauczyciel varchar(50),
                primary key(zajecia_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table oceny(
                oceny_id int AUTO_INCREMENT,
                user_id int,
                zajecia_id int,
                ocenySemestr1 varchar(80),
                ocenyPrzewidywane1 varchar(2),
                ocenyOkresowe varchar(2),
                ocenySemestr2 varchar(80),
                ocenyPrzewidywane2 varchar(2),
                ocenyKoncowe varchar(2),
                primary key(oceny_id),
                foreign key(user_id) references uzytkownik(user_id),
                foreign key(zajecia_id) references zajecia(zajecia_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table sprawdziany(
                sprawdziany_id int AUTO_INCREMENT,
                user_id int,
                zajecia_id int,
                rodzaj varchar(30),
                temat varchar(50),
                szczegoly varchar(30),
                termin date,
                primary key(sprawdziany_id),
                foreign key(user_id) references uzytkownik(user_id),
                foreign key(zajecia_id) references zajecia(zajecia_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table frekfencja(
                frekfencja_id int AUTO_INCREMENT,
                user_id int,
                zajecia_id int,
                dataZajec date,
                czasZajec varchar(11),
                status varchar(40),
                komentarz varchar(50),
                tresc varchar(200),
                primary key(frekfencja_id),
                foreign key(user_id) references uzytkownik(user_id),
                foreign key(zajecia_id) references zajecia(zajecia_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table zachowanie(
                zachowanie_id int AUTO_INCREMENT,
                user_id int,
                ocenaPrzewidywana1 varchar(30),
                ocenaOkresowa varchar(30),
                ocenaPrzewidywana2 varchar(30),
                ocenaKoncowa varchar(30),
                primary key(zachowanie_id),
                foreign key(user_id) references uzytkownik(user_id),
                foreign key(user_id) references uzytkownik(user_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table ogloszenia(
                ogloszenia_id int AUTO_INCREMENT,
                user_id int,
                tytul varchar(50),
                tresc varchar(80),
                dataOgloszenia DATETIME,
                foreign key(user_id) references uzytkownik(user_id),
                primary key(ogloszenia_id)
            );";
            $wynik = $connect->query($sql);

                    // ==================== Zrzut Danych =================================================

            $sql = "
            INSERT INTO uzytkownik (login, password, username, dataSystemu) VALUES 
            ('Jakub', 'qwerty','Jakub Selonke','2021-05-06 08:53:22'),
            ('Bartek', 'pass0','Bartosz Rożyk','2021-05-06 08:53:22' );";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO zajecia (zajeciaNazwa,nauczyciel) VALUES
            ('Historia i Społeczeństwo','Monika Ebertowska'),
            ('Angielski','Teresa Guzek'),
            ('Matematyka','Wiolleta Pisała');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO oceny (user_id,zajecia_id, ocenySemestr1, ocenyPrzewidywane1, ocenyOkresowe,ocenySemestr2,ocenyPrzewidywane2,ocenyKoncowe) VALUES 
            (1,1,'4, 4+, 4, 4, 4, 4, 4+','4','4','+, 5-, 5-, 5, 3, 4+','5-','5'),
            (1,2,'6, nb, 5, 6-, 5+, 6','6','6','6, 6, 5, 5, 5, 6','6-','6'),
            (2,1,'4, 5, 4','4','4','4, 5-, 4','5','5'),
            (2,2,'5, 5, 5-, 5+','5-','5','4+, 5, 5, 4, 5','5-','5'),
            (2,3,'4-, 2+, 3, 2+, 1, 2-, 1','2','2','4, 2-, 1,2+,2+','2','2');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO sprawdziany (user_id,zajecia_id,rodzaj,temat,szczegoly,termin) VALUES
            (1,1,'Sprawdzian','Polska w XX wieku','Wagi 4','2021-05-24'),
            (2,1,'Sprawdzian','Polska w XX wieku','Wagi 4','2021-05-24'),
            (2,2,'kartkówka','Słownictwo','','2021-05-18'),
            (1,2,'kartkówka','Dzial 8','','2021-05-26');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO frekfencja (user_id,zajecia_id,dataZajec,czasZajec,status,komentarz,tresc) VALUES
            (1,1,'2021-05-12','11:50-12:35','Usprawiedliwione','','Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza'),
            (1,2,'2021-05-15','11:50-12:35','spoznienie','10 minut po',''),
            (1,3,'2021-05-12','11:50-12:35','Nieusprawiedliwione','Ucieczka z lekcji',''),
            (2,2,'2021-05-12','11:50-12:35','Usprawiedliwione','','Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO zachowanie (user_id,ocenaPrzewidywana1,ocenaOkresowa,ocenaPrzewidywana2,ocenaKoncowa) VALUES
            (1,'Bardzo Dobry','	Bardzo Dobry','Celujący','Celujący'),
            (2,'Dobry','Dobry','Dobry','Bardzo Dobry');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO ogloszenia (user_id,tytul,tresc,dataOgloszenia) VALUES
            (1,'OGŁOSZENIE','Szanowni Państwo, Gdyńskie Centrum Zdrowia zaprasza rodziców/ opiekunów prawnych do wypełnienia kwestionariusza wstępnej oceny kondycji zdrowotnej dziecka dostępnej pod adresem: https://zdrowie.gdynia.pl/ankieta-kzd/ . Odpowiadając na pytania z ankiety otrzymają Państwo krótkie porady i wskazówki dotyczące różnych obszarów rozwoju dziecka oraz informacje na temat oferty Gminy Miasta Gdyni w zakresie zdrowia skierowanej do dzieci. Ankieta jest anonimowa, a gromadzone dane statystyczne pozwolą ulepszyć i poszerzyć ofertę działań skierowanych do młodych Gdynian. Dodatkowo kwestionariusz ankiety jest także narzędziem rekrutacyjnym do kolejnej edycji programu polityki zdrowotnej pn. „Program polityki zdrowotnej w zakresie profilaktyki i leczenia nadwagi i otyłości w populacji młodzieży w Gminie Miasta Gdyni. Kontynuacja na lata 2020 – 2021.”, której rozpoczęcie planowane jest w listopadzie br. Więcej informacji na temat obecnej, kończącej się już edycji programu znajdą Państwo tutaj: https://gcz.gdynia.pl/programy-i-projekty/gdynski-zdrowy-uczen/program-polityki-zdrowotnej-w-zakresie-profilaktyki-i-leczenia-nadwagi-i-otylosci-w-populacji-mlodziezy-w-gminie-miasta-gdyni/ Zachęcamy do wypełnienia ankiety','2021-05-06 08:53:22'),
            (2,'KOMUNIKAT','E-dziennik jest już do pobrania w aplikacji Gdynia.pl. Od dziś łatwiej będzie zarówno o zachowanie kontaktu z placówką, zgłoszenie nieobecności, jak i sprawdzenie ocen. Wszystkie funkcje e-dziennika z Konta Mieszkańca mogą od teraz być dostępne na Państwa smartfonach.','2020-10-06 14:03:13'),
            (1,'KOMUNIKAT','Dzień dobry, Szanowni Rodzice Uczniowie w wieku 7 lat lub starsi jeżdżą za darmo w gdyńskich autobusach i trolejbusach, jeżeli mieszkają w Gdyni i posiadają poświadczający to dokument. Jeżeli uczeń używa legitymacji szkolnej, prosimy o sprawdzenie, czy jest tam wpisany gdyński adres zamieszkania! Jeśli nie ma informacji o adresie, potrzebny jest dodatkowy dokument! Może to być pisemne zaświadczenie ze szkoły lub Karta Mieszkańca. WAŻNA INFORMACJA: Jeżeli uczeń posiada Kartę Mieszkańca, należy pamiętać o przedłużeniu uprawnień do bezpłatnych przejazdów do 30 września w gdyńskim InfoBoksie (przy ul. Świętojańskiej 30 od poniedziałku do piątku w godz. 8.00-18.00). Aby to zrobić, potrzebna będzie aktualna legitymacja szkolna + zaświadczenie o adresie zamieszkania jeśli nie ma takiej adnotacji w legitymacji. Dzięki posiadaniu Karty Mieszkańca, legitymacja szkolna nie będzie już potrzebna w pojazdach ZKM. Szczegółowe informacje na temat bezpłatnych przejazdów dla gdyńskich dzieci i młodzieży znajdują się na stronie zkmgdynia.pl','2020-09-09 13:45:28'),
            (2,'KOMUNIKAT','Gdyńskie Centrum Zdrowia zaprasza rodziców bądź opiekunów prawnych dziewczynek mieszkających lub zameldowanych na terenie Gdyni i urodzonych w roku 2006 lub 2007, do zarejestrowania ich do programu szczepień ochronnych przeciwko wirusowi brodawczaka ludzkiego HPV. Szczepienia ochronne przeciwko HPV to bezpieczna i skuteczna forma profilaktyki nowotworowej. Wirus HPV jest najczęstszą przyczyną raka szyjki macicy, może również prowadzić do rozwoju raka odbytu, sromu, pochwy, języka lub gardła. Zgłoszeń na szczepienia można dokonywać poprzez formularz rejestracyjny dostępny na stronie internetowej www.zdrowie.gdynia.pl/hpv (przycisk Zgłoś do programu). Po prawidłowym dokonaniu zgłoszenia zachęcamy do kontaktu bezpośrednio z przychodnią dziecka realizującą szczepienie w celu umówienia dogodnego terminu wizyty szczepiennej, jeszcze przed wzrostem częstości infekcji w okresie jesienno-zimowym. Więcej informacji na stronie: https://gcz.gdynia.pl/aktualnosci/2020/08/gdynia-ponownie-uruchomia-zapisy-do-programu-szczepien-ochronnych-przeciwko-hpv-dla-gdynskich-dziewczynek/ Szczepienia wykonywane są w ramach programu polityki zdrowotnej: Program profilaktyki zakażeń wirusami brodawczaka ludzkiego (HPV) na terenie Gminy Miasta Gdyni na lata 2018 – 2020, realizowanego w całości ze środków miasta Gdyni.','2020-09-07 14:28:24');
";

            // ==================== Sprawdzenie poprawnosci =================================================

            $wynik = $connect->query($sql);
            if ($wynik) echo "<p class='raport'>Wygenerowano Poprawnie</p>";
            else echo "<p class='raport'>Blad w utworzeniu</p>";
            $connect->close();
        };
        
    ?>
        
</body>
</html>