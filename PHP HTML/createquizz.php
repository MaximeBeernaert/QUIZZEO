<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Creation Quizz</title>
    <title>Creation Quizz</title>
</head>
<body>

<?php

    session_start();
    require('DBconnexion.php');

    $user = $_SESSION['user'];
    
    
?>

    <form class="form1" action="savequizz.php" method="post">
    <form class="form1" action="savequizz.php" method="post">

        <h1 class="Create Quizz">Create Quizz</h1>
        <input type="text" class="quizztitle" name="quizztitle" placeholder="Titre Quizz" required />
        <input type="text" class="quizzdiff" name="quizzdiff" placeholder="Difficulté Quizz" required />
        <input type="text" class="quizzreward" name="quizzreward" placeholder="Score Quizz" required />
        <div class="addQuestions">
            <input type="button" class="addQuestion" name="addQuestion" value="Ajouter Question" >
        </div>
        <input type="submit" name="submit" value="Valider" class="submit-button">
    </form>
    
    
    <script src="createquizz.js"></script>
    <button id="button1"><a href="accueil.php">Retour à l'accueil</a></button>
</body>
</html>