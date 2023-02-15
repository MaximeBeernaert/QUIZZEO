<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Quizz</title>
</head>
<body>

    <div class="modifQuizz">

        <?php
        session_start();
        require('DBconnexion.php');

        $id = $_SESSION['id'];
        $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
        $result = mysqli_query($conn, $query);
        $actualQuizz = mysqli_fetch_assoc($result);

        ?>

        <a href="myquizz.php">Retour à mes Quizz</a>

        <h2>Bienvenue sur la page de modification de votre Quizz</h2> <?php echo " : " . $actualQuizz['titre_quizz']; ?>
        <!-- Display all the quizz in form for modification by user -->
        <form action="modifyquizz.php" method="POST">
            <?php $titre_quizz = $actualQuizz['titre_quizz'];?>
            <label for="titre">Titre de votre Quizz : </label>
            <?php echo "<input type='text' name='titre' value=$titre_quizz>"?>
            <br>

            <?php $difficulte_quizz = $actualQuizz['difficulte_quizz'];?>
            <label for="difficulte">Difficulté de votre Quizz : </label>
            <?php echo "<input type='text' name='difficulte' value=$difficulte_quizz>"?>
            <br>

            <?php $valeur_score_quizz = $actualQuizz['valeur_score_quizz'];?>
            <label for="valeur_score">Score de votre Quizz : </label>
            <?php echo "<input type='text' name='valeur_score' value=$valeur_score_quizz>"?>
            <br>

            




    </div>
    
</body>
</html>