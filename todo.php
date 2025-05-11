<?php
include "config.php";
include "functions.php";
redirectIfNotLoggedIn();

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$limit = 5;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM todos WHERE user_id = ?");
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$total_result = $count_stmt->get_result()->fetch_assoc();
$total_tasks = $total_result['total'];
$total_pages = ceil($total_tasks / $limit);

$stmt = $conn->prepare("SELECT * FROM todos WHERE user_id = ? ORDER BY id DESC LIMIT ? OFFSET ?");
$stmt->bind_param("iii", $user_id, $limit, $offset);
$stmt->execute();
$todos = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <header class="text-center mb-4">
        <h1 class="text-warning"><?= htmlspecialchars($username) ?> - To Do List</h1>
        <img src="img/profil.jpeg" alt="foto" class="foto">
        <p class="text-light">NIM: 235314023</p>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </header>

    <form method="post" action="proses_todo.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="task" class="form-control" placeholder="Ketik ToDo List di sini bolo..." required>
            <button type="submit" name="add" class="btn btn-success">Tambah</button>
        </div>
    </form>

    <ul class="list-group mb-4">
        <?php while ($row = $todos->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center 
                <?= $row['is_done'] ? 'text-decoration-line-through text-muted' : '' ?>">
                <?= htmlspecialchars($row['task']) ?>
                <div>
                    <?php if (!$row['is_done']): ?>
                        <a href="proses_todo.php?done=<?= $row['id'] ?>" class="btn btn-sm btn-outline-success">Selesai</a>
                    <?php endif; ?>
                    <a href="proses_todo.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php if ($total_pages > 1): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

</body>
</html>
