<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Panel Admin</title>
</head>

<body>
    <div class="container">

        <a href="accueil.php">Accueil</a>

        <h1>Interface administrateur</h1>

        <div class="users">
            <h2>Listes des utilisateurs de Quizzeo :</h2>

            <?php

            require 'DBconnexion.php';

            $sql = "SELECT * FROM utilisateurs";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $checkIfNull = mysqli_fetch_assoc($result);

            if ($checkIfNull == null) {
                echo "<h4> Il n'y a pas d'utilisateurs dans la base de données </h4>";
                return;
            }
            // display all users in the database as a table whit their id, name, firstname, email and type and option button to delete them, edit them or add them
            ?>
        </tbody>
            </table>
    
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Date de création du compte</th>
                    <th>Type</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    // change the type of user from number to string to display it
                    switch ($row['type_utilisateur']) {
                        case 1:
                            $row['type_utilisateur'] = "Quizzeur";
                                reak;
                        case 2:
                            $row['type_utilisateur'] = "Administrateur";
                            break;
                        default:
                            $row['type_utilisateur'] = "Utilisateur";
                            break;
                    }
                    ?>
                    <tr>
                        <td><?php echo $row['id_utilisateur']; ?></td>
                        <td><?php echo $row['nom_utilisateur']; ?></td>
                        <td><?php echo $row['prenom_utilisateur']; ?></td>
                        <td><?php echo $row['mail_utilisateur']; ?></td>
                        <td><?php echo $row['date_creation_utilisateur']; ?></td>
                        <td><?php echo $row['type_utilisateur']; ?></td>
                        <td>
    
                        <form action="admin.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id_utilisateur']; ?>">
                            <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                        </form>
                            
                        <form action="admin.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id_utilisateur']; ?>">
                            <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                        </form>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    
            <?php
            // if the user click on the delete button, delete the user from the database and ask confirmation
            if (isset($_POST['delete-btn'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = $id";
                $result = mysqli_query($conn, $sql);
                header("Location: admin.php");
            }
    
            // if the user click on the modify button, redirect to the modify page
            //TODO: create the modify page
            ?>

        </div>

    </div>
</body>

</html>