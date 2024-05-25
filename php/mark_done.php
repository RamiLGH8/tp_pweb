<?php
include 'db.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $userId = $_SESSION["user_id"];

    // Fetch the current status of the task
    $sql = "SELECT status FROM tasks WHERE id=$taskId AND user_id=$userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['status'];

        // Toggle the status
        $newStatus = $currentStatus ? 0 : 1;

        // Update the task status in the database
        $updateSql = "UPDATE tasks SET status=$newStatus WHERE id=$taskId AND user_id=$userId";
        if ($conn->query($updateSql) === TRUE) {
            echo "Tâche mise à jour";
        } else {
            echo "Erreur: " . $updateSql . "<br>" . $conn->error;
        }
    } else {
        echo "Tâche non trouvée ou non autorisée";
    }
} else {
    echo "ID de tâche non spécifié";
}

$conn->close();
header("Location: ../index.php");
exit;
?>
