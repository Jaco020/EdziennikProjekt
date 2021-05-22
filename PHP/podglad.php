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
    <link rel="stylesheet" href="../CSS/podglad.css">
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
                            <?php 
                                require "connect.php";
                                $sql="select count(status) from frekfencja WHERE frekfencja.status='Nieusprawiedliwione' AND user_id=$_SESSION[user_id]";
                                $wynik = $polaczenie->query($sql);
                                if($wynik){$dane = $wynik->fetch_array();};
                            ?>
                            <td>Czy są nieobecności nieusprawiedliwione?</td>
                            <td class="<?php echo ($dane[0]>=1) ? 'warning' : 'green';?>">
                            <?php echo ($dane[0]>=1) ? 'Tak' : 'Nie';?></td>
                            <td><a href="./frekfencja.php">Nieobecności ucznia</a></td>
                        </tr>
                        <tr>
                            <?php 
                                $sql="select count(status) from frekfencja WHERE frekfencja.status='spóźnienie' AND user_id=$_SESSION[user_id]";
                                $wynik = $polaczenie->query($sql);
                                if($wynik){$dane = $wynik->fetch_array();};
                            ?>
                            <td>Data ostatniego spóźnienia</td>
                            <td class="<?php echo ($dane[0]>=1) ? 'warning' : 'green';?>">
                            <?php
                            if($dane[0]>=1){
                                $sql="select dataZajec from frekfencja WHERE frekfencja.status='spóźnienie' AND user_id=$_SESSION[user_id] order by dataZajec desc LIMIT 1";
                                $wynik = $polaczenie->query($sql);
                                $dane = $wynik->fetch_array();
                                echo "$dane[0]";
                            }else{echo"Brak";}
                            ?>
                            </td>
                            <td><a href="./frekfencja.php">Spóźnienia ucznia</a></td>
                        </tr>
                        <tr>
                            <?php 
                                $sql="select count(rodzaj) from sprawdziany WHERE user_id=$_SESSION[user_id]";
                                $wynik = $polaczenie->query($sql);
                                if($wynik){$dane = $wynik->fetch_array();};  
                            ?>
                            <td>Czy są zaplanowane Prace?</td>
                            <td class="<?php echo ($dane[0]>=1) ? 'warning' : 'green';?>">
                            <?php echo ($dane[0]>=1) ? 'Tak' : 'Brak';?></td>
                            <td><a href="./sprawdziany.php">Zaplanowane Pracy</a></td>
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
                        <?php
                            $sql="select zajecia.zajeciaNazwa,oceny_szczegoly.ocenaNr ,oceny_szczegoly.waga,oceny_szczegoly.dataOceny,oceny_szczegoly.Liczona from oceny_all inner JOIN zajecia on zajecia.zajecia_id=oceny_all.zajecia_id INNER JOIN oceny_szczegoly on oceny_szczegoly.oceny_id=oceny_all.oceny_id where user_id=$_SESSION[user_id] order by oceny_szczegoly.dataOceny DESC LIMIT 5;";
                            $wynik = $polaczenie->query($sql);
                            if($wynik){
                                while($row=$wynik->fetch_array()){
                                    echo "
                                    <tr class='noneBottom'>
                                        <td>$row[0]</td>
                                        <td>$row[1]</td>
                                        <td>$row[2]</td>
                                        <td>$row[3]</td>
                                        <td>$row[4]</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </table>
                </div>
                <div class="infoRow__item" style="margin-left: 50px;">
                    <h3>Najnowsze Ogłoszenie</h3>
                    <div class="ogloszenie">
                        <?php 
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $sql="select count(status) from frekfencja WHERE frekfencja.status='Nieusprawiedliwione' AND user_id=$_SESSION[user_id]";
        $wynik = $polaczenie->query($sql);
        if($wynik){
            $dane = $wynik->fetch_array();
            $nieusprawiedliwione = $dane[0];
        };
        $sql="select count(status) from frekfencja WHERE frekfencja.status='Wniosek o Usprawieliwienie' AND user_id=$_SESSION[user_id]";
        $wynik = $polaczenie->query($sql);
        if($wynik){
            $dane = $wynik->fetch_array();
            $wnioskowane = $dane[0];
        };
        $sql="select count(status) from frekfencja WHERE frekfencja.status='Usprawiedliwione' AND user_id=$_SESSION[user_id]";
        $wynik = $polaczenie->query($sql);
        if($wynik){
            $dane = $wynik->fetch_array();
            $usprawiedliwione = $dane[0];
        };
        echo "$usprawiedliwione,$wnioskowane,$nieusprawiedliwione";
    ?>
    <script>
        var wykresObiekt = document.getElementById("wykresFrekfencja").getContext("2d");
        const uczenGodzinyData = [<?php echo $nieusprawiedliwione?>,<?php echo $wnioskowane?>,<?php echo $usprawiedliwione?>];
        Chart.defaults.font.size = 15;
        var wykresFrekfencja = new Chart(wykresObiekt,{
            type: 'bar',
            data: {
                labels:["Nieobecności",["Wniosek", "o usprawiedliwienie"],"Usprawiedliwone"],
                datasets: [{
                    label:'Godziny',
                    data:uczenGodzinyData,
                    backgroundColor:"#2456e0"// --blue-500
                }]
            },
            options:{
                scales:{
                    y:{
                        max:Math.max(...uczenGodzinyData)+5,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins:{
                    legend:{
                        display:false,
                    }
                }
            }
        });
    </script>
    <!-- <script src="../JavaScript/wykres.js"></script> -->
    <script src="../JavaScript/podglad.js">
    </script>
    <?php
        exit();
        $polaczenie->close();
    ?>   
</body>
</html>