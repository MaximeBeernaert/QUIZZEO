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

        <?php
        //Get the questions from database
        $queryQuestions = "SELECT * FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id')";
        $resultQuestions = mysqli_query($conn, $queryQuestions);
        $i = 0;

        while ($rowQuestion = mysqli_fetch_assoc($resultQuestions)) {
            $id_question = $rowQuestion['id_question'];
            $intitule_question = $rowQuestion['intitule_question'];

            echo "<div class='DivQuestion$i'>Question $i :";
            echo "<input type='text' class='Question$i' name='Question$i' placeholder='Question : ' value='$intitule_question'/>";

            $queryChoix = "SELECT * FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question='$id_question')";
            $resultChoix = mysqli_query($conn, $queryChoix);
            $j = 0;

            while ($rowChoix = mysqli_fetch_assoc($resultChoix)) {
                $reponse_choix = $rowChoix['reponse_choix'];
                $bonne_reponse_choix = $rowChoix['bonne_reponse_choix'];

                if ($bonne_reponse_choix == 1) {
                    echo "<input type='text' class='Question$i' name='Question$i' placeholder='Bonne réponse : ' value='$reponse_choix'/>";
                } else {
                    echo "<input type='text' class='rightAnswer$i' name='rightAnswer$i' placeholder='Mauvaise réponse $j : ' value='$reponse_choix'/>";
                }
                $j++;
            }
            echo "<div class='DivAnswerButton1'>";
            echo "<input type='button' name='addAnswer1' value='Ajouter une réponse' class='Button1'>";
            echo "</div>";
            echo "</div>";
            $i++;
        }
        ?>

        <div class="addQuestions">
            <input type="button" class="addQuestion" name="addQuestion" value="Ajouter une question">
        </div>
        <input type="submit" name="submit" value="Valider les modifications" class="submit-button">
    </form>


    <script src="createquizz.js"></script>
    <button id="button1"><a href="usermenu.php">Retour au menu utilisateur</a></button>
</body>

</html>