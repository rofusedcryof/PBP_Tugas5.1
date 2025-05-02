<?php
include "config.php";
include "functions.php";
redirectIfNotLoggedIn();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$todos = $conn->query("SELECT * FROM todos WHERE user_id = $user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
</head>
<body>
    <header>
        <h1><?= $username ?> - To Do List</h1>
        <img src="img/profil.jpg" alt="foto" class="foto">
        <p>NIM: 2153114007</p>
        <a href="logout.php" class="logout">Logout</a>
    </header>
    
    <form method="post" action="proses_todo.php">
        <input type="text" name="task" placeholder="Teks to do..." required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <ul class="list">
        <?php while ($row = $todos->fetch_assoc()): ?>
            <li>
                <span class="<?= $row['is_done'] ? 'done' : '' ?>"><?= htmlspecialchars($row['task']) ?></span>
                <a href="proses_todo.php?done=<?= $row['id'] ?>">Selesai</a>
                <a href="proses_todo.php?delete=<?= $row['id'] ?>" class="hapus">Hapus</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>