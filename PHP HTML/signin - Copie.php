<?php
session_start(); 
include "DBconnexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['mail'];
    $mdp = $_POST['mdp'];

    $sql = "INSERT INTO 'utilisateurs' ('prenom_utilisateur', 'nom_utilisateur', 'mail_utilisateur', 'mdp_utilisateur', 'type_utilisateur') VALUES ('$nom', '$prenom', '$email', '$mdp', 2)" ;
    
    if (mysqli_query($conn, $sql)) {
        echo "Compte créé avec succès";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

?>