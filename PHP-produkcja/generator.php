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
<!-- Na razie nie działa -->
    <button class="btn" onclick=<?php
        $serwer = 'localhost';
        $user = 'root';
        $pass = '';

        $link = new mysqli($serwer, $user, $pass);

        $sql = "DROP DATABASE IF EXISTS `edziennik`;";
        $wynik = $link->query($sql);

        $sql = "CREATE DATABASE `edziennik`;";
        $wynik = $link->query($sql);

        $link->select_db("edziennik");

        $sql =<<<EOT
        create table uzytkownik(
            user_id int AUTO_INCREMENT,
            login varchar(50),
            password varchar(30),
            username varchar(50),
            dataSystemu DATETIME,
            primary key(user_id)
        );ENGINE=InnoDB DEFAULT CHARSET=utf8;
        EOT;

        $wynik = $link->query($sql);

        $sql =<<<EOT
        INSERT INTO uzytkownik (login, password, username, dataSystemu) VALUES 
        ('Jakub', 'qwerty',"Jakub Selonke","2021-05-06 08:53:22"),
        ('Bartek', 'pass0',"Bartosz Rożyk","2021-05-06 08:53:22" );
        EOT;

        $wynik = $link->query($sql);

        if ($wynik) echo "<p cllas='raport'>Baza utworzona</p>";
        else echo "<p cllas='raport'>Blad w utworzeniu</p>";

        $link->close();?>>Generuj Baze</button>
    <!-- <p class="raport">Wygenerowano poprawnie</p> -->
</body>
</html>