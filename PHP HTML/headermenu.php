<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <style>
        /* style specific to this page, since it is not linked to header.php but follow the same lines */
        header {
            background-color: #37373c;
        }

        .containerHeader {
            background-image: url("poudlard.jpeg");
        }

        .banner {
            background-color: #4d4d61;
        }

        .containerPage {
            min-height: 70.5vh;
            margin: 0 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    // connect to the session
    session_start();
    // connect to the database
    require('DBconnexion.php');
    if (!isset($_SESSION['user'])) {
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

                </div>

            </div>
            <div class="containerOptions">
                <p class='spaceHeader'>|</p>
                <p class="accountName"><a href="login.php">Connexion</a></p>

                <p class='spaceHeader'>|</p>
                <p classe="decoText"><a href="signin.php">Inscription</a></p>
                <p class='spaceHeader'>|</p>
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
                // if the user is an admin 
                if ($_SESSION['user']['type_utilisateur'] == 2) {
                    echo "<p class='optionHeader'><a href='admin.php'>Administration</a></p><p class='spaceHeader'>|</p>";
                }
                // if the user is not a single user
                if ($_SESSION['user']['type_utilisateur'] != 0) {
                    echo "<p class='optionHeader'><a href='createquizz.php'>Création de quizz</a></p> <p class='spaceHeader'>|</p>";
                }

                ?>
                <p class='optionHeader'><a href="score.php">Mes Scores</a></p>
                <p class='spaceHeader'>|</p>
                <p class='optionHeader'><a href="usermenu.php">Retour menu principal</a></p>
            </div>

        </header>
    <?php
    }
    ?>