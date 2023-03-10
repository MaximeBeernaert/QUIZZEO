<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu utilisateur</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>

    <?php
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    $type_utilisateur = $user['type_utilisateur'];
    ?>

    <?php
    //if the user is a  utilisateur (type_utilisateur = 0), he can only see all the quizzes
    if ($type_utilisateur == 1 || $type_utilisateur == 2) :
    ?>
        <div class="usermenuQuizzList">Mes quizz :</div>
        <div class="display displayPersonalQuizz">

            <?php
            $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
            $result = mysqli_query($conn, $query);

            ?>
            <div class="myquizz">
                <?php
                if (mysqli_num_rows($result) == 0) :
                ?>
                    <h2>Tu n'as pas encore créé de quizz !</h2>
                <?php
                endif;
                ?>
            </div>
            <?php

            while ($row = mysqli_fetch_assoc($result)) :
                $id_quizz = $row['id_quizz'];
                $id_userQuizz = $row['auteur_quizz'];
                $queryUserQuizz = "SELECT * FROM `utilisateurs` WHERE `id_utilisateur` = '$id_userQuizz'";
                $resultUserQuizz = mysqli_query($conn, $queryUserQuizz);
                $userQuizz = mysqli_fetch_assoc($resultUserQuizz);
            ?>
                <div class="quizz">
                    <?php echo $row['titre_quizz']; ?>
                    <div class="quizzButton quizzPlay">
                        <form action="quizz.php" method="POST">
                            <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                            <button type="submit" name="choose2-quizz-btn" class="choose2-quizz-btn">Jouer !</button>
                        </form>
                    </div>
                    <?php
                    if ($type_utilisateur == 2) : ?>
                        <div class="quizzButton quizzModif">
                            <form action="modif.php" method="POST">
                                <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                                <button type="submit" name="modify2-btn" class="modify2-btn">Modifier</button>
                            </form>
                        </div>
                        <div class="quizzButton quizzDelete">
                            <form action="usermenu.php" method="POST">
                                <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                                <button type="submit" name="delete2-btn" class="delete2-btn">Supprimer</button>
                            </form>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
        <?php endwhile;
        endif;
        ?>
        </div>
        <div class="usermenuQuizzList">Tous les quizz :</div>
        <div class="display displayAllQuizz">

            <?php
            $query = "SELECT * FROM `quizz`";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
            ?>
                <h2>Il n'y a pas encore de quizz sur le site !</h2>
                <a href="createquizz.php">Créer le premier quizz</a>
                <?php
            } else {

                while ($row = mysqli_fetch_assoc($result)) :
                    $id_quizz = $row['id_quizz'];
                    $id_userQuizz = $row['auteur_quizz'];
                    $queryUserQuizz = "SELECT * FROM `utilisateurs` WHERE `id_utilisateur` = '$id_userQuizz'";
                    $resultUserQuizz = mysqli_query($conn, $queryUserQuizz);
                    $userQuizz = mysqli_fetch_assoc($resultUserQuizz);
                ?>
                    <div class="quizz">
                        <?php echo $row['titre_quizz']; ?>
                        <div class="quizzButton quizzPlay">
                            <form action="quizz.php" method="POST">
                                <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                                <button type="submit" name="choose2-quizz-btn" class="choose2-quizz-btn">Jouer !</button>
                            </form>
                        </div>
                        <?php
                        if ($type_utilisateur == 2) : ?>
                            <div class="quizzButton quizzModif">
                                <form action="modif.php" method="POST">
                                    <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                                    <button type="submit" name="modify2-btn" class="modify2-btn">Modifier</button>
                                </form>
                            </div>
                            <div class="quizzButton quizzDelete">
                                <form action="usermenu.php" method="POST">
                                    <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                                    <button type="submit" name="delete2-btn" class="delete2-btn">Supprimer</button>
                                </form>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
            <?php endwhile;
            }
            ?>
            <?php
            // if the user click on the delete button, delete the quiz from the database and ask confirmation with a button
            if (isset($_POST['delete2-btn'])) {
                $id_quizz = $_POST['id_quizz'];
                echo "<form action='usermenu.php' method='POST'>
                    <input type='hidden' name='id_quizz' value='$id_quizz'>
                    <p>Êtes-vous sûr de vouloir supprimer ce quizz ?</p>
                    <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn buttonRed'>Oui</button>
                    <button type='submit' name='buttonBlack cancel-delete-btn' class='buttonBlack cancel-delete-btn'>Non</button>
                </form>";
            }
            if (isset($_POST['confirm-delete-btn'])) {
                $id_quizz = $_POST['id_quizz'];


                $query = "DELETE FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question IN (SELECT id_question FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz')))";
                $result = mysqli_query($conn, $query);

                $query = "DELETE FROM `appartenir` WHERE id_question IN (SELECT id_question FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz'))";
                $result = mysqli_query($conn, $query);

                $query = "DELETE FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz')";
                $result = mysqli_query($conn, $query);

                $query = "DELETE FROM `contient` WHERE id_quizz='$id_quizz'";
                $result = mysqli_query($conn, $query);

                $query = "DELETE FROM `quizz` WHERE id_quizz='$id_quizz'";
                $result = mysqli_query($conn, $query);

                $query = "DELETE FROM 'jouer' WHERE id_quizz='$id_quizz'";
                $result = mysqli_query($conn, $query);

                echo ("<meta http-equiv='refresh' content='1'>");
            }
            ?>
</body>

</html>