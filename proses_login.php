<?php
include "config.php";

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$sqpl = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sqpl);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header("Location: todo.php");
    exit();
} else {
    echo "<script>alert('Username atau Password salah!');window.location='index.php';</script>";
}
?>
