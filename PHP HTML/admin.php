<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
</head>

<body>
    <div class="container">
        <h1>Interface administrateur</h1>

        <div class="users">
            <div class="col-6">
                <h2>Listes des utilisateurs de Quizzeo :</h2>

                <?php

                require 'DBconnexion.php';

                $sql = "SELECT * FROM utilisateurs";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                while ($user = mysqli_fetch_assoc($result)) {
                    echo "<br> ID : " . $user['id_utilisateur'] . " Nom :" . $user['nom_utilisateur'] . " Prenom : " . $user['prenom_utilisateur'] . " email : " . $user['mail_utilisateur'];
                }

                ?>

            </div>

        </div>
</body>

</html>