<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Menu</title>
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
      <nav>
        <ul>
          <li><a href="#jouer">Jouer aux quizz</a></li>
          <li><a href="#scores">Voir les scores</a></li>
          <li><a href="#creer">Créer les quizz</a></li>
          <li><a href="#admin">Accéder au panel admin</a></li>
        </ul>
        <button id="button1"><a href="accueil.php">Retour à l'accueil</a></button>

    </header>
    <main>
      <section id="jouer">
      </section>
      <section id="scores">
      </section>
      <section id="creer">
      </section>
      <section id="admin">
      </section>
    </main>
    <footer>
      
    </footer>
  </body>
</html>