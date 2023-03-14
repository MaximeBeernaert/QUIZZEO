<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <header>
        <!-- we call the headermenu.php, different of header.php for a different style while not-connected-->
        <?php
        require('headermenu.php');
        ?>
    </header>
    <div class="mainPage">
        <!-- we call for the first banner -->
        <div class=" banner">
            <?php echo "<img class='houseIcone' src='poudlardMaison.png'>" ?>
        </div>
        <div class="containerPage">
            <div class="welcome">
                <h1>Bienvenue sur Quizzeo !</h1>
            </div>
            <div class="text">
                <h2>Tu es à l'accueil, tu peux te connecter ou t'inscrire !</h2>
                <h3>
                    Quizzeo est une plateforme de quizz en ligne. Le site vous permet de s’inscrire et de choisir si vous êtes utilisateur ou quizzeur, puis de vous connecter.
                    <br>
                    <br>
                    Une fois votre compte créé vous pourrez jouer à des quizzs ou bien créer vos propres quizz en fonction de votre grade.
                    <br>
                    <br>
                    Cette plateforme a été créée dans le cadre d'un projet à l'IPSSI réalisé par 3 étudiants en 4 semaines.
                    <br>
                    <br>
                    Développé par : Maxime BEERNAERT, Enzo BORGES PEREIRA & Léon VACHETTE, étudiants en 1ère année de Prépa Bachelors à l'IPSSI.
                </h3>
            </div>

        </div>
        <!-- we call the second banner -->
        <div class=" banner">
            <?php echo "<img class='houseIcone' src='poudlardMaison.png'>" ?>
        </div>
    </div>
</body>

</html>