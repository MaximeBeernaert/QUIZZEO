<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link to the header.css -->
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php
    // we connect to the Session and the database, and since this page is called almost eveywhere, all the pages will have access to the session and database
    session_start();
    require('DBconnexion.php');
    // We also check if the user is connected 
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }

    ?>
    <header>
        <!-- HTML of the header -->
        <div class="containerHeader">
            <div class="containerIPSSI">
                <img src="ipssi-logo.png" class="image">
            </div>
            <div class="containerQuizzeo">
                <p><a href="accueil.php">QUIZZEO<br>HARRY POTTER</a></p>

            </div>
            <div class="containerAccount">
                <p class="accountName"><a href="personalspace.php">Compte de <?php echo $_SESSION['user']['prenom_utilisateur'] ?></a></p>
                <p classe="decoText"><a href="logout.php"><img class="decoIcone" src="deco.png" class="image"> Déconnexion</a></p>
            </div>
        </div>
        <div class="containerOptions">
            <?php
            if ($_SESSION['user']['type_utilisateur'] == 2) {
                echo "<p class='optionHeader'><a href='admin.php'>Administration</a></p><p class='spaceHeader'>|</p>";
            }
            if ($_SESSION['user']['type_utilisateur'] != 0) {
                echo "<p class='optionHeader'><a href='createquizz.php'>Création de quizz</a></p> <p class='spaceHeader'>|</p>";
            }
            if (isset($_COOKIE['currentHouse'])) {
                $currentHouse = $_COOKIE['currentHouse'];
            } else {
                $currentHouse = 'houseButton Serpentard';
            }

            ?>
            <p class='optionHeader'><a href="score.php">Mes Scores</a></p>
            <p class='spaceHeader'>|</p>
            <p class='optionHeader'><a href="usermenu.php">Retour menu principal</a></p>
            <p class='spaceHeader'>|</p>
            <?php
            echo "<img class='$currentHouse' src=''></div>"
            ?>
        </div>

    </header>