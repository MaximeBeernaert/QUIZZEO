<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Creation Quizz</title>
    <link rel="stylesheet" href="createquizz.css">
</head>
<body>

<?php

    session_start();
    require('DBconnexion.php');

    $user = $_SESSION['user'];
    
    
    ?>
    
    <form class="form1" action="savequizz.php" method="post">

        <h1 class="Create Quizz">Create Quizz</h1>
        <input type="text" class="quizztitle" name="quizztitle" placeholder="Titre Quizz" required />
        <input type="text" class="quizzdiff" name="quizzdiff" placeholder="Difficulté Quizz" required />
        <input type="text" class="quizzreward" name="quizzreward" placeholder="Score Quizz" required />
        <div class="DivQuestion1">Question 1 - Entrer la question : 
            <input type="text" class="Question1" name="Question1"> Entrer la bonne réponse : 
            <input type="text" class="rightAnswer1" name="rightAnswer1"> Entrer la première mauvaise réponse : 
            <input type="text" class="Answer1" name="AnswerButton10">
            <div class="DivAnswerButton1">
                <input type="button" name="addAnswer1" value="Ajouter une réponse 1" class="Button1">
            </div>
        </div>
        <div class="addQuestions">
            <input type="button" class="addQuestion" name="addQuestion" value="Ajouter Question" >
        </div>
        <input type="submit" name="submit" value="Valider" class="submit-button">
    </form>
    
    
    <script src="createquizz.js"></script>
    <button id="button1"><a href="usermenu.php">Retour au menu utilisateur</a></button>
</body>
</html>