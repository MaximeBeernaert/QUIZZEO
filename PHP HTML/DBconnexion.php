<?php
$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "quizzeo";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

echo $conn;
echo "hello";

if (!$conn) {
    echo "Connection failed! : " . mysqli_connect_error();
}else {echo "Connecté!";}
?>