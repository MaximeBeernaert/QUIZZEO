<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <header>
        <?php
        require('headerMenu.php');
        ?>
    </header>

    <?php
    require('DBconnexion.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $name    = stripslashes($_REQUEST['name']);
        $name    = mysqli_real_escape_string($conn, $name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $role = stripslashes($_REQUEST['role']);
        $role = mysqli_real_escape_string($conn, $role);

        //Check if passwords match and if email is valid
        if ($_REQUEST['password'] != $_REQUEST['confirmPassword']) {
            echo "<h3>Les mots de passe ne correspondent pas.</h3><br/>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h3>Adresse mail invalide.</h3><br/>";
        } else {
            //check if email is already registered
            $query    = "SELECT * FROM `utilisateurs` WHERE mail_utilisateur='$email'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                echo "<h3>Adresse mail déjà utilisée.</h3><br/>";
            } else {
                //add user to database
                $query    = "INSERT into `utilisateurs` (prenom_utilisateur, nom_utilisateur, mail_utilisateur, mdp_utilisateur, type_utilisateur)
                            VALUES ('$username', '$name', '$email', '" . md5($password) . "', '$role')";
                $result   = mysqli_query($conn, $query);

                //check if user is added to database
                if ($result) {
                    echo "<div class='form'>
                        <h3>Votre compte a bien été créer !</h3><br/>
                        <p class='link'>Cliquez <a href='login.php'>ici</a> pour vous connecter</p>
                        </div>";
                } else {
                    echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='signin.php'>signin</a> again.</p>
                        </div>";
                }
            }
        }
    } else {
    ?>

        <form class="form" action="" method="post">
            <h1 class="login-title">Inscription</h1>
            <input type="text" class="login-input" name="username" placeholder="Prénom" required />
            <input type="text" class="login-input" name="name" placeholder="Non" required />
            <input type="text" class="login-input" name="email" placeholder="Adresse Mail" require>
            <input type="password" class="login-input" name="password" placeholder="Mot de passe" require>
            <input type="password" class="login-input" name="confirmPassword" placeholder="Confirmer le mot de passe" require>

            <select type="role" name="role" class="login-input">
                <option value="0">Utilisateur</option>
                <option value="1">Quizzeur</option>
            </select>
            <input type="submit" name="submit" value="S'inscrire" class="login-button">
            <p class="link"><a href="login.php">Cliquez ici si vous avez déjà un compte</a></p>
        </form>

    <?php
    }
    ?>

</body>

</html>