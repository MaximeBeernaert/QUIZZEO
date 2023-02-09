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
    $email = $_SESSION['email'];
    $query    = "SELECT * FROM `utilisateurs` WHERE mail_utilisateur='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    echo "Vous êtes connecté sous le compte de " . $user['nom_utilisateur'] ." ". $user['prenom_utilisateur'];
    if($user['id_utilisateur']>0) {
        echo "<br> Vous pouvez créer des quizz.";
    }
    if($user['id_utilisateur']>1) {
        echo "<br> Vous pouvez gérer les utilisateurs.";
    }
?>