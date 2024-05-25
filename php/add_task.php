<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST["task_description"];
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO tasks (description, status, creation_date, user_id) VALUES ('$description', 'to-do', NOW(), $user_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle tâche ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: ../index.php");
?>
