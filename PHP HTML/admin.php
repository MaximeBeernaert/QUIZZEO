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
    <header>
        <h1>QUIZZEO</h1>
        <p>Interface utilisateur</p>

    </header>

    <div class="container">


        <div class="users">
            <h2>Listes des utilisateurs de Quizzeo :</h2>

            <?php
            session_start();
            require 'DBconnexion.php';
            if (!isset($_SESSION['user'])) {
                header("Location:notconnected.php");
            }

            $user = $_SESSION['user'];

            if ($user['type_utilisateur'] != 2) {
                header("Location:notpermited.php");
            }
            $sql = "SELECT * FROM utilisateurs";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            //don't display if the database is empty
            if ($resultCheck < 1) {
                echo "Il n'y a pas d'utilisateurs dans la base de données";
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
                    <?php while ($row = mysqli_fetch_assoc($result)) :
                        //change the type of user from number to string to display it
                        switch ($row['type_utilisateur']) {
                            case 1:
                                $row['type_utilisateur'] = "Quizzeur";
                                break;
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
                                    <?php
                                    $id_utilisateur = $row['id_utilisateur'];
                                    echo "<input type='hidden' name='id' value=$id_utilisateur>" ?>
                                    <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                                </form>
                            </td>
                            <td>
                                <form action="admin.php" method="POST">
                                    <?php
                                    $id_utilisateur = $row['id_utilisateur'];
                                    echo "<input type='hidden' name='id' value=$id_utilisateur>" ?>
                                    <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                                </form>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <?php
            // if the user click on the delete button, delete the user from the database and ask confirmation with a button
            if (isset($_POST['delete-btn'])) {
                $id = $_POST['id'];
                echo "<p>Êtes-vous sûr de vouloir supprimer l'utilisateur avec l'ID $id ?</p>";
                echo "<form action='admin.php' method='POST'>
                <input type='hidden' name='id' value='$id'>
                <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn'>Oui</button>
                <button type='submit' name='cancel-delete-btn' class='cancel-delete-btn'>Non</button>
                </form>";
            }
            // if the user click on the confirm delete button, delete the user from the database
            if (isset($_POST['confirm-delete-btn'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = $id";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "Erreur lors de la suppression de l'utilisateur";
                } else {
                    echo "L'utilisateur avec l'id $id a bien été supprimé !";
                    include_once 'admin.php';
                }
            }

            // if the user click on the modify button, redirect to the modify page
            if (isset($_POST['modify-btn'])) {
                $id = $_POST['id'];
                $_SESSION['id'] = $id;
                include_once 'modifyUser.php';
            }
            ?>
            <a href="usermenu.php">Retour au menu principal</a>
        </div>
    </div>
</body>

</html>