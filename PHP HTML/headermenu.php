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
                <p><a href="logout.php">Déconnexion</a></p>
            </div>
        </div>
        <div class="containerOptions">
            <p><a href="usermenu.php">Retour menu principal</a></p>
        </div>

    </header>