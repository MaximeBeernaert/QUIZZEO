<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Menu</title>
        <link rel="stylesheet" href="header.css">
    </head>

    <body>
    <?php
    session_start();
    require('DBconnexion.php');
    $user = $_SESSION['user'];
?>
        <header>
            <div class="image">
                <img src="image-removebg-preview (1).png" class="image">
                <h1><a href="accueil.php">QUIZZEO</a></h1>
            </div>
            <h2><a href="">Scores</a> | <a href="">Panel admin</a> | <a href="">Questions quizz</a> | <a href="">Déconnexion</a></h2>
        </header>
        <div class="elements">

        </div>
        <footer>
           <p> Company ©IPSSI . All rights reserved.</p>
        </footer>
    </body>
</html>