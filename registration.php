<?php
include 'config.php';

$email = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];

$sql = "INSERT INTO users(name,email, password) VALUES ('$name','$email','$password');";
$result = mysqli_query($conn, $sql) ;


header("location: ./index.php");
mysqli_close($conn);
?>