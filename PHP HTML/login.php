<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login.css">
    <meta charset="utf-8" />
    <title>Login</title>
    <!-- <link rel="stylesheet" href="style.css"/> -->
</head>

<body>

    <header>
        <h1>QUIZZEO</h1>
        <p>Log in</p>

    </header>
    <?php
    require('DBconnexion.php');
    session_start();
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
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>
        <div class="container">
            <div class="no2-container">
                <div class="header">
                </div>
                <form class="form" action='' method="post" name="login">
                    <h1 class="login-title">Login</h1>
                    <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true" />
                    <input type="password" class="login-input" name="password" placeholder="Password" />
                    <a href="accueil.php" class="link">Retour à l'accueil</a>
                    <input type="submit" name="submit" value="Valider " class="submit-button">
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>