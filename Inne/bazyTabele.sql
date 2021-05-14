1. Tabela uzytkownik
create table uzytkownik(
    user_id int AUTO_INCREMENT,
    login varchar(50),
    password varchar(30),
    username varchar(50),
    dataSystemu DATETIME,
    primary key(user_id)
);
2. Tabela oceny
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
);
3. Tabela zajecia
create table zajecia(
    zajecia_id int AUTO_INCREMENT,
    zajeciaNazwa varchar(50),
    nauczyciel varchar(50),
    primary key(zajecia_id)

);
4. Tabela sprawdziany
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
);
5. Tabela frekfencja
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

);
6. Tabela Zachowanie

create table zachowanie(
    zachowanie_id int AUTO_INCREMENT,
    user_id int,
    -- username z user_id --> za pomoca inner join
    ocenaPrzewidywana1 varchar(30),
    ocenaOkresowa varchar(30),
    ocenaPrzewidywana2 varchar(30),
    ocenaKoncowa varchar(30),
    primary key(zachowanie_id),
    foreign key(user_id) references uzytkownik(user_id),
    foreign key(user_id) references uzytkownik(user_id)
);
7. Tabela Ogloszenia

create table ogloszenia(
    ogloszenia_id int AUTO_INCREMENT,
    user_id int,
    tytul varchar(50),
    tresc varchar(80),
    dataOgloszenia DATETIME,
    foreign key(user_id) references uzytkownik(user_id),
    primary key(ogloszenia_id)
);
