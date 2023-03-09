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

        <br>
        <p class="quizzdiff">Difficulté : </p>
        <i class="diffilculteStarCreateQuizz" data-note="1">&#9733;</i>
        <i class="diffilculteStarCreateQuizz" data-note="2">&#9733;</i>
        <i class="diffilculteStarCreateQuizz" data-note="3">&#9733;</i>
        <i class="diffilculteStarCreateQuizz" data-note="4">&#9733;</i>
        <i class="diffilculteStarCreateQuizz" data-note="5">&#9733;</i>
        <br>

        <script>
            const stars = document.querySelectorAll('.diffilculteStarCreateQuizz');
            let check = false;
            let count = 0;
            stars.forEach(star => {
                star.addEventListener('mouseover', onHover)
                star.addEventListener('mouseleave', unselectStars)
                star.addEventListener('click', onClick)
            });
            function onClick(e) {
                count++;
                console.log(check);
                console.log(count);
                
                activeSelect(e);
            }

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
                check = true;
                // Switch for the diffilculty replace number in letter
                switch (e.target.dataset.note) {
                    case '1':
                        document.querySelector('.quizzdiff').innerHTML = 'Difficulté : Très facile';
                        break;
                    case '2':
                        document.querySelector('.quizzdiff').innerHTML = 'Difficulté : Facile';
                        break;
                    case '3':
                        document.querySelector('.quizzdiff').innerHTML = 'Difficulté : Moyen';
                        break;
                    case '4':
                        document.querySelector('.quizzdiff').innerHTML = 'Difficulté : Difficile';
                        break;
                    case '5':
                        document.querySelector('.quizzdiff').innerHTML = 'Difficulté : Très difficile';
                        break;
                }
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
        <input type="text" class="input themequizz" name="themequizz" placeholder="Thème du Quizz" required />

        <div class="DivQuestion DivQuestion1">
            <p>Question 1 - Entrer la question :</p>
            <input type="text" class="Question1" name="Question1" required>
            <p>Entrer la bonne réponse :</p>
            <input type="text" class="rightAnswer1" name="rightAnswer1" required>
            <p>Entrer la première mauvaise réponse :</p>
            <input type="text" class="Answer1" name="AnswerButton10" required>
            <div class="DivAnswerButton1">
                <input type="button" name="addAnswer1" value="Ajouter une réponse à la question 1" class="Button1">
            </div>
            <div class="DivAnswerRemove1">
                <input type="button" class='removeAnswer1' name="removeAnswer1" value="Retirer une réponse à la question 1">
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