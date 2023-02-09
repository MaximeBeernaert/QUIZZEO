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
    }
    if($user['type_utilisateur']>1) {
        echo "<br> Vous pouvez gérer les utilisateurs.";
    }
?>