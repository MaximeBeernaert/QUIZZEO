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

        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = " . $_GET['id'];
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $actualUser = mysqli_fetch_assoc($result);

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
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" value="<?php echo $actualUser['nom_utilisateur']; ?>">
            <br>

            <label for="prenom">Prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $actualUser['prenom_utilisateur']; ?>">
            <br>

            <label for="email">Email : </label>
            <input type="email" name="email" id="email" value="<?php echo $actualUser['mail_utilisateur']; ?>">
            <br>

            <label for="type">Type : <?php echo $actualUser['type_utilisateur']; ?></label>
            <select name="type" id="type">
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
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $type = $_POST['type'];

            $sql = "UPDATE utilisateurs SET nom_utilisateur = '$nom', prenom_utilisateur = '$prenom', mail_utilisateur = '$email', type_utilisateur = '$type' WHERE id_utilisateur = '$id'";
            $result = mysqli_query($conn, $sql);

            if ($result){
                header("Location: admin.php");
                echo "L'utilisateur a bien été modifié";
                exit();
            } else {
                header("Location: admin.php");
                echo "L'utilisateur n'a pas été modifié";
                exit();
            }
        }

        ?>  

    </div>
    
</body>
</html>
