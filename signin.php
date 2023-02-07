<?php
session_start(); 
include "DBconnexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $category = $_POST['category'];

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mdp, category)
    VALUES ('$nom', '$prenom', '$email', '$mdp', '$category')";

    if (mysqli_query($conn, $sql)) {
        echo "Compte créé avec succès";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>