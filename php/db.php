<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_list";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
