<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Personel</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>

    <div class="container">
        <div class="currentUserInfo">
            <?php
            if (!isset($_SESSION['user'])) {
                header("Location:notconnected.php");
            }

            // get the id of the user for the personal space
            $user = $_SESSION['user'];
            $id = $user['id_utilisateur'];
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
            <div class="infoDisplay">
                <form class='form' action="saveUser.php" method="POST">
                    <h1>Mon espace personnel</h1>
                    <?php $id_utilisateur = $actualUser['id_utilisateur'];
                    echo "<input type='hidden' name='id_utilisateur' id='id_utilisateur' value='$id_utilisateur'>"; ?>

                    <?php $nom_utilisateur = $actualUser['nom_utilisateur']; ?>
                    <label for="nom">Nom : </label>
                    <?php echo "<input class='input' type='text' name='nom' id='nom' value='$nom_utilisateur'>"; ?>
                    <br>

                    <?php $prenom_utilisateur = $actualUser['prenom_utilisateur']; ?>
                    <label for="prenom">Prénom : </label>
                    <?php echo "<input class='input' type='text' name='prenom' id='prenom' value='$prenom_utilisateur'>"; ?>
                    <br>

                    <?php $email_utilisateur = $actualUser['mail_utilisateur'];
                    echo "<label for='type'>Votre email : $email_utilisateur </label>"; ?>
                    <br>
                    <br>
                    <?php $type_utilisateur = $actualUser['type_utilisateur'];
                    echo "<label for='type'>Vous avez le grade : $type_utilisateur </label>"; ?>
                    <br>
                    <br>
                    <div class="modif-btn">
                        <button type="submit" name="modif-btn" class="buttonBlue modif-btn">Modifier</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</body>

</html>