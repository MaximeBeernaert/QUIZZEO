<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz non sauvegardé</title>
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
    <div class="containerQuizzNotSaved">
        <div class="textQuizzNotSaved">
            Le Quizz n'a pas été sauvegardé !
        </div>
        <div class="btnQuizzNotSaved">
            <a href="usermenu.php">Menu utilisateur</a>
            <a href="accueil.php">Accueil</a>
        </div>
    </div>
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