<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <header>
        <?php
        require('headermenu.php');
        ?>
    </header>

    <div class="mainPage">
        <div class=" banner">
            <?php echo "<img class='houseIcone' src='poudlardMaison.png'>" ?>
        </div>

        <?php

        // When form submitted, check and create user session.
        if (isset($_POST['email'])) {
            // removes backslashes
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($conn, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);
            // Check user is exist in the database
            $query    = "SELECT * FROM `utilisateurs` WHERE mail_utilisateur='$email'
                     AND mdp_utilisateur='" . md5($password) . "'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user'] = $user;
                // Redirect to user dashboard page
                header("Location: usermenu.php");
            } else {
                echo "<div class='form'>
                  <h3>Mot de passe ou identifiant incorrecte</h3><br/>
                  <p class='link'><a href='login.php'>Cliquez ici pour réessayer</a></p>
                  </div>";
            }
        } else {
        ?>
            <form class="form" action='' method="post">

                <h1 class="login-title">Connexion</h1>

                <input type="text" class="input" name="email" placeholder="Email" autofocus="true" require />
                <input type="password" class="input" name="password" placeholder="Mot de passe" require />

                <input type="submit" name="submit" value="Connexion" class="buttonBlue">
                <p class="link"><a href="signin.php">Cliquez ici si vous n'avez pas encore de compte</a></p>
            </form>
        <?php
        }
        ?>
        <div class=" banner">
            <?php echo "<img class='houseIcone' src='poudlardMaison.png'>" ?>
        </div>
    </div>
</body>

</html>