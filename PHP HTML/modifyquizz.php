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

        // Get the id of the quizz to modify
        $id = $_SESSION['id'];
        $query = "SELECT * FROM `quizz` WHERE id_quizz='$id'";
        $result = mysqli_query($conn, $query);
        $actualQuizz = mysqli_fetch_assoc($result);

        ?>

        <a href="myquizz.php">Retour à mes Quizz</a>

        <h2>Bienvenue sur la page de modification de votre Quizz<?php echo " : " . $actualQuizz['titre_quizz']; ?></h2> 
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

            <!-- Display all questions and answer for modifcation-->
            <?php
            $id_quizz = $actualQuizz['id_quizz'];
            $query = "SELECT * FROM `question` WHERE id_quizz='$id_quizz'";
            $result = mysqli_query($conn, $query);
            $resultCheck = mysqli_num_rows($result);
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)):
                $id_question = $row['id_question'];
                $query = "SELECT * FROM `reponse` WHERE id_question='$id_question'";
                $result2 = mysqli_query($conn, $query);
                $resultCheck2 = mysqli_num_rows($result2);
                $j = 1;
            ?>
                <label for="question">Question <?php echo $i; ?> : </label>
                <?php $question = $row['question'];?>
                <?php echo "<input type='text' name='question$i' value=$question>"?>
                <br>
                <?php while ($row2 = mysqli_fetch_assoc($result2)): ?>
                    <label for="reponse">Réponse <?php echo $j; ?> : </label>
                    <?php $reponse = $row2['reponse'];?>
                    <?php echo "<input type='text' name='reponse$i$j' value=$reponse>"?>
                    <br>
                <?php $j++; endwhile; ?>
            <?php $i++; endwhile; ?>
            <input type="submit" name="submit" value="Modifier">


            
            
        </form>
    </div>
</body>
</html>