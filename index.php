<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="proses_login.php" method="post">
            <label>Username:</label><br>
            <input type="text" name="username" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit">Submit</button>
        </form>
        <p style="text-align:center;">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>