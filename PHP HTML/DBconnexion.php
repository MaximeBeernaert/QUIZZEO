<?php
// page to connect to the database
$name = "localhost";
$username = "root";
$password = "";
$db_name = "quizzeo";

// mysqli request, with the right arguments
$conn = mysqli_connect($name, $username, $password, $db_name);

// if the connection has failed, we get the error.
if (!$conn) {
    echo "Connection failed! : " . mysqli_connect_error();
}
