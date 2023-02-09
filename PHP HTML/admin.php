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

                // display all users in the database as a table whit their id, name, firstname, email and type and option button to delete them, edit them or add them
                ?>
                <table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Nom</th>
                        <th scope='col'>Prenom</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Type</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>
                <?php
                while ($user = mysqli_fetch_assoc($result)) {
                    switch ($user['type_utilisateur']) {
                        case 1:
                            $user['type_utilisateur'] = "Quizzeur";
                            break;
                        case 2:
                            $user['type_utilisateur'] = "Administrateur";
                            break;
                        default:
                            $user['type_utilisateur'] = "Utilisateur";
                            break;
                    }
                    echo
                    "<tbody>
                        <tr>

                            <td>" . $user['id_utilisateur'] . "</td>
                            <td>" . $user['nom_utilisateur'] . "</td>
                            <td>" . $user['prenom_utilisateur'] . "</td>
                            <td>" . $user['mail_utilisateur'] . "</td>
                            <td>" . $user['type_utilisateur'] . "</td>

                            <td>
                            <button type='button' class='btn-modif'>Modifier</button>
                            <button type='button' class='btn-suppr'>Supprimer</button>
                            </td>

                        </tr>
                    </tbody>
                </table>";
                }

                function delete_user($id)
                {
                    $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = $id";
                    $result = mysqli_query($conn, $sql);
                }
                ?>

            </div>

        </div>
</body>

</html>