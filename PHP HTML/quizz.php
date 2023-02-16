<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Gérer mes Quizz</title>
    <title>Gérer mes Quizz</title>
</head>
<body>
    <table>
<?php

class Question {
    private $text_question;
    private $id_question;
    public function __construct($text,$id) {
        $this->text_question = $text;
        $this->id_question = $id;
    }
    public function getTextQuestion() {
        return $this->text_question;
    }
    public function setTextQuestion($t) {
        $this->text_question = $t;
    }
    public function getIdQuestion() {
        return $this->id_question;
    }
    public function setIdQuestion($t) {
        $this->id_question = $t;
    }
}
class Answer {
    private $text_answer;
    private $id_answer;
    public function __construct($text,$id){
        $this->text_answer = $text;
        $this->$id_answer = $id;
    }
    public function getTextAnswer() {
        return $this->text_answer;
    }
    public function setTextAnswer($t) {
        $this->text_answer = $t;
    }
    public function getIdAnswer() {
        return $this->id_answer;
    }
    public function setIdAnswer($t) {
        $this->id_answer = $t;
    }
}


function createQuestion($conn,$row,$id_question) {
    
    $queryQuestion = "SELECT * FROM `questions` WHERE `id_question` = '$id_question'";
    $resultQuestion = mysqli_query($conn, $queryQuestion);
    $question = mysqli_fetch_assoc($resultQuestion);
    $intitule = $question['intitule_question'];
    $text_question = "<h2>$intitule</h2>";
    $question = new Question($text_question,$id_question);
    return $question;
}

session_start();
require('DBconnexion.php');

$user = $_SESSION['user']; 

$id_quizz = $_POST['id_quizz'];

$query = "SELECT * FROM `quizz` WHERE `id_quizz` = '$id_quizz'";
$result = mysqli_query($conn, $query);
$quizz = mysqli_fetch_assoc($result);
echo $id_quizz." ".$quizz['titre_quizz'];
$query = "SELECT * FROM `contient` WHERE `id_quizz` = '$id_quizz'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $id_question = $row['id_question'];
    $question = createQuestion($conn,$row,$id_question);
    echo $question->getIdQuestion().$question->getTextQuestion();
   
}

?>