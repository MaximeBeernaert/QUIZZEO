<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Menu</title>
    <link rel="stylesheet" href="test.css">
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
            <li><a href="jouer" class="link1">Jouer aux quizz</a></li>
            <li><a href="scores" class="link2">Voir les scores</a></li>

            <!-- if you are quizzer you can create quizz  -->
            <?php if ($user['type_utilisateur'] == 1) { ?>
                <li><a href="createquizz.php" class="link3">Créer un quizz</a></li>
            <?php } ?>

            <li><a href="myquizz.php" class="link4">Accéder à mes quizz</a></li>

            <!-- if you are administrator you can acces to admin panel  -->
            <?php if ($user['type_utilisateur'] == 2) { ?>
                <li><a href="admin.php" class="link4">Accéder au panel admin</a></li>
            <?php } ?>
        </ul>
    </container>
    <a id="retour" href="accueil.php">Retour à l'accueil</a>
</body>


</html>