<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Menu</title>
</head>
<body>
<?php
    require('DBconnexion.php');
    echo "Vous êtes connecté sous le compte de ";
    $username = $_SESSION['username'];
    echo $username;
?>