<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
</head>
<body>
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
            }else {
                //add user to database
                $query    = "INSERT into `utilisateurs` (prenom_utilisateur, nom_utilisateur, mail_utilisateur, mdp_utilisateur, type_utilisateur)
                            VALUES ('$username', '$name', '$email', '" . md5($password) . "', '2')";
                $result   = mysqli_query($conn, $query);
                
                //check if user is added to database
                if ($result) {
                    echo "<div class='form'>
                        <h3>Votre compte a bien été créer !</h3><br/>
                        <p class='link'>Click here to <a href='login.php'>Login</a></p>
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
    <h1 class="login-title">Registration</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" required />
    <input type="text" class="login-input" name="name" placeholder="Name" required />
    <input type="text" class="login-input" name="email" placeholder="Email Adress" require>
    <input type="password" class="login-input" name="password" placeholder="Password" require>
    <input type="password" class="login-input" name="confirmPassword" placeholder="Confirm Password" require>
    <input type="submit" name="submit" value="Register" class="login-button">
    <p class="link"><a href="login.php">Click to Login</a></p>
</form>

<?php
    }
?>
</body>
</html>