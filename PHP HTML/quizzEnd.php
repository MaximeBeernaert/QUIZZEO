<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fin du Quizz</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>
    <?php
    if( isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ","",$_COOKIE['currentHouse']);
    }else{
        $currentHouse = 'Serpentard';
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    <div class="form">
    <table>
        <?php
        $user = $_SESSION['user'];
        $id_quizz = $_SESSION['id_quizz'];

        $query    = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
        $result = mysqli_query($conn, $query);
        $quizz = mysqli_fetch_assoc($result);

        echo "<div class='titleRed'>Résultats : " . $quizz['titre_quizz'] . "</div><br><br>";

        $number = 0;
        $answers_array = [];

        $query    = "SELECT * FROM `contient` WHERE id_quizz='$id_quizz'";
        $result = mysqli_query($conn, $query);

        while ($row_question = mysqli_fetch_assoc($result)) {

            $id_question = $row_question['id_question'];
            $query    = "SELECT * FROM `questions` WHERE id_question='$id_question'";
            $result_question = mysqli_query($conn, $query);
            $question = mysqli_fetch_assoc($result_question);
            $question_text = $question['intitule_question'];
            echo "Question " . ($number+1) . " : " . $question_text . "<br>";

            $id_choix  = $_COOKIE['cookieAnswer' . $number];
            $query    = "SELECT * FROM `choix` WHERE id_choix='$id_choix'";
            $result_answer = mysqli_query($conn, $query);
            $answer = mysqli_fetch_assoc($result_answer);
            echo "<br>Réponse choisie : " . $answer['reponse_choix'];
            if ($answer['bonne_reponse_choix'] == 0) {
                echo "<br>C'est une mauvaise réponse.";
                array_push($answers_array, 0);
            } else {
                echo "<br>C'est une bonne réponse.";
                array_push($answers_array, 100);
            }
            echo "<br><br>";
            $number++;
        }
        $average_result = round(array_sum($answers_array) / count($answers_array), 2);
        echo "<br>Votre score : " . $average_result;

        $id_user = $user['id_utilisateur'];
        $query = "INSERT INTO `jouer`(`id_utilisateur`, `id_quizz`,`score`) VALUES ('$id_user','$id_quizz',$average_result)";
        $result = mysqli_query($conn, $query);
        echo "<p class='link'><a href='usermenu.php'>Revenir au menu Utilisateur</a></p>";
        ?>
    </table>
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