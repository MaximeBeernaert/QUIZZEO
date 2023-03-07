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
    if (!isset($_SESSION['user'])) {
        header("Location:notconnected.php");
    }
    $user = $_SESSION['user'];
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

    <div class="displayQuizz">
        <table>
            <?php
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
                    <td><?php echo $user['prenom_utilisateur'] . $user['id_utilisateur']; ?></td>
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
        ?>
    </div>

    <a id="retour" href="accueil.php">Retour à l'accueil</a>
</body>


</html>