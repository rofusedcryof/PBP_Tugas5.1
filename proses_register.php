<?php
include "config.php";

$username = trim($_POST['username']);
$password = hash('sha256', $_POST['password']);

//cek usn sudah ada apa blom
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('Username sudah digunakan!');window.location='register.php';</script>";
} else {
    //simpan user baru yg sudah reg
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan.');window.location='register.php';</script>";
    }
}