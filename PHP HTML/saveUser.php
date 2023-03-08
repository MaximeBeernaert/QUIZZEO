<?php
require('DBconnexion.php');
session_start();
//if the user click on the modify button, update the user in the database and redirect to the admin panel
if (isset($_POST['modif-btn'])) {
    //get the new values in the form and update the user
    $id = $_POST['id_utilisateur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    if ($type == "Utilisateur") {
        $type = 0;
    } elseif ($type == "Quizzeur") {
        $type = 1;
    } else {
        $type = 2;
    }

    $sql = "UPDATE utilisateurs SET nom_utilisateur = '$nom', prenom_utilisateur = '$prenom', mail_utilisateur = '$email', type_utilisateur = '$type' WHERE id_utilisateur = '$id'";

    //if the update is successful, redirect to the admin panel
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: admin.php");
        echo "L'utilisateur a bien été modifié";
    } else {
        echo "L'utilisateur n'a pas été modifié";
    }
}
