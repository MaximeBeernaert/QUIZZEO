<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu n'es pas connecter !</title>
</head>

<body>
  <header>
    <?php
    require('headermenu.php');
    ?>
  </header>

  <!-- // When the user is not yet logged in, he is forwarded to this page, where he has the option to go to Login, or the Main Page.  -->

  <div class="containerNotConnected">
    <div class="textNotConnected">
      Vous n'êtes pas encore connecté !
    </div>
    <div class="btnNotConnected">
      <a href="login.php">Connexion</a>
      <a href="accueil.p">Accueil</a>
    </div>
  </div>
</body>

</html>