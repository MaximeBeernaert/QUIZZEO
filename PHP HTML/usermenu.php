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
    $user    = "SELECT * FROM `utilisateurs` WHERE mail_utilisateur='$email'";
    $result = mysqli_query($conn, $user);

    echo "Vous êtes connecté sous le compte de ";
    echo $user['prenom_utilisateur'];
?>