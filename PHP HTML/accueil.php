<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="accueil.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <header>    
        <?php
        require('headermenu.php');
        ?>
    </header>

    <div class="container">
        <section class="Connexion">
            <button id="button1">
                <a href="signin.php">Inscription</a>
            </button>
            <button id="button2">
                <a href="login.php">Connexion</a>
            </button>
            <?php
            if (isset($_SESSION['user'])) {
                echo "<button id='button2'> <a href='usermenu.php'>Menu utilisateur</a> </button>";
                if ($_SESSION['user']['type_utilisateur'] == 2) {
                    echo "<button id='button3'> <a href='admin.php'>Panel Admin</a> </button>";
                }
            }
            ?>
        </section>
    </div>
</body>

</html>