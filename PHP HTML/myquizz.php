<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Quizz</title>
</head>

<body>

    <a href="usermenu.php">Menu principal</a>

    <h1>Mes Quizz</h1>

    <table>
        <?php
        session_start();
        require('DBconnexion.php');

        $user = $_SESSION['user'];
        $id_utilisateur = $user['id_utilisateur'];
        $type_utilisateur = $user['type_utilisateur'];
        if ($type_utilisateur == 2) {
            $query = "SELECT * FROM `quizz`";
        } else {
            $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
        }

        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result);

        //don't display if the quizz list if is empty
        if ($resultCheck < 1) {
            echo "Il n'y a pas de quizz dans la base de données";
            return;
        }

        while ($row = mysqli_fetch_assoc($result)) :
            $id_user = $row['auteur_quizz'];
        ?>
            <tr>
                <td><?php echo $row['titre_quizz']; ?></td>
                <td><?php echo $id_user; ?></td>
                <td><?php echo $row['date_creation_quizz']; ?></td>
                <td>
                    <form action="myquizz.php" method="POST">
                        <?php $id_quizz = $row['id_quizz'];
                        echo "<input type='hidden' name='id' value=$id_quizz>" ?>
                        <button type="submit" name="modif-btn" class="modif-btn">Modifier</button>
                    </form>
                </td>
                <td>
                    <form action="myquizz.php" method="POST">
                        <?php $id_quizz = $row['id_quizz'];
                        echo "<input type='hidden' name='id' value=$id_quizz>" ?>
                        <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                    </form>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>
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
    if (isset($_POST['modif-btn'])) {
        $id = $_POST['id'];
        header("Location: modifquizz.php");
        $_SESSION['id'] = $id;
    }
    ?>

</body>

</html>