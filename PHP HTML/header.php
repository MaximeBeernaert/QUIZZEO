<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Quizz</title>
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php
    session_start();
    require('DBconnexion.php');
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }

    ?>
    <header>
        <div class="containerHeader">
            <div class="containerIPSSI">
                <img src="ipssi-logo.png" class="image">
            </div>
            <div class="containerQuizzeo">
                <p><a href="accueil.php">QUIZZEO</a></p>

            </div>
            <div class="containerAccount">
                <p class="accountName"><a href="personalspace.php">Compte de <?php echo $_SESSION['user']['prenom_utilisateur'] ?></a></p>
                <p><a href="logout.php">Déconnexion</a></p>
            </div>
        </div>
        <div class="containerOptions">
            <?php
            if ($_SESSION['user']['type_utilisateur'] == 2) {
                echo "<p><a href='admin.php'>Administration</a></p><p>|</p>";
            }
            if ($_SESSION['user']['type_utilisateur'] != 0) {
                echo "<p><a href='createquizz.php'>Création de quizz</a></p> <p>|</p>";
            }
            ?>
            <p><a href="score.php">Mes Scores</a></p>
        </div>

    </header>