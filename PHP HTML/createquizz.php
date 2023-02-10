<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create Quizz</title>
</head>
<body>

<?php

    session_start();
    require('DBconnexion.php');

    $user = $_SESSION['user'];
    if(isset($_REQUEST['quizztitle'])){
        $title = $_REQUEST['quizztitle'];
    }

?>

    <form class="form" action="" method="post">

        <h1 class="Create Quizz">Create Quizz</h1>
        <input type="text" class="Quizz Title" name="quizztitle" placeholder="Titre Quizz" required />
        <input type="submit" name="submit" value="Valider" class="submit-button">
    </form>
    <div class="addQuestions">
        <button type="text" class="addQuestion" name="addQuestion" placeholder="AddQuestion">
    </div>
    <script src="createquizz.js"></script>
    <button id="button1"><a href="accueil.php">Retour à l'accueil</a></button>
</body>
</html>