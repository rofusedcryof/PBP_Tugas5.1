<?php
include "config.php";
include "functions.php";
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
    $stmt = $conn->prepare("UPDATE todos SET is_done = 1 WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
}

header("Location: todo.php");
exit();
