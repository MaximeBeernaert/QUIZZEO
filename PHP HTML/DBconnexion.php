<?php
$name = "localhost";
$username = "root";
$password = "";
$db_name = "quizzeo";

$conn = mysqli_connect($name, $username, $password, $db_name);

if (!$conn) {
    echo "Connection failed! : " . mysqli_connect_error();
}
