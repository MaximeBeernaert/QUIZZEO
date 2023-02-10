<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <!-- <link rel="stylesheet" href="style.css"/> -->
</head>
<body>
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
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="signin.php">Entrer!</a></p>
  </form>
  <button id="button1">
        <a href="accueil.php">Retour à l'accueil</a>
         </button>
<?php
    }
?>
</body>
</html>