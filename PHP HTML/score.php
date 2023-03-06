<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Mes Scores</title>
</head>
<body>
    <table>
<?php
session_start();
require('DBconnexion.php');

$user = $_SESSION['user']; 

echo "<p class='link'><a href='usermenu.php'>Revenir au menu Utilisateur</a></p><br>";
echo "<br>Votre Moyenne générale aux Quizz : ";



?>