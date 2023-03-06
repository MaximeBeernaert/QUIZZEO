<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Jouer au Quizz</title>
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
        $this->id_answer = $id;
        $this->id_answer = $id;
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


function createQuizz($conn,$id_quizz) {
    $query = "SELECT * FROM `quizz` WHERE `id_quizz` = '$id_quizz'";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    echo $id_quizz." ".$quizz['titre_quizz'];
    $query = "SELECT * FROM `contient` WHERE `id_quizz` = '$id_quizz'";
    $result = mysqli_query($conn, $query);
    
    $quizzArray = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id_question = $row['id_question'];
        $question = createQuestion($conn,$row,$id_question);
        $questionArray = [];
        
        $queryQuestion = "SELECT * FROM `appartenir` WHERE `id_question` = '$id_question'";
        $resultQuestion = mysqli_query($conn, $queryQuestion);
        
        while ($rowQuestion = mysqli_fetch_assoc($resultQuestion)) {
            $id_answer = $rowQuestion['id_choix'];
            $answer = createAnswer($conn,$rowQuestion,$id_answer);
            array_push($questionArray,$answer);
        }
        shuffle($questionArray);
        array_unshift($questionArray, $question);
        array_push($quizzArray,$questionArray);
    }
    return $quizzArray;
}

function createQuestion($conn,$row,$id_question) {
    
function createQuizz($conn,$id_quizz) {
    $query = "SELECT * FROM `quizz` WHERE `id_quizz` = '$id_quizz'";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    echo $id_quizz." ".$quizz['titre_quizz'];
    $query = "SELECT * FROM `contient` WHERE `id_quizz` = '$id_quizz'";
    $result = mysqli_query($conn, $query);
    
    $quizzArray = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $id_question = $row['id_question'];
        $question = createQuestion($conn,$row,$id_question);
        $questionArray = [];
        
        $queryQuestion = "SELECT * FROM `appartenir` WHERE `id_question` = '$id_question'";
        $resultQuestion = mysqli_query($conn, $queryQuestion);
        
        while ($rowQuestion = mysqli_fetch_assoc($resultQuestion)) {
            $id_answer = $rowQuestion['id_choix'];
            $answer = createAnswer($conn,$rowQuestion,$id_answer);
            array_push($questionArray,$answer);
        }
        shuffle($questionArray);
        array_unshift($questionArray, $question);
        array_push($quizzArray,$questionArray);
    }
    return $quizzArray;
}

function createQuestion($conn,$row,$id_question) {
    
    $queryQuestion = "SELECT * FROM `questions` WHERE `id_question` = '$id_question'";
    $resultQuestion = mysqli_query($conn, $queryQuestion);
    $question = mysqli_fetch_assoc($resultQuestion);
    $intitule = $question['intitule_question'];
    $text_question = $intitule; //ici changer en hidden
    $question = new Question($text_question,$id_question);
    return $question;
}
function createAnswer($conn,$rowQuestion,$id_answer) {
    $queryAnswer = "SELECT * FROM `choix` WHERE `id_choix` = '$id_answer'";
    $resultAnswer = mysqli_query($conn, $queryAnswer);
    $answer = mysqli_fetch_assoc($resultAnswer);
    $intitule = $answer['reponse_choix'];
    $text_answer = $intitule; //ici changer en hidden
    $answer = new Answer($text_answer,$id_answer);
    return $answer;
}
function createHTML($conn,$quizzArray) {
    $index1 = 0;
    echo "<table name=table1 class=table1> <div name=hiddenValues class=hiddenValues>" ;
    while(isset($quizzArray[$index1][0])) {
        $questionText = $quizzArray[$index1][0]->getTextQuestion();
        $questionId = $quizzArray[$index1][0]->getIdQuestion();
        // echo $questionText.$questionId;
        echo "<input type='hidden' name='question questionText$index1' class='question questionText$index1' value='$questionText'>";
        echo "<input type='hidden' name='questionId$index1' class='questionId$index1' value='$questionId'>";
        $index2 = 1;
        while(isset($quizzArray[$index1][$index2])){
            $answerText = $quizzArray[$index1][$index2]->getTextAnswer();
            $answerId = $quizzArray[$index1][$index2]->getIdAnswer();
            echo "<input type='hidden' name='answerTextQ$index1 answerText$index2' class='answerTextQ$index1 answerText$index2' value='$answerText'>";
            echo "<input type='hidden' name='answerIdQ$index1 answerId$index2' class='answerIdQ$index1 answerId$index2' value='$answerId'>";
            $index2++;            
        }
        $index1++;
    }
    echo "</div></table>";
}

session_start();
require('DBconnexion.php');


//Suppress all cookies except the 'user' one
if (isset($_COOKIE)) {
    foreach($_COOKIE as $name => $value) {
        if ($name != "PHPSESSID") // Name of the cookie 'User' we want to keep
        {
            setcookie($name, '', 1); // Better use 1 (for the time) to avoid time problems, like timezones
            setcookie($name, '', 1, '/');
        }
    }
}
$user = $_SESSION['user'];
$id_quizz = $_POST['id_quizz'];

$_SESSION['id_quizz'] = $id_quizz;

$quizzArray = createQuizz($conn,$id_quizz);
createHTML($conn,$quizzArray);

$quizzArray = createQuizz($conn,$id_quizz);
createHTML($conn,$quizzArray);


?>

<script name='src' src="quizz.js"></script>
</html>

<script name='src' src="quizz.js"></script>
</html>