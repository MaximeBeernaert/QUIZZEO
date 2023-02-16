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

        <a href="myquizz.php">Retour à mes Quizz</a>

        <h2>Bienvenue sur la page de modification de votre Quizz<?php echo " : " . $actualQuizz['titre_quizz']; ?></h2> 
        <!-- Display all the quizz in form for modification by user -->
        <form action="modifyquizz.php" method="POST">
            <?php $titre_quizz = $actualQuizz['titre_quizz'];?>
            <label for="titre">Titre de votre Quizz : </label>
            <?php echo "<input type='text' name='titre' value=$titre_quizz>"?>
            <br>

            <?php $difficulte_quizz = $actualQuizz['difficulte_quizz'];?>
            <label for="difficulte">Difficulté de votre Quizz : </label>
            <?php echo "<input type='text' name='difficulte' value=$difficulte_quizz>"?>
            <br>

            <?php $valeur_score_quizz = $actualQuizz['valeur_score_quizz'];?>
            <label for="valeur_score">Score de votre Quizz : </label>
            <?php echo "<input type='text' name='valeur_score' value=$valeur_score_quizz>"?>
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

            while ($row = mysqli_fetch_assoc($resultQuestions)):
                $id_question = $row['id_question'];
                $intitule_question = $row['intitule_question'];

                echo "<br>";
                echo "<label for='question'>Question $i : </label>";
                echo "<input type='text' name='question' value=$intitule_question>";
                echo "<br>";
                $i++;

                $queryChoix = "SELECT * FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question='$id_question')";
                $resultChoix = mysqli_query($conn, $queryChoix);
                $j = 1;

                while ($row = mysqli_fetch_assoc($resultChoix)):
                    $id_choix = $row['id_choix'];
                    $reponse_choix = $row['reponse_choix'];
                    $bonne_reponse_choix = $row['bonne_reponse_choix'];

                    echo "<label for='choix'>Choix $j : </label>";
                    echo "<input type='text' name='choix' value=$reponse_choix>";
                    echo "<br>";
                    $j++;
                endwhile;
            endwhile;
            ?>
            <button type="submit" name="modif-btn" class="modif-btn">Modifier</button>
        </form>

        <?php
        // If the user click on the button "Modifier", the quizz is modified in the database and the user is redirected to the page "myquizz.php"
        // The modification will be take all the information in the form : the title, the difficulty, the score and all the answers for each question
        if (isset($_POST['modif-btn'])) {
            $titre = $_POST['titre'];
            $difficulte = $_POST['difficulte'];
            $valeur_score = $_POST['valeur_score'];

            // Get the id of the quizz to modify and update the title, the difficulty and the score of the quizz
            $query = "UPDATE `quizz` SET titre_quizz='$titre', difficulte_quizz='$difficulte', valeur_score_quizz='$valeur_score' WHERE id_quizz='$id'";
            $result = mysqli_query($conn, $query);

            // For each question of the quizz, update the question and the answer
            while ($row = mysqli_fetch_assoc($resultQuestions)):
                $id_question = $row['id_question'];
                $intitule_question = $row['intitule_question'];

                $query = "UPDATE `questions` SET intitule_question='$intitule_question' WHERE id_question='$id_question'";
                $result = mysqli_query($conn, $query);
                $i++;

                $queryChoix = "SELECT * FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question='$id_question')";
                $resultChoix = mysqli_query($conn, $queryChoix);
                $j = 1;

                // For each answer of the question, update the answer
                while ($row = mysqli_fetch_assoc($resultChoix)):
                    $id_choix = $row['id_choix'];
                    $reponse_choix = $row['reponse_choix'];

                    $query = "UPDATE `choix` SET reponse_choix='$reponse_choix' WHERE id_choix='$id_choix'";
                    $result = mysqli_query($conn, $query);
                    $j++;
                endwhile;
            endwhile;

            // Redirect to the page "myquizz.php" after the modification if the modification is successful
            if ($result) {
                header("Location: myquizz.php");
            } else {
                echo "Erreur";
            }
        }
        ?>
    </div>
</body>
</html>