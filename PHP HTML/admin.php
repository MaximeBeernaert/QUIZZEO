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
                $sql = "SELECT * FROM users";
                while ($user = mysqli_fetch_assoc($sql)){
                    echo $user['username'];
                }
            
                ?>

            </div>

        </div>
</body>

</html>