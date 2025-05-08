<?php
$host = "localhost";
$username = "root";
$db = "todo_app";
$password = "";

$conn = mysqli_connect($host, $username, $password, $db);
if (!$conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
?>