<?php
include "config.php";
include "functions.php";
redirectIfNotLoggedIn();

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM todos WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$todos = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($username) ?> - To Do List</h1>
        <img src="img/profil.jpeg" alt="foto" class="foto">
        <p>NIM: 235314023</p>
        <a href="logout.php" class="logout">Logout</a>
    </header>
    
    <form method="post" action="proses_todo.php">
        <input type="text" name="task" placeholder="Teks to do..." required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <ul class="list">
        <?php while ($row = $todos->fetch_assoc()): ?>
            <li>
                <span class="<?= $row['is_done'] ? 'done' : '' ?>">
                    <?= htmlspecialchars($row['task']) ?>
                </span>
                <a href="proses_todo.php?done=<?= $row['id'] ?>">Selesai</a>
                <a href="proses_todo.php?delete=<?= $row['id'] ?>" class="hapus">Hapus</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
