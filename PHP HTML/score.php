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


if(!isset($_SESSION['user'] )) {
    header("Location:notconnected.php");
}
$user = $_SESSION['user']; 
echo "<p class='link'><a href='usermenu.php'>Revenir au menu Utilisateur</a></p><br>";
echo "<br>Votre Moyenne générale aux Quizz : ";

$id_user = $user['id_utilisateur'];
$quizz_total_average = [];
$quizz_list = [];


$query    = "SELECT * FROM `jouer` WHERE `id_utilisateur` = $id_user";
$result = mysqli_query($conn, $query);
while ($row_quizz_played = mysqli_fetch_assoc($result)) {
    array_push($quizz_total_average, $row_quizz_played['score']);
}
$average_result = round(array_sum($quizz_total_average) / count($quizz_total_average), 2);
echo $average_result;

$query    = "SELECT * FROM `quizz`";
$result = mysqli_query($conn, $query);
while ($row_quizz_list = mysqli_fetch_assoc($result)) {
    array_push($quizz_list, $row_quizz_list['id_quizz']);
}

for ($index=0; $index<count($quizz_list);$index++) {
    $quizz_average = [];
    $id_quizz = $quizz_list[$index];
    $query    = "SELECT * FROM `jouer` WHERE `id_utilisateur` = $id_user AND `id_quizz` = $id_quizz";
    $result = mysqli_query($conn, $query);
    while ($row_quizz = mysqli_fetch_assoc($result)) {
        array_push($quizz_average, $row_quizz['score']);
    }
    $average_result = round(array_sum($quizz_average) / count($quizz_average), 2);
    $query    = "SELECT * FROM `quizz` WHERE `id_quizz` = $id_quizz";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    $quizz_title = $quizz['titre_quizz'];
    echo "<br>Votre moyenne pour le quizz ". $quizz_title ." : ".$average_result;
}


?>