<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Menu</title>
</head>
<body>
<?php
    session_start();
    require('DBconnexion.php');
    echo "Vous êtes connecté sous le compte de ";
    $username = $_SESSION['username'];
    echo $username;
?>