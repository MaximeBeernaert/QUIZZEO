<?php 
//code to log out of the current user session
session_start();
session_unset();
session_destroy();
// forward the user back toward the main menu
header("Location: accueil.php");
