<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Menu</title>
    <link rel="stylesheet" href="usermenu.css">
</head>

<body>
    <?php
    session_start();
    require('DBconnexion.php');
    require('header.php');
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }
    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    $type_utilisateur = $user['type_utilisateur'];
    ?>
    <header>
        <h1>QUIZZEO</h1>
        <p>Menu utilisateur</p>
    </header>

    <div class="userinfo">
        <p>Vous êtes connecté sous le compte de <?php echo $user['nom_utilisateur'] . " " . $user['prenom_utilisateur'] ?></p>
    </div>

    <container>
        <ul>
            <li><a href="score.php" class="link2">Voir les scores</a></li>
            <li><a href="createquizz.php" class="link3">Créer un quizz</a></li>
            <li><a href="admin.php" class="link4">Accéder au panel admin</a></li>
        </ul>
    </container>

    <div class="displayPersonalQuizz">
        Mes quizz :
        <?php
        $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) :
            $id_user = $row['auteur_quizz'];
        ?>
            <br>
            <tr>
                <td><?php echo $row['titre_quizz']; ?></td>
                <td><?php echo $id_user; ?></td>
                <td><?php echo $row['date_creation_quizz']; ?></td>
                <td>
                    <form action="myquizz.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_quizz']; ?>">
                        <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                    </form>
                </td>
                <td>
                    <form action="myquizz.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_quizz']; ?>">
                        <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                    </form>
                </td>
            </tr>
            <br>
        <?php endwhile; ?>
        </table>
    </div>

    <div class="displayAllQuizz">
        Tous les quizz :
        <table>
            <?php
            $query = "SELECT * FROM `quizz`";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) :
                $id_quizz = $row['id_quizz'];
                $id_userQuizz = $row['auteur_quizz'];
                $queryUserQuizz = "SELECT * FROM `utilisateurs` WHERE `id_utilisateur` = '$id_userQuizz'";
                $resultUserQuizz = mysqli_query($conn, $queryUserQuizz);
                $userQuizz = mysqli_fetch_assoc($resultUserQuizz);
            ?>
                <tr>
                    <td><?php echo $row['titre_quizz']; ?></td>
                    <td><?php echo $user['prenom_utilisateur'] . $user['id_utilisateur']; ?></td>
                    <td><?php echo $row['date_creation_quizz']; ?></td>
                    <?php
                    if ($type_utilisateur == 2) : ?>
                        <td>
                            <form action="myquizz.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id_quizz']; ?>">
                                <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form action="myquizz.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id_quizz']; ?>">
                                <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                            </form>
                        </td>
                    <?php
                    endif;
                    ?>
                    <td>
                        <form action="quizz.php" method="POST">
                            <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                            <button type="submit" name="choose-quizz-btn" class="choose-quizz-btn">Jouer !</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
        if (mysqli_fetch_assoc($result) == null) {
            echo "Il n'y a pas encore de quizz.";
        }
        ?>
    </div>
    <a id="retour" href="accueil.php">Retour à l'accueil</a>


    <?php
    // if the user click on the delete button, delete the quiz from the database and ask confirmation with a button
    if (isset($_POST['delete-btn'])) {
        $id = $_POST['id'];
        echo "<p>Êtes-vous sûr de vouloir supprimer ce quizz ?</p>";
        echo "<form action='myquizz.php' method='POST'>
             <input type='hidden' name='id' value='$id'>
             <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn'>Oui</button>
             <button type='submit' name='cancel-delete-btn' class='cancel-delete-btn'>Non</button>
         </form>";
    }
    if (isset($_POST['confirm-delete-btn'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM quizz WHERE id_quizz = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Quizz supprimé avec succès";
            header("Location: myquizz.php");
        } else {
            echo "Erreur lors de la suppression du quizz";
        }
    }

    // if the user click on the modify button, redirect to the modify page
    if (isset($_POST['modify-btn'])) {
        $id_quizz = $_POST['id'];
        header("Location: modifyquizz.php");
        $_SESSION['id_quizz'] = $id_quizz;
    }
    ?>

</body>

</html>