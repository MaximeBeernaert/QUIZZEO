<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Gérer mes Quizz</title>
    <title>Gérer mes Quizz</title>
</head>
<body>
    <table>
<?php
    session_start();
    require('DBconnexion.php');

    $user = $_SESSION['user'];
    $id_utilisateur = $user['id_utilisateur'];
    $type_utilisateur = $user['type_utilisateur'];
    if($type_utilisateur==2){
        $query = "SELECT * FROM `quizz`";
    }else{
        $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
    }
    
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)):
        $id_user = $row['auteur_quizz'];
?>
        <tr>
            <td><?php echo $row['titre_quizz']; ?></td>
            <td><?php echo $id_user; ?></td>
            <td><?php echo $row['date_creation_quizz']; ?></td>
            <td>
                <form action="quizzlist.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['titre_quizz']; ?>">
                    <button type="submit" name="modify-btn" class="modify-btn">Modifier</button>
                </form>
            </td>
            <td>                            
                <form action="quizzlist.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['titre_quizz']; ?>">
                    <button type="submit" name="delete-btn" class="delete-btn">Supprimer</button>
                </form>
            </td>
        </tr>
<?php endwhile; ?>
    </table>
<?php

// DELETE BUTTON 
// MODIFY BUTTON

?>
</html>