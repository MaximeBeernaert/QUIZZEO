<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Quizz</title>
</head>

<body>
    <?php
    session_start();
    require("DBconnexion.php");

    //Get id of the quizz for the modification
    $id = $_SESSION['id_quizz'];

    //Get the quizz from database
    $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
    $result = mysqli_query($conn, $query);
    $actualQuizz = mysqli_fetch_assoc($result);
    ?>

    <!-- Display quizz information -->
    <form action="modifyquizz.php" method="POST">

        <?php $titre_quizz = $actualQuizz["titre_quizz"] ?>
        <label for="titre">Titre du Quizz : </label>
        <?php echo "<input type='text' name='titre' value=$titre_quizz>" ?>
        <br>

        <?php $difficulte_quizz = $actualQuizz["difficulte_quizz"] ?>
        <label for="difficulte">Difficulté du Quizz : </label>
        <?php echo "<input type='text' name='difficulte' value=$difficulte_quizz>" ?>
        <br>

        <!-- Display quizz question in a two dim table -->

        <?php
        $id = $_SESSION['id_quizz'];
        $queryQuestions = "SELECT * FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id')";
        $resultQuestions = mysqli_query($conn, $queryQuestions);
        $i = 1;
        // Create a two dim table to store question and adwers
        $quizzArray = array();

        while ($rowQuestion = mysqli_fetch_assoc($resultQuestions)) {
            $id_question = $rowQuestion['id_question'];
            $intitule_question = $rowQuestion['intitule_question'];

            $questionArray = array();

            echo "<label for='question'>Question $i : </label>";
            echo "<input type='text' name='question[]' value=$intitule_question>";
            echo "<br>";
            //push question in the array
            $i++;

            // Get the adwers of the question 
            $queryChoix = "SELECT * FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question='$id_question')";
            $resultChoix = mysqli_query($conn, $queryChoix);
            $j = 1;

            // Create a table to store adwers of the question
            while ($rowChoix = mysqli_fetch_assoc($resultChoix)) {
                $id_choix = $rowChoix['id_choix'];
                $reponse_choix = $rowChoix['reponse_choix'];
                $bonne_reponse_choix = $rowChoix['bonne_reponse_choix'];

                // Display the adwers of the question and push them in the array
                if ($bonne_reponse_choix == 1) {
                    echo "<label for='reponse'>Bonne réponse $j : </label>";
                    echo "<input type='text' name='reponse[]' value=$reponse_choix>";
                    echo "<br>";
                    //push adwers in the array
                    array_push($questionArray, $id_choix, $reponse_choix, $bonne_reponse_choix);
                    $j++;
                } else {
                    echo "<label for='reponse'>Mauvaise réponse $j : </label>";
                    echo "<input type='text' name='reponse[]' value=$reponse_choix>";
                    echo "<br>";
                    //push adwers in the array
                    array_push($questionArray, $id_choix, $reponse_choix, $bonne_reponse_choix);
                    $j++;
                }
            }
            //push question in the array
            array_unshift($questionArray, $id_question, $intitule_question);
            //push question and adwers in the array of the quizz
            array_push($quizzArray, $questionArray);
        }
        print_r($quizzArray);
        ?>
    </form>
</body>

</html>