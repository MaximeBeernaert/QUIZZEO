<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modifyuser.css">
    <title>User Modification</title>
</head>
<body>

    <div class="userModif">

        <?php
        require 'DBconnexion.php';

        // get the id of the user to modify
        $id = $_GET['id'];
        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = '$id'";
        $result = mysqli_query($conn, $sql);
        $actualUser = mysqli_fetch_assoc($result);

        //change the type of user from number to string to display it
        switch ($actualUser['type_utilisateur']) {
            case 1:
                $actualUser['type_utilisateur'] = "Quizzeur";
                break;
            case 2:
                $actualUser['type_utilisateur'] = "Administrateur";
                break;
            default:
                $actualUser['type_utilisateur'] = "Utilisateur";
                break;
        }

        ?>

        <a href="admin.php">Retour au panel admin</a>

        <h1>Modification de l'utilisateur suivant : </h1><br> <h3><?php echo "ID : " . $actualUser['id_utilisateur'] . " Nom : " . $actualUser['nom_utilisateur'] . " Prénom : " . $actualUser['prenom_utilisateur']; ?></h3>

        <form action="modifyUser.php" method="POST">
            <?php 
            $nom_utilisateur = $actualUser['nom_utilisateur'];
            echo "<input type='hidden' name='id' value=$nom_utilisateur>" ?>
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" value="<?php echo $actualUser['nom_utilisateur']; ?>">
            <br>

            <?php 
            $prenom_utilisateur = $actualUser['prenom_utilisateur'];
            echo "<input type='hidden' name='id' value=$prenom_utilisateur>" ?>
            <label for="prenom">Prénom : </label>
            <input type="text" nane="prenom" id="prenom" value="<?php echo $actualUser['prenom_utilisateur']; ?>">
            <br>

            <?php 
            $mail_utilisateur = $actualUser['mail_utilisateur'];
            echo "<input type='hidden' name='id' value=$mail_utilisateur>" ?>
            <label for="email">Email : </label>
            <input type="email" name="email" id="email" value="<?php echo $actualUser['mail_utilisateur']; ?>">
            <br>

            <?php 
            $type_utilisateur = $actualUser['type_utilisateur'];
            echo "<input type='hidden' name='id' value=$type_utilisateur>" ?>
            <label for="type">Type : </label>
            <select name="type" id="type">
                <option value="none" selected disabled hidden><?php echo $actualUser['type_utilisateur']; ?></option>
                <option value="0">Utilisateur</option>
                <option value="1">Quizzeur</option>
                <option value="2">Administrateur</option>
            </select>
            <br>

            <button type="submit" name="modif-btn" class="modif-btn">Modifier</button>
        </form>

        <?php

        //if the user click on the modify button, update the user in the database and redirect to the admin panel
        if (isset($_POST['modif-btn'])){
            //get the new values in the form and update the user
            $id = $actualUser['id_utilisateur'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $type = $_POST['type'];

            $sql = "UPDATE utilisateurs SET nom_utilisateur = '$nom', prenom_utilisateur = '$prenom', mail_utilisateur = '$email', type_utilisateur = '$type' WHERE id_utilisateur = '$id'";
            
            //if the update is successful, redirect to the admin panel
            $result = mysqli_query($conn, $sql);
            if ($result){
                header("Location: admin.php");
                echo "L'utilisateur a bien été modifié";
                exit();
            } else {
                echo "L'utilisateur n'a pas été modifié";
                exit();
            }
        }

        ?>  

    </div>
    
</body>
</html>
