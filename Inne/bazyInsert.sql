1. Tabela Uzytkownik

INSERT INTO uzytkownik (login, password, username, dataSystemu) VALUES 
('Jakub', 'qwerty',"Jakub Selonke","2021-05-06 08:53:22"),
('Bartek', 'pass0',"Bartosz Rożyk","2021-05-06 08:53:22" );

2. Tabela Oceny

INSERT INTO oceny (user_id,zajecia_id, ocenySemestr1, ocenyPrzewidywane1, ocenyOkresowe,ocenySemestr2,ocenyPrzewidywane2,ocenyKoncowe) VALUES 
(1,1,"4, 4+, 4, 4, 4, 4, 4+","4","4","+, 5-, 5-, 5, 3, 4+","5-","5"),
(1,2,"6, nb, 5, 6-, 5+, 6","6","6","6, 6, 5, 5, 5, 6","6-","6"),
(2,1,"4, 5, 4","4","4","4, 5-, 4","5","5"),
(2,2,"5, 5, 5-, 5+","5-","5","4+, 5, 5, 4, 5","5-","5"),
(2,3,"4-, 2+, 3, 2+, 1, 2-, 1","2","2","4, 2-, 1,2+,2+","2","2");

3. Tabela zajecia
INSERT INTO zajecia (zajeciaNazwa,nauczyciel) VALUES
("Historia i Społeczeństwo","Monika Ebertowska"),
("Angielski","Teresa Guzek"),
("Matematyka","Wiolleta Pisała");

4. Tabela sprawdziany
INSERT INTO sprawdziany (user_id,zajecia_id,rodzaj,temat,szczegoly,termin) VALUES
(1,1,"Sprawdzian","Polska w XX wieku","Wagi 4","2021-05-24"),
(2,2,"kartkówka","Słownictwo","","2021-05-18");

5. Tablea frekfencja
INSERT INTO frekfencja (user_id,zajecia_id,dataZajec,czasZajec,status,komentarz,tresc) VALUES
(1,1,"2021-05-12","11:50-12:35","Usprawiedliwione","","Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza"),
(1,3,"2021-05-12","11:50-12:35","Nieusprawiedliwione","Ucieczka z lekcji",""),
(2,2,"2021-05-12","11:50-12:35","Usprawiedliwione","","Proszę o usprawiedliwienie nieobecności mojego syna z powodu wizyty u lekarza");

6. Tabela zachowanie
INSERT INTO zachowanie (user_id,ocenaPrzewidywana1,ocenaOkresowa,    ocenaPrzewidywana2,ocenaKoncowa) VALUES
(1,"Bardzo Dobry","	Bardzo Dobry","Celujący","Celujący"),
(2,"Dobry","Dobry","Dobry","Bardzo Dobry");

7. Tabela ogloszenia
INSERT INTO ogloszenia (user_id,tytul,tresc,dataOgloszenia) VALUES
(1,"OGŁOSZENIE","Szanowni Państwo, Gdyńskie Centrum Zdrowia zaprasza rodziców/ opiekunów prawnych do wypełnienia kwestionariusza wstępnej oceny kondycji zdrowotnej dziecka dostępnej pod adresem: https://zdrowie.gdynia.pl/ankieta-kzd/ . Odpowiadając na pytania z ankiety otrzymają Państwo krótkie porady i wskazówki dotyczące różnych obszarów rozwoju dziecka oraz informacje na temat oferty Gminy Miasta Gdyni w zakresie zdrowia skierowanej do dzieci. Ankieta jest anonimowa, a gromadzone dane statystyczne pozwolą ulepszyć i poszerzyć ofertę działań skierowanych do młodych Gdynian. Dodatkowo kwestionariusz ankiety jest także narzędziem rekrutacyjnym do kolejnej edycji programu polityki zdrowotnej pn. „Program polityki zdrowotnej w zakresie profilaktyki i leczenia nadwagi i otyłości w populacji młodzieży w Gminie Miasta Gdyni. Kontynuacja na lata 2020 – 2021.”, której rozpoczęcie planowane jest w listopadzie br. Więcej informacji na temat obecnej, kończącej się już edycji programu znajdą Państwo tutaj: https://gcz.gdynia.pl/programy-i-projekty/gdynski-zdrowy-uczen/program-polityki-zdrowotnej-w-zakresie-profilaktyki-i-leczenia-nadwagi-i-otylosci-w-populacji-mlodziezy-w-gminie-miasta-gdyni/ Zachęcamy do wypełnienia ankiety","2021-05-06 08:53:22"),
(2,"KOMUNIKAT","E-dziennik jest już do pobrania w aplikacji Gdynia.pl. Od dziś łatwiej będzie zarówno o zachowanie kontaktu z placówką, zgłoszenie nieobecności, jak i sprawdzenie ocen. Wszystkie funkcje e-dziennika z Konta Mieszkańca mogą od teraz być dostępne na Państwa smartfonach.","2020-10-06 14:03:13");
