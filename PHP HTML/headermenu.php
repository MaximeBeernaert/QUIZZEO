<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php
    session_start();
    require('DBconnexion.php');
    if (!isset($_SESSION['user'])) {
    ?>
        <header>
            <div class="containerHeaderMenu">
                <div class="containerIPSSI">
                    <img src="ipssi-logo.png" class="image">
                </div>
                <div class="containerQuizzeo">
                    <p><a href="accueil.php">QUIZZEO<br>HARRY POTTER</a></p>

                </div>
                <div class="containerAccount">
                    <p class="accountName"><a href="login.php">Connexion</a></p>
                    <p classe="decoText"><a href="signin.php">Inscription</a></p>
                </div>
            </div>

        </header>
    <?php
    } else {
    ?>
        <header>
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
    <?php
    }
    ?>