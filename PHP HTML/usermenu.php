<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Menu</title>
    <link rel="stylesheet" href="usermenu.css">
</head>

<body>
    <?php
    session_start();
    require('DBconnexion.php');
    $user = $_SESSION['user'];
    ?>
    <header>
        <h1>QUIZZEO</h1>
        <p>Menu utilisateur</p>
    </header>

    <div class="userinfo">
        <p>Vous êtes connecté sous le compte de <?php echo $user['nom_utilisateur'] . " " . $user['prenom_utilisateur'] ?></p>
    </div>

    <container>
        <ul>
            <li><a href="quizzlist.php" class="link1">Jouer aux quizz</a></li>
            <li><a href="score.php" class="link2">Voir les scores</a></li>
            <li><a href="createquizz.php" class="link3">Créer les quizz</a></li>
            <li><a href="admin.php" class="link4">Accéder au panel admin</a></li>
        </ul>
    </container>
    <a id="retour" href="accueil.php">Retour à l'accueil</a>
</body>


</html>