<?php
include "config.php";
include "functions.php";  // Pastikan functions.php di-*include* untuk fungsi redirectIfNotLoggedIn()
redirectIfNotLoggedIn();
$user_id = $_SESSION['user_id'];

// Menambahkan task baru
if (isset($_POST['add'])) {
    $task = trim($_POST['task']);
    if ($task != "") {
        $stmt = $conn->prepare("INSERT INTO todos (user_id, task) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $task);
        $stmt->execute();
    }
}

// Menandai tugas sebagai selesai
if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("UPDATE todos SET is_done = 1 WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
}

// Menghapus task
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
}

// Redirect ke halaman todo.php setelah aksi selesai
header("Location: todo.php");
exit();
