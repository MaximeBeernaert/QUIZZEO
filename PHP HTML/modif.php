<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Quizz</title>
    <style>
        .diffilculteStarCreateQuizz {
            font-size: 1.5rem;
        }

        .hover {
            color: #FFD700;
        }
    </style>

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


        <?php
        $user = $_SESSION['user'];
        if ($user['type_utilisateur'] < 1) {
            header("Location:notpermited.php");
        }

        $id_quizz = $_POST['id_quizz'];
        $_SESSION['id_quizz'] = $id_quizz;
        $query    = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
        $result = mysqli_query($conn, $query);
        $quizz = mysqli_fetch_assoc($result);
        $title_quizz = $quizz['titre_quizz'];
        $diff_quizz = $quizz['difficulte_quizz'];
        $theme_quizz = $quizz['theme_quizz'];

        ?>

        <form class="form" action="savemodif.php" method="post">

            <h1 class="Create Quizz">Modification de quizz</h1>
            <input type="text" class="input quizztitle" name="quizztitle" placeholder="Titre Quizz" value="<?php echo $title_quizz; ?>" required />
            <?php
            switch ($diff_quizz) {
                case 1:
                    $quizz_diff_text = 'Difficulté : Très facile';
                    break;
                case 2:
                    $quizz_diff_text = 'Difficulté : Facile';
                    break;
                case 3:
                    $quizz_diff_text = 'Difficulté : Moyen';
                    break;
                case 4:
                    $quizz_diff_text = 'Difficulté : Difficile';
                    break;
                case 5:
                    $quizz_diff_text = 'Difficulté : Très difficile';
                    break;
            }
            ?>

            <div class="quizzdiff" name="quizzdiff"><?php echo $quizz_diff_text; ?><input type="hidden" class="hiddenQuizzDiff" name="hiddenQuizzDiff" value=<?php echo $diff_quizz; ?>></div>

            <i class="diffilculteStarCreateQuizz" data-note="1">&#9733;</i>
            <i class="diffilculteStarCreateQuizz" data-note="2">&#9733;</i>
            <i class="diffilculteStarCreateQuizz" data-note="3">&#9733;</i>
            <i class="diffilculteStarCreateQuizz" data-note="4">&#9733;</i>
            <i class="diffilculteStarCreateQuizz" data-note="5">&#9733;</i>
            <br>

            <script>
                const stars = document.querySelectorAll('.diffilculteStarCreateQuizz');
                stars.forEach(star => {
                    star.addEventListener('mouseover', onHover)
                    star.addEventListener('mouseleave', unselectStars)
                    star.addEventListener('click', activeSelect)
                });

                function onHover(e) {
                    const data = e.target;
                    const etoiles = priviousSiblings(data);
                    etoiles.forEach(etoile => {
                        etoile.classList.add('hover');
                    })
                }

                function unselectStars(e) {
                    const data = e.target;
                    const etoiles = priviousSiblings(data);
                    etoiles.forEach(etoile => {
                        etoile.classList.remove('hover');
                    })
                }

                function activeSelect(e) {
                    // Switch for the diffilculty replace number in letter

                    const hiddenDiff = document.createElement('input');
                    hiddenDiff.type = 'hidden';
                    hiddenDiff.className = 'hiddenQuizzDiff';
                    hiddenDiff.name = 'hiddenQuizzDiff';

                    element = document.querySelector('.quizzdiff')
                    switch (e.target.dataset.note) {
                        case '1':
                            element.innerHTML = 'Difficulté : Très facile';
                            hiddenDiff.value = "1";
                            break;
                        case '2':
                            element.innerHTML = 'Difficulté : Facile';
                            hiddenDiff.value = "2";
                            break;
                        case '3':
                            element.innerHTML = 'Difficulté : Moyen';
                            hiddenDiff.value = "3";
                            break;
                        case '4':
                            element.innerHTML = 'Difficulté : Difficile';
                            hiddenDiff.value = "4";
                            break;
                        case '5':
                            element.innerHTML = 'Difficulté : Très difficile';
                            hiddenDiff.value = "5";
                            break;
                    }
                    element.appendChild(hiddenDiff);


                    const stars = document.querySelectorAll('.diffilculteStarCreateQuizz');
                    stars.forEach(star => {
                        star.classList.remove('hover');
                        star.removeEventListener('mouseleave', unselectStars)
                    })
                    const data = e.target;
                    const etoiles = priviousSiblings(data);
                    etoiles.forEach(etoile => {
                        etoile.classList.add('hover');
                    })
                }

                function priviousSiblings(data) {
                    let values = [data];
                    while (data = data.previousSibling) {
                        if (data.nodeName == "I") {
                            values.push(data);
                        }
                    }
                    return values;
                }
            </script>

            <br>

            <input type="text" class="input themequizz" name="themequizz" placeholder="Thème du Quizz" value="<?php echo $theme_quizz; ?>" required />
            <?php
            $index_question = 1;
            $query    = "SELECT * FROM `contient` WHERE id_quizz='$id_quizz'";
            $result_contient = mysqli_query($conn, $query);
            while ($current_contient = mysqli_fetch_assoc($result_contient)) :
                $id_question = $current_contient['id_question'];
                $query    = "SELECT * FROM `questions` WHERE id_question='$id_question'";
                $result_question = mysqli_query($conn, $query);
                $current_question = mysqli_fetch_assoc($result_question);
                $text_question = $current_question['intitule_question'];
                echo "<div class='DivQuestion DivQuestion" . $index_question . "'><p>Question " . $index_question . " - Entrer la question :</p>";
            ?>
                <input type="text" class="Question<?php echo $index_question; ?>" name="Question<?php echo $index_question; ?>" value="<?php echo $text_question; ?>" required />
                <?php
                $query    = "SELECT * FROM `appartenir` WHERE id_question='$id_question'";
                $result_appartenir = mysqli_query($conn, $query);
                $index_answer = 0;
                while ($current_appartenir = mysqli_fetch_assoc($result_appartenir)) {

                    $id_answer = $current_appartenir['id_choix'];
                    $query    = "SELECT * FROM `choix` WHERE id_choix='$id_answer'";
                    $result_answer = mysqli_query($conn, $query);
                    $current_answer = mysqli_fetch_assoc($result_answer);
                    $text_answer = $current_answer['reponse_choix'];

                    if ($index_answer == 0) {
                        echo "<p>Entrer la bonne réponse : </p>";
                        echo "<input type='text' class='rightAnswer" . $index_question . "' name='rightAnswer" . $index_question . "' value='" . $text_answer . "' required>";
                    } elseif ($index_answer == 1) {
                        echo "<p>Entrer la(les) mauvaise(s) réponse(s) : </p>";
                        echo "<input type='text' class='Answer" . $index_question . "' name='AnswerButton" . $index_question . ($index_answer - 1) . "' value='" . $text_answer . "' required><br>";
                    } else {
                        echo "<br><input type='text' class='Answer" . $index_question . "' name='AnswerButton" . $index_question . ($index_answer - 1) . "' value='" . $text_answer . "' required><br>";
                    }
                    $index_answer++;
                }
                ?>
                <br>
                <div class='DivAnswer DivAnswerButton<?php echo $index_question ?>'> </div>
                <div class="DivAnswerRemove DivAnswerRemove<?php echo $index_question ?>"></div>

            <?php
                $index_question++;
                echo "</div>";

            endwhile;
            ?>
            <div class="spaceDiv spaceDivQuestion"></div>
            <div class="addQuestions">
                <input type="button" class="buttonBlack addQuestion" name="addQuestion" value="Ajouter une question">
            </div>
            <div class="spaceDiv"></div>
            <div class="removeQuestions">
                <input type="button" class="buttonBlack removeQuestion" name="removeQuestion" value="Retirer la dernière question">
            </div>
            <div class="spaceDiv"></div>
            <div class="spaceDiv"></div>
            <input type="submit" name="submit" value="Valider le quizz" class="buttonBlue submit-button">
        </form>
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>
    <script src="modif.js"></script>

</body>

</html>