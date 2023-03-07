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
    $type_utilisateur = $user['type_utilisateur'];
    ?>
    <header>
        <div class="image">
            <img src="6221df85c9729_.png" class="image">
            <h1><a href="accueil.php">QUIZZEO</a></h1>
        </div>
        <h2><a href="score.php">Scores</a> <?php if ($type_utilisateur == 2) : ?> | <a href="admin.php">Panel admin</a><?php endif ?> | <a href="createquizz.php">Créer un Quizz</a> | <a href="logout.php">Déconnexion</a></h2>
    </header>
    <footer>
        <p> Company ©IPSSI . All rights reserved.</p>
    </footer>
</body>

</html>