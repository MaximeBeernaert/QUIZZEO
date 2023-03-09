<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Quizz</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>

    <a href="usermenu.php">Menu principal</a>

    <h1>Mes Quizz</h1>

    <table>
        <?php
        $user = $_SESSION['user'];
        $id_utilisateur = $user['id_utilisateur'];
        $type_utilisateur = $user['type_utilisateur'];
        if ($type_utilisateur == 2) {
            $query = "SELECT * FROM `quizz`";
        } else {
            $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
        }

        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) :
            $id_user = $row['auteur_quizz'];
        ?>
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
    if (isset($_POST['modify-btn'])) {
        $id_quizz = $_POST['id'];
        header("Location: modifyquizz.php");
        $_SESSION['id_quizz'] = $id_quizz;
    }
    ?>

</body>

</html>