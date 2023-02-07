<?php 
session_start(); 
include "DBconnexion.php";
if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT mail_utilisateur,mdp_utilisateur FROM utilisateurs WHERE mail_utilisateur='$username' AND mdp_utilisateur='$pass'";
    $result = mysqli_query($conn, $sql);
    


    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['mail_utilisateur'] == $username && $row['mdp_utilisateur'] == $pass) {
            echo "Logged in!";
        }else{
            header("Location: login.html");
        }        
    }else{
        header("Location: login.html");
    }
}else{
    header("Location: login.html");
    exit();
}
?>