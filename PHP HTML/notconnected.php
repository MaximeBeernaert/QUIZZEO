<!DOCTYPE html>
<html lang="en">
<head>
<?php
    require('header.php');
  ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
// When the user is not yet logged in, he is forwarded to this page, where he has the option to go to Login, or the Main Page. 
echo "Vous n'êtes pas encore connecté !<br><p class='link'><a href='login.php'>login</a></p><br><p class='link'><a href='accueil.php'>accueil</a></p><br>";
 require('header.php');
?>

</body>
</html>

