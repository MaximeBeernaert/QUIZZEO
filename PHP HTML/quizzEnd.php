<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Fin du Quizz</title>
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
$id_quizz = $_SESSION['id_quizz'];

$query    = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
$result = mysqli_query($conn, $query);
$quizz = mysqli_fetch_assoc($result);

echo "Résultats : ".$quizz['titre_quizz']."<br><br>"; 

$number = 0; 
$answers_array = [];

$query    = "SELECT * FROM `contient` WHERE id_quizz='$id_quizz'";
$result = mysqli_query($conn, $query);

while ( $row_question = mysqli_fetch_assoc($result) ) {

    $id_question = $row_question['id_question'];
    $query    = "SELECT * FROM `questions` WHERE id_question='$id_question'";
    $result_question = mysqli_query($conn, $query);
    $question = mysqli_fetch_assoc($result_question);
    $question_text = $question['intitule_question'];
    echo "Question ".$number." : ".$question_text."<br>";

    $id_choix  = $_COOKIE['cookieAnswer'.$number];
    $query    = "SELECT * FROM `choix` WHERE id_choix='$id_choix'";
    $result_answer = mysqli_query($conn, $query);
    $answer = mysqli_fetch_assoc($result_answer);
    echo "Réponse : ".$answer['reponse_choix']." - ";
    if($answer['bonne_reponse_choix'] == 0) {
        echo "C'est une mauvaise réponse.";
        array_push($answers_array,0);
    }else{
        echo "C'est une bonne réponse.";
        array_push($answers_array,100);
    }
    echo "<br><br>";
    $number++;
}
$average_result = round(array_sum($answers_array) / count($answers_array), 2);
echo "<br>Votre score : ".$average_result;

$id_user = $user['id_utilisateur'];
$query = "INSERT INTO `jouer`(`id_utilisateur`, `id_quizz`,`score`) VALUES ('$id_user','$id_quizz',$average_result)";
$result = mysqli_query($conn, $query);
echo "<p class='link'><a href='usermenu.php'>Revenir au menu Utilisateur</a></p>";
?>