<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Quizz</title>
</head>

<body>

    <div class="modifQuizz">

        <?php
        session_start();
        require('DBconnexion.php');

        // Get the id of the quizz to modify
        $id = $_SESSION['id'];
        $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
        $result = mysqli_query($conn, $query);
        $actualQuizz = mysqli_fetch_assoc($result);
        ?>

        <?php
        class Quizz // Class Quizz with all the attributes and methods : title, difficulty, score
        {
            public $titre_quizz;
            public $difficulte_quizz;
            public $valeur_score_quizz;

            public function __construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz)
            {
                $this->titre_quizz = $titre_quizz;
                $this->difficulte_quizz = $difficulte_quizz;
                $this->valeur_score_quizz = $valeur_score_quizz;
            }

            public function getTitreQuizz()
            {
                return $this->titre_quizz;
            }
            public function getDifficulteQuizz()
            {
                return $this->difficulte_quizz;
            }
            public function getValeurScoreQuizz()
            {
                return $this->valeur_score_quizz;
            }

            public function setTitreQuizz($titre_quizz)
            {
                $this->titre_quizz = $titre_quizz;
            }
            public function setDifficulteQuizz($difficulte_quizz)
            {
                $this->difficulte_quizz = $difficulte_quizz;
            }
            public function setValeurScoreQuizz($valeur_score_quizz)
            {
                $this->valeur_score_quizz = $valeur_score_quizz;
            }
        }

        class Questions extends Quizz // Class Questions with all the attributes and methods : title, difficulty, score and the question
        {
            public $intitule_question;

            public function __construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz, $intitule_question)
            {
                parent::__construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz);
                $this->intitule_question = $intitule_question;
            }

            public function getIntituleQuestion()
            {
                return $this->intitule_question;
            }

            public function setIntituleQuestion($intitule_question)
            {
                $this->intitule_question = $intitule_question;
            }
        }

        class Answers extends Questions // Class Answers with all the attributes and methods : title, difficulty, score, the question and the answers
        {
            public $reponse_choix;
            public $bonne_reponse_choix;

            public function __construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz, $intitule_question, $reponse_choix, $bonne_reponse_choix)
            {
                parent::__construct($titre_quizz, $difficulte_quizz, $valeur_score_quizz, $intitule_question);
                $this->reponse_choix = $reponse_choix;
                $this->bonne_reponse_choix = $bonne_reponse_choix;
            }

            public function getReponseChoix()
            {
                return $this->reponse_choix;
            }
            public function getBonneReponseChoix()
            {
                return $this->bonne_reponse_choix;
            }

            public function setReponseChoix($reponse_choix)
            {
                $this->reponse_choix = $reponse_choix;
            }
            public function setBonneReponseChoix($bonne_reponse_choix)
            {
                $this->bonne_reponse_choix = $bonne_reponse_choix;
            }
        }

        function setQuizz()
        {
        }






        //TODO : Add button for question question and answer in the form 


        //TODO : Add button for delete question and answer in the form

        ?>


        <a href="myquizz.php">Retour à mes Quizz</a>

        <h2>Bienvenue sur la page de modification de votre Quizz<?php echo " : " . $actualQuizz['titre_quizz']; ?></h2>
        <!-- Display all the quizz in form for modification by user -->
        <form action="modifyquizz.php" method="POST">
            <?php $titre_quizz = $actualQuizz['titre_quizz']; ?>
            <label for="titre">Titre de votre Quizz : </label>
            <?php echo "<input type='text' name='titre' value=$titre_quizz>" ?>
            <br>

            <?php $difficulte_quizz = $actualQuizz['difficulte_quizz']; ?>
            <label for="difficulte">Difficulté de votre Quizz : </label>
            <?php echo "<input type='text' name='difficulte' value=$difficulte_quizz>" ?>
            <br>

            <?php $valeur_score_quizz = $actualQuizz['valeur_score_quizz']; ?>
            <label for="valeur_score">Score de votre Quizz : </label>
            <?php echo "<input type='text' name='valeur_score' value=$valeur_score_quizz>" ?>
            <br>

            <?php
            // Get the id of the quizz to modify
            // For each question of the quizz, display the question and the answer in form for modification by user
            // The quizz is identified by the id of the quizz in the table quizz
            // The question is identified by the id of the question in the table questions
            // The link between the quizz and the question is the table contient where the id of the quizz is in the column id_quizz and the id of the question is in the column id_question
            // The answer is in the table choix
            // The link between the question and the answer is the id of the question in the table appartenir
            // A quizz can have multiple questions and a question can have multiple answers

            $id = $_SESSION['id'];
            $queryQuestions = "SELECT * FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id')";
            $resultQuestions = mysqli_query($conn, $queryQuestions);
            $i = 1;

            while ($row = mysqli_fetch_assoc($resultQuestions)) :
                $id_question = $row['id_question'];
                $intitule_question = $row['intitule_question'];

                echo "<br>";
                echo "<label for='question'>Question $i : </label>";
                echo "<input type='text' name='intitule_question' value=$intitule_question>";
                echo "<br>";
                $i++;

                $queryChoix = "SELECT * FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question='$id_question')";
                $resultChoix = mysqli_query($conn, $queryChoix);
                $j = 1;

                while ($row = mysqli_fetch_assoc($resultChoix)) :
                    $id_choix = $row['id_choix'];
                    $reponse_choix = $row['reponse_choix'];
                    $bonne_reponse_choix = $row['bonne_reponse_choix'];

                    if ($bonne_reponse_choix == 1) {
                        echo "<label for='bonne_reponse'>Choix $j bonne réponse : </label>";
                        echo "<input type='text' name='bonne_reponse_choix' value=$reponse_choix>";
                        echo "<br>";
                        $j++;
                    } else {
                        echo "<label for='choix'>Choix $j : </label>";
                        echo "<input type='text' name='reponse_choix' value=$reponse_choix>";
                        echo "<br>";
                        $j++;
                    }
                endwhile;
            endwhile;
            ?>
            <button type="submit" name="modif-btn" class="modif-btn">Modifier</button>
        </form>

    </div>
</body>

</html>