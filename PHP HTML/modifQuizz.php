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

        //PAGE DE MODIFICATION DE QUIZZ

        //Cette page récupère l'ID du quizz à modifier et affiche les informations du quizz : nom, score, auteur, date de création
        //On affiche chaques questions du quizz avec les réponses possibles à chaque question ainsi que la bonne réponse 
        //On affiche à côté de chaque question un bouton "modifier" qui renvoie vers la page de modification de la question selectionnée
        //On affiche à côté de chaque question un bouton "supprimer" qui supprime la question selectionnée du quizz et les réponces associées
        //On affiche un bouton "ajouter une question" qui renvoie vers la page d'ajout de question

        // Get the id of the quizz to modify
        $id = $_SESSION['id'];
        $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
        $result = mysqli_query($conn, $query);
        $actualQuizz = mysqli_fetch_assoc($result);
        ?>

        <!-- Display quizz informations : name, author, date of creation & score -->
        <form action="moddifQuizz.php" method="POST">

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

            <button type="submit" name="modif-btn-quizz" class="modif-btn-quizz">Modifier les informations du quizz</button>

            <!-- Display all the questions of ActualQuizz and adwers correspond -->

            <?php
            $id = $_SESSION['id'];
            $queryQuestions = "SELECT * FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id')";
            $resultQuestions = mysqli_query($conn, $queryQuestions);
            $i = 1;

            while ($row = mysqli_fetch_assoc($resultQuestions)) :
                $id_question = $row['id_question'];
                $intitule_question = $row['intitule_question'];

                echo "<br>";
                echo "Question n° $i : $intitule_question";
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
                        echo "Choix n° $j (bonne réponse) : $reponse_choix";
                        echo "<br>";
                        $j++;
                    } else {
                        echo "Choix n° $j : $reponse_choix";
                        echo "<br>";
                        $j++;
                    }
                endwhile;
            ?>
                <button type="submit" name="modif-btn-question" class="modif-btn-question">Modifier cette question</button>
            <?php
            endwhile;
            ?>
        </form>

        <?php

        if (isset($_POST['modif-btn-quizz'])) {
            $titre = $_POST['titre'];
            $difficulte = $_POST['difficulte'];
            $valeur_score = $_POST['valeur_score'];

            // Get the id of the quizz to modify and update the title, the difficulty and the score of the quizz
            $query = "UPDATE `quizz` SET titre_quizz='$titre', difficulte_quizz='$difficulte', valeur_score_quizz='$valeur_score' WHERE id_quizz='$id'";
            $result = mysqli_query($conn, $query);
        }

        //Check if all the modification are done
        if ($result) {
            header("Location: myquizz.php");
        } else {
            echo "Erreur";
        }

        //TODO BTN modif question

        ?>

    </div>

</body>

</html>