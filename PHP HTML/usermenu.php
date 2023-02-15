<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Menu</title>
    <link rel="stylesheet" href="usermenu.css">
</head>
<body>
<?php
    session_start();
    require('DBconnexion.php');
    $user = $_SESSION['user'];
    echo "Vous êtes connecté sous le compte de " . $user['nom_utilisateur'] ." ". $user['prenom_utilisateur'];
    if($user['type_utilisateur']>0) {
        echo "<br> Vous pouvez créer des quizz."; 
        ?> <a href="createquizz.php">Créer un quizz</a> <?php
    }
    if($user['type_utilisateur']>1) {
        echo "<br> Vous pouvez gérer les utilisateurs.";
        ?> <a href="admin.php">Gérer les utilisateurs</a> <?php
    }
?>
    <header>
        <h1>Menu utilisateur</h1>
      </header>
          <container>
        <ul>
          <li><a href="jouer" class="link1">Jouer aux quizz</a></li>
          <li><a href="scores"class="link2">Voir les scores</a></li>
          <li><a href="creer"class="link3">Créer les quizz</a></li>
          <li><a href="admin"class="link4">Accéder au panel admin</a></li>
        </ul>
    </container> 
        <a id="retour"href="accueil.php">Retour à l'accueil</a>
    </body>
</html>