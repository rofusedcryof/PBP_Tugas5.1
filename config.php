<?php
$host = "Localhost";
$username = "Admin";
$db = "todo_app";
$password = "12345678";

$conn = mysqli_connect($host, $username, $password, $db);
if (!$conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
?>