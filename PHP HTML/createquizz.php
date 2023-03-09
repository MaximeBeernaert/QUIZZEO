<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Quizz</title>
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
        require 'header.php';
        ?>
    </header>

    <?php
    $user = $_SESSION['user'];
    if ($user['type_utilisateur'] < 1) {
        header("Location:notpermited.php");
    }
    ?>

    <form class="form" action="savequizz.php" method="post">

        <h1 class="Create Quizz">Création de quizz</h1>
        <input type="text" class="input quizztitle" name="quizztitle" placeholder="Titre Quizz" required />

        <i class="diffilculteStarCreateQuizz">&#9733;</i>
        <i class="diffilculteStarCreateQuizz">&#9733;</i>
        <i class="diffilculteStarCreateQuizz">&#9733;</i>
        <i class="diffilculteStarCreateQuizz">&#9733;</i>
        <i class="diffilculteStarCreateQuizz">&#9733;</i>

        <script>
            const stars = document.querySelectorAll('.diffilculteStarCreateQuizz');
            stars.forEach(star => {
                star.addEventListener('mouseover', selectStars)
                star.addEventListener('mouseleave', unselectStars)
                star.addEventListener('click', selectStars)
            });

            function selectStars(e) {
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

        <input type="text" class="input quizzdiff" name="quizzdiff" placeholder="Difficulté Quizz" required />
        <input type="text" class="input themequizz" name="themequizz" placeholder="Thème du Quizz" required />

        <div class="DivQuestion DivQuestion1">Question 1 - Entrer la question :
            <input type="text" class="Question1" name="Question1" required> Entrer la bonne réponse :
            <input type="text" class="rightAnswer1" name="rightAnswer1" required> Entrer la première mauvaise réponse :
            <input type="text" class="Answer1" name="AnswerButton10" required>
            <div class="DivAnswerButton1">
                <input type="button" name="addAnswer1" value="Ajouter une réponse 1" class="Button1">
            </div>
        </div>
        <div class="spaceDiv spaceDivQuestion"></div>
        <div class="addQuestions">
            <input type="button" class="buttonBlack addQuestion" name="addQuestion" value="Ajouter une question">
        </div>
        <div class="spaceDiv"></div>
        <div class="removeQuestions">
            <input type="button" class="buttonBlack removeQuestion" name="removeQuestion" value="Retirer la dernière question">
        </div>
        <div class="spaceDiv"></div>
        <div class="removeAnswers">
            <div class="spaceDiv"></div>
            <input type="button" class="buttonBlack removeAnswer" name="removeAnswer" value="Retirer la dernière réponse">
        </div>
        <div class="spaceDiv"></div>
        <input type="submit" name="submit" value="Valider le quizz" class="buttonBlue submit-button">
    </form>


    <script src="createquizz.js"></script>
</body>

</html>