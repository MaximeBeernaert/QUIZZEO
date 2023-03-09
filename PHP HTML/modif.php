<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Quizz</title>
    <link rel="stylesheet" href="createquizz.css">
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>
    <?php
    $user = $_SESSION['user'];
    if ($user['type_utilisateur'] < 1) {
        header("Location:notpermited.php");
    }

    $id_quizz = $_SESSION['id_quizz'];
    $query    = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    $title_quizz = $quizz['titre_quizz'];
    $diff_quizz = $quizz['difficulte_quizz'];
    $theme_quizz = $quizz['theme_quizz'];

    ?>

    <form class="form1" action="savemodif.php" method="post">

        <h1 class="Create Quizz">Modify Quizz</h1>
        <input type="text" class="quizztitle" name="quizztitle" placeholder="Titre Quizz" value="<?php echo $title_quizz; ?>" required />
        <input type="text" class="quizzdiff" name="quizzdiff" placeholder="Difficulté Quizz" value="<?php echo $diff_quizz; ?>" required />
        <input type="text" class="themequizz" name="themequizz" placeholder="Thème du Quizz" value="<?php echo $theme_quizz; ?>" required />
        <?php
        $index_question = 1;
        $query    = "SELECT * FROM `contient` WHERE id_quizz='$id_quizz'";
        $result_contient = mysqli_query($conn, $query);
        while ($current_contient = mysqli_fetch_assoc($result_contient)) :
            $id_question = $current_contient['id_question'];
            $query    = "SELECT * FROM `questions` WHERE id_question='$id_question'";
            $result_question = mysqli_query($conn, $query);
            $current_question = mysqli_fetch_assoc($result_question);
            $text_question = $current_question['intitule_question'];
            echo "<div class='DivQuestion DivQuestion" . $index_question . "'>Question " . $index_question . " - Entrer la question :";
        ?>
            <input type="text" class="Question<?php echo $index_question; ?>" name="Question<?php echo $index_question; ?>"" value=" <?php echo $text_question; ?>" required />
        <?php
            $query    = "SELECT * FROM `appartenir` WHERE id_question='$id_question'";
            $result_appartenir = mysqli_query($conn, $query);
            $index_answer = 0;
            while ($current_appartenir = mysqli_fetch_assoc($result_appartenir)) {

                $id_answer = $current_appartenir['id_choix'];
                $query    = "SELECT * FROM `choix` WHERE id_choix='$id_answer'";
                $result_answer = mysqli_query($conn, $query);
                $current_answer = mysqli_fetch_assoc($result_answer);
                $text_answer = $current_answer['reponse_choix'];

                if ($index_answer == 0) {
                    echo "<p>Entrer la bonne réponse : </p>";
                    echo "<input type='text' class='rightAnswer" . $index_question . "' name='rightAnswer" . $index_question . "' value='" . $text_answer . "' required>";
                } else {
                    echo "<p>Entrer la mauvaise réponse " . $index_answer . " : </p>";
                    echo "<input type='text' class='Answer" . $index_question . "' name='AnswerButton" . $index_question . ($index_answer - 1) . "' value='" . $text_answer . "' required>";
                }
                $index_answer++;
            }
            echo "<div class='DivAnswer DivAnswerButton" . $index_question . "'> </div>";
            $index_question++;
            echo "</div>";
        endwhile;
        ?>

        </div>
        <div class="addQuestions">
            <input type="button" class="addQuestion" name="addQuestion" value="Ajouter une question">
        </div>
        <div class="removeQuestions">
            <input type="button" class="removeQuestion" name="removeQuestion" value="Retirer la dernière question">
        </div>
        <div class="removeAnswers">
            <input type="button" class="removeAnswer" name="removeAnswer" value="Retirer la dernière réponse">
        </div>
        <input type="submit" name="submit" value="Valider la modification" class="submit-button">
    </form>

    <script src="modif.js"></script>
    <button id="button1"><a href="usermenu.php">Retour au menu utilisateur</a></button>
</body>

</html>