<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="accueil.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php

function createQuizzArray($title)
{
    $quizzSave = array(array($title, $_POST['quizzdiff'], $_POST['themequizz']));
    $numberQuestion = 1;
    while (isset($_POST["Question" . $numberQuestion])) {
        $question = array();
        array_push($question, $_POST["Question" . $numberQuestion]);
        array_push($question, $_POST["rightAnswer" . $numberQuestion]);
        $numberAnswer = 0;
        while (isset($_POST["AnswerButton" . $numberQuestion . $numberAnswer])) {

            array_push($question, $_POST["AnswerButton" . $numberQuestion . $numberAnswer]);
            $numberAnswer += 1;
        }

        array_push($quizzSave, $question);
        $numberQuestion += 1;
    }
    $_SESSION['quizzSave'] = $quizzSave;
    return $quizzSave;
}

function checkForTitle($conn, $title)
{
    $query  = "SELECT * FROM `quizz` WHERE titre_quizz='$title'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows >= 1) {
        echo "<h3>Titre de quizz déjà pris.</h3><br/>";
        titleAlreadyTaken();
        return FALSE;
    }
    return TRUE;
}

function titleAlreadyTaken()
{
    echo "<form class='form1' action='savequizz.php' method='post'> 
              <input type='text' class='quizztitlerenamed' name='quizztitlerenamed' placeholder='Renommez votre quizz' required />
              </form>";
}

//Have the quizzer totally validate his choice. He can modify one last time here. 
function checkQuizzForValidation($quizzSave, $conn)
{
    $numberQuestion = 1;
    while (isset($quizzSave[$numberQuestion])) {
        $question_text = $quizzSave[$numberQuestion][0];
        echo "<br>Question " . $numberQuestion . " : <br>";
        $numberAnswer = 0;
        while (isset($quizzSave[$numberQuestion][$numberAnswer])) {
            echo $quizzSave[$numberQuestion][$numberAnswer] . "<br>";
            $numberAnswer += 1;
        }
        $numberQuestion += 1;
    }
}

function createQuizz($quizzSave, $conn)
{
    $user = $_SESSION['user'];
    $user_id = $user['id_utilisateur'];
    $title = $quizzSave[0][0];
    $quizz_diff = $quizzSave[0][1];
    $quizz_reward = $quizzSave[0][2];

    //INSERT un nouveau quizz avec le titre récupéré à la page d'avant (createquizz.php) et le reste des infos (utilisateurs etc.) ID_quizz A-I
    $query = "INSERT INTO `quizz`(`titre_quizz`, `difficulte_quizz`, `valeur_score_quizz`,`auteur_quizz`) 
                 VALUES ('$title','$quizz_diff','$quizz_reward',$user_id)";
    $result = mysqli_query($conn, $query);
    if ($result) {
?>

        <body>
            <h1>QUIZZEO</h1>
            <p>Votre questionnaire a été enregistré</p>
        </body>
    <?php
    } else {
    ?>

        <body>
            <h1>QUIZZEO</h1>
            <p>Votre questionnaire n'a pas été enregistré</p>
        </body>
    <?php
    }
    $query = "SELECT * FROM `quizz` WHERE titre_quizz='$title'";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    $id_quizz = $quizz['id_quizz'];
    echo $id_quizz;

    checkQuizzForValidation($quizzSave, $conn);
    $numberQuestion = 1;
    while (isset($quizzSave[$numberQuestion])) {
        $question_text = $quizzSave[$numberQuestion][0];

        //Create the question in the database
        $query = "INSERT INTO `questions`(`intitule_question`, `type_question`) VALUES ('$question_text','1')";
        $result = mysqli_query($conn, $query);

        //Select the question created in the Database
        $query = "SELECT * FROM `questions` WHERE intitule_question='$question_text'";
        $result = mysqli_query($conn, $query);
        $question = mysqli_fetch_assoc($result);
        $id_question = $question['id_question'];
        //Create the link between the question and the quizz in the database
        $query = "INSERT INTO `contient`(`id_quizz`, `id_question`) VALUES ('$id_quizz','$id_question')";
        $result = mysqli_query($conn, $query);


        $answer_text = $quizzSave[$numberQuestion][1];
        //Create the answer in the database
        $query = "INSERT INTO `choix`(`reponse_choix`, `bonne_reponse_choix`) VALUES ('$answer_text','1')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "raté";
        }

        //Select the question created in the Database
        $query = "SELECT * FROM `choix` WHERE reponse_choix='$answer_text' AND bonne_reponse_choix='1'";
        $result = mysqli_query($conn, $query);
        $answer = mysqli_fetch_assoc($result);
        $id_answer = $answer['id_choix'];
        //Create the link between the question and the quizz in the database
        $query = "INSERT INTO `appartenir`(`ID_question`, `ID_choix`) VALUES ('$id_question','$id_answer')";
        $result = mysqli_query($conn, $query);

        $numberAnswer = 2;

        while (isset($quizzSave[$numberQuestion][$numberAnswer])) {
            $answer_text = $quizzSave[$numberQuestion][$numberAnswer];

            //Create the answer in the database
            $query = "INSERT INTO `choix`(`reponse_choix`, `bonne_reponse_choix`) VALUES ('$answer_text','0')";
            $result = mysqli_query($conn, $query);

            //Select the question created in the Database
            $query = "SELECT * FROM `choix` WHERE reponse_choix='$answer_text' AND bonne_reponse_choix='0'";
            $result = mysqli_query($conn, $query);
            $answer = mysqli_fetch_assoc($result);
            $id_answer = $answer['id_choix'];
            //Create the link between the question and the quizz in the database
            $query = "INSERT INTO `appartenir`(`ID_question`, `ID_choix`) VALUES ('$id_question','$id_answer')";
            $result = mysqli_query($conn, $query);


            $numberAnswer += 1;
        }


        $numberQuestion += 1;
    }
    if (!isset($_POST["Question" . $numberQuestion])) {
    ?>

        <body>
            <p>Fin des questions</p>

        </body>
<?php
    }
}

// MAIN 
// Start the local session
session_start();
// connect to the Database
require('DBconnexion.php');

if(!isset($_SESSION['user'] )) {
    header("Location:notconnected.php");
}

// Check for two cases : 
// first is the title has been renamed (because it was already taken)
// second is the first time the quizz is been registered
// here is the first case : we check for a HTML node named 'quizztitlerenamed'
if (isset($_POST['quizztitlerenamed'])) {
    // we get the saved quizz (done in the second case) and rename the quizz there
    $quizzSave = $_SESSION['quizzSave'];
    $quizzSave[0][0] = $_POST['quizztitlerenamed'];
    // we then send for the quizz to be checked again, and if TRUE, then we save the quizz in the database
    if (checkForTitle($conn, $_POST['quizztitlerenamed'])) {
        createQuizz($quizzSave, $conn);
    }
} else // second case here where we check the quizz first the first time
{
    // we get the title of the quizz
    $title = $_POST['quizztitle'];
    // we create the quizz, putting the valeus in an array to get it back in case of already taken title
    $quizzSave = createQuizzArray($title);
    // we then send for the quizz to be checked, and if TRUE, then we save the quizz in the database
    if (checkForTitle($conn, $title)) {
        createQuizz($quizzSave, $conn);
    }
}
?>
<form class="form1" action="quizzlist.php" method="post">
    <input type="submit" name="submit" value="Valider" class="submit-button">
</form>
<?php
//For() chaque question dans le quizz de la page d'avant 
//INSERT la question (en fonction de la page précédente) ID_question individuel A-I
//INSERT un 'contient' avec l'ID_quizz et l'ID_question
//For() chaque réponse dans la question de la page d'avant
//INSERT un choix (une réponse, sans doute changer le nom dans la DB en réponse) mettre si c'est un BOOL/bonne réponse (changer dans la DB) ID_choix A-I
//INSERT un 'appartenir' (table similaire à 'contient' qui fait le lien entre les questions et les réponses) avec l'ID_question et ID_choix


// pour récupérer les infos d'un quizz, faire un SELECT * dans 'contient' où on récupère tous les élèments correspondants à l'ID_quizz
// on récupère alors avec le SELECT toutes les ID_questions référencées dans le quizz
// pour chaque questions, faire un SELECT * dans 'appartenir' qui récupère tous les élèments correspondants à l'ID_question
// on récupère alors avec le SELECT tous les ID_choix référencés dans la question
// la bonne réponse à chaque question sera la seule avec le BOOL TRUE (ou jsp quoi)
?>


</html>