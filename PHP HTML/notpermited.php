<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu n'as pas la permission !</title>
</head>

<body>
    <header>
        <?php
        require('headermenu.php');
        ?>
    </header>

    <!-- If the user d'ont have the good permision on her accont they will display this page -->

    <div class="container">
        <div class="containerNot">
            Vous n'avez pas les droits pour accéder à cette page !
            <br>
        </div>
        <div class="text">
            Votre grade actuel ne vous permet pas d'accéder à cette section de Quizzeo, si cela vous semble étrange contacter un administrateur !
        </div>
    </div>

</body>

</html>