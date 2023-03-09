<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Quizz</title>
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
    ?>

    <form class="form1" action="savequizz.php" method="post">

        <h1 class="Create Quizz">Création de quizz</h1>
        <input type="text" class="quizztitle" name="quizztitle" placeholder="Titre Quizz" required />
        <input type="text" class="quizzdiff" name="quizzdiff" placeholder="Difficulté Quizz" required />
        <input type="text" class="themequizz" name="themequizz" placeholder="Thème du Quizz" required />

        <div class="DivQuestion DivQuestion1">Question 1 - Entrer la question :
            <input type="text" class="Question1" name="Question1" required> Entrer la bonne réponse :
            <input type="text" class="rightAnswer1" name="rightAnswer1" required> Entrer la première mauvaise réponse :
            <input type="text" class="Answer1" name="AnswerButton10" required>
            <div class="DivAnswerButton1">
                <input type="button" name="addAnswer1" value="Ajouter une réponse 1" class="Button1">
            </div>
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
        <input type="submit" name="submit" value="Valider le quizz" class="submit-button">
    </form>


    <script src="createquizz.js"></script>
    <button id="button1"><a href="usermenu.php">Retour au menu utilisateur</a></button>
</body>

</html>