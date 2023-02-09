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

?>
    <form class="form" action="" method="post">
        <h1 class="Create Quizz">Create Quizz</h1>
        <input type="text" class="Quizz Title" name="quizztitle" placeholder="Titre Quizz" required />
        
        <input type="submit" name="submit" value="Valider" class="submit-button">
    </form>
</body>
</html>