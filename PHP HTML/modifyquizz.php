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
        //Get the questions from database for the quizz
        $id = $_SESSION['id_quizz'];
        $queryQuestions = "SELECT * FROM `questions` WHERE id_quizz='$id'";
        $questions = mysqli_query($conn, $queryQuestions);
        $i = 1;

        //Display the questions from database
        while ($row = mysqli_fetch_assoc($questions)) :
            $id_question = $row['id_question'];
            $intitule_question = $row['intitule_question'];

            echo "<label for='question'>Question $i : </label>";
            echo "<input type='text' name='question[]' value=$intitule_question>";
            echo "<br>";
        ?>
        <?php endwhile ?>

    </form>
</body>

</html>