<?php
include 'php/db.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: php/login.php");
    exit;
}

$sql = "SELECT id, description, status FROM tasks WHERE user_id=".$_SESSION["user_id"];
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="hello">
        <h1>Bienvenue, <?php echo $_SESSION["username"]; ?>! <a href="php/logout.php">Se déconnecter</a></h1>
        <form action="php/add_task.php" method="post">
            <input type="text" name="task_description" placeholder="Nouvelle tâche">
            <button type="submit">Ajouter</button>
        </form>
    </div>
    
    <div id="task-container">
        <ul id="task-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $checked = $row["status"] == true ? 'checked' : '';
                    echo "<li class='task'>
                              <input type='checkbox' onclick='toggleTaskStatus({$row["id"]})' {$checked}>
                              <span>{$row["description"]}</span>
                              <div>
                                  <a href='php/delete_task.php?id={$row["id"]}'>Supprimer</a>
                              </div>
                          </li>";
                }
            } else {
                echo "<p>Pas de tâches</p>";
            }
            $conn->close();
            ?>
        </ul>
    </div>
  
    <script>
        function toggleTaskStatus(taskId) {
            fetch(`php/mark_done.php?id=${taskId}`)
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
