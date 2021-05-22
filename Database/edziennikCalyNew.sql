-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Maj 2021, 19:32
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `edziennik3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `frekfencja`
--

CREATE TABLE `frekfencja` (
  `frekfencja_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zajecia_id` int(11) DEFAULT NULL,
  `dataZajec` date DEFAULT NULL,
  `czasZajec` varchar(11) COLLATE utf8_polish_ci DEFAULT NULL,
  `status` varchar(40) COLLATE utf8_polish_ci DEFAULT NULL,
  `komentarz` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `tresc` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `frekfencja`
--

INSERT INTO `frekfencja` (`frekfencja_id`, `user_id`, `zajecia_id`, `dataZajec`, `czasZajec`, `status`, `komentarz`, `tresc`) VALUES
(1, 1, 1, '2021-05-12', '11:50-12:35', 'Usprawiedliwione', '', 'Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza'),
(2, 1, 2, '2021-05-15', '11:50-12:35', 'spoznienie', '10 minut po', ''),
(3, 1, 3, '2021-05-12', '11:50-12:35', 'Nieusprawiedliwione', 'Ucieczka z lekcji', ''),
(4, 2, 2, '2021-05-12', '11:50-12:35', 'Usprawiedliwione', '', 'Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny_all`
--

CREATE TABLE `oceny_all` (
  `oceny_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zajecia_id` int(11) DEFAULT NULL,
  `ocenyPrzewidywane1` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyOkresowe` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyPrzewidywane2` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyKoncowe` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `oceny_all`
--

INSERT INTO `oceny_all` (`oceny_id`, `user_id`, `zajecia_id`, `ocenyPrzewidywane1`, `ocenyOkresowe`, `ocenyPrzewidywane2`, `ocenyKoncowe`) VALUES
(1, 1, 1, '4', '4', '5-', '5'),
(2, 1, 2, '4', '4', '5', '5'),
(3, 2, 1, '3+', '3', '4', '4'),
(4, 2, 3, '5-', '5', '5-', '5');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny_szczegoly`
--

CREATE TABLE `oceny_szczegoly` (
  `ocena1_id` int(11) NOT NULL,
  `oceny_id` int(11) DEFAULT NULL,
  `ocenaNr` enum('1','1+','2-','2','2+','3-','3','3+','4-','4','4+','5-','5','5+','6-','6') COLLATE utf8_polish_ci DEFAULT NULL,
  `waga` int(11) DEFAULT NULL,
  `dataOceny` datetime DEFAULT NULL,
  `Liczona` enum('Tak','Nie') COLLATE utf8_polish_ci DEFAULT NULL,
  `Semestr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `oceny_szczegoly`
--

INSERT INTO `oceny_szczegoly` (`ocena1_id`, `oceny_id`, `ocenaNr`, `waga`, `dataOceny`, `Liczona`, `Semestr`) VALUES
(1, 1, '3', 2, '2020-10-07 12:36:36', 'Tak', 1),
(2, 1, '4', 3, '2020-11-16 19:36:39', 'Tak', 1),
(3, 1, '5', 2, '2021-01-09 12:36:36', 'Tak', 1),
(4, 1, '5', 2, '2021-03-07 18:36:38', 'Tak', 2),
(5, 1, '5', 1, '2021-04-07 11:36:31', 'Tak', 2),
(6, 1, '5', 3, '2021-05-15 13:36:32', 'Tak', 2),
(7, 2, '4', 1, '2020-10-07 18:45:36', 'Tak', 1),
(8, 2, '4+', 1, '2020-11-16 19:26:36', 'Tak', 1),
(9, 2, '4', 3, '2021-01-09 12:16:36', 'Tak', 1),
(10, 2, '5', 4, '2021-03-07 18:46:36', 'Tak', 2),
(11, 2, '6-', 3, '2021-04-07 11:56:36', 'Tak', 2),
(12, 2, '5', 1, '2021-05-07 13:36:36', 'Tak', 2),
(13, 2, '5', 1, '2021-05-24 13:36:36', 'Nie', 2),
(14, 3, '3', 1, '2020-10-07 18:45:36', 'Tak', 1),
(15, 3, '2+', 1, '2020-11-16 19:26:36', 'Tak', 1),
(16, 3, '6', 3, '2021-01-09 12:16:36', 'Tak', 1),
(17, 3, '4', 4, '2021-03-07 18:46:36', 'Tak', 2),
(18, 3, '6-', 3, '2021-04-07 11:56:36', 'Tak', 2),
(19, 3, '5', 1, '2021-05-09 13:36:36', 'Tak', 2),
(20, 4, '5', 1, '2020-10-07 18:45:36', 'Tak', 1),
(21, 4, '5', 1, '2020-11-16 19:26:36', 'Tak', 1),
(22, 4, '5', 3, '2021-01-09 12:16:36', 'Tak', 1),
(23, 4, '5', 4, '2021-03-03 18:46:36', 'Tak', 2),
(24, 4, '5-', 3, '2021-04-07 11:56:36', 'Tak', 2),
(25, 4, '5+', 1, '2021-05-07 13:36:36', 'Tak', 2),
(26, 4, '5', 1, '2021-05-21 13:36:36', 'Nie', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `ogloszenia_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tytul` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `tresc` text COLLATE utf8_polish_ci,
  `dataOgloszenia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`ogloszenia_id`, `user_id`, `tytul`, `tresc`, `dataOgloszenia`) VALUES
(1, 1, 'OGŁOSZENIE', 'Szanowni Państwo, Gdyńskie Centrum Zdrowia zaprasza rodziców/ opiekunów prawnych do wypełnienia kwestionariusza wstępnej oceny kondycji zdrowotnej dziecka dostępnej pod adresem: https://zdrowie.gdynia.pl/ankieta-kzd/ . Odpowiadając na pytania z ankiety otrzymają Państwo krótkie porady i wskazówki dotyczące różnych obszarów rozwoju dziecka oraz informacje na temat oferty Gminy Miasta Gdyni w zakresie zdrowia skierowanej do dzieci. Ankieta jest anonimowa, a gromadzone dane statystyczne pozwolą ulepszyć i poszerzyć ofertę działań skierowanych do młodych Gdynian. Dodatkowo kwestionariusz ankiety jest także narzędziem rekrutacyjnym do kolejnej edycji programu polityki zdrowotnej pn. „Program polityki zdrowotnej w zakresie profilaktyki i leczenia nadwagi i otyłości w populacji młodzieży w Gminie Miasta Gdyni. Kontynuacja na lata 2020 – 2021.”, której rozpoczęcie planowane jest w listopadzie br. Więcej informacji na temat obecnej, kończącej się już edycji programu znajdą Państwo tutaj: https://gcz.gdynia.pl/programy-i-projekty/gdynski-zdrowy-uczen/program-polityki-zdrowotnej-w-zakresie-profilaktyki-i-leczenia-nadwagi-i-otylosci-w-populacji-mlodziezy-w-gminie-miasta-gdyni/ Zachęcamy do wypełnienia ankiety', '2021-05-06 08:53:22'),
(2, 2, 'KOMUNIKAT', 'E-dziennik jest już do pobrania w aplikacji Gdynia.pl. Od dziś łatwiej będzie zarówno o zachowanie kontaktu z placówką, zgłoszenie nieobecności, jak i sprawdzenie ocen. Wszystkie funkcje e-dziennika z Konta Mieszkańca mogą od teraz być dostępne na Państwa smartfonach.', '2020-10-06 14:03:13'),
(3, 1, 'KOMUNIKAT', 'Dzień dobry, Szanowni Rodzice Uczniowie w wieku 7 lat lub starsi jeżdżą za darmo w gdyńskich autobusach i trolejbusach, jeżeli mieszkają w Gdyni i posiadają poświadczający to dokument. Jeżeli uczeń używa legitymacji szkolnej, prosimy o sprawdzenie, czy jest tam wpisany gdyński adres zamieszkania! Jeśli nie ma informacji o adresie, potrzebny jest dodatkowy dokument! Może to być pisemne zaświadczenie ze szkoły lub Karta Mieszkańca. WAŻNA INFORMACJA: Jeżeli uczeń posiada Kartę Mieszkańca, należy pamiętać o przedłużeniu uprawnień do bezpłatnych przejazdów do 30 września w gdyńskim InfoBoksie (przy ul. Świętojańskiej 30 od poniedziałku do piątku w godz. 8.00-18.00). Aby to zrobić, potrzebna będzie aktualna legitymacja szkolna + zaświadczenie o adresie zamieszkania jeśli nie ma takiej adnotacji w legitymacji. Dzięki posiadaniu Karty Mieszkańca, legitymacja szkolna nie będzie już potrzebna w pojazdach ZKM. Szczegółowe informacje na temat bezpłatnych przejazdów dla gdyńskich dzieci i młodzieży znajdują się na stronie zkmgdynia.pl', '2020-09-09 13:45:28'),
(4, 2, 'KOMUNIKAT', 'Gdyńskie Centrum Zdrowia zaprasza rodziców bądź opiekunów prawnych dziewczynek mieszkających lub zameldowanych na terenie Gdyni i urodzonych w roku 2006 lub 2007, do zarejestrowania ich do programu szczepień ochronnych przeciwko wirusowi brodawczaka ludzkiego HPV. Szczepienia ochronne przeciwko HPV to bezpieczna i skuteczna forma profilaktyki nowotworowej. Wirus HPV jest najczęstszą przyczyną raka szyjki macicy, może również prowadzić do rozwoju raka odbytu, sromu, pochwy, języka lub gardła. Zgłoszeń na szczepienia można dokonywać poprzez formularz rejestracyjny dostępny na stronie internetowej www.zdrowie.gdynia.pl/hpv (przycisk „Zgłoś do programu\"). Po prawidłowym dokonaniu zgłoszenia zachęcamy do kontaktu bezpośrednio z przychodnią dziecka realizującą szczepienie w celu umówienia dogodnego terminu wizyty szczepiennej, jeszcze przed wzrostem częstości infekcji w okresie jesienno-zimowym. Więcej informacji na stronie: https://gcz.gdynia.pl/aktualnosci/2020/08/gdynia-ponownie-uruchomia-zapisy-do-programu-szczepien-ochronnych-przeciwko-hpv-dla-gdynskich-dziewczynek/ Szczepienia wykonywane są w ramach programu polityki zdrowotnej: „Program profilaktyki zakażeń wirusami brodawczaka ludzkiego (HPV) na terenie Gminy Miasta Gdyni na lata 2018 – 2020\", realizowanego w całości ze środków miasta Gdyni.', '2020-09-07 14:28:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprawdziany`
--

CREATE TABLE `sprawdziany` (
  `sprawdziany_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zajecia_id` int(11) DEFAULT NULL,
  `rodzaj` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `temat` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `szczegoly` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `termin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sprawdziany`
--

INSERT INTO `sprawdziany` (`sprawdziany_id`, `user_id`, `zajecia_id`, `rodzaj`, `temat`, `szczegoly`, `termin`) VALUES
(1, 1, 1, 'Sprawdzian', 'Polska w XX wieku', 'Wagi 4', '2021-05-24'),
(2, 2, 1, 'Sprawdzian', 'Polska w XX wieku', 'Wagi 4', '2021-05-24'),
(3, 2, 2, 'kartkówka', 'Słownictwo', '', '2021-05-18'),
(4, 1, 2, 'kartkówka', 'Dzial 8', '', '2021-05-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `dataSystemu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`user_id`, `login`, `password`, `username`, `dataSystemu`) VALUES
(1, 'Jakub', 'qwerty', 'Jakub Selonke', '2021-05-06 08:53:22'),
(2, 'Bartek', 'pass0', 'Bartosz Rożyk', '2021-05-06 08:53:22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zachowanie`
--

CREATE TABLE `zachowanie` (
  `zachowanie_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ocenaPrzewidywana1` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenaOkresowa` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenaPrzewidywana2` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenaKoncowa` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zachowanie`
--

INSERT INTO `zachowanie` (`zachowanie_id`, `user_id`, `ocenaPrzewidywana1`, `ocenaOkresowa`, `ocenaPrzewidywana2`, `ocenaKoncowa`) VALUES
(1, 1, 'Bardzo Dobry', '	Bardzo Dobry', 'Celujący', 'Celujący'),
(2, 2, 'Dobry', 'Dobry', 'Dobry', 'Bardzo Dobry');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zajecia`
--

CREATE TABLE `zajecia` (
  `zajecia_id` int(11) NOT NULL,
  `zajeciaNazwa` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `nauczyciel` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zajecia`
--

INSERT INTO `zajecia` (`zajecia_id`, `zajeciaNazwa`, `nauczyciel`) VALUES
(1, 'Historia i Społeczeństwo', 'Monika Ebertowska'),
(2, 'Angielski', 'Teresa Guzek'),
(3, 'Matematyka', 'Wiolleta Pisała');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `frekfencja`
--
ALTER TABLE `frekfencja`
  ADD PRIMARY KEY (`frekfencja_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `zajecia_id` (`zajecia_id`);

--
-- Indexes for table `oceny_all`
--
ALTER TABLE `oceny_all`
  ADD PRIMARY KEY (`oceny_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `zajecia_id` (`zajecia_id`);

--
-- Indexes for table `oceny_szczegoly`
--
ALTER TABLE `oceny_szczegoly`
  ADD PRIMARY KEY (`ocena1_id`),
  ADD KEY `oceny_id` (`oceny_id`);

--
-- Indexes for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`ogloszenia_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sprawdziany`
--
ALTER TABLE `sprawdziany`
  ADD PRIMARY KEY (`sprawdziany_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `zajecia_id` (`zajecia_id`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `zachowanie`
--
ALTER TABLE `zachowanie`
  ADD PRIMARY KEY (`zachowanie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `zajecia`
--
ALTER TABLE `zajecia`
  ADD PRIMARY KEY (`zajecia_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `frekfencja`
--
ALTER TABLE `frekfencja`
  MODIFY `frekfencja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `oceny_all`
--
ALTER TABLE `oceny_all`
  MODIFY `oceny_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `oceny_szczegoly`
--
ALTER TABLE `oceny_szczegoly`
  MODIFY `ocena1_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `ogloszenia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `sprawdziany`
--
ALTER TABLE `sprawdziany`
  MODIFY `sprawdziany_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zachowanie`
--
ALTER TABLE `zachowanie`
  MODIFY `zachowanie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zajecia`
--
ALTER TABLE `zajecia`
  MODIFY `zajecia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `frekfencja`
--
ALTER TABLE `frekfencja`
  ADD CONSTRAINT `frekfencja_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`),
  ADD CONSTRAINT `frekfencja_ibfk_2` FOREIGN KEY (`zajecia_id`) REFERENCES `zajecia` (`zajecia_id`);

--
-- Ograniczenia dla tabeli `oceny_all`
--
ALTER TABLE `oceny_all`
  ADD CONSTRAINT `oceny_all_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`),
  ADD CONSTRAINT `oceny_all_ibfk_2` FOREIGN KEY (`zajecia_id`) REFERENCES `zajecia` (`zajecia_id`);

--
-- Ograniczenia dla tabeli `oceny_szczegoly`
--
ALTER TABLE `oceny_szczegoly`
  ADD CONSTRAINT `oceny_szczegoly_ibfk_1` FOREIGN KEY (`oceny_id`) REFERENCES `oceny_all` (`oceny_id`);

--
-- Ograniczenia dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD CONSTRAINT `ogloszenia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`);

--
-- Ograniczenia dla tabeli `sprawdziany`
--
ALTER TABLE `sprawdziany`
  ADD CONSTRAINT `sprawdziany_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`),
  ADD CONSTRAINT `sprawdziany_ibfk_2` FOREIGN KEY (`zajecia_id`) REFERENCES `zajecia` (`zajecia_id`);

--
-- Ograniczenia dla tabeli `zachowanie`
--
ALTER TABLE `zachowanie`
  ADD CONSTRAINT `zachowanie_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`),
  ADD CONSTRAINT `zachowanie_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
