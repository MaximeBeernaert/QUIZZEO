<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif Quizz</title>
</head>

<body>

    <div class="modifQuizz">

        <?php
        session_start();
        require('DBconnexion.php');

        // For good modification, the data will be in object in the form of an array of objects (array of questions) and each question will be an object with an array of answers (array of objects) and the array of question is in the object actualQuizz
        // Get the id of the quizz to modify
        // For each question of the quizz, display the question and the answer in form for modification by user
        // The quizz is identified by the id of the quizz in the table quizz
        // The question is identified by the id of the question in the table questions
        // The link between the quizz and the question is the table contient where the id of the quizz is in the column id_quizz and the id of the question is in the column id_question
        // The answer is in the table choix
        // The link between the question and the answer is the id of the question in the table appartenir
        // A quizz can have multiple questions and a question can have multiple answers

        //Create a new class for the quizz
        class Quizz
        {
            public $titre_quizz;
            public $difficulte_quizz;
            public $valeur_score_quizz;
            public $questions = array();

            public function __construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz)
            {
                $this->titre_quizz = $titre_quizz;
                $this->difficulte_quizz = $difficulte_quizz;
                $this->valeur_score_quizz = $valeur_score_quizz;
            }

            public function addQuestion($question)
            {
                $this->questions[] = $question;
            }
            public function getQuestions()
            {
                return $this->questions;
            }
            public function addDifficulte($difficulte_quizz)
            {
                $this->difficulte_quizz = $difficulte_quizz;
            }
            public function getDifficulte()
            {
                return $this->difficulte_quizz;
            }
            public function addValeurScore($valeur_score_quizz)
            {
                $this->valeur_score_quizz = $valeur_score_quizz;
            }
            public function getValeurScore()
            {
                return $this->valeur_score_quizz;
            }
        }

        //Create a new class for the questions
        class Question
        {
            public $id_question;
            public $intitule_question;
            public $choix = array();
        }

        //Create a new class for the answers
        class Choix
        {
            public $id_choix;
            public $reponse_choix;
            public $bonne_reponse_choix;
        }






        ?>






    </div>

</body>

</html>