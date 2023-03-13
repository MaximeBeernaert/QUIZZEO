<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Modification</title>
</head>

<body>
    <header>
        <?php
        require 'header.php';
        ?>
    </header>
    <?php
    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    
    if(!isset($_POST['id_utilisateur'])){
        header("Location:usermenu.php");
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
        <div class="userModif">

            <?php
            if (!isset($_SESSION['user'])) {
                header("Location:notconnected.php");
            }
            // get the id of the user to modify
            $id = $_POST['id_utilisateur'];
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
            <!-- form to modify the user -->
            <form class="form" action="saveUser.php" method="POST">
                <!-- display the user to modify -->
                <h2>Modification de l'utilisateur suivant : </h2><br>
                <h3><?php echo "ID : " . $actualUser['id_utilisateur'] . " Nom : " . $actualUser['nom_utilisateur'] . " Prénom : " . $actualUser['prenom_utilisateur']; ?></h3>

                <?php $id_utilisateur1 = $actualUser['id_utilisateur'];
                echo "<input type='hidden' name='id_utilisateur' id='id_utilisateur' value='$id_utilisateur1'>"; ?>

                <?php $nom_utilisateur = $actualUser['nom_utilisateur']; ?>
                <label for="nom">Nom : </label>
                <?php echo "<input class='input' type='text' name='nom' id='nom' value='$nom_utilisateur'>"; ?>
                <br>

                <?php $prenom_utilisateur = $actualUser['prenom_utilisateur']; ?>
                <label for="prenom">Prénom : </label>
                <?php echo "<input class='input' type='text' name='prenom' id='prenom' value='$prenom_utilisateur'>"; ?>
                <br>

                <?php $email_utilisateur = $actualUser['mail_utilisateur']; ?>
                <label for="email">Email : </label>
                <?php echo "<input class='input' type='text' name='email' id='email' value='$email_utilisateur'>"; ?>
                <br>

                <?php $type_utilisateur = $actualUser['type_utilisateur']; ?>
                <label for="type">Type : </label>
                <?php echo "<input type='hidden' name='type' value=$type_utilisateur>" ?>
                <select class='input' name="type" id="type">
                    <option selected disabled hidden><?php echo $actualUser['type_utilisateur']; ?></option>
                    <option>Utilisateur</option>
                    <option>Quizzeur</option>
                    <option>Administrateur</option>
                </select>
                <br>
                <div class="modif-btn">
                    <button type="submit" name="modif-btn" class="buttonBlue modif-btn">Modifier</button>
                </div>
            </form>



        </div>
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>
</body>

</html>