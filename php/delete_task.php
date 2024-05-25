<?php
include 'db.php';
session_start();

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];
$sql = "DELETE FROM tasks WHERE id=$id AND user_id=$user_id";

if ($conn->query($sql) === TRUE) {
    echo "Tâche supprimée";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../index.php");
?>
