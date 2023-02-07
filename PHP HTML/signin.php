<?php
session_start(); 
include "DBconnexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $category = $_POST['category'];

    extract($_POST);

    $sql = "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, mail_utilisateur, mdp_utilisateur, type_utilisateur)
    VALUES ('$nom', '$prenom', '$email', '$mdp', '$category')";
   
   $sql->excute (array(
        'nom_utilisateur' => $nom,
        'prenom_utilisateur' => $prenom,
        'mail_utilisateur' => $email,
        'mdp_utilisateur' => $mdp,
        'type_utilisateur' => $category
    ));

    if (mysqli_query($conn, $sql)) {
        echo "Compte créé avec succès";

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
header("Location: login.html");
?>