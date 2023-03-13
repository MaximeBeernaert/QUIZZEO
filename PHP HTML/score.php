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
    <?php
    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>



        <div class='form'>
            <?php
            $user = $_SESSION['user'];
            echo "<h1>Mes Scores</h1>";

            $id_user = $user['id_utilisateur'];
            $quizz_total_average = [];


            $query    = "SELECT * FROM `quizz`";
            $result_quizz = mysqli_query($conn, $query);
            while ($row_quizz = mysqli_fetch_assoc($result_quizz)) {
                $quizz_average = [];
                $id_quizz = $row_quizz['id_quizz'];
                $query    = "SELECT * FROM `jouer` WHERE `id_utilisateur` = $id_user AND `id_quizz`=$id_quizz";
                $result_score = mysqli_query($conn, $query);
                while ($row_score = mysqli_fetch_assoc($result_score)) {
                    if (isset($row_score['score'])) {
                        array_push($quizz_total_average, $row_score['score']);
                        array_push($quizz_average, $row_score['score']);
                    }
                }
                if ($quizz_average != []) {
                    $average_result = round(array_sum($quizz_average) / count($quizz_average), 2);
                    echo "<p>Votre moyenne pour le quizz " . $row_quizz['titre_quizz'] . " est de " . $average_result . " %<br>Nombre d'essais : " . count($quizz_average) . "</p>";
                }
            }
            if ($quizz_total_average != null) {
                echo "<br><br>Votre moyenne générale aux Quizz : ";
                $average_result = round(array_sum($quizz_total_average) / count($quizz_total_average), 2);
                echo $average_result . " % </p>";
            } else {
                echo "<p>Vous n'avez pas encore de résultats.</p>";
            }
            ?>
        </div>



        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>
</body>

</html>