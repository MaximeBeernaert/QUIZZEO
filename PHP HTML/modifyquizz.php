<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Creation Quizz</title>
    <link rel="stylesheet" href="modifyquizz.css">
</head>

<body>
    <header>
        <h1>QUIZZEO</h1>
        <p>Quizz modification</p>
    </header>
    <?php
    session_start();
    require("DBconnexion.php");
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }
    //Get id of the quizz for the modification
    $id = $_SESSION['id_quizz'];

    //Get the quizz from database
    $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
    $result = mysqli_query($conn, $query);
    $actualQuizz = mysqli_fetch_assoc($result);
    ?>

    <form class="form1" action="savemodifyquizz.php" method="post">

        <h1 class="Modifty Quizz">Modify Quizz</h1>

        <?php $titre_quizz = $actualQuizz['titre_quizz'] ?>
        <?php echo "<input type='text' class='quizztitle' name='quizztitle' placeholder='Titre Quizz' value='$titre_quizz'/>" ?>

        <?php $difficulte_quizz = $actualQuizz['difficulte_quizz'] ?>
        <?php echo "<input type='text' class='quizzdiff' name='quizzdiff' placeholder='Difficulté Quizz' value='$difficulte_quizz' />" ?>

        <?php $theme_quizz = $actualQuizz['theme_quizz'] ?>
        <?php echo "<input type='text' class='themequizz' name='themequizz' placeholder='Thème du Quizz' value='$theme_quizz' />" ?>

        <div class="DivQuestion1">Question 1 :
            <input type="text" class="Question1" name="Question1"> Bonne réponse :
            <input type="text" class="rightAnswer1" name="rightAnswer1"> Première mauvaise réponse :
            <input type="text" class="Answer1" name="AnswerButton10">
            <div class="DivAnswerButton1">
                <input type="button" name="addAnswer1" value="Ajouter une réponse" class="Button1">
            </div>
        </div>
        <div class="addQuestions">
            <input type="button" class="addQuestion" name="addQuestion" value="Ajouter une question">
        </div>
        <input type="submit" name="submit" value="Valider les modifications" class="submit-button">
    </form>


    <script src="createquizz.js"></script>
    <button id="button1"><a href="usermenu.php">Retour au menu utilisateur</a></button>
</body>

</html>