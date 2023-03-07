<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Gérer mes Quizz</title>
    <title>Gérer mes Quizz</title>
</head>

<body>
    <table>
        <?php
        session_start();
        require('DBconnexion.php');
        if (!isset($_SESSION['user'])) {
            header("Location:notconnected.php");
        }
        $user = $_SESSION['user'];
        $id_utilisateur = $user['id_utilisateur'];

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
                <td><?php echo $userQuizz['prenom_utilisateur'] . $userQuizz['id_utilisateur']; ?></td>
                <td><?php echo $row['date_creation_quizz']; ?></td>
                <td>
                    <form action="quizz.php" method="POST">
                        <?php echo "<input type='hidden' name='id_quizz' value='$id_quizz'>" ?>
                        <button type="submit" name="choose-quizz-btn" class="choose-quizz-btn">Choisir ce quizz</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php
    if (mysqli_fetch_assoc($result) == null) {
        echo "Il n'y a pas encore de quizz.";
    }
    echo "<p class='link'><a href='usermenu.php'>Revenir au menu Utilisateur</a></p>";
    ?>

</html>