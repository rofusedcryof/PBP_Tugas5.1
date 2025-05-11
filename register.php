<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-box">
        <h2>Register</h2>
        <form action="proses_register.php" method="post">
            <label>Username:</label><br>
            <input type="text" name="username" placeholder="Masukkan Nama" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" placeholder= "Masukkan Password yg unik" required><br><br>
            <button type="submit">Daftar</button>
        </form>
        <p style="text-align:center;">Sudah punya akun? <a href="index.php">Login</a></p>
    </div>
</body>
</html>