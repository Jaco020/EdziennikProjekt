-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Maj 2021, 18:01
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
-- Baza danych: `edziennik`
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
(2, 1, 3, '2021-05-12', '11:50-12:35', 'Nieusprawiedliwione', 'Ucieczka z lekcji', ''),
(3, 2, 2, '2021-05-12', '11:50-12:35', 'Usprawiedliwione', '', 'Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `oceny_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `zajecia_id` int(11) DEFAULT NULL,
  `ocenySemestr1` varchar(80) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyPrzewidywane1` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyOkresowe` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenySemestr2` varchar(80) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyPrzewidywane2` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL,
  `ocenyKoncowe` varchar(2) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`oceny_id`, `user_id`, `zajecia_id`, `ocenySemestr1`, `ocenyPrzewidywane1`, `ocenyOkresowe`, `ocenySemestr2`, `ocenyPrzewidywane2`, `ocenyKoncowe`) VALUES
(6, 1, 1, '4, 4+, 4, 4, 4, 4, 4+', '4', '4', '+, 5-, 5-, 5, 3, 4+', '5-', '5'),
(7, 1, 2, '6, nb, 5, 6-, 5+, 6', '6', '6', '6, 6, 5, 5, 5, 6', '6-', '6'),
(8, 2, 1, '4, 5, 4', '4', '4', '4, 5-, 4', '5', '5'),
(9, 2, 2, '5, 5, 5-, 5+', '5-', '5', '4+, 5, 5, 4, 5', '5-', '5'),
(10, 2, 3, '4-, 2+, 3, 2+, 1, 2-, 1', '2', '2', '4, 2-, 1,2+,2+', '2', '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `ogloszenia_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tytul` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `tresc` varchar(80) COLLATE utf8_polish_ci DEFAULT NULL,
  `dataOgloszenia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`ogloszenia_id`, `user_id`, `tytul`, `tresc`, `dataOgloszenia`) VALUES
(1, 1, 'OGŁOSZENIE', 'Szanowni Państwo, Gdyńskie Centrum Zdrowia zaprasza rodziców/ opiekunów prawnych', '2021-05-06 08:53:22'),
(2, 2, 'KOMUNIKAT', 'E-dziennik jest już do pobrania w aplikacji Gdynia.pl. Od dziś łatwiej będzie za', '2020-10-06 14:03:13');

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
(2, 2, 2, 'kartkówka', 'Słownictwo', '', '2021-05-18');

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
-- Indexes for table `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`oceny_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `zajecia_id` (`zajecia_id`);

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
  MODIFY `frekfencja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `oceny_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `ogloszenia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `sprawdziany`
--
ALTER TABLE `sprawdziany`
  MODIFY `sprawdziany_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Ograniczenia dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownik` (`user_id`),
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`zajecia_id`) REFERENCES `zajecia` (`zajecia_id`);

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
