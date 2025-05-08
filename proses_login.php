<?php
include "config.php";

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']); // Gunakan hash SHA-256

$sqpl = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sqpl);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {  // Gunakan perbandingan ==
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];         // Gunakan $row, bukan $user
    $_SESSION['username'] = $row['username'];
    header("Location: todo.php");
    exit(); // Tambahkan exit agar script berhenti setelah redirect
} else {
    echo "<script>alert('Username atau Password salah!');window.location='index.php';</script>";
}
?>
