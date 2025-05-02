<?php
include "config.php";
redirectIfNotLoggedIn();
$user_id = $_SESSION['user_id'];

if (isset($_POST['add'])) {
    $task = trim($_POST['task']);
    if ($task != "") {
        $stmt = $conn->prepare("INSERT INTO todos (user_id, task) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $task);
        $stmt->execute();
    }
}

if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    $conn->query("UPDATE todos SET is_done = 1 WHERE id=$id AND user_id=$user_id");
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM todos WHERE id=$id AND user_id=$user_id");
}

header("Location: todo.php");
exit();