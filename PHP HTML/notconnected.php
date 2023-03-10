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

  <div class="containerNot">
    <div class="containerText">
      Vous n'êtes pas encore connecté !
    </div>

    <form action="login.php">
      <input type="submit" name="submit" value="Connexion" class="buttonBlue">
    </form>

    <form action="accueil.php">
      <input type="submit" name="submit" value="Accueil" class="buttonBlue">
    </form>
  </div>
</body>

</html>