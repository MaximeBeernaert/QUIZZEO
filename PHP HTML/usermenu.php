<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Menu</title>

</head>

<body>
    <?php
    require('header.php');
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    $type_utilisateur = $user['type_utilisateur'];
    ?>

    <div class="displayPersonalQuizz">
        Mes quizz :
        <?php
        $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) :
            $id_user = $row['auteur_quizz'];
            $id_quizz = $row['id_quizz'];
        ?>
            <div class="personalMain">
                <?php echo $row['titre_quizz']; ?>
                <div class="personalPlay">
                    <form action="quizz.php" method="POST">
                        <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                        <button type="submit" name="choose-quizz-btn" class="choose-quizz-btn">Jouer !</button>
                    </form>
                </div>
                <?php
                if ($type_utilisateur == 2) : ?>
                    <div class="personalModif">
                        <form action="usermenu.php" method="POST">
                            <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                            <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                        </form>
                    </div>
                    <div class="personalDelete">
                        <form action="usermenu.php" method="POST">
                            <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                            <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                        </form>
                    </div>
                <?php
                endif;
                ?>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="displayAllQuizz">
        Tous les quizz :
        <?php
        $query = "SELECT * FROM `quizz`";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Il n'y a pas encore de quizz.";
        }
        while ($row = mysqli_fetch_assoc($result)) :
            $id_quizz = $row['id_quizz'];
            $id_userQuizz = $row['auteur_quizz'];
            $queryUserQuizz = "SELECT * FROM `utilisateurs` WHERE `id_utilisateur` = '$id_userQuizz'";
            $resultUserQuizz = mysqli_query($conn, $queryUserQuizz);
            $userQuizz = mysqli_fetch_assoc($resultUserQuizz);
        ?>
            <div class="globalMain">
                <?php echo $row['titre_quizz']; ?>
                <div class="globalPlay">
                    <form action="quizz.php" method="POST">
                        <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                        <button type="submit" name="choose-quizz-btn" class="choose-quizz-btn">Jouer !</button>
                    </form>
                </div>
                <?php
                if ($type_utilisateur == 2) : ?>
                    <div class="globalModif">
                        <form action="usermenu.php" method="POST">
                            <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                            <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                        </form>
                    </div>
                    <div class="globalDelete">
                        <form action="usermenu.php" method="POST">
                            <input type="hidden" name="id_quizz" value="<?php echo $row['id_quizz']; ?>">
                            <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                        </form>
                    </div>
                <?php
                endif;
                ?>
            </div>
        <?php endwhile; ?>
    </div>

    <a id_quizz="retour" href="accueil.php">Retour à l'accueil</a>


    <?php
    // if the user click on the delete button, delete the quiz from the database and ask confirmation with a button
    if (isset($_POST['delete-btn'])) {
        $id_quizz = $_POST['id_quizz'];
        echo "<p>Êtes-vous sûr de vouloir supprimer ce quizz ?</p>";
        echo "<form action='usermenu.php' method='POST'>
             <input type='hidden' name='id_quizz' value='$id_quizz'>
             <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn'>Oui</button>
             <button type='submit' name='cancel-delete-btn' class='cancel-delete-btn'>Non</button>
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

        if ($result) {
            echo "Quizz supprimé avec succès";
            header("Refresh:0");
        } else {
            echo "Erreur lors de la suppression du quizz";
        }
    }

    // if the user click on the modify button, redirect to the modify page
    if (isset($_POST['modify-btn'])) {
        $id_quizz = $_POST['id_quizz'];
        header("Location: modif.php");
        $_SESSION['id_quizz'] = $id_quizz;
    }
    ?>
      <div id="affiches-container">
    <div class="affiche">
      <img src="image1.jpg" alt="Affiche 1">
      <h2>Quizz 1</h2>
    </div>
    <div class="affiche">
      <img src="image2.jpg" alt="Affiche 2">
      <h2>Quizz 2</h2>
    </div>
    <div class="affiche">
      <img src="image3.jpg" alt="Affiche 3">
      <h2>Quizz 3</h2>
    </div>
      <div class="affiche">
        <img src="image4.jpg" alt="Affiche 4">
        <h2>Quizz 4</h2>
      </div>
      <div class="affiche">
        <img src="image5.jpg" alt="Affiche 5">
        <h2>Quizz 5</h2>
      </div>
      <div class="affiche">
        <img src="image6.jpg" alt="Affiche 6">
        <h2>Quizz 6</h2>
      </div>
  </div>
  <?php
    require('footer.php');
  ?>
</body>

</html>