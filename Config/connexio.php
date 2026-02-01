<?php
// Connexió centralitzada
$host = "localhost";
$user = "root"; 
$pass = "";     
$db   = "projecte"; 


$conn = new mysqli($host, $user, $pass);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);
?>
