<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes scores</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>

    <div class='form'>
        <?php
        $user = $_SESSION['user'];
        echo "<h1>Mes Scores</h1>";

        $id_user = $user['id_utilisateur'];
        $quizz_total_average = [];
        $quizz_list = [];


        $query    = "SELECT * FROM `jouer` WHERE `id_utilisateur` = $id_user";
        $result = mysqli_query($conn, $query);
        if (!mysqli_fetch_assoc($result)) {
            echo "<p>Vous n'avez pas encore de résultats.</p>";
        } else {
            $query    = "SELECT * FROM `quizz`";
            $result = mysqli_query($conn, $query);
            while ($row_quizz_list = mysqli_fetch_assoc($result)) {
                array_push($quizz_list, $row_quizz_list['id_quizz']);
            }

            for ($index = 0; $index < count($quizz_list); $index++) {
                $quizz_average = [];
                $id_quizz = $quizz_list[$index];
                $query    = "SELECT * FROM `jouer` WHERE `id_utilisateur` = $id_user AND `id_quizz` = $id_quizz";
                $result = mysqli_query($conn, $query);
                while ($row_quizz = mysqli_fetch_assoc($result)) {
                    array_push($quizz_average, $row_quizz['score']);
                }
                $average_result = round(array_sum($quizz_average) / count($quizz_average), 2);
                $query    = "SELECT * FROM `quizz` WHERE `id_quizz` = $id_quizz";
                $result = mysqli_query($conn, $query);
                $quizz = mysqli_fetch_assoc($result);
                $quizz_title = $quizz['titre_quizz'];
                echo "<br><p>Votre moyenne pour le quizz " . $quizz_title . " : " . $average_result." % </p>";

                array_push($quizz_total_average, $average_result);
            }

            echo "<br><br>Votre Moyenne générale aux Quizz : ";
            $average_result = round(array_sum($quizz_total_average) / count($quizz_total_average), 2);
            echo $average_result." % </p>";
        }

        ?>
    </div>

</body>

</html>