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
    <?php
    $type_utilisateur = $user['type_utilisateur'];
    ?>
    <header>

        <div class="image">
            <img src="ipssi-logo.png" class="image">
        </div>

        <div class="quizzeo">
            <h1><a href="accueil.php">QUIZZEO</a></h1>
        </div>

        <div class="panel">
            <h2><a href="score.php">Scores</a> <?php if ($type_utilisateur == 2) : ?> | <a href="admin.php">Panel admin</a><?php endif ?><?php if ($type_utilisateur >= 1) : ?> | <a href="createquizz.php">Créer un Quizz</a><?php endif ?> | <a href="logout.php">Déconnexion</a></h2>
        </div>

        <div class="userinfo">
            <p>Vous êtes connecté sous le compte de <?php echo $user['nom_utilisateur'] . " " . $user['prenom_utilisateur'] ?></p>
        </div>

    </header>
</body>
 05dd99c9ed6ebe458fe57a15ad68c56d309a69ae
</html>