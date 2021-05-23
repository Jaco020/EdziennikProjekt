<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generuj Baze</title>
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
            $connect = mysqli_connect('localhost','root','');
            mysqli_set_charset($connect,"utf8");
            $sql = "DROP DATABASE IF EXISTS `edziennik`;";
            $wynik = $connect->query($sql);

            $sql = "CREATE DATABASE `edziennik`;";
            $wynik = $connect->query($sql);

            $connect->select_db("edziennik");
            $sql = "ALTER DATABASE edziennik CHARACTER SET utf8 COLLATE utf8_polish_ci;";
            $wynik = $connect->query($sql);
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
            create table oceny_all(
                oceny_id int AUTO_INCREMENT,
                user_id int,
                zajecia_id int,
                ocenyPrzewidywane1 varchar(2),
                ocenyOkresowe varchar(2),
                ocenyPrzewidywane2 varchar(2),
                ocenyKoncowe varchar(2),
                primary key(oceny_id),
                foreign key(user_id) references uzytkownik(user_id),
                foreign key(zajecia_id) references zajecia(zajecia_id)
            );";
            $wynik = $connect->query($sql);
            $sql = "
            create table oceny_szczegoly(
                ocena1_id int AUTO_INCREMENT,
                oceny_id int,
                ocenaNr enum('1','1+','2-','2','2+','3-','3','3+','4-','4','4+','5-','5','5+','6-','6'),
                waga int,
                dataOceny datetime,
                Liczona enum('Tak','Nie'),
                Semestr int,
                primary key(ocena1_id),
                foreign key(oceny_id) references oceny_all(oceny_id)
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
                tresc text,
                dataOgloszenia DATETIME,
                foreign key(user_id) references uzytkownik(user_id),
                primary key(ogloszenia_id)
            );";
            $wynik = $connect->query($sql);
            if(!$wynik){echo "<p class='raport'>Blad w utworzeniu Bazy</p>";exit();}

                    // ==================== Zrzut Danych =================================================

            $sql = "
            INSERT INTO uzytkownik (login, password, username, dataSystemu) VALUES 
            ('Jakub', 'qwerty','Jakub Selonke','2021-05-16 08:53:22'),
            ('Bartek', 'pass0','Bartosz Rożyk','2021-05-08 08:53:22' );";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO zajecia (zajeciaNazwa,nauczyciel) VALUES
            ('Historia i Społeczeństwo','Monika Ebertowska'),
            ('Angielski','Teresa Guzek'),
            ('Matematyka','Wiolleta Pisała'),
            ('Aplikacje Internetowe','Marek Wesołowski'),
            ('Systemy Operacyjne','Eugeniusz Kasperkowiak'),
            ('Język Niemiecki','Monika Formańska-Żadkowska'),
            ('Statyczne Witryny Internetowe','Jeremi Horodeński'),
            ('Język Polski','Dawid Ladach'),
            ('Bazy Danych','Krystyna Kasperkowiak');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO oceny_all (user_id,zajecia_id, ocenyPrzewidywane1, ocenyOkresowe,ocenyPrzewidywane2,ocenyKoncowe) VALUES 
            (1,1,'4','4','5-','5'),
            (1,2,'4','4','5','5'),
            (2,1, '3+','3','4','4'),
            (2,3,'5-','5','5-','5'),
            (1,3,'2','2','3',''),
            (1,4,'4','4','5',''),
            (2,5,'4','4','4',''),
            (2,6,'4-','3+','4+',''),
            (2,7,'5+','5+','6','');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO oceny_szczegoly (oceny_id, ocenaNr, waga,dataOceny,Liczona,Semestr) VALUES 
            -- Historia i Społeczeństwo uczen Jakub
            (1,'3','2','2020-10-07 12:36:36','Tak',1),
            (1,'4','3','2020-11-16 19:36:39','Tak',1),
            (1,'5','2','2021-01-09 12:36:36','Tak',1),
            (1,'5','2','2021-03-07 18:36:38','Tak',2),
            (1,'5','1','2021-04-07 11:36:31','Tak',2),
            (1,'5','3','2021-05-15 13:36:32','Tak',2),
            --  Angielski uczen Jakub
            (2,'4','1','2020-10-07 18:45:36','Tak',1),
            (2,'4+','1','2020-11-16 19:26:36','Tak',1),
            (2,'4','3','2021-01-09 12:16:36','Tak',1),
            (2,'5','4','2021-03-07 18:46:36','Tak',2),
            (2,'6-','3','2021-04-07 11:56:36','Tak',2),
            (2,'5','1','2021-05-07 13:36:36','Tak',2),
            (2,'5','1','2021-05-24 13:36:36','Nie',2),
            --  Historia i Społeczeństwo uczen Bartek
            (3,'3','1','2020-10-07 18:45:36','Tak',1),
            (3,'2+','1','2020-11-16 19:26:36','Tak',1),
            (3,'6','3','2021-01-09 12:16:36','Tak',1),
            (3,'4','4','2021-03-07 18:46:36','Tak',2),
            (3,'6-','3','2021-04-07 11:56:36','Tak',2),
            (3,'5','1','2021-05-09 13:36:36','Tak',2),
            --  Matematyka uczen Bartek
            (4,'5','1','2020-10-07 18:45:36','Tak',1),
            (4,'5','1','2020-11-16 19:26:36','Tak',1),
            (4,'5','3','2021-01-09 12:16:36','Tak',1),
            (4,'5','4','2021-03-03 18:46:36','Tak',2),
            (4,'5-','3','2021-04-07 11:56:36','Tak',2),
            (4,'5+','1','2021-05-07 13:36:36','Tak',2),
            (4,'5','1','2021-05-21 13:36:36','Nie',2),
            --  Matematyka uczen Jakub
            (5,'4+','1','2020-10-07 18:48:56','Tak',1),
            (5,'2','1','2020-11-16 19:26:21','Tak',1),
            (5,'1','3','2021-01-09 12:16:32','Tak',1),
            (5,'4-','4','2021-03-03 21:46:36','Tak',2),
            (5,'2+','3','2021-04-07 01:56:16','Tak',2),
            (5,'3','1','2021-05-07 23:36:46','Tak',2),
            --  Aplikacje uczen Jakub
            (6,'5','1','2020-10-04 18:45:36','Tak',1),
            (6,'4','1','2020-11-02 09:26:36','Tak',1),
            (6,'4','3','2021-01-11 22:16:16','Tak',1),
            (6,'5','4','2021-03-03 22:46:16','Tak',2),
            (6,'5-','3','2021-04-07 09:56:36','Tak',2),
            (6,'5+','1','2021-05-07 08:36:36','Tak',2),
            --  Systemy uczen Bartek
            (7,'4+','1','2020-10-07 18:48:56','Tak',1),
            (7,'3','1','2020-11-16 19:26:21','Tak',1),
            (7,'4','3','2021-01-09 12:16:32','Tak',1),
            (7,'4-','4','2021-03-03 21:46:36','Tak',2),
            (7,'4+','3','2021-04-07 01:56:16','Tak',2),
            (7,'3','1','2021-05-07 23:36:46','Tak',2),
            --  Niemiecki uczen Bartek
            (8,'2','1','2020-10-04 18:45:36','Tak',1),
            (8,'3','1','2020-11-02 09:26:36','Tak',1),
            (8,'5','3','2021-01-11 22:16:16','Tak',1),
            (8,'3','4','2021-03-03 22:46:16','Tak',2),
            (8,'5-','3','2021-04-07 09:56:36','Tak',2),
            (8,'5+','1','2021-05-07 08:36:36','Tak',2),
            --  Witryny uczen Bartek
            (9,'4','1','2020-10-04 18:45:36','Tak',1),
            (9,'4','1','2020-11-02 09:26:36','Tak',1),
            (9,'6','3','2021-01-11 22:16:16','Tak',1),
            (9,'6','4','2021-03-03 22:46:16','Tak',2),
            (9,'6-','3','2021-04-07 09:56:36','Tak',2),
            (9,'6','1','2021-05-07 08:36:36','Tak',2);";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO sprawdziany (user_id,zajecia_id,rodzaj,temat,szczegoly,termin) VALUES
            (1,1,'Sprawdzian','Polska w XX wieku','Wagi 4','2021-05-24'),
            (2,1,'Sprawdzian','Polska w XX wieku','Wagi 4','2021-05-24'),
            (2,2,'kartkówka','Słownictwo','','2021-05-18'),
            (1,2,'kartkówka','Dzial 8','','2021-05-26'),
            (1,3,'kartkówka','Trygonometria','','2021-05-28'),
            (2,4,'kartkówka','Ajax','','2021-05-24'),
            (1,5,'kartkówka','Server backup','','2021-05-30'),
            (2,6,'kartkówka','Kuchnia-słownictwo','','2021-06-1'),
            (1,7,'Sprawdzian','JS-podstawy','Wagi 4','2021-06-3'),
            (2,8,'Sprawdzian','Lalka-sprawdzian','Wagi 5','2021-06-2'),
            (1,9,'Sprawdzian','SSMS - backup bazy','Wagi 4','2021-05-24');";
            $wynik = $connect->query($sql);
            $sql = "
            INSERT INTO frekfencja (user_id,zajecia_id,dataZajec,czasZajec,status,komentarz,tresc) VALUES
            (1,1,'2021-05-13','11:50-12:35','Usprawiedliwione','','Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza'),
            (1,2,'2021-05-15','11:50-12:35','spóźnienie','10 minut po',''),
            (1,3,'2021-05-14','11:50-12:35','Nieusprawiedliwione','Ucieczka z lekcji',''),
            (2,2,'2021-05-09','11:50-12:35','Usprawiedliwione','','Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza'),

            (1,2,'2021-05-11','11:50-12:35','Wniosek o Usprawieliwienie','','Proszę o usprawiedliwienie nieobecności mojego syna z powodu jego obecności na pogrzebie'),
            (2,2,'2021-05-17','12:45-13:30','Nieusprawiedliwione','','Proszę o usprawiedliwienie :)'),
            (2,2,'2021-05-21','8:00-8:45','Nieusprawiedliwione','','Proszę usprawiedliwić'),
            (2,2,'2021-05-18','10:45-11:30','Usprawiedliwione','','Proszę o usprawiedliwienie nieobecności z powodu wizyty u dentysty'),
            (1,2,'2021-05-19','14:35-15:20','spóźnienie','Uczeń pojawił się 5 minut przed końcem zajęć',''),
            (2,2,'2021-05-14','11:50-12:35','Usprawiedliwione','','Proszę usprawiedliwić, syn był potrzebny przy przeprowadzce');";
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
            else echo "<p class='raport'>Blad w Insercie danych</p>";
            $connect->close();
        };
        
    ?>
        
</body>
</html>