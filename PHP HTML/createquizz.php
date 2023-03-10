<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation Quizz</title>
    <!-- !! inside CSS for the stars !! -->
    <!-- woopwoop -->
    <!-- stars! -->
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
                <!-- we call for the header.php for the header HTML and the CSS -->
        <?php
        require 'header.php';
        ?>
    </header>
    <?php
    // Then we call for the current colors (out of the SESSION cookies) chosen by the user (if not set, we put Serpentard>Griffondor colors)
    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    ?>
    <!-- Main page, where the banners and table of users will be -->
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
        <?php
        $user = $_SESSION['user'];
        // Verify if the user connected has the right to be on the admin page.
        if ($user['type_utilisateur'] < 1) {
            header("Location:notpermited.php");
        }
        ?>
        <!-- Form where the quizz is inputed -->
        <form class="form" action="savequizz.php" method="post">

            <h1 class="Create Quizz">Création de quizz</h1>
            <input type="text" class="input quizztitle" name="quizztitle" placeholder="Titre Quizz" required />

            <br>
            <!-- stars! -->
            <div class="quizzdiff" name="quizzdiff">Difficulté : Moyen <input type="hidden" class="hiddenQuizzDiff" name="hiddenQuizzDiff" value="3"></div>
            <div>
                <!-- data-node for the animation -->
                <i class="diffilculteStarCreateQuizz" data-note="1">&#9733;</i>
                <i class="diffilculteStarCreateQuizz" data-note="2">&#9733;</i>
                <i class="diffilculteStarCreateQuizz" data-note="3">&#9733;</i>
                <i class="diffilculteStarCreateQuizz" data-note="4">&#9733;</i>
                <i class="diffilculteStarCreateQuizz" data-note="5">&#9733;</i>
            </div>
            <br>

            <script>
                // script for the stars
                // we add event listeners here : mouseover, mouseleave, and when the user click
                const stars = document.querySelectorAll('.diffilculteStarCreateQuizz');
                stars.forEach(star => {
                    star.addEventListener('mouseover', onHover)
                    star.addEventListener('mouseleave', unselectStars)
                    star.addEventListener('click', activeSelect)
                });
                // the corresponding functions
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

            <!-- HTML for the first question to input -->
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
            <div class="spaceDiv"></div>
            <input type="submit" name="submit" value="Valider le quizz" class="buttonBlue submit-button">
        </form>
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    <!-- footer of the page -->
    <?php
    require('footer.php');
    ?>
    <!-- JS script corresponding -->
    <script src="createquizz.js"></script>
</body>

</html>