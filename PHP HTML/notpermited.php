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
        require('header.php');
        ?>
    </header>

    <!-- // When the user is not correctly logged in, he is forwarded to this page, where he has the option to go to Login, or the Main Page. -->

    <div class="containerNotPermited">
        <div class="textNotPermited">
            Vous n'avez pas les droits pour accéder à cette page !
        </div>
        <div class="btnNotPermited">
            <a href="usermenu.php">Menu utilisateur</a>
            <a href="accueil.php">Accueil</a>
        </div>
    </div>

</body>

</html>